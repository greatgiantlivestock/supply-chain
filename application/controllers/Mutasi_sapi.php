<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mutasi_sapi extends CI_Controller {
	public function index() {
		$id= $this->session->userdata("id_awo");
		$qrph = $this->db->query("SELECT jenis_rph FROM mst_rph_user JOIN mst_rph ON mst_rph_user.id_rph=mst_rph.id_rph WHERE id_awo='$id'")->row();
		if($this->session->userdata('hak_akses') == "awo" || $qrph->jenis_rph == 'Depot') {
			// $nama_rph = $this->session->userdata("nama_rph");
			$d['sapi_masuk'] = $this->App_model->get_sapi_mutasi($id);
			$d['sapi_masuk_nota'] = $this->App_model->get_sapi_mutasi_nota();
			$d['judul'] = 'Mutasi Sapi';		
			$d['pengiriman_detail'] = "";
			$d['disable'] = "";
			$d['color'] = "";
			$d['combo_rph'] = $this->App_model->get_combo_rph_filter($id);	
			//$d['combo_pengiriman'] = $this->App_model->get_combo_pengiriman();	
			$d['combo_stock'] = $this->App_model->get_combo_pengiriman_rph_mutasi();
			$d['combo_asal_sapi'] = $this->App_model->get_combo_asal_sapi();
			$d['tanggal_kirim'] = "";
			$d['jam_kirim'] = "";
			$d['asal_sapi'] = "";
			$d['keterangan'] = "";
			$d['asal_sapi'] = "";
			$d['id_pengiriman'] = "";
			$d['tipe'] = 'add';	
			$d['btn_batal'] = "";
			$d['status_terima'] = "0";
			$d['name_button'] = 'Proses';
			$d['required'] = "required";
			$this->load->view('top',$d);
			$this->load->view('menu');
			$this->load->view('mutasi_sapi/mutasi_sapi');
			$this->load->view('bottom');
		}else {
			redirect("login");
		}
	}
	public function get_mutasi() {	
		$no = 1;	
		$get = $this->db->query("SELECT * FROM penerimaan_detail WHERE intransit='5'");
		echo '<table id="tb_modal" class="table table-striped table-bordered table-hover">
					<thead>
						<tr>
							<th><input type="checkbox" onClick="all_check(this)" /> <span class="lbl"></span></th>
							<th>No.</th>
							<th>EARTAG</th>
							<th>RFID</th>
							<th>Nota</th>
							<th>Berat</th>
							<th>Customer</th>
						</tr>
					</thead>
					<tbody>';
		foreach($get->result_array() as $data) { 
					echo '<tr>
							<td><input class="check" type="checkbox" name="ck_id_detail[]" value="'.$data['id_penerimaan_detail'].'" checked>
								<span class="lbl"></span>
							</td>
							<td>'.$no.'</td>
							<td>'.$data['eartag'].'</td>
							<td>'.$data['rfid'].'</td>
							<td>'.$data['nota'].'</td>
							<td>'.$data['berat'].'</td>
							<td>'.$data['customer'].'</td>
						  </tr>';
		$no++; }
		echo		'</tbody>
				</table>';	
	}
	public function ambil_data_stock($id){
		$no = 1;	
		$q1 = $this->db->query("SELECT * FROM penerimaan_detail WHERE intransit='0' AND id_pengiriman='$id'");
		echo '<table id="tb_modal" class="table table-striped table-bordered table-hover">
					<thead>
						<tr>
							<th><input type="checkbox" onClick="all_check(this)" /> <span class="lbl"></span></th>
							<th>No.</th>
							<th>EARTAG</th>
							<th>RFID</th>
							<th>Nota</th>
							<th>Berat</th>
							<th>Customer</th>
						</tr>
					</thead>
					<tbody>';
		foreach($q1->result_array() as $data) { 
					echo '<tr>
							<td><input class="check" type="checkbox" name="ck_id_detail[]" value="'.$data['id_penerimaan_detail'].'" checked>
								<span class="lbl"></span>
							</td>
							<td>'.$no.'</td>
							<td>'.$data['eartag'].'</td>
							<td>'.$data['rfid'].'</td>
							<td>'.$data['nota'].'</td>
							<td>'.$data['berat'].'</td>
							<td>'.$data['customer'].'</td>
						  </tr>';
		$no++; }
		echo		'</tbody>
				</table>';	
	}
	public function get_detail_mutasi() {
		$id_pengiriman = $this->input->post("id_pengiriman");
		$no = 1;	
		$get = $this->db->query("SELECT * FROM pengiriman_detail WHERE id_pengiriman = '$id_pengiriman'");
		echo '<table class="table table-bordered">
					<thead>
						<tr>
							<th>No.</th>
							<th>EARTAG</th>
							<th>RFID</th>
							<th>Nota</th>
							<th>Berat</th>
							<th>Customer</th>
							<th>No.Kendaraan</th>
						</tr>
					</thead>
					<tbody>';
		foreach($get->result_array() as $data) { 
					echo '<tr>
							<td>'.$no.'</td>
							<td>'.$data['eartag'].'</td>
							<td>'.$data['rfid'].'</td>
							<td>'.$data['nota'].'</td>
							<td>'.$data['berat'].'</td>
							<td>'.$data['customer'].'</td>
							<td>'.$data['no_kendaraan'].'</td>
						  </tr>';
		$no++; }
		echo		'</tbody>
				</table>';	
	}
	public function tambah_mutasi() {
		if($this->session->userdata('hak_akses') == "awo") {
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
					$tgl_valid = $this->input->post("tanggal_kirim");
					$jam_valid = $this->input->post("jam_kirim");
					$id_rph_valid = $this->input->post("id_rph");
					$qrph = $this->db->query("SELECT nama_rph,abattoir FROM mst_rph WHERE id_rph='$id_rph_valid'")->row();
						$count_id = 0;
						for ($row = 2; $row <= $highestRow; $row++){ 
							$rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
															NULL,
															TRUE,
															FALSE);
							$rfid_impC=$rowData[0][0];
							$qDt_before = $this->App_model->get_qDt_before($id_awo_impC,$rfid_impC);
							$move_from = $qDt_before->move_to;
							$move_to = $qrph->nama_rph;
							$no_pengiriman = $qDt_before->no_pengiriman;
							if($qDt_before->jml>0){
								$qValidRFID = $this->App_model->get_qValidRFID($no_pengiriman,$rfid_impC);
								if($qValidRFID->jml < 2){
									$qValid = $this->App_model->get_qValid($move_from,$move_to,$no_pengiriman,$tgl_valid);
									if($qValid->jml==0){
										$in['status_terima'] = '0';
										$in['tanggal_kirim'] = $this->input->post("tanggal_kirim");
										$in['jam_kirim'] = $this->input->post("jam_kirim");
										$in['id_rph'] = $this->input->post("id_rph");		
										$in['keterangan'] = $this->input->post("keterangan");		
										$in['no_pengiriman'] = $qDt_before->no_pengiriman;
										$in['transit'] = 1;
										$this->db->insert("pengiriman",$in);
										$last_id = $this->db->insert_id();
										$asal_s = $this->db->query("SELECT asal_sapi,move_to FROM movement_log WHERE id_pengiriman='$qDt_before->id_preimere'")->row();
										date_default_timezone_set("Asia/Bangkok");				
											$inLog["id_pengiriman_transit"] = $qDt_before->id_preimere;
											$inLog["id_pengiriman"] = $last_id;
											$inLog["asal_sapi"] = $qDt_before->asal_sapi;
											$inLog["abattoir"] = $qrph->abattoir;
											$inLog["move_from"] = $qDt_before->move_to;
											$inLog["move_to"] = $qrph->nama_rph;
											$inLog["move_time"] = $in['tanggal_kirim']." ".$in['jam_kirim'];
											$inLog["movement_number"] = "Log".".".$id_rph_valid.".".date("ymd").date("Hi");
											$inLog["user"] = $this->session->userdata("nama");
											$this->db->insert("movement_log",$inLog);

											$where['id_penerimaan_detail'] = $qDt_before->id_penerimaan_detail;
											$inMutasi['id_pengiriman']=$last_id;
											$inMutasi['nota']=$qDt_before->nota;
											$inMutasi['eartag']=$qDt_before->eartag;
											$inMutasi['shipment']=$qDt_before->shipment;
											$inMutasi['material_description']=$qDt_before->material_description;
											$inMutasi['rfid']=$qDt_before->rfid;
											$inMutasi['berat']=$qDt_before->berat;
											$inMutasi['customer']=$qDt_before->customer;
											$inMutasi['no_kendaraan']=$qDt_before->no_kendaraan;
											$inMutasi['beast_id']=$qDt_before->beast_id;
											$inMutasi['session']=$qDt_before->session;
											$inMutasi['type_exit']=$qDt_before->type_exit;
											$inMutasi['exporter']=$qDt_before->exporter;
											$this->db->insert("pengiriman_detail",$inMutasi);
											$inMutasiUpdate['intransit']=1;
											$this->db->update("penerimaan_detail",$inMutasiUpdate,$where);
											$count_id++;
									}else{
										$qValidDt = $this->db->query("SELECT count(pd.id_pengiriman_detail) as jml FROM pengiriman pg JOIN movement_log ml 
													ON ml.id_pengiriman=pg.id_pengiriman JOIN pengiriman_detail pd ON pd.id_pengiriman=pg.id_pengiriman 
													WHERE move_from='$move_from' AND move_to='$move_to' 
													AND pg.no_pengiriman='$no_pengiriman' AND rfid='$rfid_impC'")->row();
										if($qValidDt->jml==0){
											$where['id_penerimaan_detail'] = $qDt_before->id_penerimaan_detail;
											$inMutasi['id_pengiriman']=$qValid->id_pengiriman;
											$inMutasi['nota']=$qDt_before->nota;
											$inMutasi['eartag']=$qDt_before->eartag;
											$inMutasi['shipment']=$qDt_before->shipment;
											$inMutasi['material_description']=$qDt_before->material_description;
											$inMutasi['rfid']=$qDt_before->rfid;
											$inMutasi['berat']=$qDt_before->berat;
											$inMutasi['customer']=$qDt_before->customer;
											$inMutasi['no_kendaraan']=$qDt_before->no_kendaraan;
											$inMutasi['beast_id']=$qDt_before->beast_id;
											$inMutasi['session']=$qDt_before->session;
											$inMutasi['type_exit']=$qDt_before->type_exit;
											$inMutasi['exporter']=$qDt_before->exporter;
											$this->db->insert("pengiriman_detail",$inMutasi);
											$inMutasiUpdate['intransit']=1;
											$this->db->update("penerimaan_detail",$inMutasiUpdate,$where);
											$count_id++;
										}
									}
								}
							}
						}
						if($count_id==0){
							$this->session->set_flashdata("error","Proses mutasi sapi gagal karena sudah pernah diinput sebelumnya atau data sapi tidak ada");
						}else{
							$this->session->set_flashdata("success",$count_id." ekor sapi berhasil dimutasi melalui upload CSV/excel");
						}
						@unlink("./upload/".$data['file_name']);
						redirect("Mutasi_sapi");	
				} else {
					if($this->input->post("ck_id_detail")==""){
						$this->session->set_flashdata("error","Silahkan pilih data detail sapi terlebih dahulu");
						redirect("Mutasi_sapi");
					}else{
						$nota = $this->input->post("nota");				
						$q = $this->db->query("SELECT no_pengiriman,id_rph FROM pengiriman WHERE id_pengiriman='$nota'")->row();
						$in['status_terima'] = '0';
						$in['tanggal_kirim'] = $this->input->post("tanggal_kirim");
						$in['jam_kirim'] = $this->input->post("jam_kirim");
						$in['id_rph'] = $this->input->post("id_rph");		
						$in['keterangan'] = $this->input->post("keterangan");		
						$in['no_pengiriman'] = $q->no_pengiriman;
						$this->db->insert("pengiriman",$in);
						$last_id = $this->db->insert_id();
						$id_rphfrom = $q->id_rph;
						$qRPHfrom = $this->db->query("SELECT nama_rph FROM mst_rph WHERE id_rph='$id_rphfrom'")->row();
						$id_rphto = $this->input->post("id_rph");
						$qRPHto = $this->db->query("SELECT abattoir,nama_rph FROM mst_rph WHERE id_rph='$id_rphto'")->row();
						$asal_s = $this->db->query("SELECT asal_sapi FROM movement_log WHERE id_pengiriman='$nota'")->row();
						date_default_timezone_set("Asia/Bangkok");				
							$inLog["id_pengiriman_transit"] = $nota;
							$inLog["id_pengiriman"] = $last_id;
							$inLog["asal_sapi"] = $asal_s->asal_sapi;
							$inLog["abattoir"] = $qRPHto->abattoir;
							$inLog["move_from"] = $qRPHfrom->nama_rph;
							$inLog["move_to"] = $qRPHto->nama_rph;
							$inLog["move_time"] = date("Y-m-d H:i:s");
							$inLog["movement_number"] = "Log".".".$id_rphto.".".date("ymd").date("Hi");
							$inLog["user"] = $this->session->userdata("nama");
							$this->db->insert("movement_log",$inLog);
						foreach($this->input->post("ck_id_detail") as $data_id) {
							$where['id_penerimaan_detail'] = $data_id;
							$data_last = $this->db->query("SELECT penerimaan_detail.*, pengiriman_detail.session,pengiriman_detail.type_exit,pengiriman_detail.exporter 
							FROM penerimaan_detail JOIN pengiriman_detail ON penerimaan_detail.id_pengiriman=pengiriman_detail.id_pengiriman 
							AND penerimaan_detail.beast_id=pengiriman_detail.beast_id WHERE id_penerimaan_detail='$data_id'")->row();//memindahkan data dr table penerimaan ke detail pengiriman as transit
							// $data_last = $this->db->query("SELECT * FROM penerimaan_detail WHERE id_penerimaan_detail='$data_id'")->row();//memindahkan data dr table penerimaan ke detail pengiriman as transit
							//$data_last = $this->db->query("SELECT * FROM pengiriman_detail WHERE id_pengiriman_detail = '".$data_id."'")->row();
							//$last_id1 = $last_id;
							$inMutasi['id_pengiriman']=$last_id;
							$inMutasi['nota']=$data_last->nota;
							$inMutasi['eartag']=$data_last->eartag;
							$inMutasi['shipment']=$data_last->shipment;
							$inMutasi['material_description']=$data_last->material_description;
							$inMutasi['rfid']=$data_last->rfid;
							$inMutasi['berat']=$data_last->berat;
							$inMutasi['customer']=$data_last->customer;
							$inMutasi['no_kendaraan']=$data_last->no_kendaraan;
							$inMutasi['beast_id']=$data_last->beast_id;
							$inMutasi['session']=$data_last->session;
							$inMutasi['type_exit']=$data_last->type_exit;
							$inMutasi['exporter']=$data_last->exporter;
							$this->db->insert("pengiriman_detail",$inMutasi);
							$inMutasiUpdate['intransit']=1;
							$this->db->update("penerimaan_detail",$inMutasiUpdate,$where);
						}
						$inIN['transit'] = 1;
						$whereIN['no_pengiriman'] = $q->no_pengiriman;
						$this->db->update("pengiriman",$inIN,$whereIN);
						// $in['status_terima'] = '1';
						// $this->db->update("pengiriman",$in,array('id_pengiriman' => $id));
						$this->session->set_flashdata("success","Data mutasi sapi berhasi ditambahkan");
						redirect("Mutasi_sapi");
					}	
				}
		} else {
			$this->session->set_flashdata("error","Login anda tidak mempunyai akses ke menu mutasi");
			redirect("login");
		}
	}
	// public function ambil_data($id){
	// 	$get=$this->db->query("SELECT asal_sapi FROM movement_log JOIN pengiriman ON pengiriman.id_pengiriman=movement_log.id_pengiriman 
	// 							WHERE movement_log.id_pengiriman='192' GROUP BY asal_sapi")->row();
	// 	echo $get->asal_sapi;
	// }
}
