<?php session_start();
error_reporting(0);


$USERNAME   = $_SESSION['USERNAME'];
$USER_ID       = $_SESSION['USER_ID'];
$NAMA       = $_SESSION['NAMA'];
$LEVEL           = $_SESSION['LEVEL'];
$bulan           = $_SESSION['BULAN'];
$cabang           = $_SESSION['CABANG'];
include   "css.php";
include 	"../lib/koneksi.php";
	//total inven
$q		= mysqli_query($con,"select * from tbl_owner where cabang = '$cabang'");
$data  = mysqli_fetch_array($q,MYSQLI_ASSOC);
$nama_own   = $data['nama'];
$alamat     = $data['alamat'];
$gambar     = $data['gambar'];

?>
<br>
<h2>Data Bulan <?php echo tanggal($bulan);?></h2>
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header bg-gray-dark" >
				<h5 class="card-title">Profil KSP</h5>

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
					<div class="col-md-12">

						<table id="" class="table table-bordered table-hover table-striped" style="width:100%">
							<thead>
								<tr class="small bg-gray">
									<th>No</th>
									<th>Nama KSP</th>
									<th>Alamat</th>
									<th>Logo</th>

									<th></th>                                                  
								</tr>
							</thead>
							<tbody>
								<?php if (count($data) > 0): ?>									
								<tr class="small">
									<td><?php echo "1";?></td>
									<td><?php echo $nama_own;?></td>
									<td><?php echo $alamat;?></td>
									<td><img src="<?php echo $gambar;?>" width="150"></td>
									<td>
										<button type="button" class="btn btn-xs btn-info" id="edit_profil"><i class="fa fa-edit"></i> edit</button>
									</td>                        
								</tr>
								<?php else: ?>
									<tr>
										<td colspan="5"><button class="col-md-12 btn btn-primary" id="tambah">Tambah Profil</button></td>
									</tr>
								<?php endif ?>
								<script type="text/javascript">
									$("#edit_profil").click(function(){
										$('#modal_sedang').modal('show');
										$.ajax({
											type : 'post',
											url: "data_ajax.php",
											data: "judul=Edit Profil&tampil=profil_add",
											cache: false,
											success: function(msg){
												$("#tampil_modal_sedang").html(msg);
											}
										});
									});

									$("#tambah").click(function(){
										$('#modal_sedang').modal('show');
										$.ajax({
											type : 'post',
											url: "data_ajax.php",
											data: "judul=Tambah Profil&tampil=profil_add",
											cache: false,
											success: function(msg){
												$("#tampil_modal_sedang").html(msg);
											}
										});
									});

								</script>

							</tbody>
						</table>
					</div>                  
				</div>
				<!-- /.row -->
			</div>
			<!-- ./card-body -->
			<div class="card-footer ">
				<div class="row">
					<div class="col-md-12">                    
					</div>
				</div>
				<!-- /.row -->
			</div>
			<!-- /.card-footer -->
		</div>
		<!-- /.card -->
	</div>
	<!-- /.col -->

</div>
<!-- /.row -->

<?php
include "js.php";
?>
