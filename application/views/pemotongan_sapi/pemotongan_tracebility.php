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
						<form action="<?php echo base_url(); ?>pemotongan_sapi/upload_potong" method="post" enctype="multipart/form-data">
							<table style="border: 1px solid #ccc;">
								<tr>
									<td colspan="2" style="width: 120px;padding: 15px 0 15px 10px;">Upload CSV</td>
								</tr>
								<tr>
									<td style="width: 120px;padding: 15px 0 15px 10px;"><input style="width: 180px;" type="file" name="file_upload" required></td>
									<td style="padding: 15px 10px 15px 0"><button style="border-radius:25px;" class="btn btn-danger btn-sm"><i class="fa fa-upload"> </i> Upload CSV</button>
								</tr>
							</table>	
						</form> 
					</div>
					<div class="col-md-6">
						<form action="<?php echo base_url(); ?>pemotongan_sapi/lihat_traceability" method="post" enctype="multipart/form-data">
							<table>
								<tr>
									<td style="width: 120px;padding: 15px 0 15px 10px;">Tgl.Awal</td>
									<td><input style="width: 150px;" id="tgl" type="text" name="tanggal_awal" class="form-control" value="<?php echo $tanggal_awal; ?>" required></td>
								</tr>
								<tr>
									<td style="width: 120px;padding: 15px 0 15px 10px;">Tgl.Akhir</td>
									<td><input style="width: 150px;" id="tgl2" type="text" name="tanggal_akhir" class="form-control" value="<?php echo $tanggal_akhir; ?>" required></td>
								</tr>
								<tr>
									<td colspan="2" style="padding: 15px 10px 15px 0;"><button style="margin-left: 10px;border-radius:25px;" class="btn btn-primary btn-sm">Filter</button></td>
								</tr>
							</table>	
						</form>
					</div>
				</div>
<?php if($this->session->flashdata('success')) { ?>
                    <div class="alert alert-success alert-dismissible fade in" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                      <?php echo $this->session->flashdata('success'); ?>
                    </div> 
 <?php } ?>
 <?php if($this->session->flashdata('error')) { ?>
                    <div class="alert alert-danger alert-dismissible fade in" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                      <?php echo $this->session->flashdata('error'); ?>
                    </div> 
 <?php } ?>
 			<!-- <ul style="margin-bottom:20px;" class="nav nav-tabs">
			  <li class="active"><a data-toggle="tab" href="#GGL">GGL</a></li>
			  <li><a data-toggle="tab" href="#NTF">NTF</a></li>
			  <li><a data-toggle="tab" href="#PO">PO</a></li>
			</ul> -->
				<!-- <div class="tab-content"> -->
				<div >
	  				<!-- <div id="GGL" class="tab-pane fade in active"> -->
	  				<div id="GGL">
						<table id="dttble4" class="table table-striped table-bordered table-hover">
							<thead>
								<tr>
									<th style="width:50px;">No</th>
									<th>Tanggal Masuk</th>
									<th>Nota</th>
									<th>RFID</th>
									<th>Berat</th>
									<th>Tangggal Potong</th>
									<th>Jam Potong</th>
								</tr>
							</thead>
							<tbody>
								<?php
									$no = 1;
									foreach($pemotongan_sapi_ggl->result_array() as $data) { 
										if($data['status_potong'] >= '1') {
											$bg = 'style="background:#edfce8;"';
											$potong = true;
										} else {
											$bg = 'style="background:#ffdddd;"';
											$potong = false;
										}
									?>
									<tr <?php echo $bg; ?>>
										<td><?php echo $no; ?></td>
										<td><?php echo $data['tanggal_terima']; ?></td>
										<td><?php echo $data['nota']; ?></td>
										<td><?php echo $data['rfid']; ?></td>
										<td><?php echo $data['berat']; ?></td>
										<td><?php 
												if(empty($data['tanggal_potong'])) {
													echo '-';
												} else {
													echo $data['tanggal_potong'];
												} 
											?>
										</td>
										<td><?php echo date('H:i', strtotime($data['jam_potong'])); ?></td>
									</tr>
								<?php 	$no++; } ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
 <div  class="modal fade" id="ModalPotong" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button style="border-radius:25px;" type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Data Penerimaan Sapi</h4>
            </div>
            <form style="margin-bottom:0;" action="<?php echo base_url(); ?>pemotongan_sapi/save_potong" method="post"/>
            	<input id="id_pengiriman_detail" type="hidden" name="id_pengiriman_detail" >
            	<div class="modal-body">					
            		<div class="form-gorup">
            			<label>Tanggal Potong</label>
            			<input style="width:50%;margin-bottom: 20px;" id="tgl" class="form-control" name="tanggal_potong" placeholder="Tanggal Potong ...">
            		</div>
            		<div class="form-group">
            			<label>Keterangan</label>
            			<input style="width:50%;" class="form-control" name="keterangan_potong">
            		</div>
				</div>
	            <div class="modal-footer">
			        <button style="border-radius:25px;" id="simpan_jual" class="btn btn-primary btn-sm"><i class="fa fa-save"> </i> Simpan</button>
			        <button style="border-radius:25px;" type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Batal</button>
			    </div>
			</form>
        </div>
    </div>
</div>