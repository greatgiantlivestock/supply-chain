<div class="col-md-12">
	<div class="page-header">
		<h1>
			<i class="fa fa-list-alt"></i>
			<?php echo $judul; ?>
		</h1>
	</div><!-- /.page-header -->

	<div style="margin-bottom:20px;margin-top:40px;" class="row">
		<form class="form-horizontal" action="<?php echo base_url(); ?>laporan_data_sapi/lihat_stok_sapi" method="post"/>
		<div class="col-sm-6">
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
					<tr>
						<td>
							Customer
						</td>
						<td>
							<select style="width:100%;" name="customer" class="form-control">
								<?php echo $combo_customer; ?>
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


	          		<p style="margin-bottom: 0;">LAPORAN STOK SAPI <b>(<?php echo $nama_rph; ?>)</b> </p>
	          		<p style="font-weight:bold;margin-bottom: 0;">PER TANGGAL : <?php echo $tanggal1.' s/d '.$tanggal2; ?></p>
	          		<p style="font-weight:bold;">ASAL SAPI : <?php if(!empty($asal_sapi)) { echo $asal_sapi; } else { echo 'SEMUA'; } ?></p>
					<table id="tblExport" class="table table-striped table-bordered table-hover">
						<thead>
							<tr>
								<th style="background: #22313F;color:#fff;width:30px;">No Transaksi</th>
								<th style="background: #22313F;color:#fff;">Customer</th>
								<th style="background: #22313F;color:#fff;">Asal Sapi</th>
								<th style="background: #22313F;color:#fff;">Dikirim Dari</th>
								<th style="background: #22313F;color:#fff;">Tujuan</th>
								<th style="background: #22313F;color:#fff;">Nota</th>
								<th style="background: #22313F;color:#fff;">Status Terima</th>
								<th style="background: #22313F;color:#fff;">Tanggal Terima</th>
								<th style="background: #22313F;color:#fff;">Umur</th>
								<th style="background: #22313F;color:#fff;">Status Potong</th>
								<th style="background: #22313F;color:#fff;">Status Mutasi</th>
								<th style="background: #22313F;color:#fff;">Qty</th>
								<th style="background: #22313F;color:#fff;">Action</th>
							</tr>
						</thead>

						<tbody>
			<?php
					if($stok_sapi != null) {
						$no = 1;
						$total = 0;
						$tgl_now = date('Y-m-d');
						foreach($stok_sapi->result_array() as $data) { 
							if($data['status_potong']<1 AND $data['intransit']<1){
								$total += $data['jml'];
							}						
							$start_date = new DateTime($data['tanggal_terima']);
							$end_date = new DateTime($tgl_now);
							$interval = $start_date->diff($end_date);
							if($data['status_terima']==0){
								// $style_ = 'style="background: #f0ea4a;"';
								$style_ = 'style="background: #ffffff;"';
							}else{
								if($data['intransit']==1){
									// $style_ = 'style="background: #f0ae4a;"';
									$style_ = 'style="background: #ffffff;"';
								}else if($data['intransit']==0){
									if($data['status_potong']==0){
										$style_ = 'style="background: #4af0a3;"';
									}else if($data['status_potong']>=1){
										$style_ = 'style="background: #c94000;"';
									}
								}else{
									$style_ = '';
								}
							}?>
								<tr <?php echo $style_;?>>
									<td><?php echo $data['id_pengiriman']; ?></td>
									<td><?php echo $data['customer']; ?></td>
									<td><?php echo $data['asal_sapi']; ?></td>
									<td><?php echo $data['move_from']; ?></td>
									<td><?php echo $data['move_to']; ?></td>
									<td><?php echo $data['nota']; ?></td>
									<td>
										<?php 
											if($data['status_terima']==0){
												echo "Belum Diterima";
											}else{
												echo "Diterima";
											} 
										?>
									</td>
									<td>
										<?php
											if($data['status_terima']==1){
												echo $data['tanggal_terima']; 
											} 
										?>
									</td>
									<td>
										<?php
											if($data['status_terima']==1){ 
												echo $interval->days." hari"; 
											}
										?>
									</td>
									<td>
										<?php 
											if($data['status_terima']==1){
												if($data['intransit']==0){
													if($data['status_potong']==0){
														echo "Belum Dipotong";
													}else{
														echo "Sudah Dipotong";
													}
												}else{}
											}
										?>
									</td>
									<td>
										<?php 
											if($data['status_terima']==1){
												if($data['intransit']==0){
													echo "Tidak dimutasi";
												}else{
													echo "Dimutasi";
												}
											} 
										?>
									</td>
									<td><?php echo $data['jml']; ?></td>
									<td>
										<a style="border-radius:25px;" id="detail_stok" class="label label-primary" href="" data-id_pengiriman="<?php echo $data['id_pengiriman']; ?>" 
											data-status_terima="<?php echo $data['status_terima']; ?>" data-status_potong="<?php echo $data['status_potong']; ?>" 
											data-intransit="<?php echo $data['intransit']; ?>" data-toggle="modal">
											<span class="fa fa-list-alt"> </span> Detail
										</a>
									</td>
								</tr>
			<?php 		$no++; } 
					 ?>
						</tbody>
						<tfoot>
								<tr style="background: #4af0a3;">
									<td colspan="11"><b>Tota Hidup</b></td>
									<td><b><?php echo $total; ?></b></td>
									<td ></td>
								</tr>
						</tfoot>
			<?php } ?>
					</table>
		</div>
	</div>



	 <div  class="modal fade" id="ModalStok" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	    <div class="modal-dialog">
	        <div class="modal-content">
	            <div class="modal-header">
	                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	                <h4 class="modal-title" id="myModalLabel">Data Sapi</h4>
	            </div>
	            <form style="margin-bottom:0;" action="<?php echo base_url(); ?>penerimaan_sapi/save_terima" method="post"/>
	            	<input id="id_pengiriman" type="hidden" name="id_pengiriman" >
	            	<div class="modal-body" style="height: 350px;overflow-y: scroll;">					
	            		
	            		<div id="data_stok"></div>
				
					</div>


				</form>
			   
	        </div>
	    </div>
	</div>
</div>