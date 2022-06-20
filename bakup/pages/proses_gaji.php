     <?php
     include  "lib/koneksi.php";

if(isset($_POST['update'])){
    $pegawai_id           = $_POST['pegawai_id'];
    $gaji_pokok         = $_POST['gaji_pokok'];
    
    $gaji_prive          = $_POST['gaji_prive'];
    $gaji_panjer         = $_POST['gaji_panjer'];
    $gaji_lain          = $_POST['gaji_lain'];
    $gaji_tabungan          = $_POST['gaji_tabungan'];
    $gaji_potongan      = $gaji_lain+$gaji_panjer+$gaji_prive+$gaji_tabungan;
    
    $gaji_tgl           = date("Y-m-d H:i:s");
    $gaji_jabatan       = $_POST['gaji_jabatan'];
    $gaji_masa_kerja    = $_POST['gaji_masa_kerja'];
    $gaji_pendidikan    = $_POST['gaji_pendidikan'];
    $gaji_kompetensi    = $_POST['gaji_kompetensi'];
    $gaji_tunjangan           = $gaji_jabatan+$gaji_masa_kerja+$gaji_pendidikan+$gaji_kompetensi;
    $gaji_diterima      = ($gaji_pokok+$gaji_tunjangan)-$gaji_potongan;

    $qcek=mysqli_query($con,"select pegawai_id from tbl_gaji where pegawai_id='$pegawai_id' and gaji_bulan='$bulan'");
    $cek = mysqli_num_rows($qcek);
   
    ?>

    <?php
    if($cek>0){
      $up=mysqli_query($con,"update tbl_gaji set gaji_tabungan='$gaji_tabungan', gaji_pokok='$gaji_pokok',gaji_tunjangan='$gaji_tunjangan',
        gaji_potongan='$gaji_potongan',gaji_prive='$gaji_prive',gaji_panjer='$gaji_panjer',gaji_lain='$gaji_lain',gaji_tgl='$gaji_tgl',gaji_diterima='$gaji_diterima',gaji_jabatan='$gaji_jabatan',gaji_masa_kerja='$gaji_masa_kerja',gaji_pendidikan='$gaji_pendidikan',gaji_kompetensi='$gaji_kompetensi' where pegawai_id='$pegawai_id' and gaji_bulan='$bulan'");
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
      $gaji_id="GAJI-$pegawai_id-".round(microtime(true) * 1000);
      $up=mysqli_query($con,"insert into tbl_gaji (gaji_tgl,pegawai_id,gaji_bulan,
        gaji_pokok,gaji_tunjangan,gaji_potongan,gaji_prive,gaji_panjer,gaji_lain,gaji_diterima,gaji_id,gaji_jabatan,gaji_masa_kerja,gaji_pendidikan,gaji_kompetensi,gaji_tabungan) values('$gaji_tgl','$pegawai_id','$bulan',
        '$gaji_pokok','$gaji_tunjangan','$gaji_potongan','$gaji_prive','$gaji_panjer','$gaji_lain','$gaji_diterima','$gaji_id','$gaji_jabatan','$gaji_masa_kerja','$gaji_pendidikan','$gaji_kompetensi','$gaji_tabungan')");
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

