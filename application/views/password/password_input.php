<div class="span12">					    
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

 <?php if($this->session->flashdata('success')) { ?>
                    <div class="alert alert-success alert-dismissible fade in" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                      <?php echo $this->session->flashdata('success'); ?>
                    </div> 
 <?php } ?>
				<form class="form-horizontal"  action="<?php echo base_url(); ?>password/save" method="post"/>
					<input type="hidden" name="id" value="<?php echo $id; ?>">

					<div class="control-group">
						<label class="control-label" >Ganti Password</label>

						<div class="controls">
							<input class="span4" type="text" placeholder="Ketikan Password Baru"  name="password" value="<?php echo $password; ?>"/>
						</div>
					</div>

					<div class="form-actions">
						<button style="border-radius:25px;" class="btn btn-info">
							<i class="icon-save bigger-110"></i>
							Simpan
						</button>

						&nbsp; &nbsp; &nbsp;
						<button style="border-radius:25px;" class="btn" type="reset">
							<i class="icon-undo bigger-110"></i>
							Reset
						</button>
					</div>	


				</form>
			</div>
		</div>
	</div>
</div>