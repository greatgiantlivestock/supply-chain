<div class="col-md-12">	
	<div class="page-header">
		<h1>
			<i class="fa fa-list-alt"></i>
			<?php echo $judul; ?>
		</h1>
	</div><!-- /.page-header -->

	<div  class="row">
		<form class="form-horizontal" action="<?php echo base_url(); ?>log_pengiriman/lihat_laporan" method="post"/>
	<div class="col-sm-8">
				<table class="tbl_input">
					<tr>
						<td style="width: 100px;">
							No Nota
						</td>
						<td>
							<select  style="width: 100%;"  name="nota" class="select_awo">
								<?php echo $combo_nota; ?>
							</select>
						</td>
					</tr>
					<!-- <tr>
						<td style="width: 100px;">
							Tanggal Kirim
						</td>
						<td>
							<div class="input-group">
								<span class="input-group-addon">
									<i class="fa fa-calendar bigger-110"></i>
								</span>
								<input  id="tgl" class="form-control " type="text" name="tanggal1" value="<?php echo $tanggal1; ?>" required>
							</div>
						</td>
						<td style="width: 120px; padding-left:10px;">Sampai</td>
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
						<td style="width: 100px;">
							Dari
						</td>
						<td>
							<select  style="width: 100%;" name="nama_rph1" class="select_awo">
								<?php echo $combo_rph1; ?>
							</select>
						</td>					
						<td style="width: 120px; padding-left: 10px;">
							Tujuan
						</td>
						<td>
							<select  style="width: 100%;" name="nama_rph2" class="select_awo">
								<?php echo $combo_rph2; ?>
							</select>
						</td>					
					</tr>			 -->
				</table>
			</div>
			<div style="margin-top:15px;" class="col-md-12">
				<button style="border-radius:25px;" class="btn btn-danger btn-sm" name="cari_report"><i class="fa fa-external-link"> </i> Lihat Report</button>
			<hr/>
			</div>
		</form>
	</div>

	<div class="row">
		<div class="col-xs-12" style="overflow-x: scroll;overflow-y: scroll;">

	 				<center>
	          			<a style="border-radius:25px;" class="btn btn-primary btn-sm" onclick="exportTraceabilitySapi('xls');" href="javascript://"><span class="glyphicon glyphicon-export"> </span> Export to Excell</a>
	          		</center>

	          		<p style="margin-bottom: 0;">LOG PENGIRIMAN SAPI </p>
	          		<p style="font-weight:bold;">Nomor Nota : <?php if($nota==""){echo"Semua";}else{echo $nota;} ?></p>
					<table class="table table-striped table-bordered table-hover">
						<thead>
							<tr>
								<th style="background: #22313F;color:#fff;">Asal Sapi</th>
								<th style="background: #22313F;color:#fff;">Visual Tag</th>
								<th style="background: #22313F;color:#fff;">Lot Number</th>
								<th style="background: #22313F;color:#fff;">RFID</th>
								<th style="background: #22313F;color:#fff;">Session Description</th>
								<th style="background: #22313F;color:#fff;">Type Exit</th>
								<th style="background: #22313F;color:#fff;">Exit Date</th> 
								<th style="background: #22313F;color:#fff;">Nota</th>
								<th style="background: #22313F;color:#fff;">Depo</th>
								<th style="background: #22313F;color:#fff;">Arrival Depo</th>
								<th style="background: #22313F;color:#fff;">Exit Depo</th>
								<th style="background: #22313F;color:#fff;">Customer</th>
								<th style="background: #22313F;color:#fff;">Arrival Abattoir</th>
								<th style="background: #22313F;color:#fff;">Status Potong</th>
								<th style="background: #22313F;color:#fff;">Date Slaughter</th>
								<th style="background: #22313F;color:#fff;">Time Slaughter</th>
								<th style="background: #22313F;color:#fff;">Exporter</th>
								<th style="background: #22313F;color:#fff;">Abattoir</th>
								<th style="background: #22313F;color:#fff;">Status RFID</th>
							</tr>
						</thead>

						<tbody>
	<?php 
		if($this->uri->segment(2) == 'lihat_laporan') {
			$countdata_mutasi = $this->db->query("SELECT count(*) as count1 FROM pengiriman_detail dp JOIN pengiriman pg ON pg.id_pengiriman=dp.id_pengiriman 
											JOIN movement_log ml ON ml.id_pengiriman=pg.id_pengiriman 
											LEFT JOIN penerimaan_detail pd ON pd.id_pengiriman=dp.id_pengiriman AND pd.eartag=dp.eartag 
											WHERE dp.nota LIKE '%$nota%' AND intransit=1")->row();
			if($nota==''){
				// $data_mutasi = $this->db->query("SELECT data_master.*, COUNT(id_pengiriman_detail)AS jumlah FROM(
				// 								SELECT pg.id_pengiriman,move_from, move_to,tanggal_kirim,jam_kirim,user,keterangan,status_terima,
				// 								tanggal_terima,jam_terima,keterangan_terima FROM movement_log ml JOIN pengiriman pg 
				// 								ON ml.id_pengiriman = pg.id_pengiriman WHERE tanggal_kirim BETWEEN '$tanggal1' AND '$tanggal2' 
				// 								AND no_pengiriman LIKE '%$nota%' AND move_from LIKE '%$nama_rph1%' AND move_to LIKE '%$nama_rph2%')
				// 								AS data_master JOIN pengiriman_detail ON data_master.id_pengiriman=pengiriman_detail.id_pengiriman
				// 								GROUP BY data_master.id_pengiriman");
				$data_mutasi = $this->db->query("SELECT data_mutasi.*,pd.tanggal_potong,pd.jam_potong FROM(SELECT data1.*,data2.tanggal_kirim AS tanggal_kirim2,data2.jam_kirim AS jam_kirim2,
											data2.tanggal_terima AS tanggal_terima2,data2.jam_terima AS jam_terima2,data2.asal_sapi AS asal_sapi2,data2.move_from AS move_from2,
											data2.move_to AS move_to2,data2.id_pengiriman_detail AS id_pengiriman_detail2,data2.id_pengiriman AS id_pengiriman2,data2.nota AS nota2,
											data2.eartag AS eartag2,data2.shipment AS shipment2,data2.material_description AS material_description2,data2.rfid AS rfid2,data2.berat AS berat2,
											data2.customer AS customer2,data2.no_kendaraan AS no_kendaraan2,data2.status_terima AS status_terima2,data2.eartag1 AS eartag12,
											data2.rfid1 AS rfid12,data2.status_potong AS status_potong2,data2.flag AS flag2,data2.flag1 AS flag12,data2.intransit AS intransit2,
											data2.keterangan AS keterangan2,data2.keterangan_terima AS keterangan_terima2
											FROM(SELECT tanggal_kirim,jam_kirim,tanggal_terima,jam_terima,asal_sapi,
											move_from,move_to,dp.*,pd.eartag AS eartag1,pd.rfid AS rfid1,status_potong,flag,flag1,intransit,keterangan,keterangan_terima 
											FROM pengiriman_detail dp JOIN pengiriman pg ON pg.id_pengiriman=dp.id_pengiriman 
											JOIN movement_log ml ON ml.id_pengiriman=pg.id_pengiriman 
											LEFT JOIN penerimaan_detail pd ON pd.id_pengiriman=dp.id_pengiriman AND pd.eartag=dp.eartag 
											WHERE dp.nota LIKE '%$nota%' AND intransit=1)AS data1
											LEFT JOIN(SELECT tanggal_kirim,jam_kirim,tanggal_terima,jam_terima,asal_sapi,
											move_from,move_to,dp.*,pd.eartag AS eartag1,pd.rfid AS rfid1,status_potong,flag,flag1,intransit,keterangan,keterangan_terima 
											FROM pengiriman_detail dp JOIN pengiriman pg ON pg.id_pengiriman=dp.id_pengiriman 
											JOIN movement_log ml ON ml.id_pengiriman=pg.id_pengiriman 
											LEFT JOIN penerimaan_detail pd ON pd.id_pengiriman=dp.id_pengiriman AND pd.eartag=dp.eartag 
											WHERE dp.nota LIKE '%$nota%' AND intransit=0)AS data2
											ON data1.rfid=data2.rfid)AS data_mutasi 
											LEFT JOIN penerimaan_detail pd
											ON data_mutasi.rfid=pd.rfid WHERE pd.intransit=0");
				$data_mutasi1 = $this->db->query("SELECT data_mutasi.*,pd.tanggal_potong,pd.jam_potong FROM(SELECT data1.*,data2.tanggal_kirim AS tanggal_kirim2,data2.jam_kirim AS jam_kirim2,
											data2.tanggal_terima AS tanggal_terima2,data2.jam_terima AS jam_terima2,data2.asal_sapi AS asal_sapi2,data2.move_from AS move_from2,
											data2.move_to AS move_to2,data2.id_pengiriman_detail AS id_pengiriman_detail2,data2.id_pengiriman AS id_pengiriman2,data2.nota AS nota2,
											data2.eartag AS eartag2,data2.shipment AS shipment2,data2.material_description AS material_description2,data2.rfid AS rfid2,data2.berat AS berat2,
											data2.customer AS customer2,data2.no_kendaraan AS no_kendaraan2,data2.status_terima AS status_terima2,data2.eartag1 AS eartag12,
											data2.rfid1 AS rfid12,data2.status_potong AS status_potong2,data2.flag AS flag2,data2.flag1 AS flag12,data2.intransit AS intransit2,
											data2.keterangan AS keterangan2,data2.keterangan_terima AS keterangan_terima2
											FROM(SELECT tanggal_kirim,jam_kirim,tanggal_terima,jam_terima,asal_sapi,
											move_from,move_to,dp.*,pd.eartag AS eartag1,pd.rfid AS rfid1,status_potong,flag,flag1,intransit,keterangan,keterangan_terima 
											FROM pengiriman_detail dp JOIN pengiriman pg ON pg.id_pengiriman=dp.id_pengiriman 
											JOIN movement_log ml ON ml.id_pengiriman=pg.id_pengiriman 
											LEFT JOIN penerimaan_detail pd ON pd.id_pengiriman=dp.id_pengiriman AND pd.eartag=dp.eartag 
											WHERE dp.nota LIKE '%$nota%' AND intransit=0)AS data1
											LEFT JOIN(SELECT tanggal_kirim,jam_kirim,tanggal_terima,jam_terima,asal_sapi,
											move_from,move_to,dp.*,pd.eartag AS eartag1,pd.rfid AS rfid1,status_potong,flag,flag1,intransit,keterangan,keterangan_terima 
											FROM pengiriman_detail dp JOIN pengiriman pg ON pg.id_pengiriman=dp.id_pengiriman 
											JOIN movement_log ml ON ml.id_pengiriman=pg.id_pengiriman 
											LEFT JOIN penerimaan_detail pd ON pd.id_pengiriman=dp.id_pengiriman AND pd.eartag=dp.eartag 
											WHERE dp.nota LIKE '%$nota%' AND intransit=0)AS data2
											ON data1.rfid=data2.rfid)AS data_mutasi 
											LEFT JOIN penerimaan_detail pd
											ON data_mutasi.rfid=pd.rfid WHERE pd.intransit=0");
			}else{
				// $data_mutasi = $this->db->query("SELECT data_master.*, COUNT(id_pengiriman_detail)AS jumlah FROM(
				// 								SELECT pg.id_pengiriman,move_from, move_to,tanggal_kirim,jam_kirim,user,keterangan,status_terima,
				// 								tanggal_terima,jam_terima,keterangan_terima FROM movement_log ml JOIN pengiriman pg 
				// 								ON ml.id_pengiriman = pg.id_pengiriman WHERE tanggal_kirim BETWEEN '$tanggal1' AND '$tanggal2' 
				// 								AND no_pengiriman = '$nota' AND move_from LIKE '%$nama_rph1%' AND move_to LIKE '%$nama_rph2%')
				// 								AS data_master JOIN pengiriman_detail ON data_master.id_pengiriman=pengiriman_detail.id_pengiriman
				// 								GROUP BY data_master.id_pengiriman");
				$data_mutasi = $this->db->query("SELECT data_mutasi.*,pd.tanggal_potong,pd.jam_potong FROM(SELECT data1.*,data2.tanggal_kirim AS tanggal_kirim2,data2.jam_kirim AS jam_kirim2,
											data2.tanggal_terima AS tanggal_terima2,data2.jam_terima AS jam_terima2,data2.asal_sapi AS asal_sapi2,data2.move_from AS move_from2,
											data2.move_to AS move_to2,data2.id_pengiriman_detail AS id_pengiriman_detail2,data2.id_pengiriman AS id_pengiriman2,data2.nota AS nota2,
											data2.eartag AS eartag2,data2.shipment AS shipment2,data2.material_description AS material_description2,data2.rfid AS rfid2,data2.berat AS berat2,
											data2.customer AS customer2,data2.no_kendaraan AS no_kendaraan2,data2.status_terima AS status_terima2,data2.eartag1 AS eartag12,
											data2.rfid1 AS rfid12,data2.status_potong AS status_potong2,data2.flag AS flag2,data2.flag1 AS flag12,data2.intransit AS intransit2,
											data2.keterangan AS keterangan2,data2.keterangan_terima AS keterangan_terima2
											FROM(SELECT tanggal_kirim,jam_kirim,tanggal_terima,jam_terima,asal_sapi,
											move_from,move_to,dp.*,pd.eartag AS eartag1,pd.rfid AS rfid1,status_potong,flag,flag1,intransit,keterangan,keterangan_terima 
											FROM pengiriman_detail dp JOIN pengiriman pg ON pg.id_pengiriman=dp.id_pengiriman 
											JOIN movement_log ml ON ml.id_pengiriman=pg.id_pengiriman 
											LEFT JOIN penerimaan_detail pd ON pd.id_pengiriman=dp.id_pengiriman AND pd.eartag=dp.eartag 
											WHERE dp.nota = '$nota' AND intransit=1)AS data1
											LEFT JOIN (SELECT tanggal_kirim,jam_kirim,tanggal_terima,jam_terima,asal_sapi,
											move_from,move_to,dp.*,pd.eartag AS eartag1,pd.rfid AS rfid1,status_potong,flag,flag1,intransit,keterangan,keterangan_terima 
											FROM pengiriman_detail dp JOIN pengiriman pg ON pg.id_pengiriman=dp.id_pengiriman 
											JOIN movement_log ml ON ml.id_pengiriman=pg.id_pengiriman 
											LEFT JOIN penerimaan_detail pd ON pd.id_pengiriman=dp.id_pengiriman AND pd.eartag=dp.eartag 
											WHERE dp.nota = '$nota' AND intransit=0)AS data2
											ON data1.rfid=data2.rfid)AS data_mutasi 
											LEFT JOIN penerimaan_detail pd
											ON data_mutasi.rfid=pd.rfid WHERE pd.intransit=0");
				$data_mutasi1 = $this->db->query("SELECT data_mutasi.*,pd.tanggal_potong,pd.jam_potong FROM(SELECT data1.*,data2.tanggal_kirim AS tanggal_kirim2,data2.jam_kirim AS jam_kirim2,
											data2.tanggal_terima AS tanggal_terima2,data2.jam_terima AS jam_terima2,data2.asal_sapi AS asal_sapi2,data2.move_from AS move_from2,
											data2.move_to AS move_to2,data2.id_pengiriman_detail AS id_pengiriman_detail2,data2.id_pengiriman AS id_pengiriman2,data2.nota AS nota2,
											data2.eartag AS eartag2,data2.shipment AS shipment2,data2.material_description AS material_description2,data2.rfid AS rfid2,data2.berat AS berat2,
											data2.customer AS customer2,data2.no_kendaraan AS no_kendaraan2,data2.status_terima AS status_terima2,data2.eartag1 AS eartag12,
											data2.rfid1 AS rfid12,data2.status_potong AS status_potong2,data2.flag AS flag2,data2.flag1 AS flag12,data2.intransit AS intransit2,
											data2.keterangan AS keterangan2,data2.keterangan_terima AS keterangan_terima2
											FROM(SELECT tanggal_kirim,jam_kirim,tanggal_terima,jam_terima,asal_sapi,
											move_from,move_to,dp.*,pd.eartag AS eartag1,pd.rfid AS rfid1,status_potong,flag,flag1,intransit,keterangan,keterangan_terima 
											FROM pengiriman_detail dp JOIN pengiriman pg ON pg.id_pengiriman=dp.id_pengiriman 
											JOIN movement_log ml ON ml.id_pengiriman=pg.id_pengiriman 
											LEFT JOIN penerimaan_detail pd ON pd.id_pengiriman=dp.id_pengiriman AND pd.eartag=dp.eartag 
											WHERE dp.nota = '$nota' AND intransit=0)AS data1
											LEFT JOIN (SELECT tanggal_kirim,jam_kirim,tanggal_terima,jam_terima,asal_sapi,
											move_from,move_to,dp.*,pd.eartag AS eartag1,pd.rfid AS rfid1,status_potong,flag,flag1,intransit,keterangan,keterangan_terima 
											FROM pengiriman_detail dp JOIN pengiriman pg ON pg.id_pengiriman=dp.id_pengiriman 
											JOIN movement_log ml ON ml.id_pengiriman=pg.id_pengiriman 
											LEFT JOIN penerimaan_detail pd ON pd.id_pengiriman=dp.id_pengiriman AND pd.eartag=dp.eartag 
											WHERE dp.nota = '$nota' AND intransit=0)AS data2
											ON data1.rfid=data2.rfid)AS data_mutasi 
											LEFT JOIN penerimaan_detail pd
											ON data_mutasi.rfid=pd.rfid WHERE pd.intransit=0");
			}
			$no=1;		?>
		<?php 	
			if($nota==""){
				foreach ($data_mutasi1->result_array() as $data_awo) { ?>
					<?php 
						if($data_awo['status_potong2']>0){
							$bg = 'style="background: #fffca8;"';
							// $bg = 'style="background: #87fff4;"';
						}else{
							$bg='style="background: #ffa480;"';
						}
					?>
					<?php if($data_awo['asal_sapi']==$data_awo['move_from']){?>
					<tr <?php echo $bg?>>
						<td><?php echo $data_awo['asal_sapi']; ?></td>
						<td><?php echo $data_awo['eartag']; ?></td>
						<td><?php echo $data_awo['shipment']; ?></td>
						<td><?php echo $data_awo['rfid']; ?></td>
						<td><?php echo $data_awo['session']; ?></td>
						<td><?php echo $data_awo['type_exit']; ?></td>
						<td><?php echo $data_awo['tanggal_kirim']; ?></td>
						<td><?php echo $data_awo['nota']; ?></td>
						<td></td>
						<td></td>
						<td></td>
						<td><?php echo $data_awo['customer']; ?></td>
						<td><?php echo $data_awo['tanggal_terima2']; ?></td>
						<td><?php if($data_awo['status_potong2']>0)
									{echo "Terpotong";}
								else{echo "Belum Dipotong";} 
							?>
						</td>
						<td><?php echo $data_awo['tanggal_potong']; ?></td>
						<td><?php echo $data_awo['jam_potong']; ?></td>
						<td><?php echo $data_awo['exporter']; ?></td>
						<td><?php echo $data_awo['move_to2']; ?></td>
						<td>
							<?php 
								if($data_awo['flag2']=='0' && $data_awo['flag12']=='0'){
									echo "Sesuai";
								}else if($data_awo['flag2']>0){
									echo "Tidak Sesuai";
								}else if($data_awo['flag12']>0){
									echo "Hilang";
								}
						 	?>
						</td>
					</tr>
					<?php }?>
		<?php  $no++; 
				} 
			foreach ($data_mutasi->result_array() as $data_awo) { ?>
				<?php 
					if($data_awo['status_potong2']>0){
						$bg = 'style="background: #fffca8;"';
					}else{
						$bg='style="background: #ffa480;"';
					}
				?>
				<tr <?php echo $bg?>>
					<td><?php echo $data_awo['asal_sapi']; ?></td>
					<td><?php echo $data_awo['eartag']; ?></td>
					<td><?php echo $data_awo['shipment']; ?></td>
					<td><?php echo $data_awo['rfid']; ?></td>
					<td><?php echo $data_awo['session']; ?></td>
					<td><?php echo $data_awo['type_exit']; ?></td>
					<td><?php echo $data_awo['tanggal_kirim']; ?></td>
					<td><?php echo $data_awo['nota']; ?></td>
					<td><?php echo $data_awo['move_to']; ?></td>
					<td><?php echo $data_awo['tanggal_terima']; ?></td>
					<td><?php echo $data_awo['tanggal_kirim2']; ?></td>
					<td><?php echo $data_awo['customer']; ?></td>
					<td><?php echo $data_awo['tanggal_terima2']; ?></td>
					<td><?php if($data_awo['status_potong2']>0)
								{echo "Terpotong";}
							else{echo "Belum Dipotong";} 
						?>
					</td>
					<td><?php echo $data_awo['tanggal_potong']; ?></td>
					<td><?php echo $data_awo['jam_potong']; ?></td>
					<td><?php echo $data_awo['exporter']; ?></td>
					<td><?php echo $data_awo['move_to2']; ?></td>
					<td>
						<?php 
							if($data_awo['flag2']=='0' && $data_awo['flag12']=='0'){
								echo "Sesuai";
							}else if($data_awo['flag2']>0){
								echo "Tidak Sesuai";
							}else if($data_awo['flag12']>0){
								echo "Hilang";
							}
						?>
					</td>
				</tr>
		<?php  $no++; 
			}?>

			<?php }else{ 
			if($countdata_mutasi->count1 == 0){
				foreach ($data_mutasi1->result_array() as $data_awo) { ?>
							<?php 
								if($data_awo['status_potong2']>0){
									$bg = 'style="background: #fffca8;"';
									// $bg = 'style="background: #87fff4;"';
								}else{
									$bg='style="background: #ffa480;"';
								}
							?>
							<tr <?php echo $bg?>>
								<td><?php echo $data_awo['asal_sapi']; ?></td>
								<td><?php echo $data_awo['eartag']; ?></td>
								<td><?php echo $data_awo['shipment']; ?></td>
								<td><?php echo $data_awo['rfid']; ?></td>
								<td><?php echo $data_awo['session']; ?></td>
								<td><?php echo $data_awo['type_exit']; ?></td>
								<td><?php echo $data_awo['tanggal_kirim']; ?></td>
								<td><?php echo $data_awo['nota']; ?></td>
								<td></td>
								<td></td>
								<td></td>
								<td><?php echo $data_awo['customer']; ?></td>
								<td><?php echo $data_awo['tanggal_terima2']; ?></td>
								<td><?php if($data_awo['status_potong2']>0)
											{echo "Terpotong";}
										else{echo "Belum Dipotong";} 
									?>
								</td>
								<td><?php echo $data_awo['tanggal_potong']; ?></td>
								<td><?php echo $data_awo['jam_potong']; ?></td>
								<td><?php echo $data_awo['exporter']; ?></td>
								<td><?php echo $data_awo['move_to2']; ?></td>
								<td>
									<?php 
										if($data_awo['flag2']=='0' && $data_awo['flag12']=='0'){
											echo "Sesuai";
										}else if($data_awo['flag2']>0){
											echo "Tidak Sesuai";
										}else if($data_awo['flag12']>0){
											echo "Hilang";
										}
									?>
								</td>
							</tr>
						
				<?php  $no++; 
					} 
				}else{
					foreach ($data_mutasi->result_array() as $data_awo) { ?>
						<?php 
							if($data_awo['status_potong2']>0){
								$bg = 'style="background: #fffca8;"';
								// $bg = 'style="background: #87fff4;"';
							}else{
								$bg='style="background: #ffa480;"';
							}
						?>
						<tr <?php echo $bg?>>
							<td><?php echo $data_awo['asal_sapi']; ?></td>
							<td><?php echo $data_awo['eartag']; ?></td>
							<td><?php echo $data_awo['shipment']; ?></td>
							<td><?php echo $data_awo['rfid']; ?></td>
							<td><?php echo $data_awo['session']; ?></td>
							<td><?php echo $data_awo['type_exit']; ?></td>
							<td><?php echo $data_awo['tanggal_kirim']; ?></td>
							<td><?php echo $data_awo['nota']; ?></td>
							<td><?php echo $data_awo['move_to']; ?></td>
							<td><?php echo $data_awo['tanggal_terima']; ?></td>
							<td><?php echo $data_awo['tanggal_kirim2']; ?></td>
							<td><?php echo $data_awo['customer']; ?></td>
							<td><?php echo $data_awo['tanggal_terima2']; ?></td>
							<td><?php if($data_awo['status_potong2']>0)
										{echo "Terpotong";}
									else{echo "Belum Dipotong";} 
								?>
							</td>
							<td><?php echo $data_awo['tanggal_potong']; ?></td>
							<td><?php echo $data_awo['jam_potong']; ?></td>
							<td><?php echo $data_awo['exporter']; ?></td>
							<td><?php echo $data_awo['move_to2']; ?></td>
							<td>
								<?php 
									if($data_awo['flag2']=='0' && $data_awo['flag12']=='0'){
										echo "Sesuai";
									}else if($data_awo['flag2']>0){
										echo "Tidak Sesuai";
									}else if($data_awo['flag12']>0){
										echo "Hilang";
									}
								?>
							</td>
						</tr>
					
				<?php  $no++; 
					} 
				 }
				}?>

	<?php   
		} 
	?>
						</tbody>
					</table>
		</div>
	</div>
</div>



 <div  class="modal fade" id="ModalMap" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Koordinat AWO ABSEN</h4>
            </div>
            <form style="margin-bottom:0;" action="<?php echo base_url(); ?>penerimaan_sapi/save_terima" method="post"/>
            	<input id="id_pengiriman" type="hidden" name="id_pengiriman" >
            	<div class="modal-body" style="height: 350px;overflow-y: scroll;">					

            		<div id="data_map"></div>
			
				</div>

	
		   
        </div>
    </div>
</div>
