<?php
session_start();
	// var_dump($_POST);  die;
if(isset($_POST["tambah_data"])){
	include  "../lib/koneksi.php";
	$kas_nominal 		= $_POST['kas_nominal'];
	$kas_bulan          = $_POST['bulan']."-01";
	$cabang          = $_SESSION['CABANG'];
//	echo "insert into tbl_kas_awal(kas_nominal,kas_bulan) values('$kas_nominal','$kas_bulan')";
	$up = mysqli_query($con,"insert into tbl_kas_masuk(nominal,tanggal,cabang) values('$kas_nominal','$kas_bulan','$cabang')")  or die(mysqli_error($con));

	if($up){
		$result['status'] = 200;
		$result['message'] = 'Berhasil Disimpan';		
	}else{
		$result['status'] = 500;
		$result['message'] = mysqli_error($con);
	}
	
	echo json_encode($result);
}

if(isset($_POST["update"])){
	include  "lib/koneksi.php";

	$kas_nominal 		= $_POST['kas_nominal'];
	$kas_id 			= $_POST['kas_id'];
	
	$up =mysqli_query($con,"update tbl_kas_awal set kas_nominal='$kas_nominal' where kas_id='$kas_id'");
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