<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class PrintThis extends CI_Controller {

	public function __construct(){
        parent::__construct();
        check_login_user();
       $this->load->model('common_model');
	   $this->load->model('Design_model');
	     $this->load->model('Frc_model');
       $this->load->model('login_model');
       $this->load->library('barcode');
       $this->load->library('pdf');
    }
    public function index($print){
			$data['print'] = $print;
			$this->load->view('admin/print/index', $data);
    }
    public function designmultiprint()
    {
					if ($_POST['ids']) {
						foreach ($_POST['ids'] as $value) {
							if ($value != "") {
								$data['data'][] = $this->Design_model->get_multi_value_by_id($value);
							}
						}
						 //echo"<pre>"; print_r($data['data']);
						$data['main_content'] = $this->load->view('admin/master/design/multi_list_print', $data, TRUE);
						$this->load->view('admin/print/index', $data);

					}
    }

    public function Challan_multiprint()
    {
					if ($_POST['ids']) {
						foreach ($_POST['ids'] as $value) {
							if ($value != "") {
								$data['data'][] = $this->Frc_model->get_fabric_recieve($value);
							}
						}
						$data['title']=$_POST['title'];
						$data['main_content'] = $this->load->view('admin/FRC/recieve/multi_list_print', $data, TRUE);
						$this->load->view('admin/print/index', $data);

					}
	}
	// public function Stock_multiprint()
    // {
	// 				if ($_POST['ids']) {
	// 					foreach ($_POST['ids'] as $value) {
							
	// 							$data['data'][] = $this->Frc_model->get_stock_value_by_id($value);
							
	// 					}
	// 					$data['frc_data']=$data['data'];
	// 					$data['title']=$_POST['title'];
	// 				// echo"<pre>"; print_r($data['data']);
						
						
	// 					$data['main_content'] = $this->load->view('admin/FRC/recieve/view_print', $data, TRUE);
	// 					// $data['main_content'] = $this->load->view('admin/FRC/return/multi_list_print', $data, TRUE);
	// 					$this->load->view('admin/print/index', $data);

	// 				}
    // }
  }
