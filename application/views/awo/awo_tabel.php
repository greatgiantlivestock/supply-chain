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
						<a style="border-radius:25px;" class="btn btn-sm btn-pink" href="<?php echo base_url();?>awo/add"><span class="fa fa-plus"> </span> Buat Baru</a>
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
							<th>Nama AWO</th>
							<th>Telpon AWO</th>
							<th>Alamat</th>
							<th>Jenis input</th>
							<th>RPH/Depo</th>
							<th >Action</th>
						</tr>
					</thead>
					<tbody>
<?php
		$no = 1;
		foreach($awo->result_array() as $data) { ?>
						<tr>
							<td><?php echo $no; ?></td>
							<td><?php echo $data['nama_awo']; ?></td>
							<td><?php echo $data['telpon_awo']; ?></td>
							<td><?php echo $data['alamat']; ?></td>
							<td><?php if($data['input_type']=='2'){echo "Estimasi dan Hasil Potong";}else if($data['input_type']=='1'){echo "Hanya Estimasi";}else{echo "Tidak ada Akes Input";} ?></td>
							<td>
								<?php echo $data['jml'];?>
									<?php if($data['jml']>0){?>
										<a id="detail_rph" href="" data-id_awo="<?php echo $data['id_awo']; ?>" data-toggle="modal">Detail</a>
									<?php }else{echo "0";}?>
							</td>
							<td style="text-align:center;">
								<a style="border-radius:25px;" id="tambah_detail_rph"  href="" data-id_awo="<?php echo $data['id_awo']; ?>" data-nama_awo="<?php echo $data['nama_awo']; ?>" data-toggle="modal" class="btn btn-sm btn-success btnpadd"><span class="icon-add"></span>Tambah</a>
								<a style="border-radius:25px;" class="btn btn-sm btn-primary btnpadd" href="<?php echo base_url().'awo/edit/'.$data['id_awo']; ?>"><span class="icon-edit"></span>Ubah</a>
								<a style="border-radius:25px;" class="btn btn-sm btn-danger btnpadd" href="<?php echo base_url().'awo/hapus/'.$data['id_awo']; ?>" onclick="return confirm('Yakin ingin hapus data ?');"><span class="icon-trash"></span>Hapus</a>
							</td>
						</tr>
<?php 	$no++; } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<div  class="modal fade" id="ModalrphAwo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button style="border-radius:25px;" type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Daftar RPH Per Karyawan</h4>
            </div>
            	<div class="modal-body" style="height: 350px;overflow-y: scroll;">
            		<div id="data_rph_awo"></div>
				</div>
        </div>
    </div>
</div>
<div  class="modal fade" id="ModalAddrphAwo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button style="border-radius:25px;" type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Tambah Data RPH Per Karyawan</h4>
            </div>
            <form style="margin-bottom:0;" action="<?php echo base_url(); ?>Awo/save_detail_rph" method="post">
            	<input id="id_awo_rph" type="hidden" name="id_awo" >
            	<div class="modal-body" style="height: 350px;overflow-y: scroll;">
					<div class="row" style="margin-bottom: 10px;">
						<table style="width:100%;">
							<tr>
								<td style="height: 60px;">
									<label>Nama Karyawan</label>
								</td>
								<td style="height: 60px;">
									<input id="nama_awo_rph" type="Text" readonly name="nama_awo" >
								</td>
							</tr>
							<tr></tr>
							<tr>
								<td>
									<label>RPH</label>
								</td>
								<td>
									<select name="id_rph">
											<?php echo $combo_rph; ?>
									</select>
								</td>
							</tr>
						</table>
            		</div>
            		<div id="data_rph_awo1"></div>
				</div>
				<div class="modal-footer">
	            	<div class="row">
						<div class="col-md-12 text-right">
							<button style="border-radius:25px;" id="simpan_rph_user" class="btn btn-primary btn-sm"><i class="fa fa-check"> </i> Tambahkan</button>
							</form>
						</div>
					</div>
				</div>
        </div>
    </div>
</div>
