<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class penerimaan_sapi extends CI_Controller {
	public function index() {
		if($this->session->userdata('hak_akses') == "awo"||$this->session->userdata('hak_akses') == "admin") {
			$id_awo = $this->session->userdata("id_awo");
			$d['penerimaan_sapi'] = $this->App_model->get_penerimaan($id_awo);
			$d['judul'] = 'Data Penerimaan Sapi';		
			$this->load->view('top',$d);
			$this->load->view('menu');
			$this->load->view('penerimaan_sapi/penerimaan_sapi_tabel.php');
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
				$this->load->view('penerimaan_sapi/sapi_masuk');
				$this->load->view('bottom');
			} else {
				$d['sapi_masuk'] = $this->App_model->get_sapi_masuk($id);
				$d['combo_pengiriman'] = $this->App_model->get_combo_pengiriman_rph($id);
				$d['judul'] = 'Data Sapi Masuk';		
				$this->load->view('top',$d);
				$this->load->view('menu');
				$this->load->view('penerimaan_sapi/sapi_masuk');
				$this->load->view('bottom');
			}
	}
		else {
			redirect("login");
		}
	}
	public function upload_potong() {
		if($this->session->userdata('hak_akses') == "awo"||$this->session->userdata('hak_akses') == "admin") {
			$config['upload_path'] = './upload/';
			$config['allowed_types']= 'xls||csv'; 
			$config['encrypt_name']	= TRUE;
			$config['remove_spaces']	= TRUE;	
			$config['max_size']     = '0';
			$this->load->library('upload', $config);
			$this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
				if($this->upload->do_upload("file_upload")) {
					$data	= $this->upload->data();
					$inputFileType = IOFactory::identify("./upload/".$data['file_name']);
		            $objReader = IOFactory::createReader($inputFileType);
		            $objPHPExcel = $objReader->load("./upload/".$data['file_name']);
		            $sheet = $objPHPExcel->getSheet(0);
		            $highestRow = $sheet->getHighestRow();
					$highestColumn = $sheet->getHighestColumn(); 
					$id_awo_impC = $this->session->userdata("id_awo");
					$count_id = 0;
						for ($row = 2; $row <= $highestRow; $row++){ 
							$rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
															NULL,
															TRUE,
															FALSE);
							$data_impC=$rowData[0][0];
							$last_char = substr($data_impC,-1); 
							// if($last_char==";"){
							// 	$rfid_impC=substr($data_impC,0,16);
							// 	$tanggal = substr($data_impC,-20,-10);
							// 	$waktu = substr($data_impC,-9,-1);
							// 	$jam_impC=str_replace('.', ':', $waktu);
							// 	echo "RFID : ".$rfid_impC; echo " Tanggal terima : ".$tanggal; echo " Jam terima : ".$jam_impC; echo "<br>";
							// 	$inDT['rfid'] = $rfid_impC;
							// 	$inDT['tanggal'] = $tanggal;
							// 	$inDT['jam'] = $jam_impC;
							// 	$this->db->insert("test_importcsv",$inDT);
							// }else{
							// 	echo "RFID : ".$rowData[0][1]; echo " Tanggal terima : ".$rowData[0][2]; echo " Jam terima : ".$rowData[0][3].":00"; echo "<br>";
							// 	$inDT['rfid'] = $rfid_impC;
							// 	$inDT['tanggal'] = $tanggal;
							// 	$inDT['jam'] = $jam_impC;
							// 	$this->db->insert("test_importcsv",$inDT);
							// }
							if($last_char==";"){
								$rfid_impC=substr($data_impC,0,16);
								$tanggal_impC = substr($data_impC,-20,-10);
								$waktu = substr($data_impC,-9,-1);
								$jam_impC=str_replace('.', ':', $waktu);
								// $tanggal_impC=PHPExcel_Style_NumberFormat::toFormattedString($rowData[0][1],  "YYYY-mm-dd");
								// $jam_impC=PHPExcel_Style_NumberFormat::toFormattedString($rowData[0][2],  "hh:mm");	
								// $tanggal_impC=substr($data_impC,18,10);	
								$qDt_before = $this->App_model->get_qDt_before1($id_awo_impC,$rfid_impC);
								$no_pengiriman = $qDt_before->no_pengiriman;    
								if($qDt_before->jml>0){
									$qValidRFID = $this->App_model->get_qValidRFID1($no_pengiriman,$rfid_impC,$id_awo_impC);
									if($qValidRFID->jml==0){
										$inDT['id_pengiriman'] = $qDt_before->id_pengiriman;
										$inDT['nota'] = $qDt_before->nota;
										$inDT['eartag'] = $qDt_before->eartag;
										$inDT['beast_id'] = $qDt_before->beast_id;
										$inDT['shipment'] = $qDt_before->shipment;
										$inDT['material_description'] = $qDt_before->material_description;
										$inDT['rfid'] = $qDt_before->rfid;
										$inDT['berat'] = $qDt_before->berat;
										$inDT['customer'] = $qDt_before->customer;
										$inDT['no_kendaraan'] = $qDt_before->no_kendaraan;
										$inDT['tanggal_terimaDt'] =  $tanggal_impC;
										$inDT['jam_terimaDt'] =  $jam_impC;
										$this->db->insert("penerimaan_detail",$inDT);
										$this->db->update("pengiriman_detail",array('status_terima' => '1'),array('id_pengiriman_detail' => $qDt_before->id_pengiriman_detail));
										
										$in['status_terima'] = '1';
										$in['tanggal_terima'] = $tanggal_impC;
										$in['jam_terima'] = $jam_impC;
										// $in['keterangan_terima'] = $this->input->post("keterangan_terima");
										$this->db->update("pengiriman",$in,array('id_pengiriman' => $qDt_before->id_pengiriman));
										$count_id++;
									}
								}
							}else{
								// echo "RFID : ".$rowData[0][1]; echo " Tanggal terima : ".$rowData[0][2]; echo " Jam terima : ".$rowData[0][3].":00"; echo "<br>";
								// $inDT['rfid'] = $rowData[0][1];
								// $inDT['tanggal'] = $rowData[0][2];
								// $inDT['jam'] = $rowData[0][3].":00";
								// $this->db->insert("test_importcsv",$inDT);
								// $tanggal_impC=PHPExcel_Style_NumberFormat::toFormattedString($rowData[0][1],  "YYYY-mm-dd");
								// $jam_impC=PHPExcel_Style_NumberFormat::toFormattedString($rowData[0][2],  "hh:mm");	
								$rfid_impC=$rowData[0][1];
								$tanggal_impC=$rowData[0][2];
								$jam_impC=$rowData[0][3].":00";
								$qDt_before = $this->App_model->get_qDt_before1($id_awo_impC,$rfid_impC);
								$no_pengiriman = $qDt_before->no_pengiriman; 
								if($qDt_before->jml>0){
									$qValidRFID = $this->App_model->get_qValidRFID1($no_pengiriman,$rfid_impC,$id_awo_impC);
									if($qValidRFID->jml==0){
										$inDT['id_pengiriman'] = $qDt_before->id_pengiriman;
										$inDT['nota'] = $qDt_before->nota;
										$inDT['eartag'] = $qDt_before->eartag;
										$inDT['beast_id'] = $qDt_before->beast_id;
										$inDT['shipment'] = $qDt_before->shipment;
										$inDT['material_description'] = $qDt_before->material_description;
										$inDT['rfid'] = $qDt_before->rfid;
										$inDT['berat'] = $qDt_before->berat;
										$inDT['customer'] = $qDt_before->customer;
										$inDT['no_kendaraan'] = $qDt_before->no_kendaraan;
										$inDT['tanggal_terimaDt'] =  $tanggal_impC;
										$inDT['jam_terimaDt'] =  $jam_impC;
										$this->db->insert("penerimaan_detail",$inDT);
										$this->db->update("pengiriman_detail",array('status_terima' => '1'),array('id_pengiriman_detail' => $qDt_before->id_pengiriman_detail));
										
										$in['status_terima'] = '1';
										$in['tanggal_terima'] = $tanggal_impC;
										$in['jam_terima'] = $jam_impC;
										// $in['keterangan_terima'] = $this->input->post("keterangan_terima");
										$this->db->update("pengiriman",$in,array('id_pengiriman' => $qDt_before->id_pengiriman));
										$count_id++;
									}
								}
							}
						}
						if($count_id>0){
							$this->session->set_flashdata("success","Konfirmasi penerimaan sapi melalui CSV berhasil");
						}else{
							$this->session->set_flashdata("error","Konfirmasi penerimaan sapi gagal karena sudah pernah diterima sebelumnya atau data sapi tidak ada");
						}
						@unlink("./upload/".$data['file_name']);
						redirect("Penerimaan_sapi");	
				} else {
					$this->session->set_flashdata("error",$this->upload->display_errors());
					redirect("Penerimaan_sapi");
				}			
		}else {
			redirect("login");
		}
	}
	public function save_terima() {
		if($this->session->userdata('hak_akses') == "awo"||$this->session->userdata('hak_akses') == "admin") {
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
	public function get_pengiriman() {
		$id_pengiriman = $this->input->post("id_pengiriman");
		$no = 1;	
		$get = $this->db->query("SELECT * FROM pengiriman_detail WHERE id_pengiriman = '$id_pengiriman' AND status_terima='0'");
		echo '<table class="table table-bordered">
					<thead>
						<tr>
							<th><input type="checkbox" onClick="all_check(this)" /> <span class="lbl"></span></th>
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
							<td><input class="check" type="checkbox" name="ck_id_detail[]" value="'.$data['id_pengiriman_detail'].'" checked>
								<span class="lbl"></span>
							</td>
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
