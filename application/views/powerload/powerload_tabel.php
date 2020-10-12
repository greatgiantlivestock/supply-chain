<div class="col-md-12">					    
	<div class="widget-box">
		<div class="widget-header header-color-blue">
			<h5 class="bigger lighter">
				<i class="fa fa-table"></i>
				<b><?php echo $judul; ?></b>
			</h5>
		</div>
		<div class="widget-body">
			<div class="widget-main">
				<form action="<?php echo base_url(); ?>powerload/save" method="post">
					<input type="hidden" name="tipe" value="<?php echo $tipe; ?>">
					<input type="hidden" name="id_powerload" value="<?php echo $id_powerload; ?>">
					<div class="row">
						<div class="col-md-6">
							<div style="margin-bottom:10px;" class="form-gorup">
								<label>Tanggal</label>
								<input style="<?php echo $color; ?>" id="tgl" class="form-control" type="text" placeholder="tanggal kirim" name="tanggal" required value="<?php echo $tanggal; ?>">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-gorup">
            			<label>Power Load</label>
            			<div class="row">
	            			<div class="col-xs-3">
	            				<input id="merah" style="margin-bottom: 10px;<?php echo $color; ?>" class="form-control" name="merah" placeholder="merah" value="<?php echo $merah; ?>">
	            			</div>
	            			<div class="col-xs-3">
	            				<input id="orange"  style="margin-bottom: 10px;<?php echo $color; ?>" class="form-control" name="orange" placeholder="orange" value="<?php echo $orange; ?>">
	            			</div>
	            			<div class="col-xs-3">
	            				<input id="hitam"  style="margin-bottom: 10px;<?php echo $color; ?>" class="form-control" name="hitam" placeholder="hitam" value="<?php echo $hitam; ?>">
	            			</div>
	            			<div class="col-xs-3">
	            				<input id="kuning"  style="margin-bottom: 10px;<?php echo $color; ?>" class="form-control" name="kuning" placeholder="kuning" value="<?php echo $kuning; ?>">
	            			</div>
	            		</div>
            		</div>
						</div>
					</div>

					<hr/ style="margin-top: 15px; margin-bottom: 10px;">
					<div class="row">
						<div class="col-md-6">
							<button  style="border-radius:25px;" class="btn btn-primary btn-sm"><i class="fa fa-refresh"> </i> <?php echo $name_button; ?></button>
							<a style="border-radius:25px;" style="margin-left:40px;" class="btn btn-danger btn-sm" href="<?php echo base_url().'powerload'; ?>" <?php echo $disabled; ?>><i class="fa fa-trash"> </i> Batal</a>
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
				<table id="dttble6" class="table table-bordered">
					<thead>
						<tr>
							<th>No.</th>
							<th>Tanggal</th>							
							<th>Merah</th>
							<th>Orange</th>							
							<th>Hitam</th>
							<th>Kuning</th>
							<th>Total</th>
							<th>Ke RPH</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
		<?php
			if($powerload != "") { 
				$no = 1;
				foreach($powerload->result_array() as $data) { 
		?> 
						<tr>
							<td><?php echo $no; ?></td>
							<td><?php echo $data['tanggal']; ?></td>
							<td><?php echo $data['merah']; ?></td>
							<td><?php echo $data['orange']; ?></td>							
							<td><?php echo $data['hitam']; ?></td>
							<td><?php echo $data['kuning']; ?></td>
							<td><?php echo $data['merah']+$data['orange']+$data['hitam']+$data['kuning']; ?></td>
							<td><b><?php echo $data['nama_rph']; ?></b></td>
							<td style="text-align:center;">
								<a id="penerimaan_sapi" class="label label-primary" href="<?php echo base_url().'powerload/edit/'.$data['id_powerload']; ?>" ><span class="fa fa-edit"> </span> Edit</a>
								<a id="penerimaan_sapi" class="label label-warning" href="<?php echo base_url().'powerload/hapus/'.$data['id_powerload']; ?>" onclick="return confirm('Yakin ingin hapus data ?');"><span class="fa fa-trash"> </span> Hapus</a>
							</td>
						</tr>
		<?php 	
			$no++;  } } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

