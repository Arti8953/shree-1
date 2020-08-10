<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class SRC extends CI_Controller {

	public function __construct(){
        parent::__construct();
        check_login_user();
       $this->load->model('common_model');
       $this->load->model('Customer_model');
       $this->load->model('Src_model');
    }
    public function index()
    {
        $data = array();
        $data['name'] = 'SRC';
				$data['febName'] = $this->Src_model->get_fabric_name();
				$data['fresh_fabricname'] = $this->Src_model->get_fabric_fresh_value();

				//echo print_r($data['$febName']);exit;
        $data['main_content'] = $this->load->view('admin/master/src/src', $data, TRUE);
        $this->load->view('admin/index', $data);
	}
	public function getlist()
    {
		$febName = $this->Src_model->get_fabric();
		foreach ($febName as $key => $value) {
			$data[]= $value;
		}
		header('Content-type: application/json');
		echo json_encode($data);
	}

	public function getfabricName()
    {
		$febName = $this->Src_model->get_fabric_name();
       foreach($febName as $row ) {

        foreach($row as $value){
        $result_array[]= $value;
        }

	}
		header('Content-type: application/json');
		echo json_encode($result_array);
}
	public function getErcCode()
    {

		$febName = $this->Src_model->get_Erc_Code();

       foreach($febName as $row) {

        foreach($row as $value){
        $result_array[]= $value;
        }

	}
		header('Content-type: application/json');
		echo json_encode($result_array);
}

public function update()
    {
		$id=$_POST['id'];
		if(isset($_POST['fName'])){
			$data = array();
			$data['fabName'] =$_POST['fName'];
 			$data['updated_at'] = date('Y-m-d H:i:s');
			$data['created_at'] = date('Y-m-d H:i:s');
			$data_value= $this->Src_model->get_src_name($data['fabName']);
// 			echo print_r($data_value);
 			 if(isset($id))
 			 {
 			      $status = $this->Src_model->Update($id,$data);
 			 }
		}
		if(isset($_POST['purchase'])){
			$data = array();
			$data['purchase'] =$_POST['purchase'];
			$status = $this->Src_model->Update($id,$data);
		}
		if(isset($_POST['fcode'])){
			$data = array();
			$data['fabCode'] =$_POST['fcode'];
		  $data['updated_at'] = date('Y-m-d H:i:s');
			$data['created_at'] = date('Y-m-d H:i:s');
			$status = $this->Src_model->Update($id,$data);
		}
		if(isset($_POST['srate'])){
			$data = array();
			$data['sale_rate'] =$_POST['srate'];
			$data['updated_at'] = date('Y-m-d H:i:s');
			$data['created_at'] = date('Y-m-d H:i:s');
			$status = $this->Src_model->Update($id,$data);
		}

		    $data['fabName']=$this->Src_model->get_fab_name_value('src');
		  //  echo print_r( $data['fabName']);exit;
		    $fabName=$data['fabName']->fabName;
				$fabCode=$data['fabName']->fabCode;
		   // echo $fabCode;exit;

			if(isset($_POST['purchase'])){
			$data = array();
			$data['purchase'] =$_POST['purchase'];
			$status = $this->Src_model->Update_fabric($fabName,$data);
		  }
		  if(isset($_POST['fcode'])){
			$data = array();
			$data['Code'] =$_POST['fcode'];
			$status = $this->Src_model->Update_fabric($fabName,$data);
		}
			if(isset($_POST['srate'])){
			$data = array();
			$data['sale_rate'] =$_POST['srate'];
		    $status = $this->Src_model->Update_fabric($fabName,$data);
		}
		if(isset($_POST['srate'])){
			$data = array();
			$data['saleRate'] =$_POST['srate'];
		  $status = $this->Src_model->Update_design($fabName,$fabCode,$data);
		}
		if($status=='true'){
			echo "success";
		}
    }


    // public function Adduser(){
    //   	if ($_POST)
    // 		{
    //       $data=$this->input->post();
    //       $data['password']=md5($this->input->post('password'));
    // 			//print_r($data);
    // 			$this->Employee_model->add($data);
    // 			redirect(base_url('admin/Employee'));
    // 		}
    // }

		public function checkAvailable(){
			if ($_POST) {
				$output = '';
				$check = $this->security->xss_clean($_POST);
				$data = $this->Src_model->get_SRC_set_exist($check);
				//echo print_r($data);exit;
					if($data){
						 echo 1;
					}else{
						echo 0;
					}
			}else{
					echo json_encode(array('error'=>true, 'msg'=>'somthing want wrong :('));
			}
		}
    	public function add_src(){

			$data=array();

					$data=array(

						'fabName' => 'NULL',

					);
					$id = $this->Src_model->insert($data,'src');
			echo $id;
		}

  }
