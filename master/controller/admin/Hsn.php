<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Hsn extends CI_Controller {

		public function __construct(){
        parent::__construct();
				check_login_user();
        $this->load->model('Hsn_model');
          $this->load->model('Unit_model');

    	}


    	public function index(){
	        $data = array();
        	$data['name']='HSN';
	        $data['hsn_data']=$this->Hsn_model->get();
	        $data['unit_data']=$this->Unit_model->get();
					$data['main_content'] = $this->load->view('admin/master/hsn/hsn', $data, TRUE);
 	        $this->load->view('admin/index', $data);
    	}
    	public function addHsn()
    	{
    		if ($_POST)
    		{
    			$data=array(
    				'hsn_code'=>$_POST['hsn_code'],
    				'unit'=>$_POST['unit']
    			);
    			// print_r($data);
    			$this->Hsn_model->add($data);
    			redirect(base_url('admin/hsn'));

    		}
    	}
        public function edit($id)
        {
            if ($_POST) {

              	$data=array(
    				'hsn_code'=>$_POST['hsn_code'],
    				'unit'=>$_POST['unit']
    			);
    		//	echo print_r($data);exit;

                $this->Hsn_model->edit($id,$data);
                redirect(base_url('admin/hsn'));

            }
            // echo $id;
            // $this->load->view('admin/branch_detail');
            //
        }

        public function delete($id)
        {
            $this->Hsn_model->delete($id);
            redirect(base_url('admin/HSN'));
        }
				public function deletehsn(){
					$ids = $this->input->post('ids');
					 $userid= explode(",", $ids);
					 foreach ($userid as $value) {
							$this->db->delete('hsn', array('id' => $value));
					}
				}

        public function filter()
        {
            $data=array();
            if ($_POST) {
              $searchByCat=$this->input->post('searchByCat');
              $searchValue=$this->input->post('searchValue');
                $output = "";
                $data=$this->Hsn_model->search($searchByCat,$searchValue);
                foreach ($data as $value) {
                                 //echo print_r($value);exit;
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
