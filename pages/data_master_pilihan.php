<?php session_start();


$USERNAME   = $_SESSION['USERNAME'];
$USER_ID       = $_SESSION['USER_ID'];
$NAMA       = $_SESSION['NAMA'];
$LEVEL           = $_SESSION['LEVEL'];
$bulan           = $_SESSION['BULAN'];
include   "css.php";
include  "../lib/koneksi.php";
$q		= mysqli_query($con,"select * from tbl_biayaumum  order by bu_kategori desc, bu_nama") or die(mysqli_error($con));

?>
<br>
<br>
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header bg-gray-dark" >
				<h5 class="card-title">Tambah Kategori Pilihan Biaya Umum Operasioan dan Lain-lain</h5>
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
				<form method="POST" action="" id="formMasterKategori">
					<label>Kategori</label>
					<select class="form-control" style="width: 50%" name="bu_kategori" id="bu_kategori">
						<option value="0">Biaya Umum Operasional</option>
						<option value="1">Biaya Umum Lain-lain</option>
					</select>
					<label>Nama</label>
					<input type="text" class="form-control" name="bu_nama" id="bu_nama" value="" style="width: 50%">
					<br>
					<input type="submit" class="btn btn-sm btn-primary" name="tambah" value="Simpan">
				</form>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header bg-primary" >
				<h5 class="card-title">Kategori Pilihan</h5>
			</div>
			<!-- /.card-header -->
			<div class="card-body">
				<table id="example1" class="table table-bordered table-hover table-striped" style="width:100%">
					<thead>
						<tr class="small bg-gray">
							<th>No</th>
							<th>Kategori</th>
							<th>Nama</th>
							<th>aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php 
						$no=1;
						while($user_data = mysqli_fetch_array($q)): ?>
							<tr class="small">
								<td><?php echo $no;?></td>
								<td><?= $user_data['bu_kategori'] == 0 ? 'Operasional' : 'Lain-lain' ?></td>
								<td><?php echo $user_data['bu_nama'];?></td>
								<td>
									<button type="button" class="btn btn-xs btn-info" id="edit<?php echo $user_data['bu_id'];?>"><i class="fa fa-edit"></i> edit</button>
									<button type="button" class="btn btn-danger btn-xs" id="hapus<?php echo $user_data['bu_id'];?>"><i class="fa fa-trash"></i> hapus</button>                 
								</td>
							</tr>
							<script type="text/javascript">
								$("#edit<?php echo $user_data['bu_id'];?>").click(function(){
									$('#modal_sedang').modal('show');
									$.ajax({
										type : 'post',
										url: "data_ajax.php",
										data: "judul=Edit Data Pilihan&tampil=master_data_pilihan&bu_id=<?php echo $user_data['bu_id'];?>",
										cache: false,
										success: function(msg){
											$("#tampil_modal_sedang").html(msg);
										}
									});
								});
								$("#hapus<?php echo $user_data['bu_id'];?>").click(function(){
									$('#modal_kecil').modal('show');
									$.ajax({
										type : 'post',
										url: "data_ajax.php",
										data: "judul=Hapus Data Pilihan&tampil=master_data_pilihan_del&bu_id=<?php echo $user_data['bu_id'];?>",
										cache: false,
										success: function(msg){
											$("#tampil_modal_kecil").html(msg);
										}
									});
								});
							</script>
							<?php 
							$no++; 
						endwhile;
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
	$(function() {
		$(document).on('submit','#formMasterKategori', function(e){
			e.preventDefault();
			var bu_nama = $('#bu_nama').val();
			var bu_kategori = $('#bu_kategori').val();
			if(bu_nama == ''){
				return toastr.error('Kas Tidak Boleh Kosong');
			}else{
				$.ajax({
					type : 'post',
					url: "pages/master_pilihan.php",
					dataType  : 'json',
					data: {
						'bu_nama' : bu_nama,
						'bu_kategori' : bu_kategori,
						'tambah_data' : 'true',
					},
					success: function (result)
					{
						if(result.status == 200){
							toastr.success(result.message);
						}else{
							toastr.error(result.message);
						}
						setTimeout(function(){ location.reload(); }, 1000);
					},
					error: function (xhr, desc, err)
					{
						console.log(xhr, desc, err);
						console.log("error");
					}
				});
			}
		});
	});
</script>
