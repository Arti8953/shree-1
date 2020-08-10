<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Permissions extends CI_Controller {

	public function __construct(){
        parent::__construct();
				check_login_user();
       $this->load->library(['auth', 'form_validation']);
       $this->load->model('common_model');
       $this->load->model('permission_model');
       $this->load->model('role_model');
    }

  public function index(){
    $data = array();
    $data['name'] = 'Access Role';
    $data['main_content'] = $this->load->view('admin/roles/index', $data, TRUE);
    $this->load->view('admin/index', $data);
  }

	public function add() {
		if($_POST) {
			try {
				$data = [
					'name' => strtolower($_POST['permissions_name']),
					'display_name' => $_POST['display_name'],
					'description' => $_POST['description'],
					'created_at' => current_datetime(),
				];
				$data = $this->security->xss_clean($data);
				$result = $this->common_model->insert($data, 'permissions');
				if ($result) {
					$this->session->set_flashdata(array('error' => 0, 'msg' => 'Permissions Data Added.' ));
					redirect($_SERVER['HTTP_REFERER']);
				}
			} catch (\Exception $e) {
				$this->session->set_flashdata(array('error' => 1, 'msg' => $e->getMessage()));
				redirect($_SERVER['HTTP_REFERER']);
			}
		} else {
			$this->session->set_flashdata(array('error' => 1, 'msg' => 'wrong request type' ));
			redirect($_SERVER['HTTP_REFERER']);
		}
	}

	public function assign($role_id = '') {
		if ($_POST) {
			try {
				if (count($_POST['permissions']) > 0) {
					$this->role_model->deletePermissions($_POST['role_id'], 'permission_roles');
					$result = $this->role_model->addPermissions($_POST['role_id'], $_POST['permissions']);
					if ($result) {
						$this->session->set_flashdata(array('error' => 0, 'msg' => 'Update Role Permission.' ));
						redirect($_SERVER['HTTP_REFERER']);
					}
				}else{
					$this->role_model->deletePermissions($_POST['role_id'], 'permission_roles');
					$this->session->set_flashdata(array('error' => 0, 'msg' => 'Update Role Permission.' ));
					redirect($_SERVER['HTTP_REFERER']);
				}
			} catch (\Exception $e) {
				$this->session->set_flashdata(array('error' => 1, 'msg' => $e->getMessage()));
				redirect($_SERVER['HTTP_REFERER']);
			}
		} else {
			if (is_numeric($role_id)) {
				$data = array();
				$data['name'] = 'Assign Role';
				$data['permissions'] = $this->permission_model->get_name();
				$data['role'] = $this->role_model->get_name($role_id);
				$data['selected'] = $this->role_model->roleWisePermissions($role_id);
				$data['main_content'] = $this->load->view('admin/permissions/add', $data, TRUE);
		    $this->load->view('admin/index', $data);
			}else {
				$this->session->set_flashdata(array('error' => 1, 'msg' => 'wrong request type' ));
				redirect($_SERVER['HTTP_REFERER']);
			}
		}
	}
}
