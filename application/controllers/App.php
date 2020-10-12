<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class app extends CI_Controller {
	public function index() {
		if($this->session->userdata('id') != "") {
			$this->load->view('top');
			$this->load->view('menu');
			$this->load->view('dashboard/dashboard');
			$this->load->view('bottom');
		} else {
			redirect("login");
		}	
	}
}
