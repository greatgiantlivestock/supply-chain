<div class="col-md-12">					    
	<div class="widget-box">
		<div class="widget-header header-color-blue">
			<h5 class="bigger lighter">
				<i class="icon-table"></i>
				<?php echo $judul; ?>
			</h5>
		</div>
		<div class="widget-body">
			<div class="widget-main">
				<div style="margin-bottom:20px;" class="row">
					<div style="text-align:right;" class="col-md-12">
						<a class="btn btn-sm btn-pink" href="<?php echo base_url();?>perawatan_asset/add"><span class="fa fa-plus"> </span> Tambah Data</a>
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
				<table id="sample-table-2" class="table table-striped table-bordered">
					<thead>
						<tr>
							<th style="width:50px;">No</th>
							<th>Nama barang</th>
							<th>Merk</th>
							<th>identitas</th>
							<th>Tgl.Rusak</th>
							<th>Tgl.Perbaiki</th>
							<th>Keterangan</th>
							<th>Action</th>
						</tr>
					</thead>

					<tbody>
<?php
		$no = 1;
		foreach($perawatan_asset->result_array() as $data) { 
				if($data['status'] == '0') {
					$bg = '#ffdddd';
				} else if($data['status'] == '1') {
					$bg = '#edfce8';
				}
			?>
						<tr style="background: <?php echo $bg; ?>">
							<td><?php echo $no; ?></td>
							<td><?php echo $data['nama_barang']; ?></td>
							<td><?php echo $data['merk']; ?></td>							
							<td><?php echo $data['identitas']; ?></td>
							<td><?php echo $data['tanggal_rusak']; ?></td>
							<td><center>
								<?php
									if(empty($data['tanggal_perbaiki']) || $data['tanggal_perbaiki'] == "0000-00-00") {
										echo '<a id="updateTanggal" class="" href="" data-id_perawatan="'.$data['id_perawatan'].'" data-toggle="modal"><i class="fa fa-calendar"> </i> Perbaiki</a>';
									} else {
										echo $data['tanggal_perbaiki']; 
									}
								?>
								</center>
							</td>
							<td><?php echo $data['keterangan']; ?></td>
							<td style="text-align:center;">
								<a class="btn btn-sm btn-primary" href="<?php echo base_url().'perawatan_asset/edit/'.$data['id_perawatan']; ?>"><span class="fa fa-edit"> </span></a>
								<a class="btn btn-sm btn-danger" href="<?php echo base_url().'perawatan_asset/hapus/'.$data['id_perawatan']; ?>" onclick="return confirm('Yakin ingin hapus data ?');"><span class="fa fa-trash"> </span></a>
							</td>
						</tr>
<?php 	$no++; } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>


 <div  class="modal fade" id="modalTanggal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Update Tanggal Perbaiki</h4>
            </div>
            <form style="margin-bottom:0;" action="<?php echo base_url(); ?>perawatan_asset/update_tanggal" method="post"/>
            	<div class="modal-body">					
            		<input id="id_perawatan" type="hidden" name="id_perawatan" readonly>			

            		<div class="form-group">
            			<label> Tanggal Perbaiki </label>

            			<input style="width:50%;" class="form-control" id="tgl2" type="text" name="tanggal_perbaiki" required/>
            		</div>	

            		<div class="form-group">
						<label >Keterangan</label>
						<input style="width:50%;" class="form-control" name="keterangan"/>
					</div>						
			
				</div>


	            <div class="modal-footer">
			        <button style="border-radius:25px;" class="btn btn-primary btn-sm">Simpan</button>
			        <button style="border-radius:25px;" type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Batal</button>
			    </div>

			</form>
		   
        </div>
    </div>
</div>