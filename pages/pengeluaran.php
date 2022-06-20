     <?php
     include  "lib/koneksi.php";

if(isset($_POST['update'])){
    $pengeluaran_id           = $_POST['pengeluaran_id'];
    $pengeluaran         = $_POST['pengeluaran'];
    $nominal           = $_POST['nominal'];
    
    ?>

    <?php
    if($pengeluaran_id!=""){
      $up=mysqli_query($con,"update tbl_pengeluaran set pengeluaran='$pengeluaran',nominal='$nominal' where pengeluaran_id='$pengeluaran_id'");
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
      $up=mysqli_query($con,"insert into tbl_pengeluaran (pengeluaran,nominal,bulan) values('$pengeluaran','$nominal','$bulan')");
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
    $pengeluaran_id           = $_POST['pengeluaran_id'];
   

    ?>

    <?php
   
      $up=mysqli_query($con,"delete from tbl_pengeluaran where pengeluaran_id='$pengeluaran_id'");
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