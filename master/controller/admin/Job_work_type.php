<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Job_work_type extends CI_Controller {

		public function __construct(){
        parent::__construct();
				check_login_user();
         $this->load->model('Job_work_type_model');
         $this->load->model('common_model');
         $this->load->model('unit_model');

    	}


    	public function index(){
	        $data = array();
	        $data['name']='Job Work Type';
          $data['work_type']=$this->Job_work_type_model->get();
          $data['type']=$this->Job_work_type_model->getType();
          $data['units']=$this->unit_model->getUnits();
	        $data['fabtype']=$this->Job_work_type_model->getfabricType();
		      $data['main_content'] = $this->load->view('admin/master/job_work_type/jobworktype', $data, TRUE);
			  	$this->load->view('admin/index', $data);
        }

    //     public function addType(){
    //         if ($_POST)
    // 		{
    // 		  //  echo print_r($_POST);exit;
    //             $data=array();
    //             $data['type']=$this->input->post('type');
    //             // $data['parent']=$this->input->post('parent');
    //         //   $data1['unit']=$this->input->post('unit');
    //           $arr=$this->input->post('tabledata');
    //           $str=explode(",",$arr);
    //           echo "<pre>";
    //           echo print_r($str);
    //           $data1['jobId']= $this->Job_work_type_model->add($data);
    //         $count=1;
    //         $recod = array();
    //         $recod['jobId'] = $data1['jobId'];
    //         //   foreach ($str as $value)
    //          for ($i=0; $i <count($str) ; $i++)
    //           {
    //              $temp = array();
    //               if($count <= 3){

    //                   switch($count){
    //                           case 1:
    //                           $temp['job']=$str[$i];
    //                         //   echo $temp['job'];
    //                           break;
    //                             case 2:
    //                              $temp['rate'] =$str[$i];
    //                             //  echo $temp['rate'];
    //                             break;
    //                              case 3:
    //                                  $temp['unit'] =$str[$i];
    //                                 //  echo $temp['unit'];
    //                                 break;

    //                             }

    //                   if($count==3){
    //                       $recod[]=$temp;
    //                       unset($temp);
    //                   }


    //               }

    //               else{
    //                   $count = 0;
    //                   $count++;
    //               }
    //               $count++;

    //           }
    //              print_r($recod);exit;


    //           for($i=0; $i <count($job) ; $i++){
    //             $data1['job']=$job[$i];
    //             $data1['rate']=$rate[$i];
    //             $data1['unit']=$unit[$i];
    //             $this->Job_work_type_model->insert('jobtypeconstant',$data1);
    //           }


    // 			redirect(base_url('admin/Job_work_type'));

    // 		}

    //     }
      public function addType(){
				if ($_POST) {
					$data=array();
					$data['type']=$this->input->post('type');
					$jobid= $this->Job_work_type_model->add($data);
					if ($jobid) {
						for($i = 0; $i < count($_POST['job']); $i++) {
							$datajob = array(
								'unit' =>$_POST['unit'][$i],
								'jobId' =>$jobid,
								'job' =>$_POST['job'][$i],
								'rate' =>$_POST['rate'][$i]
							);
							$this->Job_work_type_model->insert($datajob,'jobtypeconstant');
						}
						$this->session->set_flashdata(array('error' => 0, 'msg' => 'Job Work Added Successfully'));
						redirect(base_url('admin/Job_work_type'));
					}else {
						$this->session->set_flashdata(array('error' => 1, 'msg' => 'Job Work Added Faild'));
						redirect(base_url('admin/Job_work_type'));
					}
        }

      }
        public function edit($id){
            if ($_POST)
    		{
                $data=array();
                // $data['type']=$this->input->post('type');
                // $data['parent']=$this->input->post('parent');
                $data['rate']=$this->input->post('rate');
                $data['job']=$this->input->post('job');


    			$this->Job_work_type_model->update($id,$data);

    			redirect(base_url('admin/Job_work_type'));

    		}

        }

        public function delete($id)
        {
            $this->Job_work_type_model->delete($id);
            redirect(base_url('admin/Job_work_type'));
        }

	 public function deletejob(){
					 $ids = $this->input->post('ids');
					 // echo $ids;exit;
					 $userid= explode(",", $ids);
					 // echo print_r($userid);exit;
					 foreach ($userid as $value) {

					 $this->db->delete('jobtypeconstant', array('id' => $value));
					}
				}
        public function filter()
        {
            $data=array();
            if ($_POST) {
              $searchByCat=$this->input->post('searchByCat');
              $searchValue=$this->input->post('searchValue');
                $output = "";
                $data=$this->Job_work_type_model->search($searchByCat,$searchValue);
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
