<script>
	$(document).ready(function(){
		var jenis='<?php echo $jenis_rph;?>'
		if(jenis=='Depot'){
			div_jenis.style.display = 'none'
		}else if(jenis=='Belum Didefinisikan'){
			div_jenis.style.display = 'none'
		}
	});
	function changeJenisPotong(val){
		if(val.value=='Depot'){
			div_jenis.style.display = 'none'
		}else if(val.value=='RPH'){
			div_jenis.style.display = 'inline'
		}
	}
</script>
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
				<form class="form-horizontal"  action="<?php echo base_url(); ?>rph/save" method="post"/>
					<input type="hidden" name="tipe" value="<?php echo $tipe; ?>">
					<input type="hidden" name="id_rph" value="<?php echo $id_rph; ?>">

					<div class="control-group">
						<label class="control-label" >Nama RPH</label>
						<div class="controls">
							<input style="width:50%;" type="text" name="nama_rph" value="<?php echo $nama_rph; ?>"/>
						</div>
					</div>


					<div class="control-group">
						<label class="control-label" >Kota</label>
						<div class="controls">
							<input style="width:50%;" type="text" name="kota" value="<?php echo $kota; ?>"/>
						</div>
					</div>


					<div class="control-group">
						<label class="control-label" >Alamat</label>
						<div class="controls">
							<textarea style="width:50%;" name="alamat"><?php echo $alamat; ?></textarea>
						</div>
					</div>

					<div class="control-group">
						<label class="control-label" >Koordinat</label>
						<div class="controls">
							<input style="width:50%;" type="text" name="koordinat" value="<?php echo $koordinat; ?>"/>
						</div>
					</div>

					<div class="control-group">
						<label class="control-label" >Pilih Jenis</label>
						<div class="controls">
							<select id="id_jenis" required onChange="changeJenisPotong(this);" style="width: 40%;" name="jenis_rph" >
								<option value="" <?php if($jenis_rph == 'Belum Didefinisikan') { echo 'selected'; } ?>>Pilih RPH atau Depot</option>
								<option value="RPH" <?php if($jenis_rph == 'RPH') { echo 'selected'; } ?>>RPH</option>
								<option value="Depot" <?php if($jenis_rph == 'Depot') { echo 'selected'; } ?>>Depot</option>
							</select>
						</div>
					</div>

					<div id="div_jenis" class="control-group">
						<label class="control-label" >Jenis Berat Potongan (Karkas/Prosot)</label>
						<div class="controls">
							<select style="width: 40%;" name="jenis_berat" >
								<option value="0" <?php if($jenis_berat == '0') { echo 'selected'; } ?>>Belum Ditentukan</option>
								<option value="1" <?php if($jenis_berat == '1') { echo 'selected'; } ?>>Karkas</option>
								<option value="2" <?php if($jenis_berat == '2') { echo 'selected'; } ?>>Prosot</option>
							</select>
						</div>
					</div>

					<div class="form-actions">
						<button style="border-radius:25px;" class="btn btn-info">
							<i class="icon-save bigger-110"></i>
							Simpan
						</button>
						&nbsp; &nbsp; &nbsp;
						<a style="border-radius:25px;" class="btn" href="<?php echo base_url(); ?>rph">
							<i class="icon-undo bigger-110"></i>
							Batal
						</a>
					</div>	
				</form>
			</div>
		</div>
	</div>
</div>