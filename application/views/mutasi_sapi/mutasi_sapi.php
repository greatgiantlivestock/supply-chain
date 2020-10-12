<!-- <script type="text/javascript">
	$(function(){
		$.ajaxSetup({
			type:"POST",
			url: "<?php echo base_url('Mutasi_sapi/ambil_data') ?>",
			cache: false,
		});
		$("#pilih_stock").change(function(){
			var value=$(this).val();
			if(value!=""){
				$.ajax({
					data:{
						modul:'asal_sapi',nota:value
					},
					success: function(respond){
						$("#pilih_asal_sapi").val(respond);
						console.log("data respon :"respond);
					}
				})
			}
		});
	})
</script> -->
<script>
	$(document).ready(function(){
		div_file.style.display = 'none'
		div_nota.style.display = 'inline'
		file_input.disabled='true'
		male.checked="checked"
	});
	function hide_nota(val){
		div_nota.style.display = 'none'
		div_file.style.display = 'inline'
		pilih_stock.disabled='true'
		$("#file_input").removeAttr('disabled');
		$("#tb_modal").find("tr").remove();
		$("#pilih_stock").val("Pilih").change();
	}
	function hide_file(val){
		div_nota.style.display = 'inline'
		div_file.style.display = 'none'
		file_input.disabled='true'
		$("#pilih_stock").removeAttr('disabled');
	}
</script>

