					</div><!--/.row-fluid-->
				</div><!--/.page-content-->
			</div><!--/.main-content-->
		</div><!--/.main-container-->
			<!--basic scripts-->
		<script src="<?php echo base_url();?>asset/js/ace/elements.scroller.js"></script>
		<script src="<?php echo base_url();?>asset/js/ace/elements.colorpicker.js"></script>
		<script src="<?php echo base_url();?>asset/js/ace/elements.fileinput.js"></script>
		<script src="<?php echo base_url();?>asset/js/ace/elements.typeahead.js"></script>
		<script src="<?php echo base_url();?>asset/js/ace/elements.wysiwyg.js"></script>
		<script src="<?php echo base_url();?>asset/js/ace/elements.spinner.js"></script>
		<script src="<?php echo base_url();?>asset/js/ace/elements.treeview.js"></script>
		<script src="<?php echo base_url();?>asset/js/ace/elements.wizard.js"></script>
		<script src="<?php echo base_url();?>asset/js/ace/elements.aside.js"></script>
		<script src="<?php echo base_url();?>asset/js/ace/ace.js"></script>
		<script src="<?php echo base_url();?>asset/js/ace/ace.ajax-content.js"></script>
		<script src="<?php echo base_url();?>asset/js/ace/ace.touch-drag.js"></script>
		<script src="<?php echo base_url();?>asset/js/ace/ace.sidebar.js"></script>
		<script src="<?php echo base_url();?>asset/js/ace/ace.sidebar-scroll-1.js"></script>
		<script src="<?php echo base_url();?>asset/js/ace/ace.submenu-hover.js"></script>
		<script src="<?php echo base_url();?>asset/js/ace/ace.widget-box.js"></script>
		<script src="<?php echo base_url();?>asset/js/ace/ace.settings.js"></script>
		<script src="<?php echo base_url();?>asset/js/ace/ace.settings-rtl.js"></script>
		<script src="<?php echo base_url();?>asset/js/ace/ace.settings-skin.js"></script>
		<script src="<?php echo base_url();?>asset/js/ace/ace.widget-on-reload.js"></script>
		<script src="<?php echo base_url();?>asset/js/ace/ace.searchbox-autocomplete.js"></script>
		<script src="<?php echo base_url();?>asset/js/select2.js"></script>
		<script src="<?php echo base_url();?>asset/js/tableExport.js"></script>
		<script src="<?php echo base_url();?>vendor/datatables/js/jquery.dataTables.min.js"></script>
		<script src="<?php echo base_url();?>vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
		<script src="<?php echo base_url();?>vendor/datatables-responsive/dataTables.responsive.js"></script>
		<script type="text/javascript">
			$(document).ready(function() {
				$("#dttble1").DataTable({
					"dom":'<"toolbar">frtip',
					columns: [
						null,
						null,
						null,
						null,
						null,
						null,
						null,
						null,
						null,
						null,
						null
					],
					responsive: true,
					bPaginate: true,
					bLengthChange: false,
					bFilter: true,
					bInfo: false,
					bAutoWidth: false,
					order: [[ 0, "desc" ]]
				});
				$("#dttble2").DataTable({
					"dom":'<"toolbar">frtip',
					columns: [
						null,
						null,
						null,
						null,
						null,
						null,
						null,
						null,
						null,
						null,
						null
					],
					responsive: true,
					bPaginate: true,
					bLengthChange: false,
					bFilter: true,
					bInfo: false,
					bAutoWidth: false,
					order: [[ 0, "desc" ]]
				});
				$("#dttble3").DataTable({
					"dom":'<"toolbar">frtip',
					columns: [
						null,
						null,
						null,
						null,
						null,
						null,
						null,
						null,
						null,
						null,
						null,
						null
					],
					responsive: true,
					bPaginate: true,
					bLengthChange: false,
					bFilter: true,
					bInfo: false,
					bAutoWidth: false,
					order: [[ 0, "asc" ]]
				});
				$("#dttble4").DataTable({
					"dom":'<"toolbar">frtip',
					columns: [
						null,
						null,
						null,
						null,
						null,
						null,
						null
					],
					responsive: true,
					bPaginate: true,
					bLengthChange: false,
					bFilter: true,
					bInfo: false,
					bAutoWidth: false,
					order: [[ 0, "asc" ]]
				});
				$("#dttble5").DataTable({
					"dom":'<"toolbar">frtip',
					columns: [
						null,
						null,
						null,
						null,
						null,
						null,
						null,
						null,
						null,
						null,
						null,
						null,
						null,
						null,
						null,
						null,
						null,
						null,
						null,
						null,
						null,
						null
					],
					responsive: true,
					bPaginate: true,
					bLengthChange: false,
					bFilter: true,
					bInfo: false,
					bAutoWidth: false,
					order: [[ 0, "asc" ]]
				});
				$("#dttble6").DataTable({
					"dom":'<"toolbar">frtip',
					columns: [
						null,
						null,
						null,
						null,
						null,
						null,
						null,
						null,
						null
					],
					responsive: true,
					bPaginate: true,
					bLengthChange: false,
					bFilter: true,
					bInfo: false,
					bAutoWidth: false,
					order: [[ 0, "asc" ]]
				});
				$(".select_rph").select2();
				$(".select_barang").select2();
				$(".select_awo").select2();
				$(".select2").select2();
			});
		</script>
		<script type="text/javascript">
			$(function() {
				var oTable1 = $('#sample-table-2').dataTable();	
				var oTable2 = $('#sample-table-3').dataTable();		
				var oTable3 = $('#sample-table-4').dataTable();				
				var oTable4 = $('#sample-table-5').dataTable();				
			})
		</script>
		<script type="text/javascript">
		    $(function () {
		      $('#tgl').datetimepicker({
		        format: 'YYYY-MM-DD'
		      })
		       $('#tgl2').datetimepicker({
		        format: 'YYYY-MM-DD'
		      })
		      $('#tgl3').datetimepicker({
		        format: 'YYYY-MM-DD'
		      })
		      $('#tgl32').datetimepicker({
		        format: 'YYYY-MM-DD'
		      })
		      $('#tgl4').datetimepicker({
		        format: 'YYYY-MM-DD'
		      })
		      $('#jam').datetimepicker({
		        format: 'HH:mm'
		      })		        
		      $('#jam2').datetimepicker({
		        format: 'HH:mm'
		      })		        
		    });
  		</script>
        <script type="text/javascript">
        	$(document).on("click", "#ubah_kondisi", function () {
        		if($('.check').is(':checked')) { 
        			$('#awo_asset tr').filter(':has(:checkbox:checked)').each(function() {
		        			$tr = $(this);
		        			document.getElementById("nama_barang").value = $(this).attr('data-nama');
							document.getElementById("merk").value = $(this).attr('data-merk');
							document.getElementById("id_asset_awo").value = $(this).attr('data-id_asset_awo');
							document.getElementById("id_awo").value = $(this).attr('data-id_awo');
							document.getElementById("id_barang1").value = $(this).attr('data-id_barang');
					        $("#ModalKondisi").modal('show');					    
			    	});
        		} else {
        			alert('Pilih data terlebih dahulu');
        		}
        	});
        </script>
        <script type="text/javascript">
        	$(document).on("click", "#ubah_kondisi_rph", function () {
        		if($('.check').is(':checked')) { 
        			$('#rph_asset tr').filter(':has(:checkbox:checked)').each(function() {
	        			$tr = $(this);
	        			document.getElementById("nama_barang").value = $(this).attr('data-nama');
						document.getElementById("merk").value = $(this).attr('data-merk');
						document.getElementById("id_asset_rph").value = $(this).attr('data-id_asset_rph');
						document.getElementById("id_rph").value = $(this).attr('data-id_rph');
						document.getElementById("id_barang1").value = $(this).attr('data-id_barang');
						document.getElementById("identitas_barang").value = $(this).attr('data-identitas_barang');
				        $("#ModalKondisiRph").modal('show');
			    	});
        		} else {
        			alert('Pilih data terlebih dahulu');
        		}
        	});
        </script>
        <script type="text/javascript">
        	$(document).on("click", "#mutasi_asset", function () {
        		if($('.check').is(':checked')) { 
        			$('#awo_asset tr').filter(':has(:checkbox:checked)').each(function() {
	        			$tr = $(this);
	        			document.getElementById("nama_barang_asset").value = $(this).attr('data-nama');
						document.getElementById("merk_asset").value = $(this).attr('data-merk');
						document.getElementById("awo").value = $(this).attr('data-awo');
						document.getElementById("id_awo2").value = $(this).attr('data-id_awo');
						document.getElementById("id_asset_awo2").value = $(this).attr('data-id_asset_awo');
						document.getElementById("id_barang2").value = $(this).attr('data-id_barang');
						document.getElementById("identitas_barang2").value = $(this).attr('data-identitas_barang');
				        $("#ModalMutasi").modal('show');
			    	});
        		} else {
        			alert('Pilih data terlebih dahulu');
        		}
        	});
        </script>
        <script type="text/javascript">
        	$(document).on("click", "#mutasi_asset_rph", function () {
        		if($('.check').is(':checked')) { 
        			$('#rph_asset tr').filter(':has(:checkbox:checked)').each(function() {
	        			$tr = $(this);
	        			document.getElementById("nama_barang_asset").value = $(this).attr('data-nama');
						document.getElementById("merk_asset").value = $(this).attr('data-merk');
						document.getElementById("rph").value = $(this).attr('data-rph');
						document.getElementById("id_rph2").value = $(this).attr('data-id_rph');
						document.getElementById("id_barang2").value = $(this).attr('data-id_barang');
						document.getElementById("identitas_barang2").value = $(this).attr('data-identitas_barang');
						document.getElementById("id_asset_rph2").value = $(this).attr('data-id_asset_rph');
				        $("#ModalMutasiRph").modal('show');
			    	});
        		} else {
        			alert('Pilih data terlebih dahulu');
        		}
        	});
        </script>
        <script type="text/javascript">
        	$(document).on("click", "#replacement_asset", function () {
        		if($('.check').is(':checked')) { 
        			$('#awo_asset tr').filter(':has(:checkbox:checked)').each(function() {
	        			$tr = $(this);
	        			document.getElementById("nama_barang_replacement").value = $(this).attr('data-nama');
						document.getElementById("merk_replacement").value = $(this).attr('data-merk');
						document.getElementById("awo").value = $(this).attr('data-awo');
						document.getElementById("id_awo3").value = $(this).attr('data-id_awo');
						document.getElementById("id_barang3").value = $(this).attr('data-id_barang');
						document.getElementById("identitas_barang3").value = $(this).attr('data-identitas_barang');
						document.getElementById("id_asset_awo3").value = $(this).attr('data-id_asset_awo');
				        $("#ModalReplacement").modal('show');
			    	});
        		} else {
        			alert('Pilih data terlebih dahulu');
        		}
        	});
        </script>
        <script type="text/javascript">
        	$(document).on("click", "#replacement_asset_rph", function () {
        		if($('.check').is(':checked')) { 
        			$('#rph_asset tr').filter(':has(:checkbox:checked)').each(function() {
	        			$tr = $(this);
	        			document.getElementById("nama_barang_replacement").value = $(this).attr('data-nama');
						document.getElementById("merk_replacement").value = $(this).attr('data-merk');
						document.getElementById("rph").value = $(this).attr('data-rph');
						document.getElementById("id_barang3").value = $(this).attr('data-id_barang');
						document.getElementById("id_rph3").value = $(this).attr('data-id_rph');
						document.getElementById("identitas_barang3").value = $(this).attr('data-identitas_barang');
						document.getElementById("id_asset_rph3").value = $(this).attr('data-id_asset_rph');
				        $("#ModalReplacementrRph").modal('show');
			    	});
        		} else {
        			alert('Pilih data terlebih dahulu');
        		}
        	});
        </script>
        <script type="text/javascript">
        	$('input.check').on('change', function() {
				    $('input.check').not(this).prop('checked', false);  
				});
        </script>
        <script type="text/javascript">
        	$(document).ready(function(){
        		$("#pilih_pengiriman").change(function(){
        			var pengiriman = $("#pilih_pengiriman").val();
        			if(pengiriman == "") {
        				document.location.href="<?php echo base_url(); ?>pengiriman_sapi";
        			} else {							
        				document.location.href="<?php echo base_url(); ?>pengiriman_sapi/tampil/"+pengiriman;
        			}
        		});
        		$("#pilih_masuk").change(function(){
        			var pengiriman = $("#pilih_masuk").val();
        			if(pengiriman == "") {
        				document.location.href="<?php echo base_url(); ?>penerimaan_sapi/masuk";
        			} else {							
        				document.location.href="<?php echo base_url(); ?>penerimaan_sapi/masuk/"+pengiriman;
        			}
        		});
        		$("#pilih_stock").change(function(){
        			var pengiriman = $("#pilih_stock").val();
							console.log("data "+pengiriman);
							$("#tb_modal").find("tr").remove();
							$no = 1;	
		          $.get('mutasi_sapi/ambil_data_stock/'+pengiriman, function(data){ 
								console.log(data);
								var original_element = $(data);
								var clone_element = $(original_element).clone();
								$(clone_element).find("td")[0].append();
								$(clone_element).find("td")[1].append();
								$(clone_element).find("td")[2].append();
								$(clone_element).find("td")[3].append();
								$(clone_element).find("td")[4].append();
								$(clone_element).find("td")[5].append();
								$("#tb_modal").append(clone_element);
							});
							$.get('mutasi_sapi/ambil_data/'+pengiriman, function(data1){ 
								console.log("data1 :" +data1);
								//var original_element = $(data1);
								$("#pilih_asal_sapi").val(data1).change();
							});
        		});
					});
		</script>
		 <script type="text/javascript">
        	$(document).ready(function(){
        		$("#pilih_transfer").change(function(){
        			var transfer = $("#pilih_transfer").val();
        			if(transfer == "") {
        				document.location.href="<?php echo base_url(); ?>inventory_barang/transfer";
        			} else {							
        				document.location.href="<?php echo base_url(); ?>inventory_barang/tampil_transfer/"+transfer;
        			}
        		});
        	});
		</script>
		<script type="text/javascript">
        	$(document).on("click", "#penerimaan_sapi", function () {
        		var id_pengiriman = $(this).attr('data-id_pengiriman');
        		var tanggal_terima = $(this).attr('data-tanggal_terima');
        		var jam_terima = $(this).attr('data-jam_terima');
        		var keterangan_terima = $(this).attr('data-keterangan_terima');
        		$("#id_pengiriman").val(id_pengiriman);
        		$("#id_pengiriman2").val(id_pengiriman);
        		// $(".tanggal_terima").val(tanggal_terima);
        		// $(".jam_terima").val(jam_terima);
        		// $(".keterangan_terima").val(keterangan_terima);
        		$.ajax({
				    url: "<?php echo base_url(); ?>Penerimaan_sapi/get_pengiriman", 
				    async: false,
				    type: "POST",    
				    data: "id_pengiriman="+id_pengiriman,   
				    dataType: "html",
				    success: function(data) {
				      $('#data_pengiriman').html(data); 
				      $("#ModalKonfirmasi").modal('show');
				    }
				}) 
        	});
        	$(document).on("click", "#penerimaan_sapi1", function () {
        		var id_pengiriman = $(this).attr('data-id_pengiriman');
        		var tanggal_terima = $(this).attr('data-tanggal_terima');
        		var jam_terima = $(this).attr('data-jam_terima');
				var keterangan_terima = $(this).attr('data-keterangan_terima');
				console.log(id_pengiriman);
				console.log(tanggal_terima);
        		// $("#id_pengiriman").val(id_pengiriman);
        		// $("#id_pengiriman2").val(id_pengiriman);
        		$.ajax({
				    url: "<?php echo base_url(); ?>History_penerimaan/get_pengiriman", 
				    async: false,
				    type: "POST",    
				    data: {id_pengiriman: id_pengiriman, tanggal_terima: tanggal_terima},
				    dataType: "html",
				    success: function(data) {
				      $('#data_pengiriman_history').html(data); 
				      $("#ModalKonfirmasi_history").modal('show');
				    }
				}) 
        	});
			$(document).on("click", "#detail_rph", function () {
        		var id_awo = $(this).attr('data-id_awo');
        		$("#id_awo").val(id_awo);
        		$.ajax({
				    url: "<?php echo base_url(); ?>Awo/get_awo_rph", 
				    async: false,
				    type: "POST",    
				    data: "id_awo="+id_awo,   
				    dataType: "html",
				    success: function(data) {
				      $('#data_rph_awo').html(data); 
				      $("#ModalrphAwo").modal('show');
				    }
				}) 
        	});
			$(document).on("click", "#detail_rph_mutasi", function () {
        		var id_rph = $(this).attr('data-id_rph');
        		$("#id_rph").val(id_rph);
        		$.ajax({
				    url: "<?php echo base_url(); ?>Rph/get_rph_mutasi", 
				    async: false,
				    type: "POST",    
				    data: "id_rph="+id_rph,   
				    dataType: "html",
				    success: function(data) {
				      $('#data_rph_awo_mutasi').html(data); 
				      $("#ModalrphAwomutasi").modal('show');
				    }
				}) 
        	});
			$(document).on("click", "#tambah_detail_rph", function () {
        		var id_awo = $(this).attr('data-id_awo');
        		var nama_awo = $(this).attr('data-nama_awo');
        		$("#id_awo_rph").val(id_awo);
        		$("#nama_awo_rph").val(nama_awo);
        		$.ajax({
				    url: "<?php echo base_url(); ?>Awo/get_awo_rph", 
				    async: false,
				    type: "POST",    
				    data: "id_awo="+id_awo,   
				    dataType: "html",
				    success: function(data) {
				      $('#data_rph_awo1').html(data); 
				      $("#ModalAddrphAwo").modal('show');
				    }
				}) 
        	});
			$(document).on("click", "#tambah_detail_rph_mutasi", function () {
        		var id_rph = $(this).attr('data-id_rph');
        		var nama_rph = $(this).attr('data-nama_rph');
        		$("#id_rph_change").val(id_rph).change();
        		$("#nama_rph_change").val(nama_rph).change();
        		$.ajax({
				    url: "<?php echo base_url(); ?>Rph/get_rph_mutasi", 
				    async: false,
				    type: "POST",    
				    data: "id_rph="+id_rph,   
				    dataType: "html",
				    success: function(data) {
				      $('#data_rph_awo_mutasi1').html(data); 
				      $("#ModalAddrphAwomutasi").modal('show');
				    }
				}) 
        	});
		</script>
		<script type="text/javascript">
        	$(document).on("click", "#detail_mutasi", function () {
        		var id_pengiriman = $(this).attr('data-id_pengiriman');
						console.log(id_pengiriman);
        		$("#id_pengiriman").val(id_pengiriman);
        		$.ajax({
				    url: "<?php echo base_url(); ?>Mutasi_sapi/get_detail_mutasi", 
				    async: false,
				    type: "POST",    
				    data: "id_pengiriman="+id_pengiriman,   
				    dataType: "html",
				    success: function(data) {
				      $('#detail_mutasi_sapi').html(data); 
				      $("#ModalDetailMutasi").modal('show');
				    }
				}) 
        	});
		</script>
		<script type="text/javascript">
        	$(document).on("click", "#mutasi_sapi", function () {
        		var id_pengiriman = $(this).attr('data-id_pengiriman');
        		var nota = $(this).attr('data-nota');
        		var tanggal_terima = $(this).attr('data-tanggal_terima');
        		var jam_terima = $(this).attr('data-jam_terima');
        		var keterangan_terima = $(this).attr('data-keterangan_terima');
        		$("#id_pengiriman").val(id_pengiriman);
        		$("#id_pengiriman2").val(id_pengiriman);
        		$("#nota").val(nota);
        		$(".tanggal_terima").val(tanggal_terima);
        		$(".jam_terima").val(jam_terima);
        		$(".keterangan_terima").val(keterangan_terima);
        		$.ajax({
				    url: "<?php echo base_url(); ?>Mutasi_sapi/get_mutasi", 
				    async: false,
				    type: "POST",    
				    data: "id_pengiriman="+id_pengiriman,   
				    dataType: "html",
				    success: function(data) {
				      $('#data_pengiriman').html(data); 
				      $("#ModalMutasiSapi").modal('show');
				    }
				}) 
        	});
		</script>
		<script type="text/javascript">
        	$(document).on("click", "#laporan_Accept", function () {
        		var log = $(this).attr('data-log');
						$("#log").val(log);
        		$.ajax({
				    url: "<?php echo base_url(); ?>Laporan_pengerjaan_awo/get_laporan", 
				    async: false,
				    type: "POST",    
				    data: "log="+log,   
				    dataType: "html",
				    success: function(data) {
				      $('#Konfirmasi_table').html(data); 
				      $("#ModalAccept").modal('show');
				    }
				}) 
        	});
		</script>
		<script type="text/javascript">
        	$(document).on("click", "#laporan_Batal", function () {
        		var log = $(this).attr('data-log');
						$("#log1").val(log);
        		$.ajax({
				    url: "<?php echo base_url(); ?>Laporan_pengerjaan_awo/get_laporan", 
				    async: false,
				    type: "POST",    
				    data: "log="+log,   
				    dataType: "html",
				    success: function(data) {
				      $('#Batal_table').html(data); 
				      $("#ModalCancle").modal('show');
				    }
				}) 
        	});
		</script>
        <script type="text/javascript">
        	$(document).on("click", "#viewMap", function () {
        		var lat = $(this).attr('data-lat');
        		var lng = $(this).attr('data-lng');
        		$.ajax({
				    url: "<?php echo base_url(); ?>absen/get_map", 
				    async: false,
				    type: "POST",    
				    data: "lat="+lat+"&lng="+lng,   
				    dataType: "html",
				    success: function(data) {
				      $('#data_map').html(data); 
				      $("#ModalMap").modal('show');
				    }
				}) 
        	});
        </script>
        <script type="text/javascript">
        	$(document).on("click", "#detail_stok", function () {
        		var id_pengiriman = $(this).attr('data-id_pengiriman');
        		var status_terima = $(this).attr('data-status_terima');
        		var status_potong = $(this).attr('data-status_potong');
        		var intransit = $(this).attr('data-intransit');
        		$("#id_pengiriman").val(id_pengiriman)
        		$.ajax({
				    url: "<?php echo base_url(); ?>Laporan_data_sapi/get_stok", 
				    async: false,
				    type: "POST",    
				    data: "id_pengiriman="+id_pengiriman+"&status_terima="+status_terima+"&status_potong="+status_potong+"&intransit="+intransit,      
				    dataType: "html",
				    success: function(data) {
				      $('#data_stok').html(data); 
				      $("#ModalStok").modal('show');
				    }
				}) 
        	});
        </script>
        <script type="text/javascript">
        	$(document).on("click", "#pemotongan_sapi", function () {
        		var id_penerimaan_detail = $(this).attr('data-id_penerimaan_detail');
        		var tgl = $(this).attr('data-tgl');
        		var jam_potong = $(this).attr('data-jam_potong');
        		var rfid = $(this).attr('data-rfid');
        		var berat_karkas = $(this).attr('data-berat_karkas');
        		var berat_prosot = $(this).attr('data-berat_prosot');
        		var keterangan_potong = $(this).attr('data-keterangan_potong');
        		var merah = $(this).attr('data-merah');
        		var orange = $(this).attr('data-orange');
        		var kuning = $(this).attr('data-kuning');
        		var hitam = $(this).attr('data-hitam');
        		var peneumatic = $(this).attr('data-peneumatic');
        		var score = $(this).attr('data-score');
        		var pasar = $(this).attr('data-pasar');
        		var nama_pedagang = $(this).attr('data-nama_pedagang');
        		$("#id_penerimaan_detail").val(id_penerimaan_detail);
        		$("#tgl3").val(tgl);
        		$("#jam").val(jam_potong);
        		$("#rfid").val(rfid);
        		$("#berat_karkas").val(berat_karkas);
        		$("#berat_prosot").val(berat_prosot);
        		$("#keterangan_potong").val(keterangan_potong);
        		$("#merah").val(merah);
        		$("#orange").val(orange);
        		$("#kuning").val(kuning);
        		$("#hitam").val(hitam);
        		$("#peneumatic").val(peneumatic);
        		$("#score").val(score);
        		$("#pasar").val(pasar);
        		$("#nama_pedagang").val(nama_pedagang);
        		$("#ModalPotong").modal('show');
        	});
        	$(document).on("click", "#pemotongan_sapi1", function () {
        		var id_penerimaan_detail = $(this).attr('data-id_penerimaan_detail');
        		var tgl = $(this).attr('data-tgl');
        		var jam_potong = $(this).attr('data-jam_potong');
        		var rfid = $(this).attr('data-rfid');
        		var berat_karkas = $(this).attr('data-berat_karkas');
        		var berat_prosot = $(this).attr('data-berat_prosot');
        		var keterangan_potong = $(this).attr('data-keterangan_potong');
        		var merah = $(this).attr('data-merah');
        		var orange = $(this).attr('data-orange');
        		var kuning = $(this).attr('data-kuning');
        		var hitam = $(this).attr('data-hitam');
        		var peneumatic = $(this).attr('data-peneumatic');
        		var score = $(this).attr('data-score');
        		var pasar = $(this).attr('data-pasar');
        		var nama_pedagang = $(this).attr('data-nama_pedagang');
        		$("#id_penerimaan_detail").val(id_penerimaan_detail);
        		$("#tgl3").val(tgl);
        		$("#jam").val(jam_potong);
        		$("#rfid").val(rfid);
        		$("#berat_karkas").val(berat_karkas);
        		$("#berat_prosot").val(berat_prosot);
        		$("#keterangan_potong").val(keterangan_potong);
        		$("#merah").val(merah);
        		$("#orange").val(orange);
        		$("#kuning").val(kuning);
        		$("#hitam").val(hitam);
        		$("#peneumatic").val(peneumatic);
        		$("#score").val(score);
        		$("#pasar").val(pasar);
        		$("#nama_pedagang").val(nama_pedagang);
        		$("#ModalPotong1").modal('show');
        	});
			$(document).on("click", "#pemotongan_sapi2", function () {
        		var id_penerimaan_detail = $(this).attr('data-id_penerimaan_detail');
        		var tgl = $(this).attr('data-tgl');
        		var jam_potong = $(this).attr('data-jam_potong');
        		var rfid = $(this).attr('data-rfid');
        		var berat_karkas = $(this).attr('data-berat_karkas');
        		var berat_prosot = $(this).attr('data-berat_prosot');
        		var keterangan_potong = $(this).attr('data-keterangan_potong');
        		var merah = $(this).attr('data-merah');
        		var orange = $(this).attr('data-orange');
        		var kuning = $(this).attr('data-kuning');
        		var hitam = $(this).attr('data-hitam');
        		var peneumatic = $(this).attr('data-peneumatic');
        		var score = $(this).attr('data-score');
        		var pasar = $(this).attr('data-pasar');
        		var nama_pedagang = $(this).attr('data-nama_pedagang');
        		$("#id_penerimaan_detail2").val(id_penerimaan_detail);
        		$("#tgl32").val(tgl);
        		$("#jam2").val(jam_potong);
        		$("#rfid2").val(rfid);
        		$("#berat_karkas2").val(berat_karkas);
        		$("#berat_prosot2").val(berat_prosot);
        		$("#keterangan_potong2").val(keterangan_potong);
        		$("#merah2").val(merah);
        		$("#orange2").val(orange);
        		$("#kuning2").val(kuning);
        		$("#hitam2").val(hitam);
        		$("#peneumatic2").val(peneumatic);
        		$("#score2").val(score);
        		$("#pasar2").val(pasar);
        		$("#nama_pedagang2").val(nama_pedagang);
        		$("#ModalPotong2").modal('show');
        	});
			$(document).on("click", "#pemotongan_sapi3", function () {
        		var id_penerimaan_detail = $(this).attr('data-id_penerimaan_detail');
        		var tgl = $(this).attr('data-tgl');
        		var jam_potong = $(this).attr('data-jam_potong');
        		var rfid = $(this).attr('data-rfid');
        		var berat_karkas = $(this).attr('data-berat_karkas');
        		var berat_prosot = $(this).attr('data-berat_prosot');
        		var keterangan_potong = $(this).attr('data-keterangan_potong');
        		var merah = $(this).attr('data-merah');
        		var orange = $(this).attr('data-orange');
        		var kuning = $(this).attr('data-kuning');
        		var hitam = $(this).attr('data-hitam');
        		var peneumatic = $(this).attr('data-peneumatic');
        		var score = $(this).attr('data-score');
        		var pasar = $(this).attr('data-pasar');
        		var nama_pedagang = $(this).attr('data-nama_pedagang');
        		$("#id_penerimaan_detail3").val(id_penerimaan_detail);
        		$("#tgl33").val(tgl);
        		$("#jam3").val(jam_potong);
        		$("#rfid3").val(rfid);
        		$("#berat_karkas3").val(berat_karkas);
        		$("#berat_prosot3").val(berat_prosot);
        		$("#keterangan_potong3").val(keterangan_potong);
        		$("#merah3").val(merah);
        		$("#orange3").val(orange);
        		$("#kuning3").val(kuning);
        		$("#hitam3").val(hitam);
        		$("#peneumatic3").val(peneumatic);
        		$("#score3").val(score);
        		$("#pasar3").val(pasar);
        		$("#nama_pedagang3").val(nama_pedagang);
        		$("#ModalPotong3").modal('show');
        	});
        </script>
        <script type="text/javascript">
			$(document).on('click', '.pilih_barang', function (e) {  
				document.getElementById("id_barang").value = $(this).attr('data-id_barang');
				document.getElementById("barang").value = $(this).attr('data-barang');
				$('#ModalBarang').modal('hide');	
			});
		</script>
		<script type="text/javascript">
        	$(document).on("click", "#updateTanggal", function () {
        		var id_perawatan = $(this).attr('data-id_perawatan');
        		$("#id_perawatan").val(id_perawatan);        		
        		$("#modalTanggal").modal('show');
        	});
        </script>
        <script type="text/javascript">
		    function exportKartuAwo(type) {
		      $('.table').tableExport({
		        filename: 'Laporan Kartu Asset AWO_%DD%-%MM%-%YY%-%ss%',
		        format: type
		      });
		    }
		    function exportKondisiAwo(type) {
		      $('.table').tableExport({
		        filename: 'Laporan Kondisi Asset AWO_%DD%-%MM%-%YY%-%ss%',
		        format: type
		      });
		    }
		    function exportMutasiAwo(type) {
		      $('.table').tableExport({
		        filename: 'Laporan Mutasi Asset AWO_%DD%-%MM%-%YY%-%ss%',
		        format: type
		      });
		    }
		    function exportReplacementAwo(type) {
		      $('.table').tableExport({
		        filename: 'Laporan Replacement Asset AWO_%DD%-%MM%-%YY%-%ss%',
		        format: type
		      });
		    }
		    function exportKartuRph(type) {
		      $('.table').tableExport({
		        filename: 'Laporan Kartu Asset RPH_%DD%-%MM%-%YY%-%ss%',
		        format: type
		      });
		    }
		    function exportKondisiRph(type) {
		      $('.table').tableExport({
		        filename: 'Laporan Kondisi Asset RPH_%DD%-%MM%-%YY%-%ss%',
		        format: type
		      });
		    }
		    function exportMutasiRph(type) {
		      $('.table').tableExport({
		        filename: 'Laporan Mutasi Asset RPH_%DD%-%MM%-%YY%-%ss%',
		        format: type
		      });
		    }
		    function exportReplacementRph(type) {
		      $('.table').tableExport({
		        filename: 'Laporan Replacement Asset RPH_%DD%-%MM%-%YY%-%ss%',
		        format: type
		      });
		    }
		    function exportPemotonganSapi(type) {
		      $('.tbl_lapor').tableExport({
		        filename: 'Laporan Pemotongan Sapi_%DD%-%MM%-%YY%-%ss%',
		        format: type
		      });
		    }
		    function exportKonfirmasiPemotonganSapi(type) {
		      $('.tbl_lapor').tableExport({
		        filename: 'Laporan Pemotongan Sapi_%DD%-%MM%-%YY%-%ss%',
		        format: type
		      });
		    }
		    function exportBatalPemotonganSapi(type) {
		      $('.tbl_lapor1').tableExport({
		        filename: 'Laporan Pemotongan Sapi_%DD%-%MM%-%YY%-%ss%',
		        format: type
		      });
		    }
		    function exportPowerload(type) {
		      $('.table').tableExport({
		        filename: 'Laporan Powerload_%DD%-%MM%-%YY%-%ss%',
		        format: type
		      });
		    }
		    function exportTraceability(type) {
		      $('.table').tableExport({
		        filename: 'Laporan Tracebility_%DD%-%MM%-%YY%-%ss%',
		        format: type
		      });
		    }
		    function exportAbsenAwo(type) {
		      $('.table').tableExport({
		        filename: 'Laporan Absen Awo_%DD%-%MM%-%YY%-%ss%',
		        format: type
		      });
		    }
		    function exportTraceabilitySapi(type) {
		      $('.table').tableExport({
		        filename: 'Laporan Traceability Sapi_%DD%-%MM%-%YY%-%ss%',
		        format: type
		      });
		    }
		    function exportLog(type) {
		      $('.table').tableExport({
		        filename: 'Laporan Log Pengiriman_%DD%-%MM%-%YY%-%ss%',
		        format: type
		      });
		    }
		  </script>
		  <script type="text/javascript">
		  	function all_check(source) {
			  checkboxes = document.getElementsByName('ck_id_detail');
			  for(var i=0, n=checkboxes.length;i<n;i++) {
			    checkboxes[i].checked = source.checked;
			  }
			}
		  </script>
	</body>
</html> 