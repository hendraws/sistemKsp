<?php session_start();
error_reporting(0);


$USERNAME   = $_SESSION['USERNAME'];
$USER_ID       = $_SESSION['USER_ID'];
$NAMA       = $_SESSION['NAMA'];
$LEVEL           = $_SESSION['LEVEL'];
$bulan           = $_SESSION['BULAN'];
//$bulan 		= date("Y-m");
include   "css.php";
include 	"../lib/koneksi.php";
	//total inven
$q		= mysqli_query($con,"select * from tbl_jabatan order by urutan asc");
$total 	= mysqli_num_rows($q);

?>

<br>
<h2>Data Bulan <?php echo tanggal($bulan);?></h2>

<div class="row">
	<div class="col-md-3 col-sm-6 col-12">
		<div class="info-box bg-gray">
			<span class="info-box-icon"><i class="far fa-envelope"></i></span>

			<div class="info-box-content">
				<span class="info-box-text">Total Jabatan</span>
				<span class="info-box-number"><?php echo angka($total);?></span>
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
				<h5 class="card-title">Data Gaji Pokok</h5>

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

						<table  class="table table-bordered table-hover table-striped" style="width:100%">
							<thead>
								<tr class="small bg-gray">
									<!-- <th>No</th> -->
									<th>Nama Jabatan</th>
									<th>Jatah Bon Panjer</th>
									<th>Jatah Bon Prive</th>
									<th>Gaji Pokok</th>

									<th></th>                                                  
								</tr>
							</thead>
							<tbody class="sortable">
								<?php 
								$no=1;
								while($h		= mysqli_fetch_array($q,MYSQLI_ASSOC)){
									$jabatan_id     = $h['jabatan_id'];
									?>
									<tr class="small" id="<?= $jabatan_id ?> ">
										<!-- <td><?php echo $no;?></td> -->
										<td><?php echo $h['jabatan_nama'];?></td>
										<td><?php echo str_replace(",", ".", number_format($h['bon_panjer']));?></td>
										<td><?php echo str_replace(",", ".", number_format($h['bon_prive']));?></td>
										<td><?php echo str_replace(",", ".", number_format($h['gaji_pokok']));?></td>

										<td>
											<button type="button" class="btn btn-xs btn-info" id="edit<?php echo $jabatan_id;?>"><i class="fa fa-edit"></i> edit</button>
                            <!--
                            <button type="button" class="btn btn-danger btn-xs" id="hapus<?php echo $jabatan_id;?>"><i class="fa fa-trash"></i> hapus</button>  
                        -->                         
                    </td>                        
                </tr>
                <script type="text/javascript">
                	$("#edit<?php echo $jabatan_id;?>").click(function(){
                		$('#modal_sedang').modal('show');
                		$.ajax({
                			type : 'post',
                			url: "data_ajax.php",
                			data: "judul=Edit Data Jabatan&tampil=jabatan_add&jabatan_id=<?php echo $jabatan_id;?>",
                			cache: false,
                			success: function(msg){
                				$("#tampil_modal_sedang").html(msg);
                			}
                		});
                	});
                	$("#hapus<?php echo $jabatan_id;?>").click(function(){
                		$('#modal_kecil').modal('show');
                		$.ajax({
                			type : 'post',
                			url: "data_ajax.php",
                			data: "judul=Data Jabatan yakin dihapus?&tampil=jabatan_del&jabatan_id=<?php echo $jabatan_id;?>",
                			cache: false,
                			success: function(msg){
                				$("#tampil_modal_kecil").html(msg);
                			}
                		});
                	});
                	$('.sortable').sortable({
                		stop:function()
                		{
                			var ids = '';
                			$('.sortable tr').each(function(){
                				var id = $(this).attr('id');
                				if(ids=='')
                				{
                					ids = id;
                				}else{
                					ids = ids+','+id;
                				}
                			})
                			$.ajax({
                				url:'pages/gaji.php',
                				data: 'ids='+ids,
                				type: 'post',
                				success: function()
                				{
                					alert('Order Successfully');
                				}
                			})
            				// alert(ids);
                		}
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
			data: "judul=Tambah Data Jabatan&tampil=jabatan_add",
			cache: false,
			success: function(msg){
				$("#tampil_modal_sedang").html(msg);
			}
		});
	});
</script>