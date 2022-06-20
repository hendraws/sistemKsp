           
<?php

if(isset($_POST["tambah"])){
	include  "lib/koneksi.php";
	$macet_nominal 		= $_POST['macet_nominal'];
	//$kas_bulan          = $bulan."-01";
   $tgl1 = $bulan;
                           
    $bulan_lalu = date('Y-m', strtotime('-1 month', strtotime($tgl1))); 
//	echo "insert into tbl_kas_awal(kas_nominal,kas_bulan) values('$kas_nominal','$kas_bulan')";
	$up =mysqli_query($con,"insert into tbl_saldo_kemacetan(macet_nominal,macet_bulan) values('$macet_nominal','$bulan_lalu')");
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
	$macet_nominal 		= $_POST['macet_nominal'];
	$saldo_macet_id 			= $_POST['saldo_macet_id'];
	
	$up =mysqli_query($con,"update tbl_saldo_kemacetan set macet_nominal='$macet_nominal' where saldo_macet_id='$saldo_macet_id'");
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