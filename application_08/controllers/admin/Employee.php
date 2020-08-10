<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Employee extends CI_Controller {

	public function __construct(){
        parent::__construct();
        check_login_user();
       $this->load->model('common_model');
       $this->load->model('Customer_model');
       $this->load->model('Employee_model');
    }
    public function index()
    {
        $data = array();
        $data['name'] = 'Employee';
        $data['power'] = $this->common_model->get_all_power('user_power');
        $data['user_data']=$this->common_model->select('user');
         $data['user_role']=$this->common_model->get_user_role1();
       //echo"<pre>";print_r($data['user_role']);exit;
         $data['dept_name']=$this->common_model->department();
        $data['main_content'] = $this->load->view('admin/Employee/Employee', $data, TRUE);
        $this->load->view('admin/index', $data);
    }
    public function Adduser(){
      	if ($_POST)
    		{
                $data=$this->input->post();
                $data['password']=md5($this->input->post('password'));

    			//print_r($data);
    			$this->Employee_model->add($data);
    			redirect(base_url('admin/Employee/employee'));

    		}
    }

    public function edit($id)
        {
            if ($_POST) {
                $data=$this->input->post();
                $this->Employee_model->edit($id,$data);
                redirect(base_url('admin/Employee/employee'));

            }
            // echo $id;
            // $this->load->view('admin/branch_detail');
            //
        }

        public function delete($id)
        {
            $this->Employee_model->delete($id);
            redirect(base_url('admin/Employee/employee'));
        }

  }
