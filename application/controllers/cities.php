<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cities extends CI_Controller {

    var $tbl_name1;
    var $tbl_name2;

    function __construct() {
        parent::__construct();
        $this->load->library("lib");
        $this->lib->auth_check(); //authentication check
        $this->load->model("admindbmodel");
        $this->tbl_name1 = "cities";
        $id = $this->session->userdata('loged_user_id');
        $this->load->helper('text');
    }
    public function index() {
        $result = $this->admindbmodel->fetch_all_array($this->tbl_name1);
        $json = array();
        $json['data'] = array();
        foreach ($result as $key => $val) {
            $getVenueData = count($this->admindbmodel->fetch_data_con_result($val['id'],'city_id','venue'));
            $venueView = "<a href='#' title='View' class='view btn btn-primary btn-sm' data-toggle='modal' data-target='#myModal' data-value='" . $val['id'] . "'><i class='icon-search icon-white'></i>".$getVenueData."</a> ";
            $delete_btn = "<a href='" . base_url('cities/delete_data/' . $val['id']) . "' title='Delete' class='delete btn  btn-danger btn-sm'><i class='icon-trash icon-white'></i>Delete</a>";
            $edit_btn = "<a href='" . base_url('cities/edit/' . $val['id']) . "' title='Edit' class='btn btn-sm btn-info' ><i class='icon-edit icon-white'></i>Edit</a> ";
            $insert_date = date('j\<\s\u\p\>S\<\/\s\u\p\> M Y h:i a', strtotime($val['insert_date']));
            $json['data'][$key]['name'] = $val['city_title'];
            $json['data'][$key]['venues'] = $venueView;
            $json['data'][$key]['insert_date'] = $insert_date;
            $json['data'][$key]['action'] = $edit_btn . $delete_btn;
        }
        $data['datainfo'] = json_encode($json);
        $data['title'] = "City list";
        $data['main_content'] = 'cities/list';
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
  //    view modal
    public function view() {
        $dataValue = $this->admindbmodel->fetch_data_con_result($_POST['postID'],'city_id','venue');
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
                $date = date('j\<\s\u\p\>S\<\/\s\u\p\> M Y h:i A', strtotime($row->insert_date));//date('Y-m-d h:i a', strtotime($row->action_date));
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
    public function add() {
        $data['title'] = 'Add New';
        $data['main_content'] = 'cities/add';
        $this->form_validation->set_rules('city_title', 'Name', 'strip_tags|trim|required|is_unique[cities.city_title]');
        if ($this->form_validation->run() != FALSE) {
            $insert_data['insert_date'] = date('Y-m-d H:i:s');
            $insert_data['city_title'] = $this->input->post('city_title');
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
        $data['title'] = 'Edit city';
        $data['main_content'] = 'cities/edit';
        $this->form_validation->set_rules('city_title', 'City', 'strip_tags|trim|required|call_back_recheck_availabity');
        if ($this->form_validation->run() != FALSE) {
            $updateData['city_title'] = $this->input->post('city_title');
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
        if ($this->admindbmodel->reCheckAvailability($name, $id, 'city_title',$this->tbl_name1) > 0) {
            $this->form_validation->set_message('recheck_availabity', 'This title is already taken!');
            return FALSE;
        } else {
            return true;
        }
    }


}
