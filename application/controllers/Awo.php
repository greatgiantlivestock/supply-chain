<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class awo extends CI_Controller {
public function index() {
		if($this->session->userdata('hak_akses') == "admin") {
			$d['awo'] = $this->App_model->get_awo();
			$d['judul'] = 'Data AWO';		
			$d['combo_rph'] = $this->App_model->get_combo_rph();
			$this->load->view('top',$d);
			$this->load->view('menu');
			$this->load->view('awo/awo_tabel.php');
			$this->load->view('bottom');
		}
		else {
			redirect("login");
		}
	}
	public function add() {
		if($this->session->userdata('hak_akses') == "admin") {
			$d['judul'] = 'Tambah Data AWO';	
			$d['tipe'] = 'add';
			$d['id_awo'] = '';
			$d['input_type'] = '';
			$d['nama_awo'] = '';
			$d['alamat'] = '';
			$d['telpon_awo'] = '';
			$d['mac'] = '';
			$d['username'] = '';
			$d['password'] = '';
			$d['combo_rph'] = $this->App_model->get_combo_rph();
			$this->load->view('top',$d);	
			$this->load->view('menu');
			$this->load->view('awo/awo_input');
			$this->load->view('bottom');
		}
		else {
			redirect("login");
		}
	}
	public function edit($id=null) {
		if($this->session->userdata('hak_akses') == "admin" && $id != null) {
			$where['id_awo'] = $id;
			$get_id = $this->db->get_where("mst_awo",$where)->row();		
			$d['judul'] = 'Edit Data AWO';			
			$d['tipe'] = 'edit';
			$d['id_awo'] = $get_id->id_awo;
			$d['input_type'] = $get_id->input_type;
			$d['nama_awo'] = $get_id->nama_awo;
			$d['telpon_awo'] = $get_id->telpon_awo;
			// $d['username'] = $get_id->username;
			// $d['password'] = $get_id->password;
			$d['alamat'] = $get_id->alamat;
			// $d['mac'] = $get_id->mac;
			// $d['combo_rph'] = $this->App_model->get_combo_rph($get_id->id_rph);
			$this->load->view('top');
			$this->load->view('menu',$d);
			$this->load->view('awo/awo_edit');
			$this->load->view('bottom');			
		} else {
			redirect("login");
		}
	}
	public function save() {
		if($this->session->userdata('hak_akses') == "admin") {
			$required = array('nama_awo');
			$error = false;
			foreach($required as $field) {
				if(empty($_POST[$field])) {
					$error = true;
				}
			}
			$tipe = $this->input->post("tipe");	
			$where['id_awo'] 	= $this->input->post('id_awo');
			$in['nama_awo'] 		= $this->input->post('nama_awo');
			$in['input_type'] 		= $this->input->post('input_type');
			$in['telpon_awo'] 		= $this->input->post('telpon_awo');
			$in['alamat'] 		= $this->input->post('alamat');
			// $in['username'] 		= $this->input->post('username');
			// $in['password'] 		= $this->input->post('password');
			// if(!empty($this->input->post('mac'))) {				
			// 	$in['mac'] 		= $this->input->post('mac');
			// }
			if($tipe == "add") {
				$cek_mac = $this->db->query("SELECT * FROM mst_awo WHERE telpon_awo = '$in[telpon_awo]'");
				if($cek_mac->num_rows() > 0) {
					$this->session->set_flashdata("error","Karyawan Sudah Terdaftar/Nomor HP sudah digunakan");
					redirect("awo/add");	
				}				
				if($error) {
					$this->session->set_flashdata("error","Inputan Nama Awo & RPH tidak boleh kosong");
					redirect("awo/add");	
				} else {
					$this->db->insert("mst_awo",$in);
					$insert_id = $this->db->insert_id();
					$in1['id_rph'] 		= $this->input->post('id_rph');
					$in1['id_awo'] 		= $insert_id;
					$this->db->insert("mst_rph_user",$in1);
					$this->session->set_flashdata("success","Input Data AWO Berhasil");
					redirect("awo");
				}
			} elseif($tipe = 'edit') {
				if($error) {
					$this->session->set_flashdata("error","Inputan Nama Awo tidak boleh kosong");
					redirect("awo/edit/".$this->input->post('id_awo'));	
				} else {					
					// $in['id_rph'] 		= $this->input->post('id_rph');
					$this->db->update("mst_awo",$in,$where);
					$this->session->set_flashdata("success","Edit Data AWO Berhasil");
					redirect("awo");
				}		
			} else {
				redirect("awo");
			}
		} else {
			redirect("login");
		}
	}
	public function save_detail_rph() {
		if($this->session->userdata('hak_akses') == "admin") {
			$required = array('nama_awo');
			$error = false;
			foreach($required as $field) {
				if(empty($_POST[$field])) {
					$error = true;
				}
			}
			$in['id_rph'] = $this->input->post('id_rph');
			$in['id_awo'] = $this->input->post('id_awo');
			$this->db->insert("mst_rph_user",$in);
			$this->session->set_flashdata("success","Tambah Data RPH Berhasil");
			redirect("awo");
		} else {
			redirect("login");
		}
	}
	public function hapus($id) {
		if($this->session->userdata('hak_akses') == "admin" && $id != null) {
			$this->db->delete("mst_awo",array('id_awo' => $id));				
			$this->session->set_flashdata("success","Hapus Data AWO Berhasil");
			redirect("awo");			
		} else {
			redirect("login");
		}
	}
	public function hapus_rph_user($id) {
		if($this->session->userdata('hak_akses') == "admin" && $id != null) {
			$this->db->delete("mst_rph_user",array('id_user_rph' => $id));				
			$this->session->set_flashdata("success","Hapus Data RPH/Depo Karyawan Berhasil");
			redirect("awo");			
		} else {
			redirect("login");
		}
	}
	public function get_awo_rph() {
		$id_awo = $this->input->post("id_awo");
		$no = 1;	
		$get = $this->db->query("SELECT * FROM mst_rph_user JOIN mst_rph ON mst_rph_user.id_rph=mst_rph.id_rph JOIN mst_awo ON mst_awo.id_awo=mst_rph_user.id_awo WHERE mst_rph_user.id_awo = '$id_awo'");
		echo '<table class="table table-bordered">
					<thead>
						<tr>
							<th>No.</th>
							<th>Nama Karyawan</th>
							<th>Nama RPH</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>';
		foreach($get->result_array() as $data) { 
					echo '<tr>
							<td>'.$no.'</td>
							<td>'.$data['nama_awo'].'</td>
							<td>'.$data['nama_rph'].'</td>
							<td>'.'<a href="awo/hapus_rph_user/'.$data['id_user_rph'].'"> Hapus</a>'.'</td>
						  </tr>';
		$no++; }
		echo		'</tbody>
				</table>';	
	}
}
