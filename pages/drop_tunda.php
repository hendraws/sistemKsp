           
<?php

if(isset($_POST["tambah"])){
	include  "lib/koneksi.php";
	$drop_tunda 		= $_POST['drop_tunda'];
	$bulan          = $bulan;
//	echo "insert into tbl_kas_awal(kas_nominal,kas_bulan) values('$kas_nominal','$kas_bulan')";
	$up =mysqli_query($con,"insert into tbl_drop_tunda(drop_tunda,bulan) values('$drop_tunda','$bulan')");
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
	$drop_tunda 		= $_POST['drop_tunda'];
	$id_drop 			= $_POST['id_drop'];
	
	$up =mysqli_query($con,"update tbl_drop_tunda set drop_tunda='$drop_tunda' where id_drop='$id_drop'");
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