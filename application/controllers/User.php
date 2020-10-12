<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class User extends CI_Controller {
public function index() {
		if($this->session->userdata('hak_akses') == "admin") {
			$d['awo'] = $this->App_model->get_user();
			$d['judul'] = 'DATA LOGIN';		
			$this->load->view('top',$d);
			$this->load->view('menu');
			$this->load->view('user/user_tabel.php');
			$this->load->view('bottom');
		}
		else {
			redirect("login");
		}
	}
	public function add() {
		if($this->session->userdata('hak_akses') == "admin") {
			$d['judul'] = 'Tambah Data LOGIN';	
			$d['tipe'] = 'add';
			$d['username'] = '';
			$d['password'] = '';
			$d['id_login'] = '';
			$d['combo_karyawan'] = $this->App_model->get_combo_karyawan();
			$d['combo_role'] = $this->App_model->get_combo_role();
			$this->load->view('top',$d);	
			$this->load->view('menu');
			$this->load->view('user/user_input');
			$this->load->view('bottom');
		}
		else {
			redirect("login");
		}
	}
	public function edit($id=null) {
		if($this->session->userdata('hak_akses') == "admin" && $id != null) {
			$where['id_login'] = $id;
			$get_id = $this->db->get_where("mst_login",$where)->row();		
			$d['judul'] = 'Edit Data User Login';			
			$d['tipe'] = 'edit';
			$d['combo_karyawan'] = $this->App_model->get_combo_karyawan($get_id->id_awo);
			$d['combo_role'] = $this->App_model->get_combo_role($get_id->id_role);
			$d['username'] = $get_id->username;
			$d['password'] = $get_id->password;
			$d['id_login'] = $id;
			$this->load->view('top');
			$this->load->view('menu',$d);
			$this->load->view('user/user_input');
			$this->load->view('bottom');			
		} else {
			redirect("login");
		}
	}
	public function save() {
		if($this->session->userdata('hak_akses') == "admin") {
			$required = array('id_awo','id_role','username');
			$error = false;
			foreach($required as $field) {
				if(empty($_POST[$field])) {
					$error = true;
				}
			}
			$tipe = $this->input->post("tipe");	
			$where['id_login'] 	= $this->input->post('id_login');
			$id_awo = $this->input->post('id_awo');
			$qawo = $this->db->query("SELECT * FROM mst_awo WHERE id_awo='$id_awo'")->row();
			$in['nama'] 		= $qawo->nama_awo;
			$in['id_awo'] 		= $this->input->post('id_awo');
			$in['id_role'] 		= $this->input->post('id_role');
			$in['username'] 		= $this->input->post('username');
			$in['password'] 		= md5($this->input->post('password'));
			
			if($tipe == "add") {	
				$cek_mac = $this->db->query("SELECT * FROM mst_login WHERE username = '$in[username]'");
				if($cek_mac->num_rows() > 0) {
					$this->session->set_flashdata("error","Username sudah digunakan");
					redirect("User/add");	
				}else{			
					if($error) {
						$this->session->set_flashdata("error","Complete field please");
						redirect("User/add");	
					} else {
						$this->db->insert("mst_login",$in);
						$this->session->set_flashdata("success","Input User Login Berhasil");
						redirect("User");
					}
				}
			} else if($tipe = 'edit') {
				if($error) {
					$this->session->set_flashdata("error","Complete Field Please");
					redirect("User/edit/".$this->input->post('id_login'));	
				} else {				
					$in1['id_awo'] = $this->input->post('id_awo');
					$in1['id_role'] = $this->input->post('id_role');	
					$password = $this->input->post('password');	
					$id_login =$this->input->post('id_login');
					$qpass = $this->db->query("SELECT * FROM mst_login WHERE id_login='$id_login'")->row();
					if($qpass->password!=$password){
						$in1['password'] = md5($this->input->post('password'));
					}
					$this->db->update("mst_login",$in1,$where);
					$this->session->set_flashdata("success","Edit Data User Login Berhasil");
					redirect("User");
				}		
			} else {
				redirect("User");
			}
		} else {
			redirect("Login");
		}
	}
	public function hapus($id) {
		if($this->session->userdata('hak_akses') == "admin" && $id != null) {
			$this->db->delete("mst_login",array('id_login' => $id));				
			$this->session->set_flashdata("success","Hapus Data Login User Berhasil");
			redirect("User");			
		} else {
			redirect("Login");
		}
	}
}
