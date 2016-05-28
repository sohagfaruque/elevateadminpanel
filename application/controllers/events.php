<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Events extends CI_Controller {

    var $tbl_name1;
    var $tbl_name2;
    var $user_id;

    function __construct() {
        parent::__construct();
        $this->load->library("lib");
        $this->lib->auth_check(); //authentication check
        $this->load->model("admindbmodel");
        $this->tbl_name1 = "events";
        $this->user_id = $this->session->userdata('loged_user_id');
        $this->load->helper('text');
    }

    public function index() {
        $result = $this->admindbmodel->getEventData();
        $json = array();
        $json['data'] = array();
        foreach ($result as $key => $val) {
            $bottleService="<span class='label label-danger'>No</span>";
            if($val['bottle_service']==1){
              $bottleService="<span class='label label-success'>Yes</span>";  
            }
            $rsvpAddUrl = "<a href='" . base_url('events/rsvpadd') . "/" . $val['id'] . "' class='label label-warning'>add</a> ";
            $getRsvpData = count($this->admindbmodel->fetch_data_con_result($val['id'], 'event_id', 'events_rsvp'));
            $rsvpInfo = $rsvpAddUrl . "<a href='" . base_url('events/rsvp') . "/" . $val['id'] . "' class='label label-success'>" . $getRsvpData . "</a> ";
            $imageAddUrl = "<a href='" . base_url('events/imagesadd') . "/" . $val['id'] . "' class='label label-warning'>add</a> ";
            $imageData = count($this->admindbmodel->fetch_data_con_result($val['id'], 'event_id', 'event_images'));
            $eventImage = $imageAddUrl . "<a href='" . base_url('events/images') . "/" . $val['id'] . "' class='label label-success'>" . $imageData . "</a> ";
            $delete_btn = "<a href='" . base_url('events/delete_data/venue') . '/' . $val['id'] . "' title='Delete' class='delete btn  btn-danger btn-sm'><i class='icon-trash icon-white'></i>Delete</a>";
            $edit_btn = "<a href='" . base_url('events/edit/' . $val['id']) . "' title='Edit' class='btn btn-sm btn-info' ><i class='icon-edit icon-white'></i>Edit</a> ";
            $insert_date = date('j\<\s\u\p\>S\<\/\s\u\p\> M Y h:i a', strtotime($val['insert_date']));
            $json['data'][$key]['event_title'] = $val['event_title'];
            $json['data'][$key]['event_address'] = $val['event_address'];
            $json['data'][$key]['city_title'] = $val['city_title'];
            $json['data'][$key]['venue_title'] = $val['venue_title'];
            $json['data'][$key]['bottle_service'] = $bottleService;
            $json['data'][$key]['rsvp'] = $rsvpInfo;
            $json['data'][$key]['images'] = $eventImage;
            $json['data'][$key]['event_end_date'] = $val['event_end_date'];
            $json['data'][$key]['action'] = $edit_btn . $delete_btn;
        }
        $data['datainfo'] = json_encode($json);
        $data['cityInfo'] = $this->admindbmodel->fetch_all_obj('cities');
        $data['venueInfo'] = $this->admindbmodel->fetch_all_obj('venue');
        $data['title'] = "Event list";
        $data['main_content'] = 'events/list';
        $this->load->view('template', $data);
    }

    //events vip table
    public function rsvp($id) {
        $result = $this->admindbmodel->getEventSpecificData($id, 'events_rsvp');
        $json = array();
        $json['data'] = array();
        foreach ($result as $key => $val) {
            $delete_btn = "<a href='" . base_url('events/delete_data/events_rsvp') . '/' . $val['id'] . "' title='Delete' class='delete btn  btn-danger btn-sm'><i class='icon-trash icon-white'></i>Delete</a>";
            $edit_btn = "<a href='" . base_url('events/rsvpedit/') . '/' . $id . '/' . $val['id'] . "' title='Edit' class='btn btn-sm btn-info' ><i class='icon-edit icon-white'></i>Edit</a> ";
            $insert_date = date('j\<\s\u\p\>S\<\/\s\u\p\> M Y h:i a', strtotime($val['insert_date']));
            $json['data'][$key]['rsvp_description'] = $val['rsvp_description'];
            $json['data'][$key]['insert_date'] = $insert_date;
            $json['data'][$key]['action'] = $edit_btn . $delete_btn;
        }
        $data['datainfo'] = json_encode($json);
        $data['title'] = "Rsvp list";
        $data['eventValue'] = $this->admindbmodel->fetch_data_con_result($id, 'id', 'events');
        $data['main_content'] = 'events/rsvp';
        $this->load->view('template', $data);
    }

    //events images table
    public function images($id) {
        $result = $this->admindbmodel->getEventSpecificData($id, 'event_images');
        $json = array();
        $json['data'] = array();
        foreach ($result as $key => $val) {
            $delete_btn = "<a href='" . base_url('events/delete_data/venue_images') . '/' . $val['id'] . "' title='Delete' class='delete btn  btn-danger btn-sm'><i class='icon-trash icon-white'></i>Delete</a>";
            $edit_btn = "<a href='" . base_url('events/tableedit/') . '/' . $id . '/' . $val['id'] . "' title='Edit' class='btn btn-sm btn-info' ><i class='icon-edit icon-white'></i>Edit</a> ";
            $insert_date = date('j\<\s\u\p\>S\<\/\s\u\p\> M Y h:i a', strtotime($val['insert_date']));
            $json['data'][$key]['event_images'] = $val['event_image'];
            $json['data'][$key]['insert_date'] = $insert_date;
            $json['data'][$key]['action'] = $delete_btn;
        }
        $data['datainfo'] = json_encode($json);
        $data['title'] = "Image list";
        $data['eventValue'] = $this->admindbmodel->fetch_data_con_result($id, 'id', 'events');
        $data['main_content'] = 'events/image_list';
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
        <h4 class="modal-title" id="exampleModalLabel">All events</h4>
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
    public function rsvpadd($id) {
        $data['title'] = 'Add New';
        $data['main_content'] = 'events/rsvp_add';
        $data['eventValue'] = $this->admindbmodel->fetch_data_con_result($id, 'id', 'events');
        $this->form_validation->set_rules('rsvp_description', 'Description', 'strip_tags|trim|required');
        if ($this->form_validation->run() != FALSE) {
            $insert_data['insert_date'] = date('Y-m-d H:i:s');
            $insert_data['event_id'] = $id;
            $insert_data['rsvp_description'] = $this->input->post('rsvp_description');
            if ($this->admindbmodel->set_data($insert_data, 'events_rsvp') == TRUE) {
                $updateData['rsvp'] = 1;
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
        $data['main_content'] = 'events/image_add';
        $data['eventValue'] = $this->admindbmodel->fetch_data_con_result($id, 'id', 'events');
        $this->form_validation->set_rules('event_id', 'Title', 'strip_tags|trim|required');
        if ($this->form_validation->run() != FALSE) {
            foreach ($_FILES['imagefile']['name'] as $imageKey => $name) {
                if ($name) {
                    $fileDataImage = pathinfo(basename($_FILES["imagefile"]["name"][$imageKey]));
                    $file_image = uniqid() . '.' . $fileDataImage['extension']; //icon rename
                    $imageExtension = pathinfo($file_image, PATHINFO_EXTENSION);
                    $file_image_thumb = basename($file_image, '.' . $imageExtension) . "_thumb." . $imageExtension;
                    $this->lib->upload_file($_FILES["imagefile"]["tmp_name"][$imageKey], 'assets/events/' . $file_image);
                    $resize_data1 = array(
                        'source_image' => 'assets/events/' . $file_image,
                        'new_image' => 'assets/events/medium/',
                        'create_thumb' => true,
                        'maintain_ratio' => FALSE,
                        'width' => 500,
                        'height' => 800
                    );
                    $resize_data2 = array(
                        'source_image' => 'assets/events/' . $file_image,
                        'new_image' => 'assets/events/small/',
                        'create_thumb' => true,
                        'maintain_ratio' => FALSE,
                        'width' => 200,
                        'height' => 200
                    );

                    $this->lib->image_resize($resize_data1);
                    $this->lib->image_resize($resize_data2);
                    unlink('assets/events/' . $file_image);
                }
                $insert_data['event_image'] = $file_image_thumb;
                $insert_data['event_id'] = $id;
                $insert_data['insert_date'] = date('Y-m-d H:i:s');
                if ($this->admindbmodel->set_data($insert_data, 'event_images') == TRUE) {
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
        $data['main_content'] = 'events/add';
        $data['venueValue'] = $this->admindbmodel->fetch_all_obj('venue');
        $this->form_validation->set_rules('event_venue', 'Venue', 'strip_tags|trim|required');
        $this->form_validation->set_rules('event_title', 'Title', 'strip_tags|trim|required');
        $this->form_validation->set_rules('event_address', 'Address', 'strip_tags|trim|required');
        $this->form_validation->set_rules('event_email', 'Email', 'strip_tags|trim|required');
        $this->form_validation->set_rules('event_mobile', 'Mobile', 'strip_tags|trim|required|integer');
        $this->form_validation->set_rules('event_start_date', 'Start Date', 'strip_tags|trim|required');
        $this->form_validation->set_rules('event_end_date', 'End Date', 'strip_tags|trim|required');
        $this->form_validation->set_rules('bottle_service', 'Bottle Service', 'strip_tags|trim|required');
        $this->form_validation->set_rules('rsvp', 'RSVP', 'strip_tags|trim|required');
        if ($this->form_validation->run() != FALSE) {
            $insert_data['insert_date'] = date('Y-m-d H:i:s');
            $insert_data['user_id'] = $this->user_id;
            $insert_data['event_category'] = 1;//by default its one
            $insert_data['event_venue'] = $this->input->post('event_venue');
            $insert_data['event_title'] = $this->input->post('event_title');
            $insert_data['event_address'] = $this->input->post('event_address');
            $insert_data['event_email'] = $this->input->post('event_email');
            $insert_data['event_mobile'] = $this->input->post('event_mobile');
            $insert_data['event_start_date'] = date('Y-m-d H:i:s',  strtotime($_POST['event_start_date']));
            $insert_data['event_end_date'] = date('Y-m-d H:i:s',  strtotime($_POST['event_end_date']));
            $insert_data['bottle_service'] = $this->input->post('bottle_service');
            $insert_data['rsvp'] = $this->input->post('rsvp');
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
    public function rsvpedit($event_id, $id) {
        $data['dataValue'] = $this->admindbmodel->fetch_data_con_result($id, 'id', 'events_rsvp');
        $data['eventValue'] = $this->admindbmodel->fetch_data_con_result($event_id, 'id', 'events');
        $data['title'] = 'Edit Rsvp';
        $data['main_content'] = 'events/rsvp_edit';
        $this->form_validation->set_rules('rsvp_description', 'Description', 'strip_tags|trim|required');
        if ($this->form_validation->run() != FALSE) {
            $updateData['rsvp_description'] = $this->input->post('rsvp_description');
            if ($this->admindbmodel->update_data_con($updateData, $id, 'id', 'events_rsvp') == TRUE) {
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
        $data['dataValue'] = $this->admindbmodel->fetch_data_con_result($id, 'id', 'events');
        $data['venueValue'] = $this->admindbmodel->fetch_all_obj('venue');
        $data['title'] = 'Edit Events';
        $data['main_content'] = 'events/edit';
        $this->form_validation->set_rules('event_venue', 'Venue', 'strip_tags|trim|required');
        $this->form_validation->set_rules('event_title', 'Title', 'strip_tags|trim|required');
        $this->form_validation->set_rules('event_address', 'Address', 'strip_tags|trim|required');
        $this->form_validation->set_rules('event_email', 'Email', 'strip_tags|trim|required');
        $this->form_validation->set_rules('event_mobile', 'Mobile', 'strip_tags|trim|required|integer');
        $this->form_validation->set_rules('event_start_date', 'Start Date', 'strip_tags|trim|required');
        $this->form_validation->set_rules('event_end_date', 'End Date', 'strip_tags|trim|required');
        $this->form_validation->set_rules('bottle_service', 'Bottle Service', 'strip_tags|trim|required');
        $this->form_validation->set_rules('rsvp', 'RSVP', 'strip_tags|trim|required');
        if ($this->form_validation->run() != FALSE) {
            $updateData['event_category'] = 1;//by default its one
            $updateData['event_venue'] = $this->input->post('event_venue');
            $updateData['event_title'] = $this->input->post('event_title');
            $updateData['event_address'] = $this->input->post('event_address');
            $updateData['event_email'] = $this->input->post('event_email');
            $updateData['event_mobile'] = $this->input->post('event_mobile');
            $updateData['event_start_date'] = date('Y-m-d H:i:s',  strtotime($_POST['event_start_date']));
            $updateData['event_end_date'] = date('Y-m-d H:i:s',  strtotime($_POST['event_end_date']));
            $updateData['bottle_service'] = $this->input->post('bottle_service');
            $updateData['event_additional_info'] = $this->input->post('event_additional_info');
            $updateData['rsvp'] = $this->input->post('rsvp');
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
