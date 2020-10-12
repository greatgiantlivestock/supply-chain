<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class laporan_diterima extends CI_Controller {

	public function index() {
		if($this->session->userdata('hak_akses') == "admin") {
			//$id_rph = $this->session->userdata("id_rph");
			$d['pemotongan_sapi'] = $this->App_model->get_laporan_sapi_diterima();
			$d['judul'] = 'Laporan Sapi Diterima';		
			$this->load->view('top',$d);
			$this->load->view('menu');
			$this->load->view('laporan_diterima/laporan_diterima_table.php');
			$this->load->view('bottom');
		}
		else {
			redirect("login");
		}
	}

	public function masuk($id=null) {
		if($this->session->userdata('hak_akses') == "admin") {
			$id_rph = $this->session->userdata("id_rph");
			if($id == null) {
				$d['sapi_masuk'] = "";
				$d['combo_pengiriman'] = $this->App_model->get_combo_pengiriman_rph();
				$d['judul'] = 'Data Sapi Masuk';		
				$this->load->view('top',$d);
				$this->load->view('menu');
				$this->load->view('laporan_diterima/sapi_masuk');
				$this->load->view('bottom');
			} else {
				$d['sapi_masuk'] = $this->App_model->get_sapi_masuk($id);
				$d['combo_pengiriman'] = $this->App_model->get_combo_pengiriman_rph($id);
				$d['judul'] = 'Data Sapi Masuk';		
				$this->load->view('top',$d);
				$this->load->view('menu');
				$this->load->view('laporan_diterima/sapi_masuk');
				$this->load->view('bottom');
			}
	}
		else {
			redirect("login");
		}
	}

	public function get_laporan() {
		$log = $this->input->post("log");
		$no = 1;	
		$get = $this->db->query("SELECT pemotongan_log.*,penerimaan_detail.*,pengiriman.*,nama_rph FROM pemotongan_log JOIN penerimaan_detail 
								ON pemotongan_log.id_penerimaan_detail = penerimaan_detail.id_penerimaan_detail
								JOIN pengiriman ON pengiriman.id_pengiriman=penerimaan_detail.id_pengiriman 
								JOIN mst_rph ON mst_rph.id_rph=pengiriman.id_rph
								WHERE LOG='$log'");
		echo '
		
			<thead>
				<tr>
					<th style="background: #22313F;color:#fff;width:50px;">No</th>
					<th style="background: #22313F;color:#fff;">RPH</th>
					<th style="background: #22313F;color:#fff;">Nota</th>
					<th style="background: #22313F;color:#fff;">Shipment</th>
					<th style="background: #22313F;color:#fff;">Jenis</th>
					<th style="background: #22313F;color:#fff;">Eartag</th>
					<th style="background: #22313F;color:#fff;">Tgl.Masuk</th>
					<th style="background: #22313F;color:#fff;">Tgl.Potong</th>
					<th style="background: #22313F;color:#fff;">Umur</th>
					<th style="background: #22313F;color:#fff;">RFID</th>
					<th style="background: #22313F;color:#fff;">BBD</th>
					<th style="background: #22313F;color:#fff;">Karkas</th>
					<th style="background: #22313F;color:#fff;">% Karkas</th>
					<th style="background: #22313F;color:#fff;">Ket.</th>
					<th style="background: #22313F;color:#fff;">Pasar</th>
					<th style="background: #22313F;color:#fff;">Pedagang</th>
					<th style="background: #22313F;color:#fff;">Merah</th>
					<th style="background: #22313F;color:#fff;">Orange</th>
					<th style="background: #22313F;color:#fff;">Hitam</th>
					<th style="background: #22313F;color:#fff;">Kuning</th>
					<th style="background: #22313F;color:#fff;">Peneumatic</th>
					<th style="background: #22313F;color:#fff;">Score</th>
				</tr>
			</thead>
			<tbody>';
			foreach($get->result_array() as $data) { 
					if(!empty($data['tanggal_potong'])) {
						$start_date = new DateTime($data['tanggal_terima']);
						$end_date = new DateTime($data['tanggal_potong']);
						$interval = $start_date->diff($end_date);
					} else {
						echo '-';
					}
				echo '
				<tr>
					<td>'.$no.'</td>
					<td>'.$data['nama_rph'].'</td>
					<td>'.$data['nota'].'</td>
					<td>'.$data['shipment'].'</td>
					<td>'.$data['material_description'].'</td>
					<td>'.$data['eartag'].'</td>
					<td>'.$data['tanggal_terima'].'</td>
					<td>'.$data['tanggal_potong'].'</td>
					<td>'.$interval->days.'</td>
					<td>'.$data['rfid'].'</td>
					<td>'.$data['berat'].'</td>
					<td>'.$data['berat_karkas'].'</td>
					<td>'.round((($data['berat_karkas']/$data['berat'])*100),2) .' %'.'</td>
					<td>'.$data['keterangan_potong'].'</td>
					<td>'.$data['pasar'].'</td>
					<td>'.$data['nama_pedagang'].'</td>
					<td>'.$data['merah'].'</td>
					<td>'.$data['orange'].'</td>
					<td>'.$data['hitam'].'</td>
					<td>'.$data['kuning'].'</td>
					<td>'.$data['peneumatic'].'</td>
					<td>'.$data['score_stune'].'</td>
				</tr>';
			$no++; }

			echo
			'</tbody>
		';	
	}


	public function save_terima() {
		if($this->session->userdata('hak_akses') == "admin") {
			$log = $this->input->post("log");
			$in['status'] = '2';
			$where['log'] = $this->input->post("log");
			
			$this->db->update("pemotongan_log",$in,$where);				

			$this->session->set_flashdata("success","Data Potong Sapi Telah Dikonfirmasi");
			redirect("laporan_diterima");	
		} else {
			redirect("login");
		}
	}

	public function save_batal() {
		if($this->session->userdata('hak_akses') == "admin") {
			$log = $this->input->post("log");
			$in['status'] = '1';
			$where['log'] = $this->input->post("log");
			
			$this->db->update("pemotongan_log",$in,$where);				

			$this->session->set_flashdata("success","Data potong sapi berhasil di batalkan");
			redirect("laporan_diterima");	
		} else {
			redirect("login");
		}
	}

}
