     <?php
     include  "lib/koneksi.php";

if(isset($_POST['update'])){
    $pegawai_id           = $_POST['pegawai_id'];
    $pegawai_nama         = $_POST['pegawai_nama'];
    $pegawai_jk           = $_POST['pegawai_jk'];
    $pegawai_nik          = $_POST['pegawai_nik'];
    $pegawai_telp         = $_POST['pegawai_telp'];
    $jabatan_id           = $_POST['jabatan_id'];
    $user_pass           = $_POST['user_pass'];

    if($jabatan_id=="1"){
      $user_level = "0";
    }else if($jabatan_id=="2"){
      $user_level = "10";
    }else if($jabatan_id=="3"){
      $user_level = "10";
    }else if($jabatan_id=="4"){
      $user_level = "2";
    }else if($jabatan_id=="5"){
      $user_level = "10";
    }else if($jabatan_id=="6"){
      $user_level = "2";
    }else if($jabatan_id=="7"){
      $user_level = "3";
    }else if($jabatan_id=="8"){
      $user_level = "4";
    }else if($jabatan_id=="9"){
      $user_level = "10";
    }else if($pegawai_id=="admin"){
	$user_level ="1";
}

    ?>

    <?php
    if($pegawai_id!=""){
      $up=mysqli_query($con,"update tbl_pegawai set pegawai_nama='$pegawai_nama',pegawai_jk='$pegawai_jk',
        pegawai_nik='$pegawai_nik',pegawai_telp='$pegawai_telp',jabatan_id='$jabatan_id' where pegawai_id='$pegawai_id'");
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

    }else{
      $pegawai_id = date("Ymdhis");
      $up=mysqli_query($con,"insert into tbl_pegawai (pegawai_id,pegawai_nama,pegawai_jk,
        pegawai_nik,pegawai_telp,jabatan_id) values('$pegawai_id','$pegawai_nama','$pegawai_jk',
        '$pegawai_nik','$pegawai_telp','$jabatan_id')");
      if($up){
        ?>
        <script type="text/javascript">
          toastr.success('Tambah data berhasil disimpan');
        </script>
        <?php
      }else{
        ?>
        <script type="text/javascript">
          toastr.danger('Tambah data gagal disimpan');
        </script>
        <?php
      }
     
    }

    $qcek = mysqli_query($con,"select user_name from tbl_user where user_name='$pegawai_id'");
    if(mysqli_num_rows($qcek)>0){
      if($user_pass!=""){
        $passe=md5($user_pass);
        mysqli_query($con,"update tbl_user set user_pass='$passe',user_level='$user_level',user_nama='$pegawai_nama' where user_name='$pegawai_id'");
      }
    }else{
      $passe = md5($user_pass);
      mysqli_query($con,"insert into tbl_user(user_name,user_pass,user_nama,user_level) values('$pegawai_id','$passe','$pegawai_nama','$user_level')");
    }

    
  }


if(isset($_POST['delete'])){
    $pegawai_id           = $_POST['pegawai_id'];
   

    ?>

    <?php
   
      $up=mysqli_query($con,"delete from tbl_pegawai where pegawai_id='$pegawai_id'");
      if($up){
        ?>
        <script type="text/javascript">
          toastr.success('Data terhapus');
        </script>
        <?php
      }else{
        ?>
        <script type="text/javascript">
          toastr.danger('Data tidak terhapus');
        </script>
        <?php
      }

    
    
  }

?>