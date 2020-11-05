<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class app_model extends CI_Model {
	public function cekLogin($in) { 
		$username = $in['username'];
		$password = md5($in['password']);
		// $password_awo = $in['password'];
		$q_admin = $this->db->query("SELECT mst_login.*,mst_awo.input_type FROM mst_login JOIN mst_awo ON mst_login.id_awo=mst_awo.id_awo WHERE username='$username' AND password='$password'");
		// $q_awo = $this->db->query("SELECT * FROM mst_awo LEFT JOIN mst_rph ON mst_awo.id_rph = mst_rph.id_rph WHERE username='$username' AND password='$password_awo'");
		if($q_admin->num_rows() > 0) {
			foreach($q_admin->result() as $data) {
				$session['nama'] = $data->nama;
				$session['username'] = $data->username;
				$session['id'] = $data->id_login;
				$session['id_awo'] = $data->id_awo;
				$session['id_login'] = $data->id_login;
				$session['id_role'] = $data->id_role;
				$session['input_type'] = $data->input_type;
				if($data->id_role<=2){
					$session['hak_akses'] = 'admin';
				}else if($data->id_role>2){
					$session['hak_akses'] = 'awo';
				}
				$this->session->set_userdata($session);
			}
			redirect("app");
		} 
		// else if($q_awo->num_rows() > 0) {
		// 	foreach($q_awo->result() as $data) {
		// 		$session['nama'] = $data->nama_awo;
		// 		$session['nama_rph'] = $data->nama_rph;
		// 		$session['username'] = $data->username;
		// 		$session['id'] = $data->id_awo;
		// 		$session['id_rph'] = $data->id_rph;
		// 		$session['jenis_berat'] = $data->jenis_berat;
		// 		$session['hak_akses'] = 'awo';
		// 		$this->session->set_userdata($session);
		// 	}
		// 	redirect("app");
		// }
		else {
			$this->session->set_flashdata("error","Gagal Login, Username dan Password Salah");
			redirect("login");
		}
	}
	public function cekLoginAndroid($in) {
		$username = $in['username'];
		$password = $in['password'];
		$mac = $in['mac'];
		$q_awo = $this->db->query("SELECT * FROM mst_awo WHERE username='$username' AND password='$password'");
		if($q_awo->num_rows() > 0) {
			foreach($q_awo->result() as $data) {
				if($data->mac != $mac) {
					$res['out']['response'] = 'successy';
				} else {
					$res['out']['response'] = 'success';
				}
				$res['out']['id_awo'] = $data->id_awo;
				$res['out']['nama_awo'] = $data->nama_awo;
				echo json_encode($res);
			}
		} else {
			$res['out']['response'] = 'successx';
			$res['out']['id_awo'] = "";
			$res['out']['nama_awo'] = "";
			echo json_encode($res);
		}
	}
	public function get_asset_awo() {
		$q = $this->db->query("SELECT * FROM asset_awo 							
													LEFT JOIN mst_barang ON mst_barang.id_barang = asset_awo.id_barang 
													LEFT JOIN mst_jenis_barang ON mst_barang.id_jenis_barang = mst_jenis_barang.id_jenis_barang 
													LEFT JOIN mst_awo ON mst_awo.id_awo = asset_awo.id_awo 
													LEFT JOIN mst_rph ON mst_rph.id_rph = mst_awo.id_rph 
													ORDER BY tanggal DESC");
		return $q;
	}
	// public function get_data_mutasi($tanggal1,$tanggal2,$nota,$rph1,$rph2) {
	// 	$q = $this->db->query("SELECT * FROM movement_log ml JOIN pengiriman pg ON ml.id_pengiriman = pg.id_pengiriman
	// 					WHERE no_pengiriman ='$nota' AND ");
	// 	return $q;
	// }
	public function get_asset_rph() {
		$q = $this->db->query("SELECT * FROM asset_rph 							
													LEFT JOIN mst_barang ON mst_barang.id_barang = asset_rph.id_barang 
													LEFT JOIN mst_jenis_barang ON mst_barang.id_jenis_barang = mst_jenis_barang.id_jenis_barang 
													LEFT JOIN mst_rph ON mst_rph.id_rph = asset_rph.id_rph 
													ORDER BY tanggal DESC");
		return $q;
	}
	public function get_barang() {
		$q = $this->db->query("SELECT * FROM mst_barang LEFT JOIN mst_jenis_barang ON mst_barang.id_jenis_barang = mst_jenis_barang.id_jenis_barang ORDER BY id_barang DESC");
		return $q;
	}
	public function ambil_data_stock($id){
		$no=1;
		$q = $this->db->query("SELECT * FROM penerimaan_detail WHERE intransit='0' AND id_pengiriman='$id'");
		return $q;
	}
	public function get_jenis_barang() {
		$q = $this->db->query("SELECT * FROM mst_jenis_barang ORDER BY id_jenis_barang DESC");
		return $q;
	}
	public function get_barang_by_name() {
		$q = $this->db->query("SELECT * FROM mst_barang LEFT JOIN mst_jenis_barang ON mst_barang.id_jenis_barang = mst_jenis_barang.id_jenis_barang ORDER BY nama_barang DESC");
		return $q;
	}
	public function get_rph() {
		$q = $this->db->query("SELECT * FROM mst_rph ORDER BY id_rph DESC");
		return $q;
	}
	public function get_rph_mutasi() {
		$q = $this->db->query("SELECT mst_rph.*,jml FROM mst_rph LEFT JOIN(SELECT id_rph,COUNT(*)AS jml 
						FROM mst_rph_child GROUP BY id_rph)AS data1 ON mst_rph.id_rph=data1.id_rph");
		return $q;
	}
	public function get_awo() {
		$q = $this->db->query("SELECT mst_awo.*, jml FROM (SELECT id_awo,count(id_user_rph) as jml FROM mst_rph_user GROUP BY id_awo) as data1 RIGHT JOIN mst_awo ON mst_awo.id_awo=data1.id_awo WHERE NOT (mst_awo.id_awo='99' or mst_awo.id_awo='105') ORDER BY nama_awo ASC");
		return $q;
	}
	public function get_user() {
		$q = $this->db->query("SELECT * FROM mst_login JOIN mst_role ON mst_login.id_role=mst_role.id_role ORDER BY nama ASC");
		return $q;
	}
	public function get_kartu_asset_awo($tanggal) {
		$q = $this->db->query("SELECT * FROM
									    asset_awo
									    LEFT JOIN mst_barang 
									        ON (mst_barang.id_barang = asset_awo.id_barang) 
									    LEFT JOIN mst_jenis_barang ON mst_barang.id_jenis_barang = mst_jenis_barang.id_jenis_barang 
									    LEFT JOIN mst_awo 
									        ON (mst_awo.id_awo = asset_awo.id_awo) 
									    LEFT JOIN mst_rph 
									        ON (mst_rph.id_rph = mst_awo.id_rph) WHERE asset_awo.tanggal <= '$tanggal' ORDER BY asset_awo.tanggal DESC");
		return $q;
	}
	public function get_kondisi_asset_awo($tanggal1,$tanggal2,$keadaan_barang,$nama_barang,$nama_awo) {
		$q = $this->db->query("SELECT * FROM
									    asset_awo_kondisi
									    LEFT JOIN mst_barang 
									        ON (mst_barang.id_barang = asset_awo_kondisi.id_barang) 
									        LEFT JOIN mst_jenis_barang ON mst_barang.id_jenis_barang = mst_jenis_barang.id_jenis_barang 
									    LEFT JOIN mst_awo 
									        ON (mst_awo.id_awo = asset_awo_kondisi.id_awo) 
									    LEFT JOIN mst_rph 
									        ON (mst_rph.id_rph = mst_awo.id_rph) WHERE asset_awo_kondisi.tanggal >= '$tanggal1' AND asset_awo_kondisi.tanggal <= '$tanggal2'  AND (asset_awo_kondisi.keadaan_barang LIKE '%$keadaan_barang%' AND mst_awo.nama_awo LIKE '%$nama_awo%') AND asset_awo_kondisi.id_barang = '$nama_barang' ORDER BY asset_awo_kondisi.tanggal DESC");
		return $q;
	}
	public function get_kondisi_asset_awo_all($tanggal1,$tanggal2,$keadaan_barang,$nama_awo) {
		$q = $this->db->query("SELECT * FROM
									    asset_awo_kondisi
									    LEFT JOIN mst_barang 
									        ON (mst_barang.id_barang = asset_awo_kondisi.id_barang) 
									        LEFT JOIN mst_jenis_barang ON mst_barang.id_jenis_barang = mst_jenis_barang.id_jenis_barang 
									    LEFT JOIN mst_awo 
									        ON (mst_awo.id_awo = asset_awo_kondisi.id_awo) 
									    LEFT JOIN mst_rph 
									        ON (mst_rph.id_rph = mst_awo.id_rph) WHERE asset_awo_kondisi.tanggal >= '$tanggal1' AND asset_awo_kondisi.tanggal <= '$tanggal2'  AND (asset_awo_kondisi.keadaan_barang LIKE '%$keadaan_barang%' AND mst_awo.nama_awo LIKE '%$nama_awo%') ORDER BY asset_awo_kondisi.tanggal DESC");
		return $q;
	}
	public function get_mutasi_asset_awo($tanggal1,$tanggal2,$nama_barang) {
		$q = $this->db->query("SELECT * FROM
									    asset_awo_mutasi
									    LEFT JOIN mst_barang 
									        ON (mst_barang.id_barang = asset_awo_mutasi.id_barang) 
									        LEFT JOIN mst_jenis_barang ON mst_barang.id_jenis_barang = mst_jenis_barang.id_jenis_barang 
									    LEFT JOIN mst_awo 
									        ON (mst_awo.id_awo = asset_awo_mutasi.id_awo) WHERE asset_awo_mutasi.tanggal >= '$tanggal1' AND asset_awo_mutasi.tanggal <= '$tanggal2' AND asset_awo_mutasi.id_barang = '$nama_barang' ORDER BY asset_awo_mutasi.tanggal DESC");
		return $q;
	}
	public function get_mutasi_asset_awo_all($tanggal1,$tanggal2) {
		$q = $this->db->query("SELECT * FROM
									    asset_awo_mutasi
									    LEFT JOIN mst_barang 
									        ON (mst_barang.id_barang = asset_awo_mutasi.id_barang) 
									        LEFT JOIN mst_jenis_barang ON mst_barang.id_jenis_barang = mst_jenis_barang.id_jenis_barang 
									    LEFT JOIN mst_awo 
									        ON (mst_awo.id_awo = asset_awo_mutasi.id_awo) WHERE asset_awo_mutasi.tanggal >= '$tanggal1' AND asset_awo_mutasi.tanggal <= '$tanggal2' ORDER BY asset_awo_mutasi.tanggal DESC");
		return $q;
	}
	public function get_replacement_asset_awo($tanggal1,$tanggal2,$nama_barang,$nama_awo) {
		$q = $this->db->query("SELECT * FROM
									    asset_awo_replacement
									    LEFT JOIN mst_barang 
									        ON (mst_barang.id_barang = asset_awo_replacement.id_barang) 
									        LEFT JOIN mst_jenis_barang ON mst_barang.id_jenis_barang = mst_jenis_barang.id_jenis_barang 
									    LEFT JOIN mst_awo 
									        ON (mst_awo.id_awo = asset_awo_replacement.id_awo) WHERE asset_awo_replacement.tanggal >= '$tanggal1' AND asset_awo_replacement.tanggal <= '$tanggal2' AND mst_awo.nama_awo LIKE '%$nama_awo%' AND asset_awo_replacement.id_barang = '$nama_barang'  ORDER BY asset_awo_replacement.tanggal DESC");
		return $q;
	}
	public function get_replacement_asset_awo_all($tanggal1,$tanggal2,$nama_awo) {
		$q = $this->db->query("SELECT * FROM
									    asset_awo_replacement
									    LEFT JOIN mst_barang 
									        ON (mst_barang.id_barang = asset_awo_replacement.id_barang) 
									        LEFT JOIN mst_jenis_barang ON mst_barang.id_jenis_barang = mst_jenis_barang.id_jenis_barang 
									    LEFT JOIN mst_awo 
									        ON (mst_awo.id_awo = asset_awo_replacement.id_awo) WHERE asset_awo_replacement.tanggal >= '$tanggal1' AND asset_awo_replacement.tanggal <= '$tanggal2' AND (mst_awo.nama_awo LIKE '%$nama_awo%') ORDER BY asset_awo_replacement.tanggal DESC");
		return $q;
	}
	public function get_kartu_inventaris_rph($tanggal) {
		$q = $this->db->query("SELECT * FROM
									    asset_rph
									    LEFT JOIN mst_barang 
									        ON (mst_barang.id_barang = asset_rph.id_barang) 
									        LEFT JOIN mst_jenis_barang ON mst_barang.id_jenis_barang = mst_jenis_barang.id_jenis_barang 
									    LEFT JOIN mst_rph 
									        ON (mst_rph.id_rph = asset_rph.id_rph) WHERE asset_rph.tanggal <= '$tanggal' ORDER BY asset_rph.tanggal DESC");
		return $q;
	}
	public function get_kondisi_asset_rph($tanggal1,$tanggal2,$keadaan_barang,$nama_barang,$nama_rph) {
		$q = $this->db->query("SELECT * FROM
									    asset_rph_kondisi
									    LEFT JOIN mst_barang 
									        ON (mst_barang.id_barang = asset_rph_kondisi.id_barang) 
									        LEFT JOIN mst_jenis_barang ON mst_barang.id_jenis_barang = mst_jenis_barang.id_jenis_barang 
									    LEFT JOIN mst_rph 
									        ON (mst_rph.id_rph = asset_rph_kondisi.id_rph) WHERE asset_rph_kondisi.tanggal >= '$tanggal1' AND asset_rph_kondisi.tanggal <= '$tanggal2'  AND (asset_rph_kondisi.keadaan_barang LIKE '%$keadaan_barang%' AND mst_rph.nama_rph LIKE '%$nama_rph%') AND asset_rph_kondisi.id_barang = '$nama_barang' ORDER BY asset_rph_kondisi.tanggal DESC");
		return $q;
	}
	public function get_kondisi_asset_rph_all($tanggal1,$tanggal2,$keadaan_barang,$nama_rph) {
		$q = $this->db->query("SELECT * FROM
									    asset_rph_kondisi
									    LEFT JOIN mst_barang 
									        ON (mst_barang.id_barang = asset_rph_kondisi.id_barang) 
									        LEFT JOIN mst_jenis_barang ON mst_barang.id_jenis_barang = mst_jenis_barang.id_jenis_barang 
									    LEFT JOIN mst_rph 
									        ON (mst_rph.id_rph = asset_rph_kondisi.id_rph) WHERE asset_rph_kondisi.tanggal >= '$tanggal1' AND asset_rph_kondisi.tanggal <= '$tanggal2'  AND (asset_rph_kondisi.keadaan_barang LIKE '%$keadaan_barang%' AND mst_rph.nama_rph LIKE '%$nama_rph%') ORDER BY asset_rph_kondisi.tanggal DESC");
		return $q;
	}
	public function get_mutasi_asset_rph($tanggal1,$tanggal2,$nama_barang) {
		$q = $this->db->query("SELECT * FROM
									    asset_rph_mutasi
									    LEFT JOIN mst_barang 
									        ON (mst_barang.id_barang = asset_rph_mutasi.id_barang) 
									        LEFT JOIN mst_jenis_barang ON mst_barang.id_jenis_barang = mst_jenis_barang.id_jenis_barang 
									    LEFT JOIN mst_rph 
									        ON (mst_rph.id_rph = asset_rph_mutasi.id_rph) WHERE asset_rph_mutasi.tanggal >= '$tanggal1' AND asset_rph_mutasi.tanggal <= '$tanggal2' AND asset_rph_mutasi.id_barang = '$nama_barang' ORDER BY asset_rph_mutasi.tanggal DESC");
		return $q;
	}
	public function get_mutasi_asset_rph_all($tanggal1,$tanggal2) {
		$q = $this->db->query("SELECT * FROM
									    asset_rph_mutasi
									    LEFT JOIN mst_barang 
									        ON (mst_barang.id_barang = asset_rph_mutasi.id_barang) 
									        LEFT JOIN mst_jenis_barang ON mst_barang.id_jenis_barang = mst_jenis_barang.id_jenis_barang 
									    LEFT JOIN mst_rph 
									        ON (mst_rph.id_rph = asset_rph_mutasi.id_rph) WHERE asset_rph_mutasi.tanggal >= '$tanggal1' AND asset_rph_mutasi.tanggal <= '$tanggal2' ORDER BY asset_rph_mutasi.tanggal DESC");
		return $q;
	}
	public function get_replacement_asset_rph($tanggal1,$tanggal2,$nama_barang,$nama_rph) {
		$q = $this->db->query("SELECT * FROM
									    asset_rph_replacement
									    LEFT JOIN mst_barang 
									        ON (mst_barang.id_barang = asset_rph_replacement.id_barang) 
									        LEFT JOIN mst_jenis_barang ON mst_barang.id_jenis_barang = mst_jenis_barang.id_jenis_barang 
									    LEFT JOIN mst_rph 
									        ON (mst_rph.id_rph = asset_rph_replacement.id_rph) WHERE asset_rph_replacement.tanggal >= '$tanggal1' AND asset_rph_replacement.tanggal <= '$tanggal2' AND mst_rph.nama_rph LIKE '%$nama_rph%' AND asset_rph_replacement.id_barang = '$nama_barang' ORDER BY asset_rph_replacement.tanggal DESC");
		return $q;
	}
	public function get_replacement_asset_rph_all($tanggal1,$tanggal2,$nama_rph) {
		$q = $this->db->query("SELECT * FROM
									    asset_rph_replacement
									    LEFT JOIN mst_barang 
									        ON (mst_barang.id_barang = asset_rph_replacement.id_barang) 
									        LEFT JOIN mst_jenis_barang ON mst_barang.id_jenis_barang = mst_jenis_barang.id_jenis_barang 
									    LEFT JOIN mst_rph 
									        ON (mst_rph.id_rph = asset_rph_replacement.id_rph) WHERE asset_rph_replacement.tanggal >= '$tanggal1' AND asset_rph_replacement.tanggal <= '$tanggal2' AND mst_rph.nama_rph LIKE '%$nama_rph%' ORDER BY asset_rph_replacement.tanggal DESC");
		return $q;
	}
	public function get_pengiriman_detail($id) {
		$q = $this->db->query("SELECT * FROM pengiriman_detail WHERE id_pengiriman = '$id'");
		return $q;
	}
	public function get_penerimaan_detail_rph($id,$asal_sapi) {
		// if($asal_sapi=="GGL"||$asal_sapi=="NTF"||$asal_sapi=="PO"){
			$q = $this->db->query("SELECT * FROM penerimaan_detail INNER JOIN pengiriman ON pengiriman.id_pengiriman = penerimaan_detail.id_pengiriman 
								INNER JOIN movement_log ON pengiriman.id_pengiriman=movement_log.id_pengiriman
								JOIN mst_rph_user ON mst_rph_user.id_rph=pengiriman.id_rph
								WHERE mst_rph_user.id_awo = '$id' AND pengiriman.status_terima = '1' 
								AND asal_sapi like '%$asal_sapi%' ORDER BY penerimaan_detail.status_potong DESC");
		// }
		return $q;
	}
	public function get_penerimaan_detail_rph_tgl($id,$asal_sapi,$tanggal_awal,$tanggal_akhir) {
		// if($asal_sapi=="GGL"||$asal_sapi=="NTF"||$asal_sapi=="PO"){
			// $q = $this->db->query("SELECT * FROM penerimaan_detail INNER JOIN pengiriman ON pengiriman.id_pengiriman = penerimaan_detail.id_pengiriman 
			// 					INNER JOIN movement_log ON pengiriman.id_pengiriman=movement_log.id_pengiriman
			// 					WHERE pengiriman.tanggal_terima >= '$tanggal_awal' AND pengiriman.tanggal_terima <= '$tanggal_akhir' 
			// 					AND pengiriman.id_rph = '$id' AND pengiriman.status_terima = '1' 
			// 					AND asal_sapi like '%$asal_sapi%' ORDER BY penerimaan_detail.id_penerimaan_detail DESC");
			$q = $this->db->query("SELECT * FROM penerimaan_detail INNER JOIN pengiriman ON pengiriman.id_pengiriman = penerimaan_detail.id_pengiriman 
								INNER JOIN movement_log ON pengiriman.id_pengiriman=movement_log.id_pengiriman
								JOIN mst_rph_user ON mst_rph_user.id_rph=pengiriman.id_rph
								WHERE pengiriman.tanggal_terima >= '$tanggal_awal' AND pengiriman.tanggal_terima <= '$tanggal_akhir'
								AND mst_rph_user.id_awo = '$id' AND pengiriman.status_terima = '1' 
								AND asal_sapi like '%$asal_sapi%' ORDER BY penerimaan_detail.status_potong DESC");
		// }
		return $q;
	}
	public function get_penerimaan_detail_rph2($id,$asal_sapi) {
		// if($asal_sapi=="GGL"||$asal_sapi=="NTF"||$asal_sapi=="PO"){
			$q = $this->db->query("SELECT * FROM penerimaan_detail INNER JOIN pengiriman ON pengiriman.id_pengiriman = penerimaan_detail.id_pengiriman 
								INNER JOIN movement_log ON pengiriman.id_pengiriman=movement_log.id_pengiriman
								JOIN mst_rph_user ON mst_rph_user.id_rph=pengiriman.id_rph
								WHERE mst_rph_user.id_awo = '$id' AND pengiriman.status_terima = '1' 
								AND asal_sapi like '%$asal_sapi%' ORDER BY penerimaan_detail.tanggal_potong DESC");
		// }
		return $q;
	}
	public function get_penerimaan_detail_rph2_stts($id,$asal_sapi) {
		// if($asal_sapi=="GGL"||$asal_sapi=="NTF"||$asal_sapi=="PO"){
			$q = $this->db->query("SELECT * FROM penerimaan_detail INNER JOIN pengiriman ON pengiriman.id_pengiriman = penerimaan_detail.id_pengiriman 
								INNER JOIN movement_log ON pengiriman.id_pengiriman=movement_log.id_pengiriman
								JOIN mst_rph_user ON mst_rph_user.id_rph=pengiriman.id_rph
								WHERE mst_rph_user.id_awo = '$id' AND penerimaan_detail.status_potong = '1' 
								AND asal_sapi like '%$asal_sapi%' ORDER BY penerimaan_detail.tanggal_potong DESC");
		// }
		return $q;
	}
	public function get_penerimaan_detail_rph2_tgl($id,$asal_sapi,$tanggal_awal,$tanggal_akhir,$status) {
		// if($asal_sapi=="GGL"||$asal_sapi=="NTF"||$asal_sapi=="PO"){
			if($status>0){
				$q = $this->db->query("SELECT * FROM penerimaan_detail INNER JOIN pengiriman ON pengiriman.id_pengiriman = penerimaan_detail.id_pengiriman 
									INNER JOIN movement_log ON pengiriman.id_pengiriman=movement_log.id_pengiriman
									JOIN mst_rph_user ON mst_rph_user.id_rph=pengiriman.id_rph
									WHERE penerimaan_detail.tanggal_potong >= '$tanggal_awal' AND penerimaan_detail.tanggal_potong 
									<= '$tanggal_akhir' AND mst_rph_user.id_awo = '$id' AND pengiriman.status_terima = '1' 
									AND asal_sapi like '%$asal_sapi%' AND status_potong>='$status' ORDER BY penerimaan_detail.tanggal_potong DESC");
			}else{
				$q = $this->db->query("SELECT * FROM penerimaan_detail INNER JOIN pengiriman ON pengiriman.id_pengiriman = penerimaan_detail.id_pengiriman 
									INNER JOIN movement_log ON pengiriman.id_pengiriman=movement_log.id_pengiriman
									JOIN mst_rph_user ON mst_rph_user.id_rph=pengiriman.id_rph
									WHERE penerimaan_detail.tanggal_potong >= '$tanggal_awal' AND penerimaan_detail.tanggal_potong 
									<= '$tanggal_akhir' AND mst_rph_user.id_awo = '$id' AND pengiriman.status_terima = '1' 
									AND asal_sapi like '%$asal_sapi%' AND status_potong='$status' ORDER BY penerimaan_detail.tanggal_potong DESC");
			}
		// }
		return $q;
	}
	public function get_penerimaan_detail_rph2_no_tgl($id,$asal_sapi,$status) {
		// if($asal_sapi=="GGL"||$asal_sapi=="NTF"||$asal_sapi=="PO"){
			if($status>0){
				$q = $this->db->query("SELECT * FROM penerimaan_detail INNER JOIN pengiriman ON pengiriman.id_pengiriman = penerimaan_detail.id_pengiriman 
									INNER JOIN movement_log ON pengiriman.id_pengiriman=movement_log.id_pengiriman
									JOIN mst_rph_user ON mst_rph_user.id_rph=pengiriman.id_rph
									WHERE mst_rph_user.id_awo = '$id' AND pengiriman.status_terima = '1' 
									AND asal_sapi like '%$asal_sapi%' AND status_potong >='$status' ORDER BY penerimaan_detail.tanggal_potong DESC");
			}else{
				$q = $this->db->query("SELECT * FROM penerimaan_detail INNER JOIN pengiriman ON pengiriman.id_pengiriman = penerimaan_detail.id_pengiriman 
									INNER JOIN movement_log ON pengiriman.id_pengiriman=movement_log.id_pengiriman
									JOIN mst_rph_user ON mst_rph_user.id_rph=pengiriman.id_rph
									WHERE mst_rph_user.id_awo = '$id' AND pengiriman.status_terima = '1' 
									AND asal_sapi like '%$asal_sapi%' AND status_potong ='$status' ORDER BY penerimaan_detail.tanggal_potong DESC");
			}
		// }
		return $q;
	}
	public function get_penerimaan_detail_rph2_tgl_stts($id,$asal_sapi,$tanggal_awal,$tanggal_akhir,$status) {
		// if($asal_sapi=="GGL"||$asal_sapi=="NTF"||$asal_sapi=="PO"){
			if($status>0){
				$q = $this->db->query("SELECT * FROM penerimaan_detail INNER JOIN pengiriman ON pengiriman.id_pengiriman = penerimaan_detail.id_pengiriman 
									INNER JOIN movement_log ON pengiriman.id_pengiriman=movement_log.id_pengiriman
									JOIN mst_rph_user ON mst_rph_user.id_rph=pengiriman.id_rph
									WHERE penerimaan_detail.tanggal_potong >= '$tanggal_awal' AND penerimaan_detail.tanggal_potong 
									<= '$tanggal_akhir' AND mst_rph_user.id_awo = '$id' AND pengiriman.status_terima = '1' 
									AND asal_sapi like '%$asal_sapi%' AND status_potong >='$status' ORDER BY penerimaan_detail.tanggal_potong DESC");
			}else{
				$q = $this->db->query("SELECT * FROM penerimaan_detail INNER JOIN pengiriman ON pengiriman.id_pengiriman = penerimaan_detail.id_pengiriman 
									INNER JOIN movement_log ON pengiriman.id_pengiriman=movement_log.id_pengiriman
									JOIN mst_rph_user ON mst_rph_user.id_rph=pengiriman.id_rph
									WHERE penerimaan_detail.tanggal_potong >= '$tanggal_awal' AND penerimaan_detail.tanggal_potong 
									<= '$tanggal_akhir' AND mst_rph_user.id_awo = '$id' AND pengiriman.status_terima = '1' 
									AND asal_sapi like '%$asal_sapi%' AND status_potong='$status' ORDER BY penerimaan_detail.tanggal_potong DESC");
			}
		// }
		return $q;
	}
	public function get_penerimaan_detail_rph2_no_tgl_stts($id,$asal_sapi,$status) {
		// if($asal_sapi=="GGL"||$asal_sapi=="NTF"||$asal_sapi=="PO"){
			if($status>0){
				$q = $this->db->query("SELECT * FROM penerimaan_detail INNER JOIN pengiriman ON pengiriman.id_pengiriman = penerimaan_detail.id_pengiriman 
								INNER JOIN movement_log ON pengiriman.id_pengiriman=movement_log.id_pengiriman
								JOIN mst_rph_user ON mst_rph_user.id_rph=pengiriman.id_rph
								WHERE mst_rph_user.id_awo = '$id' AND pengiriman.status_terima = '1' 
								AND asal_sapi like '%$asal_sapi%' AND status_potong >='$status' ORDER BY penerimaan_detail.tanggal_potong DESC");
			}else{
				$q = $this->db->query("SELECT * FROM penerimaan_detail INNER JOIN pengiriman ON pengiriman.id_pengiriman = penerimaan_detail.id_pengiriman 
								INNER JOIN movement_log ON pengiriman.id_pengiriman=movement_log.id_pengiriman
								JOIN mst_rph_user ON mst_rph_user.id_rph=pengiriman.id_rph
								WHERE mst_rph_user.id_awo = '$id' AND pengiriman.status_terima = '1' 
								AND asal_sapi like '%$asal_sapi%' AND status_potong='$status' ORDER BY penerimaan_detail.tanggal_potong DESC");
			}
		// }
		return $q;
	}
	public function get_penerimaan_detail_rph2_no_tgl_stts1($id,$asal_sapi,$status) {
		if($status>0){
			$q = $this->db->query("SELECT * FROM penerimaan_detail INNER JOIN pengiriman ON pengiriman.id_pengiriman = penerimaan_detail.id_pengiriman 
							INNER JOIN movement_log ON pengiriman.id_pengiriman=movement_log.id_pengiriman
							WHERE pengiriman.status_terima = '1' AND asal_sapi like '%$asal_sapi%' AND status_potong >='$status' 
							ORDER BY penerimaan_detail.tanggal_potong DESC");
		}else{
			$q = $this->db->query("SELECT * FROM penerimaan_detail INNER JOIN pengiriman ON pengiriman.id_pengiriman = penerimaan_detail.id_pengiriman 
							INNER JOIN movement_log ON pengiriman.id_pengiriman=movement_log.id_pengiriman
							WHERE pengiriman.status_terima = '1' AND asal_sapi like '%$asal_sapi%' AND status_potong='$status' 
							ORDER BY penerimaan_detail.tanggal_potong DESC");
		}
		return $q;
	}
	public function get_penerimaan($id) {
		$q = $this->db->query("SELECT pengiriman.*,movement_log.*,COUNT(id_penerimaan_detail) AS jml 
							FROM pengiriman JOIN movement_log ON pengiriman.id_pengiriman=movement_log.id_pengiriman 
							LEFT JOIN penerimaan_detail ON pengiriman.id_pengiriman=penerimaan_detail.id_pengiriman
							JOIN mst_rph_user ON mst_rph_user.id_rph=pengiriman.id_rph
							WHERE mst_rph_user.id_awo = '$id' GROUP BY pengiriman.id_pengiriman ORDER BY tanggal_kirim DESC");
		return $q;
	}
	public function get_penerimaan_history($id) {
		$q = $this->db->query("SELECT pengiriman.*,movement_log.*,COUNT(id_penerimaan_detail) AS jml,tanggal_terimaDt,jam_terimaDt 
							FROM pengiriman JOIN movement_log ON pengiriman.id_pengiriman=movement_log.id_pengiriman 
							LEFT JOIN penerimaan_detail ON pengiriman.id_pengiriman=penerimaan_detail.id_pengiriman
							JOIN mst_rph_user ON mst_rph_user.id_rph=pengiriman.id_rph
							WHERE mst_rph_user.id_awo = '$id' GROUP BY pengiriman.id_pengiriman, tanggal_terimaDt ORDER BY tanggal_kirim DESC");
		return $q;
	}
	public function get_laporan_potong_awo() {
		// $q = $this->db->query("SELECT dt_join.*, nama_rph FROM mst_rph JOIN
		// (SELECT pemotongan_log.id_awo,pemotongan_log.log,pemotongan_log.status,pemotongan_log.tanggal_laporan,
		// pemotongan_log.jam,pemotongan_log.id_rph, dtc_log.c_log FROM pemotongan_log 
		// JOIN(SELECT COUNT(LOG)AS c_log, LOG FROM pemotongan_log  GROUP BY LOG) AS dtc_log GROUP BY LOG)AS dt_join ON dt_join.id_rph=mst_rph.id_rph");
		// return $q;
		$q = $this->db->query("SELECT data_lap_awo.*, mst_awo.nama_awo from (SELECT dt_join.*, nama_rph FROM mst_rph JOIN
		(SELECT pemotongan_log.id_awo,pemotongan_log.log,pemotongan_log.status,pemotongan_log.delete_status,pemotongan_log.tanggal_laporan,
		pemotongan_log.jam,pemotongan_log.id_rph, dtc_log.c_log FROM pemotongan_log 
		JOIN(SELECT COUNT(LOG)AS c_log, LOG FROM pemotongan_log WHERE delete_status='0' GROUP BY LOG) AS dtc_log ON dtc_log.log=pemotongan_log.log)AS dt_join ON dt_join.id_rph=mst_rph.id_rph) 
		as data_lap_awo join mst_awo ON data_lap_awo.id_awo=mst_awo.id_awo WHERE delete_status='0' GROUP BY id_rph,LOG");
		return $q;
	}
	public function get_laporan_sapi_diterima() {
		$q = $this->db->query("SELECT * FROM (SELECT pg.id_pengiriman,move_from,move_to,tanggal_kirim,tanggal_terima, jam_kirim, jam_terima, 
							COUNT(id_pengiriman_detail) AS banyak_sapi, pg.status_terima, konfirmasi FROM pengiriman pg JOIN pengiriman_detail pd 
							ON pg.id_pengiriman = pd.id_pengiriman JOIN movement_log mv ON mv.id_pengiriman=pd.id_pengiriman 
							WHERE move_from='GGL' OR move_from='NTF' OR move_from='PO' GROUP BY pg.id_pengiriman)AS dataa 
							WHERE dataa.status_terima = '1' AND dataa.konfirmasi ='0'");
		return $q;
	}
	// public function get_stok_sapi($tanggal1,$tanggal2,$id,$asal_sapi) {
	// 	$q = $this->db->query("SELECT COUNT(*) as total_sapi, nota,tanggal_terima,asal_sapi,move_from,pengiriman.id_pengiriman,
	// 						mst_rph.nama_rph FROM penerimaan_detail INNER JOIN pengiriman ON pengiriman.id_pengiriman = penerimaan_detail.id_pengiriman 
	// 						INNER JOIN mst_rph ON pengiriman.id_rph = mst_rph.id_rph 
	// 						INNER JOIN movement_log ON pengiriman.id_pengiriman=movement_log.id_pengiriman
	// 						WHERE pengiriman.tanggal_terima >= '$tanggal1' AND pengiriman.tanggal_terima <= '$tanggal2' 
	// 						AND mst_rph.nama_rph LIKE '%$id%' AND intransit='0' AND status_potong = '0' AND asal_sapi LIKE '%$asal_sapi%' 
	// 						GROUP BY nota");
	// 	return $q;
	// }
	public function get_stok_sapi($tanggal1,$tanggal2,$id,$asal_sapi,$customer) {
		$q = $this->db->query("SELECT COUNT(*) AS jml,data1.asal_sapi,move_from,move_to,id_pengiriman,nota,status_terima,tanggal_kirim,jam_kirim,tanggal_terima,customer,jam_terima,status_potong,flag,flag1,intransit FROM 
		(SELECT tanggal_kirim,jam_kirim,tanggal_terima,jam_terima,asal_sapi,move_from,move_to,dp.*,pd.eartag AS eartag1,pd.rfid AS rfid1,status_potong,flag,flag1,intransit 
		FROM pengiriman_detail dp JOIN pengiriman pg ON pg.id_pengiriman=dp.id_pengiriman JOIN movement_log ml ON ml.id_pengiriman=pg.id_pengiriman 
		LEFT JOIN penerimaan_detail pd ON pd.id_pengiriman=dp.id_pengiriman AND pd.eartag=dp.eartag) AS data1 WHERE move_from like '%$asal_sapi%' AND move_to like '%$id%' AND customer LIKE '%$customer%' 
		AND tanggal_terima BETWEEN '$tanggal1' AND '$tanggal2' GROUP BY id_pengiriman,move_from,move_to,status_terima,status_potong,intransit ORDER BY id_pengiriman ASC");
		return $q;
	}
	public function get_pemotongan_sapi($tanggal1,$tanggal2,$id,$status_potong,$asal_sapi) {
		$q = $this->db->query("SELECT * FROM penerimaan_detail INNER JOIN pengiriman ON pengiriman.id_pengiriman = penerimaan_detail.id_pengiriman 
								INNER JOIN movement_log ON pengiriman.id_pengiriman=movement_log.id_pengiriman
								INNER JOIN mst_rph ON pengiriman.id_rph = mst_rph.id_rph JOIN pemotongan_log ON pemotongan_log.id_penerimaan_detail=penerimaan_detail.id_penerimaan_detail 
								WHERE status=2 AND penerimaan_detail.tanggal_potong >= '$tanggal1' 
								AND penerimaan_detail.tanggal_potong <= '$tanggal2' AND mst_rph.nama_rph LIKE '%$id%' 
								AND status_potong > '$status_potong' AND asal_sapi LIKE '%$asal_sapi%' GROUP BY penerimaan_detail.id_penerimaan_detail
								ORDER BY tanggal_potong DESC");
		return $q;
	}
	public function get_transfer_detail($id) {
		$q = $this->db->query("SELECT * FROM transfer_barang_detail INNER JOIN mst_barang ON transfer_barang_detail.id_barang = mst_barang.id_barang WHERE id_transfer = '$id' ORDER BY id_transfer_detail DESC");
		return $q;
	}
	public function get_powerload($id) {
		$q = $this->db->query("SELECT * FROM powerload INNER JOIN mst_rph_user ON mst_rph_user.id_rph=powerload.id_rph 
						JOIN mst_rph ON mst_rph.id_rph=mst_rph_user.id_rph WHERE mst_rph_user.id_awo = '$id' ORDER BY tanggal DESC");
		return $q;
	}
	public function get_perawatan_asset() {
		$q = $this->db->query("SELECT * FROM perawatan_asset LEFT JOIN mst_barang ON perawatan_asset.id_barang = mst_barang.id_barang LEFT JOIN mst_jenis_barang ON mst_barang.id_jenis_barang = mst_jenis_barang.id_jenis_barang  ORDER BY tanggal_rusak DESC");
		return $q;
	}
	public function get_sapi_masuk($id) {
		$q = $this->db->query("SELECT * FROM penerimaan_detail WHERE id_pengiriman = '$id'");
		return $q;
	}
	public function get_sapi_mutasi($id="") {
		//$q = $this->db->query("SELECT * FROM penerimaan_detail WHERE intransit = '1'");
		// $nama_rph=$this->session->userdata("nama_rph");
		$q = $this->db->query("SELECT * FROM pengiriman JOIN movement_log ON pengiriman.id_pengiriman=movement_log.id_pengiriman 
		JOIN mst_rph ON mst_rph.nama_rph=movement_log.move_from JOIN mst_rph_user ON mst_rph_user.id_rph=mst_rph.id_rph WHERE mst_rph_user.id_awo='$id'
		ORDER BY tanggal_kirim DESC");
		return $q; 
	}
	public function get_sapi_mutasi_nota() {
		$q = $this->db->query("SELECT * FROM penerimaan_detail WHERE intransit = '0' group by nota")->row();
		return $q;
	}
	public function get_qDt_before($id_awo_impC,$rfid_impC) {
		$q = $this->db->query("SELECT pg.id_pengiriman as id_preimere, count(*)as jml,pg.*,pd.*,ml.*,mr.*,mur.*,pnd.id_penerimaan_detail FROM pengiriman pg JOIN pengiriman_detail pd ON pg.id_pengiriman=pd.id_pengiriman 
							JOIN movement_log ml ON pg.id_pengiriman=ml.id_pengiriman JOIN mst_rph mr ON mr.id_rph=pg.id_rph 
							JOIN mst_rph_user mur ON mur.id_rph=pg.id_rph JOIN penerimaan_detail pnd ON pnd.rfid=pd.rfid WHERE mur.id_awo='$id_awo_impC' 
							AND pd.rfid='$rfid_impC'")->row();
		return $q;
	}
	public function get_qDt_before1($id_awo_impC,$rfid_impC) {
		$q = $this->db->query("SELECT pg.id_pengiriman as id_preimere, count(*)as jml,pg.*,pd.*,ml.*,mr.*,mur.* FROM pengiriman pg JOIN pengiriman_detail pd ON pg.id_pengiriman=pd.id_pengiriman 
							JOIN movement_log ml ON pg.id_pengiriman=ml.id_pengiriman JOIN mst_rph mr ON mr.id_rph=pg.id_rph 
							JOIN mst_rph_user mur ON mur.id_rph=pg.id_rph WHERE mur.id_awo='$id_awo_impC' 
							AND pd.rfid='$rfid_impC'")->row();
		return $q;
	}
	public function get_qValid($move_to,$move_from,$no_pengiriman,$tgl_valid) {
		$q = $this->db->query("SELECT count(pg.id_pengiriman) as jml,pg.id_pengiriman FROM pengiriman pg JOIN movement_log ml 
							ON ml.id_pengiriman=pg.id_pengiriman WHERE move_from='$move_to' AND move_to='$move_from' 
							AND pg.no_pengiriman='$no_pengiriman' AND tanggal_kirim='$tgl_valid'")->row();
		return $q;
	}
	public function get_qValidRFID($no_pengiriman,$RFIDimp) {
		$q = $this->db->query("SELECT count(id_pengiriman_detail) as jml FROM pengiriman_detail WHERE rfid='$RFIDimp' AND nota='$no_pengiriman'")->row();
		return $q;
	}
	public function get_qValidRFID1($no_pengiriman,$RFIDimp,$id_awo) {
		$q = $this->db->query("SELECT count(id_penerimaan_detail) as jml FROM penerimaan_detail pd JOIN pengiriman pg ON pd.id_pengiriman=pg.id_pengiriman
							JOIN mst_rph_user mru ON mru.id_rph=pg.id_rph
							WHERE rfid='$RFIDimp' AND nota='$no_pengiriman' AND id_awo='$id_awo'")->row();
		return $q;
	}
	public function get_laporan_tracebility($id,$asal_sapi,$tanggal_awal,$tanggal_akhir) {
		$q = $this->db->query("SELECT * FROM penerimaan_detail INNER JOIN pengiriman ON pengiriman.id_pengiriman = penerimaan_detail.id_pengiriman 
								INNER JOIN mst_rph ON pengiriman.id_rph = mst_rph.id_rph
								INNER JOIN movement_log ON pengiriman.id_pengiriman=movement_log.id_pengiriman 
								WHERE penerimaan_detail.tanggal_potong >= '$tanggal_awal' 
								AND penerimaan_detail.tanggal_potong <= '$tanggal_akhir' 
								AND mst_rph.nama_rph LIKE '%$id%' AND asal_sapi LIKE '%$asal_sapi%' 
								AND status_potong >= '1' AND pengiriman.status_terima = '1' AND flag = '0' AND flag1 = '0' 
								ORDER BY penerimaan_detail.tanggal_potong DESC");
		return $q;
	}
	public function get_laporan_tracebilityAll($id,$asal_sapi,$tanggal_awal,$tanggal_akhir) {
		$q = $this->db->query("SELECT * FROM penerimaan_detail INNER JOIN pengiriman ON pengiriman.id_pengiriman = penerimaan_detail.id_pengiriman 
								INNER JOIN mst_rph ON pengiriman.id_rph = mst_rph.id_rph 
								INNER JOIN movement_log ON pengiriman.id_pengiriman=movement_log.id_pengiriman
								WHERE penerimaan_detail.tanggal_potong >= '$tanggal_awal' 
								AND penerimaan_detail.tanggal_potong <= '$tanggal_akhir' 
								AND mst_rph.nama_rph LIKE '%$id%' AND asal_sapi LIKE '%$asal_sapi%' 
								AND status_potong >= '1' AND pengiriman.status_terima = '1' AND flag != '0' 
								ORDER BY penerimaan_detail.tanggal_potong DESC");
		return $q;
	}
	public function get_laporan_tracebilityAll1($id,$asal_sapi,$tanggal_awal,$tanggal_akhir) {
		$q = $this->db->query("SELECT * FROM penerimaan_detail INNER JOIN pengiriman ON pengiriman.id_pengiriman = penerimaan_detail.id_pengiriman 
								INNER JOIN mst_rph ON pengiriman.id_rph = mst_rph.id_rph 
								INNER JOIN movement_log ON pengiriman.id_pengiriman=movement_log.id_pengiriman
								WHERE penerimaan_detail.tanggal_potong >= '$tanggal_awal' 
								AND penerimaan_detail.tanggal_potong <= '$tanggal_akhir' 
								AND mst_rph.nama_rph LIKE '%$id%' AND asal_sapi LIKE '%$asal_sapi%' 
								AND status_potong >= '1' AND pengiriman.status_terima = '1' AND flag1 != '0' 
								ORDER BY penerimaan_detail.tanggal_potong DESC");
		return $q;
	}
	public function get_combo_jenis($id="") {
		$hasil = "";
		$q = $this->db->query("SELECT * FROM mst_jenis_barang ORDER BY nama_barang ASC");
		$hasil .= '<option value>Pilih Jenis Barang</option>';
		foreach($q->result() as $h) {
			if($id == $h->id_jenis_barang) {
				$hasil .= '<option value="'.$h->id_jenis_barang.'" selected="selected">'.$h->nama_barang.' - '.$h->merk.'</option>';
			} else {
				$hasil .= '<option value="'.$h->id_jenis_barang.'">'.$h->nama_barang.' - '.$h->merk.'</option>';
			}
		}
		return $hasil;
	}
	public function get_combo_rph($id="") {
		$hasil = "";
		$q = $this->db->query("SELECT * FROM mst_rph ORDER BY nama_rph ASC");
		$hasil .= '<option value>Pilih RPH</option>';
		foreach($q->result() as $h) {
			if($id == $h->id_rph) {
				$hasil .= '<option value="'.$h->id_rph.'" selected="selected">'.$h->nama_rph.'</option>';
			} else {
				$hasil .= '<option value="'.$h->id_rph.'">'.$h->nama_rph.'</option>';
			}
		}
		return $hasil;
	}
	public function get_combo_rph_filter($id="") {
		$hasil = "";
		$q = $this->db->query("SELECT mst_rph.* FROM mst_rph JOIN mst_rph_child ON mst_rph.id_rph=mst_rph_child.id_rph_mutasi 
						JOIN mst_rph_user ON mst_rph_user.id_rph=mst_rph_child.id_rph WHERE id_awo='$id' ORDER BY nama_rph ASC");
		$hasil .= '<option value>Pilih RPH</option>';
		foreach($q->result() as $h) {
			if($id == $h->id_rph) {
				$hasil .= '<option value="'.$h->id_rph.'" selected="selected">'.$h->nama_rph.'</option>';
			} else {
				$hasil .= '<option value="'.$h->id_rph.'">'.$h->nama_rph.'</option>';
			}
		}
		return $hasil;
	}
	public function get_combo_rph_only($id="") {
		$hasil = "";
		$q = $this->db->query("SELECT * FROM mst_rph WHERE nama_rph NOT LIKE 'DEPO%' ORDER BY nama_rph ASC");
		$hasil .= '<option value>Pilih RPH</option>';
		foreach($q->result() as $h) {
			if($id == $h->id_rph) {
				$hasil .= '<option value="'.$h->id_rph.'" selected="selected">'.$h->nama_rph.'</option>';
			} else {
				$hasil .= '<option value="'.$h->id_rph.'">'.$h->nama_rph.'</option>';
			}
		}
		return $hasil;
	}
	public function get_combo_rph_depo($id="") {
		$hasil = "";
		$q = $this->db->query("SELECT * FROM mst_rph where nama_rph like'%Depo%' ORDER BY nama_rph ASC");
		$hasil .= '<option value>Pilih Depo</option>';
		foreach($q->result() as $h) {
			if($id == $h->id_rph) {
				$hasil .= '<option value="'.$h->id_rph.'" selected="selected">'.$h->nama_rph.'</option>';
			} else {
				$hasil .= '<option value="'.$h->id_rph.'">'.$h->nama_rph.'</option>';
			}
		}
		return $hasil;
	}
	public function get_combo_role($id="") {
		$hasil = "";
		$q = $this->db->query("SELECT * FROM mst_role ORDER BY id_role ASC");
		$hasil .= '<option value>Pilih Role</option>';
		foreach($q->result() as $h) {
			if($id == $h->id_role) {
				$hasil .= '<option value="'.$h->id_role.'" selected="selected">'.$h->nama_role.'</option>';
			} else {
				$hasil .= '<option value="'.$h->id_role.'">'.$h->nama_role.'</option>';
			}
		}
		return $hasil;
	}
	public function get_combo_karyawan($id="") {
		$hasil = "";
		$q = $this->db->query("SELECT * FROM mst_awo ORDER BY nama_awo ASC");
		$hasil .= '<option value>Pilih Karyawan</option>';
		foreach($q->result() as $h) {
			if($id == $h->id_awo) {
				$hasil .= '<option value="'.$h->id_awo.'" selected="selected">'.$h->nama_awo.'</option>';
			} else {
				$hasil .= '<option value="'.$h->id_awo.'">'.$h->nama_awo.'</option>';
			}
		}
		return $hasil;
	}
	public function get_combo_rph_powerload($id="") {
		$hasil = "";
		$q = $this->db->query("SELECT * FROM mst_rph ORDER BY nama_rph ASC");
		$hasil .= '<option value>[Semua]</option>';
		foreach($q->result() as $h) {
			if($id == $h->nama_rph) {
				$hasil .= '<option value="'.$h->nama_rph.'" selected="selected">'.$h->nama_rph.'</option>';
			} else {
				$hasil .= '<option value="'.$h->nama_rph.'">'.$h->nama_rph.'</option>';
			}
		}
		return $hasil;
	}
	public function get_combo_rph_mutasi_from($id="") {
		$hasil = "";
		$q = $this->db->query("SELECT * FROM movement_log GROUP BY move_from ORDER BY move_from ASC");
		$hasil .= '<option value>Pilih Lokasi</option>';
		foreach($q->result() as $h) {
			if($id == $h->move_from) {
				$hasil .= '<option value="'.$h->move_from.'" selected="selected">'.$h->move_from.'</option>';
			} else {
				$hasil .= '<option value="'.$h->move_from.'">'.$h->move_from.'</option>';
			}
		}
		return $hasil;
	}
	public function get_combo_rph_mutasi($id="") {
		$hasil = "";
		$q = $this->db->query("SELECT * FROM mst_rph ORDER BY nama_rph ASC");
		$hasil .= '<option value>Pilih Lokasi</option>';
		foreach($q->result() as $h) {
			if($id == $h->nama_rph) {
				$hasil .= '<option value="'.$h->nama_rph.'" selected="selected">'.$h->nama_rph.'</option>';
			} else {
				$hasil .= '<option value="'.$h->nama_rph.'">'.$h->nama_rph.'</option>';
			}
		}
		return $hasil;
	}
	public function get_combo_rph_awo($id="") {
		$hasil = "";
		$hak_akses = $this->session->userdata("hak_akses");
		$id_rph = $this->session->userdata("id_awo");
		if($hak_akses=='admin'){
			$q = $this->db->query("SELECT mst_rph.* FROM mst_rph");
			$hasil .= '<option value>Pilih RPH</option>';
			foreach($q->result() as $h) {
				if($id == $h->id_rph) {
					$hasil .= '<option value="'.$h->id_rph.'" selected="selected">'.$h->nama_rph.'</option>';
				} else {
					$hasil .= '<option value="'.$h->id_rph.'">'.$h->nama_rph.'</option>';
				}
			}
		}else{
			$q = $this->db->query("SELECT mst_rph.* FROM mst_rph JOIN mst_rph_user ON mst_rph_user.id_rph=mst_rph.id_rph WHERE id_awo='$id_rph'");
			$hasil .= '<option value>Pilih RPH</option>';
			foreach($q->result() as $h) {
				if($id == $h->id_rph) {
					$hasil .= '<option value="'.$h->id_rph.'" selected="selected">'.$h->nama_rph.'</option>';
				} else {
					$hasil .= '<option value="'.$h->id_rph.'">'.$h->nama_rph.'</option>';
				}
			}
		}
		return $hasil;
	}
	public function get_combo_barang($id="") {
		$hasil = "";
		$q = $this->db->query("SELECT * FROM mst_barang LEFT JOIN mst_jenis_barang ON mst_barang.id_jenis_barang = mst_jenis_barang.id_jenis_barang ORDER BY nama_barang DESC");
		$hasil .= '<option value>Pilih barang</option>';
		foreach($q->result() as $h) {
			if($id == $h->id_barang) {
				$hasil .= '<option value="'.$h->id_barang.'" selected="selected">'.$h->nama_barang.' - '.$h->merk.' - '.$h->identitas.'</option>';
			} else {
				$hasil .= '<option value="'.$h->id_barang.'">'.$h->nama_barang.' - '.$h->merk.' - '.$h->identitas.'</option>';
			}
		}
		return $hasil;
	}
	public function get_combo_barang_non($id="") {
		$hasil = "";
		$q = $this->db->query("SELECT * FROM mst_barang WHERE kategori='NON ASSET' ORDER BY nama_barang ASC");
		$hasil .= '<option>Pilih barang</option>';
		foreach($q->result() as $h) {
			if($id == $h->id_barang) {
				$hasil .= '<option value="'.$h->id_barang.'" selected="selected">'.$h->nama_barang.' - '.$h->merk.'</option>';
			} else {
				$hasil .= '<option value="'.$h->id_barang.'">'.$h->nama_barang.' - '.$h->merk.'</option>';
			}
		}
		return $hasil;
	}
	public function get_combo_awo($id="") {
		$hasil = "";
		$q = $this->db->query("SELECT * FROM mst_awo ORDER BY nama_awo ASC");
		$hasil .= '<option>Pilih awo</option>';
		foreach($q->result() as $h) {
			if($id == $h->id_awo) {
				$hasil .= '<option value="'.$h->id_awo.'" selected="selected">'.$h->nama_awo.'</option>';
			} else {
				$hasil .= '<option value="'.$h->id_awo.'">'.$h->nama_awo.'</option>';
			}
		}
		return $hasil;
	}
	public function get_combo_awo_report($id="") {
		$hasil = "";
		$q = $this->db->query("SELECT * FROM mst_awo ORDER BY nama_awo ASC");
		$hasil .= '<option value>[SEMUA]</option>';
		foreach($q->result() as $h) {
			if($id == $h->nama_awo) {
				$hasil .= '<option value="'.$h->nama_awo.'" selected="selected">'.$h->nama_awo.'</option>';
			} else {
				$hasil .= '<option value="'.$h->nama_awo.'">'.$h->nama_awo.'</option>';
			}
		}
		return $hasil;
	}
	public function get_combo_barang_report($id="") {
		$hasil = "";
		$q = $this->db->query("SELECT * FROM mst_barang LEFT JOIN mst_jenis_barang ON mst_barang.id_jenis_barang = mst_jenis_barang.id_jenis_barang ORDER BY nama_barang ASC");
		$hasil .= '<option value>[SEMUA]</option>';
		foreach($q->result() as $h) {
			if($id == $h->id_barang) {
				$hasil .= '<option value="'.$h->id_barang.'" selected="selected">'.$h->nama_barang.' - '.$h->merk.' - '.$h->identitas.'</option>';
			} else {
				$hasil .= '<option value="'.$h->id_barang.'">'.$h->nama_barang.' - '.$h->merk.' - '.$h->identitas.'</option>';
			}
		}
		return $hasil;
	}
	public function get_combo_rph_report($id="") {
		$hasil = "";
		$q = $this->db->query("SELECT * FROM mst_rph ORDER BY nama_rph ASC");
		$hasil .= '<option value>[SEMUA]</option>';
		foreach($q->result() as $h) {
			if($id == $h->nama_rph) {
				$hasil .= '<option value="'.$h->nama_rph.'" selected="selected">'.$h->nama_rph.'</option>';
			} else {
				$hasil .= '<option value="'.$h->nama_rph.'">'.$h->nama_rph.'</option>';
			}
		}
		return $hasil;
	}
	public function get_combo_customer($id="") {
		$hasil = "";
		$q = $this->db->query("SELECT customer FROM pengiriman_detail group by customer ORDER BY customer ASC");
		$hasil .= '<option value>[SEMUA]</option>';
		foreach($q->result() as $h) {
			if($id == $h->customer) {
				$hasil .= '<option value="'.$h->customer.'" selected="selected">'.$h->customer.'</option>';
			} else {
				$hasil .= '<option value="'.$h->customer.'">'.$h->customer.'</option>';
			}
		}
		return $hasil;
	}
	public function get_combo_pengiriman($id="") {
		$hasil = "";
		//$q = $this->db->query("SELECT no_pengiriman,id_pengiriman FROM pengiriman ORDER BY no_pengiriman DESC");
		$q = $this->db->query("SELECT pengiriman.no_pengiriman,pengiriman.id_pengiriman FROM pengiriman JOIN movement_log ON 
							pengiriman.id_pengiriman=movement_log.id_pengiriman JOIN pengiriman_detail ON pengiriman_detail.id_pengiriman=pengiriman.id_pengiriman 
							WHERE move_from like '%GGL%' OR move_from like '%NTF%' OR move_from like '%PO%' GROUP BY no_pengiriman ORDER BY pengiriman.no_pengiriman DESC");
		$hasil .= '<option value>Pilih No.Pengiriman</option>';
		foreach($q->result() as $h) {
			if($id == $h->id_pengiriman) {
				$hasil .= '<option value="'.$h->id_pengiriman.'" selected="selected">'.$h->no_pengiriman.'</option>';
			} else {
				$hasil .= '<option value="'.$h->id_pengiriman.'">'.$h->no_pengiriman.'</option>';
			}
		}
		return $hasil;
	}
	public function get_combo_pengiriman_mutasi($id="") {
		$hasil = "";
		//$q = $this->db->query("SELECT no_pengiriman,id_pengiriman FROM pengiriman ORDER BY no_pengiriman DESC");
		$q = $this->db->query("SELECT pengiriman.no_pengiriman,pengiriman.id_pengiriman FROM pengiriman JOIN movement_log ON 
							pengiriman.id_pengiriman=movement_log.id_pengiriman WHERE move_from like '%GGL%' OR move_from like '%NTF%' OR move_from like '%PO%' 
							ORDER BY pengiriman.no_pengiriman DESC");
		$hasil .= '<option value>[Semua]</option>';
		foreach($q->result() as $h) {
			if($id == $h->no_pengiriman) {
				$hasil .= '<option value="'.$h->no_pengiriman.'" selected="selected">'.$h->no_pengiriman.'</option>';
			} else {
				$hasil .= '<option value="'.$h->no_pengiriman.'">'.$h->no_pengiriman.'</option>';
			}
		}
		return $hasil;
	}
	public function get_combo_pengiriman_rph($id="") {
		$hasil = "";
		// $q = $this->db->query("SELECT no_pengiriman,pengiriman.id_pengiriman FROM pengiriman JOIN penerimaan_detail ON penerimaan_detail.id_pengiriman=pengiriman.id_pengiriman WHERE status_terima='1' AND id_rph = '".$this->session->userdata("id_rph")."' GROUP BY pengiriman.id_pengiriman ORDER BY no_pengiriman DESC");
		$q = $this->db->query("SELECT no_pengiriman,pengiriman.id_pengiriman FROM pengiriman JOIN penerimaan_detail ON penerimaan_detail.id_pengiriman=pengiriman.id_pengiriman 
		JOIN mst_rph_user ON mst_rph_user.id_rph=pengiriman.id_rph WHERE status_terima='1' AND mst_rph_user.id_awo='".$this->session->userdata("id_awo")."' GROUP BY pengiriman.id_pengiriman ORDER BY no_pengiriman DESC");
		$hasil .= '<option value>Pilih No Nota</option>';
		foreach($q->result() as $h) {
			if($id == $h->id_pengiriman) {
				$hasil .= '<option value="'.$h->id_pengiriman.'" selected="selected">'.$h->no_pengiriman.'</option>';
			} else {
				$hasil .= '<option value="'.$h->id_pengiriman.'">'.$h->no_pengiriman.'</option>';
			}
		}
		return $hasil;
	}
	public function get_combo_pengiriman_rph_mutasi($id="") {
		$hasil = "";
		$q = $this->db->query("SELECT no_pengiriman,pengiriman.id_pengiriman FROM pengiriman JOIN penerimaan_detail ON 
							penerimaan_detail.id_pengiriman=pengiriman.id_pengiriman JOIN mst_rph_user ON mst_rph_user.id_rph=pengiriman.id_rph 
							WHERE status_terima='1' AND intransit='0' AND id_awo = '".$this->session->userdata("id_awo")."' 
							GROUP BY pengiriman.id_pengiriman ORDER BY no_pengiriman DESC");
		$hasil .= '<option value>Pilih No Nota</option>';
		foreach($q->result() as $h) {
			if($id == $h->id_pengiriman) {
				$hasil .= '<option value="'.$h->id_pengiriman.'" selected="selected">'.$h->no_pengiriman.'</option>';
			} else {
				$hasil .= '<option value="'.$h->id_pengiriman.'">'.$h->no_pengiriman.'</option>';
			}
		}
		return $hasil;
	}
	public function get_combo_asal_sapi($id="") {
		$hasil = "";
		$q = $this->db->query("SELECT asal_sapi FROM asal_sapi");
		$hasil .= '<option value>Asal sapi</option>';
		foreach($q->result() as $h) {
			if($id == $h->asal_sapi) {
				$hasil .= '<option value="'.$h->asal_sapi.'" selected="selected">'.$h->asal_sapi.'</option>';
			} else {
				$hasil .= '<option value="'.$h->asal_sapi.'">'.$h->asal_sapi.'</option>';
			}
		}
		return $hasil;
	}
	// public function get_combo_stock_sapi($id="") {
	// 	$hasil = "";
	// 	$q = $this->db->query("SELECT no_pengiriman,id_pengiriman FROM pengiriman WHERE id_rph = '".$this->session->userdata("id_rph")."' ORDER BY no_pengiriman DESC");
	// 	$hasil .= '<option value>Pilih No.Pengiriman</option>';
	// 	foreach($q->result() as $h) {
	// 		if($id == $h->id_pengiriman) {
	// 			$hasil .= '<option value="'.$h->id_pengiriman.'" selected="selected">'.$h->no_pengiriman.'</option>';
	// 		} else {
	// 			$hasil .= '<option value="'.$h->id_pengiriman.'">'.$h->no_pengiriman.'</option>';
	// 		}
	// 	}
	// 	return $hasil;
	// }
	public function get_combo_transfer($id="") {
		$hasil = "";
		$q = $this->db->query("SELECT no_transfer,id_transfer FROM transfer_barang ORDER BY no_transfer DESC");
		$hasil .= '<option value>Pilih No.transfer</option>';
		foreach($q->result() as $h) {
			if($id == $h->id_transfer) {
				$hasil .= '<option value="'.$h->id_transfer.'" selected="selected">'.$h->no_transfer.'</option>';
			} else {
				$hasil .= '<option value="'.$h->id_transfer.'">'.$h->no_transfer.'</option>';
			}
		}
		return $hasil;
	}
}