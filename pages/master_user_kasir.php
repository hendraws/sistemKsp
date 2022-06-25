<?php
session_start();
	include  "../lib/koneksi.php";
	// var_dump($_POST);  die;
if(isset($_POST["tambah_data"])){

	$user_nama 		= $_POST['user_nama'];
	$user_name 		= $_POST['user_name'];
	$user_pass 		= md5($_POST['user_pass']);
	$cabang 		= $_POST['cabang'];
	$user_level 		= $_POST['user_level'];

	$up = mysqli_query($con,"insert into tbl_user(user_nama,user_name,user_pass,cabang,user_level) values('$user_nama','$user_name','$user_pass','$cabang','$user_level')")  or die(mysqli_error($con));


	if($up){
		$_SESSION['message'] = 'Tambah Data Berhasil';
		header('Location: /data-master-user-kasir');
		
	}else{
		var_dump('eror');  die;
		$result['status'] = 500;
		$result['message'] = mysqli_error($con);
	}
	
	echo json_encode($result);
}

if(isset($_POST["update"])){

	$user_id     = $_POST['user_id'];
	$user_nama 		= $_POST['user_nama'];
	$user_name 		= $_POST['user_name'];
	$cabang 		= $_POST['cabang'];
	$user_permission 		= $_POST['2'];
 
	$up =mysqli_query($con,"UPDATE tbl_user SET user_id = '$user_id', user_nama = '$user_nama', user_name = '$user_name', cabang = '$cabang' where user_id='$user_id'");
	if($up){
		$_SESSION['message'] = 'Perubahan Data Berhasil';
		header('Location: /data-master-user-kasir');
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


	$id     = $_POST['user_id'];
	$up=mysqli_query($con,"DELETE FROM tbl_user WHERE user_id='$id'") or die(mysqli_error($con)) ;

	if($up){
		$_SESSION['message'] = 'Hapus Data Berhasil';
		header('Location: /data-master-user-kasir');
		?>
		<?php
	}else{
		var_dump($up);  die;
		?>
		<?php
	}
}

if(isset($_POST["permission"])){

	$id     = $_POST['user_id'];
	$status = $_POST['status'] == 0 ? 2 : 0;

	$up=mysqli_query($con,"UPDATE tbl_user SET user_permission = '$status' where user_id='$id'") or die(mysqli_error($con)) ;

	if($up){
		$_SESSION['message'] = 'Perubahan Data Berhasil';
		header('Location: /data-master-user-kasir');
		?>
		<?php
	}else{
		var_dump($up);  die;
		?>
		<?php
	}
}
?>