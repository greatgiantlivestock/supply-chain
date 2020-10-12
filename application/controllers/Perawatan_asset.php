<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class perawatan_asset extends CI_Controller {

public function index() {
		if($this->session->userdata('hak_akses') == "admin") {
			$d['perawatan_asset'] = $this->App_model->get_perawatan_asset();
			$d['judul'] = 'Data Perawatan Asset';		
			$this->load->view('top',$d);
			$this->load->view('menu');
			$this->load->view('perawatan_asset/perawatan_asset_tabel');
			$this->load->view('bottom');
		}
		else {
			redirect("login");
		}
	}

	public function add() {
		if($this->session->userdata('hak_akses') == "admin") {
			$d['judul'] = 'Tambah Data Perawatan Asset';	
			$d['tipe'] = 'add';
			$d['id_perawatan'] = '';
			$d['combo_barang'] = $this->App_model->get_combo_barang();
			$d['tanggal_rusak'] = '';
			$d['tanggal_perbaiki'] = '';
			$d['keterangan'] = '';
			$this->load->view('top',$d);	
			$this->load->view('menu');
			$this->load->view('perawatan_asset/perawatan_asset_input');
			$this->load->view('bottom');
		}
		else {
			redirect("login");
		}
	}

	public function edit($id) {
		if($this->session->userdata('hak_akses') == "admin" && $id != null) {
			$where['id_perawatan'] = $id;
			$get_id = $this->db->get_where("perawatan_asset",$where)->row();		
			$d['judul'] = 'Edit Data Perawatan Asset';			
			$d['tipe'] = 'edit';
			$d['id_perawatan'] = $get_id->id_perawatan;
			$d['combo_barang'] = $this->App_model->get_combo_barang($get_id->id_barang);
			$d['tanggal_rusak'] = $get_id->tanggal_rusak;
			$d['keterangan'] = $get_id->keterangan;

			$this->load->view('top');
			$this->load->view('menu',$d);
			$this->load->view('perawatan_asset/perawatan_asset_input');
			$this->load->view('bottom');			
		} else {
			redirect("login");
		}
	}


	public function save() {
		if($this->session->userdata('hak_akses') == "admin") {
			$required = array('id_barang','tanggal_rusak');
			$error = false;
			foreach($required as $field) {
				if(empty($_POST[$field])) {
					$error = true;
				}
			}
			$tipe = $this->input->post("tipe");	
			$where['id_perawatan'] 	= $this->input->post('id_perawatan');
			$in['id_barang'] 		= $this->input->post('id_barang');
			$in['tanggal_rusak'] 		= $this->input->post('tanggal_rusak');
			$in['keterangan'] 		= $this->input->post('keterangan');

			$cek = $this->db->query("SELECT * FROM perawatan_asset WHERE id_barang = '$in[id_barang]' AND status = '0'");

			if($tipe == "add") {				
				if($cek->num_rows() > 0) {
					$this->session->set_flashdata("error","Barang masih di perbaiki");
					redirect("perawatan_asset/add");	
				}else if($error) {
					$this->session->set_flashdata("error","Inputan Barang & Tanggal Rusak tidak boleh kosong");
					redirect("perawatan_asset/add");	
				} else {
					$this->db->insert("perawatan_asset",$in);
					$this->session->set_flashdata("success","Input Data Perawatan Asset Berhasil");
					redirect("perawatan_asset");
				}
			} elseif($tipe = 'edit') {
				if($error) {
					$this->session->set_flashdata("error","Inputan Barang & Tanggal Rusak tidak boleh kosong");
					redirect("perawatan_asset/edit/".$this->input->post('id_perawatan'));	
				} else {
					$this->db->update("perawatan_asset",$in,$where);
					$this->session->set_flashdata("success","Edit Data Perawatan Asset Berhasil");
					redirect("perawatan_asset");
				}		
			} else {
				redirect("perawatan_asset");
			}
		} else {
			redirect("login");
		}
	}

	public function hapus($id) {
		if($this->session->userdata('hak_akses') == "admin" && $id != null) {
			$this->db->delete("perawatan_asset",array('id_perawatan' => $id));				
			$this->session->set_flashdata("success","Hapus Data Perawatan Asset Berhasil");
			redirect("perawatan_asset");			
		} else {
			redirect("login");
		}
	}

	public function update_tanggal() {
		if($this->session->userdata('hak_akses') == "admin") {
			$where['id_perawatan'] = $this->input->post("id_perawatan");
			$in['tanggal_perbaiki'] = $this->input->post("tanggal_perbaiki");
			$in['status'] = '1';
			$in['keterangan'] = $this->input->post("keterangan");
			$this->db->update("perawatan_asset",$in,$where);				
			$this->session->set_flashdata("success","Update Tanggal Berhasil");
			redirect("perawatan_asset");			
		} else {
			redirect("login");
		}
	}


}
