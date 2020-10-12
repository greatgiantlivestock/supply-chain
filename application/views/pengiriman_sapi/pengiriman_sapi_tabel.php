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
				<form action="<?php echo base_url(); ?>pengiriman_sapi/save_upload" method="post" enctype="multipart/form-data">
					<input type="hidden" name="tipe" value="<?php echo $tipe; ?>">
					<input type="hidden" name="id_pengiriman" value="<?php echo $id_pengiriman; ?>">
					<table class="tbl_input">
						<tr>
							<td style="width:120px;">
								Tanggal Kirim
							</td>
							<td style="width: 500px;">
								<input style="width: 60%;<?php echo $color; ?>" id="tgl" class="form-control " type="text" placeholder="dd/mm/yyyy" name="tanggal_kirim" value="<?php echo $tanggal_kirim; ?>" required>		
							</td>							
							<td>
								Pilih File
							</td>
							<td>
								<input style="width: 100%;<?php echo $color; ?>" class="form-control " type="file" name="file_upload" <?php echo $required; ?>>		
							</td>
						</tr>
						<tr>
							<td>
								Jam Kirim
							</td>
							<td>
								<input style="width: 20%;<?php echo $color; ?>" id="jam" class="form-control " type="text" name="jam_kirim" value="<?php echo $jam_kirim; ?>" required>		
							</td>
							<td style="width:120px;">
								Asal Sapi
							</td>
							<td>
								<select style="width: 60%; <?php echo $color; ?>" class="form-control " name="asal_sapi" required>
									<!-- <option value>Pilih Asal Sapi</option>
									<option value="GGL" <?php if($asal_sapi == 'GGL') { echo 'selected'; } ?>>GGL</option>
									<option value="NTF" <?php if($asal_sapi == 'NTF') { echo 'selected'; } ?>>NTF</option>
									<option value="PO" <?php if($asal_sapi == 'PO') { echo 'selected'; } ?>>PO</option> -->
									<?php echo $combo_asal_sapi; ?>
								</select>		
							</td>							
						</tr>	
						<tr>
							<td>
								Kirim ke 
							</td>
							<td>
								<select style="width:80%;<?php echo $color; ?>" class="select_rph" name="id_rph" required>
									<?php echo $combo_rph; ?>
								</select>		
							</td>
							<td style="width:120px;">
								Keterangan
							</td>
							<td>
								<input style="width: 100%;<?php echo $color; ?>" class="form-control " type="text" name="keterangan" value="<?php echo $keterangan; ?>">		
							</td>
						</tr>							
					</table>

				<hr/>
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
									<th style="width: 5%;">Ear Tag</th>									
									<th style="width: 8%;">Shipment</th>									
									<th style="width: 10%;">RFID</th>									
									<th style="width: 5%;">Nota</th>
									<th style="width: 5%;">Berat</th>
									<th style="width: 15%;">Customer</th>
									<th style="width: 10%;">Material Description</th>
									<th style="width: 5%;">No.Kendaraan</th>
								</tr> 
							</thead>

							<tbody>
	<?php
		if($pengiriman_detail != null) { 
			$no = 1;
			$total_sapi = 0;
			foreach($pengiriman_detail->result_array() as $data) { 
				$total_sapi += $no; ?>
									<tr>
										<td style="width: 5%;"><?php echo $data['eartag']; ?></td>									
										<td style="width: 8%;"><?php echo $data['shipment']; ?></td>									
										<td style="width: 10%;"><?php echo $data['rfid']; ?></td>									
										<td style="width: 5%;"><?php echo $data['nota']; ?></td>
										<td style="width: 5%;"><?php echo $data['berat']; ?></td>
										<td style="width: 15%;"><?php echo $data['customer']; ?></td>
										<td style="width: 10%;"><?php echo $data['material_description']; ?></td>
										<td style="width: 5%;"><?php echo $data['no_kendaraan']; ?></td>
									</tr> 
		<?php 
			}
		 ?>
							</tbody>	
							<tfoot>
								<tr>
									<td colspan="8"><strong>Total Jumlah Sapi : <?php echo $total_sapi; ?></strong></td>
								</tr>
							</tfoot>	
		<?php } ?>					
						</table>
			</div>
		</div>
	</div>
</div>