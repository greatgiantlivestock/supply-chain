<script type="text/javascript">
        	$(document).on("click", "#laporkan_admin", function () {
        		var id_pengiriman = $(this).attr('data-id_pengiriman');
        		$.ajax({
								url: "<?php echo base_url(); ?>pemotongan_sapi/get_pengiriman", 
								async: false,
								type: "POST",    
								data: "id_pengiriman="+id_pengiriman,   
								dataType: "html",
								success: function(data) {
									$('#data_pengiriman').html(data); 
									$("#ModalLaporkan").modal('show');
								}
						}) 
        	});
			function AlertLock(x){
				alert('Terkunci, hubungi admin untuk mengeditnya.');
			}
	</script>
<div class="col-md-12">					    
	<div class="widget-box">
		<div class="widget-header header-color-red">
			<h5 class="bigger lighter">
				<i class="fa fa-table"></i>
				<?php echo $judul; ?>
			</h5>
		</div>
		<div class="widget-body">
			<div class="widget-main">
<?php if($this->session->flashdata('success')) { ?>
                    <div class="alert alert-success alert-dismissible fade in" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                      <?php echo $this->session->flashdata('success'); ?>
                    </div> 
 <?php } ?>
 <div class="row" style="margin-bottom: 20px;">
 	<div class="col-md-6">
 		<form action="<?php echo base_url(); ?>pemotongan_sapi/lihat_hasil_pemotongan" method="post">
 			<table style="border: 1px solid #ccc;">
 				<tr>
 					<td style="width: 120px;padding: 15px 0 15px 10px;">Tgl.Awal</td>
 					<td><input style="width: 150px;" id="tgl" type="text" name="tanggal_awal" class="form-control" value="<?php echo $tanggal_awal; ?>" ></td>
 					<td style="width: 120px;padding: 15px 0 15px 10px;">Tgl.Akhir</td>
 					<td><input style="width: 150px;" id="tgl2" type="text" name="tanggal_akhir" class="form-control" value="<?php echo $tanggal_akhir; ?>" ></td>
 					<td style="width: 120px;padding: 15px 0 15px 10px;">
					 	<select name="status_potong">
							<option <?php if($status_potong==""){?>selected <?php }?> value=''>pilih status</option>
							<option <?php if($status_potong=="0"){?>selected <?php }?>value='0'>Belum Dipotong</option>
							<option <?php if($status_potong=="1"){?>selected <?php }?>value='1'>Sudah Dipotong</option>
					 	</select>
					</td>
 					<td style="padding: 15px 10px 15px 0;"><button style="margin-left: 10px;border-radius:25px;" class="btn btn-primary btn-sm">Filter</button></td>
 				</tr>
 			</table>	
 		</form>
 	</div>
 </div>
 				<!-- <ul style="margin-bottom:20px;" class="nav nav-tabs">
			  		<li class="active"><a data-toggle="tab" href="#GGL">GGL</a></li>
			  		<li><a data-toggle="tab" href="#NTF">NTF</a></li>
			  		<li><a data-toggle="tab" href="#PO">PO</a></li>
				</ul> -->
				<div class="tab-content">
	  				<!-- <div id="GGL" class="tab-pane fade in active"> -->
	  				<div id="GGL">
	  					<div style="overflow-y: scroll;margin-bottom: 20px;">
							<!-- <?php if($pemotongan_sapi_ggl_stts->result_array()==null){?>
								<a id="laporkan_admin" disabled class="btn btn-sm btn-primary" href=""  style="margin-bottom:10px"
								data-toggle="modal"><span class="fa fa-send"> </span> Laporkan Admin</a>
							<?php }else if(!$pemotongan_sapi_ggl_stts->result_array()==null){?>
								<a id="laporkan_admin" class="btn btn-sm btn-primary" href=""  style="margin-bottom:10px"
								data-toggle="modal"><span class="fa fa-send"> </span> Laporkan Admin</a>
							<?php }?> -->
							<table style="font-size:11px;width: 1500px;" id="sample-table-2" class="table table-striped table-bordered table-hover">
								<thead>
									<tr>
										<th style="width:50px;">No</th>										
										<th>Action</th>
										<th>Nota</th>
										<th>Shipment</th>
										<th>Jenis</th>
										<th>Eartag</th>
										<th>Tgl.Masuk</th>							
										<th>Tgl.Potong</th>
										<th>Umur</th>
										<th>RFID</th>
										<th>BBD</th>
										<?php if($this->session->userdata('jenis_berat')==0){?>
											<th>Karkas</th>
											<th>% Karkas</th>
										<?php }else{ ?>
											<th>Prosot</th>
											<th>% Prosot</th>
										<?php } ?>
										<th>Ket.</th>
										<th>Pasar</th>
										<th>Pedagang</th>
										<th>Merah</th>
										<th>Orange</th>
										<th>Hitam</th>
										<th>Kuning</th>
										<th>Peneumatic</th>
										<th>Score</th>
									</tr>
								</thead>
							<?php
								$no = 1;
								foreach($pemotongan_sapi_ggl->result_array() as $data) { 
									if($data['status_potong'] == '1') {
										$bg = 'style="background:#edfce8;"';
										$potong = true;
									} else if ($data['status_potong'] == '0') {
										$bg = 'style="background:#ffdddd;"';
										$potong = false;
									}else if ($data['status_potong'] == '2') {
										$bg = 'style="background:#d3d3d3;"';
										$potong = false;
									}
								?>
									<tr <?php echo $bg; ?>>		
										<td><?php echo $no; ?></td>															
										<td style="text-align:center;">
											<?php if($data['status_potong'] == '0' || $data['status_potong'] == '1'){?>
												<a style="border-radius:25px;" id="pemotongan_sapi1" class="label label-primary" href="" data-id_penerimaan_detail="<?php echo $data['id_penerimaan_detail']; ?>" 
												data-tgl="<?php echo $data['tanggal_potong']; ?>" data-rfid="<?php echo $data['rfid']; ?>" 
												data-berat_karkas="<?php echo $data['berat_karkas']; ?>" data-berat_prosot="<?php echo $data['berat_prosot']; ?>" data-keterangan_potong="<?php echo $data['keterangan_potong']; ?>" 
												data-pasar="<?php echo $data['pasar']; ?>" data-nama_pedagang="<?php echo $data['nama_pedagang']; ?>"  
												data-jam_potong="<?php echo $data['jam_potong']; ?>" data-merah="<?php echo $data['merah']; ?>" 
												data-orange="<?php echo $data['orange']; ?>" data-hitam="<?php echo $data['hitam']; ?>" 
												data-kuning="<?php echo $data['kuning']; ?>" data-peneumatic="<?php echo $data['peneumatic']; ?>" 
												data-score="<?php echo $data['score_stune']; ?>" data-toggle="modal">
												<span class="fa fa-refresh"> </span></a>
											<?php }else if($data['status_potong'] == '2'){ ?>
												<button class="label label-normal" onclick="AlertLock(this)" href="#" >
												<span class="fa fa-lock"> </span></button>
											<?php }?>
										</td>
										<td><?php echo $data['nota']; ?></td>
										<td><?php echo $data['shipment']; ?></td>
										<td><?php echo $data['material_description']; ?></td>
										<td><?php echo $data['eartag']; ?></td>
										<td><?php echo $data['tanggal_terima']; ?></td>	
										<td><?php 
												if(empty($data['tanggal_potong'])) {
													echo '-';
												} else {
													echo $data['tanggal_potong'];
												} 
											?>
										</td>
										<td>
											<?php
												if(!empty($data['tanggal_potong'])) {
													$start_date = new DateTime($data['tanggal_terima']);
													$end_date = new DateTime($data['tanggal_potong']);
													$interval = $start_date->diff($end_date);
													echo $interval->days;
												} else {
													echo '-';
												}
											?>
										</td>						
										<td><?php echo $data['rfid']; ?></td>
										<td><?php echo $data['berat']; ?></td>
										<?php if($this->session->userdata('jenis_berat')==0){?>
											<td><?php echo $data['berat_karkas']; ?></td>
											<td><?php echo round((($data['berat_karkas']/$data['berat'])*100),2); ?>%</td>
										<?php }else{ ?>
											<td><?php echo $data['berat_prosot']; ?></td>
											<td><?php echo round((($data['berat_prosot']/$data['berat'])*100),2); ?>%</td>
										<?php } ?>
										<td><?php echo $data['keterangan_potong']; ?></td>
										<td><?php echo $data['pasar']; ?></td>
										<td><?php echo $data['nama_pedagang']; ?></td>
										<td><?php echo $data['merah']; ?></td>
										<td><?php echo $data['orange']; ?></td>
										<td><?php echo $data['hitam']; ?></td>
										<td><?php echo $data['kuning']; ?></td>
										<td><?php echo $data['peneumatic']; ?></td>
										<td><?php echo $data['score_stune']; ?></td>
									</tr>
							<?php 	$no++; } ?>
												<tbody>
												</tbody>
											</table>
						</div>
					</div>
					
				</div>
			</div>
		</div>
	</div>
