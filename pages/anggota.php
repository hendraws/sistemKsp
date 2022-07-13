           
<?php
error_reporting(0);
session_start();
include  "lib/koneksi.php";
$cabang = $_SESSION['CABANG'];
if(isset($_POST["tambah_anggota"])){

	$resort_id  = $_POST['resort_id'];
	$anggota_id = $_POST['anggota_id'];
	$anggota_nama     = $_POST['anggota_nama'];
	$anggota_alamat   = $_POST['anggota_alamat'];
	$keterangan       = $_POST['keterangan'];
	$tgl_daftar       = $_POST['tgl_daftar'];
	$tgl_keluar       = $_POST['tgl_keluar'];

	if($tgl_keluar==""){
		$tgl_keluar="1900-01-01";
	}else{
		$tgl_keluar=$tgl_keluar;
	}

	if($anggota_id!=""){

		$q= mysqli_query($con,"update tbl_anggota set anggota_nama='$anggota_nama',
			anggota_alamat='$anggota_alamat',keterangan='$keterangan',tgl_daftar='$tgl_daftar',tgl_keluar='$tgl_keluar',resort_id='$resort_id' where anggota_id='$anggota_id'");
	}else{

		$q= mysqli_query($con,"insert into tbl_anggota (anggota_nama,anggota_alamat,keterangan,tgl_daftar,tgl_keluar,resort_id) values('$anggota_nama','$anggota_alamat','$keterangan','$tgl_daftar','$tgl_keluar','$resort_id') ");

	}
	if($q){
		echo "<div class='alert alert-success'>Data Berhasil disimpan</div>";
	}
	
}
if(isset($_POST["hapus_anggota"])){
	$anggota_id = $_POST['anggota_id'];
	$q= mysqli_query($con,"delete from tbl_anggota  where anggota_id='$anggota_id'");
	if($q){
		echo "<div class='alert alert-success'>Data Berhasil dihapus</div>";
	}
}
?>
<div class="row">
	<div class="col-md-12">
		<br>
		<br>
		<div class="card">
			<div class="card-header bg-gray-dark" >
				<h5 class="card-title">Filter Data</h5>

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
				<div class="row">
					<div class="col-md-5">
						<label>Resort </label><br>
						<select id="anggota_resort_id" class="form-control select2" style="width: 100%" required>

							<?php 
							if($LEVEL=="1"){
								$qresort = mysqli_query($con,"select * from tbl_resort where unit_id = '$cabang' order by resort_id asc");
							}else{
								$qresort = mysqli_query($con,"select * from tbl_resort where pegawai_id = '$USERNAME'");
							}
							while($data_resort    = mysqli_fetch_array($qresort,MYSQLI_ASSOC)){
								$resort_id_data     = $data_resort['resort_id'];
								if($resort_id_data==$resort_id){
									$pilih   = "selected";
								}else{ 
									$pilih   = "";
								}
								?>
								<option value="<?php echo $data_resort['resort_id']?>" <?php echo $pilih;?>><?php echo $data_resort['resort_nama']?></option>
							<?php } 
							if($LEVEL=="1"){                     ?>
								<option value="">Semua resort</option>
							<?php } ?>
						</select>
					</div>

					<div class="col-md-2">
						<br>

						<button class="btn btn-primary btn-sm" id="tampil_data_anggota">Tampilkan</button>
					</div>
				</div>
			</div>
		</div>
	</div> 
</div>