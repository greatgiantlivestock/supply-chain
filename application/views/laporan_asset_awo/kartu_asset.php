<div class="col-md-12">					    
	<div class="page-header">
		<h1>
			<i class="fa fa-list-alt"></i>
			<?php echo $judul; ?>
		</h1>
	</div><!-- /.page-header -->

	<div style="margin-bottom:20px;margin-top:40px;" class="row">
		<form class="form-horizontal" action="<?php echo base_url(); ?>laporan_asset_awo/lihat_kartu_asset" method="post"/>
			<div class="col-sm-6">
				<table>
					<tr>
						<td style="width: 120px;">
							Tanggal
						</td>
						<td style="width: 320px;">
							<div class="input-group">
								<span class="input-group-addon">
									<i class="fa fa-calendar bigger-110"></i>
								</span>
								<input  id="tgl" class="form-control " type="text" name="tanggal" value="<?php echo $tanggal; ?>" required>
							</div>
						</td>					
					</tr>			
				</table>
			</div>
			<div style="margin-top:15px;" class="col-md-12">
				<button class="btn btn-danger btn-sm" name="cari_report"><i class="fa fa-external-link"> </i> Lihat Report</button>
			<hr/>
			</div>
		</form>
	</div>

	<div class="row">
		<div class="col-md-12">

	 				<center>
	          			<a style="margin-bottom:20px;" class="btn btn-primary btn-sm" onclick="exportKartuAwo('xls');" href="javascript://"><span class="glyphicon glyphicon-export"> </span> Export to Excell</a>
	          		</center>
	          		
	          		<p style="margin-bottom: 0;">KARTU ASSET </p>
	          		<p style="font-weight:bold;">PER TANGGAL : <?php echo $tanggal; ?></p>
					<table class="table table-striped table-bordered table-hover">
						<thead>
							<tr>
								<th style="background: #22313F;color:#fff;width:50px;">No</th>
								<th style="background: #22313F;color:#fff;">Jenis/Nama Barang</th>
								<th style="background: #22313F;color:#fff;">Merk/Model</th>
								<th style="background: #22313F;color:#fff;">Jumlah</th>
								<th style="background: #22313F;color:#fff;">Identitas Barang</th>
								<th style="background: #22313F;color:#fff;">AWO</th>
								<th style="background: #22313F;color:#fff;">Keadaan Barang</th>
								<th style="background: #22313F;color:#fff;">RPH</th>
								<th style="background: #22313F;color:#fff;">Keterangan</th>
							</tr>
						</thead>

						<tbody>
	<?php 
		if(!empty($kartu_asset)) {
		$no = 1;
		foreach($kartu_asset->result_array() as $data) {  ?>
							<tr>
								<td><?php echo $no; ?></td>
								<td><?php echo $data['nama_barang']; ?></td>
								<td><?php echo $data['merk']; ?></td>
								<td><center><?php echo $data['jumlah_barang']; ?></center></td>
								<td><?php echo $data['identitas']; ?></td>
								<td><?php echo $data['nama_awo']; ?></td>
								<td><?php echo $data['keadaan_barang']; ?></td>
								<td><?php echo $data['nama_rph']; ?></td>
								<td><?php echo $data['keterangan']; ?></td>
							</tr>
	<?php $no++; } 
		} 
	?>
						</tbody>
					</table>
		</div>
	</div>
</div>