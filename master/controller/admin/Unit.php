
<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Unit extends CI_Controller {


		public function __construct(){
        parent::__construct();
				check_login_user();
        $this->load->model('Unit_model');

    	}
    	public function index(){
      $data = array();
      $data['name']='Unit';
      $data['unit_data']=$this->Unit_model->get();
			$data['main_content'] = $this->load->view('admin/master/units/index', $data, TRUE);
			$this->load->view('admin/index', $data);

    	}
    	public function addUnit()
    	{
    		if ($_POST)
    		{
    			$data =array(
						'unitName'=>$_POST['unitName'],
						'unitSymbol'=>$_POST['unitSymbol'],

					);
    			$this->Unit_model->add($data);
    			redirect(base_url('admin/Unit'));

    		}
    	}
    	public function edit($id)
        {
            if ($_POST) {
							$data =array(
								'unitName'=>$_POST['unitName'],
								'unitSymbol'=>$_POST['unitSymbol'],

							);
                $this->Unit_model->edit($id,$data);
                redirect(base_url('admin/Unit'));
            }
            // echo $id;
            // $this->load->view('admin/branch_detail');
            //
        }

        public function delete($id)
        {
            $this->Unit_model->delete($id);
            redirect(base_url('admin/Unit'));
        }

				public function delete_unit(){
					$ids = $this->input->post('ids');
					 $userid= explode(",", $ids);
					 foreach ($userid as $value) {
							$this->db->delete('unit', array('id' => $value));
					}
				}
        public function filter()
        {
            $data=array();
            if ($_POST) {
              $searchByCat=$this->input->post('searchByCat');
              $searchValue=$this->input->post('searchValue');
                $output = "";
                $data=$this->Unit_model->search($searchByCat,$searchValue);
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
