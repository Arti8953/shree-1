<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct(){
      	parent::__construct();
       $this->load->model('common_model');
       $this->load->model('login_model');
       $this->load->model('Orders_model');
			 check_login_user();
    }
    public function index()
    {
        $data = array();
        $data['name'] = 'Dashboard';
    	  $data['main_content'] = $this->load->view('admin/admin_home', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    public function order_flow_chart()
    {
			$data = array();
			header('Content-type: application/json');
			$order_data = $this->Orders_model->show_order_flow_chart();
			foreach ($order_data as $key => $value) {
				$data[$key] =  $value;
				$data[$key]['order_date'] = my_date_show($data[$key]['order_date']);
			}
			echo json_encode($data);
    }

  }
