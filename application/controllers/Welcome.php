<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index($msg = NULL)
	{ 
        $data['msg'] = $msg;
        $this->load->view('includes/header');
        $this->load->view('access/admin/login');
        $this->load->view('includes/footer');
	}
}
