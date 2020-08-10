<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Setting extends CI_Controller {

	public function __construct(){
      	parent::__construct();
	       $this->load->model('common_model');
	       $this->load->model('setting_model');
	       $this->load->model('login_model');
	       $this->load->model('role_model');
				 $this->load->model('user_model');
				 check_login_user();
    }
    public function index()
    {
        $data = array();
        $data['name'] = 'setting';
        $data['main_content'] = $this->load->view('admin/master/setting/index', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

		// Role Managements

		public function roles(){
			$data = array();
			$data['page_name'] = 'Role Management';
			$data['roles'] = $this->role_model->getDetailWithPermissions();
			$data['main_content'] = $this->load->view('admin/roles/index', $data, TRUE);
			$this->load->view('admin/index', $data);
		}

		public function permissions(){
			$data = array();
			$data['page_name'] = 'Permission Management';
			$data['permissions'] = $this->common_model->select('permissions');
			$data['main_content'] = $this->load->view('admin/permissions/index', $data, TRUE);
			$this->load->view('admin/index', $data);
		}

		public function users()
		{
				$data = array();
				$data['name'] = 'User Management';
				$data['user'] = $this->user_model->all_details();
				$data['main_content'] = $this->load->view('admin/users/index', $data, TRUE);
				$this->load->view('admin/index', $data);
		}

  }
