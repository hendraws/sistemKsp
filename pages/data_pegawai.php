<?php
$bulan 		= date("Y-m");
include   "css.php";
include 	"../lib/koneksi.php";
session_start();
$cabang = $_SESSION['CABANG'];

	//total pegawai
$q		= mysqli_query($con,"select a.*,b.jabatan_nama from tbl_pegawai a left join tbl_jabatan b on a.jabatan_id=b.jabatan_id where status = 'aktif' and cabang = '$cabang'");
$total_pegawai 	= mysqli_num_rows($q);
	//laki-laki 
$q1		= mysqli_query($con,"select a.*,b.jabatan_nama from tbl_pegawai a left join tbl_jabatan b on a.jabatan_id=b.jabatan_id 
	where a.pegawai_jk='L' and status = 'aktif' and cabang = '$cabang'");
$pegawai_l 	= mysqli_num_rows($q1);
	//peremuan
$q2		= mysqli_query($con,"select a.*,b.jabatan_nama from tbl_pegawai a left join tbl_jabatan b on a.jabatan_id=b.jabatan_id 
	where a.pegawai_jk='P' and status = 'aktif' and cabang = '$cabang'");
$pegawai_p 	= mysqli_num_rows($q2);
?>

<br>
<h2>Data Bulan <?php echo tanggal($bulan);?></h2>

<div class="row">
	<div class="col-md-3 col-sm-6 col-12">
		<div class="info-box bg-gray">
			<span class="info-box-icon"><i class="far fa-envelope"></i></span>

			<div class="info-box-content">
				<span class="info-box-text">Total Pegawai</span>
				<span class="info-box-number"><?php echo angka($total_pegawai);?></span>
			</div>
			<!-- /.info-box-content -->
		</div>
		<!-- /.info-box -->
	</div>
	<!-- /.col -->
	<div class="col-md-3 col-sm-6 col-12">
		<div class="info-box bg-success">
			<span class="info-box-icon "><i class="far fa-flag"></i></span>

			<div class="info-box-content">
				<span class="info-box-text">Total Laki-laki</span>
				<span class="info-box-number"><?php echo angka($pegawai_l);?></span>
			</div>
			<!-- /.info-box-content -->
		</div>
		<!-- /.info-box -->
	</div>
	<!-- /.col -->
	<div class="col-md-3 col-sm-6 col-12">
		<div class="info-box bg-danger">
			<span class="info-box-icon "><i class="far fa-copy"></i></span>

			<div class="info-box-content">
				<span class="info-box-text">Total Perempuan</span>
				<span class="info-box-number"><?php echo angka($pegawai_p);?></span>
			</div>
			<!-- /.info-box-content -->
		</div>
		<!-- /.info-box -->
	</div>
	
</div>

<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header bg-gray-dark" >
				<h5 class="card-title">Data Pegawai</h5>

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
						<button id="tambah" class="btn btn-sm btn-info" type="button">Tambah Data</button><br><br>
						<table id="example1" class="table table-bordered table-hover table-striped" >
							<thead>
								<tr class="small bg-gray">
									
									<th>No</th>
									<th></th>
									<th>Username</th>
									<th>NIK</th>
									<th>Nama Pegawai</th>
									<th>Jenis Kelamin</th>
									<th>No Telp</th> 
									<th>Jabatan</th>
									
								</tr>
							</thead>
							<tbody>
								<?php 
								$no=1;
								while($h		= mysqli_fetch_array($q,MYSQLI_ASSOC)){
									$pegawai_id     = $h['pegawai_id'];
									?>
									<tr class="small">
										
										<td><?php echo $no;?></td>
										<td>
											<button type="button" class="btn btn-xs btn-info" id="edit<?php echo $pegawai_id;?>"><i class="fa fa-edit"></i> </button>
											<button type="button" class="btn btn-danger btn-xs" id="hapus<?php echo $pegawai_id;?>"><i class="fa fa-trash"></i> </button>                           
											<button type="button" class="btn btn-danger btn-xs" id="berhenti<?php echo $pegawai_id;?>">Berhenti</button>                           
										</td>     
										<td><?php echo $h['pegawai_id'];?></td>
										<td><?php echo $h['pegawai_nik'];?></td>
										<td><?php echo $h['pegawai_nama'];?></td>
										<td><?php echo $h['pegawai_jk'];?></td>
										<td><?php echo $h['pegawai_telp'];?></td>
										<td><?php echo $h['jabatan_nama'];?></td>  
										
									</tr>
									<script type="text/javascript">
										$("#edit<?php echo $pegawai_id;?>").click(function(){
											$('#modal_sedang').modal('show');
											$.ajax({
												type : 'post',
												url: "data_ajax.php",
												data: "judul=Edit Data Pegawai&tampil=pegawai_add&pegawai_id=<?php echo $pegawai_id;?>",
												cache: false,
												success: function(msg){
													$("#tampil_modal_sedang").html(msg);
												}
											});
										});
										$("#hapus<?php echo $pegawai_id;?>").click(function(){
											$('#modal_kecil').modal('show');
											$.ajax({
												type : 'post',
												url: "data_ajax.php",
												data: "judul=Data Pegawai yakin dihapus?&tampil=pegawai_del&pegawai_id=<?php echo $pegawai_id;?>",
												cache: false,
												success: function(msg){
													$("#tampil_modal_kecil").html(msg);
												}
											});
										});
										$("#berhenti<?php echo $pegawai_id;?>").click(function(){
											$('#modal_kecil').modal('show');
											$.ajax({
												type : 'post',
												url: "data_ajax.php",
												data: "judul=Data Pegawai Di Keluarkan?&tampil=pegawai_berhenti&pegawai_id=<?php echo $pegawai_id;?>",
												cache: false,
												success: function(msg){
													$("#tampil_modal_kecil").html(msg);
												}
											});
										});
									</script>
									<?php 
									$no++;
								} ?>
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
<script type="text/javascript">
	$("#tambah").click(function(){
		$('#modal_sedang').modal('show');
		$("#tampil_modal").html("<center><br><br><img src='loader.gif' width='150'></center>");                                     
		
		$.ajax({
			type : 'post',
			url: "data_ajax.php",
			data: "judul=Tambah Data Pegawai&tampil=pegawai_add",
			cache: false,
			success: function(msg){
				$("#tampil_modal_sedang").html(msg);
			}
		});
	});
</script>