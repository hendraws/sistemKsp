     <?php
     include  "lib/koneksi.php";


  /* ---------------------------------------------- simpanan ------------------------ */
  if(isset($_POST['update'])){
    $nama       = $_POST['nama'];
    $alamat     = $_POST['alamat'];
    $gambar     = $_FILES['gambar']['name'];

    if($gambar!=""){
       move_uploaded_file($_FILES['gambar']['tmp_name'], $gambar) or die ("Error: gagal upload");
       mysqli_query($con, "update tbl_owner set nama='$nama',alamat='$alamat',gambar='$gambar'");

    }else{
       mysqli_query($con, "update tbl_owner set nama='$nama',alamat='$alamat'");
    }
   
      }

