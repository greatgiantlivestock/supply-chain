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
 <div class="row">
 	<div class="col-md-6">
 		<form action="<?php echo base_url(); ?>pemotongan_sapi/lihat_hasil_pemotongan" method="post">
 			<table >
 				<tr>
 					<td style="width: 120px;padding: 5px 0 15px 10px;">Tgl.Awal</td>
 					<td><input style="width: 150px;" id="tgl" name="tanggal_awal" class="form-control" value="<?php echo $tanggal_awal; ?>" ></td>
 				</tr>
 				<tr>
 					<td style="width: 120px;padding: 5px 0 15px 10px;">Tgl.Akhir</td>
 					<td><input style="width: 150px;" id="tgl2" name="tanggal_akhir" class="form-control" value="<?php echo $tanggal_akhir; ?>" ></td>
 				</tr>
 				<tr>
				 	<td style="width: 120px;padding: 5px 0 15px 10px;">Status</td>
 					<td style="width: 150px;">
					 	<select name="status_potong">
							<option <?php if($status_potong==""){?>selected <?php }?> value=''>pilih status</option>
							<option <?php if($status_potong=="0"){?>selected <?php }?>value='0'>Belum Dipotong</option>
							<option <?php if($status_potong=="1"){?>selected <?php }?>value='1'>Sudah Dipotong</option>
					 	</select>
					</td>
					</tr>
 				<tr>
 					<td ><button style="margin-left: 10px;border-radius:25px;" class="btn btn-primary btn-sm">Filter</button></td>
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
					  		<?php if($pemotongan_sapi_ggl_stts->result_array()==null){?>
								<a style="border-radius:25px;" id="laporkan_admin" disabled class="btn btn-sm btn-primary" href=""  style="margin-bottom:10px"
								data-toggle="modal"><span class="fa fa-send"> </span> Laporkan</a>
							<?php }else if(!$pemotongan_sapi_ggl_stts->result_array()==null){?>
								<a style="border-radius:25px;" id="laporkan_admin" class="btn btn-sm btn-primary" href="" 
								data-toggle="modal"><span class="fa fa-send"> </span> Laporkan</a>
							<?php }?>
	  					<!-- <div style="overflow-y: scroll;margin-bottom: 20px;"> -->
							<table style="font-size:11px;" id="dttble5" class="table table-striped table-bordered table-hover">
								<thead>
									<tr>
										<th style="width:50px;">No</th>									
										<th>Action</th>
										<th>Eartag</th>
										<th>RFID</th>	
										<th>Nota</th>
										<th>Shipment</th>
										<th>Jenis</th>
										<th>Tgl.Masuk</th>							
										<th>Tgl.Potong</th>
										<th>Umur</th>
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
										$id_penerimaan_detail=$data['id_penerimaan_detail'];
										$qCond = $this->db->query("SELECT jenis_berat FROM mst_rph JOIN pengiriman ON pengiriman.id_rph=mst_rph.id_rph 
															JOIN penerimaan_detail ON penerimaan_detail.id_pengiriman=pengiriman.id_pengiriman WHERE 
															id_penerimaan_detail='$id_penerimaan_detail'")->row();
									?><script>console.log(<?php echo $qCond->jenis_berat;?>);</script>
									<tr <?php echo $bg; ?>>		
										<td><?php echo $no; ?></td>															
										<td style="text-align:center;">
											<?php if($data['status_potong'] == '0' || $data['status_potong'] == '1'){ ?>
												<?php if($qCond->jenis_berat==1){?>		
													<a id="pemotongan_sapi" class="label label-primary" href="" data-id_penerimaan_detail="<?php echo $data['id_penerimaan_detail']; ?>" 
													data-tgl="<?php echo $data['tanggal_potong']; ?>" data-rfid="<?php echo $data['rfid']; ?>" 
													data-berat_karkas="<?php echo $data['berat_karkas']; ?>" data-berat_prosot="<?php echo $data['berat_prosot']; ?>" data-keterangan_potong="<?php echo $data['keterangan_potong']; ?>" 
													data-pasar="<?php echo $data['pasar']; ?>" data-nama_pedagang="<?php echo $data['nama_pedagang']; ?>"  
													data-jam_potong="<?php echo $data['jam_potong']; ?>" data-merah="<?php echo $data['merah']; ?>" 
													data-orange="<?php echo $data['orange']; ?>" data-hitam="<?php echo $data['hitam']; ?>" 
													data-kuning="<?php echo $data['kuning']; ?>" data-peneumatic="<?php echo $data['peneumatic']; ?>" 
													data-score="<?php echo $data['score_stune']; ?>" data-toggle="modal">
													<span class="fa fa-refresh"> </span></a>
												<?php }else if($qCond->jenis_berat==2){?>
													<a id="pemotongan_sapi2" class="label label-primary" href="" data-id_penerimaan_detail="<?php echo $data['id_penerimaan_detail']; ?>" 
													data-tgl="<?php echo $data['tanggal_potong']; ?>" data-rfid="<?php echo $data['rfid']; ?>" 
													data-berat_karkas="<?php echo $data['berat_karkas']; ?>" data-berat_prosot="<?php echo $data['berat_prosot']; ?>" data-keterangan_potong="<?php echo $data['keterangan_potong']; ?>" 
													data-pasar="<?php echo $data['pasar']; ?>" data-nama_pedagang="<?php echo $data['nama_pedagang']; ?>"  
													data-jam_potong="<?php echo $data['jam_potong']; ?>" data-merah="<?php echo $data['merah']; ?>" 
													data-orange="<?php echo $data['orange']; ?>" data-hitam="<?php echo $data['hitam']; ?>" 
													data-kuning="<?php echo $data['kuning']; ?>" data-peneumatic="<?php echo $data['peneumatic']; ?>" 
													data-score="<?php echo $data['score_stune']; ?>" data-toggle="modal">
													<span class="fa fa-refresh"> </span></a>
												<?php }else{?>
													<a id="pemotongan_sapi3" class="label label-danger" href="" data-id_penerimaan_detail="<?php echo $data['id_penerimaan_detail']; ?>" 
													data-tgl="<?php echo $data['tanggal_potong']; ?>" data-rfid="<?php echo $data['rfid']; ?>" 
													data-berat_karkas="<?php echo $data['berat_karkas']; ?>" data-berat_prosot="<?php echo $data['berat_prosot']; ?>" data-keterangan_potong="<?php echo $data['keterangan_potong']; ?>" 
													data-pasar="<?php echo $data['pasar']; ?>" data-nama_pedagang="<?php echo $data['nama_pedagang']; ?>"  
													data-jam_potong="<?php echo $data['jam_potong']; ?>" data-merah="<?php echo $data['merah']; ?>" 
													data-orange="<?php echo $data['orange']; ?>" data-hitam="<?php echo $data['hitam']; ?>" 
													data-kuning="<?php echo $data['kuning']; ?>" data-peneumatic="<?php echo $data['peneumatic']; ?>" 
													data-score="<?php echo $data['score_stune']; ?>" data-toggle="modal">
													<span class="fa fa-refresh"> </span></a>
												<?php } ?>
											<?php }else if($data['status_potong'] == '2'){ ?>
												<button class="label label-normal" onclick="AlertLock(this)" href="#" >
												<span class="fa fa-lock"> </span></button>
											<?php }?>
										</td>
										<td><?php echo $data['eartag']; ?></td>
										<td><?php echo $data['rfid']; ?></td>
										<td><?php echo $data['nota']; ?></td>
										<td><?php echo $data['shipment']; ?></td>
										<td><?php echo $data['material_description']; ?></td>
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
						<!-- </div> -->
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div  class="modal fade" id="ModalLaporkan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
			<!-- <script type="text/javascript">
				$("#checkAll").click(function () {
					$('input:checkbox').not(this).prop('checked', this.checked);
					var checkBox = document.getElementById("checkAll");
					var table = document.getElementById("dataTables-example");
					var count = table.rows.length;
					var calc = count - 3;
				});
			</script> -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Rekap Laporan Potong Sapi</h4>
            </div>
            <form style="margin-bottom:0;" action="<?php echo base_url(); ?>Pemotongan_sapi/laporkan_admin" method="post">
            	<input id="id_pengiriman" type="hidden" name="id_pengiriman" >
            	<div class="modal-body" style="height: 350px;overflow-y: scroll;">					
            		<div id="data_pengiriman"></div>
				</div>
	            <div class="modal-footer">
	            	<div class="row">
	            		<div class="col-md-12 text-right">
			        		<button style="border-radius:25px;" id="simpan_jual" class="btn btn-primary btn-sm"><i class="fa fa-check"> </i> Laporkan</button>
			        	</div>
					</div>
			    </div>
			</form>
        </div>
    </div>
</div>
<div  class="modal fade" id="ModalPotong" tabindex="-1"  aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Update Hasil Pemotongan</h4>
            </div>
            <form style="margin-bottom:0;" action="<?php echo base_url(); ?>Pemotongan_sapi/update_hasil_potong" method="post">
            	<input id="id_penerimaan_detail" type="hidden" name="id_penerimaan_detail" >
            	<div class="modal-body">					
            		<div class="form-gorup">
            			<label>Tgl. Potong</label>
						<!-- <table style="width:100%;">
							<tr>
								<td>
								</td>
								<td>
								</td>
							</tr>
						</table> -->
            			<div class="row">
            				<div class="col-xs-5">
            					<input style="margin-bottom: 10px;" autocomplete="off" id="tgl3" class="form-control" name="tanggal_potong" placeholder="Tanggal Potong ..." required>
            				</div>
            				<div class="col-xs-5">
            					<input id="jam" class="form-control" style="margin-bottom: 20px;" type="text" name="jam_potong" placeholder="Jam Potong .." required>
            				</div>
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
					<div class="form-gorup">
						<label>Berat Karkas</label>
						<input id="berat_karkas" style="width:10%;margin-bottom: 10px;" class="form-control" name="berat_karkas">
					</div>
            		<div class="form-gorup">
            			<label>Power Load</label>
            			<div class="row">
	            			<div class="col-xs-2">
	            				<input id="merah" style="margin-bottom: 10px;" class="form-control" name="merah" placeholder="merah" >
	            			</div>
	            			<div class="col-xs-2">
	            				<input id="orange"  style="margin-bottom: 10px;" class="form-control" name="orange" placeholder="orange" >
	            			</div>
	            			<div class="col-xs-2">
	            				<input id="hitam"  style="margin-bottom: 10px;" class="form-control" name="hitam" placeholder="hitam" >
	            			</div>
	            			<div class="col-xs-2">
	            				<input id="kuning"  style="margin-bottom: 10px;" class="form-control" name="kuning" placeholder="kuning" >
	            			</div>
	            		</div>
            		</div>
            		<div class="row">
            			<div class="col-xs-2">
		            		<div class="form-gorup">
		            			<label>Peneumatic</label>
		            			<input id="peneumatic" style="margin-bottom: 10px;" class="form-control" name="peneumatic" required>
		            		</div>
		            	</div>
		            	<div class="col-xs-2">
		            		<div class="form-gorup">
		            			<label>Score</label>
		            			<input id="score" style="margin-bottom: 10px;" class="form-control" name="score" required>
		            		</div>
		            	</div>
		            </div>
		            <div class="row">
            			<div class="col-xs-6">
		            		<div class="form-gorup">
		            			<label>Pasar</label>
		            			<input id="pasar" style="margin-bottom: 10px;" class="form-control" name="pasar">
		            		</div>
		            	</div>
		            	<div class="col-xs-6">
		            		<div class="form-gorup">
		            			<label>Nama Pedagang</label>
		            			<input id="nama_pedagang" style="margin-bottom: 10px;" class="form-control" name="nama_pedagang">
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
</div>
<div  class="modal fade" id="ModalPotong2" tabindex="-1" aria-labelledby="myModalLabel2" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel2">Update Hasil Pemotongan</h4>
            </div>
            <form style="margin-bottom:0;" action="<?php echo base_url(); ?>Pemotongan_sapi/update_hasil_potong" method="post">
            	<input id="id_penerimaan_detail2" type="hidden" name="id_penerimaan_detail" >
            	<div class="modal-body">					
            		<div class="form-gorup">
            			<label>Tgl. Potong</label>
            			<div class="row">
            				<div class="col-xs-5">
            					<input style="margin-bottom: 10px;" id="tgl32" autocomplete="off" class="form-control" name="tanggal_potong" placeholder="Tanggal Potong ..." required>
            				</div>
            				<div class="col-xs-5">
            					<input id="jam2" class="form-control" autocomplete="off" style="margin-bottom: 20px;" type="text" name="jam_potong" placeholder="Jam Potong .." required>
            				</div>
						</div>
            		</div>
            		<div class="form-gorup">
            			<label>RFID</label>
            			<div class="row">
            				<div class="col-xs-6">
            					<input id="rfid2" autocomplete="off" class="form-control" name="rfid" required>
            				</div>
            				<div class="col-xs-6">
            					<input type="checkbox" value="1" name="flag" /> <span class="lbl">RFID Tidak Sesuai</span>
            				</div>
            				<div class="col-xs-6">
            					<input type="checkbox" value="1" name="flag1" /> <span class="lbl">RFID Hilang</span>
            				</div>
            			</div>
            		</div>
					<div class="form-gorup">
						<label>Berat Prosot</label>
						<input id="berat_prosot2" autocomplete="off" style="width:25%;margin-bottom: 10px;" class="form-control" name="berat_prosot">
					</div>
            		<div class="form-gorup">
            			<label>Power Load</label>
            			<div class="row">
	            			<div class="col-xs-3">
	            				<input id="merah2" autocomplete="off" style="margin-bottom: 10px;width:115%;" class="form-control" name="merah" placeholder="merah" >
	            			</div>
	            			<div class="col-xs-3">
	            				<input id="orange2" autocomplete="off" style="margin-bottom: 10px;width:115%;" class="form-control" name="orange" placeholder="orange" >
	            			</div>
	            			<div class="col-xs-3">
	            				<input id="hitam2" autocomplete="off" style="margin-bottom: 10px;width:115%;" class="form-control" name="hitam" placeholder="hitam" >
	            			</div>
	            			<div class="col-xs-3">
	            				<input id="kuning2" autocomplete="off" style="margin-bottom: 10px;width:115%;" class="form-control" name="kuning" placeholder="kuning" >
	            			</div>
	            		</div>
            		</div>
            		<div class="row">
            			<div class="col-xs-4">
		            		<div class="form-gorup">
		            			<label>Peneumatic</label>
		            			<input id="peneumatic2" autocomplete="off" style="margin-bottom: 10px;width:100%;" class="form-control" name="peneumatic" required>
		            		</div>
		            	</div>
		            	<div class="col-xs-4">
		            		<div class="form-gorup">
		            			<label>Score</label>
		            			<input id="score2" autocomplete="off" style="margin-bottom: 10px;width:100%;" class="form-control" name="score" required>
		            		</div>
		            	</div>
		            </div>
		            <div class="row">
            			<div class="col-xs-6">
		            		<div class="form-gorup">
		            			<label>Pasar</label>
		            			<input id="pasar2" autocomplete="off" style="margin-bottom: 10px;" class="form-control" name="pasar">
		            		</div>
		            	</div>
		            	<div class="col-xs-6">
		            		<div class="form-gorup">
		            			<label>Nama Pedagang</label>
		            			<input id="nama_pedagang2" autocomplete="off" style="margin-bottom: 10px;" class="form-control" name="nama_pedagang">
		            		</div>
		            	</div>
		            </div>
            		<div class="form-group">
            			<label>Keterangan</label>
            			<input id="keterangan_potong2" autocomplete="off" style="width:50%;" class="form-control" name="keterangan_potong">
            		</div>
				</div>
	            <div class="modal-footer">
			        <button style="border-radius:25px;" id="simpan_jual2" class="btn btn-primary btn-sm"><i class="fa fa-save"> </i> Update</button>
			        <button style="border-radius:25px;" type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Batal</button>
			    </div>
			</form>
        </div>
    </div>
</div>
<div  class="modal fade" id="ModalPotong3" tabindex="-1" aria-labelledby="myModalLabel3" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel3">Update Hasil Pemotongan</h4>
            </div>
            <form style="margin-bottom:0;" action="<?php echo base_url(); ?>Pemotongan_sapi/update_hasil_potong" method="post">
            	<input id="id_penerimaan_detail3" type="hidden" name="id_penerimaan_detail" >
            	<div class="modal-body">					
            		<div class="form-gorup">
            			<label>Tgl. Potong</label>
            			<div class="row">
            				<div class="col-xs-4">
            					<input style="margin-bottom: 10px;" id="tgl33" class="form-control" name="tanggal_potong" placeholder="Tanggal Potong ..." required>
            				</div>
            				<div class="col-xs-3">
            					<input id="jam3" class="form-control" style="margin-bottom: 20px;" type="text" name="jam_potong" placeholder="Jam Potong .." required>
            				</div>
						</div>
            		</div>
            		<div class="form-gorup">
            			<label>RFID</label>
            			<div class="row">
            				<div class="col-xs-6">
            					<input id="rfid3"  class="form-control" name="rfid" required>
            				</div>
            				<div class="col-xs-6">
            					<input type="checkbox" value="1" name="flag" /> <span class="lbl">RFID Tidak Sesuai</span>
            				</div>
            				<div class="col-xs-6">
            					<input type="checkbox" value="1" name="flag1" /> <span class="lbl">RFID Hilang</span>
            				</div>
            			</div>
            		</div>
					<div style="background:red;padding:10px;" class="form-gorup">
						<label>Berat Karkas/Prosot tidak bisa diinput karena jenis berat belum didefinisikan</label>
					</div>
            		<div class="form-gorup">
            			<label>Power Load</label>
            			<div class="row">
	            			<div class="col-xs-2">
	            				<input id="merah3" style="margin-bottom: 10px;" class="form-control" name="merah" placeholder="merah" >
	            			</div>
	            			<div class="col-xs-2">
	            				<input id="orange3"  style="margin-bottom: 10px;" class="form-control" name="orange" placeholder="orange" >
	            			</div>
	            			<div class="col-xs-2">
	            				<input id="hitam3"  style="margin-bottom: 10px;" class="form-control" name="hitam" placeholder="hitam" >
	            			</div>
	            			<div class="col-xs-2">
	            				<input id="kuning3"  style="margin-bottom: 10px;" class="form-control" name="kuning" placeholder="kuning" >
	            			</div>
	            		</div>
            		</div>
            		<div class="row">
            			<div class="col-xs-2">
		            		<div class="form-gorup">
		            			<label>Peneumatic</label>
		            			<input id="peneumatic3" style="margin-bottom: 10px;" class="form-control" name="peneumatic" required>
		            		</div>
		            	</div>
		            	<div class="col-xs-2">
		            		<div class="form-gorup">
		            			<label>Score</label>
		            			<input id="score3" style="margin-bottom: 10px;" class="form-control" name="score" required>
		            		</div>
		            	</div>
		            </div>
		            <div class="row">
            			<div class="col-xs-6">
		            		<div class="form-gorup">
		            			<label>Pasar</label>
		            			<input id="pasar3" style="margin-bottom: 10px;" class="form-control" name="pasar">
		            		</div>
		            	</div>
		            	<div class="col-xs-6">
		            		<div class="form-gorup">
		            			<label>Nama Pedagang</label>
		            			<input id="nama_pedagang3" style="margin-bottom: 10px;" class="form-control" name="nama_pedagang">
		            		</div>
		            	</div>
		            </div>
            		<div class="form-group">
            			<label>Keterangan</label>
            			<input id="keterangan_potong3" style="width:50%;" class="form-control" name="keterangan_potong">
            		</div>
				</div>
	            <div class="modal-footer">
			        <button style="border-radius:25px;" id="simpan_jual3" class="btn btn-primary btn-sm"><i class="fa fa-save"> </i> Update</button>
			        <button style="border-radius:25px;" type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Batal</button>
			    </div>
			</form>
        </div>
    </div>
</div>