<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//LOCATION : application - controller - Home.php

class Home extends CI_Controller {

    public function __construct(){
        parent::__construct();
        if (check()) {
          redirect(base_url('admin'));
        } else {
          redirect(base_url('login'));
        }
    }
    public function index(){}

}
