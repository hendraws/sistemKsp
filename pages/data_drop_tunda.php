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
                <h5 class="card-title">DROP Tunda <?php echo tanggal($bulan);?></h5>

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
$q=mysqli_query($con,"select id_drop,drop_tunda from tbl_drop_tunda where bulan like '$bulan%'");
$cek=mysqli_num_rows($q);
$data=mysqli_fetch_array($q,MYSQLI_ASSOC);
$id_drop   = $data['id_drop'];
$drop_tunda = $data['drop_tunda'];
if($cek==0){
	echo "<div class='alert alert-danger'>DROP Tunda Belum diinput</div>";
	?>
	<form method="POST" action="/drop_tunda">
		
		<input type="hidden" name="id_drop" value="<?php echo $id_drop;?>">
		<label>Nominal</label>
		<input type="text" class="form-control" name="drop_tunda" value="<?php echo $drop_tunda;?>"  style="width: 50%">
		<br>

		<input type="submit" class="btn btn-sm btn-primary" name="tambah" value="Simpan">
	</form>
	<?php
}else{
	?>
	<form method="POST" action="/drop_tunda">
		
		<input type="hidden" name="id_drop" value="<?php echo $id_drop;?>">
		<label>Nominal</label>
		<input type="text" class="form-control" name="drop_tunda" value="<?php echo $drop_tunda;?>" style="width: 50%">
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