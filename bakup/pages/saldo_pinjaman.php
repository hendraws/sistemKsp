     <?php
     include  "lib/koneksi.php";


  if(isset($_POST['update_saldo'])){
 
  $saldo_id   = $_POST['saldo_id'];
  $saldo_pinjaman = $_POST['saldo_pinjaman'];

  $jum            = count($saldo_id);
  for($x=0;$x<$jum;$x++){
    $saldo_pinjaman_ok 		= $saldo_pinjaman[$x];
 
    $saldo_id_ok 		= $saldo_id[$x];
    $q=mysqli_query($con, "update tbl_saldo_pinjaman set saldo_pinjaman='$saldo_pinjaman_ok' where saldo_id='$saldo_id_ok'");
  
  }
  if($q){
  	?>
  	<div class="alert alert-success">Data  Tersimpan</div>
  	<?php
  }
	
}


?>