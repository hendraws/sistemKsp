<?php
session_start();
	// var_dump($_POST);  die;
if(isset($_POST["tambah_data"])){
	include  "../lib/koneksi.php";

	$bu_nama 		= $_POST['bu_nama'];
	$bu_kategori 		= $_POST['bu_kategori'];

	$up = mysqli_query($con,"insert into tbl_biayaumum(bu_nama,bu_kategori) values('$bu_nama','$bu_kategori')")  or die(mysqli_error($con));

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
	include  "../lib/koneksi.php";

	$bu_nama     = $_POST['bu_nama'];
	$bu_kategori     = $_POST['bu_kategori'];
	$bu_id     = $_POST['bu_id'];
	
	$up =mysqli_query($con,"update tbl_biayaumum set bu_nama='$bu_nama', bu_kategori='$bu_kategori' where bu_id='$bu_id'");
	if($up){
		$_SESSION['message'] = 'Perubahan Data Berhasil';
		header('Location: /data-master-pilihan');
		?>
		<script type="text/javascript">
			window.location.href('/asdf');
		</script>
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

	$bu_id     = $_POST['bu_id'];
	 $up=mysqli_query($con,"DELETE FROM tbl_biayaumum WHERE bu_id='$bu_id'") or die(mysqli_error($con)) ;

	if($up){
		$_SESSION['message'] = 'Hapus Data Berhasil';
		header('Location: /data-master-pilihan');
		?>
		<script type="text/javascript">
			window.location.href('/asdf');
		</script>
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
?>