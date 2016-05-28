<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Venues extends CI_Controller {

    var $tbl_name1;
    var $tbl_name2;

    function __construct() {
        parent::__construct();
        $this->load->library("lib");
        $this->lib->auth_check(); //authentication check
        $this->load->model("admindbmodel");
        $this->tbl_name1 = "venue";
        $id = $this->session->userdata('loged_user_id');
        $this->load->helper('text');
    }

    public function index() {
        $result = $this->admindbmodel->getVenueData();
        $json = array();
        $json['data'] = array();
        foreach ($result as $key => $val) {
            $vipTableAddUrl = "<a href='" . base_url('venues/viptableadd') . "/" . $val['id'] . "' class='label label-warning'>add</a> ";
            $getVipTableData = count($this->admindbmodel->fetch_data_con_result($val['id'], 'venue_id', 'venue_tables'));
            $vipTable = $vipTableAddUrl . "<a href='" . base_url('venues/viptable') . "/" . $val['id'] . "' class='label label-success'>" . $getVipTableData . "</a> ";
            $imageAddUrl = "<a href='" . base_url('venues/imagesadd') . "/" . $val['id'] . "' class='label label-warning'>add</a> ";
            $imageData = count($this->admindbmodel->fetch_data_con_result($val['id'], 'venue_id', 'venue_images'));
            $vipImage = $imageAddUrl . "<a href='" . base_url('venues/images') . "/" . $val['id'] . "' class='label label-success'>" . $imageData . "</a> ";
            $getEventData = count($this->admindbmodel->fetch_data_con_result($val['id'], 'event_venue', 'events'));
            $eventView = "<a href='#' title='View' class='view label label-success' data-toggle='modal' data-target='#myModal' data-value='" . $val['id'] . "'><i class='icon-search icon-white'></i>" . $getEventData . "</a> ";
            $delete_btn = "<a href='" . base_url('venues/delete_data/venue') . '/' . $val['id'] . "' title='Delete' class='delete btn  btn-danger btn-sm'><i class='icon-trash icon-white'></i>Delete</a>";
            $edit_btn = "<a href='" . base_url('venues/edit/' . $val['id']) . "' title='Edit' class='btn btn-sm btn-info' ><i class='icon-edit icon-white'></i>Edit</a> ";
            $insert_date = date('j\<\s\u\p\>S\<\/\s\u\p\> M Y h:i a', strtotime($val['insert_date']));
            $json['data'][$key]['venue_title'] = $val['venue_title'];
            $json['data'][$key]['venue_location'] = $val['venue_location'];
            $json['data'][$key]['venue_age_limit'] = $val['venue_age_limit'];
            $json['data'][$key]['venue_dress_code'] = $val['venue_dress_code'];
            $json['data'][$key]['venue_music'] = $val['venue_music'];
            $json['data'][$key]['venue_vip_table'] = $vipTable;
            $json['data'][$key]['images'] = $vipImage;
            $json['data'][$key]['events'] = $eventView;
            $json['data'][$key]['cities'] = $val['city_title'];
            $json['data'][$key]['insert_date'] = $insert_date;
            $json['data'][$key]['action'] = $edit_btn . $delete_btn;
        }
        $data['datainfo'] = json_encode($json);
        $data['cityInfo'] = $this->admindbmodel->fetch_all_obj('cities');
        $data['title'] = "Venue list";
        $data['main_content'] = 'venues/list';
        $this->load->view('template', $data);
    }

    //venues vip table
    public function viptable($id) {
        $result = $this->admindbmodel->getVenueSpecificData($id, 'venue_tables');
        $json = array();
        $json['data'] = array();
        foreach ($result as $key => $val) {
            $delete_btn = "<a href='" . base_url('venues/delete_data/venue_tables') . '/' . $val['id'] . "' title='Delete' class='delete btn  btn-danger btn-sm'><i class='icon-trash icon-white'></i>Delete</a>";
            $edit_btn = "<a href='" . base_url('venues/tableedit/') . '/' . $id . '/' . $val['id'] . "' title='Edit' class='btn btn-sm btn-info' ><i class='icon-edit icon-white'></i>Edit</a> ";
            $insert_date = date('j\<\s\u\p\>S\<\/\s\u\p\> M Y h:i a', strtotime($val['insert_date']));
            $json['data'][$key]['venue_table_title'] = $val['venue_table_title'];
            $json['data'][$key]['venue_table_price'] = $val['venue_table_price'];
            $json['data'][$key]['venue_table_bottle_amount'] = $val['venue_table_bottle_amount'];
            $json['data'][$key]['venue_table_components_amount'] = $val['venue_table_components_amount'];
            $json['data'][$key]['venue_table_description'] = $val['venue_table_description'];
            $json['data'][$key]['insert_date'] = $insert_date;
            $json['data'][$key]['action'] = $edit_btn . $delete_btn;
        }
        $data['datainfo'] = json_encode($json);
        $data['title'] = "Table list";
        $data['venueValue'] = $this->admindbmodel->fetch_data_con_result($id, 'id', 'venue');
        $data['main_content'] = 'venues/table_list';
        $this->load->view('template', $data);
    }

    //venues images table
    public function images($id) {
        $result = $this->admindbmodel->getVenueSpecificData($id, 'venue_images');
        $json = array();
        $json['data'] = array();
        foreach ($result as $key => $val) {
            $delete_btn = "<a href='" . base_url('venues/delete_data/venue_images') . '/' . $val['id'] . "' title='Delete' class='delete btn  btn-danger btn-sm'><i class='icon-trash icon-white'></i>Delete</a>";
            $edit_btn = "<a href='" . base_url('venues/tableedit/') . '/' . $id . '/' . $val['id'] . "' title='Edit' class='btn btn-sm btn-info' ><i class='icon-edit icon-white'></i>Edit</a> ";
            $insert_date = date('j\<\s\u\p\>S\<\/\s\u\p\> M Y h:i a', strtotime($val['insert_date']));
            $json['data'][$key]['venue_images'] = $val['venue_images'];
            $json['data'][$key]['insert_date'] = $insert_date;
            $json['data'][$key]['action'] = $delete_btn;
        }
        $data['datainfo'] = json_encode($json);
        $data['title'] = "Image list";
        $data['venueValue'] = $this->admindbmodel->fetch_data_con_result($id, 'id', 'venue');
        $data['main_content'] = 'venues/image_list';
        $this->load->view('template', $data);
    }

    /* Delete Data */

    public function delete_data($table, $id) {
        if ($checkAnsIs = $this->admindbmodel->deleteDataOneCon($id, 'id', $table) == true) {
            $result = 1; //Delete Success
        } else {

            $result = 2; //system Error.Please Contact with Developer
        }

        echo $result;
        exit;
    }

    //    view modal
    public function view() {
        $dataValue = $this->admindbmodel->fetch_data_con_result($_POST['postID'], 'city_id', 'venue');
        $textTitle = 'Cancled';
        if ($dataValue) {
            $html = ' <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">All Venues</h4>
      </div>
      <div class="modal-body">
        <form>';
            foreach ($dataValue as $row) {
                $date = date('j\<\s\u\p\>S\<\/\s\u\p\> M Y h:i A', strtotime($row->insert_date)); //date('Y-m-d h:i a', strtotime($row->action_date));
                $html .=' <div class="modal-field text-align-none">
    <dl class="dl-horizontal">';
                $html .='<dt>Title</dt>';
                $html .="<dd> $row->venue_title </dd>";
                $html .="<dt>Location</dt>
        <dd>$row->venue_location</dd>
        <dt>Age Limit</dt>
        <dd>$row->venue_age_limit</dd>
        <dt>Added Date</dt>
        <dd>$date</dd>
        
    </dl>
          </div>";
            }

            $html.='</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>';
        } else {
            $html = ' <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">All venues</h4>
      </div>
      <div class="modal-body">
        <form>
          <div class="modal-field text-align-none">
          No record found!
       
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>';
        }

        echo $html;
    }

//add new information
    public function viptableadd($id) {
        $data['title'] = 'Add New';
        $data['main_content'] = 'venues/table_add';
        $data['venueValue'] = $this->admindbmodel->fetch_data_con_result($id, 'id', 'venue');
        $this->form_validation->set_rules('venue_table_title', 'Title', 'strip_tags|trim|required');
        $this->form_validation->set_rules('venue_table_price', 'Price', 'strip_tags|trim|required');
        $this->form_validation->set_rules('venue_table_bottle_amount', 'Amount', 'strip_tags|trim|required');
        $this->form_validation->set_rules('venue_table_components_amount', 'Amount', 'strip_tags|trim|required');
        $this->form_validation->set_rules('venue_table_description', 'Description', 'strip_tags|trim|required');
        if ($this->form_validation->run() != FALSE) {
            $insert_data['insert_date'] = date('Y-m-d H:i:s');
            $insert_data['venue_id'] = $id;
            $insert_data['venue_table_title'] = $this->input->post('venue_table_title');
            $insert_data['venue_table_price'] = $this->input->post('venue_table_price');
            $insert_data['venue_table_bottle_amount'] = $this->input->post('venue_table_bottle_amount');
            $insert_data['venue_table_components_amount'] = $this->input->post('venue_table_components_amount');
            $insert_data['venue_table_description'] = $this->input->post('venue_table_description');
            if ($this->admindbmodel->set_data($insert_data, 'venue_tables') == TRUE) {
                $updateData['venue_vip_table'] = 1;
                $this->admindbmodel->update_data_con($updateData, $id, 'id', $this->tbl_name1);
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

//add new images
    public function imagesadd($id) {
        $data['title'] = 'Add New';
        $data['main_content'] = 'venues/image_add';
        $data['venueValue'] = $this->admindbmodel->fetch_data_con_result($id, 'id', 'venue');
        $this->form_validation->set_rules('venue_id', 'Title', 'strip_tags|trim|required');
        if ($this->form_validation->run() != FALSE) {
            foreach ($_FILES['imagefile']['name'] as $imageKey => $name) {
                if ($name) {
                    $fileDataImage = pathinfo(basename($_FILES["imagefile"]["name"][$imageKey]));
                    $file_image = uniqid() . '.' . $fileDataImage['extension']; //icon rename
                    $imageExtension = pathinfo($file_image, PATHINFO_EXTENSION);
                    $file_image_thumb = basename($file_image, '.' . $imageExtension) . "_thumb." . $imageExtension;
                    $this->lib->upload_file($_FILES["imagefile"]["tmp_name"][$imageKey], 'assets/venues/' . $file_image);
                    $resize_data1 = array(
                        'source_image' => 'assets/venues/' . $file_image,
                        'new_image' => 'assets/venues/medium/',
                        'create_thumb' => true,
                        'maintain_ratio' => FALSE,
                        'width' => 500,
                        'height' => 800
                    );
                    $resize_data2 = array(
                        'source_image' => 'assets/venues/' . $file_image,
                        'new_image' => 'assets/venues/small/',
                        'create_thumb' => true,
                        'maintain_ratio' => FALSE,
                        'width' => 200,
                        'height' => 200
                    );

                    $this->lib->image_resize($resize_data1);
                    $this->lib->image_resize($resize_data2);
                    unlink('assets/venues/' . $file_image);
                }
                $insert_data['venue_images'] = $file_image_thumb;
                $insert_data['venue_id'] = $id;
                $insert_data['insert_date'] = date('Y-m-d H:i:s');
                if ($this->admindbmodel->set_data($insert_data, 'venue_images') == TRUE) {
                    $data['successMsg'] = 'Successfully Added';
                    $this->load->view('template', $data);
                } else {
                    $data['errorMsg'] = 'System Error.Please Contact With Developer.';
                    $this->load->view('template', $data);
                }
            }
        } else {
            $this->load->view('template', $data);
        }
    }

//add new information
    public function add() {
        $data['title'] = 'Add New';
        $data['main_content'] = 'venues/add';
        $data['cityValue'] = $this->admindbmodel->fetch_all_obj('cities');
        $this->form_validation->set_rules('city_id', 'City', 'strip_tags|trim|required');
        $this->form_validation->set_rules('venue_title', 'Title', 'strip_tags|trim|required');
        $this->form_validation->set_rules('venue_location', 'Location', 'strip_tags|trim|required');
        $this->form_validation->set_rules('venue_description', 'Description', 'strip_tags|trim|required');
        $this->form_validation->set_rules('venue_age_limit', 'Age limit', 'strip_tags|trim|required|integer');
        $this->form_validation->set_rules('venue_dress_code', 'Dress code', 'strip_tags|trim|required');
        $this->form_validation->set_rules('venue_music', 'Music', 'strip_tags|trim|required');
        $this->form_validation->set_rules('venue_vip_table', 'Vip table', 'strip_tags|trim|required');
        if ($this->form_validation->run() != FALSE) {
            $insert_data['insert_date'] = date('Y-m-d H:i:s');
            $insert_data['city_id'] = $this->input->post('city_id');
            $insert_data['venue_title'] = $this->input->post('venue_title');
            $insert_data['venue_location'] = $this->input->post('venue_location');
            $insert_data['venue_description'] = $this->input->post('venue_description');
            $insert_data['venue_age_limit'] = $this->input->post('venue_age_limit');
            $insert_data['venue_dress_code'] = $this->input->post('venue_dress_code');
            $insert_data['venue_music'] = $this->input->post('venue_music');
            $insert_data['venue_vip_table'] = $this->input->post('venue_vip_table');
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

//table edite
    public function tableedit($venue_id, $id) {
        $data['dataValue'] = $this->admindbmodel->fetch_data_con_result($id, 'id', 'venue_tables');
        $data['venueValue'] = $this->admindbmodel->fetch_data_con_result($venue_id, 'id', 'venue');
        $data['title'] = 'Edit Table';
        $data['main_content'] = 'venues/table_edit';
        $this->form_validation->set_rules('venue_table_title', 'Title', 'strip_tags|trim|required');
        $this->form_validation->set_rules('venue_table_price', 'Price', 'strip_tags|trim|required');
        $this->form_validation->set_rules('venue_table_bottle_amount', 'Amount', 'strip_tags|trim|required');
        $this->form_validation->set_rules('venue_table_components_amount', 'Amount', 'strip_tags|trim|required');
        $this->form_validation->set_rules('venue_table_description', 'Descripton', 'strip_tags|trim|required');
        if ($this->form_validation->run() != FALSE) {
            $updateData['venue_table_title'] = $this->input->post('venue_table_title');
            $updateData['venue_table_price'] = $this->input->post('venue_table_price');
            $updateData['venue_table_bottle_amount'] = $this->input->post('venue_table_bottle_amount');
            $updateData['venue_table_components_amount'] = $this->input->post('venue_table_components_amount');
            $updateData['venue_table_description'] = $this->input->post('venue_table_description');
            if ($this->admindbmodel->update_data_con($updateData, $id, 'id', 'venue_tables') == TRUE) {
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

//venue edite
    public function edit($id) {
        $data['dataValue'] = $this->admindbmodel->fetch_data_con_result($id, 'id', 'venue');
        $data['cityValue'] = $this->admindbmodel->fetch_all_obj('cities');
        $data['title'] = 'Edit Venue';
        $data['main_content'] = 'venues/edit';
        $this->form_validation->set_rules('city_id', 'City', 'strip_tags|trim|required');
        $this->form_validation->set_rules('venue_title', 'Title', 'strip_tags|trim|required');
        $this->form_validation->set_rules('venue_location', 'Location', 'strip_tags|trim|required');
        $this->form_validation->set_rules('venue_description', 'Description', 'strip_tags|trim|required');
        $this->form_validation->set_rules('venue_age_limit', 'Age limit', 'strip_tags|trim|required|integer');
        $this->form_validation->set_rules('venue_dress_code', 'Dress code', 'strip_tags|trim|required');
        $this->form_validation->set_rules('venue_music', 'Music', 'strip_tags|trim|required');
        $this->form_validation->set_rules('venue_vip_table', 'Vip table', 'strip_tags|trim|required');
        if ($this->form_validation->run() != FALSE) {
            $updateData['city_id'] = $this->input->post('city_id');
            $updateData['venue_title'] = $this->input->post('venue_title');
            $updateData['venue_location'] = $this->input->post('venue_location');
            $updateData['venue_description'] = $this->input->post('venue_description');
            $updateData['venue_age_limit'] = $this->input->post('venue_age_limit');
            $updateData['venue_dress_code'] = $this->input->post('venue_dress_code');
            $updateData['venue_music'] = $this->input->post('venue_music');
            $updateData['venue_vip_table'] = $this->input->post('venue_vip_table');
            if ($this->admindbmodel->update_data_con($updateData, $id, 'id',  $this->tbl_name1) == TRUE) {
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
        if ($this->admindbmodel->reCheckAvailability($name, $id, 'city_title', $this->tbl_name1) > 0) {
            $this->form_validation->set_message('recheck_availabity', 'This title is already taken!');
            return FALSE;
        } else {
            return true;
        }
    }

}
