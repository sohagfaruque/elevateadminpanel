<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class admindbmodel extends CI_Model {
    /*
     * Select with Condition 1 
     * parameter query start
     */

    

    /*
     * Select all data
     * parameter query start
     */

   

    /* update data with Condition start */

    function update_data_con($update_data, $colVal, $colName, $tbl_name) {
        $this->db->where($colName, $colVal);
        $result = $this->db->update($tbl_name, $update_data);
        return $result;
    }

    /* update data with no Condition start */

    function update_data($update_data, $tbl_name) {
        $result = $this->db->update($tbl_name, $update_data);
        return $result;
    }

    /*
     * Select with Condition 1 
     * parameter query start
     */

    function fetch_data_con_row($colVal, $colName, $tblName) {
        $this->db->where($colName, $colVal);
        $query = $this->db->get($tblName);
        $result = $query->num_rows();
        return $result;
    }

    /* Select with Condition 2 where status is active
     * parameter query start
     */

    function fetch_data_two_con($firstColVal, $secondColVal, $firstColName, $secondColName, $tblName) {
        $this->db->where($firstColName, $firstColVal);
        $this->db->where($secondColName, $secondColVal);
        $query = $this->db->get($tblName);
        $result = $query->result();
        return $result;
    }

    /* Select with Condition 2 where status is active
     * parameter query start
     */

    function fetch_data_three_con($firstColVal, $secondColVal, $thirdColVal, $firstColName, $secondColName, $thirdColName, $tblName) {
        $this->db->where($firstColName, $firstColVal);
        $this->db->where($secondColName, $secondColVal);
        $this->db->where($thirdColName,$thirdColVal);
        $query = $this->db->get($tblName);
        $result = $query->result();
        return $result;
    }

  

   

    /* delete data with condition start */

    function deleteDataTwoCon($firstColVal, $secondColVal, $firstColName, $secondColName, $tbl_name) {
        $this->db->where($firstColName, $firstColVal);
        $this->db->where($secondColName, $secondColVal);
        $result = $this->db->delete($tbl_name);
        return $result;
    }

    

    //get all admin from users table 
    function getAdminInformation($param) {
        if ($param['limit'] != '') {
            $this->db->limit($param['limit'], $param['offset']);
        }
        if ($param['search'] != '') {
            $this->db->like('name', $param['search']);
        }
        $this->db->order_by('id', 'DESC');
        $this->db->where('user_type', 4);
        $query = $this->db->get('users');
        $result_data = $query->result_array();

        if ($param['search'] != '') {
            $this->db->or_like('name', $param['search']);
        }
        $this->db->order_by('id', 'DESC');
        $this->db->where('user_type', 4);
        $this->db->from('users');
        $query_count = $this->db->get();
        $total_rows = $query_count->num_rows();
        $result = array('total_rows' => $total_rows, 'result_data' => $result_data);
        return $result;
    }

    //get all admin from  users table 
    function getAdminInformation_join_old($param) {
        if ($param['limit'] != '') {
            $this->db->limit($param['limit'], $param['offset']);
        }
        if ($param['search'] != '') {
            $this->db->like('b.name', $param['search']);
        }
        $this->db->order_by('a.id', 'DESC');
        $this->db->select('a.*,b.name,b.email,b.phone');
        $this->db->from('blood_request a');
        $this->db->join('users b', 'b.id = a.user_id');
        $query = $this->db->get();
        $result_data = $query->result_array();

        if ($param['search'] != '') {
            $this->db->or_like('b.name', $param['search']);
        }
         $this->db->order_by('a.id', 'DESC');
        $this->db->select('a.*,b.name,b.email,b.phone');
        $this->db->from('blood_request a');
        $this->db->join('users b', 'b.id = a.user_id');
        $query_count = $this->db->get();
        $total_rows = $query_count->num_rows();
        $result = array('total_rows' => $total_rows, 'result_data' => $result_data);
        return $result;
    }

    public function viewRequestResponse($id,$type) {
        $this->db->select('b.*,a.update_date action_date');
        $this->db->join('users b', 'b.id = a.user_id', 'left');
        $this->db->where('a.request_id', $id);
        $this->db->where('a.response_type', $type);
        $this->db->from('users_response a');
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }
   
//    new code goes here-------------------------------------------------------------------------------------
   

    function fetch_all_array($tblName) {
        $query = $this->db->get($tblName);
        $result = $query->result_array();
        return $result;
    }
    //fetch all data as object
    function fetch_all_obj($tblName) {
        $query = $this->db->get($tblName);
        $result = $query->result();
        return $result;
    }
    /* delete data with condition start */

    function deleteDataOneCon($firstColVal, $firstColName, $tbl_name) {
        $this->db->where($firstColName, $firstColVal);
        $result = $this->db->delete($tbl_name);
        return $result;
    }
     //check when update by title
    function recheckAvailabiltyWithTitleId($firstColVal, $secondColVal, $firstColName, $secondColName, $tbl_name) {
        $this->db->select('id');
        $this->db->where($firstColName, $firstColVal);
        $this->db->where($secondColName, $secondColVal);
        $this->db->from($tbl_name);
        $query = $this->db->get();
        $result = $query->num_rows();
        return $result;
    }
     //get admin data from user table
    function getAdminData() {
        $sql = "SELECT * FROM users where user_type=3 OR user_type=4";
        $query = $this->db->query($sql);
        $result = $query->result_array();
        return $result;
    }
     //get all venues with city
    function getVenueData() {
        $sql = "SELECT a.*,b.city_title FROM venue a LEFT JOIN cities b ON a.city_id = b.id";
        $query = $this->db->query($sql);
        $result = $query->result_array();
        return $result;
    }
     //get all events along with venue city
    function getEventData() {
        $sql = "SELECT a.*,b.venue_title,c.city_title FROM events a "
                . "LEFT JOIN venue b ON a.event_venue = b.id LEFT JOIN cities c ON b.city_id=c.id";
        $query = $this->db->query($sql);
        $result = $query->result_array();
        return $result;
    }
     //get all vip table by venue id
    function getVenueSpecificData($id,$table) {
        $sql = "SELECT a.*,b.venue_title FROM $table a "
                . "LEFT JOIN venue b ON a.venue_id = b.id WHERE a.venue_id = $id";
        $query = $this->db->query($sql);
        $result = $query->result_array();
        return $result;
    }
     //get all vip table by venue id
    function getEventSpecificData($id,$table) {
        $sql = "SELECT a.*,b.event_title FROM $table a "
                . "LEFT JOIN events b ON a.event_id = b.id WHERE a.event_id = $id";
        $query = $this->db->query($sql);
        $result = $query->result_array();
        return $result;
    }
    
    function reCheckAvailability($data,$col_name ,$id,$table) {
        $sql = "SELECT * FROM $table WHERE $col_name=$data AND id!=$id";
        $query = $this->db->query($sql);
        $result = $query->num_rows();
        return $result;
    }
    //get data single condtion
    function fetch_data_con_result($colVal, $colName, $tblName) {
        $this->db->where($colName, $colVal);
        $query = $this->db->get($tblName);
        $result = $query->result();
        return $result;
    }
      /*
     * insert query start
     */

    function set_data($insert_data, $tbl_name) {
        $result = $this->db->insert($tbl_name, $insert_data);
        return $result;
    }
    

}
