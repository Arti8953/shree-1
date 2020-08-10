
<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Department extends CI_Controller {

		public function __construct(){
        parent::__construct();
				check_login_user();
        $this->load->model('Department_model');
				  $this->load->model('common_model');

    	}


    	public function index(){
	        $data = array();
					$data['name']=' Department';
	        $data['dept_data']=$this->Department_model->get();
					$data['user'] = $this->common_model->user_name();
	        $data['main_content'] = $this->load->view('admin/master/department/department', $data, TRUE);
	        $this->load->view('admin/index', $data);
    	}
    	public function addDept()
    	{
    		if ($_POST)
    		{
    			$data=array(
						'deptName'=>$_POST['deptName'],
						'userId'=>$_POST['userId'],
						'email'=>$_POST['email'],
						'phone_no'=>$_POST['phone_no'],

					);

    			$this->Department_model->add($data);
					$this->session->set_flashdata('success','Successfully');
    			redirect(base_url('admin/Department'));

    		}
    	}
        public function edit($id)
        {
            if ($_POST) {
							$data=array(
								'deptName'=>$_POST['deptName'],
								'userId'=>$_POST['userId'],
								'email'=>$_POST['email'],
								'phone_no'=>$_POST['phone_no'],
							);
                $this->Department_model->edit($id,$data);
								$this->session->set_flashdata('success','Successfully');
                redirect(base_url('admin/Department'));

            }
        }
        public function delete($id)
        {
            $this->Department_model->delete($id);
            redirect(base_url('admin/Department'));
        }

				public function deletedepartment(){
					$ids = $this->input->post('ids');
					 $userid= explode(",", $ids);
					 foreach ($userid as $value) {
							$this->db->delete('department', array('id' => $value));
					}
				}

        public function filter()
        {
            $data=array();
            if ($_POST) {
              $searchByCat=$this->input->post('searchByCat');
              $searchValue=$this->input->post('searchValue');
                $output = "";
                $data=$this->Department_model->search($searchByCat,$searchValue);
                foreach ($data as $value) {
                                // echo print_r($value);exit;
                     $output .= "<tr id='tr_".$value['id']."'>";
                     $output .="<td><input type='checkbox' class='sub_chk' data-id=".$value['id']."></td>";
                    foreach ($value as $temp) {
                        $output .= "<td>".$temp."</td>";
                     }
                   $output .= "<td><a href='#".$value['id']."' class='text-center tip' data-toggle='modal' data-original-title='Edit'><i class='fas fa-edit blue'></i></a>
                    <a class='text-danger text-center tip' href='javascript:void(0)' onclick='delete_detail(".$value['id'].")' data-original-title='Delete'><i class='mdi mdi-delete red' ></i></a>
                    </td>";
                $output .= "</tr>";
                            }
              echo json_encode($output);
            }
        }

	}

	/* End of file Dashboard.php */
	/* Location: ./application/controllers/admin/Dashboard.php */
 ?>
