<div class="col-md-12">					    
	<div class="widget-box">
		<div class="widget-header header-color-red">
			<h5 class="bigger lighter">
				<i class="fa fa-table"></i>
				<?php echo $judul; ?>
			</h5>
		</div>
		<div class="widget-body">
			<div class="widget-main">
				<div class="row" style="margin-bottom: 20px;">

					<div class="col-md-6">
						<form action="<?php echo base_url(); ?>laporan_data_sapi/lihat_traceability" method="post" enctype="multipart/form-data">
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
								<input  id="tgl" class="form-control " type="text" name="tanggal_awal" value="<?php echo $tanggal_awal; ?>" required>
							</div>
						</td>
						<td style="width: 30px;"><center>s/d</center></td>
						<td>
							<div class="input-group">
								<span class="input-group-addon">
									<i class="fa fa-calendar bigger-110"></i>
								</span>
								<input  id="tgl2" class="form-control " type="text" name="tanggal_akhir" value="<?php echo $tanggal_akhir; ?>" required>
							</div>
						</td>
					</tr>	
					<tr>
						<td>
							RPH
						</td>
						<td>
							<select style="width:100%;" name="id_rph" class="form-control">
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
					<div style="margin-top:15px;" class="col-md-12">
						<button style="border-radius:25px;" class="btn btn-danger btn-sm" name="cari_report"><i class="fa fa-external-link"> </i> Lihat Report</button>
					<hr/>
					</div>
						</form>
					</div>
				</div>
					<center>
	          			<a style="margin-bottom:20px;border-radius:25px;" class="btn btn-primary btn-sm" onclick="exportTraceability('xls');" href="javascript://"><span class="glyphicon glyphicon-export"> </span> Export to CSV</a>
	          		</center>

	          		<p style="margin-bottom: 0;">LAPORAN TRACEABILITY SAPI <b>(<?php echo $nama_rph; ?>)</b></p>
	          		<p style="font-weight:bold;margin-bottom: 0;">PER TANGGAL : <?php echo $tanggal_awal.' s/d '.$tanggal_akhir; ?></p>
	          		<p style="font-weight:bold;">ASAL SAPI : <?php if(!empty($asal_sapi)) { echo $asal_sapi; } else { echo 'SEMUA'; } ?></p>
 		
						<table class="table table-bordered table-striped">
							<thead>
								<tr>
									<th style="background: #22313F;color:#fff;">Asal Sapi</th>
									<th style="background: #22313F;color:#fff;">RPH</th>
									<th style="background: #22313F;color:#fff;">RFID</th>
									<th style="background: #22313F;color:#fff;">Tangggal Potong</th>
									<th style="background: #22313F;color:#fff;">Jam Potong</th>
									<th style="background: #22313F;color:#fff;">Status RFID</th>
								</tr>
							</thead>
							<tbody>
								<?php
								if($traceability != null) {
								$no = 1;
									foreach($traceability->result_array() as $data) { 
									?>
													<tr>
														<td><?php echo $data['asal_sapi']; ?></td>
														<td><?php echo $data['move_to']; ?></td>
														<td><?php echo $data['rfid']; ?></td>
														<td><?php 
																$ex_tanggal = explode("-", $data['tanggal_potong']);
																echo $ex_tanggal[1]."/".$ex_tanggal[2]."/".$ex_tanggal[0];
															?>										
														</td>
														<td><?php echo date('H:i', strtotime($data['jam_potong'])); ?></td>
														<td><?php echo "Sesuai"; ?></td>
													</tr>
								<?php 	
									$no++; 
									} 
								} ?>							
							</tbody>
							<!-- <thead>
								<tr>
									<th colspan="4">Data Tacebility yang RFID nya Tidak Sesuai</th>
								</tr>
							</thead> -->
							<tbody>
								<?php
								if($traceabilityAll != null) {
								$no = 1;
									foreach($traceabilityAll->result_array() as $data) { 
									?>
													<tr>
														<td><?php echo $data['asal_sapi']; ?></td>
														<td><?php echo $data['move_to']; ?></td>
														<td><?php echo $data['rfid']; ?></td>
														<td><?php 
																$ex_tanggal = explode("-", $data['tanggal_potong']);
																echo $ex_tanggal[1]."/".$ex_tanggal[2]."/".$ex_tanggal[0];
															?>										
														</td>
														<td><?php echo date('H:i', strtotime($data['jam_potong'])); ?></td>
														<td><?php echo "Tidak Sesuai"; ?></td>
													</tr>
								<?php 	
									$no++; 
									} 
								} ?>							
							</tbody>
							<!-- <thead>
								<tr>
									<th colspan="4">Data Tacebility yang RFID nya Hilang</th>
								</tr>
							</thead> -->
							<tbody>
								<?php
								if($traceabilityAll1 != null) {
								$no = 1;
									foreach($traceabilityAll1->result_array() as $data) { 
									?>
													<tr>
														<td><?php echo $data['asal_sapi']; ?></td>
														<td><?php echo $data['move_to']; ?></td>
														<td><?php echo $data['rfid']; ?></td>
														<td><?php 
																$ex_tanggal = explode("-", $data['tanggal_potong']);
																echo $ex_tanggal[1]."/".$ex_tanggal[2]."/".$ex_tanggal[0];
															?>										
														</td>
														<td><?php echo date('H:i', strtotime($data['jam_potong'])); ?></td>
														<td><?php echo "Hilang"; ?></td>
													</tr>
								<?php 	
									$no++; 
									} 
								} ?>							
							</tbody>
						</table>

						<!-- <p style="margin-bottom: 0;">Data Tacebility yang RFID nya Hilang</b></p>
						<table class="table table-bordered table-striped">
							<thead>
								<tr>
									<th style="background: #22313F;color:#fff;" >RFID</th>
									<th style="background: #22313F;color:#fff;">Tangggal Potong</th>
									<th style="background: #22313F;color:#fff;">Jam Potong</th>
									<th style="background: #22313F;color:#fff;">Status RFID</th>
								</tr>
							</thead>
							<tbody>
								<?php
								if($traceabilityAll1 != null) {
								$no = 1;
									foreach($traceabilityAll1->result_array() as $data) { 
									?>
													<tr>
														<td><?php echo $data['rfid']; ?></td>
														<td><?php 
																$ex_tanggal = explode("-", $data['tanggal_potong']);
																echo $ex_tanggal[1]."/".$ex_tanggal[2]."/".$ex_tanggal[0];
															?>										
														</td>
														<td><?php echo date('H:i', strtotime($data['jam_potong'])); ?></td>
														<td><?php echo "Hilang"; ?></td>
													</tr>
								<?php 	
									$no++; 
									} 
								} ?>							
							</tbody>
						</table> -->
				</div>
			</div>
		</div>
	</div>
</div>
