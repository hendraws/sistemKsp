<?php
session_start();
	// var_dump($_POST);  die;
if(isset($_POST["tambah_data"])){

	include  "../lib/koneksi.php";

	$unit_nama 		= $_POST['unit_nama'];
	$created_by 		= $_SESSION['USER_ID'];

	$up = mysqli_query($con,"insert into tbl_unit(unit_nama,created_by) values('$unit_nama','$created_by')")  or die(mysqli_error($con));

	if($up){
		$_SESSION['message'] = 'Tambah Data Berhasil';
		header('Location: /data-master-cabang');
		
	}else{
		$result['status'] = 500;
		$result['message'] = mysqli_error($con);
	}
	
	echo json_encode($result);
}

if(isset($_POST["update"])){
	include  "../lib/koneksi.php";

	$unit_nama     = $_POST['unit_nama'];
	$unit_id     = $_POST['unit_id'];
	
	$up =mysqli_query($con,"update tbl_unit set unit_nama='$unit_nama' where unit_id='$unit_id'");
	if($up){
		$_SESSION['message'] = 'Perubahan Data Berhasil';
		header('Location: /data-master-cabang');
		?>
		<?php
	}else{
		var_dump($up);  die;
		?>
		<script type="text/javascript">
			toastr.danger('Perubahan data gagal disimpan');
		</script>
		<?php
	}
}

if(isset($_POST["delete"])){
	include  "../lib/koneksi.php";

	$unit_id     = $_POST['unit_id'];
	$up=mysqli_query($con,"DELETE FROM tbl_unit WHERE unit_id='$unit_id'") or die(mysqli_error($con)) ;

	if($up){
		$_SESSION['message'] = 'Hapus Data Berhasil';
		header('Location: /data-master-cabang');
		?>
		<?php
	}else{
		var_dump($up);  die;
		?>
		<?php
	}
}
?>