<div class="col-md-12">					    
	<div class="widget-box">
		<div class="widget-header header-color-red">
			<h5 class="bigger lighter">
				<i class="fa fa-table"></i>
				<b><?php echo $judul; ?></b>
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
				<!-- <form action="<?php echo base_url(); ?>mutasi_sapi/save_mutasi" method="post" enctype="multipart/form-data">
				<input type="hidden" name="tipe" value="<?php echo $tipe; ?>">
				<input type="hidden" name="id_pengiriman" value="<?php echo $id_pengiriman; ?>">

					<div class="row">
						<div class="col-md-8">
						
							<button  class="btn btn-primary btn-sm"><i class="fa fa-refresh"> </i> <?php echo $name_button; ?></button>
							<a style="margin-left:20px;" class="btn btn-danger btn-sm" href="<?php echo base_url().'pengiriman_sapi/hapus/'.$id_pengiriman; ?>" onclick="return confirm('Yakin ingin hapus data ?');"><i class="fa fa-trash"> </i> Hapus</a>	

							<?php echo $btn_batal."<br/><br/>"; ?>			

						<?php if($status_terima == '1') {

							$kirim = strtotime($tanggal_kirim." ".$jam_kirim);
							$terima = strtotime($tanggal_terima." ".$jam_terima);
							$selisih = $terima - $kirim;
							$jam = floor($selisih / (60 * 60));
							$menit = $selisih - $jam * (60 * 60);
							echo '<a style="color:red;">Telah Diterima Oleh RPH Tanggal '.$tanggal_terima.' <b>(Lama Perjalanan '.str_pad($jam, 2, "0", STR_PAD_LEFT).':'.str_pad(floor( $menit / 60 ), 2, "0", STR_PAD_LEFT).')</b></a>';
						} ?>	
						</div>
						<div class="col-md-4">
							<select style="width:60%;font-weight: bold;font-size: 1.2em;" id="pilih_pengiriman" class="select2" name="pilih_pengiriman">
								<?php echo $combo_pengiriman; ?>
							</select>
						</div>
					</div>
				</form>
				<hr style="margin-top:0px"> -->

				<div class="row" style="margin-bottom: 20px;">
					<div class="col-md-6">
						<a style="border-radius:25px;" style="margin-bottom:10px;" id="mutasi_sapi" class="btn btn-sm btn-primary" 
						 data-toggle="modal"><span class="fa fa-plus"> </span> Add</a>
					</div>
				</div>

			<form style="margin-bottom:0;" action="<?php echo base_url(); ?>mutasi_sapi/kirim_sapi" method="post"/>

						<table id="dttble3" class="table table-striped table-bordered table-hover">
					<thead>
						<tr>
							<th style="width:50px;">No</th>
							<th>No.Pengiriman</th>
							<th>Tanggal Kirim</th>
							<th>Jam</th>
							<th>Dikirim Dari</th>
							<th>Dikirim Ke</th>
							<th>Jumlah Sapi</th>
							<th>Ket.Pengiriman</th>
							<th>Tanggal Terima</th>
							<th>Jam Terima</th>
							<th>Ket.Penerimaan</th>
							<!-- <th>Lama Perjalanan</th> -->
							<th>Action</th>
						</tr>
					</thead>
	<?php
		$no = 1;
		foreach($sapi_masuk->result_array() as $data) { 
			$q = $this->db->query("SELECT COUNT(*) AS hitung_sapi,id_pengiriman_detail FROM pengiriman_detail WHERE id_pengiriman='$data[id_pengiriman]' AND status_terima = '0'")->row();
			$q1 = $this->db->query("SELECT COUNT(*) AS hitung_sapi,id_pengiriman_detail FROM pengiriman_detail WHERE id_pengiriman='$data[id_pengiriman]'")->row();
			if($q->hitung_sapi > 0) {
				$bg = 'style="background:#F89406;"'; 
			} else {
				$bg = 'style="background:#2ECC71;"';
			}

			$kirim = strtotime($data['tanggal_kirim']." ".$data['jam_kirim']);
			$terima = strtotime($data['tanggal_terima']." ".$data['jam_terima']);
			$selisih = $terima - $kirim;
			$jam = floor($selisih / (60 * 60));
			$menit = $selisih - $jam * (60 * 60);
		?>
						<tr <?php echo $bg; ?>>
							<td><?php echo $no; ?></td>
							<td><?php echo $data['no_pengiriman']; ?></td>
							<td><?php echo $data['tanggal_kirim']; ?></td>
							<td><?php echo date('H:i', strtotime($data['jam_kirim'])); ?></td>
							<td><?php echo $data['move_from']; ?></td>
							<td><?php echo $data['move_to']; ?></td>
							<td><?php echo $q1->hitung_sapi; ?></td>
							<td><?php echo $data['keterangan']; ?></td>
							<td><?php echo $data['tanggal_terima']; ?></td>
							<td><?php echo date('H:i', strtotime($data['jam_terima'])); ?></td>
							<td><?php echo $data['keterangan_terima']; ?></td>
							<!-- <td><?php echo str_pad($jam, 2, "0", STR_PAD_LEFT).':'.str_pad(floor( $menit / 60 ), 2, "0", STR_PAD_LEFT); ?></td> -->
							<td style="text-align:center;">
								<?php if($q->hitung_sapi > 0){?>
									<a style="border-radius:25px;" id="detail_mutasi" class="btn btn-sm btn-primary" href="" data-id_pengiriman="<?php echo $data['id_pengiriman']; ?>" data-tanggal_terima="<?php echo $data['tanggal_terima']; ?>" data-jam_terima="<?php echo $data['jam_terima']; ?>" data-keterangan_terima="<?php echo $data['keterangan_terima']; ?>" data-toggle="modal"><span class="fa fa-list-alt"> </span> Detail</a>
								<?php }else if($q->hitung_sapi <= 0){ ?>
									<a style="border-radius:25px;" id="detail_mutasi" class="btn btn-sm btn-primary" href="" data-id_pengiriman="<?php echo $data['id_pengiriman']; ?>" data-tanggal_terima="<?php echo $data['tanggal_terima']; ?>" data-jam_terima="<?php echo $data['jam_terima']; ?>" data-keterangan_terima="<?php echo $data['keterangan_terima']; ?>" data-toggle="modal"><span class="fa fa-list-alt"> </span> Detail</a>
								<?php } ?>
							</td>
						</tr>
					<?php 	$no++; } ?>
				</table>
						</div>
			</form>
			</div>
		</div>
	</div>
