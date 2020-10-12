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
							<th>Dikirim Dari</th>
							<th>Tujuan</th>
							<th>Waktu Kirim</th>
							<th>Waktu Terima</th>
							<th>Lama Perjalanan</th>
							<th>Jumlah Sapi</th>
							<th>Action</th>
						</tr>
					</thead>
	<?php
		$no = 1;
		foreach($pemotongan_sapi->result_array() as $data) { 
			if($data['konfirmasi'] == 0) {
				$bg = 'style="background:#F89406;"';
			} else if($data['konfirmasi'] == 1){
				$bg = 'style="background:#2ECC71;"';
			}
		?>
						<tr <?php echo $bg; ?>>
							<td><?php echo $no; ?></td>
							<td><?php echo $data['move_from']; ?></td>
							<td><?php echo $data['move_to']; ?></td>
							<td><?php echo $data['tanggal_kirim']; echo $data['jam_kirim']; ?></td>
							<td><?php echo $data['tanggal_terima']; echo $data['jam_terima']; ?></td>
							<td><?php echo $data['banyak_sapi']; ?></td>
							<td><?php echo $data['banyak_sapi']; ?></td>
							<td style="text-align:center;">
								<?php if($data['konfirmasi'] == 0){?>
									<a id="laporan_Accept" class="btn btn-sm btn-primary" href="" data-log="<?php echo $data['id_pengiriman']; ?>" 
									data-toggle="modal"><span class="fa fa-check"> </span> Konfirmasi</a>
								<?php }else if($data['konfirmasi'] == 1){?>
									<a id="laporan_Batal" class="btn btn-sm btn-danger" href="" data-log="<?php echo $data['id_pengiriman']; ?>" 
									data-toggle="modal"><span class="fa fa-close"> </span> Batalkan</a>
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


<div  class="modal fade" id="ModalAccept" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Data Pemotongan Sapi</h4>
            </div>
            <form style="margin-bottom:0;" action="<?php echo base_url(); ?>Laporan_pengerjaan_awo/save_terima" method="post"/>
            	<input id="log" type="hidden" name="log" >
				<center>
	          			<a style="margin-bottom:20px;" class="btn btn-primary btn-sm" onclick="exportKonfirmasiPemotonganSapi('xls');" href="javascript://"><span class="glyphicon glyphicon-export"> </span> Export to Excell</a>
	          	</center>
            	<div class="modal-body" style="height: 350px;overflow-y: scroll;">					
            		<div >
						<table id="Konfirmasi_table" class="tbl_lapor table-bordered"></table>
					</div>
				</div>

	            <div class="modal-footer">
	            	<div class="row">
	            		<div class="col-md-12 text-right">
			        		<button style="border-radius:25px;" id="simpan_jual" class="btn btn-primary btn-sm"><i class="fa fa-check"> </i> Konfirmasi</button>
			        		</form>
			        	</div>
					</div>
			    </div>
        </div>
    </div>
</div>

<div  class="modal fade" id="ModalCancle" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Data Pemotongan Sapi</h4>
            </div>
            <form style="margin-bottom:0;" action="<?php echo base_url(); ?>Laporan_pengerjaan_awo/save_batal" method="post"/>
            	<input id="log1" type="hidden" name="log" >

				<center>
	          			<a style="margin-bottom:20px;" class="btn btn-primary btn-sm" onclick="exportBatalPemotonganSapi('xls');" href="javascript://"><span class="glyphicon glyphicon-export"> </span> Export to Excell</a>
	          	</center>

            	<div class="modal-body" style="height: 350px;overflow-y: scroll;">					
            		<div >
						<table id="Batal_table" class="tbl_lapor1 table-bordered"></table>
					</div>
				</div>

	            <div class="modal-footer">
	            	<div class="row">
	            		<div class="col-md-12 text-right">
			        		<button style="border-radius:25px;" id="simpan_jual" class="btn btn-primary btn-sm"><i class="fa fa-close"> </i> Batalkan Konfirmasi</button>
			        		</form>
			        	</div>
					</div>
			    </div>
        </div>
    </div>
</div>