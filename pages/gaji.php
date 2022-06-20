     <?php
     include  "lib/koneksi.php";

if(isset($_POST['update'])){
    $jabatan_id           = $_POST['jabatan_id'];
    $jabatan_nama         = $_POST['jabatan_nama'];
    $bon_prive           = $_POST['bon_prive'];
    $bon_panjer          = $_POST['bon_panjer'];
    $gaji_pokok         = $_POST['gaji_pokok'];
   
    ?>

    <?php
    if($jabatan_id!=""){
      $up=mysqli_query($con,"update tbl_jabatan set jabatan_nama='$jabatan_nama',bon_prive='$bon_prive',
        bon_panjer='$bon_panjer',gaji_pokok='$gaji_pokok' where jabatan_id='$jabatan_id'");
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
      //$pegawai_id = date("Ymdhis");
      $up=mysqli_query($con,"insert into tbl_jabatan (jabatan_nama,bon_panjer,bon_prive,
        gaji_pokok) values('$jabatan_nama','$bon_panjer','$bon_prive',
        '$gaji_pokok')");
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
    
  }


if(isset($_POST['delete'])){
    $jabatan_id           = $_POST['jabatan_id'];
   

    ?>

    <?php
   
      $up=mysqli_query($con,"delete from tbl_jabatan where jabatan_id='$jabatan_id'");
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