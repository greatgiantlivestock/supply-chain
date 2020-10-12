<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_asset_awo extends CI_Controller {

	public function index() {
		redirect(base_url());
	}

	public function kartu_asset() {
		if($this->session->userdata('hak_akses') == "admin") {
			$d['judul'] = 'Laporan Kartu Asset AWO';
			$d['kartu_asset'] = '';		
			$d['tanggal'] = '';
			$this->load->view('top',$d);
			$this->load->view('menu');
			$this->load->view('laporan_asset_awo/kartu_asset');
			$this->load->view('bottom');
		}
		else {
			redirect("login");
		}
	}

	public function lihat_kartu_asset() {
		if($this->session->userdata('hak_akses') == "admin") {
			$d['tanggal'] = $this->input->post("tanggal");
			$d['judul'] = 'Laporan Kartu Asset AWO';
			$d['kartu_asset'] = $this->App_model->get_kartu_asset_awo($d['tanggal']);
			$this->load->view('top',$d);
			$this->load->view('menu');
			$this->load->view('laporan_asset_awo/kartu_asset');
			$this->load->view('bottom');
		}
		else {
			redirect("login");
		}
	}

	public function kondisi_asset() {
		if($this->session->userdata('hak_akses') == "admin") {
			$d['judul'] = 'Laporan Kondisi Asset AWO';
			$d['kondisi_asset'] = '';		
			$d['tanggal1'] = '';
			$d['tanggal2'] = '';
			$d['checkeda'] = '';
			$d['checkedb'] = '';
			$d['checkedc'] = '';
			$d['combo_awo'] = $this->App_model->get_combo_awo_report();
			$d['combo_barang'] = $this->App_model->get_combo_barang_report();
			$this->load->view('top',$d);
			$this->load->view('menu');
			$this->load->view('laporan_asset_awo/kondisi_asset');
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

			

			$d['judul'] = 'Laporan Kondisi Asset AWO';

			$d['checkeda'] = '';
			$d['checkedb'] = '';
			$d['checkedc'] = '';

			$d['combo_awo'] = $this->App_model->get_combo_awo_report($this->input->post("nama_awo"));
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

			if($this->input->post("nama_awo") != "") {
				$nama_awo = $this->input->post("nama_awo");
			} else {
				$nama_awo = '';
			}

			if($this->input->post("nama_barang") != "") {
				$d['kondisi_asset'] = $this->App_model->get_kondisi_asset_awo($d['tanggal1'],$d['tanggal2'],$keadaan_barang,$nama_barang,$nama_awo);				
			} else {
				$d['kondisi_asset'] = $this->App_model->get_kondisi_asset_awo_all($d['tanggal1'],$d['tanggal2'],$keadaan_barang,$nama_awo);			
			}

			$this->load->view('top',$d);
			$this->load->view('menu');
			$this->load->view('laporan_asset_awo/kondisi_asset');
			$this->load->view('bottom');
		}
		else {
			redirect("login");
		}
	}

	public function mutasi_asset() {
		if($this->session->userdata('hak_akses') == "admin") {
			$d['judul'] = 'Laporan Mutasi Asset AWO';
			$d['mutasi_asset'] = '';		
			$d['tanggal1'] = '';
			$d['tanggal2'] = '';
			$d['combo_barang'] = $this->App_model->get_combo_barang_report();
			$this->load->view('top',$d);
			$this->load->view('menu');
			$this->load->view('laporan_asset_awo/mutasi_asset');
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

			

			$d['judul'] = 'Laporan Mutasi Asset AWO';

			$d['combo_barang'] = $this->App_model->get_combo_barang_report($this->input->post("nama_barang"));

			if($this->input->post("nama_barang") != "") {
				$nama_barang = $this->input->post("nama_barang");
				$d['mutasi_asset'] = $this->App_model->get_mutasi_asset_awo($d['tanggal1'],$d['tanggal2'],$nama_barang);
			} else {
				$d['mutasi_asset'] = $this->App_model->get_mutasi_asset_awo_all($d['tanggal1'],$d['tanggal2']);			
			}
			

			$this->load->view('top',$d);
			$this->load->view('menu');
			$this->load->view('laporan_asset_awo/mutasi_asset');
			$this->load->view('bottom');
		}
		else {
			redirect("login");
		}
	}

	public function replacement_asset() {
		if($this->session->userdata('hak_akses') == "admin") {
			$d['judul'] = 'Laporan Replacement Asset AWO';
			$d['replacement_asset'] = '';		
			$d['tanggal1'] = '';
			$d['tanggal2'] = '';
			$d['combo_barang'] = $this->App_model->get_combo_barang_report();
			$d['combo_awo'] = $this->App_model->get_combo_awo_report();
			$this->load->view('top',$d);
			$this->load->view('menu');
			$this->load->view('laporan_asset_awo/replacement_asset');
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
			$d['nama_awo'] 	= $this->input->post("nama_awo");

			

			$d['judul'] = 'Laporan Replacement Asset AWO';

			$d['combo_barang'] = $this->App_model->get_combo_barang_report($this->input->post("nama_barang"));
			$d['combo_awo'] = $this->App_model->get_combo_awo_report($this->input->post("nama_awo"));



			if($this->input->post("nama_barang") != "") {
				$nama_barang = $this->input->post("nama_barang");
			} else {
				$nama_barang = '';
			}

			if($this->input->post("nama_awo") != "") {
				$nama_awo = $this->input->post("nama_awo");
			} else {
				$nama_awo = '';
			}

			if($this->input->post("nama_barang") != "") {
				$d['replacement_asset'] = $this->App_model->get_replacement_asset_awo($d['tanggal1'],$d['tanggal2'],$nama_barang,$nama_awo);
			} else {
				$d['replacement_asset'] = $this->App_model->get_replacement_asset_awo_all($d['tanggal1'],$d['tanggal2'],$nama_awo);
			}
			$this->load->view('top',$d);
			$this->load->view('menu');
			$this->load->view('laporan_asset_awo/replacement_asset');
			$this->load->view('bottom');
		}
		else {
			redirect("login");
		}
	}

}
