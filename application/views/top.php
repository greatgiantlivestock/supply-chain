<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>Admin Page - Supply Chain</title>
		<meta name="description" content="" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="stylesheet" href="<?php echo base_url();?>asset/css/bootstrap.css" />
		<link rel="stylesheet" href="<?php echo base_url();?>asset/css/font-awesome.css" />
		<link rel="stylesheet" href="<?php echo base_url();?>asset/css/ace-fonts.css" />
		<link rel="stylesheet" href="<?php echo base_url();?>asset/css/ace.css" class="ace-main-stylesheet" id="main-ace-style" />
		<link rel="stylesheet" href="<?php echo base_url();?>asset/css/bootstrap-datetimepicker.css" />
		<link rel="stylesheet" href="<?php echo base_url();?>asset/css/select2.css" />
		<script src="<?php echo base_url();?>asset/js/date-time/moment-with-locales.min.js"></script>
		<script type="text/javascript">
			window.jQuery || document.write("<script src='<?php echo base_url();?>asset/js/jquery.js'>"+"<"+"/script>");
		</script>
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='<?php echo base_url();?>asset/js/jquery.mobile.custom.js'>"+"<"+"/script>");
		</script>
		<script src="<?php echo base_url();?>asset/js/bootstrap.js"></script>
		<script src="<?php echo base_url();?>asset/js/dataTables/jquery.dataTables.js"></script>
		<script src="<?php echo base_url();?>asset/js/dataTables/jquery.dataTables.bootstrap.js"></script>
		<script src="<?php echo base_url();?>asset/js/date-time/bootstrap-datetimepicker.min.js"></script>
		<script src="<?php echo base_url();?>asset/js/ace-extra.js"></script>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	</head>
	<style>
		.table thead tr th, .table tbody tr td {
			padding: 3px 10px;
		}
		.btnpadd {
			line-height: 5px;
		}
		.tbl_input {
			width: 100%;
		}
		.tbl_input tr td {
			padding: 10px 0;
		}
		.tbl_jual_detail {
			width:100%;
			table-layout: fixed;
			border: 2px solid #ccc;			
		}
		.tbl_jual_detail th,
		.tbl_lapor tr td, .tbl_lapor tr th {
			border: 1px solid #ccc;
			padding: 5px;
		}
		.tbl_jual_detail thead {
			background-color: #ECECEC;
		}
		.tbl_jual_detail thead tr {
			display: block;
			position: relative;
		}
		.tbl_jual_detail tbody {
			display: block;
			overflow: auto;
			width: 100%;
			height: 200px;
			overflow-y: scroll;
			overflow-x: hidden;
		}
		.tbl_jual_detail tfoot {
			display: block;
			width: 100%;
		}
		.tbl_jual_detail tfoot tr {
			display: block;
			position: relative;
		}
		/*mulai dari sini style untuk membuat menu di atas*/
		body {margin:0;}
		.topnav {
			overflow: hidden;
			background-color: #333;
		}
		.topnav a {
			float: left;
			display: block;
			color: #ffff;
			text-align: center;
			padding: 10px 3px;
			text-decoration: none;
			font-size: 15px;
		}
		#header{
			width:100%; 
			z-index:1000; 
			position:fixed;
			height:60px; 
			background:#252525;
		}
		.topnav a:hover {
			background-color: #ddd;
			color: black;
		}
		.active {
			background-color: #4CAF50;
			color: white;
		}
		.topnav .icon {
			display: none;
		}
		@media screen and (max-width: 600px) {
			.topnav a:not(:first-child) {display: none;}
			.topnav a.icon {
				float: right;
				display: block;
			}
		}
		@media screen and (max-width: 600px) {
			.topnav.responsive {position: relative;}
			.topnav.responsive .icon {
				position: absolute;
				right: 0;
				top: 0;
			}
			.topnav.responsive a {
				float: none;
				display: block;
				text-align: left;
			}
		}
	</style>
	<body class="no-skin">
		<!-- <div id="myTopnav" class="navbar navbar-default" style="background: linear-gradient(to right, #0B5345 0%, #1A5276 50%, #4A235A  100%);">
			<div class="navbar-container" id="navbar-container">
				<a href="<?php echo base_url(); ?>" class="navbar-brand">
					<small>
						<i class="fa fa-laptop"></i>
							Supply Chain
					</small>
				</a>
				<a href="<?php echo base_url();?>penerimaan_sapi">
					<i class="fa fa-folder-open"></i>
					<span class="menu-text"> Penerimaan Sapi</span>
				</a>
				<a href="<?php echo base_url();?>History_penerimaan">
					<i class="fa fa-search"></i>
					<span class="menu-text"> History Penerimaan </span>
				</a>
				<a href="<?php echo base_url();?>mutasi_sapi">
					<i class="fa fa-truck"></i>
					<span class="menu-text"> Mutasi Sapi </span>
				</a>
			</div>
		</div> -->
		<div class="topnav" id="myTopnav" style="background: linear-gradient(to right, #0B5345 0%, #1A5276 50%, #4A235A  100%);">
			<a href="<?php echo base_url(); ?>" >
				<i class="fa fa-laptop"></i>
					Supply Chain
			</a>
			<?php if($this->session->userdata("hak_akses")=='awo'){
				$count_pengiriman = $this->db->query("SELECT COUNT(*) AS hitung_pengiriman FROM(SELECT pg.* FROM pengiriman pg JOIN pengiriman_detail pd ON pg.id_pengiriman=pd.id_pengiriman
				JOIN mst_rph_user mru ON mru.id_rph=pg.id_rph WHERE mru.id_awo = '".$this->session->userdata("id_awo")."' 
				AND pd.status_terima = '0' GROUP BY pg.id_pengiriman) AS data1")->row();
					if($this->session->userdata("input_type")=='0'){?>
						<a href="<?php echo base_url();?>penerimaan_sapi">
							<i class="fa fa-folder-open"></i>
							<span class="menu-text" style="margin-right:35px;"> Penerimaan Sapi <label style="border-radius:25px;height:20px;position:absolute;margin-left:3px;" class="label label-warning"> <?php echo $count_pengiriman->hitung_pengiriman; ?> </label></span>
						</a>
						<a href="<?php echo base_url(); ?>History_penerimaan">
							<i class="menu-icon  fa fa-pencil-square"></i>
							<span class="menu-text"> History Penerimaan </span>
						</a>
						<a href="<?php echo base_url(); ?>Mutasi_sapi">
							<i class="menu-icon  fa fa-tags"></i>
							<span class="menu-text"> Mutasi Sapi </span>
						</a>
						<a href="<?php echo base_url(); ?>Password">
							<i class="menu-icon  fa fa-tags"></i>
							<span class="menu-text"> Password </span>
						</a>
				<?php }else if ($this->session->userdata("input_type")=='2'){?>
						<a href="<?php echo base_url();?>penerimaan_sapi">
							<i class="fa fa-folder-open"></i>
							<span class="menu-text" style="margin-right:35px;"> Penerimaan Sapi <label style="border-radius:25px;height:20px;position:absolute;margin-left:3px;" class="label label-warning"> <?php echo $count_pengiriman->hitung_pengiriman; ?> </label></span>
						</a>
						<a href="<?php echo base_url();?>History_penerimaan">
							<i class="fa fa-search"></i>
							<span class="menu-text"> History Penerimaan </span>
						</a>
						<a href="<?php echo base_url();?>Pemotongan_sapi/traceability">
							<i class="fa fa-signal"></i>
							<span class="menu-text"> Update Status Potong</span>
						</a>
						<a href="<?php echo base_url();?>Pemotongan_sapi/hasil_pemotongan">
							<i class="fa fa-edit"></i>
							<span class="menu-text"> Hasil Pemotongan</span>
						</a>
						<a href="<?php echo base_url(); ?>Powerload">
							<i class="fa fa-exchange"></i>
							<span class="menu-text"> Transfer Powerload </span>
						</a>
						<a href="<?php echo base_url(); ?>Powerload/kartu_stok_awo">
							<i class="fa fa-list"></i>
							<span class="menu-text"> History Powerload </span>
						</a>									
						<a href="<?php echo base_url(); ?>Password">
							<i class="fa fa-list"></i>
							<span class="menu-text"> Password </span>
						</a>									
				<?php }?>
			<?php }?>
			<?php if($this->session->userdata("hak_akses")=='admin'){?>
				<a class="pull-right" style="background-color: coral;color:black;margin-right:5px;" href="<?php echo base_url(); ?>Logout" onclick="return confirm('Yakin ingin keluar sistem ?');">
					<i class="fa fa-sign-out"></i>
					<span class="menu-text"> Logout </span>
				</a>
			<?php }else{?>
				<a style="margin-right:5px;" href="<?php echo base_url(); ?>Logout" onclick="return confirm('Yakin ingin keluar sistem ?');">
					<i class="fa fa-sign-out"></i>
					<span class="menu-text"> Logout </span>
				</a>
			<?php }?>
			<a href="javascript:void(0);" style="font-size:15px;" class="icon" onclick="myFunction()">&#9776;</a>
		</div>
	<script>
		function myFunction() {
			var x = document.getElementById("myTopnav");
			if (x.className === "topnav") {
				x.className += " responsive";
			} else {
				x.className = "topnav";
			}
		}
	</script>
</body>