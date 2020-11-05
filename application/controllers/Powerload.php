<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class powerload extends CI_Controller {

	public function index() {
		if($this->session->userdata('hak_akses') == "awo") {
			$id_awo = $this->session->userdata("id_awo");
			$d['powerload'] = $this->App_model->get_powerload($id_awo);
			$d['judul'] = 'Data Powerload';
			$d['color'] = '';	
			$d['id_transfer'] = '';
			$d['name_button'] = 'Tambah';
			$d['disabled'] = 'disabled';	
			$d['tipe'] = 'add';
			$d['id_powerload'] = 'add';
			$d['combo_rph'] = $this->App_model->get_combo_rph_awo();
			$d['id_powerload'] = "";
			$d['id_rph'] = "";
			$d['merah'] = "";
			$d['orange'] = "";
			$d['hitam'] = "";
			$d['kuning'] = "";
			$d['color'] = '';
			$d['tanggal'] = '';
			$this->load->view('top',$d);
			$this->load->view('menu');
			$this->load->view('powerload/powerload_tabel.php');
			$this->load->view('bottom');
		}
		else {
			redirect("login");
		}
	}

	public function edit($id) {
		if($this->session->userdata('hak_akses') == "awo" && $id != null) {
			$id_rph = $this->session->userdata("id_awo");
			$d['powerload'] = $this->App_model->get_powerload($id_rph);
			$where['id_powerload'] = $id;
			$get_id = $this->db->get_where("powerload",$where)->row();		
			$d['judul'] = 'Edit Data Powerload';			
			$d['tipe'] = 'edit';
			$d['name_button'] = 'Edit';
			$d['disabled'] = '';
			$d['id_powerload'] = $get_id->id_powerload;
			$d['combo_rph'] = $this->App_model->get_combo_rph_awo($get_id->id_rph);
			$d['tanggal'] = $get_id->tanggal;
			$d['merah'] = $get_id->merah;
			$d['orange'] = $get_id->orange;
			$d['hitam'] = $get_id->hitam;
			$d['kuning'] = $get_id->kuning;
			$d['color'] = 'background:#ffffe1;';

			$this->load->view('top');
			$this->load->view('menu',$d);
			$this->load->view('powerload/powerload_tabel');
			$this->load->view('bottom');			
		} else {
			redirect("login");
		}
	}

	public function save() {
		if($this->session->userdata('hak_akses') == "awo") {
			$where['id_powerload'] 	= $this->input->post('id_powerload');
			$in['id_awo'] 			= $this->session->userdata("id_awo");
			$in['id_rph'] 			= $this->input->post('id_rph');
			$in['tanggal'] 		= $this->input->post('tanggal');
			$in['merah'] = $this->input->post('merah');
			$in['orange'] 	= $this->input->post('orange');
			$in['hitam'] 	= $this->input->post('hitam');
			$in['kuning'] 	= $this->input->post('kuning');

			if($tipe == 'add') {
				$this->db->insert("powerload",$in);
				$this->session->set_flashdata("success","Input Data Powerload Berhasil");
				redirect("powerload");
			} else if($tipe == 'edit') {
				$this->db->update("powerload",$in,$where);
				$this->session->set_flashdata("success","Edit Data Poerload Berhasil");
				redirect("powerload");
			} else {
				redirect("login");
			}
		} else {
			redirect("login");
		}
	}

	public function hapus($id) {
		if($this->session->userdata('hak_akses') == "awo" && $id != null) {
			$this->db->delete("powerload",array('id_powerload' => $id));				
			$this->session->set_flashdata("success","Hapus Data Asset AWO Berhasil");
			redirect("powerload");			
		} else {
			redirect("login");
		}
	}


	public function kartu_stok() {
		if($this->session->userdata('hak_akses') == "admin") {
			$d['judul'] = 'Laporan Kartu Stok Powerload';
			$d['kartu_stok'] = '';		
			$d['tanggal1'] = '';
			$d['tanggal2'] = '';
			$d['combo_rph'] = $this->App_model->get_combo_rph_awo();
			$d['id_rph'] = '';
			$this->load->view('top',$d);
			$this->load->view('menu');
			$this->load->view('powerload/kartu_stok');
			$this->load->view('bottom');
		}
		else {
			redirect("login");
		}
	}

	public function lihat_kartu_stok() {
		if($this->session->userdata('hak_akses') == "admin") {
			$d['judul'] = 'Laporan Kartu Stok Powerload';
			$d['kartu_stok'] = '';		
			$d['tanggal1'] = $this->input->post("tanggal1");
			$d['tanggal2'] = $this->input->post("tanggal2");
			$d['combo_rph'] = $this->App_model->get_combo_rph_awo($this->input->post("id_rph"));
			$d['id_rph'] = $this->input->post("id_rph");
			$this->load->view('top',$d);
			$this->load->view('menu');
			$this->load->view('powerload/kartu_stok');
			$this->load->view('bottom');
		}
		else {
			redirect("login");
		}
	}

	public function kartu_stok_awo() {
		if($this->session->userdata('hak_akses') == "awo") {
			$d['judul'] = 'History Penggunaan Powerload';
			$d['kartu_stok'] = '';		
			$d['tanggal1'] = '';
			$d['tanggal2'] = '';
			$d['combo_rph'] = $this->App_model->get_combo_rph_awo($this->session->userdata("id_rph"));
			$d['id_rph'] = $this->session->userdata("id_rph");
			$this->load->view('top',$d);
			$this->load->view('menu');
			$this->load->view('powerload/kartu_stok_awo');
			$this->load->view('bottom');
		}
		else {
			redirect("login");
		}
	}

	public function lihat_kartu_stok_awo() {
		if($this->session->userdata('hak_akses') == "awo") {
			$d['judul'] = 'History Penggunaan Powerload';
			$d['kartu_stok'] = '';		
			$d['tanggal1'] = $this->input->post("tanggal1");
			$d['tanggal2'] = $this->input->post("tanggal2");
			$d['combo_rph'] = $this->App_model->get_combo_rph_awo($this->input->post("id_rph"));
			$d['id_rph'] = $this->input->post("id_rph");
			$this->load->view('top',$d);
			$this->load->view('menu');
			$this->load->view('powerload/kartu_stok_awo');
			$this->load->view('bottom');
		}
		else {
			redirect("login");
		}
	}

}
