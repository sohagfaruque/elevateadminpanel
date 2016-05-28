<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Users extends CI_Controller {

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

    function index() {
        $data['title'] = "User List";
        $data['main_content'] = 'users/list';
        $this->load->view('template', $data);
    }

    public function getDataList() {
        $userType = $this->session->userdata('type');
        $data_table_param['offset'] = $_POST['length'] == -1 ? '' : $_POST['start'];
        $data_table_param['limit'] = $_POST['length'] == -1 ? '' : $_POST['length'];
        $data_table_param['search'] = $_POST['search']['value'];
        $sorting_array = array(0 => 'id', 1 => 'player_name');
        $data_table_param['sorting'] = $sorting_array[$_POST['order'][0]['column']];
        $data_table_param['sorting_dir'] = $_POST['order'][0]['dir'];
        $result = $this->admindbmodel->getUserDataInfo($data_table_param);
        $json = array();
        $json['draw'] = 0;
        $json['recordsTotal'] = $result['total_rows'];
        $json['recordsFiltered'] = $result['total_rows'];
        $json['data'] = array();
        $counter = $_POST['start'];
        foreach ($result['result_data'] as $key => $val) {
            $counter = $counter + 1;

            if ($val['status'] == 1) {
                $status_change_btn = "<span class='label label-success'>Active</span> &nbsp; "
                        . "<a href='" . base_url('users/update_status/' . $val['id']) . "/" . $val['status'] . "' class='update' title='Deactive This News' style='color:#dd1111;'>"
                        . "<i class='fa fa-times'></i>"
                        . "</a>";
            } else {
                $status_change_btn = "<span class='label label-danger'>Inactive</span> &nbsp; "
                        . "<a href='" . base_url('users/update_status/' . $val['id']) . "/" . $val['status'] . "' class='update' title='Active This News'><i class='fa fa-check'></i></a>";
            }
            if ($val['gender'] == 1) {
                $sex = "<span class='label label-success'>Male</span>";
            } else if ($val['gender'] == 2) {
                $sex = "<span class='label label-warning'>Female</span>";
            } else {
                $sex = "<span class='label label-danger'>Other</span>";
            }
            $edit_btn = "<a href='" . base_url('users/edit/' . $val['id']) . "' title='Edit' class='btn btn-info btn-sm' ><i class='icon-edit icon-white'></i>Edit</a> ";
            $view_btn = "<a href='#' title='View' class='view btn btn-primary btn-sm' data-toggle='modal' data-target='#myModal' data-value='" . $val['id'] . "'><i class='icon-search icon-white'></i>View</a> ";
            $delete_btn = "<a href='" . base_url('users/delete_data/' . $val['id']) . "' title='Delete' class='delete btn  btn-danger btn-sm'><i class='icon-trash icon-white'></i>Delete</a>";
            $Cdate = date('j\<\s\u\p\>S\<\/\s\u\p\> M Y h:i a', strtotime($val['insert_date']));
            $dob = date('j\<\s\u\p\>S\<\/\s\u\p\> M Y ', strtotime($val['dob']));
            $image = "<img src='" . base_url('assets/users') . "/" . $val['image'] . "' width='40' height='40'>";
            $json['data'][$key]['serial'] = $counter;
            $json['data'][$key]['name'] = $val['name'];
            $json['data'][$key]['email'] = $val['email'];
            $json['data'][$key]['image'] = $image;
            $json['data'][$key]['sex'] = $sex;
            $json['data'][$key]['bloodgrp'] = $val['bloodgroup'];
            $json['data'][$key]['dob'] = $dob;
            $json['data'][$key]['status'] = $status_change_btn;
            $json['data'][$key]['createdDate'] = $Cdate;
            $json['data'][$key]['action'] = $view_btn . $edit_btn . $delete_btn;
        }
        echo json_encode($json);
        die();
    }

//    view modal
    public function view() {
        $dataValue = $this->admindbmodel->fetch_data_con_result($_POST['postID'], 'id', 'users');
        $status = $dataValue[0]->status == 1 ? '<span class="label label-success">Active</span>' : '<span class="label label-danger">Inactive</span>';
        $insertDate = date('Y-m-d h:i a', strtotime($dataValue[0]->insert_date));
        $dob = date('Y-m-d', strtotime($dataValue[0]->dob));
        if ($dataValue[0]->gender == 1) {
            $sex = 'Male';
        } else if ($dataValue[0]->gender == 2) {
            $sex = 'Female';
        } else {
            $sex = 'Other';
        }
        $html = ' <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">' . $dataValue[0]->name . '</h4>
      </div>
      <div class="modal-body">
        <form>
          <div class="modal-field text-align-none">
             Name : ' . $dataValue[0]->name . '
          </div>
          <div class="modal-field text-align-none">
             Email : ' . $dataValue[0]->email . '
          </div>
          <div class="modal-field text-align-none">
             Longitude : ' . $dataValue[0]->longitude . '
          </div>
          <div class="modal-field text-align-none">
             Latitude : ' . $dataValue[0]->latitude . '
          </div>
          <div class="modal-field text-align-none">
             Sex : ' . $sex . '
          </div>
          <div class="modal-field text-align-none">
             Date of Birth : ' . $dob . '
          </div>
          <div class="modal-field text-align-none">
             Added Date : ' . $insertDate . '
          </div>
           <div class="modal-field text-align-none">
             Avatar : <img src="' . base_url('assets/users') . '/' . $dataValue[0]->image . '" width="40" height="40">
          </div>
           <div class="modal-field text-align-none">
             Status : ' . $status . '
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>';
        echo $html;
    }

    /* Delete Data */

    public function delete_data($id) {
        if ($checkAnsIs = $this->admindbmodel->deleteDataOneCon($id, 'id', 'users') == true) {
            $result = 1; //Delete Success
        } else {

            $result = 2; //system Error.Please Contact with Developer
        }

        echo $result;
        exit;
    }

    /* update status */

    public function update_status($id, $status) {
        if ($status == 0) {
            $data['status'] = 1;
        } else {
            $data['status'] = 0;
        }
        $fieldName = 'id';
        $result = $this->admindbmodel->update_data_con($data, $id, $fieldName, 'users');
        if ($result == true) {
            echo 1;
        } else {
            echo 0;
        }
        die();
    }

    public function add() {
        $data['title'] = 'Add New';
        $data['main_content'] = 'users/add';
        $this->form_validation->set_rules('name', 'Name', 'strip_tags|trim|required');
        $this->form_validation->set_rules('email', 'Email', 'strip_tags|trim|required|valid_email');
        $this->form_validation->set_rules('phone', 'Phone', 'strip_tags|trim|required');
        $this->form_validation->set_rules('password', 'Password', 'strip_tags|trim|required');
        $this->form_validation->set_rules('latitude', 'Latitude', 'strip_tags|trim|required');
        $this->form_validation->set_rules('longitude', 'Longitude', 'strip_tags|trim|required');
        $this->form_validation->set_rules('gender', 'Gender', 'strip_tags|trim|required');
        $this->form_validation->set_rules('bloodgroup', 'Bloodgroup', 'strip_tags|trim|required');
        $this->form_validation->set_rules('dob', 'Date of Birth', 'strip_tags|trim|required');
        $this->form_validation->set_rules('imagefile', 'image', 'trim|xss_clean|callback_imageValidation');
        if ($this->form_validation->run() != FALSE) {
            $fileDataImage = pathinfo(basename($_FILES["imagefile"]["name"]));
            $file_image = uniqid() . '.' . $fileDataImage['extension']; //icon rename
            $imageExtension = pathinfo($file_image, PATHINFO_EXTENSION);
            $file_image_thumb = basename($file_image, '.' . $imageExtension) . "_thumb." . $imageExtension;
            $insert_data['image'] = $file_image_thumb;
            $insert_data['insert_date'] = date('Y-m-d H:i:s');
            $insert_data['name'] = $this->input->post('name');
            $insert_data['email'] = $this->input->post('email');
            $insert_data['password'] = md5($this->input->post('email'));
            $insert_data['phone'] = $this->input->post('phone');
            $insert_data['longitude'] = $this->input->post('longitude');
            $insert_data['latitude'] = $this->input->post('latitude');
            $insert_data['gender'] = $this->input->post('gender');
            $insert_data['bloodgroup'] = $this->input->post('bloodgroup');
            $insert_data['dob'] = $this->input->post('dob');
            if ($this->admindbmodel->set_data($insert_data, 'users') == TRUE) {
                if ($_FILES['imagefile']['name'] != '') {//image upload
                    $this->lib->upload_file($_FILES["imagefile"]["tmp_name"], 'assets/users/' . $file_image);
                    $resize_data1 = array(
                        'source_image' => 'assets/users/' . $file_image,
                        'new_image' => 'assets/users/',
                        'create_thumb' => true,
                        'maintain_ratio' => FALSE,
                        'width' => 500,
                        'height' => 800
                    );

                    $this->lib->image_resize($resize_data1);
                }

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
        $data['title'] = 'Edit users';
        $data['main_content'] = 'users/edit';
        $this->form_validation->set_rules('previousImage', 'Promotion', 'strip_tags|trim|required');
        if (isset($_FILES['imagefile']['name'])) {
            if ($_FILES['imagefile']['name']) {
                $this->form_validation->set_rules('imagefile', 'Image', 'callback_imageValidation');
            }
        }
        if ($this->form_validation->run() != FALSE) {
            if ($_FILES['imagefile']['name'] != '') {
                $fileDataImage = pathinfo(basename($_FILES["imagefile"]["name"]));
                $file_image = uniqid() . '.' . $fileDataImage['extension']; //logo rename
                $imageExtension = pathinfo($file_image, PATHINFO_EXTENSION);
                $file_thumb_logo = basename($file_image, '.' . $imageExtension) . "_thumb." . $imageExtension;
                $updateData['image'] = $file_thumb_logo;
            }
            $updateData['name'] = $this->input->post('name');
            $updateData['email'] = $this->input->post('email');
            $updateData['bloodgroup'] = $this->input->post('bloodgroup');
            $updateData['gender'] = $this->input->post('gender');
            $updateData['longitude'] = $this->input->post('longitude');
            $updateData['latitude'] = $this->input->post('latitude');
            $updateData['phone'] = $this->input->post('phone');
            if (isset($_POST['password'])) {
                $updateData['password'] = md5($this->input->post('phone'));
            }
            $updateData['status'] = $this->input->post('status');

            if ($this->admindbmodel->update_data_con($updateData, $id, 'id', 'users') == TRUE) {
                if ($_FILES['imagefile']['name'] != '') {
                    $this->lib->upload_file($_FILES["imagefile"]["tmp_name"], 'assets/users/' . $file_image);
                    $resize_data1 = array(
                        'source_image' => 'assets/users/' . $file_image,
                        'new_image' => 'assets/users/',
                        'create_thumb' => true,
                        'maintain_ratio' => FALSE,
                        'width' => 500,
                        'height' => 800
                    );
                    $this->lib->image_resize($resize_data1);
                    unlink('assets/users/' . $_POST['previousImage']);
                }
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

//check availabity by category english name
    public function recheck_availabity_by_englishname($name) {
        $id = $this->uri->segment(3);
        if ($this->admindbmodel->recheckAvailabiltyWithTitleId($name, $id, 'englishName', 'operatorID', $this->tbl_name1) > 0) {
            $this->form_validation->set_message('recheck_availabity_by_englishname', 'This Title is already assigned by other!');
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
