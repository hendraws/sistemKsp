     <?php
     include  "lib/koneksi.php";
     session_start();
     $cabang           = $_SESSION['CABANG'];
     if(isset($_POST['update'])){
     	$pemasukan_id           = $_POST['pemasukan_id'];
     	$pemasukan         = $_POST['pemasukan'];
     	$nominal           = $_POST['nominal'];

     	?>

     	<?php
     	if($pemasukan_id!=""){
     		$up=mysqli_query($con,"update tbl_pemasukan set pemasukan='$pemasukan',nominal='$nominal' where pemasukan_id='$pemasukan_id'");
     		if($up){
     			?>
     			<script type="text/javascript">
     				toastr.success('Perubahan data berhasil disimpan');
     			</script>
     			<?php
     		}else{
     			?>
     			<script type="text/javascript">
     				toastr.danger('Perubahan data gagal disimpan');
     			</script>
     			<?php
     		}

     	}else{
      //$pegawai_id = date("Ymdhis");
     		$up=mysqli_query($con,"insert into tbl_pemasukan (pemasukan,nominal,bulan,cabang) values('$pemasukan','$nominal','$bulan','$cabang')");
     		if($up){
     			?>
     			<script type="text/javascript">
     				toastr.success('Tambah data berhasil disimpan');
     			</script>
     			<?php
     		}else{
     			?>
     			<script type="text/javascript">
     				toastr.danger('Tambah data gagal disimpan');
     			</script>
     			<?php
     		}

     	}

     }


     if(isset($_POST['delete'])){
     	$pemasukan_id           = $_POST['pemasukan_id'];


     	?>

     	<?php

     	$up=mysqli_query($con,"delete from tbl_pemasukan where pemasukan_id='$pemasukan_id'");
     	if($up){
     		?>
     		<script type="text/javascript">
     			toastr.success('Data terhapus');
     		</script>
     		<?php
     	}else{
     		?>
     		<script type="text/javascript">
     			toastr.danger('Data tidak terhapus');
     		</script>
     		<?php
     	}



     }

     ?>