<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class asset_rph extends CI_Controller {

	public function index() {
		if($this->session->userdata('hak_akses') == "admin") {
			$d['combo_barang'] = $this->App_model->get_combo_barang();
			$d['combo_rph'] = $this->App_model->get_combo_rph();
			$d['asset_rph'] = $this->App_model->get_asset_rph();
			$d['barang'] = $this->App_model->get_barang_by_name();
			$d['judul'] = 'Data Asset RPH';
			$d['color'] = '';		
			$d['tipe'] = 'add';
			$this->load->view('top',$d);
			$this->load->view('menu');
			$this->load->view('asset_rph/asset_rph_tabel.php');
			$this->load->view('bottom');
		}
		else {
			redirect("login");
		}
	}


	public function save() {
		if($this->session->userdata('hak_akses') == "admin") {
				
			$where['id_asset_rph'] 	= $this->input->post('id_asset_rph');
			$in['id_rph'] 			= $this->input->post('id_rph');
			$in['id_barang'] 		= $this->input->post('id_barang');
			$in['jumlah_barang'] 	= $this->input->post('jumlah_barang');
			$in['tanggal'] 	= $this->input->post('tanggal');
			$in['keadaan_barang'] 	= $this->input->post('keadaan_barang');
			$in['keterangan'] 	= $this->input->post('keterangan');


			$ir['id_barang'] 		= $this->input->post('id_barang');
			$ir['keadaan_barang'] 	= $this->input->post('keadaan_barang');
			$ir['tanggal'] 			= $this->input->post('tanggal');
			$ir['keterangan'] 			= $this->input->post('keterangan');
			$ir['id_rph'] 				= $this->input->post('id_rph');

			$cek = $this->db->query("SELECT id_barang FROM asset_rph WHERE id_barang = '$in[id_barang]'");
			if($cek->num_rows() > 0) {
				$this->session->set_flashdata("error","Barang sudah pakai");
			} else {
				$this->db->insert("asset_rph",$in);
				$this->db->insert("asset_rph_kondisi",$ir);	
			}
			redirect("asset_rph");
		} else {
			redirect("login");
		}
	}



	public function ubah_kondisi() {
		if($this->session->userdata('hak_akses') == "admin") {
			$in['keadaan_barang'] 			= $this->input->post('keadaan_barang');
			$in['tanggal'] 					= $this->input->post('tanggal');
			$in['keterangan'] 				= $this->input->post('keterangan');
			$in['id_barang'] 				= $this->input->post('id_barang');		
			$in['id_rph'] 					= $this->input->post('id_rph');

			$where2['id_asset_rph'] 		= $this->input->post('id_asset_rph');
			$in2['keadaan_barang'] 			= $this->input->post('keadaan_barang');
			$in2['keterangan'] 				= $this->input->post('keterangan');
			$in2['tanggal'] 				= $this->input->post('tanggal');
			$in2['id_barang'] 				= $this->input->post('id_barang');

			$this->db->insert("asset_rph_kondisi",$in);
			$this->db->update("asset_rph",$in2,$where2);
			redirect("asset_rph");
		} else {
			redirect("login");
		}	
	}


	public function mutasi_asset() {
		if($this->session->userdata('hak_akses') == "admin") {
			$in['tanggal'] 				= $this->input->post('tanggal');
			$in['id_rph'] 				= $this->input->post('id_rph');
			$in['rph_penerima'] 		= $this->input->post('rph_penerima');
			$in['keterangan'] 			= $this->input->post('keterangan');
			$in['id_barang'] 			= $this->input->post('id_barang');

			$where2['id_asset_rph'] 	= $this->input->post('id_asset_rph');
			$in2['id_rph'] 				= $this->input->post('rph_penerima');
			$in2['keterangan'] 				= $this->input->post('keterangan');
			$in2['tanggal'] 				= $this->input->post('tanggal');

			$this->db->insert("asset_rph_mutasi",$in);
			$this->db->update("asset_rph",$in2,$where2);
			//$this->session->set_flashdata("success","Kondisi Asset Berhasil Diubah");
			redirect("asset_rph");	
		} else {
			redirect("login");
		}	
	}

	public function replacement_asset() {
		if($this->session->userdata('hak_akses') == "admin") {
			$in['tanggal'] 					= $this->input->post('tanggal');
			$in['id_rph'] 				= $this->input->post('id_rph');
			$in['id_barang'] 				= $this->input->post('id_barang');
			$in['barang_pengganti'] 			= $this->input->post('barang_pengganti');
			$in['keterangan'] 				= $this->input->post('keterangan');

			$where2['id_asset_rph'] 		= $this->input->post('id_asset_rph');
			$in2['id_barang'] 				= $this->input->post('barang_pengganti');
			$in2['keterangan'] 				= $this->input->post('keterangan');
			$in2['tanggal'] 				= $this->input->post('tanggal');
			$in2['keadaan_barang'] 			= "Baik";

			$this->db->insert("asset_rph_replacement",$in);
			$this->db->update("asset_rph",$in2,$where2);
			//$this->session->set_flashdata("success","Kondisi Asset Berhasil Diubah");
			redirect("asset_rph");	
		} else {
			redirect("login");
		}	
	}

	public function hapus_asset($id) {
		if($this->session->userdata('hak_akses') == "admin" && $id != null) {
			$this->db->delete("asset_rph",array('id_asset_rph' => $id));				
			$this->session->set_flashdata("success","Hapus Asset Berhasil");
			redirect("asset_rph");			
		} else {
			redirect("login");
		}
	}
}
