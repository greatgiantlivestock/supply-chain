<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class barang extends CI_Controller {

	public function index() {
		if($this->session->userdata('hak_akses') == "admin") {
			$d['barang'] = $this->App_model->get_barang();
			$d['judul'] = 'Data Barang';		
			$this->load->view('top',$d);
			$this->load->view('menu');
			$this->load->view('barang/barang_tabel.php');
			$this->load->view('bottom');
		}
		else {
			redirect("login");
		}
	}

	public function jenis() {
		if($this->session->userdata('hak_akses') == "admin") {
			$d['jenis'] = $this->App_model->get_jenis_barang();
			$d['judul'] = 'Data Jenis Barang';		
			$this->load->view('top',$d);
			$this->load->view('menu');
			$this->load->view('barang/jenis_tabel.php');
			$this->load->view('bottom');
		}
		else {
			redirect("login");
		}
	}

	public function jenis_add() {
		if($this->session->userdata('hak_akses') == "admin") {
			$d['judul'] = 'Tambah Jenis Barang';	
			$d['tipe'] = 'add';
			$d['id_jenis_barang'] = '';
			$d['nama_barang'] = '';
			$d['merk'] = '';
			$this->load->view('top',$d);	
			$this->load->view('menu');
			$this->load->view('barang/jenis_input');
			$this->load->view('bottom');
		}
		else {
			redirect("login");
		}
	}

	public function jenis_edit($id) {
		if($this->session->userdata('hak_akses') == "admin" && $id != null) {
			$where['id_barang'] = $id;
			$get_id = $this->db->get_where("mst_jenis_barang",$where)->row();		
			$d['judul'] = 'Edit Jenis Barang';			
			$d['tipe'] = 'edit';
			$d['id_jenis_barang'] = $get_id->id_jenis_barang;
			$d['nama_barang'] = $get_id->nama_barang;
			$d['merk'] = $get_id->merk;

			$this->load->view('top');
			$this->load->view('menu',$d);
			$this->load->view('barang/barang_input');
			$this->load->view('bottom');			
		} else {
			redirect("login");
		}
	}

	public function save_jenis() {
		if($this->session->userdata('hak_akses') == "admin") {

			$tipe = $this->input->post("tipe");	
			$where['id_jenis_barang'] 	= $this->input->post('id_barang');
			$in['nama_barang'] 		= $this->input->post('nama_barang');
			$in['merk'] 		= $this->input->post('merk');

			if($tipe == "add") {				
				$this->db->insert("mst_jenis_barang",$in);
				$this->session->set_flashdata("success","Input Jenis Barang Berhasil");
				redirect("barang/jenis");
			} elseif($tipe = 'edit') {
				$this->db->update("mst_jenis_barang",$in,$where);
				$this->session->set_flashdata("success","Edit Jenis Barang Berhasil");
				redirect("barang/jenis");		
			} else {
				redirect("barang/jenis");
			}
		} else {
			redirect("login");
		}
	}

	public function jenis_hapus($id) {
		if($this->session->userdata('hak_akses') == "admin" && $id != null) {
			$this->db->delete("mst_jenis_barang",array('id_jenis_barang' => $id));				
			$this->session->set_flashdata("success","Hapus Data Barang Berhasil");
			redirect("barang/jenis");			
		} else {
			redirect("login");
		}
	}


	public function add() {
		if($this->session->userdata('hak_akses') == "admin") {
			$d['judul'] = 'Tambah Data Barang';	
			$d['tipe'] = 'add';
			$d['id_barang'] = '';
			$d['combo_jenis_barang'] = $this->App_model->get_combo_jenis();
			$d['identitas'] = '';
			$this->load->view('top',$d);	
			$this->load->view('menu');
			$this->load->view('barang/barang_input');
			$this->load->view('bottom');
		}
		else {
			redirect("login");
		}
	}

	public function edit($id=null) {
		if($this->session->userdata('hak_akses') == "admin" && $id != null) {
			$where['id_barang'] = $id;
			$get_id = $this->db->get_where("mst_barang",$where)->row();		
			$d['judul'] = 'Edit Data Barang';			
			$d['tipe'] = 'edit';
			$d['id_barang'] = $get_id->id_barang;
			$d['identitas'] = $get_id->identitas;
			$d['combo_jenis_barang'] = $this->App_model->get_combo_jenis($get_id->id_jenis_barang);

			$this->load->view('top');
			$this->load->view('menu',$d);
			$this->load->view('barang/barang_input');
			$this->load->view('bottom');			
		} else {
			redirect("login");
		}
	}


	public function save() {
		if($this->session->userdata('hak_akses') == "admin") {
	
			$tipe = $this->input->post("tipe");	
			$where['id_barang'] 	= $this->input->post('id_barang');
			$in['id_jenis_barang'] 		= $this->input->post('id_jenis_barang');
			$in['identitas'] 		= $this->input->post('identitas');

			$cek = $this->db->query("SELECT * FROM mst_barang WHERE identitas = '$in[identitas]' AND id_jenis_barang = '$in[id_jenis_barang]'");

			if($cek->num_rows() > 0) {
				$this->session->set_flashdata("error","Barang Sudah ada");
				redirect("barang/add");
			} else if($tipe == "add") {				
				$this->db->insert("mst_barang",$in);
				$this->session->set_flashdata("success","Input Data Barang Berhasil");
				redirect("barang");
			} elseif($tipe = 'edit') {
				$this->db->update("mst_barang",$in,$where);
				$this->session->set_flashdata("success","Edit Data Barang Berhasil");
				redirect("barang");		
			} else {
				redirect("barang");
			}
		} else {
			redirect("login");
		}
	}

	public function hapus($id) {
		if($this->session->userdata('hak_akses') == "admin" && $id != null) {
			$this->db->delete("mst_barang",array('id_barang' => $id));				
			$this->session->set_flashdata("success","Hapus Data Barang Berhasil");
			redirect("barang");			
		} else {
			redirect("login");
		}
	}


}
