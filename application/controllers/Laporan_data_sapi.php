<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_data_sapi extends CI_Controller {

	public function index() {
		redirect(base_url());
	}

	public function stok_sapi() {
		if($this->session->userdata('hak_akses') == "admin") {
			$d['judul'] = 'Laporan Stok Sapi';
			$d['stok_sapi'] = '';		
			$d['tanggal1'] = '';
			$d['tanggal2'] = '';
			$d['asal_sapi'] = '';
			$d['nama_rph'] = '';
			$d['combo_rph'] = $this->App_model->get_combo_rph_report();
			$d['combo_customer'] = $this->App_model->get_combo_customer();
			$this->load->view('top',$d);
			$this->load->view('menu');
			$this->load->view('laporan_data_sapi/laporan_stok_sapi');
			$this->load->view('bottom');
		}
		else {
			redirect("login");
		}
	}

	public function lihat_stok_sapi() {
		if($this->session->userdata('hak_akses') == "admin") {
			$d['tanggal1'] = $this->input->post("tanggal1");
			$d['tanggal2'] = $this->input->post("tanggal2");
			$id_rph = $this->input->post("id_rph");
			$customer = $this->input->post("customer");

			$d['judul'] = 'Laporan Stok Sapi';

			$d['combo_rph'] = $this->App_model->get_combo_rph_report($this->input->post("id_rph"));
			
			$d['combo_customer'] = $this->App_model->get_combo_customer($this->input->post("customer"));

			$d['asal_sapi'] = $this->input->post("asal_sapi");

			if($this->input->post("id_rph") != "") {
				$d['nama_rph'] = $this->input->post("id_rph");
			} else {
				$d['nama_rph'] = "Semua RPH";
			}

			$d['stok_sapi'] = $this->App_model->get_stok_sapi($d['tanggal1'],$d['tanggal2'],$id_rph,$d['asal_sapi'],$customer);
			
			$this->load->view('top',$d);
			$this->load->view('menu');
			$this->load->view('laporan_data_sapi/laporan_stok_sapi');
			$this->load->view('bottom');
		}
		else {
			redirect("login");
		}
	}


	public function pemotongan_sapi() {
		if($this->session->userdata('hak_akses') == "admin") {
			$d['judul'] = 'Laporan Pemotongan Sapi';
			$d['pemotongan_sapi'] = '';		
			$d['tanggal1'] = '';
			$d['tanggal2'] = '';
			$d['asal_sapi'] = '';
			$d['nama_rph'] = '';
			$d['combo_rph'] = $this->App_model->get_combo_rph_report();
			$d['combo_customer'] = $this->App_model->get_combo_customer();
			$this->load->view('top',$d);
			$this->load->view('menu');
			$this->load->view('laporan_data_sapi/laporan_pemotongan_sapi');
			$this->load->view('bottom');
		}
		else {
			redirect("login");
		}
	}

	public function lihat_pemotongan_sapi() {
		if($this->session->userdata('hak_akses') == "admin") {
			$d['tanggal1'] = $this->input->post("tanggal1");
			$d['tanggal2'] = $this->input->post("tanggal2");
			$d['asal_sapi'] = $this->input->post("asal_sapi");
			$id_rph = $this->input->post("id_rph");

			$d['judul'] = 'Laporan Pemotongan Sapi';

			$d['combo_rph'] = $this->App_model->get_combo_rph_report($this->input->post("id_rph"));
			$d['combo_customer'] = $this->App_model->get_combo_customer($this->input->post("customer"));

			$status_potong = '1';	

			if($this->input->post("id_rph") != "") {
				$d['nama_rph'] = $this->input->post("id_rph");
			} else {
				$d['nama_rph'] = "Semua RPH";
			}

			$d['pemotongan_sapi'] = $this->App_model->get_pemotongan_sapi($d['tanggal1'],$d['tanggal2'],$id_rph,$status_potong,$d['asal_sapi']);

			$this->load->view('top',$d);
			$this->load->view('menu');
			$this->load->view('laporan_data_sapi/laporan_pemotongan_sapi');
			$this->load->view('bottom');
		}
		else {
			redirect("login");
		}
	}

	public function traceability() {
		if($this->session->userdata('hak_akses') == "admin") {
			$d['asal_sapi'] = "";	
			$d['tanggal_awal'] = "";	
			$d['tanggal_akhir'] = "";		
			$d['traceability'] = "";
			$d['traceabilityAll'] = "";
			$d['traceabilityAll1'] = "";
			$d['judul'] = 'Data Traceability Pemotongan Sapi';	
			$d['tanggal_awal'] = "";
			$d['tanggal_akhir'] = "";
			$d['combo_rph'] = $this->App_model->get_combo_rph_report();	
			$d['combo_customer'] = $this->App_model->get_combo_customer();	
			$d['nama_rph'] = '';

			$this->load->view('top',$d);
			$this->load->view('menu');
			$this->load->view('laporan_data_sapi/traceability');
			$this->load->view('bottom');
		}
		else {
			redirect("login");
		}
	}

	public function lihat_traceability() {
		if($this->session->userdata('hak_akses') == "admin") {
			// $id_rph = $this->session->userdata("id_rph");	
			$d['tanggal_awal'] = $this->input->post("tanggal_awal");
			$d['tanggal_akhir'] = $this->input->post("tanggal_akhir");	
			$d['asal_sapi'] = $this->input->post("asal_sapi");	
			if($this->input->post("id_rph") != "") {
				$d['nama_rph'] = $this->input->post("id_rph");
			} else {
				$d['nama_rph'] = "Semua RPH";
			}
			$d['combo_rph'] = $this->App_model->get_combo_rph_report($this->input->post("id_rph"));	
			$d['combo_customer'] = $this->App_model->get_combo_customer($this->input->post("customer"));	
			$id_rph = $this->input->post("id_rph");
			$d['traceability'] = $this->App_model->get_laporan_tracebility($id_rph,$d['asal_sapi'],$d['tanggal_awal'],$d['tanggal_akhir']);
			$d['traceabilityAll'] = $this->App_model->get_laporan_tracebilityAll($id_rph,$d['asal_sapi'],$d['tanggal_awal'],$d['tanggal_akhir']);
			$d['traceabilityAll1'] = $this->App_model->get_laporan_tracebilityAll1($id_rph,$d['asal_sapi'],$d['tanggal_awal'],$d['tanggal_akhir']);

			$d['judul'] = 'Data Traceability Pemotongan Sapi';		
			$this->load->view('top',$d);
			$this->load->view('menu');
			$this->load->view('laporan_data_sapi/traceability');
			$this->load->view('bottom');
		}
		else {
			redirect("login");
		}
	}

	/*

	public function kartu_stok_sapi() {
		if($this->session->userdata('hak_akses') == "admin") {
			$d['judul'] = 'Laporan Kartu Stok Sapi';
			$d['kartu_stok'] = '';		
			$d['tanggal1'] = '';
			$d['tanggal2'] = '';
			$d['combo_rph'] = $this->App_model->get_combo_rph();
			$this->load->view('top',$d);
			$this->load->view('menu');
			$this->load->view('laporan_data_sapi/laporan_kartu_stok');
			$this->load->view('bottom');
		}
		else {
			redirect("login");
		}
	}

	public function lihat_kartu_stok_sapi() {
		if($this->session->userdata('hak_akses') == "admin") {
			$d['judul'] = 'Laporan Kartu Stok Sapi';
			$d['kartu_stok'] = '';		
			$d['tanggal1'] = $this->input->post("tanggal1");
			$d['tanggal2'] = $this->input->post("tanggal2");
			$d['combo_rph'] = $this->App_model->get_combo_rph($this->input->post("id_rph"));
			$d['id_rph'] = $this->input->post("id_rph");
			$this->load->view('top',$d);
			$this->load->view('menu');
			$this->load->view('laporan_data_sapi/laporan_kartu_stok');
			$this->load->view('bottom');
		}
		else {
			redirect("login");
		}
	}
	*/

	public function get_stok() {
		$id_pengiriman = $this->input->post("id_pengiriman");
		$status_terima = $this->input->post("status_terima");
		$status_potong = $this->input->post("status_potong");
		$intransit = $this->input->post("intransit");
		$no = 1;	
		// $get = $this->db->query("SELECT * FROM penerimaan_detail WHERE id_pengiriman = '$id_pengiriman' AND status_potong = '0'");
		$get = $this->db->query("SELECT tanggal_kirim,jam_kirim,tanggal_terima,jam_terima,asal_sapi,move_from,move_to,dp.*,pd.eartag 
							AS eartag1,pd.rfid AS rfid1,status_potong,flag,flag1,intransit FROM pengiriman_detail dp JOIN pengiriman pg 
							ON pg.id_pengiriman=dp.id_pengiriman JOIN movement_log ml ON ml.id_pengiriman=pg.id_pengiriman 
							LEFT JOIN penerimaan_detail pd ON pd.id_pengiriman=dp.id_pengiriman AND pd.eartag=dp.eartag
							WHERE pg.id_pengiriman='$id_pengiriman' AND pg.status_terima='$status_terima' AND status_potong='$status_potong' AND
							intransit='$intransit'");
		echo '<table class="table table-bordered">
					<thead>
						<tr>
							<th>No.</th>
							<th>RFID</th>
							<th>Berat</th>
						</tr>
					</thead>
					<tbody>';
		foreach($get->result_array() as $data) { 
				
					echo '<tr>
							<td>'.$no.'</td>
							<td>'.$data['rfid'].'</td>
							<td>'.$data['berat'].'</td>
						  </tr>';
		$no++; }

		echo		'</tbody>
				</table>';	
	}




}
