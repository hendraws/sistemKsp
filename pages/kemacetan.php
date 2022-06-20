     <?php
     include  "lib/koneksi.php";


  if(isset($_POST['update_kemacetan'])){
 
  $kemacetan_id   = $_POST['kemacetan_id'];
  $kemacetan_baru = $_POST['macet_baru'];
  $angsuran 	  = $_POST['angsuran'];
  $plus 		  = $_POST['plus'];
  $minus 		  = $_POST['minus'];
  $jum            = count($kemacetan_id);
  for($x=0;$x<$jum;$x++){
    $kemacetan_baru_ok 		= $kemacetan_baru[$x];
    $angsuran_ok 			= $angsuran[$x];
    $plus_ok 				= $plus[$x];
    $minus_ok 				= $minus[$x];
    $kemacetan_id_ok 		= $kemacetan_id[$x];
    $q=mysqli_query($con, "update tbl_kemacetan set kemacetan_baru='$kemacetan_baru_ok',angsuran='$angsuran_ok',plus='$plus_ok',minus='$minus_ok' where kemacetan_id='$kemacetan_id_ok'");
  
  }
  if($q){
  	?>
  	<div class="alert alert-success">Data Kemacetan Tersimpan</div>
  	<?php
  }
	
}


?>