<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Fabric extends CI_Controller {

		public function __construct(){
        parent::__construct();
				check_login_user();
        $this->load->model('Fabric_model');
				$this->load->model('Hsn_model');
    	}


    	public function index(){
	        $data = array();
	        $data['name']='Fabric';
	        // $data['fabric_data']=$this->Fabric_model->get();
					$data['hsn_data']=$this->Hsn_model->hsn();
					$data['main_content'] = $this->load->view('admin/master/fabric/fabric', $data, TRUE);
  	      $this->load->view('admin/index', $data);
    	}

			public function get_fabric_list(){
				$query = '';
				$output = array();
				$data = array();

				if (!empty($_POST["search"]["value"])) {
				//	pre($_POST["search"]["value"]);exit;
					$query .= 'SELECT * FROM fabric  where';
					$query .= 'fabricName LIKE %' . $_POST["search"]["value"] . '% ';
					$query .= 'OR fabHsnCode LIKE %' . $_POST["search"]["value"] . '% ';
					$query .= 'OR fabricType LIKE %' . $_POST["search"]["value"] . '% ';
					$query .= 'OR fabricCode LIKE %' . $_POST["search"]["value"] . '% ';
					$query .= 'OR purchase LIKE %' . $_POST["search"]["value"] . '% ';
					$caption = 'Search Result For : '. $_POST["search"]["value"].'';
				}else if(!empty($_POST["filter"])){
					$data1['filter'] = $this->input->post('filter');
					$caption = 'Search Result For : ';
					if ($data1['filter']['search'] == 'simple') {
						if ($_POST['filter']['searchByCat'] != "" || $_POST['filter']['searchValue'] != "") {
							$query .= 'SELECT * FROM fabric  where';
							$query .= ' '. $_POST['filter']['searchByCat'].' LIKE "%' . $_POST['filter']['searchValue'] . '%" ';
							$caption = $caption . $data1['filter']['searchByCat'] . " = " . $data1['filter']['searchValue'] . " ";
						}

					} else {
						if (isset($_POST['designName']) && $_POST['designName'] != "") {
							$data1['cat'][] = 'designName';
							$fab = $this->input->post('designName');


							$data1['Value'][] = $fab;
							$caption = $caption . ' designName' . " = " . $fab . " ";
						}
						if (isset($_POST['designSeries']) && $_POST['designSeries'] != "") {
							$data1['cat'][] = 'designSeries';
							$fab = $this->input->post('designSeries');
							$data1['Value'][] = $fab;
							$caption = $caption . 'designSeries ' . " = " . $fab . " ";
						}
						if (isset($_POST['desCode']) && $_POST['desCode'] != "") {
							$data1['cat'][] = 'desCode';
							$fab = $this->input->post('desCode');
							$data1['Value'][] = $fab;
							$caption = $caption . 'desCode' . " = " . $fab . " ";
						}
						if (isset($_POST['rate']) && $_POST['rate'] != "") {
							$data1['cat'][] = 'rate';
							$fab = $this->input->post('rate');
							$data1['Value'][] = $fab;
							$caption = $caption . 'rate' . " = " . $fab . " ";
						}
						if (isset($_POST['stitch']) && $_POST['stitch'] != "") {
							$data1['cat'][] = 'stitch';
							$fab = $this->input->post('stitch');
							$data1['Value'][] = $fab;
							$caption = $caption . 'stitch' . " = " . $fab . " ";
						}
						if (isset($_POST['dye']) && $_POST['dye'] != "") {
							$data1['cat'][] = 'dye';
							$fab = $this->input->post('dye');
							$data1['Value'][] = $fab;
							$caption = $caption . 'dye' . " = " . $fab . " ";
						}
						if (isset($_POST['matching']) && $_POST['matching'] != "") {
							$data1['cat'][] = 'matching';
							$fab = $this->input->post('matching');
							$data1['Value'][] = $fab;
							$caption = $caption . 'matching' . " = " . $fab . " ";
						}
						if (isset($_POST['sale_rate']) && $_POST['sale_rate'] != "") {
							$data1['cat'][] = 'sale_rate';
							$fab = $this->input->post('sale_rate');
							$data1['Value'][] = $fab;
							$caption = $caption . 'sale_rate' . " = " . $fab . " ";
						}
						if (isset($_POST['htCattingRate']) && $_POST['htCattingRate'] != "") {
							$data1['cat'][] = 'htCattingRate';
							$fab = $this->input->post('htCattingRate');
							$data1['Value'][] = $fab;
							$caption = $caption . 'htCattingRate' . " = " . $fab . " ";
						}
						if (isset($_POST['fabricName']) && $_POST['fabricName'] != "") {
							$data1['cat'][] = 'fabricName';
							$fab = $this->input->post('fabricName');
							$data1['Value'][] = $fab;
							$caption = $caption . 'fabricName' . " = " . $fab . " ";
						}
						if (isset($_POST['barCode']) && $_POST['barCode'] != "") {
							$data1['cat'][] = 'barCode';
							$fab = $this->input->post('barCode');
							$data1['Value'][] = $fab;
							$caption = $caption . 'barCode' . " = " . $fab . " ";
						}
						if (isset($_POST['designOn']) && $_POST['designOn'] != "") {
							$data1['cat'][] = 'designOn';
							$fab = $this->input->post('designOn');
							$data1['Value'][] = $fab;
							$caption = $caption . 'designOn' . " = " . $fab . " ";
						}
						if(isset($data1['cat']) && $data1['Value']) {
							$query .= 'SELECT * FROM fabric  where';
							$count = count($data['cat']);
							for ($i = 0; $i < $count; $i++) {
								$query .= ' ' . $data['cat'][$i] . ' LIKE "%' . $data['Value'][$i] . '%" ';
							}

						} else {
							$this->session->set_flashdata('error', 'please enter some keyword');
							redirect($_SERVER['HTTP_REFERER']);
						}
					}


				} else {
					$caption= "Fabric List";
					$query .= 'SELECT * FROM fabric ';
				}

				if (!empty($_POST["order"]) && isset($_POST["order"])) {
					$query .= ' ORDER BY ' . $_POST['order']['0']['column'] . ' ' . $_POST['order']['0']['dir'] . ' ';
				} else {
					$query .= ' ORDER BY id desc ';
				}

				if (isset($_POST["length"]) && $_POST["length"]!= -1) {
					$query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
				}else{
					$query .= 'LIMIT  1 , 50';
				}

				$sql = $this->db->query($query);
				$result = $sql->result_array();
				$filtered_rows = $sql->num_rows();
			//	echo "<pre>"; print_r($result);exit;
				$id=1;
				foreach ($result as $value) {
					$sub_array = array();
					$sub_array[] = '<input type="checkbox" class="sub_chk" data-id='.$value['id'].'>';
					$sub_array[] = '<span class="label label-info">'.$id.'</span>';
					$sub_array[] = $value['fabricName'];
					$sub_array[] = $value['fabHsnCode'];
					$sub_array[] = $value['fabricType'];
					$sub_array[] = $value['fabricCode'];
					$sub_array[] = $value['purchase'];


					$sub_array[] =  '<a class="text-primary text-center tip" href="javascript:void(0)" onclick="edit( ' . $value['id'] . ')" data-original-title="Delete">
													<i class="mdi mdi-pen blue"></i>
												</a>
												<a class="text-danger text-center tip" href="javascript:void(0)" onclick="delete_detail( '.$value['id'].')" data-original-title="Delete">
													<i class="mdi mdi-delete red"></i>
												</a>';

					$data[] = $sub_array;
					$id++;
				}

				$output = array(
					'caption' => $caption,
					"draw"       =>  intval($_POST["draw"]),
					"recordsTotal" => $this->Fabric_model->get_count('fabric'),
					"recordsFiltered" =>$this->Fabric_model->get_count('fabric'),

					"data" => $data
				);

				echo json_encode($output);

			}
			public function getFabric()
			{

				$id = $this->security->xss_clean($_POST['id']);

				$data['data'] = $this->Fabric_model->get_single_value_by_id($id);

				echo json_encode($data['data']);
			}



    	public function addFabric()
    	{
    		if ($_POST)
    		{
    			$data=array(
    				'fabricName'=>$_POST['fabricName'],
    				'fabHsnCode'=>$_POST['fabHsnCode'],
    				'fabricType'=>$_POST['fabricType'],
    				'fabricCode'=>$_POST['fabricCode']
    			);
    			// print_r($data);
    			$this->Fabric_model->add($data);
    			redirect(base_url('admin/Fabric'));

    		}
    	}
        public function edit()
        {
            if ($_POST) {
								$id = $_POST['fabricId'];
               $data=array(
    				'fabricName'=>$_POST['fabricName'],
    				'fabHsnCode'=>$_POST['fabHsnCode'],
    				'fabricType'=>$_POST['fabricType'],
    				'fabricCode'=>$_POST['fabricCode']
    			);
                // print_r($data);
                $this->Fabric_model->edit($id,$data);
                redirect(base_url('admin/Fabric'));

            }
        }
        public function delete($id)
        {
            $this->Fabric_model->delete($id);
            redirect(base_url('admin/Fabric'));
        }
				public function deletefabric(){
					$ids = $this->input->post('ids');
					 $userid= explode(",", $ids);
					 foreach ($userid as $value) {
							$this->db->delete('fabric', array('id' => $value));
					}
				}


        public function filter()
        {
            $data=array();
            if ($_POST) {
              $searchByCat=$this->input->post('searchByCat');
              $searchValue=$this->input->post('searchValue');
                $output = "";
                $data=$this->Fabric_model->search($searchByCat,$searchValue);
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

		public function fabricExist()
			 {
					if ($_POST) {
						$output = '';
						$data = $this->Fabric_model->get_fabric_exist($_POST['fabricName']);
						//echo print_r($data);exit;
						if($data){

							 echo TRUE;
						}else{

							echo FALSE;
						}
					}else{
						echo json_encode(array('error'=>true, 'msg'=>'somthing want wrong :('));
					}

			}

	}

	/* End of file Dashboard.php */
	/* Location: ./application/controllers/admin/Dashboard.php */
 ?>
