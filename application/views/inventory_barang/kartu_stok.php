<div class="page-header">
	<h1>
		<i class="fa fa-list-alt"></i>
		<?php echo $judul; ?>
	</h1>
</div><!-- /.page-header -->

<div style="margin-bottom:20px;margin-top:40px;" class="row">
	<form class="form-horizontal" action="<?php echo base_url(); ?>laporan_data_sapi/lihat_kartu_stok_sapi" method="post"/>
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
					<td style="width: 80px;">
						Barang
					</td>
					<td>
						<select style="width:230px;" name="id_barang" class="form-control" required>
							<?php echo $combo_barang; ?>
						</select>
					</td>
				</tr>	
				<tr>
					<td>
						RPH
					</td>
					<td>
						<select style="width:100%;" name="id_rph" class="form-control" required>
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
          			<a style="margin-bottom:20px;border-radius:25px;" class="btn btn-primary btn-sm" onclick="exportTo('xls');" href="javascript://"><span class="glyphicon glyphicon-export"> </span> Export to Excell</a>
          		</center>

          		<p style="margin-bottom: 0;">LAPORAN KARTU  STOK </p>
          		<p style="font-weight:bold;">PER TANGGAL : <?php echo $tanggal1.' s/d '.$tanggal2; ?></p>
				<table id="tblExport" class="table table-striped table-bordered table-hover">
					<thead>
						<tr>
							<th style="width:50px;background: #22313F;color:#fff;">No</th>
							<th style="background: #22313F;color:#fff;">Tanggal</th>
							<th colspan="3" style="background: #22313F;color:#fff;">Masuk</th>
							<th colspan="3" style="background: #22313F;color:#fff;">Keluar</th>
							<th style="background: #22313F;color:#fff;">Saldo</th>
						</tr>
						<tr>
							<th style="background: #22313F;color:#fff;"></th>
							<th style="background: #22313F;color:#fff;"></th>
							<th style="background: #22313F;color:#fff;">Nota</th>
							<th style="background: #22313F;color:#fff;">Transaksi</th>
							<th style="background: #22313F;color:#fff;">Qty</th>	
							<th style="background: #22313F;color:#fff;">Nota</th>							
							<th style="background: #22313F;color:#fff;">Transaksi</th>
							<th style="background: #22313F;color:#fff;">Qty</th>
							<th style="background: #22313F;color:#fff;"></th>
						</tr>
					</thead>

					<tbody>
					<?php 
						if($this->uri->segment(2) == "lihat_kartu_stok") {  
							$no = 1;
							$begin = new DateTime($tanggal1);
							$end = new DateTime($tanggal2);
							$end = $end->modify( '+1 day' ); 
							$interval = new DateInterval('P1D');
							$period = new DatePeriod($begin, $interval, $end);

							$yesterday = date('Y-m-d', strtotime($tanggal1."-1 days"));
							/*
							$data_saldo_in = $this->db->query("SELECT COUNT(*) as qtyIn FROM transfer_barang_detail INNER JOIN transfer_barang ON transfer_barang.id_transfer = transfer_barang_detail.id_transfer WHERE transfer_barang.tanggal_transfer <='$yesterday' OR transfer_barang_detail.tanggal_transfer <='$yesterday' AND transfer_barang.id_rph = '$id_rph' AND transfer_barang.id_barang = '$id_barang'")->row();

							$data_saldo_out = $this->db->query("SELECT COUNT(*) as qtyOut FROM transfer_barang_detail INNER JOIN transfer_barang ON transfer_barang.id_transfer = transfer_barang_detail.id_transfer WHERE transfer_barang_detail.tanggal_transfer <='$yesterday' AND transfer_barang.id_rph = '$id_rph'")->row();

							$saldo_awal = $data_saldo_in->qtyIn - $data_saldo_out->qtyOut; */
					?>

							<tr style="font-weight: bold;">
								<td>#</td>
								<td><?php 
									//$tgl_db_in = explode("-", $yesterday); 
									//$tgl_convert_in = $tgl_db_in[2]."/".$tgl_db_in[1]."/".$tgl_db_in[0];
									//echo $tgl_convert_in;
									?>											
								</td>
								<td colspan="6" style="text-align: left;">SALDO AWAL</td>
								<td><?php //echo $saldo_awal; ?></td>
							</tr>
					<?php
							$total_in = 0;
							$total_out = 0;
							foreach($period as $dt) { 
								$date_range = $dt->format( "Y-m-d" );
								$data_masuk = $this->db->query("SELECT COUNT(*) as total_barang,tanggal_transfer,qty FROM transfer_barang_detail INNER JOIN transfer_barang ON transfer_barang.id_transfer = transfer_barang_detail.id_transfer WHERE transfer_barang.tanggal_transfer ='$date_range' AND transfer_barang.id_rph = '$id_rph' AND transfer_barang_detail.id_barang = '$id_barang' ");

								$data_keluar = $this->db->query("SELECT COUNT(*) as total_barang,tanggal_transfer,tanggal_transfer FROM transfer_barang_detail INNER JOIN transfer_barang ON transfer_barang.id_transfer = transfer_barang_detail.id_transfer WHERE transfer_barang_detail.tanggal_transfer ='$date_range' AND transfer_barang.id_rph = '$id_rph' AND status_potong = '1' GROUP BY nota");

								foreach($data_masuk->result_array() as $data_in) {
									$total_in += $data_in['total_barang']
							?>

									<tr>
										<td><?php echo $no; ?></td>
										<td><?php 
												$tgl_db_in = explode("-", $data_in['tanggal_transfer']); 
												$tgl_convert_in = $tgl_db_in[2]."/".$tgl_db_in[1]."/".$tgl_db_in[0];
												echo $tgl_convert_in;
											?>
										</td>
										<td><?php echo $data_in["nota"]; ?></td>
										<td>Sapi Masuk</td>
										<td><?php echo $data_in['total_barang']; ?></td>
										<td>-</td>
										<td>-</td>
										<td>-</td>
										<td><?php $saldo_awal = $saldo_awal + $data_in['total_barang']; echo $saldo_awal; ?></td>
									</tr>
				<?php 	$no++;	}

								foreach($data_keluar->result_array() as $data_out) {
									$total_out += $data_out['total_barang']
							?>

									<tr>
										<td><?php echo $no; ?></td>
										<td><?php 
												$tgl_db_in = explode("-", $data_out['tanggal_transfer']); 
												$tgl_convert_in = $tgl_db_in[2]."/".$tgl_db_in[1]."/".$tgl_db_in[0];
												echo $tgl_convert_in;
											?>
										</td>

										<td>-</td>
										<td>-</td>
										<td>-</td>
										<td><?php echo $data_out["nota"]; ?></td>
										<td>Sapi Keluar/Dipotong</td>
										<td><?php echo $data_out['total_barang']; ?></td>
										<td><?php $saldo_awal = $saldo_awal - $data_out['total_barang']; echo $saldo_awal; ?></td>
									</tr>
				<?php 			}
					 		}
						} ?>
					</tbody>
					<tfoot>
							<tr>
								<td colspan="4"><center><b>Total</b></center></td>
								<td><b><?php echo $total_in; ?></b></td>
								<td colspan="2"></td>
								<td><b><?php echo $total_out; ?></b></td>
								<td></td>
							</tr>
					</tfoot>
	
				</table>
	</div>
</div>
