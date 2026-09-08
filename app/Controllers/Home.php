<?php

namespace App\Controllers;
use App\Models\AppModel;

class Home extends BaseController
{
    protected $AppModel;

    public function __construct()
    {
        $this->AppModel = new AppModel();
    }
    public function index(): string
    {

        $table_name = "admin_category";
        $where_condition = array('cat_status' => 'Active');
        $data['categoryList'] = $this->AppModel->gameAllData($table_name, $where_condition);

        foreach ($data['categoryList'] as $row) {
            $stats = $this->getCidStats($row->cid);

            $row->right_count               = $stats['right_count'];
            $row->wrong_count               = $stats['wrong_count'];
            $row->total_time_used_formatted = $stats['total_time_used_formatted'];
            $row->time_balance_formatted    = $stats['time_balance_formatted'];
        }
        return view('welcome_message',$data);
    }
    public function graphview($cid): string
    {
        date_default_timezone_set('Asia/Kolkata');
        $table_name = "admin_subcategory";
        $where_condition = array('web_status' => 'Active','cid' => $cid);
        $data['imageList'] = $this->AppModel->fetchAllData($table_name, $where_condition);

        $check_table = "admin_update";
        $check_condition = array('c_status' => 'Active', 'cid' => $cid);
        $checkcount = $this->AppModel->fetchAllData($check_table, $check_condition);

        if (count($checkcount) == 0) {
            $update_condition = array(
                'cid'      => $cid,
                'activate_time' => date('Y-m-d H:i:s'),
                'c_status' => 'Active'
            );
            $this->AppModel->insertDataUpdate($update_condition);
        }
        $data['cid'] = $cid;
        return view('graphview',$data);
    }

