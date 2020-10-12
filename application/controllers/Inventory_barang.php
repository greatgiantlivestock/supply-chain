<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class inventory_barang extends CI_Controller {

	public function index() {
		redirect(base_url());
	}

	public function transfer() {
		if($this->session->userdata('hak_akses') == "admin") {
			$d['pengiriman_detail'] = "";
			$d['disabled'] = "disabled";
			$d['color'] = "";
			$d['judul'] = 'Data Transfer Barang';
			$d['combo_rph'] = $this->App_model->get_combo_rph();	
			$d['combo_transfer'] = $this->App_model->get_combo_transfer();	
			$d['tanggal_transfer'] = "";
			$d['keterangan_transfer'] = "";
			$d['transfer_detail'] = "";
			$d['id_transfer'] = "";
			$d['tipe'] = 'add';	
			$d['btn_batal'] = "";
			$d['name_button'] = 'Proses';
			$d['required'] = "required";
			$this->load->view('top',$d);
			$this->load->view('menu');
			$this->load->view('inventory_barang/transfer');
			$this->load->view('bottom');
		}
		else {
			redirect("login");
		}
	}

	public function tampil_transfer($id) {
		if($this->session->userdata('hak_akses') == "admin" || $id != null) {

			$d['judul'] = 'Data Transfer Barang';
			$get_transfer = $this->db->query("SELECT * FROM transfer_barang WHERE id_transfer = '$id'")->row();

			$d['id_transfer'] = $get_transfer->id_transfer;
			$d['tanggal_transfer'] = $get_transfer->tanggal_transfer;
			$d['combo_rph'] = $this->App_model->get_combo_rph($get_transfer->id_rph);	
			$d['combo_transfer'] = $this->App_model->get_combo_transfer($get_transfer->id_transfer);			
			$d['keterangan_transfer'] = $get_transfer->keterangan_transfer;	


			$d['transfer_detail'] = $this->App_model->get_transfer_detail($id);
			$d['name_button'] = 'Ubah Data';
			$d['disabled'] = "";
			$d['required'] = "";
			$d['color'] = 'background:#ffffe1;';
			$d['tipe'] = 'edit';
			$d['btn_batal'] = '<a class="btn btn-default btn-small" style="margin-left: 40px;" href="'.base_url().'inventory_barang/transfer">
											<i class="ace-icon fa fa-close"></i>
											<span class="bigger-110">Batal</span>
										</a>';	

			$d['combo_barang'] = $this->App_model->get_combo_barang_non();	

			$this->load->view('top',$d);
			$this->load->view('menu');
			$this->load->view('inventory_barang/transfer.php');
			$this->load->view('bottom');
		}
		else {
			redirect("login");
		}
	}

	public function save_transfer() {
		if($this->session->userdata('hak_akses') == "admin") {
			$tipe = $this->input->post("tipe");

			$where["id_transfer"] = $this->input->post("id_transfer");
			$in["tanggal_transfer"] = $this->input->post("tanggal_transfer");
			$in["keterangan_transfer"] = $this->input->post("keterangan_transfer");
			$in["id_rph"] = $this->input->post("id_rph");

			if($tipe == "add") { 
				$get_id = $this->db->query("SELECT MAX(no_transfer) AS nomor FROM transfer_barang")->row();
	  			$no_akhir = $get_id->nomor;
	  			$tanggal = "IVN.".date("ymd",strtotime($this->input->post('tanggal_transfer'))).".";
				$in['no_transfer'] = buatkode($no_akhir, $tanggal, 4);

				$this->db->insert("transfer_barang",$in);
				$last_id = $this->db->insert_id();
				redirect("inventory_barang/tampil_transfer/".$last_id);

			} else if($tipe == "edit") {
				$this->db->update("transfer_barang",$in,$where);
				redirect("inventory_barang/tampil_transfer/".$where["id_transfer"]);
			}

				
		}
		else {
			redirect("login");
		}
	}

	public function save_transfer_detail() {
		if($this->session->userdata('hak_akses') == "admin") {
			$in["id_transfer"] = $this->input->post("id_transfer");
			$in["id_barang"] = $this->input->post("id_barang");
			$in["qty"] = $this->input->post("qty");
			$this->db->insert("transfer_barang_detail",$in);
			redirect("inventory_barang/tampil_transfer/".$in["id_transfer"]);
		} else {
			redirect("login");
		}
	}



	public function hapus($id) {
		if($this->session->userdata('hak_akses') == "admin" && $id != null) {
			$this->db->delete("transfer_barang",array('id_transfer' => $id));				
			$this->session->set_flashdata("success","Hapus Data Transfer Barang Berhasil");
			redirect("inventory_barang/transfer");			
		} else {
			redirect("login");
		}
	}



	public function kartu_stok() {
		if($this->session->userdata('hak_akses') == "admin") {
			$d['judul'] = 'Laporan Kartu Stok Sapi';
			$d['kartu_stok'] = '';		
			$d['tanggal1'] = '';
			$d['tanggal2'] = '';
			$d['combo_rph'] = $this->App_model->get_combo_rph();
			$d['combo_barang'] = $this->App_model->get_combo_barang_non();	
			$this->load->view('top',$d);
			$this->load->view('menu');
			$this->load->view('inventory_barang/kartu_stok');
			$this->load->view('bottom');
		}
		else {
			redirect("login");
		}
	}

	public function lihat_kartu_stok() {
		if($this->session->userdata('hak_akses') == "admin") {
			$d['judul'] = 'Laporan Kartu Stok Sapi';
			$d['kartu_stok'] = '';		
			$d['tanggal1'] = $this->input->post("tanggal1");
			$d['tanggal2'] = $this->input->post("tanggal2");
			$d['combo_rph'] = $this->App_model->get_combo_rph($this->input->post("id_rph"));
			$d['id_rph'] = $this->input->post("id_rph");
			$this->load->view('top',$d);
			$this->load->view('menu');
			$this->load->view('laporan_data_sapi/laporan_kartu_stok');
			$this->load->view('bottom');
		}
		else {
			redirect("login");
		}
	}


}
