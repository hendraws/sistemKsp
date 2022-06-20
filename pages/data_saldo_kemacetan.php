<?php session_start();

    
      $USERNAME   = $_SESSION['USERNAME'];
      $USER_ID       = $_SESSION['USER_ID'];
      $NAMA       = $_SESSION['NAMA'];
      $LEVEL           = $_SESSION['LEVEL'];
      $bulan           = $_SESSION['BULAN'];
include  "../lib/koneksi.php";
?>
<br>
<br>
<div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header bg-gray-dark" >
                <h5 class="card-title">Saldo Kemacetan Awal <?php echo tanggal($bulan);?></h5>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>                  
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">

              
<?php
$bulan_lalu = date('Y-m', strtotime('-1 month', strtotime($bulan))); 
$q=mysqli_query($con,"select saldo_macet_id,macet_nominal from tbl_saldo_kemacetan where macet_bulan= '$bulan_lalu'");
$cek=mysqli_num_rows($q);
$data=mysqli_fetch_array($q,MYSQLI_ASSOC);
$saldo_macet_id   = $data['saldo_macet_id'];
$macet_nominal = $data['macet_nominal'];
if($cek==0){
	echo "<div class='alert alert-danger'>saldo kemacetan Awal Belum diinput</div>";
	?>
	<form method="POST" action="/saldo_macet">
		
		<input type="hidden" name="saldo_macet_id" value="<?php echo $saldo_macet_id;?>">
		<label>Nominal</label>
		<input type="text" class="form-control" name="macet_nominal" value="<?php echo $macet_nominal;?>"  style="width: 50%">
		<br>

		<input type="submit" class="btn btn-sm btn-primary" name="tambah" value="Simpan">
	</form>
	<?php
}else{
	?>
	<form method="POST" action="/saldo_macet">
		
		<input type="hidden" name="saldo_macet_id" value="<?php echo $saldo_macet_id;?>">
		<label>Nominal</label>
		<input type="text" class="form-control" name="macet_nominal" value="<?php echo $macet_nominal;?>" style="width: 50%">
		<br>
		<input type="submit" class="btn btn-sm btn-primary" name="update" value="Simpan">
	</form>
	<?php
}

?>
</div>
            </div>
        </div>
</div>