<div class="col-md-12">	
	<div class="page-header">
		<h1>
			<i class="fa fa-list-alt"></i>
			<?php echo $judul; ?>
		</h1>
	</div><!-- /.page-header -->

	<div style="margin-bottom:20px;margin-top:40px;" class="row">
		<form class="form-horizontal" action="<?php echo base_url(); ?>laporan_asset_rph/lihat_kondisi_asset" method="post"/>
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
							<select style="width:250px;" name="nama_rph" class="select_rph">
								<?php echo $combo_rph; ?>
							</select>
						</td>					
					</tr>			
				</table>
			</div>
			<div class="col-sm-6">
				<table class="tbl_input">
					<tr>
						<td style="width: 100px;">
							Kondisi Barang
						</td>
						<td>
							<div class="radio">
								<label>
									<input name="keadaan_barang" type="radio" class="ace" value="all" checked>
									<span class="lbl"> All</span>
								</label>

								<label>
									<input name="keadaan_barang" type="radio" class="ace" value="Baik" <?php echo $checkeda; ?>>
									<span class="lbl"> Baik</span>
								</label>

								<label>
									<input name="keadaan_barang" type="radio" class="ace" value="Rusak" <?php echo $checkedc; ?>>
									<span class="lbl"> Rusak</span>
								</label>
							</div>
						</td>
					</tr>
					<tr>
						<td>
							Nama Barang
						</td>
						<td>
							<select style="width:350px;" name="nama_barang" class="select_barang">
								<?php echo $combo_barang; ?>
							</select>
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
		<div class="col-xs-12">

	 				<center>
	          			<a style="margin-bottom:20px;" class="btn btn-primary btn-sm" onclick="exportKondisiRph('xls');" href="javascript://"><span class="glyphicon glyphicon-export"> </span> Export to Excell</a>
	          		</center>

	          		<p style="margin-bottom: 0;">LAPORAN KONDISI ASSET </p>
	          		<p style="font-weight:bold;">PER TANGGAL : <?php echo $tanggal1.' s/d '.$tanggal2; ?></p>
					<table class="table table-striped table-bordered table-hover">
						<thead>
							<tr>
								<th style="background: #22313F;color:#fff;width:50px;">No</th>
								<th style="background: #22313F;color:#fff;">Tanggal</th>
								<th style="background: #22313F;color:#fff;">Jenis/Nama Barang</th>
								<th style="background: #22313F;color:#fff;">Merk/Model</th>
								<th style="background: #22313F;color:#fff;">Identitas Barang</th>
								<th style="background: #22313F;color:#fff;">Keadaan Barang</th>
								<th style="background: #22313F;color:#fff;">RPH</th>
								<th style="background: #22313F;color:#fff;">Keterangan</th>
							</tr>
						</thead>

						<tbody>
	<?php 
		if(!empty($kondisi_asset)) {
		$no = 1;
		foreach($kondisi_asset->result_array() as $data) {  ?>
							<tr>
								<td><?php echo $no; ?></td>
								<td><?php echo $data['tanggal']; ?></td>
								<td><?php echo $data['nama_barang']; ?></td>
								<td><?php echo $data['merk']; ?></td>
								<td><?php echo $data['identitas']; ?></td>
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