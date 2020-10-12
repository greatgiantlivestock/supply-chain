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
				<form action="<?php echo base_url(); ?>User/save" method="post">
					<input type="hidden" name="tipe" value="<?php echo $tipe; ?>">
					<input type="hidden" name="id_login" value="<?php echo $id_login; ?>">
					<div class="form-group">
						<label>Nama Karyawan</label>
						<select requeired style="width:60%;" class="form-control" name="id_awo">
								<?php echo $combo_karyawan; ?>
						</select>
					</div>
					<div class="form-group">
						<label >Username</label>
						<input style="width:60%;" class="form-control" type="text" requeired name="username" value="<?php echo $username; ?>"/>
					</div>
					<div class="form-group">
						<label >Password</label>
						<input style="width:60%;" class="form-control" type="password" requeired name="password" value="<?php echo $password; ?>">
					</div>
					<div class="form-group">
						<label>Login Role</label>
						<select requeired style="width:60%;" class="form-control" name="id_role">
								<?php echo $combo_role; ?>
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
						<a class="btn btn-small" href="<?php echo base_url(); ?>User">
							<i class="fa fa-undo bigger-110"></i>
							Batal
						</a>
					</div>	
				</form>
			</div>
		</div>
	</div>
</div>