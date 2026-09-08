<?php

namespace App\Models;

use CodeIgniter\Model;

class AppModel extends Model
{
    function fetchData($table_name,$where_condition)
    {
        return $this->db->table($table_name)->select('*')->where($where_condition)->get()->getrow();
    }
    function fetchAllData($table_name,$where_condition)
    {
        return $this->db->table($table_name)
                ->where($where_condition)
                ->orderBy('cid', 'DESC')
                ->get()
                ->getResult();
                
    }
    function fetchCountData($all_table, $all_condition)
    {
       return $this->db->table($all_table)
            ->where($all_condition)
            ->countAllResults();
    }
    function fetchAllListData($table_name,$where_condition)
    {
        return $this->db->table($table_name)
                ->where($where_condition)
                ->orderBy('doctor_id', 'DESC')
                ->get()
                ->getResult();
    }
    function insertData($data)
    {
        return $this->db->table('admin_category') // your table name
                    ->insert($data);
    }
    function UpdateData($data,$table_name,$where_condition)
    {
        return $this->db->table($table_name)->where($where_condition)->set($data)->update();
    }
    function fetchSubcategoryData()
    {
        return $this->db->table('admin_subcategory as sub')
            ->select('sub.*, cat.cat_name')
            ->join('admin_category as cat', 'cat.cid = sub.cid', 'left') // or inner
            ->where('sub.web_status', 'Active')
            ->orderBy('sub.sid', 'DESC')
            ->get()
            ->getResult();
    }
    function insertAllData($table,$data)
    {
        return $this->db->table($table) // your table name
                    ->insert($data);
    }
    function fetchEditSubcategoryData($sid)
    {
        return $this->db->table('admin_subcategory as sub')
            ->select('sub.*, cat.cat_name')
            ->join('admin_category as cat', 'cat.cid = sub.cid', 'left') // or inner
            ->where('sub.web_status', 'Active')
            ->where('sub.sid', $sid)
            ->get()
            ->getrow();
    }
    function fetchListData($table_name, $where_condition)
    {
        return $this->db->table($table_name)
                ->where($where_condition)
                ->get()
                ->getResult();
                
    }
    function fetchUsersessionList()
    {
         return $this->db->table('admin_usersession as user')
            ->select('user.*,sub.sid,sub.web_title as subcat_name, cat.cat_name,cat.cid')
            ->join('admin_category as cat', 'cat.cid = user.cid', 'left') // or inner
            ->join('admin_subcategory as sub', 'sub.sid = user.sid', 'left')
            ->where('user.is_delete', 'Active')
            ->orderBy('user.usid', 'DESC')
            ->get()
            ->getResult();
    }
    function fetchUserData($usid)
    {
         return $this->db->table('admin_usersession as user')
            ->select('user.*,sub.sid,sub.web_title as subcat_name, cat.cat_name,cat.cid')
            ->join('admin_category as cat', 'cat.cid = user.cid', 'left') // or inner
            ->join('admin_subcategory as sub', 'sub.sid = user.sid', 'left')
            ->where('user.is_delete', 'Active')
            ->where('user.usid', $usid)
            ->get()
            ->getrow();
    }
     function fetchListDataDoctor()
    {
         return $this->db->table('doctor_booking as user')
            ->select('user.*,cat.doctor_name as doctor_name')
            ->join('heal_doctorlist as cat', 'cat.doctor_id = user.doctor_id', 'left') // or inner
            ->where('user.booking_status', 'Active')
            ->orderBy('user.booking_id', 'DESC')
            ->get()
            ->getResult();
    }
    function insertDataUpdate($update_condition)
    {
        return $this->db->table('admin_update') // your table name
                    ->insert($update_condition);
    }
    function gameAllData()
    {
        return $this->db->table('admin_category as cat')
            ->select('cat.*, COUNT(au.cid) as categoryId')
            ->join('admin_update as au', 'au.cid = cat.cid', 'left')
            ->where('cat.cat_status', 'Active')
            ->groupBy('cat.cid')
            ->orderBy('cat.cid', 'ASC')
            ->get()
            ->getResult();
    }
}