    private function getCidStats($cid, int $totalSessionSeconds = 120): array
    {
        $db = \Config\Database::connect();

        // Total images configured for this category
        $imageCount = $db->table('admin_subcategory')
            ->where('cid', $cid)
            ->where('web_status', 'Active')
            ->countAllResults();

        // When this category was activated
        $adminUpdate = $db->table('admin_update')
            ->select('activate_time')
            ->where('cid', $cid)
            ->get()
            ->getRow();

        $activateTimeOnly = null;
        if ($adminUpdate && !empty($adminUpdate->activate_time)) {
            $activateTimeOnly = date('H:i:s', strtotime($adminUpdate->activate_time));
        }

        // Most recent answer submitted for this category (any session)
        $lastAnswer = $db->table('quiz_answers')
            ->select('submitted_time')
            ->where('cid', $cid)
            ->orderBy('id', 'DESC')
            ->limit(1)
            ->get()
            ->getRow();

        $lastSubmittedTimeOnly = $lastAnswer->submitted_time ?? null;

        $elapsedSinceActivate = 0;
        if ($activateTimeOnly && $lastSubmittedTimeOnly) {
            $t1 = strtotime('1970-01-01 ' . $activateTimeOnly);
            $t2 = strtotime('1970-01-01 ' . $lastSubmittedTimeOnly);
            $elapsedSinceActivate = abs($t2 - $t1);
        }

        $timeBalanceSeconds = max(0, $totalSessionSeconds - $elapsedSinceActivate);

        // Right / wrong counts across all answers logged for this cid
        $answers = $db->table('quiz_answers')
            ->where('cid', $cid)
            ->get()
            ->getResult();

        $rightCount = 0;
        $wrongCount = 0;
        foreach ($answers as $answer) {
            if ($answer->status === 'right') $rightCount++;
            if ($answer->status === 'wrong') $wrongCount++;
        }

        $formatMMSS = function (int $seconds) {
            $m = floor($seconds / 60);
            $s = $seconds % 60;
            return sprintf('%02d:%02d', $m, $s);
        };

        return [
            'image_count'               => $imageCount,
            'right_count'               => $rightCount,
            'wrong_count'               => $wrongCount,
            'total_time_used_seconds'   => $elapsedSinceActivate,
            'total_time_used_formatted' => $formatMMSS($elapsedSinceActivate),
            'time_balance_seconds'      => $timeBalanceSeconds,
            'time_balance_formatted'    => $formatMMSS($timeBalanceSeconds),
        ];
    }
    public function saveAnswer()
    {
        date_default_timezone_set('Asia/Kolkata');
        $input = json_decode($this->request->getBody(), true);

        if (empty($input['image_id']) || empty($input['status'])) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'image_id and status are required',
            ])->setStatusCode(400);
        }

        $allowedStatuses = ['right', 'wrong'];

        if (!in_array($input['status'], $allowedStatuses, true)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'status must be right or wrong',
            ])->setStatusCode(400);
        }

        $db = \Config\Database::connect();

        $sessionId = session_id();
        $imageId   = (int) $input['image_id'];

        $totalSessionSeconds = 120;

        $subcategory = $db->table('admin_subcategory')
            ->select('sid, cid, web_image')
            ->where('web_status', 'Active')
            ->where('sid', $imageId)
            ->get()
            ->getRow();

        if (!$subcategory) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Image not found'
            ])->setStatusCode(404);
        }

        $cid = (int) $subcategory->cid;

        $imageCount = $db->table('admin_subcategory')
            ->where('web_status', 'Active')
            ->where('cid', $cid)
            ->countAllResults();

        $answeredCountForCid = $db->table('quiz_answers')
            ->where('cid', $cid)
            ->countAllResults();


        if ($imageCount > 0 && $answeredCountForCid >= $imageCount) {

            $adminUpdate = $db->table('admin_update')
            ->select('activate_time')
            ->where('cid', $cid)
            ->get()
            ->getRow();

        $activateTimeOnly = null;
        if ($adminUpdate && !empty($adminUpdate->activate_time)) {
            $activateTimeOnly = date('H:i:s', strtotime($adminUpdate->activate_time));
        }

        $lastAnswerForCid = $db->table('quiz_answers')
            ->select('submitted_time')
            ->where('cid', $cid)
            ->orderBy('id', 'DESC')
            ->limit(1)
            ->get()
            ->getRow();

        $lastSubmittedTimeOnly = $lastAnswerForCid->submitted_time ?? null;

        $elapsedSinceActivate = 0;
        if ($activateTimeOnly && $lastSubmittedTimeOnly) {
            $t1 = strtotime('1970-01-01 ' . $activateTimeOnly);
            $t2 = strtotime('1970-01-01 ' . $lastSubmittedTimeOnly);
            $elapsedSinceActivate = abs($t2 - $t1);
        }

        // NEW: balance = total session length minus elapsed time since activation
        $timeBalanceSeconds = max(0, $totalSessionSeconds - $elapsedSinceActivate);

        $answers = $db->table('quiz_answers')
            ->where('cid', $cid)
            ->where('session_id', $sessionId)
            ->get()
            ->getResult();

        $totalSubmitted  = count($answers);
        $rightCount      = 0;
        $wrongCount      = 0;
        $totalTimeUsed   = 0;
        $lastSubmittedAt = null;

        foreach ($answers as $answer) {
            if ($answer->status === 'right') $rightCount++;
            if ($answer->status === 'wrong') $wrongCount++;
            $totalTimeUsed += (int) $answer->time_taken;
            if ($lastSubmittedAt === null || $answer->submitted_at > $lastSubmittedAt) {
                $lastSubmittedAt = $answer->submitted_at;
            }
        }

        $formatMMSS = function (int $seconds) {
            $m = floor($seconds / 60);
            $s = $seconds % 60;
            return sprintf('%02d:%02d', $m, $s);
        };

        // NEW: tell frontend whether the whole cid is now complete
        $cidNowCompleted = ($answeredCountForCid + 1) >= $imageCount;
         $now = date('Y-m-d H:i:s');
            return $this->response->setJSON([
                'success'          => true,
                'already_answered' => true,
                'cid_completed'    => true,
                'message'          => 'All images for this category have already been answered.',
                'cid_completed'    => $cidNowCompleted,
                'total_submitted'  => $totalSubmitted,
                'right_count'      => $rightCount,
                'wrong_count'      => $wrongCount,
                'image_count'      => $imageCount,
                'cid'              => $cid,

                // NEW: driven by activate_time -> submitted_time elapsed, not summed time_taken
                'total_time_used_seconds'   => $elapsedSinceActivate,
                'total_time_used_formatted' => $formatMMSS($elapsedSinceActivate),

                'time_balance_seconds'      => $timeBalanceSeconds,
                'time_balance_formatted'    => $formatMMSS($timeBalanceSeconds),

                'activate_time'             => $activateTimeOnly,
                'last_submitted_time'       => $lastSubmittedTimeOnly,

                'session_length_seconds'    => $totalSessionSeconds,
                'session_length_formatted'  => $formatMMSS($totalSessionSeconds),
                'last_submitted_at'         => $lastSubmittedAt,
                'submitted_at'              => $now,
            ]);
        } else {

            $timeTaken = (int) ($input['time_taken'] ?? 0);

            // NEW: tell frontend whether the whole cid is now complete
            $cidNowCompleted = ($answeredCountForCid + 1) >= $imageCount;
            $now = date('Y-m-d H:i:s');

            $data = [
                'session_id'     => $sessionId,
                'image_id'       => $imageId,
                'cid'            => $cid,
                'status'         => $input['status'],
                'time_taken'     => $timeTaken,
                'submitted_time' => date('H:i:s'),
                'submitted_at'   => $now,
                'created_at'     => $now,
            ];

            $db->table('quiz_answers')->insert($data);

            $adminUpdate = $db->table('admin_update')
                ->select('activate_time')
                ->where('cid', $cid)
                ->get()
                ->getRow();

            $activateTimeOnly = null;
            if ($adminUpdate && !empty($adminUpdate->activate_time)) {
                $activateTimeOnly = date('H:i:s', strtotime($adminUpdate->activate_time));
            }

            $lastAnswerForCid = $db->table('quiz_answers')
                ->select('submitted_time')
                ->where('cid', $cid)
                ->orderBy('id', 'DESC')
                ->limit(1)
                ->get()
                ->getRow();

            $lastSubmittedTimeOnly = $lastAnswerForCid->submitted_time ?? null;

            // Convert both "H:i:s" strings into numeric timestamps before doing any math
            $t1 = null;
            $t2 = null;
            $elapsedSinceActivate = 0;

            if ($activateTimeOnly && $lastSubmittedTimeOnly) {
                $t1 = strtotime('1970-01-01 ' . $activateTimeOnly);
                $t2 = strtotime('1970-01-01 ' . $lastSubmittedTimeOnly);
                $elapsedSinceActivate = abs($t2 - $t1);
            }

            // Balance = total session length minus elapsed time since activation
            $timeBalanceSecondsRemaining = max(0, $totalSessionSeconds - $elapsedSinceActivate);

            // Elapsed time between activate_time and last_submitted_time (numeric now, not string subtraction)
            $timeBalanceSeconds = ($t1 !== null && $t2 !== null) ? max(0, $t2 - $t1) : 0;

            $answers = $db->table('quiz_answers')
                ->where('cid', $cid)
                ->where('session_id', $sessionId)
                ->get()
                ->getResult();

            $totalSubmitted  = count($answers);
            $rightCount      = 0;
            $wrongCount      = 0;
            $totalTimeUsed   = 0;
            $lastSubmittedAt = null;

            foreach ($answers as $answer) {
                if ($answer->status === 'right') $rightCount++;
                if ($answer->status === 'wrong') $wrongCount++;
                $totalTimeUsed += (int) $answer->time_taken;
                if ($lastSubmittedAt === null || $answer->submitted_at > $lastSubmittedAt) {
                    $lastSubmittedAt = $answer->submitted_at;
                }
            }

            $formatMMSS = function (int $seconds) {
                $m = floor($seconds / 60);
                $s = $seconds % 60;
                return sprintf('%02d:%02d', $m, $s);
            };

            return $this->response->setJSON([
                'success'          => true,
                'already_answered' => false,
                'cid_completed'    => $cidNowCompleted,
                'total_submitted'  => $totalSubmitted,
                'right_count'      => $rightCount,
                'wrong_count'      => $wrongCount,
                'image_count'      => $imageCount,
                'cid'              => $cid,

                // Driven by activate_time -> submitted_time elapsed, not summed time_taken
                'total_time_used_seconds'   => $elapsedSinceActivate,
                'total_time_used_formatted' => $formatMMSS($elapsedSinceActivate),

                'time_balance_seconds'      => $timeBalanceSecondsRemaining,
                'time_balance_formatted'    => $formatMMSS($timeBalanceSecondsRemaining),

                'activate_time'             => $activateTimeOnly,
                'last_submitted_time'       => $lastSubmittedTimeOnly,

                'session_length_seconds'    => $totalSessionSeconds,
                'session_length_formatted'  => $formatMMSS($totalSessionSeconds),
                'last_submitted_at'         => $lastSubmittedAt,
                'submitted_at'              => $now,
            ]);

        }
        
    }
   
   
}
