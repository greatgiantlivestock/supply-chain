<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class pengiriman_sapi extends CI_Controller {

	public function index() {
		if($this->session->userdata('hak_akses') == "admin") {
			$d['pengiriman_detail'] = "";
			$d['disable'] = "";
			$d['color'] = "";
			$d['judul'] = 'Data Pengiriman Sapi';
			$d['combo_rph'] = $this->App_model->get_combo_rph();	
			$d['combo_pengiriman'] = $this->App_model->get_combo_pengiriman();	
			$d['combo_asal_sapi'] = $this->App_model->get_combo_asal_sapi();	
			$d['tanggal_kirim'] = "";
			$d['jam_kirim'] = "";
			$d['asal_sapi'] = "";
			$d['keterangan'] = "";
			$d['id_pengiriman'] = "";
			$d['tipe'] = 'add';	
			$d['btn_batal'] = "";
			$d['status_terima'] = "0";
			$d['name_button'] = 'Proses';
			$d['required'] = "required";
			$this->load->view('top',$d);
			$this->load->view('menu');
			$this->load->view('pengiriman_sapi/pengiriman_sapi_tabel.php');
			$this->load->view('bottom');
		}
		else {
			redirect("login");
		}
	}

	public function tampil($id) {
		if($this->session->userdata('hak_akses') == "admin" || $id != null) {

			$d['judul'] = 'Data Pengiriman Sapi';
			$get_pengiriman = $this->db->query("SELECT * FROM pengiriman LEFT JOIN mst_rph ON mst_rph.id_rph = pengiriman.id_rph 
												JOIN movement_log ON pengiriman.id_pengiriman = movement_log.id_pengiriman 
												WHERE pengiriman.id_pengiriman = '$id'")->row();

			$d['id_pengiriman'] = $get_pengiriman->id_pengiriman;
			$d['tanggal_kirim'] = $get_pengiriman->tanggal_kirim;
			$d['jam_kirim'] = $get_pengiriman->jam_kirim;
			$d['combo_rph'] = $this->App_model->get_combo_rph($get_pengiriman->id_rph);	
			$d['combo_pengiriman'] = $this->App_model->get_combo_pengiriman($get_pengiriman->id_pengiriman);			
			$d['combo_asal_sapi'] = $this->App_model->get_combo_asal_sapi($get_pengiriman->move_from);			
			$d['keterangan'] = $get_pengiriman->keterangan;	
			$d['asal_sapi'] = $get_pengiriman->move_from;	

			$d['jam_terima'] = $get_pengiriman->jam_terima;
			$d['tanggal_terima'] = $get_pengiriman->tanggal_terima;
			$d['pengiriman_detail'] = $this->App_model->get_pengiriman_detail($id);
			$d['name_button'] = 'Ubah Data';
			$d['disable'] = "";
			$d['required'] = "";
			$d['color'] = 'background:#ffffe1;';
			$d['tipe'] = 'edit';
			$d['btn_batal'] = '<a class="btn btn-default btn-sm" style="margin-left: 40px;" href="'.base_url().'pengiriman_sapi">
											<i class="ace-icon fa fa-close"></i>
											<span class="bigger-110">Batal</span>
										</a>';	
			$d['status_terima'] = $get_pengiriman->status_terima;
			$this->load->view('top',$d);
			$this->load->view('menu');
			$this->load->view('pengiriman_sapi/pengiriman_sapi_tabel.php');
			$this->load->view('bottom');
		}
		else {
			redirect("login");
		}
	}

	public function save_upload() {
		if($this->session->userdata('hak_akses') == "admin") {
			$tipe = $this->input->post("tipe");

			$where["id_pengiriman"] = $this->input->post("id_pengiriman");
			$in["tanggal_kirim"] = $this->input->post("tanggal_kirim");
			$in["jam_kirim"] = $this->input->post("jam_kirim");
			$in["keterangan"] = $this->input->post("keterangan");
			$in["id_rph"] = $this->input->post("id_rph");
			$in["tanggal_kirim"] = $this->input->post("tanggal_kirim");
			// $in["asal_sapi"] = $this->input->post("asal_sapi");

			$config['upload_path'] = './upload/';
			$config['allowed_types']= 'xls|xlsx|csv';
			$config['encrypt_name']	= TRUE;
			$config['remove_spaces']	= TRUE;	
			$config['max_size']     = '0';

			$this->load->library('upload', $config);
			$this->load->library(array('PHPExcel','PHPExcel/IOFactory'));

			if($tipe == "add") { 
				if($this->upload->do_upload("file_upload")) {
					$data	= $this->upload->data();

					$inputFileType = IOFactory::identify("./upload/".$data['file_name']);
		            $objReader = IOFactory::createReader($inputFileType);
		            $objPHPExcel = $objReader->load("./upload/".$data['file_name']);

		            $sheet = $objPHPExcel->getSheet(0);
		            $highestRow = $sheet->getHighestRow();
					$highestColumn = $sheet->getHighestColumn(); 
                 
					$rowData = $sheet->rangeToArray('A' . 2 . ':' . $highestColumn . 2, // ngambil baris ke 2 dari file excel
													NULL,
			                                        TRUE,
													FALSE);   
					
					$in['no_pengiriman'] = $rowData[0][5];
							
			        $cek = $this->db->query("SELECT no_pengiriman FROM pengiriman WHERE no_pengiriman = '$in[no_pengiriman]'");
			        if($cek->num_rows() > 0) {
						$this->session->set_flashdata("error", "RFID <b>".$inDT['rfid']." </b>Sudah Digunakan, Periksa Kembali");
			            $this->db->delete("pengiriman",array("id_pengiriman"=>$last_id));
			            @unlink("./upload/".$data['file_name']);
			            redirect("pengiriman_sapi");
			        } else {
						$this->db->insert("pengiriman",$in);
								
						$last_id = $this->db->insert_id();
						$id_rph = $this->input->post("id_rph");
						$qRPH = $this->db->query("SELECT nama_rph FROM mst_rph WHERE id_rph='$id_rph'")->row();
						date_default_timezone_set("Asia/Bangkok");

						$inLog["id_pengiriman_transit"] = $last_id;
						$inLog["id_pengiriman"] = $last_id;
						$inLog["asal_sapi"] = $this->input->post("asal_sapi");
						$inLog["move_from"] = $this->input->post("asal_sapi");
						$inLog["move_to"] = $qRPH->nama_rph;
						$inLog["move_time"] = date("Y-m-d H:i:s");
						$inLog["movement_number"] = "Log".".".$id_rph.".".date("ymd").date("Hi");
						$inLog["user"] = $this->session->userdata("nama");

						$this->db->insert("movement_log",$inLog);

						for ($row = 2; $row <= $highestRow; $row++){ 
							$rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
															NULL,
															TRUE,
															FALSE);   

							$inDT['id_pengiriman'] = $last_id;
							$inDT['nota'] = $rowData[0][5];
							$inDT['eartag'] = $rowData[0][0];
							$inDT['shipment'] = $rowData[0][1];
							$inDT['material_description'] = $rowData[0][8];
							$inDT['rfid'] = $rowData[0][2];
							$inDT['berat'] = $rowData[0][4];
							$inDT['customer'] = $rowData[0][7];
							$inDT['no_kendaraan'] = $rowData[0][9];
							$inDT['beast_id'] = $rowData[0][10];
							$inDT['session'] = $rowData[0][11];
							$inDT['type_exit'] = $rowData[0][12];
							$inDT['exporter'] = $rowData[0][13];
									
							$cek = $this->db->query("SELECT rfid FROM pengiriman_detail WHERE rfid = '$inDT[rfid]'");
							if($cek->num_rows() > 0) {
								$this->session->set_flashdata("error", "RFID <b>".$inDT['rfid']." </b>Sudah Digunakan, Periksa Kembali");
								$this->db->delete("pengiriman",array("id_pengiriman"=>$last_id));
								@unlink("./upload/".$data['file_name']);
								redirect("pengiriman_sapi");
							} else {
								$this->db->insert("pengiriman_detail",$inDT);
							}	
						}
						@unlink("./upload/".$data['file_name']);
						redirect("pengiriman_sapi/tampil/".$last_id);	
					}
				} else {
					$this->session->set_flashdata("error",$this->upload->display_errors());
					redirect("pengiriman_sapi");
				}			

			} else if($tipe == "edit") {
				$in["status_terima"] = "0";
				if(!empty($_FILES['file_upload']['name'])) {
					if($this->upload->do_upload("file_upload")) {

						$this->db->delete("pengiriman_detail",$where);
						$data	 	= $this->upload->data();

						$inputFileType = IOFactory::identify("./upload/".$data['file_name']);
		                $objReader = IOFactory::createReader($inputFileType);
		                $objPHPExcel = $objReader->load("./upload/".$data['file_name']);

		                $sheet = $objPHPExcel->getSheet(0);
		            	$highestRow = $sheet->getHighestRow();
		            	$highestColumn = $sheet->getHighestColumn();

						for ($row = 2; $row <= $highestRow; $row++){                  
		                $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
		                                                NULL,
		                                                TRUE,
		                                                FALSE);   

		                $inDT['id_pengiriman'] = $where['id_pengiriman'];
		                $inDT['nota'] = $rowData[0][5];
		                $inDT['eartag'] = $rowData[0][0];
			            $inDT['shipment'] = $rowData[0][1];
			            $inDT['material_description'] = $rowData[0][8];
		                $inDT['rfid'] = $rowData[0][2];
		                $inDT['berat'] = $rowData[0][4];
		                $inDT['customer'] = $rowData[0][7];
		                $inDT['no_kendaraan'] = $rowData[0][9];
						$inDT['beast_id'] = $rowData[0][10];
						$inDT['session'] = $rowData[0][11];
						$inDT['type_exit'] = $rowData[0][12];
						$inDT['exporter'] = $rowData[0][13];

		            	$cek = $this->db->query("SELECT rfid FROM pengiriman_detail WHERE rfid = '$inDT[rfid]'");
			                if($cek->num_rows() > 0) {
			                	$this->session->set_flashdata("error", "RFID <b>".$inDT['rfid']." </b>Sudah Digunakan, Periksa Kembali");
			                	@unlink("./upload/".$data['file_name']);
			                	redirect("pengiriman_sapi/tampil/".$where["id_pengiriman"]);
			                } else {
			            		$this->db->insert("pengiriman_detail",$inDT);
			                }	
		                
		            	}
		            	@unlink("./upload/".$data['file_name']);
						redirect("pengiriman_sapi/tampil/".$where["id_pengiriman"]);
					} else {
						$this->session->set_flashdata("error",$this->upload->display_errors());
						redirect("pengiriman_sapi/tampil/".$where["id_pengiriman"]);
					}
				} else {
					$this->db->update("pengiriman",$in,$where);
					redirect("pengiriman_sapi/tampil/".$where["id_pengiriman"]);
				}
			}
				
		}else {
			redirect("login");
		}
	}

	public function hapus($id) {
		if($this->session->userdata('hak_akses') == "admin" && $id != null) {
			$this->db->delete("pengiriman",array('id_pengiriman' => $id));				
			$this->session->set_flashdata("success","Hapus Data Pengiriman Sapi Berhasil");
			redirect("pengiriman_sapi");			
		} else {
			redirect("login");
		}
	}

}
