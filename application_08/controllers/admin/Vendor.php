<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Vendor extends CI_Controller {


		public function __construct(){
        parent::__construct();

    	}


    	public function index(){
	        $data = array();
	        $data['name']='Vendor';
	        $this->load->view('admin/vendor');
	        $this->load->view('admin/footer');

    	}

	}

	/* End of file Branch_detail.php */
	/* Location: ./application/controllers/admin/Branch_detail.php */

 ?>
