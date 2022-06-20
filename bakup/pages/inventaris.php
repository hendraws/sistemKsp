     <?php
     include  "lib/koneksi.php";

if(isset($_POST['update'])){
    $inven_id           = $_POST['inven_id'];
    $inven_nama         = $_POST['inven_nama'];
    $inven_nopol           = $_POST['inven_nopol'];
    $inven_stnk          = $_POST['inven_stnk'];
    $inven_tempo         = $_POST['inven_tempo'];
    $inven_transport           = $_POST['inven_transport'];
    $pegawai_id           = $_POST['pegawai_id'];

    ?>

    <?php
    if($inven_id!=""){
      $up=mysqli_query($con,"update tbl_inventaris set inven_nama='$inven_nama',inven_nopol='$inven_nopol',
        inven_stnk='$inven_stnk',inven_tempo='$inven_tempo',inven_transport='$inven_transport',pegawai_id='$pegawai_id' where inven_id='$inven_id'");
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
      $up=mysqli_query($con,"insert into tbl_inventaris (inven_nama,inven_nopol,inven_stnk,
        inven_tempo,inven_transport,pegawai_id) values('$inven_nama','$inven_nopol','$inven_stnk',
        '$inven_tempo','$inven_transport','$pegawai_id')");
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
    $inven_id           = $_POST['inven_id'];
   

    ?>

    <?php
   
      $up=mysqli_query($con,"delete from tbl_inventaris where inven_id='$inven_id'");
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