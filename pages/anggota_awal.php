<?php session_start();


if(isset($_POST["tambah"])){
	include  "lib/koneksi.php";
	$anggota_awal 		= $_POST['anggota_awal'];
	$anggota_bulan          = $bulan."-01";
	$CABANG = $_SESSION['CABANG'];
//	echo "insert into tbl_kas_awal(kas_nominal,kas_bulan) values('$kas_nominal','$kas_bulan')";
	$up =mysqli_query($con,"insert into tbl_anggota_awal(anggota_awal,anggota_bulan,cabang) values('$anggota_awal','$anggota_bulan', $CABANG)");
	if($up){
        ?>
        <script type="text/javascript">
          toastr.success('Perubahan data berhasil disimpan');
        </script>
        <?php
      }else{
        ?>
        <script type="text/javascript">
          toastr.danger('Perubahan data gagal disimpan');
        </script>
        <?php
      }
}
if(isset($_POST["update"])){
	include  "lib/koneksi.php";
	$anggota_awal 		= $_POST['anggota_awal'];
	$anggota_awal_id 			= $_POST['anggota_awal_id'];
	
	$up =mysqli_query($con,"update tbl_anggota_awal set anggota_awal='$anggota_awal' where anggota_awal_id='$anggota_awal_id'");
	if($up){
        ?>
        <script type="text/javascript">
          toastr.success('Perubahan data berhasil disimpan');
        </script>
        <?php
      }else{
        ?>
        <script type="text/javascript">
          toastr.danger('Perubahan data gagal disimpan');
        </script>
        <?php
      }
}
?>