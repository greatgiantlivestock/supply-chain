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
				<form action="<?php echo base_url(); ?>barang/save_jenis" method="post"/>
					<input type="hidden" name="tipe" value="<?php echo $tipe; ?>">
					<input type="hidden" name="id_jenis_barang" value="<?php echo $id_jenis_barang; ?>">

					<div class="form-group">
						<label >Jenis/Nama Barang</label>
						<div>
							<input style="width:50%;" class="form-control" type="text" name="nama_barang" value="<?php echo $nama_barang; ?>" required/>
						</div>
					</div>


					<div class="form-group">
						<label >Merk/Model</label>
						<div>
							<input style="width:50%;"  class="form-control" type="text" name="merk" value="<?php echo $merk; ?>" required/>
						</div>
					</div>


					<div class="form-actions">
						<button class="btn btn-info">
							<i class="icon-save bigger-110"></i>
							Simpan
						</button>
						&nbsp; &nbsp; &nbsp;
						<a class="btn" href="<?php echo base_url(); ?>barang/jenis">
							<i class="icon-undo bigger-110"></i>
							Batal
						</a>
					</div>	
				</form>
			</div>
		</div>
	</div>
</div>