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
				<table id="sample-table-2" class="table table-striped table-bordered table-hover">
					<thead>
						<tr>
							<th style="width:50px;">No</th>
							<th>No.Pengiriman</th>
							<th>Tanggal Kirim</th>
							<th>Jam</th>
							<th>Asal Sapi</th>
							<th>Jumlah Sapi</th>
							<th>Ket.Pengiriman</th>
							<th>Tanggal Terima</th>
							<th>Jam Terima</th>
							<th>Ket.Penerimaan</th>
							<th>Lama Perjalanan</th>
							<th>Action</th>
						</tr>
					</thead>
	<?php
		$no = 1;
		foreach($penerimaan_sapi->result_array() as $data) { 
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
							<td><?php echo $data['asal_sapi']; ?></td>
							<td><?php echo $q1->hitung_sapi; ?></td>
							<td><?php echo $data['keterangan']; ?></td>
							<td><?php echo $data['tanggal_terima']; ?></td>
							<td><?php echo date('H:i', strtotime($data['jam_terima'])); ?></td>
							<td><?php echo $data['keterangan_terima']; ?></td>
							<td><?php echo str_pad($jam, 2, "0", STR_PAD_LEFT).':'.str_pad(floor( $menit / 60 ), 2, "0", STR_PAD_LEFT); ?></td>
							<td style="text-align:center;">
								<?php if($q->hitung_sapi > 0){?>
									<a id="penerimaan_sapi" class="btn btn-sm btn-primary" href="" data-id_pengiriman="<?php echo $data['id_pengiriman']; ?>" data-tanggal_terima="<?php echo $data['tanggal_terima']; ?>" data-jam_terima="<?php echo $data['jam_terima']; ?>" data-keterangan_terima="<?php echo $data['keterangan_terima']; ?>" data-toggle="modal"><span class="fa fa-list-alt"> </span> Detail</a>
								<?php }else if($q->hitung_sapi <= 0){ ?>
									<a id="penerimaan_sapi" disabled class="btn btn-sm btn-normal" href="" data-id_pengiriman="<?php echo $data['id_pengiriman']; ?>" data-tanggal_terima="<?php echo $data['tanggal_terima']; ?>" data-jam_terima="<?php echo $data['jam_terima']; ?>" data-keterangan_terima="<?php echo $data['keterangan_terima']; ?>" data-toggle="modal"><span class="fa fa-lock"> </span> Detail</a>
								<?php } ?>
							</td>
						</tr>
<?php 	$no++; } ?>

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
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Data Penerimaan Sapi</h4>
            </div>
            <form style="margin-bottom:0;" action="<?php echo base_url(); ?>penerimaan_sapi/save_terima" method="post"/>
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