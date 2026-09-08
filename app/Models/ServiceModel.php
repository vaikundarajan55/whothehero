<?php namespace App\Models;
use CodeIgniter\Model;
//use PhpParser\Node\Expr\Print_;

class ServiceModel  extends Model
{
     /*
    |--------------------------------------------------------------------------
    | Fetch Single Row
    |--------------------------------------------------------------------------
    */
    public function fetchData($table_name, $where_condition)
    {
        return $this->db->table($table_name)
                        ->select('*')
                        ->where($where_condition)
                        ->get()
                        ->getRow();
    }

    /*
    |--------------------------------------------------------------------------
    | Fetch All Data
    |--------------------------------------------------------------------------
    */
    public function fetchAllData($table_name, $where_condition = [])
    {
        return $this->db->table($table_name)
                        ->where($where_condition)
                        ->orderBy('cid', 'DESC')
                        ->get()
                        ->getResult();
    }

    /*
    |--------------------------------------------------------------------------
    | Insert Data
    |--------------------------------------------------------------------------
    */
    public function insertAllData($table_name, $data)
    {
        return $this->db->table($table_name)
                        ->insert($data);
    }

    public function updateData($data, $table_name, $where_condition)
    {
        return $this->db->table($table_name)
                        ->where($where_condition)
                        ->set($data)
                        ->update();
    }
    public function fetchfullData($table_name, $where_condition = [])
    {
        return $this->db->table($table_name)
                ->where($where_condition)
                ->get()
                ->getResult();
    }
    public function fetchListData($table_name, $where_condition = [])
    {
        return $this->db->table($table_name)
                        ->where($where_condition)
                        ->get()
                        ->getResultArray();
    }
    public function getSingleData($table_name, $where_condition = [])
    {
        return $this->db->table($table_name)
                        ->where($where_condition)
                        ->get()
                        ->getRow();
    }
    public function insertgetData($table_name, $data)
    {
        $this->db->table($table_name)->insert($data);
            return $this->db->insertID();
    }
    public function fetchSubCategoryData($CategoryId)
    {
       return $this->db->table('admin_subcategory as subcat')
            ->select('subcat.*, COUNT(vat.sid) as video_count')
            ->join('heal_videolist as vat', 'vat.sid = subcat.sid', 'left')
            ->where('subcat.web_status', 'Active')
            ->where('subcat.cid', $CategoryId)
            ->groupBy('subcat.sid')
            ->get()
            ->getResult();
    }
     public function fetchUserData($user_id, $CategoryId)
    {
         // Total videos in the category
        $totalVideos = $this->db->table('heal_videolist')
            ->where('cid', $CategoryId)
            ->countAllResults();

        // Total unique videos watched
        $watchedData = $this->db->table('user_access_session')
            ->select('COUNT(DISTINCT vid) as watched')
            ->where([
                'user_id'    => $user_id,
                'CategoryId' => $CategoryId
            ])
            ->get()
            ->getRow();

        $watchedCount = ($watchedData) ? $watchedData->watched : 0;

        // Watch percentage
        $percentage = 0;
        if ($totalVideos > 0) {
            $percentage = round(($watchedCount / $totalVideos) * 100, 2);
        }

        // Get all unique watch dates
        $watchDates = $this->db->table('user_access_session')
            ->select('book_date')
            ->where([
                'user_id'    => $user_id,
                'CategoryId' => $CategoryId
            ])
            ->groupBy('book_date')
            ->orderBy('book_date', 'DESC')
            ->get()
            ->getResultArray();

        $dateArray = array_column($watchDates, 'book_date');

        $continueDay = 0;

        if (!empty($dateArray)) {

            // If today is watched, start from today; otherwise start from yesterday.
            if (in_array(date('Y-m-d'), $dateArray)) {
                $checkDate = date('Y-m-d');
            } else {
                $checkDate = date('Y-m-d', strtotime('-1 day'));
            }

            while (in_array($checkDate, $dateArray)) {
                $continueDay++;
                $checkDate = date('Y-m-d', strtotime($checkDate . ' -1 day'));
            }
        }

        return [
            'total_videos' => $totalVideos,
            'watched'      => $watchedCount,
            'percentage'   => $percentage,
            'continue_day' => $continueDay
        ];
    }
    
}