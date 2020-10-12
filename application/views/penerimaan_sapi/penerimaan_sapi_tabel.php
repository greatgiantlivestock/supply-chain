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
				<div class="row" style="margin-bottom: 20px;">
					<div class="col-md-6">
						<form action="<?php echo base_url(); ?>Penerimaan_sapi/upload_potong" method="post" enctype="multipart/form-data">
							<table style="border: 1px solid #ccc;">
								<tr>
									<td colspan="2"style="width: 120px;padding: 15px 0 15px 10px;">Upload CSV</td>
								</tr>
								<tr>
									<td style="width: 120px;padding: 15px 0 15px 10px;"><input style="width: 180px;" type="file" name="file_upload" required></td>
									<td style="padding: 15px 10px 15px 0"><button style="border-radius:25px;" class="btn btn-danger btn-sm"><i class="fa fa-upload"> </i> Upload CSV</button>
								</tr>
							</table>	
						</form>
					</div>
				</div>
				<?php if($this->session->flashdata('success')) { ?>
                    <div class="alert alert-success alert-dismissible fade in" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                      <?php echo $this->session->flashdata('success'); ?>
                    </div> 
 				<?php }else if($this->session->flashdata('error')){?>
					<div class="alert alert-danger alert-dismissible fade in" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                      <?php echo $this->session->flashdata('error'); ?>
                    </div> 
				<?php }?>
				<table width="100%" id="dttble1" class="table table-striped table-bordered table-hover"data-page-length='100'>
					<thead>
						<tr>
							<th>No.Pengiriman</th>
							<th>Tanggal Kirim</th>
							<th>Jam</th>
							<th>Asal Sapi</th>
							<th>Tujuan</th>
							<th>Jumlah Sapi</th>
							<th>Ket.Penerimaan</th>
							<th>Tanggal Terima</th>
							<th>Jam Terima</th>
							<th>Lama Perjalanan</th>
							<th>Action</th>
						</tr>
					</thead>
	<?php
		$no = 1;
		foreach($penerimaan_sapi->result_array() as $data) { 
			$q = $this->db->query("SELECT COUNT(*) AS hitung_sapi,id_pengiriman_detail FROM pengiriman_detail WHERE id_pengiriman='$data[id_pengiriman]' AND status_terima = '0'")->row();
			// $q1 = $this->db->query("SELECT COUNT(*) AS hitung_sapi,id_pengiriman_detail FROM pengiriman_detail WHERE id_pengiriman='$data[id_pengiriman]'")->row();
			if($q->hitung_sapi > 0) {
				$bg = 'style="background:#F89406;"';
			// } else {
			// 	$bg = 'style="background:#2ECC71;"';
			// }
			$kirim = strtotime($data['tanggal_kirim']." ".$data['jam_kirim']);
			$terima = strtotime($data['tanggal_terima']." ".$data['jam_terima']);
			$selisih = $terima - $kirim;
			$jam = floor($selisih / (60 * 60));
			$menit = $selisih - $jam * (60 * 60);
		?>
						<tr <?php echo $bg; ?>>
							<td><?php echo $data['no_pengiriman']; ?></td>
							<td><?php echo $data['tanggal_kirim']; ?></td>
							<td><?php echo date('H:i', strtotime($data['jam_kirim'])); ?></td>
							<td><?php echo $data['move_from']; ?></td>
							<td><?php echo $data['move_to']; ?></td>
							<td><?php if($q->hitung_sapi<=0){echo $data['jml'];}else{echo $q->hitung_sapi;} ?></td>
							<td><?php echo $data['keterangan']; ?></td>
							<td><?php if($q->hitung_sapi > 0){echo "0000-00-00";}else{echo $data['tanggal_terima'];} ?></td>
							<td><?php if($q->hitung_sapi > 0){echo "00:00";}else{echo date('H:i', strtotime($data['jam_terima']));} ?></td>
							<td><?php echo str_pad($jam, 2, "0", STR_PAD_LEFT).':'.str_pad(floor( $menit / 60 ), 2, "0", STR_PAD_LEFT); ?></td>
							<td style="text-align:center;">
								<?php if($q->hitung_sapi > 0){?>
									<a style="border-radius:25px;" id="penerimaan_sapi" class="btn btn-sm btn-primary" href="" data-id_pengiriman="<?php echo $data['id_pengiriman']; ?>" data-tanggal_terima="<?php echo $data['tanggal_terima']; ?>" data-jam_terima="<?php echo $data['jam_terima']; ?>" data-keterangan_terima="<?php echo $data['keterangan_terima']; ?>" data-toggle="modal"><span class="fa fa-list-alt"> </span> Detail</a>
								<?php }else if($q->hitung_sapi <= 0){ ?>
									<a style="border-radius:25px;" id="penerimaan_sapi" disabled class="btn btn-sm btn-normal" href="" data-id_pengiriman="<?php echo $data['id_pengiriman']; ?>" data-tanggal_terima="<?php echo $data['tanggal_terima']; ?>" data-jam_terima="<?php echo $data['jam_terima']; ?>" data-keterangan_terima="<?php echo $data['keterangan_terima']; ?>" data-toggle="modal"><span class="fa fa-lock"> </span> Detail</a>
								<?php } ?>
							</td>
						</tr>
		<?php }
			$no++; 
		} ?>
					<tbody>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
 <div  class="modal fade" id="ModalKonfirmasi" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button style="border-radius:25px;" type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Data Penerimaan Sapi</h4>
            </div>
            <form style="margin-bottom:0;" action="<?php echo base_url(); ?>Penerimaan_sapi/save_terima" method="post">
            	<input id="id_pengiriman" type="hidden" name="id_pengiriman" >
            	<div class="modal-body" style="height: 350px;overflow-y: scroll;">					
            		<div class="row" style="margin-bottom: 10px;">
            			<div class="col-md-4">
            				<input id="tgl" class="form-control tanggal_terima" type="text" name="tanggal_terima" placeholder="Tanggal Terima .." required>
            			</div>
            			<div class="col-md-3">
            				<input id="jam" class="form-control jam_terima" type="text" name="jam_terima" placeholder="Jam Terima .." required>
            			</div>
            		</div>
            		<input class="form-control keterangan_terima" style="width:60%;margin-bottom: 20px;" type="text" name="keterangan_terima" placeholder="Keterangan Terima ..">
            		<div id="data_pengiriman"></div>
				</div>
	            <div class="modal-footer">
	            	<div class="row">
	            		<div class="col-md-12 text-right">
			        		<button style="border-radius:25px;" id="simpan_jual" class="btn btn-primary btn-sm"><i class="fa fa-check"> </i> Terima</button>
			        		</form>
			        	</div>
			        	<!--
			        	<div class="col-md-2">
					        <form action="<?php echo base_url(); ?>penerimaan_sapi/save_batal" method="post" />
		            			<input id="id_pengiriman2" type="hidden" name="id_pengiriman" >
					        	<button  class="btn btn-danger btn-sm"><i class="fa fa-times"> </i> Batal Terima</button>
					        </form>
					    </div> -->
					</div>
			    </div>
        </div>
    </div>
</div>