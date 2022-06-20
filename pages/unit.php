     <?php
     include  "lib/koneksi.php";

if(isset($_POST['update'])){
    $unit_id           = $_POST['unit_id'];
    $unit_nama         = $_POST['unit_nama'];
    
   

    ?>

    <?php
    if($unit_id!=""){
      $up=mysqli_query($con,"update tbl_unit set unit_nama='$unit_nama' where unit_id='$unit_id'");
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
      $up=mysqli_query($con,"insert into tbl_unit (unit_nama) values('$unit_nama')");
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
    $unit_id           = $_POST['unit_id'];
   

    ?>

    <?php
   
      $up=mysqli_query($con,"delete from tbl_unit where unit_id='$unit_id'");
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