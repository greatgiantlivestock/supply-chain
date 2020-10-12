<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class laporan_asset_rph extends CI_Controller {

	public function index() {
		redirect(base_url());
	}

	public function kartu_inventaris() {
		if($this->session->userdata('hak_akses') == "admin") {
			$d['judul'] = 'Laporan Kartu Inventaris RPH';
			$d['kartu_inventaris'] = '';		
			$d['tanggal'] = '';
			$this->load->view('top',$d);
			$this->load->view('menu');
			$this->load->view('laporan_asset_rph/kartu_inventaris');
			$this->load->view('bottom');
		}
		else {
			redirect("login");
		}
	}

	public function lihat_kartu_inventaris() {
		if($this->session->userdata('hak_akses') == "admin") {
			$d['tanggal'] = $this->input->post("tanggal");
			$d['judul'] = 'Laporan Kartu Inventaris RPH';
			$d['kartu_inventaris'] = $this->App_model->get_kartu_inventaris_rph($d['tanggal']);
			$this->load->view('top',$d);
			$this->load->view('menu');
			$this->load->view('laporan_asset_rph/kartu_inventaris');
			$this->load->view('bottom');
		}
		else {
			redirect("login");
		}
	}

	public function kondisi_asset() {
		if($this->session->userdata('hak_akses') == "admin") {
			$d['judul'] = 'Laporan Kondisi Asset RPH';
			$d['kondisi_asset'] = '';		
			$d['tanggal1'] = '';
			$d['tanggal2'] = '';
			$d['checkeda'] = '';
			$d['checkedb'] = '';
			$d['checkedc'] = '';
			$d['combo_rph'] = $this->App_model->get_combo_rph_report();
			$d['combo_barang'] = $this->App_model->get_combo_barang_report();
			$this->load->view('top',$d);
			$this->load->view('menu');
			$this->load->view('laporan_asset_rph/kondisi_asset');
			$this->load->view('bottom');
		}
		else {
			redirect("login");
		}
	}

	public function lihat_kondisi_asset() {
		if($this->session->userdata('hak_akses') == "admin") {
			$d['tanggal1'] = $this->input->post("tanggal1");
			$d['tanggal2'] = $this->input->post("tanggal2");

			

			$d['judul'] = 'Laporan Kondisi Asset RPH';

			$d['checkeda'] = '';
			$d['checkedb'] = '';
			$d['checkedc'] = '';

			$d['combo_rph'] = $this->App_model->get_combo_rph_report($this->input->post("nama_rph"));
			$d['combo_barang'] = $this->App_model->get_combo_barang_report($this->input->post("nama_barang"));

			if($this->input->post("keadaan_barang") == 'Baik') {
				$d['checkeda'] = 'checked';
				$keadaan_barang = 'Baik';
			} else if($this->input->post("keadaan_barang") == 'Rusak') {
				$d['checkedc'] = 'checked';
				$keadaan_barang = 'Rusak';
			} else {
				$keadaan_barang = '';
			}

			if($this->input->post("nama_barang") != "") {
				$nama_barang = $this->input->post("nama_barang");
			} else {
				$nama_barang = '';
			}

			if($this->input->post("nama_rph") != "") {
				$nama_rph = $this->input->post("nama_rph");
			} else {
				$nama_rph = '';
			}

			if($this->input->post("nama_barang") != "") {
				$d['kondisi_asset'] = $this->App_model->get_kondisi_asset_rph($d['tanggal1'],$d['tanggal2'],$keadaan_barang,$nama_barang,$nama_rph);
			} else {
				$d['kondisi_asset'] = $this->App_model->get_kondisi_asset_rph_all($d['tanggal1'],$d['tanggal2'],$keadaan_barang,$nama_rph);
			}
			$this->load->view('top',$d);
			$this->load->view('menu');
			$this->load->view('laporan_asset_rph/kondisi_asset');
			$this->load->view('bottom');
		}
		else {
			redirect("login");
		}
	}

	public function mutasi_asset() {
		if($this->session->userdata('hak_akses') == "admin") {
			$d['judul'] = 'Laporan Mutasi Asset RPH';
			$d['mutasi_asset'] = '';		
			$d['tanggal1'] = '';
			$d['tanggal2'] = '';
			$d['combo_barang'] = $this->App_model->get_combo_barang_report();
			$this->load->view('top',$d);
			$this->load->view('menu');
			$this->load->view('laporan_asset_rph/mutasi_asset');
			$this->load->view('bottom');
		}
		else {
			redirect("login");
		}
	}

	public function lihat_mutasi_asset() {
		if($this->session->userdata('hak_akses') == "admin") {
			$d['tanggal1'] 		= $this->input->post("tanggal1");
			$d['tanggal2'] 		= $this->input->post("tanggal2");
			$d['nama_barang'] 	= $this->input->post("nama_barang");

			

			$d['judul'] = 'Laporan Mutasi Asset RPH';

			$d['combo_barang'] = $this->App_model->get_combo_barang_report($this->input->post("nama_barang"));



			if($this->input->post("nama_barang") != "") {
				$nama_barang = $this->input->post("nama_barang");
				$d['mutasi_asset'] = $this->App_model->get_mutasi_asset_rph($d['tanggal1'],$d['tanggal2'],$nama_barang);
			} else {
				$nama_barang = '';				
				$d['mutasi_asset'] = $this->App_model->get_mutasi_asset_rph_all($d['tanggal1'],$d['tanggal2']);
			}

			

			$this->load->view('top',$d);
			$this->load->view('menu');
			$this->load->view('laporan_asset_rph/mutasi_asset');
			$this->load->view('bottom');
		}
		else {
			redirect("login");
		}
	}

	public function replacement_asset() {
		if($this->session->userdata('hak_akses') == "admin") {
			$d['judul'] = 'Laporan Replacement Asset RPH';
			$d['replacement_asset'] = '';		
			$d['tanggal1'] = '';
			$d['tanggal2'] = '';
			$d['combo_barang'] = $this->App_model->get_combo_barang_report();
			$d['combo_rph'] = $this->App_model->get_combo_rph_report();
			$this->load->view('top',$d);
			$this->load->view('menu');
			$this->load->view('laporan_asset_rph/replacement_asset');
			$this->load->view('bottom');
		}
		else {
			redirect("login");
		}
	}

	public function lihat_replacement_asset() {
		if($this->session->userdata('hak_akses') == "admin") {
			$d['tanggal1'] 		= $this->input->post("tanggal1");
			$d['tanggal2'] 		= $this->input->post("tanggal2");
			$d['nama_barang'] 	= $this->input->post("nama_barang");
			$d['nama_rph'] 	= $this->input->post("nama_rph");

			

			$d['judul'] = 'Laporan Replacement Asset RPH';

			$d['combo_barang'] = $this->App_model->get_combo_barang_report($this->input->post("nama_barang"));
			$d['combo_rph'] = $this->App_model->get_combo_rph_report($this->input->post("nama_rph"));



			if($this->input->post("nama_barang") != "") {
				$nama_barang = $this->input->post("nama_barang");
			} else {
				$nama_barang = '';
			}

			if($this->input->post("nama_rph") != "") {
				$nama_rph = $this->input->post("nama_rph");
			} else {
				$nama_rph = '';
			}

			if($this->input->post("nama_barang") != "") {
				$d['replacement_asset'] = $this->App_model->get_replacement_asset_rph($d['tanggal1'],$d['tanggal2'],$nama_barang,$nama_rph);
			} else {
				$d['replacement_asset'] = $this->App_model->get_replacement_asset_rph_all($d['tanggal1'],$d['tanggal2'],$nama_rph);
			}

			$this->load->view('top',$d);
			$this->load->view('menu');
			$this->load->view('laporan_asset_rph/replacement_asset');
			$this->load->view('bottom');
		}
		else {
			redirect("login");
		}
	}

}
