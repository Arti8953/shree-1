<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class EMB extends CI_Controller {

	public function __construct(){
        parent::__construct();
        check_login_user();
       $this->load->model('common_model');
       $this->load->model('Erc_model');
      	$this->load->model('Emb_model');
    }
    public function index()
    {
        $data = array();
        $data['name'] = 'ERC';
		    $data['designname'] = $this->Emb_model->get_design_name();
		    $data['worker'] = $this->Emb_model->get_worker_name();
	     	$data['emb'] = $this->Emb_model->get_emb();
        $data['main_content'] = $this->load->view('admin/master/emb/emb', $data, TRUE);
        $this->load->view('admin/index', $data);
    }


public function update($id)
    {
		if ($_POST) {
							$datajob = array(
								'workerName' =>$_POST['job'],
								'rate' =>$_POST['rate']
							);
							$this->Emb_model->update($id,$datajob);
							redirect(base_url('admin/emb'));
        }
    }
		public function add_emb(){

			if ($_POST) {

					$design=$this->input->post('design');
					
						for($i = 0; $i < count($_POST['job']); $i++) {
							$datajob = array(

								'designName'=> $design,
								'workerName' =>$_POST['job'][$i],
								'rate' =>$_POST['rate'][$i]
							);
							$this->Emb_model->insert($datajob,'emb');
						}
					redirect(base_url('admin/emb'));
        }

		}

     public function delete($id)
        {
            $this->Emb_model->delete($id);
            redirect(base_url('admin/Design'));
        }

  }
