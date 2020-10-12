<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class History_penerimaan extends CI_Controller {
	public function index() {
		if($this->session->userdata('hak_akses') == "awo"||$this->session->userdata('hak_akses') == "admin") {
			$id_awo = $this->session->userdata("id_awo");
			$d['penerimaan_sapi'] = $this->App_model->get_penerimaan_history($id_awo);
			$d['judul'] = 'Data Penerimaan Sapi';		
			$this->load->view('top',$d);
			$this->load->view('menu');
			$this->load->view('history_penerimaan/history_penerimaan_tabel.php');
			$this->load->view('bottom');
		}
		else {
			redirect("login");
		}
	}
	public function masuk($id=null) {
		if($this->session->userdata('hak_akses') == "awo") {
			// $id_rph = $this->session->userdata("id_rph");
			if($id == null) {
				$d['sapi_masuk'] = "";
				$d['combo_pengiriman'] = $this->App_model->get_combo_pengiriman_rph();
				$d['judul'] = 'Data Sapi Masuk';		
				$this->load->view('top',$d);
				$this->load->view('menu');
				$this->load->view('history_penerimaan/sapi_masuk');
				$this->load->view('bottom');
			} else {
				$d['sapi_masuk'] = $this->App_model->get_sapi_masuk($id);
				$d['combo_pengiriman'] = $this->App_model->get_combo_pengiriman_rph($id);
				$d['judul'] = 'Data Sapi Masuk';		
				$this->load->view('top',$d);
				$this->load->view('menu');
				$this->load->view('history_penerimaan/sapi_masuk');
				$this->load->view('bottom');
			}
	}
		else {
			redirect("login");
		}
	}
	public function get_pengiriman() {
		$id_pengiriman = $this->input->post("id_pengiriman");
		$tanggal_terima = $this->input->post("tanggal_terima");
		$no = 1;	
		$get = $this->db->query("SELECT penerimaan_detail.* FROM pengiriman_detail JOIN penerimaan_detail 
						ON pengiriman_detail.rfid=penerimaan_detail.rfid WHERE penerimaan_detail.id_pengiriman = '$id_pengiriman' 
						AND status_terima='1' AND tanggal_terimaDt='$tanggal_terima' GROUP BY rfid");
		echo '<table class="table table-bordered">
					<thead>
						<tr>
							<th>No.</th>
							<th>Nota</th>
							<th>RFID</th>
							<th>Eartag</th>
							<th>Berat</th>
							<th>Customer</th>
							<th>No.Kendaraan</th>
						</tr>
					</thead>
					<tbody>';
		foreach($get->result_array() as $data) { 
					echo '<tr>
							<td>'.$no.'</td>
							<td>'.$data['nota'].'</td>
							<td>'.$data['rfid'].'</td>
							<td>'.$data['eartag'].'</td>
							<td>'.$data['berat'].'</td>
							<td>'.$data['customer'].'</td>
							<td>'.$data['no_kendaraan'].'</td>
						  </tr>';
		$no++; }
		echo		'</tbody>
				</table>';	
	}
	public function save_terima() {
		if($this->session->userdata('hak_akses') == "awo") {
			$id = $this->input->post("id_pengiriman");
			$in['status_terima'] = '1';
			$in['tanggal_terima'] = $this->input->post("tanggal_terima");
			$in['jam_terima'] = $this->input->post("jam_terima");
			$in['keterangan_terima'] = $this->input->post("keterangan_terima");
			$tanggal_terima = $this->input->post("tanggal_terima");
			$jam_terima = $this->input->post("jam_terima");
			//$this->db->update("pengiriman",$in,array('id_pengiriman' => $id));				
			foreach($this->input->post("ck_id_detail") as $data_id) {
				$q = $this->db->query("SELECT * FROM pengiriman_detail WHERE id_pengiriman_detail = '".$data_id."'")->row();
						$inDT['id_pengiriman'] = $q->id_pengiriman;
		                $inDT['nota'] = $q->nota;
		                $inDT['eartag'] = $q->eartag;
		                $inDT['beast_id'] = $q->beast_id;
			            $inDT['shipment'] = $q->shipment;
			            $inDT['material_description'] = $q->material_description;
		                $inDT['rfid'] = $q->rfid;
		                $inDT['berat'] = $q->berat;
		                $inDT['customer'] = $q->customer;
		                $inDT['no_kendaraan'] = $q->no_kendaraan;
		                $inDT['tanggal_terimaDt'] =  $tanggal_terima;
		                $inDT['jam_terimaDt'] =  $jam_terima;
		                $this->db->insert("penerimaan_detail",$inDT);
		                $this->db->update("pengiriman_detail",array('status_terima' => '1'),array('id_pengiriman_detail' => $data_id));
			}
			$in['status_terima'] = '1';
			$this->db->update("pengiriman",$in,array('id_pengiriman' => $id));
			$this->session->set_flashdata("success","Konfirmasi penerimaan sapi berhasil");
			redirect("penerimaan_sapi");	
		} else {
			redirect("login");
		}
	}
	public function save_batal() {
		if($this->session->userdata('hak_akses') == "awo") {
			$id = $this->input->post("id_pengiriman");
			$in['status_terima'] = '0';
			$in['tanggal_terima'] = "";
			$in['jam_terima'] = "";
			$this->db->update("pengiriman",$in,array('id_pengiriman' => $id));				
			$this->session->set_flashdata("success","penerimaan sapi berhasil di batalkan");
			redirect("penerimaan_sapi");			
		} else {
			redirect("login");
		}
	}
}
