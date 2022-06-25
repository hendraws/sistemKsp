<?php session_start();


$USERNAME   = $_SESSION['USERNAME'];
$USER_ID       = $_SESSION['USER_ID'];
$NAMA       = $_SESSION['NAMA'];
$LEVEL           = $_SESSION['LEVEL'];
$bulan           = $_SESSION['BULAN'];
include   "css.php";
include  "../lib/koneksi.php";
$q		= mysqli_query($con,"SELECT * FROM tbl_user LEFT JOIN tbl_unit ON unit_id = cabang where user_level = 3 ORDER BY user_id") or die(mysqli_error($con));

$queryCabang = mysqli_query($con,"select * from tbl_unit") or die(mysqli_error($con));
?>
<br>
<br>
<div class="row">
	<div class="col-md-12">
		<div class="card collapsed-card">
			<div class="card-header " >
				<h5 class="card-title"></h5>

				<div class="card-tools">
					<button type="button" class="btn btn-primary" data-card-widget="collapse">
						<i class="fas fa-plus"></i> Tambah User
					</button>                  
				</div>
			</div>
			<!-- /.card-header -->
			<div class="card-body">
				<form method="POST" action="/pages/master_user_kasir.php">
					<label>Nama</label>
					<input type="text" class="form-control" name="user_nama" required value="" style="width: 50%">
					<label>Username</label>
					<input type="text" class="form-control" name="user_name" required value="" style="width: 50%">
					<label>Password</label>
					<input type="password" class="form-control" name="user_pass" required value="" style="width: 50%">
					<label>Cabang</label>
					<select class="form-control" style="width: 50%" name="cabang" required>
						<?php while($dataCabang = mysqli_fetch_array($queryCabang)) : ?>
						<option value="<?= $dataCabang['unit_id'] ?>"><?= $dataCabang['unit_nama'] ?></option>
						<?php endwhile ?>
					</select>
					<input type="hidden" name="user_level" value="3">
					<br>
					<input type="submit" class="btn btn-sm btn-primary" name="tambah_data" value="Simpan">
				</form>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header bg-primary" >
				<h5 class="card-title">Data User Kasir</h5>
			</div>
			<!-- /.card-header -->
			<div class="card-body">
				<table id="example1" class="table table-bordered table-hover table-striped" style="width:100%">
					<thead>
						<tr class="small bg-gray">
							<th>No</th>
							<th>Nama</th>
							<th>Username</th>
							<th>Cabang</th>
							<th>Edit</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<?php 
						$no=1;
						while($data = mysqli_fetch_array($q)){   
							?>
							<tr class="small">
								<td><?php echo $no;?></td>
								<td><?php echo $data['user_nama'];?></td>
								<td><?php echo $data['user_name'];?></td>
								<td><?php echo $data['unit_nama'];?></td>
								<td class="text-center"><?= $data['user_permission'] != 0 ? '<i class="fa fa-check"></i>' : ''  ?> </td>
								<td>
									<button type="button" class="btn btn-xs <?= $data['user_permission'] != 0 ? 'btn-warning' : 'btn-success'  ?>" id="permission<?php echo $data['user_id'];?>" data-value="<?= $data['user_permission'] ?>" data-name="<?= $data['user_permission'] != 0 ? 'Hapus Permission Edit' : 'Ijinkan Edit'  ?>"><?= $data['user_permission'] != 0 ? 'Hapus Permission Edit' : 'Ijinkan Edit'  ?></button>
									<button type="button" class="btn btn-xs btn-info" id="edit<?php echo $data['user_id'];?>"><i class="fa fa-edit"></i> edit</button>
									<button type="button" class="btn btn-danger btn-xs" id="hapus<?php echo $data['user_id'];?>"><i class="fa fa-trash"></i> hapus</button>             
								</td>
							</tr>
							<script type="text/javascript">
								$("#permission<?php echo $data['user_id'];?>").click(function(){
									var judul = $(this).data('name');
									var status = $(this).data('value');
									console.log($(this).data('name'));
									$('#modal_kecil').modal('show');
									$.ajax({
										type : 'post',
										url: "data_ajax.php",
										data: "judul="+judul+"&tampil=permission_kasir&user_id=<?php echo $data['user_id'];?>&status="+status,
										cache: false,
										success: function(msg){
											$("#tampil_modal_kecil").html(msg);
										}
									});
								});
								$("#edit<?php echo $data['user_id'];?>").click(function(){
									$('#modal_sedang').modal('show');
									$.ajax({
										type : 'post',
										url: "data_ajax.php",
										data: "judul=Edit Data User&tampil=master_data_user_kasir&user_id=<?php echo $data['user_id'];?>",
										cache: false,
										success: function(msg){
											$("#tampil_modal_sedang").html(msg);
										}
									});
								});
								$("#hapus<?php echo $data['user_id'];?>").click(function(){
									$('#modal_kecil').modal('show');
									$.ajax({
										type : 'post',
										url: "data_ajax.php",
										data: "judul=Hapus Data User&tampil=master_data_user_kasir_del&user_id=<?php echo $data['user_id'];?>",
										cache: false,
										success: function(msg){
											$("#tampil_modal_kecil").html(msg);
										}
									});
								});
							</script>
							<?php 
							$no++;
						}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<?php
include "js.php";
if(!empty($_SESSION['message'])){
	echo "<script type='text/javascript'>
	$(function() {
		toastr.success('".$_SESSION['message']."');
		});
		</script>";
	}
	unset($_SESSION['message']);
	?>
	<script type="text/javascript">
	// $(function() {
	// 	$(document).on('submit','#formKasMasuk', function(e){
	// 		e.preventDefault();
	// 		var kas_nominal = $('#kas_nominal').val();
	// 		if(kas_nominal == ''){
	// 			return toastr.error('Kas Tidak Boleh Kosong');
	// 		}else{
	// 			$.ajax({
	// 				type : 'post',
	// 				url: "pages/kas_masuk.php",
	// 				dataType  : 'json',
	// 				data: {
	// 					'kas_nominal' : kas_nominal,
	// 					'tambah_data' : 'true',
	// 					'bulan' : '<?= $bulan ?>',
	// 				},
	// 				success: function (result)
	// 				{
	// 					if(result.status == 200){
	// 						toastr.success(result.message);
	// 					}else{
	// 						toastr.error(result.message);
	// 					}
	// 					setTimeout(function(){ location.reload(); }, 1000);
	// 				},
	// 				error: function (xhr, desc, err)
	// 				{
	// 					console.log(xhr, desc, err);
	// 					console.log("error");
	// 				}
	// 			});
	// 		}
	// 	});
	// });
</script>