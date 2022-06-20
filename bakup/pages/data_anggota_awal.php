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
                <h5 class="card-title">Anggota Awal <?php echo tanggal($bulan);?></h5>

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
$q=mysqli_query($con,"select anggota_awal_id,anggota_awal from tbl_anggota_awal where anggota_bulan like '$bulan%'");
$cek=mysqli_num_rows($q);
$data=mysqli_fetch_array($q,MYSQLI_ASSOC);
$anggota_awal_id   = $data['anggota_awal_id'];
$anggota_awal = $data['anggota_awal'];
if($cek==0){
	echo "<div class='alert alert-danger'>Anggota awal Belum diinput</div>";
	?>
	<form method="POST" action="/anggota_awal">
		
		<input type="hidden" name="anggota_awal_id" value="<?php echo $anggota_awal_id;?>">
		<label>Anggota Awal bulan</label>
		<input type="text" class="form-control" name="anggota_awal" value="<?php echo $anggota_awal;?>"  style="width: 50%">
		<br>

		<input type="submit" class="btn btn-sm btn-primary" name="tambah" value="Simpan">
	</form>
	<?php
}else{
	?>
	<form method="POST" action="/anggota_awal">
		
		<input type="hidden" name="anggota_awal_id" value="<?php echo $anggota_awal_id;?>">
		<label>Anggota Awal bulan</label>
		<input type="text" class="form-control" name="anggota_awal" value="<?php echo $anggota_awal;?>" style="width: 50%">
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