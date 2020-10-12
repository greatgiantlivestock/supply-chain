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
<?php if($this->session->flashdata('error')) { ?>
                    <div class="alert alert-danger alert-dismissible fade in" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                      <?php echo $this->session->flashdata('error'); ?>
                    </div> 
 <?php } ?>
				<form action="<?php echo base_url(); ?>perawatan_asset/save" method="post"/>
					<input type="hidden" name="tipe" value="<?php echo $tipe; ?>">
					<input type="hidden" name="id_perawatan" value="<?php echo $id_perawatan; ?>">
					

					<div class="form-group">
						<label >Barang</label>
						<div>
							<select style="width:50%;"  class="select2" name="id_barang" required/>
								<?php echo $combo_barang; ?>
							</select>
						</div>
					</div>

					<div class="form-group">
						<label >Tanggal Rusak</label>
						<input id="tgl" style="width:30%;" class="form-control" name="tanggal_rusak" value="<?php echo $tanggal_rusak; ?>" required/>
					</div>

		
					<div class="form-group">
						<label >Keterangan</label>
						<input style="width:50%;" class="form-control" name="keterangan"/>
					</div>


					<div class="form-actions">
						<button class="btn btn-info">
							<i class="icon-save bigger-110"></i>
							Simpan
						</button>
						&nbsp; &nbsp; &nbsp;
						<a class="btn" href="<?php echo base_url(); ?>perawatan_asset">
							<i class="icon-undo bigger-110"></i>
							Batal
						</a>
					</div>	
				</form>
			</div>
		</div>
	</div>
</div>