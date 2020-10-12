<div class="main-container container-fluid">
	<!-- <a class="menu-toggler" id="menu-toggler" href="#">
		<span class="menu-text"></span>
	</a> -->
	
	<div class="main-content">
		<div class="breadcrumbs" id="breadcrumbs">
			<ul class="breadcrumb">
				<?php 
				$session_nama = $this->session->userdata('nama');
				$session_tipe = $this->session->userdata('hak_akses');
				echo "Selamat Datang, <strong>".$session_nama. "</strong> (Anda Login Sebagai <strong>".$session_tipe."</strong>) - <b>"."</b>";
				?>
			</ul>
		</div>
		<div class="page-content">
			<div class="row-fluid">
