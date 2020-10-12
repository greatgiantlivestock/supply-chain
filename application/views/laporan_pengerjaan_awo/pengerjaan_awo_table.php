<script type="text/javascript">
    	$(document).on("click", "#laporkan_admin", function () {
    		var id_pengiriman = $(this).attr('data-id_pengiriman');
        	$.ajax({
							url: "<?php echo base_url(); ?>Laporan_pengerjaan_awo/get_pengiriman", 
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
<?php if($this->session->flashdata('success_update')) { ?>
                    <div class="alert alert-success alert-dismissible fade in" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                      <?php echo $this->session->flashdata('success'); ?>
                    </div> 
 <?php } ?>
 				<?php if($pemotongan_sapi_ggl_stts->result_array()==null){?>
					<a style="border-radius:25px;margin-bottom:25px;" id="laporkan_admin" disabled class="btn btn-sm btn-primary" href="" 
						data-toggle="modal"><span class="fa fa-send"> </span> Release</a>
				<?php }else if(!$pemotongan_sapi_ggl_stts->result_array()==null){?>
					<a style="border-radius:25px;margin-bottom:25px;" id="laporkan_admin" class="btn btn-sm btn-primary" href="" 
						data-toggle="modal"><span class="fa fa-send"> </span> Release</a>
				<?php }?>
				<table id="sample-table-2" class="table table-striped table-bordered table-hover">
					<thead>
						<tr>
							<th style="width:50px;">No</th>
							<th>Waktu Laporan</th>
							<th>Log</th>
							<th>RPH</th>
							<th>Nama AWO</th>
							<th>Jumlah Sapi</th>
							<th>Action</th>
						</tr>
					</thead>
	<?php
		$no = 1;
		foreach($pemotongan_sapi->result_array() as $data) { 
			// $log=$data['log'];
			// $q = $this->db->query("SELECT status FROM pemotongan_log WHERE log='$log'")->row();
			// $q1 = $this->db->query("SELECT COUNT(*) AS hitung_sapi,id_pengiriman_detail FROM pengiriman_detail WHERE id_pengiriman='$data[id_pengiriman]'")->row();
			if($data['status'] == 1) {
				$bg = 'style="background:#F89406;"';
			} else if($data['status'] == 2){
				$bg = 'style="background:#2ECC71;"';
			}else{
				$bg = '';
			}
		?>
						<tr <?php echo $bg; ?>>
							<td><?php echo $no; ?></td>
							<td><?php echo $data['tanggal_laporan']." ".$data['jam']; ?></td>
							<td><?php echo $data['log']; ?></td>
							<td><?php echo $data['nama_rph']; ?></td>
							<td><?php echo $data['nama_awo']; ?></td>
							<td><?php echo $data['c_log']; ?></td>
							<td style="text-align:center;">
								<?php if($data['status'] == 1){?>
									<a style="border-radius:25px" id="laporan_Accept" class="btn btn-sm btn-primary" href="" data-log="<?php echo $data['log']; ?>" 
									data-toggle="modal"><span class="fa fa-check"> </span> Konfirmasi</a>
								<?php }else if($data['status'] == 2){?>
									<a style="border-radius:25px" id="laporan_Batal" class="btn btn-sm btn-danger" href="" data-log="<?php echo $data['log']; ?>" 
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
			        		<button id="simpan_jual" class="btn btn-primary btn-sm"><i class="fa fa-close"> </i> Batalkan Konfirmasi</button>
			        		</form>
			        	</div>
					</div>
			    </div>
        </div>
    </div>
</div>
<div  class="modal fade" id="ModalLaporkan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Release Data Potong ke SAP</h4>
            </div>
            <form style="margin-bottom:0;" action="<?php echo base_url(); ?>Laporan_pengerjaan_awo/release" method="post">
            	<input id="id_pengiriman" type="hidden" name="id_pengiriman" >
            	<div class="modal-body" style="height: 350px;overflow-y: scroll;">					
            		<div id="data_pengiriman"></div>
				</div>
	            <div class="modal-footer">
	            	<div class="row">
	            		<div class="col-md-12 text-right">
			        		<button style="border-radius:25px;" id="simpan_jual" class="btn btn-primary btn-sm"><i class="fa fa-check"> </i> Release</button>
			        	</div>
					</div>
			    </div>
			</form>
        </div>
    </div>
</div>