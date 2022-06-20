     <?php
     include  "lib/koneksi.php";


  if(isset($_POST['update_saldo'])){
 
  $saldo_id   = $_POST['saldo_id'];
  $saldo_simpanan = $_POST['saldo_simpanan'];

  $jum            = count($saldo_id);
  for($x=0;$x<$jum;$x++){
    $saldo_simpanan_ok    = $saldo_simpanan[$x];
 
    $saldo_id_ok    = $saldo_id[$x];
    $q=mysqli_query($con, "update tbl_saldo_simpanan set saldo_simpanan='$saldo_simpanan_ok' where saldo_id='$saldo_id_ok'");
  
  }
  if($q){
    ?>
    <div class="alert alert-success">Data  Tersimpan</div>
    <?php
  }
  
}


?>