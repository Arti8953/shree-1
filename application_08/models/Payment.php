<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Payment extends CI_Controller {

    public function __construct(){
        parent::__construct();
        check_login_user();
        $this->load->model('common_model');
    }

    public function index(){
        $data = array();
        $data['page_title'] = 'Payment Request';
        $data['completed'] =  $this->common_model->get_payment_completed();
        //$data['request'] =  $this->common_model->get_payment_request();
        $data['main_content'] = $this->load->view('admin2/payment/index', $data, TRUE);
        $this->load->view('admin2/index', $data);
    }
    public function request(){
        $data = array();
        $data['page_title'] = 'Payment Request';
        //$data['completed'] =  $this->common_model->get_payment_completed();
        $data['request'] =  $this->common_model->get_payment_request();
        $data['main_content'] = $this->load->view('admin2/payment/request', $data, TRUE);
        $this->load->view('admin2/index', $data);
    }

    public function completed(){
        $data = array();
        $data['page_title'] = 'Payment Completed';
        $data['completed'] =  $this->common_model->get_payment_completed();
        $data['main_content'] = $this->load->view('admin/payment/completed', $data, TRUE);
        $this->load->view('admin/index', $data);
    }
    public function transaction($id){
        $data = array();
        $data['page_title'] = 'Payment Details';
        $data['transaction'] =  $this->common_model->get_payment_transaction($id);
        $data['main_content'] = $this->load->view('admin2/payment/transaction.php', $data, TRUE);
        $this->load->view('admin2/index', $data);
    }

    public function do_payment(){
      if ($_POST) {
        $payment = array();
        $data = array(
          'paid_amount' => $_POST['paid_amount'],
          'request_id' => $_POST['request_id'],
          'transaction_id' =>  $_POST['transaction_id'],
          'created' => current_datetime()
        );
        $data = $this->security->xss_clean($data);
        if ($data['paid_amount'] == $_POST['request_amount']) {
          $payment['request_status'] = 'done';
          $payment['payment_date'] = current_datetime();
          $this->common_model->update_by_node($payment, 'request_id', $data['request_id'],'payment_request');
          $this->common_model->insert($data, 'payment_details');
        }else{
          $payment['request_status'] = 'pending';
          $payment['payment_date'] = current_datetime();
          $this->common_model->update_by_node($payment, 'request_id', $data['request_id'],'payment_request');
          $this->common_model->insert($data, 'payment_details');
        }
        $this->session->set_flashdata('msg', 'Requested Amount Pay Successfully');
        redirect(base_url('admin2/payment'));
      }
    }

    public function create_payment(){
        $data = array();
        $data['page_title'] = 'New payment';
        $data['main_content'] = $this->load->view('admin/payment/create_payment', $data, TRUE);
        $this->load->view('admin/index', $data);
    }


}
