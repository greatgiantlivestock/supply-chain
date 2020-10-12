<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class asset_awo extends CI_Controller {

	public function index() {
		if($this->session->userdata('hak_akses') == "admin") {
			$d['combo_barang'] = $this->App_model->get_combo_barang();
			$d['combo_awo'] = $this->App_model->get_combo_awo();
			$d['asset_awo'] = $this->App_model->get_asset_awo();
			$d['barang'] = $this->App_model->get_barang_by_name();
			$d['judul'] = 'Data Asset AWO';
			$d['color'] = '';		
			$d['tipe'] = 'add';
			$this->load->view('top',$d);
			$this->load->view('menu');
			$this->load->view('asset_awo/asset_awo_tabel.php');
			$this->load->view('bottom');
		}
		else {
			redirect("login");
		}
	}


	public function save() {
		if($this->session->userdata('hak_akses') == "admin") {
			
			$tipe = $this->input->post("tipe");	
			$get_identitas = explode("-", $this->input->post("barang"));
			$where['id_asset_awo'] 	= $this->input->post('id_asset_awo');
			$in['id_awo'] 			= $this->input->post('id_awo');
			$in['id_barang'] 		= $this->input->post('id_barang');
			$in['jumlah_barang'] 	= $this->input->post('jumlah_barang');
			$in['tanggal'] 	= $this->input->post('tanggal');
			$in['keadaan_barang'] 	= $this->input->post('keadaan_barang');
			$in['keterangan'] 	= $this->input->post('keterangan');

			$ir['id_awo'] 			= $this->input->post('id_awo');
			$ir['id_barang'] 		= $this->input->post('id_barang');
			$ir['keadaan_barang'] 	= $this->input->post('keadaan_barang');
			$ir['tanggal'] 			= $this->input->post('tanggal');

			$cek = $this->db->query("SELECT id_barang FROM asset_awo WHERE id_barang = '$in[id_barang]'");
			if($cek->num_rows() > 0) {
				$this->session->set_flashdata("error","Barang sudah pakai");
			} else {
				$this->db->insert("asset_awo",$in);
				$this->db->insert("asset_awo_kondisi",$ir);	
			}
			redirect("asset_awo");
		} else {
			redirect("login");
		}
	}




	public function ubah_kondisi() {
		if($this->session->userdata('hak_akses') == "admin") {
			$in['id_awo'] 			= $this->input->post('id_awo');
			$in['id_barang'] 		= $this->input->post('id_barang');
			$in['keadaan_barang'] 	= $this->input->post('keadaan_barang');
			$in['tanggal'] 			= $this->input->post('tanggal');
			$in['keterangan'] 		= $this->input->post('keterangan');

			$where2['id_asset_awo'] = $this->input->post('id_asset_awo');
			$in2['keadaan_barang'] 	= $this->input->post('keadaan_barang');
			$in2['keterangan'] 		= $this->input->post('keterangan');
			$in2['tanggal'] 		= $this->input->post('tanggal');

			$this->db->insert("asset_awo_kondisi",$in);
			$this->db->update("asset_awo",$in2,$where2);
			redirect("asset_awo");
		} else {
			redirect("login");
		}	
	}


	public function mutasi_asset() {
		if($this->session->userdata('hak_akses') == "admin") {
			$in['tanggal'] 					= $this->input->post('tanggal');
			$in['id_awo'] 					= $this->input->post('id_awo');
			$in['id_barang'] 				= $this->input->post('id_barang');
			$in['awo_penerima'] 			= $this->input->post('awo_penerima');
			$in['keterangan'] 				= $this->input->post('keterangan');

			$where2['id_asset_awo'] 	= $this->input->post('id_asset_awo');
			$in2['id_awo'] 				= $this->input->post('awo_penerima');
			$in2['keterangan'] 				= $this->input->post('keterangan');
			$in2['tanggal'] 				= $this->input->post('tanggal');

			//$this->db->delete("asset_awo",$where2);			
			$this->db->update("asset_awo",$in2,$where2);
			$this->db->insert("asset_awo_mutasi",$in);
			redirect("asset_awo");	
		} else {
			redirect("login");
		}	
	}

	public function replacement_asset() {
		if($this->session->userdata('hak_akses') == "admin") {
			$in['tanggal'] 					= $this->input->post('tanggal');
			$in['id_awo'] 					= $this->input->post('id_awo');
			$in['id_barang'] 				= $this->input->post('id_barang');
			$in['barang_pengganti'] 			= $this->input->post('barang_pengganti');
			$in['keterangan'] 				= $this->input->post('keterangan');

			$where2['id_asset_awo'] 		= $this->input->post('id_asset_awo');
			$in2['id_barang'] 				= $this->input->post('barang_pengganti');
			$in2['keterangan'] 				= $this->input->post('keterangan');
			$in2['tanggal'] 				= $this->input->post('tanggal');
			$in2['keadaan_barang'] 			= "Baik";

			$this->db->insert("asset_awo_replacement",$in);
			$this->db->update("asset_awo",$in2,$where2);
			//$this->session->set_flashdata("success","Kondisi Asset Berhasil Diubah");
			redirect("asset_awo");	
		} else {
			redirect("login");
		}	
	}

	public function hapus_asset($id) {
		if($this->session->userdata('hak_akses') == "admin" && $id != null) {
			$this->db->delete("asset_awo",array('id_asset_awo' => $id));				
			$this->session->set_flashdata("success","Hapus Asset Berhasil");
			redirect("asset_awo");			
		} else {
			redirect("login");
		}
	}
}
