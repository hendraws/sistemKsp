     <?php
     include  "lib/koneksi.php";


     /* ---------------------------------------------- simpanan ------------------------ */
     if(isset($_POST['update'])){
     	$nama       = $_POST['nama'];
     	$alamat     = $_POST['alamat'];
     	$gambar     = $_FILES['gambar']['name'];

     	if($gambar!=""){
     		move_uploaded_file($_FILES['gambar']['tmp_name'], $gambar) or die ("Error: gagal upload");
     		mysqli_query($con, "update tbl_owner set nama='$nama',alamat='$alamat',gambar='$gambar' where cabang = $cabang");
     	}else{
     		mysqli_query($con, "update tbl_owner set nama='$nama',alamat='$alamat'");
     	}

     }

     if(isset($_POST['simpan'])){
     	$nama       = $_POST['nama'];
     	$alamat     = $_POST['alamat'];
     	$gambar     = $_FILES['gambar']['name'];

     	if($gambar!=""){
     		// var_dump(is_writable($_SERVER['DOCUMENT_ROOT'] . "/images") );  die;
     		move_uploaded_file($_FILES['gambar']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] ."/". $_FILES['gambar']['name']) or die ($_SERVER['DOCUMENT_ROOT']);
     		mysqli_query($con, "INSERT INTO tbl_owner (nama, alamat, gambar,cabang) VALUES ('$nama','$alamat','$gambar','$cabang')");
     	}
     	
     }

