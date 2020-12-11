<div class="col-md-12">
	<div class="page-header">
		<h1>
			<i class="fa fa-list-alt"></i>
			<?php echo $judul; ?>
		</h1>
	</div><!-- /.page-header -->

	<div style="margin-bottom:20px;margin-top:40px;" class="row">
		<form action="<?php echo base_url(); ?>laporan_data_sapi/lihat_pemotongan_sapi" method="post"/>
		<div class="col-sm-8">
				<table class="tbl_input">
					<tr>
						<td style="width: 100px;">
							Tanggal
						</td>
						<td>
							<div class="input-group">
								<span class="input-group-addon">
									<i class="fa fa-calendar bigger-110"></i>
								</span>
								<input  id="tgl" class="form-control " type="text" name="tanggal1" value="<?php echo $tanggal1; ?>" required>
							</div>
						</td>
						<td style="width: 30px;"><center>s/d</center></td>
						<td>
							<div class="input-group">
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
							<select style="width:100%;" name="id_rph" class="select2">
								<?php echo $combo_rph; ?>
							</select>
						</td>
					</tr>	
					<tr>
						<td>
							Asal Sapi
						</td>
						<td>
							<select style="width:100%;" class="form-control" name="asal_sapi">
								<option value>[SEMUA]</option>
								<option value="GGL" <?php if($asal_sapi == 'GGL') { echo 'selected'; } ?>>GGL</option>
								<option value="NTF" <?php if($asal_sapi == 'NTF') { echo 'selected'; } ?>>NTF</option>
								<option value="PO" <?php if($asal_sapi == 'PO') { echo 'selected'; } ?>>PO</option>
							</select>
						</td>
					</tr>		
				</table> 
			</div>
			<div style="margin-top:15px;" class="col-md-12">
				<button style="border-radius:25px" class="btn btn-danger btn-sm" name="cari_report"><i class="fa fa-external-link"> </i> Lihat Report</button>
			<hr/>
			</div>
		</form>
	</div>

	<div class="row">
		<div class="col-xs-12">

	 				<center>
	          			<a style="margin-bottom:20px;border-radius:25px;" class="btn btn-primary btn-sm" onclick="exportPemotonganSapi('xls');" href="javascript://"><span class="glyphicon glyphicon-export"> </span> Export to Excell</a>
	          		</center>

	          		<p style="margin-bottom: 0;">LAPORAN PEMOTONGAN SAPI <b>(<?php echo $nama_rph; ?>)</b></p>
	          		<p style="font-weight:bold;margin-bottom: 0;">PER TANGGAL : <?php echo $tanggal1.' s/d '.$tanggal2; ?></p>
	          		<p style="font-weight:bold;">ASAL SAPI : <?php if(!empty($asal_sapi)) { echo $asal_sapi; } else { echo 'SEMUA'; } ?></p>
	          		<div style="overflow-y: scroll;margin-bottom: 20px;">
						<table style="font-size:12px;width: 1500px;" class="tbl_lapor">
							<thead>
								<tr>
									<th style="background: #22313F;color:#fff;width:50px;">No</th>
									<th style="background: #22313F;color:#fff;">RPH</th>
									<th style="background: #22313F;color:#fff;">Nota</th>
									<th style="background: #22313F;color:#fff;">Shipment</th>
									<th style="background: #22313F;color:#fff;">Jenis</th>
									<th style="background: #22313F;color:#fff;">Eartag</th>
									<th style="background: #22313F;color:#fff;">RFID</th>
									<th style="background: #22313F;color:#fff;">Tgl.Kirim (feedlot)</th>
									<th style="background: #22313F;color:#fff;">Tgl.Potong</th>
									<th style="background: #22313F;color:#fff;">Jam Potong</th>
									<th style="background: #22313F;color:#fff;">Umur</th>
									<th style="background: #22313F;color:#fff;">BBD</th>
									<th style="background: #22313F;color:#fff;">Karkas</th>
									<th style="background: #22313F;color:#fff;">% Karkas</th>
									<th style="background: #22313F;color:#fff;">Prosot</th>
									<th style="background: #22313F;color:#fff;">% Prosot</th>
									<th style="background: #22313F;color:#fff;">Ket.</th>
									<th style="background: #22313F;color:#fff;">Pasar</th>
									<th style="background: #22313F;color:#fff;">Pedagang</th>
									<th style="background: #22313F;color:#fff;">Merah</th>
									<th style="background: #22313F;color:#fff;">Orange</th>
									<th style="background: #22313F;color:#fff;">Hitam</th>
									<th style="background: #22313F;color:#fff;">Kuning</th>
									<th style="background: #22313F;color:#fff;">Peneumatic</th>
									<th style="background: #22313F;color:#fff;">Score</th>
								</tr>
							</thead>

							<tbody>
				<?php
						if($pemotongan_sapi != null) {
							$no = 1;
							foreach($pemotongan_sapi->result_array() as $data) { 
				?>
									<tr>
										<td><?php echo $no; ?></td>
										<td><?php echo $data['nama_rph']; ?></td>
										<td><?php echo $data['nota']; ?></td>
										<td><?php echo $data['shipment']; ?></td>
										<td><?php echo $data['material_description']; ?></td>
										<td><?php echo $data['eartag']; ?></td>
										<td><?php echo $data['rfid']; ?></td>
										<td>
											<?php 
												$id_pengiriman = $data['id_pengiriman'];
												$eartag = $data['eartag'];
												$rfid = $data['rfid'];
												if($data['transit']==1){
													$tanggal_ = $this->db->query("SELECT data_min.id_pengiriman,tanggal_kirim FROM(SELECT MIN(pg.id_pengiriman) AS id_pengiriman 
																				FROM(SELECT no_pengiriman FROM pengiriman WHERE id_pengiriman='$id_pengiriman')AS data_awal 
																				JOIN pengiriman pg ON pg.no_pengiriman=data_awal.no_pengiriman) AS data_min JOIN pengiriman 
																				ON pengiriman.id_pengiriman=data_min.id_pengiriman")->row();
													echo $tanggal_->tanggal_kirim;
												}else{
													echo $data['tanggal_kirim'];
												} 
											?>
										</td>
										<td><?php echo $data['tanggal_potong']; ?></td>
										<td><?php echo $data['jam_potong']; ?></td>
										<td><?php
											if(!empty($data['tanggal_potong'])) {
												if($data['transit']==1){
													$tanggal_ = $this->db->query("SELECT data_min.id_pengiriman,tanggal_kirim FROM(SELECT MIN(pg.id_pengiriman) AS id_pengiriman 
																				FROM(SELECT no_pengiriman FROM pengiriman WHERE id_pengiriman='$id_pengiriman')AS data_awal 
																				JOIN pengiriman pg ON pg.no_pengiriman=data_awal.no_pengiriman) AS data_min JOIN pengiriman 
																				ON pengiriman.id_pengiriman=data_min.id_pengiriman")->row();
													$start_date = new DateTime($tanggal_->tanggal_kirim);
												}else{
													$start_date = new DateTime($data['tanggal_kirim']);
												}
												$end_date = new DateTime($data['tanggal_potong']);
												$interval = $start_date->diff($end_date);
												echo $interval->days;
											} else {
												echo '-';
											}
											?>									
										</td>
										<td><?php echo $data['berat']; ?></td>
										<td><?php echo $data['berat_karkas']; ?></td>
										<!-- <td><?php echo round((($data['berat_karkas']/$data['berat'])*100),2); ?>%</td> -->
										<?php if($data['berat_karkas']==""){ ?>
										<td><?php echo ""; ?></td>
										<?php }else{?>
										<td><?php echo round((($data['berat_karkas']/$data['berat'])*100),2); ?>%</td>
										<?php }?>
										<td><?php echo $data['berat_prosot']; ?></td>
										<?php if($data['berat_prosot']==""){ ?>
										<td><?php echo ""; ?></td>
										<?php }else{?>
										<td><?php echo round((($data['berat_prosot']/$data['berat'])*100),2); ?>%</td>
										<?php }?>
										<td><?php echo $data['keterangan_potong']; ?></td>
										<td><?php echo $data['pasar']; ?></td>
										<td><?php echo $data['nama_pedagang']; ?></td>
										<td><?php echo $data['merah']; ?></td>
										<td><?php echo $data['orange']; ?></td>
										<td><?php echo $data['hitam']; ?></td>
										<td><?php echo $data['kuning']; ?></td>
										<td><?php echo $data['peneumatic']; ?></td>
										<td><?php echo $data['score_stune']; ?></td>
									</tr>
				<?php 		$no++; } 
						 ?>
							</tbody>
				<?php } ?>
						</table>
					</div>
		</div>
	</div>
</div>