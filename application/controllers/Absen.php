<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class absen extends CI_Controller {

	public function index() {

	}

	public function add() {
		$in['id_awo'] = $this->input->post("id_awo");
		$in['tanggal'] = $this->input->post("tanggal");
		$in['jam'] = $this->input->post("jam");
		$in['lat'] = $this->input->post("lat");
		$in['lng'] = $this->input->post("lng");
		$this->db->insert("mst_absen",$in);
	}

	public function laporan() {
		if($this->session->userdata('hak_akses') == "admin") {
			$d['judul'] = 'Laporan Absen AWO';		
			$d['tanggal1'] = '';
			$d['tanggal2'] = '';
			$d['awo'] = '';
			$d['combo_awo'] = $this->App_model->get_combo_awo_report();
			$this->load->view('top',$d);
			$this->load->view('menu');
			$this->load->view('laporan_absen/laporan_absen');
			$this->load->view('bottom');
		}
		else {
			redirect("login");
		}
	}

	public function lihat_laporan_absen() {
		if($this->session->userdata('hak_akses') == "admin") {
			$d['judul'] = 'Laporan Absen AWO';		
			$d['tanggal1'] = $this->input->post("tanggal1");
			$d['tanggal2'] = $this->input->post("tanggal2");;
			$d['combo_awo'] = $this->App_model->get_combo_awo_report($this->input->post("nama_awo"));
			$d['awo'] = $this->input->post("nama_awo");
			$this->load->view('top',$d);
			$this->load->view('menu');
			$this->load->view('laporan_absen/laporan_absen');
			$this->load->view('bottom');
		}
		else {
			redirect("login");
		}
	}


	public function get($id_awo) {
		$tanggal= date("Y-m-d");
		$get = $this->db->query("SELECT tanggal,MAX(jam) as max_jam FROM mst_absen WHERE id_awo = '$id_awo' AND tanggal='$tanggal'")->row();
		$res['out']['tanggal'] = $get->tanggal;
		$res['out']['jam'] = $get->max_jam;
		echo json_encode($res);
	}

	public function get_map() {
		$lat = $this->input->post("lat");
		$lng = $this->input->post("lng");
		
		echo '<iframe width="100%" height="300" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?q='.$lat.','.$lng.'&hl=es;z=16&amp;output=embed"></iframe>';
	}
}