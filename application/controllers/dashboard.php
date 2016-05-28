    <?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    var $tbl_name1;
    var $tbl_name2;

    function __construct() {
        parent::__construct();
        $this->load->library("lib");
        $this->lib->auth_check(); //authentication check
        $this->load->model('users_model');
        $this->load->model("admindbmodel");
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->tbl_name2 = "admin_list";
        $this->load->library('email');
        $id = $this->session->userdata('loged_user_id');
    }

    function index() {
        $data['title'] = 'Dashboard';
        $data['main_content'] = 'dashboard/dashboard';
        $data['adminValue'] = $this->admindbmodel->fetch_data_con_result(4,'user_type','users');
        $data['userValue'] = $this->admindbmodel->fetch_all_obj('users');
        $data['cityValue'] = $this->admindbmodel->fetch_all_obj('cities');
        $data['venueValue'] = $this->admindbmodel->fetch_all_obj('venue');
        $data['eventValue'] = $this->admindbmodel->fetch_all_obj('events');
        $this->load->view('template', $data);
    }


}