</div>

 <div  class="modal fade" id="ModalPotong1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Update Hasil Estimasi Pemotongan</h4>
            </div>
            <form style="margin-bottom:0;" action="<?php echo base_url(); ?>Pemotongan_sapi/update_hasil_potong_estimasi" method="post">
            	<input id="id_penerimaan_detail" type="hidden" name="id_penerimaan_detail" >
            	<div class="modal-body">					
            		<div class="form-gorup">
            			<label>Tgl. Potong</label>
            			<div class="row">
            				<div class="col-xs-4">
            					<input style="margin-bottom: 10px;" id="tgl3" class="form-control" name="tanggal_potong" placeholder="Tanggal Potong ..." required>
            				</div>
            				<div class="col-xs-3">
            					<input id="jam" class="form-control" style="margin-bottom: 20px;" type="text" name="jam_potong" placeholder="Jam Potong .." required>
            				</div>
            		</div>
            		<div class="form-gorup">
            			<label>RFID</label>
            			<div class="row">
            				<div class="col-xs-6">
            					<input id="rfid"  class="form-control" name="rfid" required>
            				</div>
            				<div class="col-xs-6">
            					<input type="checkbox" value="1" name="flag" /> <span class="lbl">RFID Tidak Sesuai</span>
            				</div>
            				<div class="col-xs-6">
            					<input type="checkbox" value="1" name="flag1" /> <span class="lbl">RFID Hilang</span>
            				</div>
            			</div>
            		</div>
            		<div class="form-group">
            			<label>Keterangan</label>
            			<input id="keterangan_potong" style="width:50%;" class="form-control" name="keterangan_potong">
            		</div>
				</div>
	            <div class="modal-footer">
			        <button style="border-radius:25px;" id="simpan_jual" class="btn btn-primary btn-sm"><i class="fa fa-save"> </i> Update</button>
			        <button style="border-radius:25px;" type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Batal</button>
			    </div>
			</form>
        </div>
	</div>

	<!-- <div  class="modal fade" id="ModalLaporkan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Rekap Laporan Potong Sapi</h4>
				</div>
				<form style="margin-bottom:0;" action="<?php echo base_url(); ?>Pemotongan_sapi/laporkan_admin" method="post">
					<input id="id_pengiriman" type="hidden" name="id_pengiriman" >
					<div class="modal-body" style="height: 350px;overflow-y: scroll;">					
						<div id="data_pengiriman"></div>
					</div>
			</div>
		</div> 
	</div> -->