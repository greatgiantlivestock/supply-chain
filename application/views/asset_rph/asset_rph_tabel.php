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
				<form action="<?php echo base_url(); ?>asset_rph/save" method="post">
					<table class="tbl_input">
						<tr>
							<td style="width:120px;">
								Tanggal
							</td>
							<td style="width: 500px;">
								<input style="width: 60%;" id="tgl" class="form-control " type="text" placeholder="dd/mm/yyyy" name="tanggal" value="<?php // echo $tanggal_keluar; ?>" required>		
							</td>
							<td style="width:120px;">
								RPH
							</td>
							<td>
								<select style="width:250px;" class="select_rph" name="id_rph" required>
									<?php echo $combo_rph; ?>
								</select>
							</td>
						</tr>
						<tr>
							<td>
								Barang
							</td>
							<td>
								<input id="id_barang" name="id_barang" type="hidden">
								<div class="col-sm-6" style="padding: 0;">
			                      <input id="barang" type="text" class="form-control input-sm" name="barang" placeholder="Cari.." required readonly>
			                    </div>
			                    <div class="col-sm-2" style="padding: 0;">
			                    	<a class="btn btn-danger btn-sm" href="" data-toggle="modal" data-target="#ModalBarang"><span class="fa fa-search"> </i> </a> 
			                    </div>
							</td>
							<td>Keadaan Barang</td>
							<td>
								<div class="radio">
									<label>
										<input id="rb_lunas" name="keadaan_barang" type="radio" class="ace" value="Baik">
										<span class="lbl"> Baik</span>
									</label>

									<label>
										<input id="rb_promosi" name="keadaan_barang" type="radio" class="ace" value="Rusak">
										<span class="lbl"> Rusak</span>
									</label>
								</div>
							</td>
						</tr>	
						<tr>
							<td>
								Jumlah Barang
							</td>
							<td>															
								<input style="width: 20%;"  class="form-control" type="text" name="jumlah_barang" required>
							</td>
							<td>
								Keterangan
							</td>
							<td>	
								<input class="form-control" type="text" name="keterangan">	
							</td>
						</tr>			
					</table>

				<hr/ style="margin-top: 30px; margin-bottom: 10px;">
				<div class="row">
					<div class="col-md-6">
						<a id="ubah_kondisi_rph" class="btn btn-pink btn-sm" href="" data-toggle="modal"><i class="fa fa-refresh"> </i> Ubah Kondisi Barang</a>
						<a id="mutasi_asset_rph" style="margin-left:20px;" class="btn btn-primary btn-sm" href="" data-toggle="modal"><i class="fa fa-exchange"> </i> Mutasi Asset</a>
						<a id="replacement_asset_rph" style="margin-left:20px;" class="btn btn-success btn-sm" href="" data-toggle="modal"><i class="fa fa-reorder"> </i> Replacement Asset</a>
					</div>
					<div class="col-md-6 text-right">
						<button class="btn btn-danger btn-sm"><i class="fa fa-plus"> </i> Tambah Data Asset</button>
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

 <?php if($this->session->flashdata('error')) { ?>
                    <div class="alert alert-danger alert-dismissible fade in" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                      <?php echo $this->session->flashdata('error'); ?>
                    </div> 
 <?php } ?>
				<table id="rph_asset" class="table table-bordered">
					<thead>
						<tr>
							<th>#</th>
							<th>No.</th>
							<th>Tanggal</th>							
							<th>Nama Barang</th>
							<th>Merk</th>							
							<th>Identitas</th>
							<th>Jumlah</th>
							<th>RPH</th>
							<th>Keadaan</th>
							<th>Keterangan</th>
							<th>#</th>
						</tr>
					</thead>
					<tbody>
		<?php
				$no = 1;
				foreach($asset_rph->result_array() as $data) { 
					if($data['keadaan_barang'] == 'Baik') {
						$bg = '#edfce8';
					}
					if($data['keadaan_barang'] == 'Kurang Baik') {
						$bg = '#fffcdd';
					}
					if($data['keadaan_barang'] == 'Rusak') {
						$bg = '#ffdddd';
					}
		?> 
						<tr style="background: <?php echo $bg; ?>" id="<?php echo $data['id_asset_rph']; ?>" data-id_asset_rph="<?php echo $data['id_asset_rph']; ?>" data-nama="<?php echo $data['nama_barang']; ?>" data-merk="<?php echo $data['merk']; ?>" data-rph="<?php echo $data['nama_rph']; ?>" data-id_rph="<?php echo $data['id_rph']; ?>" data-id_barang="<?php echo $data['id_barang']; ?>">
							<td>
								<input class="check" type="checkbox">
								<span class="lbl"></span>
							</td>
							<td><?php echo $no; ?></td>
							<td><?php echo $data['tanggal']; ?></td>
							<td><?php echo $data['nama_barang']; ?></td>
							<td><?php echo $data['merk']; ?></td>							
							<td><?php echo $data['identitas']; ?></td>
							<td><?php echo $data['jumlah_barang']; ?></td>
							<td><b><?php echo $data['nama_rph']; ?></b></td>
							<td><?php echo $data['keadaan_barang']; ?></td>
							<td><?php echo $data['keterangan']; ?></td>
							<td><a class="btn btn-default btn-sm" href="<?php echo base_url().'asset_rph/hapus_asset/'.$data['id_asset_rph']; ?>" onclick="return confirm('Yakin ingin hapus data ?');"><i class="fa fa-trash"> </i></a></td>
						</tr>
		<?php 	$no++; } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>



 <div  class="modal fade" id="ModalKondisiRph" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Ubah Kondisi Barang</h4>
            </div>
            <form style="margin-bottom:0;" action="<?php echo base_url(); ?>asset_rph/ubah_kondisi" method="post"/>
            	<div class="modal-body">					
            		<input id="id_asset_rph" type="hidden" name="id_asset_rph" readonly>			
            		<input id="id_barang1" type="hidden" name="id_barang" readonly>			
            		<input id="identitas_barang" type="hidden" name="identitas_barang" readonly>			
            		<input id="id_rph" type="hidden" name="id_rph" readonly>			

            		<div class="form-group">
            			<label> Nama Barang </label>

            			<input class="form-control" id="nama_barang" type="text" name="nama_barang" readonly/>
            		</div>	

            		<div class="form-group">
            			<label> Merk </label>

            			<input class="form-control" id="merk" type="text" name="merk" readonly/>
            		</div>	

            		<div class="form-group">
            			<label> Tanggal </label>

            			<input class="form-control" id="tgl2" type="text" name="tanggal" required/>
            		</div>	

            		<div class="form-group">
            			<label> Keadaan Barang </label>

            			<select name="keadaan_barang" class="form-control" required>
            				<option>Pilih Keadaan Barang</option>
            				<option value="Baik">Baik</option>
            				<option value="Rusak" selected>Rusak</option>
            			</select>
            		</div>	

            		<div class="form-group">
            			<label> Keterangan </label>

            			<input class="form-control" type="text" name="keterangan" value="Rusak" />
            		</div>						
			
				</div>


	            <div class="modal-footer">
			        <button id="simpan_jual" class="btn btn-primary btn-sm">Simpan</button>
			        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Batal</button>
			    </div>

			</form>
		   
        </div>
    </div>
