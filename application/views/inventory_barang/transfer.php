<div class="col-md-12">					    
	<div class="widget-box">
		<div class="widget-header header-color-red">
			<h5 class="bigger lighter">
				<i class="fa fa-table"></i>
				<b><?php echo $judul; ?></b>
			</h5>
		</div>
		<div class="widget-body">
			<div class="widget-main">
				<?php if($this->session->flashdata('error')) { ?>
                    <div class="alert alert-danger alert-dismissible fade in" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                      <?php echo $this->session->flashdata('error'); ?>
                    </div> 
 				<?php } ?>
				<form action="<?php echo base_url(); ?>inventory_barang/save_transfer" method="post">
					<input type="hidden" name="tipe" value="<?php echo $tipe; ?>">
					<input type="hidden" name="id_transfer" value="<?php echo $id_transfer; ?>">
					<table class="tbl_input">
						<tr>
							<td style="width:70px;">
								Tanggal
							</td>
							<td style="width: 200px;">
								<input style="width:80%; <?php echo $color; ?>" id="tgl" class="form-control " type="text" placeholder="dd/mm/yyyy" name="tanggal_transfer" value="<?php echo $tanggal_transfer; ?>" required>		
							</td>							
							<td style="width:100px;">
								Kirim ke RPH
							</td>
							<td style="width: 200px;">
								<select style="width:80%; <?php echo $color; ?>" class="form-control" name="id_rph" required>
									<?php echo $combo_rph; ?>
								</select>		
							</td>
							<td style="width:80px;">
								Keterangan
							</td>
							<td>
								<input style="width: 80%;<?php echo $color; ?>" class="form-control " type="text" name="keterangan_transfer" value="<?php echo $keterangan_transfer; ?>">		
							</td>
						</tr>
									
					</table>

				<hr/ style="margin-top: 30px; margin-bottom: 10px;">
				<div class="row">
					<div class="col-md-8">
						<button  class="btn btn-primary btn-sm"><i class="fa fa-refresh"> </i> <?php echo $name_button; ?></button>
						<a style="margin-left:20px;" class="btn btn-danger btn-sm" href="<?php echo base_url().'inventory_barang/hapus/'.$id_transfer; ?>" <?php echo $disabled; ?>><i class="fa fa-trash"> </i> Hapus</a>
						<?php echo $btn_batal; ?>
					</div>
					<div class="col-md-4">
						<select style="width:60%;font-weight: bold;font-size: 1.2em;" id="pilih_transfer" class="select2" name="pilih_transfer">
							<?php echo $combo_transfer; ?>
						</select>
					</div>
				</div>
				<hr/ style="margin-top: 10px; margin-bottom: 30px;">


				</form>

<?php if($this->session->flashdata('success')) { ?>
                    <div class="alert alert-success alert-dismissible fade in" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                      <?php echo $this->session->flashdata('success'); ?>
                    </div> 
 <?php } ?>

 				<a style="margin-bottom: 20px;" class="btn btn-pink btn-sm" href="" data-toggle="modal" data-target="#modalBarang" <?php echo $disabled; ?>><i class="fa fa-plus"> </i> Tambah Barang</a>
				<table class="tbl_jual_detail">
							<thead>
								<tr>
									<th>Barang</th>	
									<th>Jenis</th>								
									<th>QTY</th>
								</tr> 
							</thead>

							<tbody>
	<?php
		if($transfer_detail != null) { 
			$no = 1;
			$total_barang = 0;
			foreach($transfer_detail->result_array() as $data) { 
				$total_barang += $data['qty']; ?>
									<tr>
										<td><?php echo $data['nama_barang']; ?></td>									
										<td><?php echo $data['merk']; ?></td>
										<td><?php echo $data['qty']; ?></td>
									</tr> 
		<?php 
			}
		 ?>
							</tbody>	
							<tfoot>
								<tr>
									<td></td>
									<td><strong>Total Jumlah Barang : </strong></td>
									<td><strong><?php echo $total_barang; ?></strong></td>
								</tr>
							</tfoot>	
		<?php } ?>					
						</table>
			</div>
		</div>
	</div>
</div>


 <div  class="modal fade" id="modalBarang" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Ubah Kondisi Barang</h4>
            </div>
            <form style="margin-bottom:0;" action="<?php echo base_url(); ?>inventory_barang/save_transfer_detail" method="post"/>
            	<input type="hidden" name="id_transfer" value="<?php echo $id_transfer; ?>">
            	<div class="modal-body">								

            		<div class="form-group">
            			<label> Barang </label>
            			<select style="width:250px;" name="id_barang" class="form-control" required>
							<?php echo $combo_barang; ?>
						</select>
            		</div>	

            		<div class="form-group">
            			<label> QTY </label>

            			<input style="width:20%;" class="form-control" id="qty" type="text" name="qty" required />
            		</div>	
						
			
				</div>


	            <div class="modal-footer">
			        <button id="simpan_jual" class="btn btn-primary btn-sm">Simpan</button>
			        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Batal</button>
			    </div>

			</form>
		   
        </div>
    </div>
</div>