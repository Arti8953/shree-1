<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Branch_detail extends CI_Controller {


		public function __construct(){
        parent::__construct();
				check_login_user();
        $this->load->model('Branch_model');
    	}

    	public function index(){
	        $data = array();
					$data['name']='Branch Details';
	        $data['branch_data']=$this->Branch_model->get();
	        $data['main_content'] = $this->load->view('admin/master/branch/branch_detail', $data, TRUE);
					$this->load->view('admin/index', $data);
    	}

    	public function addBranch(){
    		if ($_POST)
    		{
					$data = array();
					$data1 = $this->security->xss_clean($_POST);
    			$data=array(
						'name' =>$data1['name'],
						'sort_name' =>$data1['sort_name'],
						'phone_no' =>$data1['phone_no'],
						'email' =>$data1['email'],
						'grade' =>$data1['grade'],
						'remark' =>$data1['remark'],
						'address' =>$data1['address'],
						'category' =>$data1['category'],
					);
    			// print_r($data);
    			$id=$this->Branch_model->insert($data,'branch_detail');
					if($id){
						$this->session->set_flashdata('success', ' Successfully !!');
					}

    			redirect(base_url('admin/Branch_detail'));

    		}
    	}

        public function edit($id)
        {
            if ($_POST) {
							$data = array();
							$data1 = $this->security->xss_clean($_POST);
							$data=array(
								'name' =>$data1['name'],
								'sort_name' =>$data1['sort_name'],
								'phone_no' =>$data1['phone_no'],
								'email' =>$data1['email'],
								'grade' =>$data1['grade'],
								'remark' =>$data1['remark'],
								'address' =>$data1['address'],
								'category' =>$data1['category'],
							);
              $this->Branch_model->edit($id,$data);
							$this->session->set_flashdata('success', ' Update Successfully !!');
              redirect(base_url('admin/Branch_detail'));
            }
        }

        public function delete($id)
        {
            $this->Branch_model->delete($id);
            redirect(base_url('admin/Branch_detail'));
        }

				public function deletebranch(){
					$ids = $this->input->post('ids');
					 $userid= explode(",", $ids);
					 foreach ($userid as $value) {
							$this->db->delete('branch_detail', array('id' => $value));
					}
				}



        public function filter()
        {
            $data=array();
            if ($_POST) {
              $searchByCat=$this->input->post('searchByCat');
              $searchValue=$this->input->post('searchValue');
                $output = "";
                $data=$this->Branch_model->search($searchByCat,$searchValue);
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

	/* End of file Branch_detail.php */
	/* Location: ./application/controllers/admin/Branch_detail.php */

 ?>
