<?php
include 	"../lib/koneksi.php";

if(isset($_POST['update_pegawai'])){
    $pegawai_id           = $_POST['pegawai_id'];
    $pegawai_nama         = $_POST['pegawai_nama'];
    $pegawai_jk           = $_POST['pegawai_jk'];
    $pegawai_nik          = $_POST['pegawai_nik'];
    $pegawai_telp         = $_POST['pegawai_telp'];
    $jabatan_id           = $_POST['jabatan_id'];

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
      $up=mysqli_query($con,"insert into tbl_pegawai (pegawai_nama,pegawai_jk,
        pegawai_nik,pegawai_telp,jabatan_id) values('$pegawai_nama','$pegawai_jk',
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
    ?>

    <?php
  }

?>
<meta http-equiv="refresh" content='0; url=/pegawai' />
