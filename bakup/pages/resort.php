     <?php
     include  "lib/koneksi.php";

if(isset($_POST['update'])){
    $resort_id           = $_POST['resort_id'];
    $resort_nama         = $_POST['resort_nama'];
    $unit_id         = $_POST['unit_id'];
    
    $pegawai_id           = $_POST['pegawai_id'];

    ?>

    <?php
    if($resort_id!=""){
      $up=mysqli_query($con,"update tbl_resort set resort_nama='$resort_nama',pegawai_id='$pegawai_id',unit_id='$unit_id' where resort_id='$resort_id'");
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
      $up=mysqli_query($con,"insert into tbl_resort (resort_nama,pegawai_id,unit_id) values('$resort_nama','$pegawai_id','$unit_id')");
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
    $resort_id           = $_POST['resort_id'];
   

    ?>

    <?php
   
      $up=mysqli_query($con,"delete from tbl_resort where resort_id='$resort_id'");
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