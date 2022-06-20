<?php session_start();


$USERNAME   = $_SESSION['USERNAME'];
$USER_ID       = $_SESSION['USER_ID'];
$NAMA       = $_SESSION['NAMA'];
$LEVEL           = $_SESSION['LEVEL'];
$bulan           = $_SESSION['BULAN'];
include   "css.php";
include  "../lib/koneksi.php";
$q		= mysqli_query($con,"select * from tbl_kas_masuk  order by id desc") or die(mysqli_error($con));
?>
<br>
<br>
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header bg-gray-dark" >
				<h5 class="card-title">Tambah Kas Masuk <?php echo tanggal($bulan);?></h5>

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
				<form method="POST" action="/kas-masuk" id="formKasMasuk">
					<label>Nominal</label>
					<input type="text" class="form-control" name="kas_nominal" id="kas_nominal" value="" style="width: 50%">
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
				<h5 class="card-title">Kas Masuk <?php echo tanggal($bulan);?></h5>
			</div>
			<!-- /.card-header -->
			<div class="card-body">
				<table id="example1" class="table table-bordered table-hover table-striped" style="width:100%">
					<thead>
						<tr class="small bg-gray">
							<th>No</th>
							<th>Nominal</th>
						</tr>
					</thead>
					<tbody>
						<?php 
						$no=1;
						while($user_data = mysqli_fetch_array($q)){   

							?>
							<tr class="small">
								<td><?php echo $no;?></td>
								<td><?php echo $user_data['nominal'];?></td>
							</tr>
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
?>
<script type="text/javascript">
	$(function() {
		$(document).on('submit','#formKasMasuk', function(e){
			e.preventDefault();
			var kas_nominal = $('#kas_nominal').val();
			if(kas_nominal == ''){
				return toastr.error('Kas Tidak Boleh Kosong');
			}else{
				$.ajax({
					type : 'post',
					url: "pages/kas_masuk.php",
					dataType  : 'json',
					data: {
						'kas_nominal' : kas_nominal,
						'tambah_data' : 'true',
						'bulan' : '<?= $bulan ?>',
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