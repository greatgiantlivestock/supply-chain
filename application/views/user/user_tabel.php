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
				<div style="margin-bottom:20px;" class="row">
					<div style="text-align:right;" class="col-md-12">
						<a style="border-radius:25px;" class="btn btn-sm btn-pink" href="<?php echo base_url();?>User/add"><span class="fa fa-plus"> </span> Tambah Data</a>
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
				<table id="sample-table-2" class="table table-striped table-bordered table-hover">
					<thead>
						<tr>
							<th style="width:50px;">No</th>
							<th>Nama Karyawan</th>
							<th>Username</th>
							<th>Role</th>
							<th >Action</th>
						</tr>
					</thead>
					<tbody>
<?php
		$no = 1;
		foreach($awo->result_array() as $data) { ?>
						<tr>
							<td><?php echo $no; ?></td>
							<td><?php echo $data['nama']; ?></td>
							<td><?php echo $data['username']; ?></td>
							<td><?php echo $data['nama_role']; ?></td>
							<td style="text-align:center;">
								<a style="border-radius:25px;" class="btn btn-sm btn-primary btnpadd" href="<?php echo base_url().'User/edit/'.$data['id_login']; ?>"><span class="icon-edit"></span>Edit</a>
								<a style="border-radius:25px;" class="btn btn-sm btn-danger btnpadd" href="<?php echo base_url().'User/hapus/'.$data['id_login']; ?>" onclick="return confirm('Yakin ingin hapus data ?');"><span class="icon-trash"></span>Hapus</a>
							</td>
						</tr>
<?php 	$no++; } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>