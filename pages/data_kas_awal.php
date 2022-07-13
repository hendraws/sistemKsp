<?php session_start();


$USERNAME   = $_SESSION['USERNAME'];
$USER_ID       = $_SESSION['USER_ID'];
$NAMA       = $_SESSION['NAMA'];
$LEVEL           = $_SESSION['LEVEL'];
$bulan           = $_SESSION['BULAN'];
$cabang           = $_SESSION['CABANG'];
include  "../lib/koneksi.php";
?>
<br>
<br>
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header bg-gray-dark" >
				<h5 class="card-title">Kas Awal <?php echo tanggal($bulan);?></h5>

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
				$q=mysqli_query($con,"select kas_id,kas_nominal from tbl_kas_awal where kas_bulan like '$bulan%' and cabang = '$cabang'");
				$cek=mysqli_num_rows($q);
				$data=mysqli_fetch_array($q,MYSQLI_ASSOC);
				$kas_id   = $data['kas_id'];
				$kas_nominal = $data['kas_nominal'];
				if($cek==0){
					echo "<div class='alert alert-danger'>Kas Awal Belum diinput</div>";
					?>
					<form method="POST" action="/kas">

						<input type="hidden" name="kas_id" value="<?php echo $kas_id;?>">
						<label>Nominal</label>
						<input type="text" class="form-control" name="kas_nominal" value="<?php echo $kas_nominal;?>"  style="width: 50%">
						<br>

						<input type="submit" class="btn btn-sm btn-primary" name="tambah" value="Simpan">
					</form>
					<?php
				}else{
					?>
					<form method="POST" action="/kas">

						<input type="hidden" name="kas_id" value="<?php echo $kas_id;?>">
						<label>Nominal</label>
						<input type="text" class="form-control" name="kas_nominal" value="<?php echo $kas_nominal;?>" style="width: 50%">
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