<div class="col-md-12">					    
	<div class="widget-box">
		<div class="widget-header header-color-blue">
			<h5 class="bigger lighter">
				<i class="fa fa-table"></i>
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
				<form action="<?php echo base_url(); ?>awo/save" method="post">
					<input type="hidden" name="tipe" value="<?php echo $tipe; ?>">
					<input type="hidden" name="id_awo" value="<?php echo $id_awo; ?>">
					<div class="form-group">
						<label>Nama AWO</label>
						<input style="width:60%;" class="form-control" type="text" name="nama_awo" value="<?php echo $nama_awo; ?>"/>
					</div>
					<div class="form-group">
						<label >Telpon</label>
						<input style="width:60%;" class="form-control" type="text" name="telpon_awo" value="<?php echo $telpon_awo; ?>"/>
					</div>
					<div class="form-group">
						<label >Alamat</label>
						<input style="width:60%;" class="form-control" type="text" name="alamat" value="<?php echo $alamat; ?>"/>
					</div>
					<div class="form-group">
						<label>RPH</label>
						<select style="width:60%;" class="form-control" name="id_rph">
								<?php echo $combo_rph; ?>
						</select>
					</div>
					<div class="form-group">
						<label>Jenis Input</label>
						<select style="width:60%;" class="form-control" name="input_type">
								<option value='0' <?php if($input_type==0){echo "selected";}?>>Tidak Ada Akses Input</option>
								<option value='1' <?php if($input_type==1){echo "selected";}?>>Hanya Estimasi Potong</option>
								<option value='2' <?php if($input_type==2){echo "selected";}?>>Estimasi dan Hasil Potong</option>
						</select>
					</div>
					<!-- <div class="form-group">
						<label>Username</label>
						<input style="width:40%;" class="form-control" type="text" name="username" value="<?php echo $username; ?>"/>
					</div>
					<div class="form-group">
						<label>Password</label>
						<input style="width:40%;" class="form-control" type="password" name="password" value="<?php echo $password; ?>"/>
					</div>
					<div class="form-group">
						<label>MAC</label>
						<input style="width:40%;" class="form-control" type="text" name="mac" value="<?php echo $mac; ?>"/>
					</div> -->
					<div class="form-group">
						<button class="btn btn-info btn-small">
							<i class="fa fa-save bigger-110"></i>
							Simpan
						</button>
						&nbsp; &nbsp; &nbsp;
						<a class="btn btn-small" href="<?php echo base_url(); ?>awo">
							<i class="fa fa-undo bigger-110"></i>
							Batal
						</a>
					</div>	
				</form>
			</div>
		</div>
	</div>
</div>