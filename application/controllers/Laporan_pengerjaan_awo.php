<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class laporan_pengerjaan_awo extends CI_Controller {

	public function index() {
		if($this->session->userdata('hak_akses') == "admin") {
			$id_rph = $this->session->userdata("id_rph");
			$d['pemotongan_sapi'] = $this->App_model->get_laporan_potong_awo();
			$d['judul'] = 'Laporan Pengerjaan AWO';	
			$d['pemotongan_sapi_ggl_stts'] = $this->App_model->get_penerimaan_detail_rph2_no_tgl_stts1($id_rph,'','2');	
			$this->load->view('top',$d);
			$this->load->view('menu');
			$this->load->view('laporan_pengerjaan_awo/pengerjaan_awo_table.php');
			$this->load->view('bottom');
		}
		else {
			redirect("login");
		}
	}

	public function release(){
		date_default_timezone_set("Asia/Bangkok");
		$date = date("Ymd");
		if($this->input->post("ck_id_detail") != ''){
			$getNR = $this->db->query("SELECT max(nomor_release) as jml FROM mst_release")->row();
			$noRelease = $getNR->jml+1;
			foreach($this->input->post("ck_id_detail") as $data_id) {
				$id_rph = $this->session->userdata("id_awo");
				$get = $this->db->query("SELECT abattoir,move_to,tanggal_terima,jam_terima,pengiriman.id_rph,penerimaan_detail.* FROM penerimaan_detail JOIN pengiriman ON 
									penerimaan_detail.id_pengiriman=pengiriman.id_pengiriman JOIN movement_log ON movement_log.id_pengiriman=pengiriman.id_pengiriman 
									JOIN mst_rph_user ON mst_rph_user.id_rph=pengiriman.id_rph WHERE status_potong = '2' AND id_penerimaan_detail='$data_id'")->row();
					$getBD = $this->db->query("SELECT beast_id FROM pengiriman_detail WHERE rfid='$get->rfid'")->row();
					$fp = fopen("../interface/To/RS_".$noRelease."_".$date.".txt","a") or die("Unable to open file!");
					$fp1 = fopen("../interface/To_backup/RS_".$noRelease."_".$date.".txt","a") or die("Unable to open file!");
					$data1 = $getBD->beast_id;
					$data2 = $get->abattoir;
					$data7 = $get->move_to;
					$data7a = $data7."                                   ";
					$data3 = str_replace("-","",$get->tanggal_potong);
					$data4 = str_replace(":","",$get->jam_potong);
					$data8 = str_replace("-","",$get->tanggal_terima);
					$data9 = str_replace(":","",$get->jam_terima);
					$data5a = strpos($get->berat_karkas,'.');
					$data5b = strpos($get->berat_karkas,',');
					if($data5a==''){
						if($data5b==''){
							$data5c = '000000000000000'.$get->berat_karkas.'00';
						}else{
							$data5c = '000000000000000'.number_format((float)$get->berat_karkas, 2, '', '');
						}
					}else{
						$data5c = '000000000000000'.number_format((float)$get->berat_karkas, 2, '', '');
					}
					$data6a = strpos($get->berat_prosot,'.');
					$data6b = strpos($get->berat_prosot,',');
					if($data6a==''){
						if($data6b==''){
							$data6c = '000000000000000'.$get->berat_prosot.'00';
						}else{
							$data6c = '000000000000000'.number_format((float)$get->berat_prosot, 2, '', '');
						}
					}else{
						$data6c = '000000000000000'.number_format((float)$get->berat_prosot, 2, '', '');
					}
					$content = $data1.$data2.substr($data7a,0,35).$data3.$data4.substr($data5c,-8).substr($data6c,-8).$data8.$data9."00"."\n";
					if($data1 != ''){
						fwrite($fp,$content);
						fclose($fp);
						fwrite($fp1,$content);
						fclose($fp1);
						$where['id_penerimaan_detail'] = $data_id;
						$inUpdate['release_status'] = 1;
						$inR['id_penerimaan_detail'] = $data_id;
						$inR['nomor_release'] = $noRelease;
						$this->db->insert("mst_release",$inR);
						$this->db->update("penerimaan_detail",$inUpdate,$where);
						$this->session->set_flashdata("success_update","Release Data Hasil Potong Sukses");
					}else{
						fclose($fp);
						fclose($fp1);
						unlink("../interface/To/RS_".$noRelease."_".$date.".txt");
						unlink("../interface/To_backup/RS_".$noRelease."_".$date.".txt");
						$this->session->set_flashdata("error_update","Sebagian Data Gagal Dirilis");
					}
			}
			redirect("Laporan_pengerjaan_awo");
		}else{
			$this->session->set_flashdata("error","Belum ada data yang dipilih, silahkan pilih data release terlebih dahulu");
			redirect("Laporan_pengerjaan_awo");
		}	
	}

	public function get_pengiriman() {
		$id_pengiriman = $this->input->post("id_pengiriman");
		$id_rph = $this->session->userdata("id_awo");
		$no = 1;	
		$get = $this->db->query("SELECT pengiriman.*,penerimaan_detail.* FROM pengiriman JOIN penerimaan_detail ON pengiriman.id_pengiriman=penerimaan_detail.id_pengiriman 
						JOIN pemotongan_log ON penerimaan_detail.id_penerimaan_detail=pemotongan_log.id_penerimaan_detail 
						WHERE status_potong='2' AND status='2' AND delete_status='0' AND release_status='0'");
		echo '<table id="dataTables-example" class="table table-bordered">
					<thead>
						<tr>
							<th><input style="width:20px;height:20px;" type="checkbox" value="0"class="ceksemua" id="checkAll"/> All </th>
							<th>No.</th>
							<th>Nota</th>
							<th>Shipment</th>
							<th>Jenis</th>
							<th>Eartag</th>
							<th>Tanggal Masuk</th>
							<th>Tanggal Potong</th>
							<th>RFID</th>
							<th>BBD</th>
							<th>Karkas</th>
							<th>Prosot</th>
							<th>Pasar</th>
							<th>Pedagang</th>
						</tr>
					</thead>
					<tbody>';
		foreach($get->result_array() as $data) { 
					echo '<tr>
							<td>
								<input style="width:20px;height:20px;" class="checksemua" id="rel_id" type="checkbox" name="ck_id_detail[]" value="'.$data['id_penerimaan_detail'].'">
								<span class="lbl"></span>
							</td>
							<td>'.$no.'</td>
							<td>'.$data['nota'].'</td>
							<td>'.$data['shipment'].'</td>
							<td>'.$data['material_description'].'</td>
							<td>'.$data['eartag'].'</td>
							<td>'.$data['tanggal_terima'].'</td>
							<td>'.$data['tanggal_potong'].'</td>
							<td>'.$data['rfid'].'</td>
							<td>'.$data['berat'].'</td>
							<td>'.$data['berat_karkas'].'</td>
							<td>'.$data['berat_prosot'].'</td>
							<td>'.$data['pasar'].'</td>
							<td>'.$data['nama_pedagang'].'</td>
						  </tr>';
		$no++; }
		echo		'</tbody>
				</table>';	
	}

	public function masuk($id=null) {
		if($this->session->userdata('hak_akses') == "admin") {
			// $id_rph = $this->session->userdata("id_rph");
			if($id == null) {
				$d['sapi_masuk'] = "";
				$d['combo_pengiriman'] = $this->App_model->get_combo_pengiriman_rph();
				$d['judul'] = 'Data Sapi Masuk';		
				$this->load->view('top',$d);
				$this->load->view('menu');
				$this->load->view('laporan_pengerjaan_awo/sapi_masuk');
				$this->load->view('bottom');
			} else {
				$d['sapi_masuk'] = $this->App_model->get_sapi_masuk($id);
				$d['combo_pengiriman'] = $this->App_model->get_combo_pengiriman_rph($id);
				$d['judul'] = 'Data Sapi Masuk';		
				$this->load->view('top',$d);
				$this->load->view('menu');
				$this->load->view('laporan_pengerjaan_awo/sapi_masuk');
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
								WHERE LOG='$log' AND delete_status=0");
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
					<th style="background: #22313F;color:#fff;">Prosot</th>
					<th style="background: #22313F;color:#fff;">% Prosot</th>
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
					<td>'.$data['berat_prosot'].'</td>
					<td>'.round((($data['berat_prosot']/$data['berat'])*100),2) .' %'.'</td>
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

			// foreach($this->input->post("ck_id_detail") as $data_id) {
			// 	$q = $this->db->query("SELECT * FROM pengiriman_detail WHERE id_pengiriman_detail = '".$data_id."'")->row();
				
			// 			$inDT['id_pengiriman'] = $q->id_pengiriman;
		    //             $inDT['nota'] = $q->nota;
		    //             $inDT['eartag'] = $q->eartag;
			//             $inDT['shipment'] = $q->shipment;
			//             $inDT['material_description'] = $q->material_description;
		    //             $inDT['rfid'] = $q->rfid;
		    //             $inDT['berat'] = $q->berat;
		    //             $inDT['customer'] = $q->customer;
		    //             $inDT['no_kendaraan'] = $q->no_kendaraan;

		    //             $this->db->insert("penerimaan_detail",$inDT);

		    //             $this->db->update("pengiriman_detail",array('status_terima' => '1'),array('id_pengiriman_detail' => $data_id));
			// }
			// $in['status_terima'] = '1';
			
			// $this->db->update("pengiriman",$in,array('id_pengiriman' => $id));

			$this->session->set_flashdata("success","Data Potong Sapi Telah Dikonfirmasi");
			redirect("laporan_pengerjaan_awo");	
		} else {
			redirect("login");
		}
	}

	public function save_batal() {
		if($this->session->userdata('hak_akses') == "admin") {
			$log = $this->input->post("log");
			$in['delete_status'] = '1';
			$where['log'] = $this->input->post("log");
			$this->db->update("pemotongan_log",$in,$where);
			$qData = $this->db->query("SELECT id_penerimaan_detail FROM pemotongan_log WHERE log='$log'");		
			foreach($qData->result_array() as $data1) {
				$in1['status_potong'] = '1';
				$where1['id_penerimaan_detail'] = $data1['id_penerimaan_detail'];
				$this->db->update("penerimaan_detail",$in1,$where1);
			} 		

			$this->session->set_flashdata("success","Data potong sapi berhasil di batalkan");
			redirect("laporan_pengerjaan_awo");	
		} else {
			redirect("login");
		}
	}

	// public function save_batal() {
	// 	if($this->session->userdata('hak_akses') == "admin") {
	// 		$log = $this->input->post("log");
	// 		$in['status'] = '1';
	// 		$where['log'] = $this->input->post("log");

	// 		$this->db->update("pemotongan_log",$in,$where);
			
	// 		$this->session->set_flashdata("success","penerimaan sapi berhasil di batalkan");
	// 		redirect("laporan_pengerjaan_awo");			
	// 	} else {
	// 		redirect("login");
	// 	}
	// }

}
