<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin extends CI_Controller {

    var $tbl_name1;
    var $tbl_name2;

    function __construct() {
        parent::__construct();
        $this->load->library("lib");
        $this->lib->auth_check(); //authentication check
        $this->load->model("admindbmodel");
        $this->tbl_name1 = "users";
        $id = $this->session->userdata('loged_user_id');
        $this->load->helper('text');
    }

    function index_old() {
        $data['title'] = "Admin";
        $data['main_content'] = 'admin/list';
        $this->load->view('template', $data);
    }

    public function index() {
        $result = $this->admindbmodel->getAdminData();
        $json = array();
        $json['data'] = array();
        foreach ($result as $key => $val) {
            $status = "<span class='label label-danger'>Inactive</span> &nbsp; ";
            $type = "<span class='label label-danger'>Sub-admin</span> &nbsp; ";
            if ($val['status'] == 1) {
                $status = "<span class='label label-success'>Active</span> &nbsp; ";
            }
            if ($val['user_type'] == 3) {
                $type = "<span class='label label-success'>Super-admin</span> &nbsp; ";
            }
            $view_btn = "<a href='#' title='View' class='view btn btn-primary btn-sm' data-toggle='modal' data-target='#myModal' data-value='" . $val['id'] . "'><i class='icon-search icon-white'></i>View</a> ";
            $delete_btn = "<a href='" . base_url('admin/delete_data/' . $val['id']) . "' title='Delete' class='delete btn  btn-danger btn-sm'><i class='icon-trash icon-white'></i>Delete</a>";
            $edit_btn = "<a href='" . base_url('admin/edit/' . $val['id']) . "' title='Edit' class='btn btn-sm btn-info' ><i class='icon-edit icon-white'></i>Edit</a> ";
            $insert_date = date('j\<\s\u\p\>S\<\/\s\u\p\> M Y h:i a', strtotime($val['insert_date']));
            $json['data'][$key]['name'] = $val['user_name'];
            $json['data'][$key]['email'] = $val['email'];
            $json['data'][$key]['status'] = $status;
            $json['data'][$key]['type'] = $type;
            $json['data'][$key]['insert_date'] = $insert_date;
            $json['data'][$key]['action'] = $edit_btn . $delete_btn;
        }
        $data['datainfo'] = json_encode($json);
        $data['title'] = "Admin";
        $data['main_content'] = 'admin/list';
        $this->load->view('template', $data);
    }

    /* Delete Data */

    public function delete_data($id) {
        if ($checkAnsIs = $this->admindbmodel->deleteDataOneCon($id, 'id', $this->tbl_name1) == true) {
            $result = 1; //Delete Success
        } else {

            $result = 2; //system Error.Please Contact with Developer
        }

        echo $result;
        exit;
    }

//add new information
    public function add() {
        $data['title'] = 'Add New';
        $data['main_content'] = 'admin/add';
        $this->form_validation->set_rules('name', 'Name', 'strip_tags|trim|required');
        $this->form_validation->set_rules('email', 'Email', 'strip_tags|trim|required|valid_email|is_unique[admin_list.email]');
        $this->form_validation->set_rules('password', 'Password', 'strip_tags|trim|required');
        $this->form_validation->set_rules('type', 'Type', 'strip_tags|trim|required');
        if ($this->form_validation->run() != FALSE) {
            $insert_data['insert_date'] = date('Y-m-d H:i:s');
            $insert_data['user_name'] = $this->input->post('name');
            $insert_data['email'] = $this->input->post('email');
            $insert_data['password'] = md5($this->input->post('email'));
            $insert_data['user_type'] = $this->input->post('type');
            if ($this->admindbmodel->set_data($insert_data, $this->tbl_name1) == TRUE) {
                $data['successMsg'] = 'Successfully Added';
                $this->load->view('template', $data);
            } else {
                $data['errorMsg'] = 'System Error.Please Contact With Developer.';
                $this->load->view('template', $data);
            }
        } else {
            $this->load->view('template', $data);
        }
    }

    public function edit($id) {
        $data['dataValue'] = $this->admindbmodel->fetch_data_con_result($id, 'id', $this->tbl_name1);
        $data['title'] = 'Edit admin';
        $data['main_content'] = 'admin/edit';
        $this->form_validation->set_rules('email', 'Email', 'strip_tags|trim|required|valid_email|call_back_recheck_availabity');
        $this->form_validation->set_rules('name', 'Name', 'strip_tags|trim|required');
        $this->form_validation->set_rules('status', 'Status', 'strip_tags|trim|required');
        $this->form_validation->set_rules('type', 'Type', 'strip_tags|trim|required');
        if ($this->form_validation->run() != FALSE) {
            $updateData['user_name'] = $this->input->post('name');
            $updateData['email'] = $this->input->post('email');
            $updateData['user_type'] = $this->input->post('type');
            if (isset($_POST['password'])) {
                if ($_POST['password']!='') {
                    $updateData['password'] = md5($this->input->post('password'));
                }
            }
            $updateData['status'] = $this->input->post('status');

            if ($this->admindbmodel->update_data_con($updateData, $id, 'id', $this->tbl_name1) == TRUE) {
                $data['successMsg'] = 'Successfully Updated';
                $this->load->view('template', $data);
            } else {

                $data['errorMsg'] = 'System Error.Please Let Us Know.';
                $this->load->view('template', $data);
            }
        } else {
            $this->load->view('template', $data);
        }
    }

//check availabity by admin english name
    public function recheck_availabity($name) {
        $id = $this->uri->segment(3);
        if ($this->admindbmodel->recheckAvailabiltyWithTitleId($name, $id, 'email', 'id', $this->tbl_name1) > 0) {
            $this->form_validation->set_message('recheck_availabity', 'Email is already assigned to other user!');
            return FALSE;
        } else {
            return true;
        }
    }

    //    image validation
    public function imageValidation() {
        $allow_ext = array('jpg', 'gif', 'png', 'bmp', 'jpeg');
        if (trim($_FILES["imagefile"]["name"]) == "") {
            $this->form_validation->set_message('imageValidation', 'Can Not Be empty');
            return FALSE;
        } else if (!in_array(end(explode('.', trim($_FILES["imagefile"]["name"]))), $allow_ext)) {
            $this->form_validation->set_message('imageValidation', 'Image Must be jpg, gif, png, bmp or jpeg');
            return FALSE;
        } else {
            return TRUE;
        }
    }

}
