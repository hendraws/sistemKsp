<?php session_start();

if($_SESSION['USERNAME'] != null){
	$USERNAME   = $_SESSION['USERNAME'];
	$USER_ID       = $_SESSION['USER_ID'];
	$NAMA       = $_SESSION['NAMA'];
	$LEVEL           = $_SESSION['LEVEL'];
	$PERMISSION           = $_SESSION['PERMISSION'];
	$bulan           = $_SESSION['BULAN'];
	$nama_owner           = $_SESSION['NAMA_OWNER'];
	$cabang           = $_SESSION['CABANG'];
	$menu        = str_replace("/","", $_SERVER['REQUEST_URI']);
      // $menu        = explode('/', $_SERVER['REQUEST_URI'])[1];


	?>

	<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="x-ua-compatible" content="ie=edge">

		<title>Koperasi simpan pinjam</title>

		<!-- Font Awesome Icons -->
		<link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
		<!-- overlayScrollbars -->
		<link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
		<!-- Toastr -->
		<link rel="stylesheet" href="plugins/toastr/toastr.min.css">
		<!-- Theme style -->
		<link rel="stylesheet" href="dist/css/adminlte.min.css">
		<!-- DataTables -->
		<link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
		<link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
		<link rel="stylesheet" href="plugins/jquery-ui/jquery-ui.css">
		<style type="text/css">
			/* Absolute Center CSS Spinner */
			.loading {
				position: fixed;
				z-index: 999;
				height: 2em;
				width: 2em;
				overflow: show;
				margin: auto;
				top: 0;
				left: 0;
				bottom: 0;
				right: 0;
			}

			/* Transparent Overlay */
			.loading:before {
				content: '';
				display: block;
				position: fixed;
				top: 0;
				left: 0;
				width: 100%;
				height: 100%;
				background-color: rgba(0,0,0,0.3);
			}

			/* :not(:required) hides these rules from IE9 and below */
			.loading:not(:required) {
				/* hide "loading..." text */
				font: 0/0 a;
				color: transparent;
				text-shadow: none;
				background-color: transparent;
				border: 0;
			}

			.loading:not(:required):after {
				content: '';
				display: block;
				font-size: 10px;
				width: 1em;
				height: 1em;
				margin-top: -0.5em;
				-webkit-animation: spinner 1500ms infinite linear;
				-moz-animation: spinner 1500ms infinite linear;
				-ms-animation: spinner 1500ms infinite linear;
				-o-animation: spinner 1500ms infinite linear;
				animation: spinner 1500ms infinite linear;
				border-radius: 0.5em;
				-webkit-box-shadow: rgba(0, 0, 0, 0.75) 1.5em 0 0 0, rgba(0, 0, 0, 0.75) 1.1em 1.1em 0 0, rgba(0, 0, 0, 0.75) 0 1.5em 0 0, rgba(0, 0, 0, 0.75) -1.1em 1.1em 0 0, rgba(0, 0, 0, 0.5) -1.5em 0 0 0, rgba(0, 0, 0, 0.5) -1.1em -1.1em 0 0, rgba(0, 0, 0, 0.75) 0 -1.5em 0 0, rgba(0, 0, 0, 0.75) 1.1em -1.1em 0 0;
				box-shadow: rgba(0, 0, 0, 0.75) 1.5em 0 0 0, rgba(0, 0, 0, 0.75) 1.1em 1.1em 0 0, rgba(0, 0, 0, 0.75) 0 1.5em 0 0, rgba(0, 0, 0, 0.75) -1.1em 1.1em 0 0, rgba(0, 0, 0, 0.75) -1.5em 0 0 0, rgba(0, 0, 0, 0.75) -1.1em -1.1em 0 0, rgba(0, 0, 0, 0.75) 0 -1.5em 0 0, rgba(0, 0, 0, 0.75) 1.1em -1.1em 0 0;
			}

			/* Animation */

			@-webkit-keyframes spinner {
				0% {
					-webkit-transform: rotate(0deg);
					-moz-transform: rotate(0deg);
					-ms-transform: rotate(0deg);
					-o-transform: rotate(0deg);
					transform: rotate(0deg);
				}
				100% {
					-webkit-transform: rotate(360deg);
					-moz-transform: rotate(360deg);
					-ms-transform: rotate(360deg);
					-o-transform: rotate(360deg);
					transform: rotate(360deg);
				}
			}
			@-moz-keyframes spinner {
				0% {
					-webkit-transform: rotate(0deg);
					-moz-transform: rotate(0deg);
					-ms-transform: rotate(0deg);
					-o-transform: rotate(0deg);
					transform: rotate(0deg);
				}
				100% {
					-webkit-transform: rotate(360deg);
					-moz-transform: rotate(360deg);
					-ms-transform: rotate(360deg);
					-o-transform: rotate(360deg);
					transform: rotate(360deg);
				}
			}
			@-o-keyframes spinner {
				0% {
					-webkit-transform: rotate(0deg);
					-moz-transform: rotate(0deg);
					-ms-transform: rotate(0deg);
					-o-transform: rotate(0deg);
					transform: rotate(0deg);
				}
				100% {
					-webkit-transform: rotate(360deg);
					-moz-transform: rotate(360deg);
					-ms-transform: rotate(360deg);
					-o-transform: rotate(360deg);
					transform: rotate(360deg);
				}
			}
			@keyframes spinner {
				0% {
					-webkit-transform: rotate(0deg);
					-moz-transform: rotate(0deg);
					-ms-transform: rotate(0deg);
					-o-transform: rotate(0deg);
					transform: rotate(0deg);
				}
				100% {
					-webkit-transform: rotate(360deg);
					-moz-transform: rotate(360deg);
					-ms-transform: rotate(360deg);
					-o-transform: rotate(360deg);
					transform: rotate(360deg);
				}
			}
		</style>

		<!-- Google Font: Source Sans Pro -->
		<link href="font.css" rel="stylesheet">

		<!-- js -->
		<!-- REQUIRED SCRIPTS -->
		<!-- jQuery -->
		<script src="plugins/jquery/jquery.min.js"></script>
		<script src="plugins/jquery-ui/jquery-ui.js"></script>

		<!-- <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script> -->
		<!-- Bootstrap -->
		<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
		<!-- overlayScrollbars -->
		<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
		<!-- DataTables -->
		<script src="plugins/datatables/jquery.dataTables.min.js"></script>
		<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
		<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
		<!-- <script src="plugins/fdatatables-responsive/js/responsive.bootstrap4.min.js"></script> -->
		<!-- AdminLTE App -->
		<script src="dist/js/adminlte.js"></script>

<!--
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<script src="https://code.highcharts.com/modules/data.js"></script>
-->
<!-- Toastr -->
<script src="plugins/toastr/toastr.min.js"></script>
</head>
<body class="hold-transition sidebar-mini ">
	<div class="wrapper">

		<!-- Navbar -->
		<nav class="main-header navbar navbar-expand navbar-white navbar-light elevation-1">
			<!-- Left navbar links -->
			<ul class="navbar-nav">
				<li class="nav-item">
					<a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
				</li>
				<li class="nav-item">
					SISTEM INFORMASI <?php echo $nama_owner;?>
				</li>

			</ul>



			<!-- Right navbar links -->
			<ul class="navbar-nav ml-auto">

				<li class="nav-item">

					<label class="small"><a class="nav-link">Login Sebagai : <?php echo $NAMA;?></a></label>
				</li>

				<li class="nav-item">
					<label class="small"><a href="logout.php" class="nav-link"><i class="fa fa-power-off"></i> Keluar</a></label>
				</li>

			</ul>
		</nav>
		<!-- /.navbar -->

		<!-- Main Sidebar Container -->
		<aside class="main-sidebar sidebar-dark-primary elevation-4">
			<!-- Brand Logo -->
			<a href="index.php" class="brand-link">

				<span class="brand-text font-weight-light">SI Koperasi Simpan Pinjam</span>
			</a>

			<!-- Sidebar -->
			<div class="sidebar">
				<!-- Sidebar user panel (optional) -->
				<?php
				if($menu=="pegawai"){
					$master 			= "menu-open";
					$master_pegawai 	= "active";
					$url 				= "pages/data_pegawai.php";
				}else if($menu=="kas"){
					$master       = "menu-open";
					$master_kas   = "active";
					$url        = "pages/data_kas_awal.php";
				}else if($menu=="kas-masuk"){
					$master       = "menu-open";
					$master_kas_masuk  = "active";
					$url        = "pages/data_kas_masuk.php";
				}else if($menu=="data-master-pilihan"){
					$master       = "menu-open";
					$master_pilihan  = "active";
					$url        = "pages/data_master_pilihan.php";
				}else if($menu=="data-master-cabang"){
					$master       = "menu-open";
					$master_cabang  = "active";
					$url        = "pages/data_master_cabang.php";
				}else if($menu=="data-backup-database"){
					$master       = "menu-open";
					$master_backup_database  = "active";
					$url        = "pages/data_backup_database.php";
				}else if($menu=="data-master-user-kasir"){
					$master       = "menu-open";
					$master_user_kasir  = "active";
					$url        = "pages/data_master_user_kasir.php";
				}else if($menu=="drop_tunda"){
					$master       = "menu-open";
					$master_drop_tunda   = "active";
					$url        = "pages/data_drop_tunda.php";
				}else if($menu=="anggota_awal"){
					$master       = "menu-open";
					$master_anggota_awal   = "active";
					$url        = "pages/data_anggota_awal.php";
				}else if($menu=="saldo_macet"){
					$master       = "menu-open";
					$master_kemacetan   = "active";
					$url        = "pages/data_saldo_kemacetan.php";
				}else if($menu=="profil"){
					$master       = "menu-open";
					$master_profil   = "active";
					$url        = "pages/data_profil.php";
				}else if($menu=="inventaris"){
					$master 			= "menu-open";
					$master_inventaris 	= "active";
					$url        = "pages/data_inventaris.php";
				}else if($menu=="gaji"){
					$master 			= "menu-open";
					$master_gaji 	 	= "active";
					$url        = "pages/data_gaji.php";
				}else if($menu=="resort"){
					$master 			= "menu-open";
					$master_resort 	 	= "active";
					$url        = "pages/data_resort.php";
				}else if($menu=="unit"){
					$master       = "menu-open";
					$master_unit    = "active";
					$url        = "pages/data_unit.php";
				}else if($menu=="anggota"){
					$master       = "menu-open";
					$master_anggota    = "active";
        //$url        = "pages/data_anggota.php";
				}else if($menu=="kasir"){
					$lembar_kerja       = "menu-open";
					$lembar_kerja_kasir    = "active";
					$url        = "pages/data_kasir.php";
				}else if($menu=="kemacetan"){
					$lembar_kerja       = "menu-open";
					$lembar_kerja_kemacetan    = "active";
					$url        = "pages/data_kemacetan.php";
				}else if($menu=="saldo_pinjaman"){
					$lembar_kerja       = "menu-open";
					$lembar_kerja_saldo_pinjaman    = "active";
					$url        = "pages/data_saldo_pinjaman.php";
				}else if($menu=="saldo_simpanan"){
					$lembar_kerja       = "menu-open";
					$lembar_kerja_saldo_simpanan    = "active";
					$url        = "pages/data_saldo_simpanan.php";
				}else if($menu=="proses_gaji"){
					$lembar_kerja       = "menu-open";
					$lembar_kerja_gaji    = "active";
					$url        = "pages/data_proses_gaji.php";
				}else if($menu=="pemasukan"){
					$lembar_kerja       = "menu-open";
					$lembar_kerja_pemasukan    = "active";
					$url        = "pages/data_pemasukan.php";
				}else if($menu=="pengeluaran"){
					$lembar_kerja       = "menu-open";
					$lembar_kerja_pengeluaran    = "active";
					$url        = "pages/data_pengeluaran.php";
				}else if($menu=="pdl"){
					$lembar_kerja       = "menu-open";
					$lembar_kerja_pdl    = "active";
        //$url        = "pages/data_pdl.php";
				}
				else if($menu=="jurubuku"){
					$lembar_kerja       = "menu-open";
					$lembar_kerja_jurubuku    = "active";
        //$url        = "pages/data_pdl.php";
				}else if($menu=="rekapitulasi"){
					$laporan       = "menu-open";
					$laporan_rekapitulasi    = "active";
					$url        = "pages/data_rekapitulasi.php";
				}else if($menu=="laporan_bulanan"){
					$laporan       = "menu-open";
					$laporan_bulanan    = "active";
					$url        = "pages/data_lap_bulanan.php";
				}else if($menu=="kas_akhir"){
					$laporan       = "menu-open";
					$laporan_kas    = "active";
					$url        = "pages/data_kas_akhir.php";
				}else{
					$url 				= "pages/home.php";
				}
				?>

				<!-- Sidebar Menu -->
				<nav class="mt-2">
					<ul class="nav nav-pills nav-sidebar flex-column " data-widget="treeview" role="menu" data-accordion="false">

          <!-- Add icons to the links using the .nav-icon class
          	with font-awesome or any other icon font library -->

          	<li class="nav-item">
          		<a href="index.php" class="nav-link">
          			<i class="fa fa-home"></i>
          			<p>
          				Home

          			</p>
          		</a>
          	</li>


          	<li class="nav-item has-treeview <?php echo $master;?>">
          		<a href="#" class="nav-link">
          			<i class="nav-icon fas fa-copy"></i>
          			<p>
          				Data Master
          				<i class="fas fa-angle-left right"></i>

          			</p>
          		</a>
          		<ul class="nav nav-treeview">     
          			<?php if($LEVEL=="1" or $LEVEL = "3"){?>
          				<li class="nav-item">
          					<a href="/profil" class="nav-link <?php echo $master_profil;?>" id="menu_profil">
          						<i class="far fa-circle nav-icon"></i>
          						<p>
          							Profil KSP                
          						</p>
          					</a>
          				</li>
          				<li class="nav-item">
          					<a href="/pegawai" class="nav-link <?php echo $master_pegawai;?>" id="menu_pegawai">
          						<i class="far fa-circle nav-icon"></i>
          						<p>
          							Data Pegawai                
          						</p>
          					</a>
          				</li>
          				<li class="nav-item">
          					<a href="/inventaris" class="nav-link <?php echo $master_inventaris;?>">
          						<i class="far fa-circle nav-icon"></i> 
          						<p>
          							Data Inventaris               
          						</p>
          					</a>
          				</li>
          				<li class="nav-item">
          					<a href="/gaji" class="nav-link <?php echo $master_gaji;?>">
          						<i class="far fa-circle nav-icon"></i> 
          						<p>
          							Data Gaji Pegawai               
          						</p>
          					</a>
          				</li>
          				<li class="nav-item">
          					<a href="/unit" class="nav-link <?php echo $master_unit;?>">
          						<i class="far fa-circle nav-icon"></i>
          						<p>
          							Data Unit                
          						</p>
          					</a>
          				</li>
          				<li class="nav-item">
          					<a href="/resort" class="nav-link <?php echo $master_resort;?>">
          						<i class="far fa-circle nav-icon"></i>
          						<p>
          							Data Resort                
          						</p>
          					</a>
          				</li>
          				<li class="nav-item">
          					<a href="/data-master-pilihan" class="nav-link <?php echo $master_pilihan;?>">
          						<i class="far fa-circle nav-icon"></i>
          						<p>
          							Data Master Pilihan                
          						</p>
          					</a>
          				</li>
          			<?php } 
          			if($LEVEL!="3" and $LEVEL!="4"){
          				?>
          				<li class="nav-item">
          					<a href="/anggota" class="nav-link <?php echo $master_anggota;?>">
          						<i class="far fa-circle nav-icon"></i>
          						<p>
          							Data Anggota                
          						</p>
          					</a>
          				</li>
          			<?php } 
          			if($LEVEL=="1" or $LEVEL=="3"){
          				?>
          				<li class="nav-item">
          					<a href="/anggota_awal" class="nav-link <?php echo $master_anggota_awal;?>" id="menu_kas">
          						<i class="far fa-circle nav-icon"></i>
          						<p>
          							Anggota Awal Bulan              
          						</p>
          					</a>
          				</li>
          				<li class="nav-item">
          					<a href="/kas" class="nav-link <?php echo $master_kas;?>" id="menu_kas">
          						<i class="far fa-circle nav-icon"></i>
          						<p>
          							Kas Awal              
          						</p>
          					</a>
          				</li>
          				<li class="nav-item">
          					<a href="/kas-masuk" class="nav-link <?php echo $master_kas_masuk;?>" id="menu_kas">
          						<i class="far fa-circle nav-icon"></i>
          						<p>
          							Kas Masuk              
          						</p>
          					</a>
          				</li>
          				<li class="nav-item">
          					<a href="/drop_tunda" class="nav-link <?php echo $master_drop_tunda;?>" id="menu_drop">
          						<i class="far fa-circle nav-icon"></i>
          						<p>
          							Drop Tunda 
          						</p>
          					</a>
          				</li>
          				<li class="nav-item">
          					<a href="/saldo_macet" class="nav-link <?php echo $master_kemacetan;?>" id="menu_kas">
          						<i class="far fa-circle nav-icon"></i>
          						<p>
          							Saldo Kemacetan Awal              
          						</p>
          					</a>
          				</li>
          				
          				<?php if($PERMISSION == 9 && $LEVEL != 1) : ?>
          					<li class="nav-item">
          						<a href="/data-master-user-kasir" class="nav-link <?php echo $master_user_kasir;?>">
          							<i class="far fa-circle nav-icon"></i>
          							<p>
          								Data Master User Kasir                
          							</p>
          						</a>
          					</li>
          					<li class="nav-item">
          						<a href="/data-master-cabang" class="nav-link <?php echo $master_cabang;?>">
          							<i class="far fa-circle nav-icon"></i>
          							<p>
          								Data Master Cabang                
          							</p>
          						</a>
          					</li>
          					<li class="nav-item">
          						<a href="/data-backup-database" class="nav-link <?php echo $master_backup_database;?>" id="menu_kas">
          							<i class="far fa-circle nav-icon"></i>
          							<p>
          								Backup Database              
          							</p>
          						</a>
          					</li>
          				<?php endif ?>
          			<?php } ?>

          		</ul>
          	</li>

          	<li class="nav-item has-treeview <?php echo $lembar_kerja;?>">
          		<a href="#" class="nav-link">
          			<i class="nav-icon fas fa-copy"></i>
          			<p>
          				Lembar Kerja
          				<i class="fas fa-angle-left right"></i>

          			</p>
          		</a>
          		<ul class="nav nav-treeview">  
          			<?php if($LEVEL=="1" or $LEVEL=="2"){?>   
          				<li class="nav-item">
          					<a href="/pdl" class="nav-link <?php echo $lembar_kerja_pdl;?>">
          						<i class="far fa-circle nav-icon"></i> 
          						<p>
          							PDL                
          						</p>
          					</a>
          				</li>
          			<?php } 
          			if($LEVEL=="1" or $LEVEL=="4"){
          				?>
          				<li class="nav-item ">
          					<a href="/jurubuku" class="nav-link <?php echo $lembar_kerja_jurubuku;?>">
          						<i class="far fa-circle nav-icon"></i> 
          						<p>
          							Juru Buku             
          						</p>
          					</a>
          				</li>
          			<?php } 
          			if($LEVEL=="1" or $LEVEL=="3"){

          				?>
          				<li class="nav-item">
          					<a href="/kasir" class="nav-link <?php echo $lembar_kerja_kasir;?>">
          						<i class="far fa-circle nav-icon"></i>
          						<p>
          							Kasir               
          						</p>
          					</a>
          				</li>
          				<li class="nav-item">
          					<a href="/proses_gaji" class="nav-link <?php echo $lembar_kerja_gaji;?>">
          						<i class="far fa-circle nav-icon"></i>
          						<p>
          							Pembayaran gaji               
          						</p>
          					</a>
          				</li>
          				<li class="nav-item">
          					<a href="/pemasukan" class="nav-link <?php echo $lembar_kerja_pemasukan;?>">
          						<i class="far fa-circle nav-icon"></i>
          						<p>
          							Pengembalian 5% Pimpinan               
          						</p>
          					</a>
          				</li>
          				<li class="nav-item">
          					<a href="/pengeluaran" class="nav-link <?php echo $lembar_kerja_pengeluaran;?>">
          						<i class="far fa-circle nav-icon"></i>
          						<p>
          							SETOR PUSAT               
          						</p>
          					</a>
          				</li>
          				<li class="nav-item">
          					<a href="/kemacetan" class="nav-link <?php echo $lembar_kerja_kemacetan;?>">
          						<i class="far fa-circle nav-icon"></i>
          						<p>
          							Kemacetan            
          						</p>
          					</a>
          				</li>
          				<li class="nav-item">
          					<a href="/saldo_pinjaman" class="nav-link <?php echo $lembar_kerja_saldo_pinjaman;?>">
          						<i class="far fa-circle nav-icon"></i>
          						<p>
          							Saldo Pinjaman Awal            
          						</p>
          					</a>
          				</li>
          				<li class="nav-item">
          					<a href="/saldo_simpanan" class="nav-link <?php echo $lembar_kerja_saldo_simpanan;?>">
          						<i class="far fa-circle nav-icon"></i>
          						<p>
          							Saldo Simpanan Awal            
          						</p>
          					</a>
          				</li>
          			<?php }?>
          		</ul>
          	</li>
          	<?php if($LEVEL=="1" or $LEVEL=="3"){?>
          		<li class="nav-item has-treeview <?php echo $laporan;?>">
          			<a href="#" class="nav-link">
          				<i class="far fa-copy nav-icon"></i>
          				<p>
          					Laporan
          					<i class="fas fa-angle-left right"></i>

          				</p>
          			</a>
          			<ul class="nav nav-treeview">   

          				<li class="nav-item">
          					<a href="/kas_akhir" class="nav-link <?php echo $laporan_kas;?>">
          						<i class="far fa-circle nav-icon"></i>
          						<p>
          							Kas                
          						</p>
          					</a>
          				</li>
		<!--
            
              <li class="nav-item ">
                <a href="#link_akademik" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                    Gaji             
                  </p>
                </a>
              </li>

               <li class="nav-item">
                <a href="#link_sdm" class="nav-link">
                 <i class="far fa-circle nav-icon"></i>
                  <p>
                    Biaya Umum               
                  </p>
                </a>
              </li>
          -->
          <li class="nav-item">
          	<a href="/rekapitulasi" class="nav-link <?php echo $laporan_rekapitulasi;?>">
          		<i class="far fa-circle nav-icon"></i> 
          		<p>
          			Rekapitulasi               
          		</p>
          	</a>
          </li>
          <li class="nav-item">
          	<a href="/laporan_bulanan" class="nav-link <?php echo $laporan_bulanan;?>">
          		<i class="far fa-circle nav-icon"></i> 
          		<p>
          			Lap. Bulanan               
          		</p>
          	</a>
          </li>
              <!--
              <li class="nav-item">
                <a href="#link_sdm" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                    Simpanan               
                  </p>
                </a>
              </li>
          -->
      </ul>

  </li>
<?php } ?>

<li class="nav-item">
	<a href="logout.php" class="nav-link">
		<i class="fa fa-power-off"></i>
		<p>
			Keluar                
		</p>
	</a>
</li>
          <!--
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Layout Options
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right">6</span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pages/layout/top-nav.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Top Navigation</p>
                </a>
              </li>              
            </ul>
          </li>
      -->
  </ul>
</nav>
<!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->
</aside>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->


	<!-- /.content-header -->

	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<!-- KONTEN DUSINI --> 

			<div class="modal fade" id="modal_besar">
				<div class="modal-dialog modal-xl">
					<div id="tampil_modal_besar"></div>
				</div>
			</div>
			<div class="modal fade" id="modal_sedang">
				<div class="modal-dialog modal-lg">
					<div id="tampil_modal_sedang"></div>
				</div>
			</div>
			<div class="modal fade" id="modal_kecil">
				<div class="modal-dialog modal-sm">
					<div id="tampil_modal_kecil"></div>
				</div>
			</div>
			<div class="loading" style="display: none" id="wait_loading">Loading&#8230;</div>
			<?php
			if($menu=="pegawai"){
				include "pages/pegawai.php";
			}else if($menu=="inventaris"){
				include "pages/inventaris.php";
			}else if($menu=="profil"){
				include "pages/profil.php";
			}else if($menu=="kemacetan"){
				include "pages/kemacetan.php";
			}else if($menu=="saldo_pinjaman"){
				include "pages/saldo_pinjaman.php";
			}else if($menu=="saldo_simpanan"){
				include "pages/saldo_simpanan.php";
			}else if($menu=="gaji"){
				include "pages/gaji.php";
			}else if($menu=="proses_gaji"){
				include "pages/proses_gaji.php";
			}else if($menu=="resort"){
				include "pages/resort.php";
			}else if($menu=="resort"){
				include "pages/resort.php";
			}else if($menu=="unit"){
				include "pages/unit.php";
			}else if($menu=="anggota"){
				include "pages/anggota.php";
			}else if($menu=="kasir"){
				if(isset($_POST['tambah_akomodasi']) or isset($_POST['hapus_akomodasi'])){
					$tab_kasir = 2;
				}
				if(isset($_POST['tambah_bon_panjer']) or isset($_POST['hapus_bon_panjer'])){
					$tab_kasir = 3;
				}
				if(isset($_POST['tambah_bon_prive']) or isset($_POST['hapus_bon_prive'])){
					$tab_kasir = 4;
				}
				if(isset($_POST['tambah_operasional']) or isset($_POST['hapus_operasional'])){
					$tab_kasir = 5;
				}
				if(isset($_POST['tambah_lain']) or isset($_POST['hapus_lain'])){
					$tab_kasir = 7; 
				}
				include "pages/kasir.php";
			}else if($menu=="pdl"){        
				include "pages/pdl.php";
			}else if($menu=="jurubuku"){        
				include "pages/jurubuku.php";
			}else if($menu=="kas"){
				include "pages/kas_awal.php";
			}else if($menu=="kas-masuk"){
				include "pages/kas_masuk.php";
			}else if($menu=="drop_tunda"){
				include "pages/drop_tunda.php";
			}else if($menu=="anggota_awal"){
				include "pages/anggota_awal.php";
			}else if($menu=="saldo_macet"){
				include "pages/saldo_macet.php";
			}else if($menu=="kas_akhir"){
				include "pages/kas_akhir.php";
			}else if($menu=="pemasukan"){
				include "pages/pemasukan.php";
			}else if($menu=="pengeluaran"){
				include "pages/pengeluaran.php";
			}

			?>

			<div id="tampil_content"></div>         
		</div><!--/. container-fluid -->
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-light">
	<!-- Control sidebar content goes here -->
	<br>
	<center><label>Daftar Aplikasi</label></center>
	<hr>

	<div class="container-fluid">

	</div>
</aside>
<!-- /.control-sidebar -->

<!-- Main Footer -->
<footer class="main-footer small">
	<strong>Copyright &copy; 2021 <a href="index.php">Sistem Informasi  <?php echo $nama_owner;?></a>.</strong>
	All rights reserved.
	<div class="float-right d-none d-sm-inline-block small">
		<b>Version</b> 1.0
	</div>
</footer>
</div>

<!-- ./wrapper -->



<!-- page script -->
<script>
	$(function () {

		$("#example3").DataTable({
			"responsive": true,
			"autoWidth": true,
		});
		$("#example1").DataTable({


		});
		$("#example2").DataTable({
			"responsive": true,
			"autoWidth": true,
		});
		$('#example0').DataTable({
			"paging": true,
			"lengthChange": true,
			"length":25,
			"ordering": true,
			"info": true,
			"autoWidth": true,
			"responsive": true,
		});



		<?php 
      //if($menu=="pegawai"){
		?>
		$(document).ajaxStart(function(){
            //$("#tampil_content").html("<br><br><div class='alert alert-info'>Sedang Memproses Data</div>");
            //toastr.info('Proses Data')

            $("#wait_loading").css("display", "block");

        }); 
		$(document).ajaxComplete(function(){
			$("#wait_loading").css("display", "none");

		});
		<?php
		if($menu!="pdl" and $menu!="jurubuku" and $menu!="anggota"){
			?>
      //alert("Aa");
      $.ajax({
      	type : 'post',
      	url: "<?php echo $url;?>",
      	data: "tab=",
      	cache: false,
      	success: function(msg){
      		$("#tampil_content").html(msg);
      	}
      });
  <?php } ?>
  $("#tampil_data_anggota").click(function(){
  	var anggota_resort_id = $("#anggota_resort_id").val();                                            

  	$.ajax({
  		type : 'post',
  		url: "pages/data_anggota.php",
  		data: "resort_id="+anggota_resort_id,
  		cache: false,
  		success: function(msg){
  			$("#tampil_content").html(msg);
  		}
  	});
  });
  <?php if($menu=="anggota"){ ?>

  	var anggota_resort_id = $("#anggota_resort_id").val();                                            

  	$.ajax({
  		type : 'post',
  		url: "pages/data_anggota.php",
  		data: "resort_id="+anggota_resort_id,
  		cache: false,
  		success: function(msg){
  			$("#tampil_content").html(msg);
  		}
  	});


  <?php } ?>

  $("#tampil_data_pdl").click(function(){
  	var pdl_tgl = $("#pdl_tgl").val();
  	var pdl_resort_id = $("#pdl_resort_id").val();
  	var nama = $("#nama").val();



  	$.ajax({
  		type : 'post',
  		url: "pages/data_pdl.php",
  		data: "pdl_tgl="+pdl_tgl+"&pdl_resort_id="+pdl_resort_id+"&nama="+nama,
  		cache: false,
  		success: function(msg){
  			$("#tampil_content").html(msg);
  		}
  	});
  });
  <?php if($menu=="pdl"){ ?>
  	var pdl_tgl = $("#pdl_tgl").val();
  	var pdl_resort_id = $("#pdl_resort_id").val();
  	var tab = $("#tab").val();


  	$.ajax({
  		type : 'post',
  		url: "pages/data_pdl.php",
  		data: "pdl_tgl="+pdl_tgl+"&pdl_resort_id="+pdl_resort_id+"&tab="+tab,
  		cache: false,
  		success: function(msg){
  			$("#tampil_content").html(msg);
  		}
  	});


  <?php } ?>


  $("#tampil_data_jurubuku").click(function(){
  	var pdl_tgl = $("#pdl_tgl").val();
  	var pdl_resort_id = $("#pdl_resort_id").val();



  	$.ajax({
  		type : 'post',
  		url: "pages/data_jurubuku.php",
  		data: "pdl_tgl="+pdl_tgl+"&pdl_resort_id="+pdl_resort_id,
  		cache: false,
  		success: function(msg){
  			$("#tampil_content").html(msg);
  		}
  	});
  });
  <?php if($menu=="jurubuku"){ ?>
  	var pdl_tgl = $("#pdl_tgl").val();
  	var pdl_resort_id = $("#pdl_resort_id").val();
  	var tab = $("#tab").val();


  	$.ajax({
  		type : 'post',
  		url: "pages/data_jurubuku.php",
  		data: "pdl_tgl="+pdl_tgl+"&pdl_resort_id="+pdl_resort_id+"&tab="+tab,
  		cache: false,
  		success: function(msg){
  			$("#tampil_content").html(msg);
  		}
  	});


  <?php } ?>


});
</script>

<!-- OPTIONAL SCRIPTS 
<script src="dist/js/demo.js"></script>
-->
<!-- PAGE PLUGINS -->
<!-- jQuery Mapael 
<script src="plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="plugins/raphael/raphael.min.js"></script>
<script src="plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="plugins/jquery-mapael/maps/usa_states.min.js"></script>
-->
<!-- ChartJS 
<script src="plugins/chart.js/Chart.min.js"></script>
-->
<!-- PAGE SCRIPTS 
<script src="dist/js/pages/dashboard2.js"></script>
-->
</body>
</html>
<?php
}else {
      //include "login/index.php";
	echo "<meta http-equiv='refresh' content='0; url=login.php'>";
}
?>