</div>

 <div  class="modal fade" id="ModalMutasiRph" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Mutasi Asset RPH</h4>
            </div>
            <form style="margin-bottom:0;" action="<?php echo base_url(); ?>asset_rph/mutasi_asset" method="post"/>
            	<div class="modal-body">					
            		<input id="id_asset_rph2" type="hidden" name="id_asset_rph" readonly>			
            		<input id="id_rph2" type="hidden" name="id_rph" readonly>
            		<input id="id_barang2" type="hidden" name="id_barang" readonly>			
            		<input id="identitas_barang2" type="hidden" name="identitas_barang" readonly>				

            		<div class="form-group">
            			<label> Nama Barang </label>

            			<input style="width:80%;" class="form-control" id="nama_barang_asset" type="text" name="nama_barang" readonly/>
            		</div>	

            		<div class="form-group">
            			<label> Merk </label>

            			<input style="width:80%;" class="form-control" id="merk_asset" type="text" name="merk" readonly/>
            		</div>	

            		<div class="form-group">
            			<label> RPH </label>

            			<input style="width:40%;" class="form-control" id="rph" type="text" name="rph" readonly/>
            		</div>	

            		<div class="form-group">
            			<label> Tanggal </label>

            			<input style="width:60%;" class="form-control" id="tgl3" type="text" name="tanggal" required/>
            		</div>	

            		<div class="form-group">
            			<label> Mutasi Ke rph </label>

            			<select style="width:100%;" name="rph_penerima" class="select2" required>
            				<option>Pilih RPH</option>
            			<?php 
            				$q_rph = $this->db->query("SELECT * FROM mst_rph ORDER BY nama_rph ASC");
            				foreach($q_rph->result_array() as $data_rph) { ?>
            					<option value="<?php echo $data_rph['id_rph']; ?>"><?php echo $data_rph['nama_rph']; ?></option>
            			<?php } ?>
            			</select>
            		</div>	

            		<div class="form-group">
            			<label> Keterangan </label>

            			<input style="width:80%;" class="form-control" type="text" name="keterangan" value="Mutasi" required/>
            		</div>						
			
				</div>


	            <div class="modal-footer">
			        <button id="simpan_jual" class="btn btn-primary btn-sm">Simpan</button>
			        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Batal</button>
			    </div>

			</form>
		   
        </div>
    </div>
