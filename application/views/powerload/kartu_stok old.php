<div class="col-md-12">	
	<div class="page-header">
		<h1>
			<i class="fa fa-list-alt"></i>
			<?php echo $judul; ?>
		</h1>
	</div><!-- /.page-header -->

	<div style="margin-bottom:20px;margin-top:40px;" class="row">
		<form class="form-horizontal" action="<?php echo base_url(); ?>powerload/lihat_kartu_stok" method="post"/>
		<div class="col-sm-12">
				<table class="tbl_input">
					<tr>
						<td style="width: 100px;">
							Tanggal
						</td>
						<td  style="width: 150px;">
							<div style="width: 150px;" class="input-group">
								<span class="input-group-addon">
									<i class="fa fa-calendar bigger-110"></i>
								</span>
								<input  id="tgl" class="form-control " type="text" name="tanggal1" value="<?php echo $tanggal1; ?>" required>
							</div>
						</td>
						<td ><center>s/d</center></td>
						<td>
							<div style="width: 150px;" class="input-group">
								<span class="input-group-addon">
									<i class="fa fa-calendar bigger-110"></i>
								</span>
								<input  id="tgl2" class="form-control " type="text" name="tanggal2" value="<?php echo $tanggal2; ?>" required>
							</div>
						</td>
					</tr>	
					<tr>
						<td>
							RPH
						</td>
						<td>
							<select style="width:100%;" name="nama_rph" class="form-control" >
								<?php echo $combo_rph; ?>
							</select>
						</td>
					</tr>			
				</table>
			</div>
			<div style="margin-top:15px;" class="col-md-12">
				<button style="border-radius:25px;" class="btn btn-danger btn-sm" name="cari_report"><i class="fa fa-external-link"> </i> Lihat Report</button>
			<hr/>
			</div>
		</form>
	</div>

	<div class="row">
		<div class="col-xs-12">

	 				<center>
	          			<a style="margin-bottom:20px;" class="btn btn-primary btn-sm" onclick="exportPowerload('xls');" href="javascript://"><span class="glyphicon glyphicon-export"> </span> Export to Excell</a>
	          		</center>

	          		<p style="margin-bottom: 0;">LAPORAN KARTU  STOK </p>
	          		<p style="font-weight:bold;">PER TANGGAL : <?php echo $tanggal1.' s/d '.$tanggal2; ?></p>
					<table class="table table-striped table-bordered table-hover">
						<thead>
							<tr>
								<th style="width:50px;background: #22313F;color:#fff;">No</th>
								<th style="background: #22313F;color:#fff;">Tanggal</th>
								<th colspan="5" style="background: #22313F;color:#fff;">Masuk</th>
								<th colspan="5" style="background: #22313F;color:#fff;">Pakai</th>
								<th style="background: #22313F;color:#fff;">Saldo</th>
							</tr>
							<tr>
								<th style="background: #22313F;color:#fff;"></th>
								<th style="background: #22313F;color:#fff;"></th>
								<th style="background: #22313F;color:#fff;">Merah</th>
								<th style="background: #22313F;color:#fff;">Orange</th>
								<th style="background: #22313F;color:#fff;">Hitam</th>
								<th style="background: #22313F;color:#fff;">Kuning</th>
								<th style="background: #22313F;color:#fff;">Total Qty</th>	
								<th style="background: #22313F;color:#fff;">Merah</th>
								<th style="background: #22313F;color:#fff;">Orange</th>
								<th style="background: #22313F;color:#fff;">Hitam</th>
								<th style="background: #22313F;color:#fff;">Kuning</th>
								<th style="background: #22313F;color:#fff;">Total Qty</th>
								<th style="background: #22313F;color:#fff;"></th>
							</tr>
						</thead>

						<tbody>
						<?php 
							if($this->uri->segment(2) == "lihat_kartu_stok") {  
								$no = 1;

								$total_saldo_in = 0;
								$total_saldo_out = 0;
								$begin = new DateTime($tanggal1);
								$end = new DateTime($tanggal2);
								$end = $end->modify( '+1 day' ); 
								$interval = new DateInterval('P1D');
								$period = new DatePeriod($begin, $interval, $end);

								$yesterday = date('Y-m-d', strtotime($tanggal1."-1 days"));
								
								$data_saldo_in = $this->db->query("SELECT tanggal,SUM(merah) as sd_merah,SUM(orange) as sd_orange,SUM(hitam) as sd_hitam,SUM(kuning) as sd_kuning FROM powerload  WHERE tanggal <='$yesterday' AND id_rph = '$id_rph'");
								foreach($data_saldo_in->result_array() as $saldo_in) {
									$total_saldo_in = $saldo_in['sd_merah'] + $saldo_in['sd_orange'] + $saldo_in['sd_hitam'] + $saldo_in['sd_kuning'];
								}

								$data_saldo_out = $this->db->query("SELECT tanggal_potong,SUM(merah) as sd_merah,SUM(orange) as sd_orange,SUM(hitam) as sd_hitam,SUM(kuning) as sd_kuning FROM penerimaan_detail INNER JOIN pengiriman ON penerimaan_detail.id_pengiriman = pengiriman.id_pengiriman WHERE penerimaan_detail.tanggal_potong <='$yesterday' AND pengiriman.id_rph = '$id_rph' AND status_potong = '1' GROUP BY tanggal_potong");

								foreach($data_saldo_out->result_array() as $saldo_out) {
									$total_saldo_out = $saldo_out['sd_merah'] + $saldo_out['sd_orange'] + $saldo_out['sd_hitam'] + $saldo_out['sd_kuning'];
								}

								$saldo_awal = $total_saldo_in - $total_saldo_out; 
						?>

								<tr style="font-weight: bold;">
									<td>#</td>
									<td><?php 
										$tgl_db_in = explode("-", $yesterday); 
										$tgl_convert_in = $tgl_db_in[2]."/".$tgl_db_in[1]."/".$tgl_db_in[0];
										echo $tgl_convert_in;
										?>											
									</td>
									<td colspan="10" style="text-align: left;">SALDO AWAL</td>
									<td><?php echo $saldo_awal; ?></td>
								</tr>
						<?php
								foreach($period as $dt) { 
									$date_range = $dt->format( "Y-m-d" );
									$data_masuk = $this->db->query("SELECT tanggal,merah,orange,hitam,kuning FROM powerload  WHERE tanggal ='$date_range' AND id_rph = '$id_rph'");

									$data_keluar = $this->db->query("SELECT tanggal_potong,SUM(merah) as tot_merah,SUM(orange) as tot_orange,SUM(hitam) as tot_hitam,SUM(kuning) as tot_kuning FROM penerimaan_detail INNER JOIN pengiriman ON penerimaan_detail.id_pengiriman = pengiriman.id_pengiriman WHERE penerimaan_detail.tanggal_potong ='$date_range' AND pengiriman.id_rph = '$id_rph' AND status_potong = '1' GROUP BY tanggal_potong");

									foreach($data_masuk->result_array() as $data_in) {
								?>

										<tr>
											<td><?php echo $no; ?></td>
											<td><?php 
													$tgl_db_in = explode("-", $data_in['tanggal']); 
													$tgl_convert_in = $tgl_db_in[2]."/".$tgl_db_in[1]."/".$tgl_db_in[0];
													echo $tgl_convert_in;
												?>
											</td>
											<td><?php echo $data_in["merah"]; ?></td>
											<td><?php echo $data_in["orange"]; ?></td>
											<td><?php echo $data_in["hitam"]; ?></td>
											<td><?php echo $data_in["kuning"]; ?></td>
											<td><?php 
													$total_qty_in = $data_in['merah'] + $data_in['orange'] + $data_in['hitam'] + $data_in['kuning'];


													echo $total_qty_in;
												?>
											</td>
											<td>-</td>
											<td>-</td>
											<td>-</td>
											<td>-</td>
											<td>-</td>
											<td><?php
													$saldo_awal = $saldo_awal + $total_qty_in;
												 	echo $saldo_awal ;
												 ?>											
											</td>
										</tr>
					<?php 	$no++;	}

									foreach($data_keluar->result_array() as $data_out) {

								?>

										<tr>
											<td><?php echo $no; ?></td>
											<td><?php 
													$tgl_db_in = explode("-", $data_out['tanggal_potong']); 
													$tgl_convert_in = $tgl_db_in[2]."/".$tgl_db_in[1]."/".$tgl_db_in[0];
													echo $tgl_convert_in;
												?></td>
											<td>-</td>
											<td>-</td>
											<td>-</td>
											<td>-</td>
											<td>-</td>

											<td><?php echo $data_out["tot_merah"]; ?></td>
											<td><?php echo $data_out["tot_orange"]; ?></td>
											<td><?php echo $data_out["tot_hitam"]; ?></td>
											<td><?php echo $data_out["tot_kuning"]; ?></td>
											<td><?php 
													$total_qty_out = $data_out['tot_merah'] + $data_out['tot_orange'] + $data_out['tot_hitam'] + $data_out['tot_kuning'];						
													echo $total_qty_out;
												?>
											</td>
											<td><?php
													$saldo_awal = $saldo_awal - $total_qty_out;
												 	echo $saldo_awal ;
												 ?>											
											</td>
										</tr>
					<?php 			}
						 		}
							} ?>
						</tbody>
		
					</table>

					<?php
						$data_merah_in = 0;
						$data_orange_in = 0;
						$data_hitam_in = 0;
						$data_kuning_in = 0;

						$data_merah_out = 0;
						$data_orange_out = 0;
						$data_hitam_out = 0;
						$data_kuning_out = 0;

						$data_single_in = $this->db->query("SELECT tanggal,SUM(merah) as sd_merah,SUM(orange) as sd_orange,SUM(hitam) as sd_hitam,SUM(kuning) as sd_kuning FROM powerload  WHERE tanggal <='$tanggal2' AND id_rph = '$id_rph'"); 
						if($data_single_in->num_rows() >0) {
							foreach($data_single_in->result_array() as $single_data_in) {
								$data_merah_in = $single_data_in['sd_merah'];
								$data_orange_in = $single_data_in['sd_orange'];
								$data_hitam_in = $single_data_in['sd_hitam'];
								$data_kuning_in = $single_data_in['sd_kuning'];
							}
						}

						$data_single_out = $this->db->query("SELECT tanggal_potong,SUM(merah) as sd_merah,SUM(orange) as sd_orange,SUM(hitam) as sd_hitam,SUM(kuning) as sd_kuning FROM penerimaan_detail INNER JOIN pengiriman ON penerimaan_detail.id_pengiriman = pengiriman.id_pengiriman WHERE penerimaan_detail.tanggal_potong <='$tanggal2' AND pengiriman.id_rph = '$id_rph' AND status_potong = '1'");
						if($data_single_out->num_rows() >0) {
							foreach($data_single_out->result_array() as $single_data_out) {
								$data_merah_out = $single_data_out['sd_merah'];
								$data_orange_out = $single_data_out['sd_orange'];
								$data_hitam_out = $single_data_out['sd_hitam'];
								$data_kuning_out = $single_data_out['sd_kuning'];
							}
						}

					?>
									<table class="table table-bordered" style="width:20%;">
										<tr>
											<td style="width:100px;background: #000;color: #fff;">Merah</td>
											<td style="text-align: right;"><?php 
													$data_merah = $data_merah_in - $data_merah_out;
													echo $data_merah;
												?>												
											</td>
										</tr>
										<tr>
											<td style="background: #000;color: #fff;">Orange</td>
											<td style="text-align: right;"><?php 
													$data_orange = $data_orange_in - $data_orange_out;
													echo $data_orange;
												?>												
											</td>
										</tr>
										<tr>
											<td style="background: #000;color: #fff;">Hitam</td>
											<td style="text-align: right;"><?php 
													$data_hitam = $data_hitam_in - $data_hitam_out;
													echo $data_hitam;
												?>												
											</td>
										</tr>
										<tr>
											<td style="background: #000;color: #fff;">Kuning</td>
											<td style="text-align: right;"><?php 
													$data_kuning = $data_kuning_in - $data_kuning_out;
													echo $data_kuning;
												?>												
											</td>
										</tr>
										<tr>
											<td>Total</td>
											<td style="text-align: right;"><?php 
													echo $data_merah + $data_orange + $data_hitam + $data_kuning;
												?>												
											</td>
										</tr>
									</table>
				
		</div>
	</div>
</div>