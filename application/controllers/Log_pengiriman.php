<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Log_pengiriman extends CI_Controller {
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
	public function mutasi_pengiriman() {
		if($this->session->userdata('hak_akses') == "admin") {
			$d['judul'] = 'Log Pengiriman & Mutasi';		
			$d['tanggal1'] = '';
			$d['tanggal2'] = '';
			$d['nota'] = '';
			$d['nama_rph1'] = '';
			$d['nama_rph2'] = '';
			$d['combo_nota'] = $this->App_model->get_combo_pengiriman_mutasi();
			$d['combo_rph1'] = $this->App_model->get_combo_rph_mutasi_from();
			$d['combo_rph2'] = $this->App_model->get_combo_rph_mutasi();
			$this->load->view('top',$d);
			$this->load->view('menu');
			$this->load->view('log_pengiriman/mutasi_pengiriman');
			$this->load->view('bottom');
		}
		else {
			redirect("login");
		}
	}
	public function lihat_laporan() {
		if($this->session->userdata('hak_akses') == "admin") {
			$d['judul'] = 'Laporan Log Pengiriman & Mutasi';		
			$d['tanggal1'] = $this->input->post("tanggal1");
			$d['tanggal2'] = $this->input->post("tanggal2");
			$d['nota'] = $this->input->post("nota");
			$d['nama_rph1'] = $this->input->post("nama_rph1");
			$d['nama_rph2'] = $this->input->post("nama_rph2");
			$d['combo_nota'] = $this->App_model->get_combo_pengiriman_mutasi($this->input->post("nota"));
			$d['combo_rph1'] = $this->App_model->get_combo_rph_mutasi_from($this->input->post("nama_rph1"));
			$d['combo_rph2'] = $this->App_model->get_combo_rph_mutasi($this->input->post("nama_rph2"));
			$this->load->view('top',$d);
			$this->load->view('menu');
			$this->load->view('log_pengiriman/mutasi_pengiriman');
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