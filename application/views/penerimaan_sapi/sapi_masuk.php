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
				<div class="row">
					<div class="col-md-8">
						<select style="width:60%;font-weight: bold;font-size: 1.2em;" id="pilih_masuk" class="select2" name="pilih_pengiriman">
							<?php echo $combo_pengiriman; ?>
						</select>
					</div>
				</div>
				<hr/ style="margin-top: 10px; margin-bottom: 30px;">
<?php if($this->session->flashdata('success')) { ?>
                    <div class="alert alert-success alert-dismissible fade in" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                      <?php echo $this->session->flashdata('success'); ?>
                    </div> 
 <?php } ?>
				<table class="table table-striped table-bordered table-hover" >
							<thead>
								<tr>
									<th>RFID</th>									
									<th>Nota</th>
									<th>Berat</th>
									<th>Customer</th>
									<th>No.Kendaraan</th>
									<th>Status</th>
								</tr> 
							</thead>
							<tbody>
	<?php
		if($sapi_masuk != null) { 
			$no = 1;
			$total_sapi = 0;
			$total_sapi_hidup = 0;
			foreach($sapi_masuk->result_array() as $data) { 
				$total_sapi += $no; 
				if($data['status_potong']<=0){
					$total_sapi_hidup += $no;
				}
				?>
									<tr>
										<td><?php echo $data['rfid']; ?></td>									
										<td><?php echo $data['nota']; ?></td>
										<td><?php echo $data['berat']; ?></td>
										<td><?php echo $data['customer']; ?></td>
										<td><?php echo $data['no_kendaraan']; ?></td>
										<td>
											<?php 
											if($data['intransit']==0){
												if($data['status_potong']==0){
													echo "Tersedia";
												}else{
													echo "Sudah Dipotong";
												}
											}else{
												echo "Sudah Dimutasi"; 
											}?>
										</td>
									</tr> 
		<?php 
			}
		 ?>
							</tbody>	
							<tfoot>
								<tr>
									<td colspan="2"><strong>Total Jumlah Sapi : </strong></td>
									<td><strong><?php echo $total_sapi; ?></strong></td>
									<td colspan="2"><strong>Total Jumlah Sapi Hidup : </strong></td>
									<td><strong><?php echo $total_sapi_hidup; ?></strong></td>
								</tr>
							</tfoot>	
		<?php } ?>					
						</table>
			</div>
		</div>
	</div>
</div>