</div>

<div  class="modal fade" id="ModalMutasiSapi" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Mutasi Sapi</h4>
				</div>
				<form style="margin-bottom:0;" action="<?php echo base_url(); ?>Mutasi_sapi/tambah_mutasi" method="post" enctype="multipart/form-data">
					<input id="id_pengiriman" type="hidden" name="id_pengiriman" >
					
					<table style="margin-left:10px;" class="tbl_input">
						<tr>
							<td>
								<input style="width: 50%;<?php echo $color; ?>" id="tgl" class="form-control " type="text" placeholder="Tanggal Kirim" name="tanggal_kirim" value="<?php echo $tanggal_kirim; ?>" required>		
							</td>
							<td>
								<input style="width: 40%;<?php echo $color; ?>" id="jam" class="form-control " type="text" placeholder="Jam Kirim" name="jam_kirim" value="<?php echo $jam_kirim; ?>" required>		
							</td>
						</tr>
						<tr>
							<td>
								<select style="width:90%;<?php echo $color; ?>" class="select_rph" name="id_rph" required>
									<?php echo $combo_rph; ?>
								</select>		
							</td>
							<td>
								<input style="width: 90%;<?php echo $color; ?>" class="form-control " type="text" placeholder="Keterangan" name="keterangan" value="<?php echo $keterangan; ?>">		
							</td>
						</tr>
						<tr>
							<td>
								<input onclick="hide_file();" type="radio" id="male" name="gender" value="male">
								<label style="margin-right:10px;" for="male">By Nota</label>
								<input onclick="hide_nota();" type="radio" id="female" name="gender" value="female">
								<label for="female">By Upload File</label>
							</td>
						</tr>
						<tr>																			
							<td id="div_nota">
								<select style="width:90%;<?php echo $color; ?>" class="select_rph" id="pilih_stock" name="nota" required>
									<?php echo $combo_stock; ?>
								</select>		
							</td>	
							<td id="div_file"><input id='file_input' style="width: 180px;" type="file" name="file_upload" required></td>					
							<!-- <td>
								<select style="width: 60%; <?php echo $color; ?>" id="pilih_asal_sapi" class="form-control " name="asal_sapi" readonly>
									<option value>Pilih Asal Sapi</option>
									<option value="GGL" <?php if($asal_sapi == 'GGL') { echo 'selected'; } ?>>GGL</option>
									<option value="NTF" <?php if($asal_sapi == 'NTF') { echo 'selected'; } ?>>NTF</option>
									<option value="PO" <?php if($asal_sapi == 'PO') { echo 'selected'; } ?>>PO</option>
								</select>		
							</td>						 -->
						</tr>							
					</table>

					<div class="modal-body" style="height: 300px;overflow-y: scroll;">					
						<div id="data_pengiriman"></div>
					</div>

					<div class="modal-footer">
						<div class="row">
							<div class="col-md-12 text-right">
								<button style="border-radius:25px;" id="simpan_jual" class="btn btn-primary btn-sm"><i class="fa fa-check"> </i> Tambahkan</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
</div>

<div  class="modal fade" id="ModalDetailMutasi" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Detail Mutasi Sapi</h4>
				</div>
				<form style="margin-bottom:0;" action="<?php echo base_url(); ?>mutasi_sapi/tambah_mutasi" method="post"/>
					<input id="id_pengiriman" type="hidden" name="id_pengiriman" >

					<div class="modal-body" style="height: 300px;overflow-y: scroll;">					
						<div id="detail_mutasi_sapi"></div>
					</div>

					<div class="modal-footer">
						<div class="row">
							<div class="col-md-12 text-right">
								<button style="border-radius:25px;" class="btn btn-primary btn-sm" data-dismiss="modal"><i class="fa fa-check"> </i> close</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
</div>
