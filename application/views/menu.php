<?php if($this->session->userdata("hak_akses")=='admin'){?>
<div class="main-container container-fluid">
	<a class="menu-toggler" id="menu-toggler" href="#">
		<span class="menu-text"></span>
	</a>
<?php }?>

	
	<?php if($this->session->userdata("hak_akses")=="admin"){?>
		<div class="sidebar" id="sidebar">
			<ul class="nav nav-list">
				<li>
					<a href="<?php echo base_url(); ?>">
						<i class="fa fa-dashboard"></i>
						<span class="menu-text"> Dashboard </span>
					</a>
				</li>

				<?php	if($this->session->userdata("id_role")==1){ ?>
							<li>
								<a href="#" class="dropdown-toggle">
									<i class="fa fa-folder-open"></i>
									<span class="menu-text"> Karyawan & User</span>
									<b class="arrow fa fa-angle-down"></b>
								</a>
								<ul class="submenu">					
									<li>
										<a href="<?php echo base_url();?>Awo">
											<i class="fa fa-double-angle-right"></i>
											Master Karyawan
										</a>
									</li>
									<li>
										<a href="<?php echo base_url();?>User">
											<i class="fa fa-double-angle-right"></i>
											Master User
										</a>
									</li>
								</ul>
							</li>
						<?php }else{
							$id_awo = $this->session->userdata("id_awo");
							$count_pengiriman = $this->db->query("SELECT COUNT(data1.log) as hitung_pemotongan FROM (SELECT id_awo,LOG,status,delete_status 
																FROM pemotongan_log WHERE status='1' AND delete_status='0' GROUP BY LOG)AS data1")->row();
							$count_potong_estimasi = $this->db->query("SELECT id_pengiriman,COUNT(*) AS hitung_pemotongan FROM (SELECT pg.* FROM pengiriman pg 
																JOIN pengiriman_detail pd ON pg.id_pengiriman=pd.id_pengiriman JOIN mst_rph_user mru 
																ON mru.id_rph=pg.id_rph WHERE pd.status_terima=0 AND id_awo='$id_awo' GROUP BY pg.id_pengiriman)AS data1")->row();
							$count_terkirim = $this->db->query("SELECT COUNT(dataa.id_pengiriman) AS hitung_pengiriman FROM (SELECT pengiriman.* 
																FROM pengiriman JOIN movement_log ON pengiriman.id_pengiriman=movement_log.id_pengiriman 
																WHERE move_from='GGL' OR move_from='NTF' OR move_from='PO')AS dataa WHERE dataa.status_terima = '1'")->row();
							?>
							<li>
								<a href="#" class="dropdown-toggle">
									<i class="fa fa-truck"></i>
									<span class="menu-text"> Estimasi Potong <label class="label label-warning pull-right"> <?php echo $count_potong_estimasi->hitung_pemotongan; ?> </label> </span>
									<b class="arrow fa fa-angle-down"></b>
								</a>
								<ul class="submenu">					
									<li>
										<a href="<?php echo base_url();?>Penerimaan_sapi">
											<i class="fa fa-double-angle-right"><label class="label label-warning pull-right"> <?php echo $count_potong_estimasi->hitung_pemotongan; ?> </label> </i>
											Penerimaan Sapi
										</a> 
									</li>
									<li>
										<a href="<?php echo base_url();?>History_penerimaan">
											<i class="fa fa-double-angle-right"></i>
											History Penerimaan
										</a>
									</li>
									<li>
										<a href="<?php echo base_url(); ?>Pemotongan_sapi/traceability">
											<i class="fa fa-double-angle-right"></i>
											Update Status Potong
										</a>
									</li>
									</li>
									<li>
										<a href="<?php echo base_url(); ?>Pemotongan_sapi/hasil_pemotongan">
											<i class="fa fa-double-angle-right"></i>
											Update Estimasi
										</a>
									</li>
								</ul>
							</li>
							<li>
								<a href="#" class="dropdown-toggle">
									<i class="fa fa-folder-open"></i>
									<span class="menu-text"> Master AWO & RPH</span>
									<b class="arrow fa fa-angle-down"></b>
								</a>
								<ul class="submenu">					
									<li>
										<a href="<?php echo base_url();?>rph">
											<i class="fa fa-double-angle-right"></i>
											Data RPH
										</a>
									</li>
									<li>
										<a href="<?php echo base_url();?>awo">
											<i class="fa fa-double-angle-right"></i>
											Data AWO
										</a>
									</li>
								</ul>
							</li>
							<li>
								<a href="#" class="dropdown-toggle">
									<i class="fa fa-list-alt"></i>
									<span class="menu-text"> Laporan Data Sapi <label class="label label-warning pull-right"> <?php echo $count_pengiriman->hitung_pemotongan; ?> </label> </span>
									<b class="arrow fa fa-angle-down"></b>
								</a>
								<ul class="submenu">
									<li>
										<a href="<?php echo base_url();?>laporan_data_sapi/stok_sapi">
											<i class="fa fa-double-angle-right"></i>
											Stok Sapi
										</a>
									</li>
									<li>
										<a href="<?php echo base_url();?>laporan_data_sapi/traceability">
											<i class="fa fa-double-angle-right"></i>
											Tracebility by Date
										</a>
									</li>
									<li>
										<a href="<?php echo base_url();?>log_pengiriman/mutasi_pengiriman">
											<i class="fa fa-double-angle-right"></i>
											Tracebility by Nota
										</a>
									</li>
									<li>
										<a href="<?php echo base_url();?>laporan_pengerjaan_awo">
											<span class="menu-text"> Laporan AWO <label class="label label-warning pull-right"> <?php echo $count_pengiriman->hitung_pemotongan; ?> </label></span>
										</a>
									</li>
									<li>
										<a href="<?php echo base_url();?>laporan_data_sapi/pemotongan_sapi">
											<i class="fa fa-double-angle-right"></i>
											Hasil Pemotongan Sapi
										</a>
									</li>
								</ul>
							</li>
							<li>
								<a href="<?php echo base_url(); ?>powerload/kartu_stok">
									<i class="fa fa-reorder"></i>
									<span class="menu-text"> Stok Powerload </span>
								</a>
							</li>
					<?php }  ?>
				<?php if($this->session->userdata("hak_akses") == "awo") { 
					$count_pengiriman = $this->db->query("SELECT COUNT(*) AS hitung_pengiriman FROM(SELECT pg.* FROM pengiriman pg JOIN pengiriman_detail pd ON pg.id_pengiriman=pd.id_pengiriman
														JOIN mst_rph_user mru ON mru.id_rph=pg.id_rph WHERE mru.id_awo = '".$this->session->userdata("id_awo")."' 
														AND pd.status_terima = '0' GROUP BY pg.id_pengiriman) AS data1")->row();
						if($this->session->userdata("input_type")=='0'){?>
							<!-- <li>
								<a href="<?php echo base_url();?>penerimaan_sapi">
									<i class="fa fa-folder-open"></i>
									<span class="menu-text"> Penerimaan Sapi <label class="label label-warning pull-right"> <?php echo $count_pengiriman->hitung_pengiriman; ?> </label></span>
								</a>
							</li>
							<li>
								<a href="<?php echo base_url();?>History_penerimaan">
									<i class="fa fa-search"></i>
									<span class="menu-text"> History Penerimaan </span>
								</a>
							</li>
							<li>
								<a href="<?php echo base_url();?>mutasi_sapi">
									<i class="fa fa-truck"></i>
									<span class="menu-text"> Mutasi Sapi </span>
								</a>
							</li> -->
						<?php }else if($this->session->userdata("input_type")=='2'){?>
							<!-- <li>
									<a href="<?php echo base_url();?>penerimaan_sapi">
										<i class="fa fa-folder-open"></i>
										<span class="menu-text"> Penerimaan Sapi <label class="label label-warning pull-right"> <?php echo $count_pengiriman->hitung_pengiriman; ?> </label></span>
									</a>
								</li>
								<li>
									<a href="<?php echo base_url();?>History_penerimaan">
										<i class="fa fa-search"></i>
										<span class="menu-text"> History Penerimaan </span>
									</a>
								</li>
								<li>
									<a href="<?php echo base_url();?>pemotongan_sapi/traceability">
										<i class="fa fa-signal"></i>
										<span class="menu-text"> Update Status Potong</span>
									</a>
								</li>
								<li>
									<a href="<?php echo base_url();?>pemotongan_sapi/hasil_pemotongan">
										<i class="fa fa-edit"></i>
										<span class="menu-text"> Hasil Pemotongan</span>
									</a>
								</li>
								<li>
									<a href="<?php echo base_url(); ?>powerload">
										<i class="fa fa-exchange"></i>
										<span class="menu-text"> Transfer Powerload </span>
									</a>
								</li>
								<li>
									<a href="<?php echo base_url(); ?>powerload/kartu_stok_awo">
										<i class="fa fa-list"></i>
										<span class="menu-text"> History Powerload </span>
									</a>
								</li> -->
						<?php }?>
				<?php } ?>
				<li>
					<a href="<?php echo base_url();?>password">
						<i class="fa fa-cog"></i>
						<span class="menu-text"> Ganti Password </span>
					</a>
				</li>
			</ul>
			<div class="sidebar-collapse" id="sidebar-collapse">
				<i class="fa fa-double-angle-left"></i>
			</div>
		</div>
	<?php }?>

<?php if($this->session->userdata("hak_akses")=='admin'){?>
	<div class="main-content">
		<div class="breadcrumbs" >
			<ul class="breadcrumb">
				<?php 
				$session_nama = $this->session->userdata('nama');
				$session_tipe = $this->session->userdata('hak_akses');
				echo "Selamat Datang, <strong>".$session_nama. "</strong> (Anda Login Sebagai <strong>".$session_tipe."</strong>) - <b>". $this->session->userdata('nama_rph')."</b>";
				?>
			</ul>
		</div>
		<div class="page-content">
			<div class="row-fluid">
<?php }else{?>
	<div class="breadcrumbs" >
		<ul class="breadcrumb">
			<?php 
				$session_nama = $this->session->userdata('nama');
				$session_tipe = $this->session->userdata('hak_akses');
				echo "Selamat Datang, <strong>".$session_nama. "</strong> (Anda Login Sebagai <strong>".$session_tipe."</strong>) - <b>". $this->session->userdata('nama_rph')."</b>";
			?>
		</ul>
	</div>
<?php }?>


