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
				<!-- <div style="margin-bottom:20px;" class="row">
					<div style="text-align:right;" class="col-md-12">
						<a class="btn btn-sm btn-pink" href="<?php echo base_url();?>rph/add"><span class="fa fa-plus"> </span> Tambah Data</a>
					</div>
				</div> -->
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
							<th>Nama</th>
							<!-- <th>Kota</th>
							<th style="width: 300px;">Alamat</th>
							<th>Koordinat</th> -->
							<th>Jenis</th>
							<th>Karkas/Prosot</th>
							<th>Tujuan Mutasi</th>
							<th style="width:220px;">Action</th>
						</tr>
					</thead> 
					<tbody>
<?php
		$no = 1;
		foreach($rph->result_array() as $data) { ?>
						<tr>
							<td><?php echo $no; ?></td>
							<td><?php echo $data['nama_rph']; ?></td>
							<!-- <td><?php echo $data['kota']; ?></td>
							<td><?php echo $data['alamat']; ?></td>
							<td><?php echo $data['koordinat']; ?></td> -->
							<td><?php echo $data['jenis_rph']; ?></td>
							<td><?php if($data['jenis_rph']=='RPH'){if($data['jenis_berat']==0){echo "Belum Didefinisikan";}else if($data['jenis_berat']==1){echo "Karkas";}else if($data['jenis_berat']==1){echo "Prosot";} }?></td>
							<td>
								<?php echo $data['jml'];?>
									<?php if($data['jml']>0){?>
										<a id="detail_rph_mutasi" href="" data-id_rph="<?php echo $data['id_rph']; ?>" data-toggle="modal">Detail</a>
									<?php }else{echo "0";}?>
							</td>
							<td style="text-align:center;">
								<?php if(substr($data['nama_rph'],0,4)=='Depo'){?>
									<a style="border-radius:25px;" id="tambah_detail_rph_mutasi"  href="" data-id_rph="<?php echo $data['id_rph']; ?>" data-nama_rph="<?php echo $data['nama_rph']; ?>" data-toggle="modal" class="btn btn-sm btn-success btnpadd"><span class="icon-add"></span>Tambah</a>
								<?php }?>
								<a style="border-radius:25px;" class="btn btn-sm btn-primary btnpadd" href="<?php echo base_url().'rph/edit/'.$data['id_rph']; ?>"><span class="icon-edit"></span>Ubah Data</a>
								<!-- <a class="btn btn-sm btn-danger btnpadd" href="<?php echo base_url().'rph/hapus/'.$data['id_rph']; ?>" onclick="return confirm('Yakin ingin hapus data ?');"><span class="icon-trash"></span>Hapus</a> -->
							</td>
						</tr>
<?php 	$no++; } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<div  class="modal fade" id="ModalrphAwomutasi" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button style="border-radius:25px;" type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Daftar RPH Per Depo</h4>
            </div>
            	<div class="modal-body" style="height: 350px;overflow-y: scroll;">
            		<div id="data_rph_awo_mutasi"></div>
				</div>
        </div>
    </div>
</div>
<div  class="modal fade" id="ModalAddrphAwomutasi" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button style="border-radius:25px;" type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Tambah Data RPH Per Karyawan</h4>
            </div>
            <form style="margin-bottom:0;" action="<?php echo base_url(); ?>Rph/save_detail_rph" method="post">
            	<input id="id_awo_rph" type="hidden" name="id_awo" >
            	<div class="modal-body" style="height: 350px;overflow-y: scroll;">
					<div class="row" style="margin-bottom: 10px;">
						<table style="width:100%;padding:15px;">
							<tr>
								<td>
									<label>Depo</label>
								</td>
								<td>
									<label>:</label>
								</td>
								<td>
									<input disabled id="nama_rph_change"></input>
									<select hidden id="id_rph_change" name="id_rph">
											<?php echo $combo_rph; ?>
									</select>
								</td>
							</tr>
							<tr style="height:10px;"></tr>
							<tr>
								<td>
									<label>RPH</label>
								</td>
								<td>
									<label>:</label>
								</td>
								<td>
									<select style="width:60%;" name="id_rph_mutasi" class="select2">
											<?php echo $combo_rph_mutasi; ?>
									</select>
								</td>
							</tr>
						</table>
            		</div>
            		<div id="data_rph_awo_mutasi1"></div>
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