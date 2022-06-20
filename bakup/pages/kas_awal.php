           
<?php

if(isset($_POST["tambah"])){
	include  "lib/koneksi.php";
	$kas_nominal 		= $_POST['kas_nominal'];
	$kas_bulan          = $bulan."-01";
//	echo "insert into tbl_kas_awal(kas_nominal,kas_bulan) values('$kas_nominal','$kas_bulan')";
	$up =mysqli_query($con,"insert into tbl_kas_awal(kas_nominal,kas_bulan) values('$kas_nominal','$kas_bulan')");
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
}
if(isset($_POST["update"])){
	include  "lib/koneksi.php";
	$kas_nominal 		= $_POST['kas_nominal'];
	$kas_id 			= $_POST['kas_id'];
	
	$up =mysqli_query($con,"update tbl_kas_awal set kas_nominal='$kas_nominal' where kas_id='$kas_id'");
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
}
?>