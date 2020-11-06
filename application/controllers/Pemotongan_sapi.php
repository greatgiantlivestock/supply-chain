<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class pemotongan_sapi extends CI_Controller {
	public function index() {
		redirect(base_url());
	} 
	public function traceability() {
		if($this->session->userdata('hak_akses') == "awo"||$this->session->userdata('hak_akses') == "admin") {
			$id_rph = $this->session->userdata("id_awo");			
			$d['pemotongan_sapi_ggl'] = $this->App_model->get_penerimaan_detail_rph($id_rph,'');
			// $d['pemotongan_sapi_ntf'] = $this->App_model->get_penerimaan_detail_rph($id_rph,'NTF');
			// $d['pemotongan_sapi_po'] = $this->App_model->get_penerimaan_detail_rph($id_rph,'PO');
			// $d['pemotongan_sapi_depot'] = $this->App_model->get_penerimaan_detail_rph($id_rph,'Depot');
			$d['judul'] = 'Data Traceability Pemotongan Sapi';	
			$d['tanggal_awal'] = "";
			$d['tanggal_akhir'] = "";		
			$d['status_potong'] = "";	
			$this->load->view('top',$d);
			$this->load->view('menu');
			$this->load->view('pemotongan_sapi/pemotongan_tracebility');
			$this->load->view('bottom');
		}
		else {
			redirect("login");
		}
	}
	public function lihat_traceability() {
		if($this->session->userdata('hak_akses') == "awo"||$this->session->userdata('hak_akses') == "admin") {
			$id_rph = $this->session->userdata("id_awo");	
			$d['tanggal_awal'] = $this->input->post("tanggal_awal");
			$d['tanggal_akhir'] = $this->input->post("tanggal_akhir");			
			$d['status_potong'] = "";
			$d['pemotongan_sapi_ggl'] = $this->App_model->get_penerimaan_detail_rph_tgl($id_rph,'',$d['tanggal_awal'],$d['tanggal_akhir']);
			// $d['pemotongan_sapi_ntf'] = $this->App_model->get_penerimaan_detail_rph_tgl($id_rph,'NTF',$d['tanggal_awal'],$d['tanggal_akhir']);
			// $d['pemotongan_sapi_po'] = $this->App_model->get_penerimaan_detail_rph_tgl($id_rph,'PO',$d['tanggal_awal'],$d['tanggal_akhir']);
			// $d['pemotongan_sapi_depot'] = $this->App_model->get_penerimaan_detail_rph_tgl($id_rph,'Depot',$d['tanggal_awal'],$d['tanggal_akhir']);
			$d['judul'] = 'Data Traceability Pemotongan Sapi';		
			$this->load->view('top',$d);
			$this->load->view('menu');
			$this->load->view('pemotongan_sapi/pemotongan_tracebility');
			$this->load->view('bottom');
		}
		else {
			redirect("login");
		}
	}
	public function hasil_pemotongan() {
		if($this->session->userdata('hak_akses') == "awo"||$this->session->userdata('hak_akses') == "admin") {
			$id_rph = $this->session->userdata("id_awo");
			$d['pemotongan_sapi_ggl'] = $this->App_model->get_penerimaan_detail_rph2($id_rph,'');
			// $d['pemotongan_sapi_ntf'] = $this->App_model->get_penerimaan_detail_rph2($id_rph,'NTF');
			// $d['pemotongan_sapi_po'] = $this->App_model->get_penerimaan_detail_rph2($id_rph,'PO');
			// $d['pemotongan_sapi_depot'] = $this->App_model->get_penerimaan_detail_rph2($id_rph,'Depot');
			$d['pemotongan_sapi_ggl_stts'] = $this->App_model->get_penerimaan_detail_rph2_stts($id_rph,'');
			// $d['pemotongan_sapi_ntf_stts'] = $this->App_model->get_penerimaan_detail_rph2_stts($id_rph,'NTF');
			// $d['pemotongan_sapi_po_stts'] = $this->App_model->get_penerimaan_detail_rph2_stts($id_rph,'PO');
			// $d['pemotongan_sapi_depot_stts'] = $this->App_model->get_penerimaan_detail_rph2_stts($id_rph,'Depot');
			$d['judul'] = 'Data Hasil Pemotongan Sapi';	
			$d['tanggal_awal'] = "";
			$d['tanggal_akhir'] = "";	
			$d['status_potong'] = "";		
			$this->load->view('top',$d);
			$this->load->view('menu');
			$this->load->view('pemotongan_sapi/pemotongan_hasil');
			$this->load->view('bottom');
		}
		else {
			redirect("login");
		}
	}
	public function hasil_pemotongan_estimasi() {
		if($this->session->userdata('hak_akses') == "awo"||$this->session->userdata('hak_akses') == "admin") {
			$id_rph = $this->session->userdata("id_awo");
			$d['pemotongan_sapi_ggl'] = $this->App_model->get_penerimaan_detail_rph2($id_rph,'');
			// $d['pemotongan_sapi_ntf'] = $this->App_model->get_penerimaan_detail_rph2($id_rph,'NTF');
			// $d['pemotongan_sapi_po'] = $this->App_model->get_penerimaan_detail_rph2($id_rph,'PO');
			// $d['pemotongan_sapi_depot'] = $this->App_model->get_penerimaan_detail_rph2($id_rph,'Depot');
			$d['pemotongan_sapi_ggl_stts'] = $this->App_model->get_penerimaan_detail_rph2_stts($id_rph,'');
			// $d['pemotongan_sapi_ntf_stts'] = $this->App_model->get_penerimaan_detail_rph2_stts($id_rph,'NTF');
			// $d['pemotongan_sapi_po_stts'] = $this->App_model->get_penerimaan_detail_rph2_stts($id_rph,'PO');
			// $d['pemotongan_sapi_depot_stts'] = $this->App_model->get_penerimaan_detail_rph2_stts($id_rph,'Depot');
			$d['judul'] = 'Data Hasil Pemotongan Sapi';	
			$d['tanggal_awal'] = "";
			$d['tanggal_akhir'] = "";	
			$d['status_potong'] = "";		
			$this->load->view('top',$d);
			$this->load->view('menu');
			$this->load->view('pemotongan_sapi/pemotongan_hasil1');
			$this->load->view('bottom');
		}
		else {
			redirect("login");
		}
	}
	public function lihat_hasil_pemotongan() {
		if($this->session->userdata('hak_akses') == "awo"||$this->session->userdata('hak_akses') == "admin") {
			if($this->input->post("tanggal_akhir")==""){
				$id_rph = $this->session->userdata("id_awo");
				$d['tanggal_awal'] = '';
				$d['tanggal_akhir'] = '';		
				$d['status_potong'] = $this->input->post("status_potong");
				$d['pemotongan_sapi_ggl'] = $this->App_model->get_penerimaan_detail_rph2_no_tgl($id_rph,'',$d['status_potong']);
				// $d['pemotongan_sapi_ntf'] = $this->App_model->get_penerimaan_detail_rph2_no_tgl($id_rph,'NTF',$d['status_potong']);
				// $d['pemotongan_sapi_po'] = $this->App_model->get_penerimaan_detail_rph2_no_tgl($id_rph,'PO',$d['status_potong']);
				$d['pemotongan_sapi_ggl_stts'] = $this->App_model->get_penerimaan_detail_rph2_no_tgl_stts($id_rph,'',$d['status_potong']);
				// $d['pemotongan_sapi_ntf_stts'] = $this->App_model->get_penerimaan_detail_rph2_no_tgl_stts($id_rph,'NTF',$d['status_potong']);
				// $d['pemotongan_sapi_po_stts'] = $this->App_model->get_penerimaan_detail_rph2_no_tgl_stts($id_rph,'PO',$d['status_potong']);
			}else{
				$id_rph = $this->session->userdata("id_awo");
				$d['tanggal_awal'] = $this->input->post("tanggal_awal");
				$d['tanggal_akhir'] = $this->input->post("tanggal_akhir");	
				$d['status_potong'] = $this->input->post("status_potong");	
				$d['pemotongan_sapi_ggl'] = $this->App_model->get_penerimaan_detail_rph2_tgl($id_rph,'',$d['tanggal_awal'],$d['tanggal_akhir'],$d['status_potong']);
				// $d['pemotongan_sapi_ntf'] = $this->App_model->get_penerimaan_detail_rph2_tgl($id_rph,'NTF',$d['tanggal_awal'],$d['tanggal_akhir'],$d['status_potong']);
				// $d['pemotongan_sapi_po'] = $this->App_model->get_penerimaan_detail_rph2_tgl($id_rph,'PO',$d['tanggal_awal'],$d['tanggal_akhir'],$d['status_potong']);
				$d['pemotongan_sapi_ggl_stts'] = $this->App_model->get_penerimaan_detail_rph2_tgl_stts($id_rph,'',$d['tanggal_awal'],$d['tanggal_akhir'],$d['status_potong']);
				// $d['pemotongan_sapi_ntf_stts'] = $this->App_model->get_penerimaan_detail_rph2_tgl_stts($id_rph,'NTF',$d['tanggal_awal'],$d['tanggal_akhir'],$d['status_potong']);
				// $d['pemotongan_sapi_po_stts'] = $this->App_model->get_penerimaan_detail_rph2_tgl_stts($id_rph,'PO',$d['tanggal_awal'],$d['tanggal_akhir'],$d['status_potong']);	
			}
			$d['judul'] = 'Data Hasil Pemotongan Sapi';	
			$this->load->view('top',$d);
			$this->load->view('menu');
			$this->load->view('pemotongan_sapi/pemotongan_hasil');
			$this->load->view('bottom');
		}
		else {
			redirect("login");
		}
	}
	public function laporkan_admin(){
		date_default_timezone_set("Asia/Bangkok");
		$date = date("Ymd");
		if($this->input->post("ck_id_detail") != ''){
			$getNR = $this->db->query("SELECT max(nomor_release) as jml FROM mst_release")->row();
			$noRelease = $getNR->jml+1;
			foreach($this->input->post("ck_id_detail") as $data_id) {
				$id_rph = $this->session->userdata("id_awo");
				$get = $this->db->query("SELECT abattoir,move_to,tanggal_terima,jam_terima,pengiriman.id_rph,penerimaan_detail.* FROM penerimaan_detail JOIN pengiriman ON 
									penerimaan_detail.id_pengiriman=pengiriman.id_pengiriman JOIN movement_log ON movement_log.id_pengiriman=pengiriman.id_pengiriman 
									JOIN mst_rph_user ON mst_rph_user.id_rph=pengiriman.id_rph
									WHERE mst_rph_user.id_awo='$id_rph' AND status_potong = '1' AND id_penerimaan_detail='$data_id'")->row();
				// $qdata1=$this->db->query("SELECT id_detail_request,nama_product,qty FROM detail_request dr JOIN mst_product mp ON dr.id_product=mp.id_product WHERE id_request='$data_id' AND delete_id=0 order by urutan ASC");
				// foreach($qdata1->result_array() as $rows){
					// $getBD = $this->db->query("SELECT beast_id FROM pengiriman_detail WHERE rfid='$get->rfid'")->row();
					// $data_id_detail = $rows['id_detail_request'];
					// $fp = fopen("../interface/To/RS_".$noRelease."_".$date.".txt","a") or die("Unable to open file!");
					// $fp1 = fopen("../interface/To_backup/RS_".$noRelease."_".$date.".txt","a") or die("Unable to open file!");
					// $qRelease=$this->App_model->get_release_order_final($data_id_detail)->row(); 
					// $data1 = $getBD->beast_id;
					// $data2 = $get->abattoir;
					// $data7 = $get->move_to;
					// $data7a = $data7."                                   ";
					// $data3 = str_replace("-","",$get->tanggal_potong);
					// $data4 = str_replace(":","",$get->jam_potong);
					// $data8 = str_replace("-","",$get->tanggal_terima);
					// $data9 = str_replace(":","",$get->jam_terima);
					// $data5a = strpos($get->berat_karkas,'.');
					// $data5b = strpos($get->berat_karkas,',');
					// if($data5a==''){
					// 	if($data5b==''){
					// 		$data5c = '000000000000000'.$get->berat_karkas.'00';
					// 	}else{
					// 		$data5c = '000000000000000'.number_format((float)$get->berat_karkas, 2, '', '');
					// 	}
					// }else{
					// 	$data5c = '000000000000000'.number_format((float)$get->berat_karkas, 2, '', '');
					// }
					// $data6a = strpos($get->berat_prosot,'.');
					// $data6b = strpos($get->berat_prosot,',');
					// if($data6a==''){
					// 	if($data6b==''){
					// 		$data6c = '000000000000000'.$get->berat_prosot.'00';
					// 	}else{
					// 		$data6c = '000000000000000'.number_format((float)$get->berat_prosot, 2, '', '');
					// 	}
					// }else{
					// 	$data6c = '000000000000000'.number_format((float)$get->berat_prosot, 2, '', '');
					// }
					// $content = $data1.$data2.substr($data7a,0,35).$data3.$data4.substr($data5c,-8).substr($data6c,-8).$data8.$data9."\n";
					// if($data1 != ''){
						// fwrite($fp,$content);
						// fclose($fp);
						// fwrite($fp1,$content);
						// fclose($fp1);
						// $id_awo = $this->session->userdata("id");
						// $id_awo = $this->session->userdata("id_awo");
						$where['id_penerimaan_detail'] = $data_id;
						$inUpdate['status_potong'] = 2;
						$inLG['id_penerimaan_detail'] = $data_id;
						$inLG['id_awo'] = $id_rph;
						$inLG['id_rph'] = $get->id_rph;
						$inLG['log'] = "LOG".".".$id_rph.".".$get->tanggal_potong.".".date("His");
						$inLG['tanggal_laporan'] = date("Y-m-d");
						$inLG['jam'] = date("H:i:s");
						$inLG['status'] = 1;
						// $inR['id_penerimaan_detail'] = $data_id;
						// $inR['nomor_release'] = $noRelease;
						$this->db->insert("pemotongan_log",$inLG);
						// $this->db->insert("mst_release",$inR);
						$this->db->update("penerimaan_detail",$inUpdate,$where);
						// $inRelease['release_id'] = 1;
						// $whereRelease['id_detail_request'] = $data_id_detail;
						// $this->db->update("detail_request",$inRelease,$whereRelease);
						$this->session->set_flashdata("success_update","Release Data Hasil Potong Sukses");
					// }else{
					// 	fclose($fp);
					// 	fclose($fp1);
					// 	unlink("../interface/To/RS_".$noRelease."_".$date.".txt");
					// 	unlink("../interface/To_backup/RS_".$noRelease."_".$date.".txt");
					// 	$this->session->set_flashdata("error_update","Sebagian Data Hasil Potong Gagal Dirilis");
					// }
				// }
			}
			redirect("pemotongan_sapi/hasil_pemotongan");
		}else{
			$this->session->set_flashdata("error","Belum ada data yang dipilih, silahkan pilih data release terlebih dahulu");
			redirect("pemotongan_sapi/hasil_pemotongan");
		}	
	}
	public function get_pengiriman() {
		$id_pengiriman = $this->input->post("id_pengiriman");
		$id_rph = $this->session->userdata("id_awo");
		$no = 1;	
		$get = $this->db->query("SELECT * FROM pengiriman JOIN penerimaan_detail ON pengiriman.id_pengiriman=penerimaan_detail.id_pengiriman 
								JOIN mst_rph_user ON mst_rph_user.id_rph=pengiriman.id_rph
								WHERE mst_rph_user.id_awo='$id_rph' AND status_potong='1'");
		echo '<table id="dataTables-example" class="table table-bordered">
					<thead>
						<tr>
							<th><input style="width:20px;height:20px;" type="checkbox" id="checkAll"/> All </th>
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
								<input style="width:20px;height:20px;" class="check" id="rel_id" type="checkbox" name="ck_id_detail[]" value="'.$data['id_penerimaan_detail'].'">
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
	public function upload_potong() {
		// if($this->session->userdata('hak_akses') == "awo") {
		// 	$config['upload_path'] = './upload/';
		// 	$config['allowed_types']= 'csv';
		// 	$config['encrypt_name']	= TRUE;
		// 	$config['remove_spaces']	= TRUE;	
		// 	$config['max_size']     = '0';
		// 	$this->load->library('upload', $config);
		// 	if($this->upload->do_upload("file_upload")) {
		// 		$data_upload	 	= $this->upload->data();
		// 		$fp = fopen("./upload/".$data_upload["file_name"],"r");
		// 		//$fp = fopen("./upload/avb.csv","r");
		// 		while (($data = fgetcsv($fp, 1000, ",")) !== FALSE)
		// 		{
		// 			for ($i=0; $i < count($data) ; $i++) { 
		// 					$array[] = $data[$i];
		// 			}
		// 		}
		// 		fclose($fp); 
		// 		$filter_array = array_filter($array);
		// 		$i = 0;
		// 		foreach($filter_array as $data_array) {
		// 			if($i > 3) {
		// 				$fix_array[] = $data_array;
		// 			}
		// 			$i++;
		// 		}
		// 		$chunk = array_chunk($fix_array, 3);
		// 		foreach ($chunk as $key => $value) {
		// 			if (strpos($value[1], '/') !== false) {
		// 				$ex_tanggal = explode("/", $value[1]);
		// 				$tanggal_potong = $ex_tanggal[2]."-".$ex_tanggal[0]."-".$ex_tanggal[1];
		// 			} if (strpos($value[1], '-') !== false) {
		// 				$ex_tanggal = explode("-", $value[1]);
		// 				$tanggal_potong = $value[1];
		// 			}
		// 			$where['rfid'] = $value[0];
		// 			$where['intransit'] = "0";
		// 			$in['tanggal_potong'] = $tanggal_potong;
		// 			$in['status_potong'] = '1';
		// 			$in['jam_potong'] = $value[2];
		// 			$cek = $this->db->query("SELECT pengiriman.id_rph,penerimaan_detail.rfid FROM penerimaan_detail INNER JOIN pengiriman 
		// 									ON penerimaan_detail.id_pengiriman = pengiriman.id_pengiriman WHERE penerimaan_detail.rfid = 
		// 									'$where[rfid]' AND intransit='0'")->row();
		// 			if($cek->id_rph == $this->session->userdata("id_rph"))
		// 			$this->db->update("penerimaan_detail",$in,$where);
		// 		}
		// 		@unlink("./upload/".$data_upload['file_name']);
		// 		redirect("pemotongan_sapi/traceability");
		// 		//echo '<pre>';
		// 		//print_r($fix_array);
		// 		//echo '</pre>';
		// 		//echo '<pre>';
		// 		//print_r($chunk);
		// 		//echo '</pre>';
		// 	} else {
		// 		$this->session->set_flashdata("error",$this->upload->display_errors());
		// 		redirect("pemotongan_sapi/traceability");
		// 	}
		// } else {
		// 	redirect("login");
		// }
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
					$countX = 0;
						for ($row = 2; $row <= $highestRow; $row++){ 
							$rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
															NULL,
															TRUE,
															FALSE);
							$data_impC=$rowData[0][0];
							$last_char = substr($data_impC,-1); 

							if($last_char==";"){
								$rfid_impC=substr($data_impC,0,16);
								$tanggal_impC = substr($data_impC,-20,-10);
								$waktu = substr($data_impC,-9,-1);
								$jam_impC=str_replace('.', ':', $waktu);
	
								$qCount = $this->db->query("SELECT COUNT(id_penerimaan_detail) AS  jml, penerimaan_detail.id_pengiriman FROM penerimaan_detail JOIN pengiriman ON pengiriman.`id_pengiriman`=penerimaan_detail.`id_pengiriman` JOIN mst_rph_user ON mst_rph_user.id_rph=pengiriman.id_rph 
															WHERE mst_rph_user.id_awo='$id_awo_impC' AND rfid='$rfid_impC'")->row();    
								if($qCount->jml > 0){
									$qvalStat = $this->db->query("SELECT count(*) as jml FROM penerimaan_detail WHERE status_potong='1' AND rfid='$rfid' AND id_pengiriman='$qCount->id_pengiriman'")->row();
									if($qvalStat->jml==0){
										$where['rfid'] = $rfid_impC;
										$where['id_pengiriman'] = $qCount->id_pengiriman;
										$where['intransit'] = "0";
										$in['status_potong'] = '1';
										$in['tanggal_potong'] = $tanggal_impC;
										$in['jam_potong'] = $jam_impC;
										$this->db->update("penerimaan_detail",$in,$where);
										$countX++;
									}
								}
							}else{
								$rfid_impC=$rowData[0][1];
								$tanggal_impC=$rowData[0][2];
								$jam_impC=$rowData[0][3].":00";

								$qCount = $this->db->query("SELECT COUNT(id_penerimaan_detail) AS  jml, penerimaan_detail.id_pengiriman FROM penerimaan_detail JOIN pengiriman ON pengiriman.`id_pengiriman`=penerimaan_detail.`id_pengiriman` JOIN mst_rph_user ON mst_rph_user.id_rph=pengiriman.id_rph 
															WHERE mst_rph_user.id_awo='$id_awo_impC' AND rfid='$rfid_impC'")->row();    
								if($qCount->jml > 0){
									$qvalStat = $this->db->query("SELECT count(*) as jml FROM penerimaan_detail WHERE status_potong='1' AND rfid='$rfid' AND id_pengiriman='$qCount->id_pengiriman'")->row();
									if($qvalStat->jml==0){
										$where['rfid'] = $rfid_impC;
										$where['id_pengiriman'] = $qCount->id_pengiriman;
										$where['intransit'] = "0";
										$in['status_potong'] = '1';
										$in['tanggal_potong'] = $tanggal_impC;
										$in['jam_potong'] = $jam_impC;
										$this->db->update("penerimaan_detail",$in,$where);
										$countX++;
									}
								}
							}
						}
						if($countX==0){
							$this->session->set_flashdata("error", "Update status potong gagal karena sapi belum diterima atau sudah pernah dipotong sebelumnya ".$tanggal_potong);
						}else{
							$this->session->set_flashdata("success", $countX." Ekor sapi berhasil diupdate status potongnya");
						}
						@unlink("./upload/".$data['file_name']);
						redirect("pemotongan_sapi/traceability");	
				} else {
					$this->session->set_flashdata("error",$this->upload->display_errors());
					redirect("pemotongan_sapi/traceability");
				}			
		}else {
			redirect("login");
		}
	}
	public function update_hasil_potong() {
		if($this->session->userdata('hak_akses') == "awo"||$this->session->userdata('hak_akses') == "admin") {
			$id = $this->input->post("id_penerimaan_detail");
			$in['status_potong'] = '1';
			$in['tanggal_potong'] = $this->input->post("tanggal_potong");
			$in['rfid'] = $this->input->post("rfid");
			$in['berat_karkas'] = $this->input->post("berat_karkas");
			$in['berat_prosot'] = $this->input->post("berat_prosot");
			if($this->input->post("merah")==""){
				$in['merah'] = "0";
			}else{
				$in['merah'] = $this->input->post("merah");
			}
			if($this->input->post("orange")==""){
				$in['orange'] = "0";
			}else{
				$in['orange'] = $this->input->post("orange");
			}
			if($this->input->post("hitam")==""){
				$in['hitam'] = "0";
			}else{
				$in['hitam'] = $this->input->post("hitam");
			}
			if($this->input->post("kuning")==""){
				$in['kuning'] = "0";
			}else{
				$in['kuning'] = $this->input->post("kuning");
			}
			if($this->input->post("peneumatic")==''){
				$in['peneumatic'] = 0;
			}else{
				$in['peneumatic'] = $this->input->post("peneumatic");
			}
			if($this->input->post("score")==''){
				$in['score_stune'] = 0;
			}else{
				$in['score_stune'] = $this->input->post("score");
			}
			$in['keterangan_potong'] = $this->input->post("keterangan_potong");
			$in['pasar'] = $this->input->post("pasar");
			$in['nama_pedagang'] = $this->input->post("nama_pedagang");
			$in['jam_potong'] = $this->input->post("jam_potong");
			if($this->input->post("flag") != "") {
				$in['flag'] = '1';
			} else {
				$in['flag'] = '0';
			} 
			if($this->input->post("flag1") != "") {
				$in['flag1'] = '1';
			} else {
				$in['flag1'] = '0';
			} 
			$this->db->update("penerimaan_detail",$in,array('id_penerimaan_detail' => $id));
			$this->session->set_flashdata("success","Update data berhasil");
			redirect("pemotongan_sapi/hasil_pemotongan");			
		} else {
			redirect("login");
		}
	}
	public function update_hasil_potong_estimasi() {
		if($this->session->userdata('hak_akses') == "awo"||$this->session->userdata('hak_akses') == "admin") {
			$id = $this->input->post("id_penerimaan_detail");
			$in['status_potong'] = '1';
			$in['tanggal_potong'] = $this->input->post("tanggal_potong");
			$in['rfid'] = $this->input->post("rfid");
			$in['berat_karkas'] = $this->input->post("berat_karkas");
			$in['berat_prosot'] = $this->input->post("berat_prosot");
			// $in['merah'] = $this->input->post("merah");
			// $in['orange'] = $this->input->post("orange");
			// $in['hitam'] = $this->input->post("hitam");
			// $in['kuning'] = $this->input->post("kuning");
			// $in['peneumatic'] = $this->input->post("peneumatic");
			// $in['score_stune'] = $this->input->post("score");
			if($this->input->post("merah")==""){
				$in['merah'] = "0";
			}else{
				$in['merah'] = $this->input->post("merah");
			}
			if($this->input->post("orange")==""){
				$in['orange'] = "0";
			}else{
				$in['orange'] = $this->input->post("orange");
			}
			if($this->input->post("hitam")==""){
				$in['hitam'] = "0";
			}else{
				$in['hitam'] = $this->input->post("hitam");
			}
			if($this->input->post("kuning")==""){
				$in['kuning'] = "0";
			}else{
				$in['kuning'] = $this->input->post("kuning");
			}
			if($this->input->post("peneumatic")==''){
				$in['peneumatic'] = 0;
			}else{
				$in['peneumatic'] = $this->input->post("peneumatic");
			}
			if($this->input->post("score")==''){
				$in['score_stune'] = 0;
			}else{
				$in['score_stune'] = $this->input->post("score");
			}
			$in['keterangan_potong'] = $this->input->post("keterangan_potong");
			$in['pasar'] = $this->input->post("pasar");
			$in['nama_pedagang'] = $this->input->post("nama_pedagang");
			$in['jam_potong'] = $this->input->post("jam_potong");
			if($this->input->post("flag") != "") {
				$in['flag'] = '1';
			} else {
				$in['flag'] = '0';
			} 
			if($this->input->post("flag1") != "") {
				$in['flag1'] = '1';
			} else {
				$in['flag1'] = '0';
			} 
			$this->db->update("penerimaan_detail",$in,array('id_penerimaan_detail' => $id));
			$this->session->set_flashdata("success","Update data berhasil");
			redirect("Pemotongan_sapi/hasil_pemotongan_estimasi");			
		} else {
			redirect("login");
		}
	}
}