</div>


 <div  class="modal fade" id="ModalReplacementrRph" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Replacement Asset</h4>
            </div>
            <form style="margin-bottom:0;" action="<?php echo base_url(); ?>asset_rph/replacement_asset" method="post"/>
            	<div class="modal-body">					
            		<input id="id_asset_rph3" type="hidden" name="id_asset_rph" readonly>			
            		<input id="id_rph3" type="hidden" name="id_rph" readonly>
            		<input id="id_barang3" type="hidden" name="id_barang" readonly>	
					<input id="identitas_barang3" type="hidden" name="identitas_barang" readonly>

            		<div class="form-group">
            			<label> Nama Barang </label>

            			<input style="width:80%;" class="form-control" id="nama_barang_replacement" type="text" name="nama_barang" readonly/>
            		</div>	

            		<div class="form-group">
            			<label> Merk </label>

            			<input style="width:80%;" class="form-control" id="merk_replacement" type="text" name="merk" readonly/>
            		</div>	

            		

            		<div class="form-group">
            			<label> Tanggal </label>

            			<input style="width:60%;" class="form-control" id="tgl4" type="text" name="tanggal" required/>
            		</div>	

            		<div class="form-group">
            			<label> Barang Pengganti </label>

            			<select style="width:100%;" name="barang_pengganti" class="select2" required>
            				<option>Pilih Barang</option>
            			<?php 
            				$q_barang = $this->db->query("SELECT * FROM mst_barang LEFT JOIN mst_jenis_barang ON mst_barang.id_jenis_barang = mst_jenis_barang.id_jenis_barang ORDER BY nama_barang DESC");
            				foreach($q_barang->result_array() as $data_barang) { ?>
            					<option value="<?php echo $data_barang['id_barang']; ?>"><?php echo $data_barang['nama_barang']." - ".$data_barang['merk']." - ".$data_barang['identitas']; ?></option>
            			<?php } ?>
            			</select>
            		</div>	


            		<div class="form-group">
            			<label> Keterangan </label>

            			<input style="width:80%;" class="form-control" type="text" name="keterangan" value="Replacement" required/>
            		</div>						
			
				</div>


	            <div class="modal-footer">
			        <button id="simpan_jual" class="btn btn-primary btn-sm">Simpan</button>
			        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Batal</button>
			    </div>

			</form>
		   
        </div>
    </div>
</div>


 <div  class="modal fade" id="ModalBarang" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Daftar Barang</h4>
            </div>
            	<div class="modal-body">					
            		<table class="table table-bordered table-hover"> 
            			<thead>
            				<tr>
            					<th>No.</th>
            					<th>Nama</th>
            					<th>Merk</th>
            					<th>Identitas</th>
            				</tr>
            			</thead>
            			<tbody>
            				<?php
		$no = 1;
		foreach($barang->result_array() as $data) { ?>
						<tr class="pilih_barang" data-barang="<?php echo $data['nama_barang'].'-'.$data['merk'].'-'.$data['identitas']; ?>" data-id_barang="<?php echo $data['id_barang']; ?>">
							<td><?php echo $no; ?></td>
							<td><?php echo $data['nama_barang']; ?></td>
							<td><?php echo $data['merk']; ?></td>							
							<td><?php echo $data['identitas']; ?></td>
						</tr>
<?php 	$no++; } ?>
            			</tbody>
            		</table>
				</div>

	            <div class="modal-footer">
			        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Batal</button>
			    </div>		   
        </div>
    </div>
</div>