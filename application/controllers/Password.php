<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class password extends CI_Controller {

public function index() {
		if($this->session->userdata('id') != "") {
			$d['judul'] = 'Ganti Password';		
			$d['id'] = $this->session->userdata('id');
			$d['password'] = '';
			$this->load->view('top',$d);
			$this->load->view('menu');
			$this->load->view('password/password_input.php');
			$this->load->view('bottom');
		}
		else {
			redirect("login");
		}
	}



	public function save() {
		if($this->session->userdata('hak_akses') == "keuangan" || $this->session->userdata('hak_akses') == "administrasi") {
			$required = array('password');
			$error = false;
			foreach($required as $field) {
				if(empty($_POST[$field])) {
					$error = true;
				}
			}
			$where['nik'] 	= $this->session->userdata('id');
			$in['password'] = $this->input->post('password');

			if($error) {
				$this->session->set_flashdata("error","Inputan ('password') tidak boleh kosong");
				redirect("password");	
			} else {
				$this->db->update("tbl_pegawai",$in,$where);
				$this->session->set_flashdata("success","Update Password Berhasil");
				redirect("password");
			}			
		} elseif($this->session->userdata('hak_akses') == "admin") { 
			$required = array('password');
			$error = false;
			foreach($required as $field) {
				if(empty($_POST[$field])) {
					$error = true;
				}
			}
			$where['id_admin'] 	= $this->session->userdata('id');
			$in['password'] = md5($this->input->post('password'));

			if($error) {
				$this->session->set_flashdata("error","Inputan ('password') tidak boleh kosong");
				redirect("password");	
			} else {
				$this->db->update("tbl_admin",$in,$where);
				$this->session->set_flashdata("success","Update Password Berhasil");
				redirect("password");
			}			
		} elseif($this->session->userdata('hak_akses') == "koordinator") { 
			$required = array('password');
			$error = false;
			foreach($required as $field) {
				if(empty($_POST[$field])) {
					$error = true;
				}
			}
			$where['nidn'] 	= $this->session->userdata('id');
			$in['password'] = $this->input->post('password');

			if($error) {
				$this->session->set_flashdata("error","Inputan ('password') tidak boleh kosong");
				redirect("password");	
			} else {
				$this->db->update("tbl_dosen",$in,$where);
				$this->session->set_flashdata("success","Update Password Berhasil");
				redirect("password");
			}			
		} elseif($this->session->userdata('hak_akses') == "mahasiswa") { 
			$required = array('password');
			$error = false;
			foreach($required as $field) {
				if(empty($_POST[$field])) {
					$error = true;
				}
			}
			$where['nim'] 	= $this->session->userdata('id');
			$in['password'] = $this->input->post('password');

			if($error) {
				$this->session->set_flashdata("error","Inputan ('password') tidak boleh kosong");
				redirect("password");	
			} else {
				$this->db->update("tbl_mahasiswa",$in,$where);
				$this->session->set_flashdata("success","Update Password Berhasil");
				redirect("password");
			}			
		} else {
			redirect("login");
		}
	}
}
