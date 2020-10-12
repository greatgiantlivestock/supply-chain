<div class="col-md-12">	
	<div class="page-header">
		<h1>
			<i class="fa fa-list-alt"></i>
			<?php echo $judul; ?>
		</h1>
	</div><!-- /.page-header -->

	<div style="margin-bottom:20px;margin-top:40px;" class="row">
		<form class="form-horizontal" action="<?php echo base_url(); ?>absen/lihat_laporan_absen" method="post"/>
	<div class="col-sm-6">
				<table class="tbl_input">
					<tr>
						<td style="width: 100px;">
							Tanggal
						</td>
						<td>
							<div class="input-group">
								<span class="input-group-addon">
									<i class="fa fa-calendar bigger-110"></i>
								</span>
								<input  id="tgl" class="form-control " type="text" name="tanggal1" value="<?php echo $tanggal1; ?>" required>
							</div>
						</td>
						<td style="width: 30px;"><center>s/d</center></td>
						<td>
							<div class="input-group">
								<span class="input-group-addon">
									<i class="fa fa-calendar bigger-110"></i>
								</span>
								<input  id="tgl2" class="form-control " type="text" name="tanggal2" value="<?php echo $tanggal2; ?>" required>
							</div>
						</td>
					</tr>
					<tr>
						<td>
							AWO
						</td>
						<td>
							<select style="width: 100%;" name="nama_awo" class="select_awo">
								<?php echo $combo_awo; ?>
							</select>
						</td>					
					</tr>			
				</table>
			</div>
			<div style="margin-top:15px;" class="col-md-12">
				<button class="btn btn-danger btn-sm" name="cari_report"><i class="fa fa-external-link"> </i> Lihat Report</button>
			<hr/>
			</div>
		</form>
	</div>

	<div class="row">
		<div class="col-xs-12">

	 				<center>
	          			<a style="margin-bottom:20px;" class="btn btn-primary btn-sm" onclick="exportAbsenAwo('xls');" href="javascript://"><span class="glyphicon glyphicon-export"> </span> Export to Excell</a>
	          		</center>

	          		<p style="margin-bottom: 0;">LAPORAN KONDISI ASSET </p>
	          		<p style="font-weight:bold;">PER TANGGAL : <?php echo $tanggal1.' s/d '.$tanggal2; ?></p>
					<table class="table table-striped table-bordered table-hover">
						<thead>
							<tr>
								<th style="background: #22313F;color:#fff;width:50px;">No</th>
								<th style="background: #22313F;color:#fff;">Tanggal</th>
								<th style="background: #22313F;color:#fff;">Nama AWO</th>
								<th style="background: #22313F;color:#fff;">RPH</th>
								<th style="background: #22313F;color:#fff;">Jam Masuk</th>
								<th style="background: #22313F;color:#fff;">Jam Pulang</th>
								<th style="background: #22313F;color:#fff;">Keterangan</th>
								<th style="background: #22313F;color:#fff;">View</th>
							</tr>
						</thead>

						<tbody>
	<?php 
		if($this->uri->segment(2) == 'lihat_laporan_absen') {


		$begin = new DateTime($tanggal1);
		$end = new DateTime($tanggal2);

		$end = $end->modify( '+1 day' ); 
		$interval = new DateInterval('P1D');
		$period = new DatePeriod($begin, $interval, $end);
		$no = 1;  
		$i = 1;

		//CARI SELISIH//
		$awal = date_create($tanggal1);
		$akhir = date_create($tanggal2);
		$selisih = date_diff($awal,$akhir);
		$fix_selisih = $selisih->d + 1; 
		$q1 = $this->db->query("SELECT nama_awo,id_awo,nama_rph FROM mst_awo LEFT JOIN mst_rph ON mst_awo.id_rph = mst_rph.id_rph WHERE nama_awo LIKE '%$awo%' ORDER BY nama_awo ASC");		
		$length_awo = count($q1->result_array());
		foreach ($q1->result_array() as $data_awo) {
			foreach($period as $dt) {				
				$q2 = $this->db->query("SELECT jam,MAX(jam) as max_jam, MIN(jam) as min_jam FROM mst_absen WHERE id_awo='$data_awo[id_awo]' AND tanggal = '".$dt->format( "Y-m-d" )."'")->row();

				$q3 = $this->db->query("SELECT jam,lat,lng FROM mst_absen WHERE id_awo='$data_awo[id_awo]' AND tanggal = '".$dt->format( "Y-m-d" )."'");
				$data_q3 = $q3->row();

				if(empty($q2->jam)) {
					$keterangan_absen = 'Alpa';
				} else if(count($q3->result_array()) == 1) {
					$keterangan_absen = 'Absen Kurang';
				} else {
					$keterangan_absen = "";
				}

		?>
						<tr>
							<td><?php echo $no; ?></td>
							<td><?php echo $dt->format( "Y-m-d" ); ?></td>
							<td><?php echo $data_awo['nama_awo']; ?></td>
							<td><?php echo $data_awo['nama_rph']; ?></td>
							<td><?php 
									if(empty($q2->jam)) {
										echo '-';					
									} else {
										echo date('H:i', strtotime($q2->min_jam)); 
									}
								?>								
							</td>
							<td><?php 
									if(empty($q2->jam) || count($q3->result_array()) == 1) {
										echo '-';							
									} else {
										echo date('H:i', strtotime($q2->max_jam)); 
									}
								?>								
							</td>
							<td><?php echo $keterangan_absen; ?></td>
							<td><?php if(empty($keterangan_absen)) {  ?><center><a id="viewMap" class="label label-primary" href="" data-toggle="modal" data-lat="<?php echo $data_q3->lat; ?>" data-lng="<?php echo $data_q3->lng; ?>"><i class="fa fa-map-marker"> </i> View</a></center> <?php } ?></td>
						</tr>
						<?php
							if ($i % $fix_selisih == 0) {
						        echo '<tr style="background:#ccc;"><td>&nbsp;</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>';
						    }
						?>
	<?php  $no++; $i++;  } ?>
	<?php  
		 } 
		} 
	?>
						</tbody>
					</table>
		</div>
	</div>
</div>



 <div  class="modal fade" id="ModalMap" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Koordinat AWO ABSEN</h4>
            </div>
            <form style="margin-bottom:0;" action="<?php echo base_url(); ?>penerimaan_sapi/save_terima" method="post"/>
            	<input id="id_pengiriman" type="hidden" name="id_pengiriman" >
            	<div class="modal-body" style="height: 350px;overflow-y: scroll;">					

            		<div id="data_map"></div>
			
				</div>

	
		   
        </div>
    </div>
</div>
