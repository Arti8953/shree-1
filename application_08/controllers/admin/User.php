<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct(){
        parent::__construct();
        check_login_user();
       $this->load->model('common_model');
       $this->load->model('login_model');
       $this->load->model('user_model');
       $this->load->model('role_model');
    }


    public function index()
    {
        $data = array();
        $data['name'] = 'User Management';
        $data['user'] = $this->user_model->all_details();
        $data['roles'] = $this->role_model->get_displayname();
        $data['main_content'] = $this->load->view('admin/users/index', $data, TRUE);
        $this->load->view('admin/index', $data);
    }
    public function view()
    {
        $data = array();
        $data['page_title'] = 'User';
        $data['country'] = $this->common_model->select('country');
        $data['power'] = $this->common_model->get_all_power('user_power');
        $data['main_content'] = $this->load->view('admin/user/profile', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

		public function check_user(){
			if ($_POST) {
				try {
					$data = array(
							'username' => $_POST['username'],
					);
					$data = $this->security->xss_clean($data);
					//-- check duplicate username
					$username = $this->common_model->check_user($data['username']);

					if (empty($username)) {

						echo json_encode(array('error' => 0, 'msg' => 'User Name Allowed'));

					} else {
						echo json_encode(array('error' => 1, 'msg' => 'UserName Already Exist'));
					}
				} catch (\Exception $e) {
					echo json_encode(array('error' => 1, 'msg' => $e->getMessage()));
				}
			}else {
				echo json_encode(array('error' => 1, 'msg' => 'Request Type not Allowed'));
			}
		}
    //-- add new user by admin
    public function add()
    {
        if ($_POST) {
					try {
						$data = array(
                'name' => $_POST['name'],
                'username' => $_POST['username'],
                'password' => $_POST['password'],
                'created_at' => current_datetime()
            );
            $data = $this->security->xss_clean($data);
            //-- check duplicate email
            $username = $this->common_model->check_user($data['username']);

            if (empty($username)) {
                $user_id = $this->user_model->add($data);
                if ($this->input->post('role')) {
                    $roles = $this->input->post('role');
                    foreach ($roles as $value) {
                        $role_data = array(
                            'user_id' => $user_id,
                            'role_id' => $value
                        );
                       $role_data = $this->security->xss_clean($role_data);
                       $this->user_model->addRole($role_data);
                    }
                }
                $this->session->set_flashdata(array('error' => 0, 'msg' => 'User Added'));
                redirect($_SERVER['HTTP_REFERER']);
            } else {
                $this->session->set_flashdata(array('error' => 1, 'msg' => 'User Name already exist, try another User Name'));
                redirect($_SERVER['HTTP_REFERER']);
          	}
					} catch (\Exception $e) {
						$this->session->set_flashdata(array('error' => 1, 'msg' => $e->getMessage()));
						redirect($_SERVER['HTTP_REFERER']);
					}
        }else {
					$this->session->set_flashdata(array('error' => 1, 'msg' => 'Request Type not Allowed'));
					redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function all_user_list()
    {
	 	$data['page_title'] = 'All Registered Users';
        $data['users'] = $this->common_model->get_all_user();
        $data['country'] = $this->common_model->select('country');
        $data['count'] = $this->common_model->get_user_total();
        $data['main_content'] = $this->load->view('admin/user/users', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    //-- update users info
    public function update($id)
    {
        if ($_POST) {

            $data = array(
                'first_name' => $_POST['first_name'],
                'last_name' => $_POST['last_name'],
                'mobile' => $_POST['mobile'],
                'country' => $_POST['country'],
                'role' => $_POST['role']
            );
            $data = $this->security->xss_clean($data);

            $powers = $this->input->post('role_action');
            if (!empty($powers)) {
                $this->common_model->delete_user_role($id, 'user_role');
                foreach ($powers as $value) {
                   $role_data = array(
                        'user_id' => $id,
                        'action' => $value
                    );
                   $role_data = $this->security->xss_clean($role_data);
                   $this->common_model->insert($role_data, 'user_role');
                }
            }

            $this->common_model->edit_option($data, $id, 'user');
            $this->session->set_flashdata('msg', 'Information Updated Successfully');
            redirect(base_url('admin/user/all_user_list'));

        }

        $data['user'] = $this->common_model->get_single_user_info($id);
        $data['user_role'] = $this->common_model->get_user_role($id);
        $data['power'] = $this->common_model->select('user_power');
        $data['country'] = $this->common_model->select('country');
        $data['main_content'] = $this->load->view('admin/user/edit_user', $data, TRUE);
		$data['page_title'] = 'Edit Users';
        $this->load->view('admin/index', $data);

    }


    //-- active user
    public function active($id)
    {
        $data = array(
            'status' => 1
        );
        $data = $this->security->xss_clean($data);
        $this->common_model->update($data, $id,'user');
        $this->session->set_flashdata('msg', 'User active Successfully');
        redirect(base_url('admin/user/all_user_list'));
    }

    //-- deactive user
    public function deactive($id)
    {
        $data = array(
            'status' => 0
        );
        $data = $this->security->xss_clean($data);
        $this->common_model->update($data, $id,'user');
        $this->session->set_flashdata('msg', 'User deactive Successfully');
        redirect(base_url('admin/user/all_user_list'));
    }

    //-- delete user
    public function delete($id)
    {
        $this->common_model->delete($id,'user');
        $this->session->set_flashdata('msg', 'User deleted Successfully');
        redirect(base_url('admin/user/all_user_list'));
    }


    public function power()
    {
		$data['page_title'] = 'Add User Role';
        $data['powers'] = $this->common_model->get_all_power('user_power');
        $data['main_content'] = $this->load->view('admin/user/user_power', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    //-- add user power
    public function add_power()
    {
        if (isset($_POST)) {
            $data = array(
                'name' => $_POST['name'],
                'power_id' => $_POST['power_id']
            );
            $data = $this->security->xss_clean($data);

            //-- check duplicate power id
            $power = $this->common_model->check_exist_power($_POST['power_id']);
            if (empty($power)) {
                $user_id = $this->common_model->insert($data, 'user_power');
                $this->session->set_flashdata('msg', 'Power added Successfully');
            } else {
                $this->session->set_flashdata('error_msg', 'Power id already exist, try another one');
            }
            redirect(base_url('admin/user/power'));
        }

    }

    //--update user power
    public function update_power()
    {
        if (isset($_POST)) {
            $data = array(
                'name' => $_POST['name']
            );
            $data = $this->security->xss_clean($data);

            $this->session->set_flashdata('msg', 'Power updated Successfully');
            $user_id = $this->common_model->edit_option($data, $_POST['id'], 'user_power');
            redirect(base_url('admin/user/power'));
        }

    }

    public function delete_power($id)
    {
        $this->common_model->delete($id,'user_power');
        $this->session->set_flashdata('msg', 'Power deleted Successfully');
        redirect(base_url('admin/user/power'));
    }


}
