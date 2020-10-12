<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class rph extends CI_Controller {

public function index() {
		if($this->session->userdata('hak_akses') == "admin") {
			$d['rph'] = $this->App_model->get_rph_mutasi();
			$d['combo_rph'] = $this->App_model->get_combo_rph_depo();
			$d['combo_rph_mutasi'] = $this->App_model->get_combo_rph_only();
			$d['judul'] = 'Data RPH/Depo';		
			$this->load->view('top',$d);
			$this->load->view('menu'); 
			$this->load->view('rph/rph_tabel.php');
			$this->load->view('bottom');
		}
		else {
			redirect("login");
		}
	}

	public function add() {
		if($this->session->userdata('hak_akses') == "admin") {
			$d['judul'] = 'Tambah Data RPH';	
			$d['tipe'] = 'add';
			$d['id_rph'] = '';
			$d['nama_rph'] = '';
			$d['kota'] = '';
			$d['alamat'] = '';
			$d['koordinat'] = '';
			$d['jenis_rph'] = '';
			$d['jenis_berat'] = '';
			$this->load->view('top',$d);	
			$this->load->view('menu');
			$this->load->view('rph/rph_input');
			$this->load->view('bottom');
		}
		else {
			redirect("login");
		}
	}

	public function save_detail_rph() {
		if($this->session->userdata('hak_akses') == "admin") {
			$required = array('id_rph','id_rph_mutasi');
			$error = false;
			foreach($required as $field) {
				if(empty($_POST[$field])) {
					$error = true;
				}
			}
			$in['id_rph'] = $this->input->post('id_rph');
			$in['id_rph_mutasi'] = $this->input->post('id_rph_mutasi');
			$this->db->insert("mst_rph_child",$in);
			$this->session->set_flashdata("success","Tambah Data RPH Berhasil");
			redirect("Rph");
		} else {
			redirect("login");
		}
	}

	public function get_rph_mutasi() {
		$id_rph = $this->input->post("id_rph");
		$no = 1;	
		$get = $this->db->query("SELECT data1.*,mst_rph.nama_rph AS nama_rph1 FROM(SELECT mst_rph.*,id_rph_mutasi FROM mst_rph JOIN mst_rph_child ON mst_rph.id_rph=mst_rph_child.id_rph)AS data1 
		LEFT JOIN mst_rph ON mst_rph.id_rph=data1.id_rph_mutasi WHERE data1.id_rph='$id_rph'");
		echo '<table class="table table-bordered">
					<thead>
						<tr>
							<th>No.</th>
							<th>Nama Depo</th>
							<th>Nama RPH</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>';
		foreach($get->result_array() as $data) { 
					echo '<tr>
							<td>'.$no.'</td>
							<td>'.$data['nama_rph'].'</td>
							<td>'.$data['nama_rph1'].'</td>
							<td>'.'<a href="Rph/hapus_rph_user/'.$data['id_rph_mutasi'].'"> Hapus</a>'.'</td>
						  </tr>';
		$no++; }
		echo		'</tbody>
				</table>';	
	}

	public function hapus_rph_user($id) {
		if($this->session->userdata('hak_akses') == "admin" && $id != null) {
			$this->db->delete("mst_rph_child",array('id_rph_mutasi' => $id));				
			$this->session->set_flashdata("success","Hapus Data RPH berhasil");
			redirect("Rph");			
		} else {
			redirect("login");
		}
	}

	public function edit($id=null) {
		if($this->session->userdata('hak_akses') == "admin" && $id != null) {
			$where['id_rph'] = $id;
			$get_id = $this->db->get_where("mst_rph",$where)->row();		
			$d['judul'] = 'Edit Data RPH';			
			$d['tipe'] = 'edit';
			$d['id_rph'] = $get_id->id_rph;
			$d['nama_rph'] = $get_id->nama_rph;
			$d['kota'] = $get_id->kota;
			$d['alamat'] = $get_id->alamat;
			$d['koordinat'] = $get_id->koordinat;
			$d['jenis_rph'] = $get_id->jenis_rph;
			$d['jenis_berat'] = $get_id->jenis_berat;

			$this->load->view('top');
			$this->load->view('menu',$d);
			$this->load->view('rph/rph_input');
			$this->load->view('bottom');			
		} else {
			redirect("login");
		}
	}


	public function save() {
		if($this->session->userdata('hak_akses') == "admin") {
			$required = array('nama_rph','jenis_rph');
			$error = false;
			foreach($required as $field) {
				if(empty($_POST[$field])) {
					$error = true;
				}
			}
			$tipe = $this->input->post("tipe");	
			$where['id_rph'] 	= $this->input->post('id_rph');
			$in['nama_rph'] 		= $this->input->post('nama_rph');
			$in['jenis_rph'] 		= $this->input->post('jenis_rph');
			$in['jenis_berat'] 		= $this->input->post('jenis_berat');
			$in['kota'] 		= $this->input->post('kota');
			$in['alamat'] 		= $this->input->post('alamat');
			$in['koordinat'] 		= $this->input->post('koordinat');

			if($tipe == "add") {				
				if($error) {
					$this->session->set_flashdata("error","Inputkan data dengan lengkap");
					redirect("rph/add");	
				} else {
					$this->db->insert("mst_rph",$in);
					$this->session->set_flashdata("success","Input Data RPH Berhasil");
					redirect("rph");
				}
			} elseif($tipe = 'edit') {
				if($error) {
					$this->session->set_flashdata("error","Inputkan data dengan lengkap");
					redirect("rph/edit/".$this->input->post('id_rph'));	
				} else {
					$this->db->update("mst_rph",$in,$where);
					$this->session->set_flashdata("success","Edit Data RPH Berhasil");
					redirect("rph");
				}		
			} else {
				redirect("rph");
			}
		} else {
			redirect("login");
		}
	}

	public function hapus($id) {
		if($this->session->userdata('hak_akses') == "admin" && $id != null) {
			$this->db->delete("mst_rph",array('id_rph' => $id));				
			$this->session->set_flashdata("success","Hapus Data RPH Berhasil");
			redirect("rph");			
		} else {
			redirect("login");
		}
	}


}
