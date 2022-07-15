<?php
session_start();
include  "lib/koneksi.php";
$cabang = $_SESSION['CABANG'];
if(isset($_POST['tambah_pembukuan_harian'])){
	$pembukuan_id           = $_POST['pembukuan_id'];
	$drop                   = $_POST['drop'];
	$storting               = $_POST['storting'];
	$psp                    = $_POST['psp'];
	$kasbon_pagi            = $_POST['kasbon_pagi'];
	$resort_id              = $_POST['resort_id'];
	$L              = $_POST['L'];
	$B              = $_POST['B'];
	$K              = $_POST['K'];
	$pembukuan_tgl          = $_POST['pembukuan_tgl'];


	if($pembukuan_id!=""){
		$up=mysqli_query($con,"update tbl_pembukuan_harian set pembukuan_drop='$drop',storting='$storting',
			psp='$psp',kasbon_pagi='$kasbon_pagi',resort_id='$resort_id',pembukuan_tgl='$pembukuan_tgl',L='$L',B='$B',K='$K' where pembukuan_id='$pembukuan_id'");

		if($up){
			?>
			<script type="text/javascript">
				toastr.success('Perubahan data berhasil disimpan');
			</script>
			<?php
		}else{
			?>
			<script type="text/javascript">
				toastr.error('Perubahan data gagal disimpan');
			</script>
			<?php
		}
	}else{
		$qcek = mysqli_query($con,"SELECT pembukuan_id from tbl_pembukuan_harian where pembukuan_tgl='$pembukuan_tgl' and resort_id='$resort_id'");
		$cek = mysqli_num_rows($qcek);
		if($cek>0){
			?>
			<script type="text/javascript">
				toastr.error('Data Resort tersebut sudah diinput ditanggal tersebut');
			</script>
			<?php
		}else{
          //$pegawai_id = date("Ymdhis");
			$pembukuan_id = "PH".round(microtime(true) * 1000);
			$up=mysqli_query($con,"insert into tbl_pembukuan_harian (pembukuan_drop,storting,psp,
				kasbon_pagi,resort_id,pembukuan_id,pembukuan_tgl,L,B,K) values('$drop','$storting','$psp',
				'$kasbon_pagi','$resort_id','$pembukuan_id','$pembukuan_tgl','$L','$B','$K')");
			if($up){
				?>
				<script type="text/javascript">
					toastr.success('Tambah data berhasil disimpan');
				</script>
				<?php
			}else{
				?>
				<script type="text/javascript">
					toastr.error('Tambah data gagal disimpan');
				</script>
				<?php
			}
		}

	}       
}

if(isset($_POST['hapus_pembukuan_harian'])){
	$pembukuan_id           = $_POST['pembukuan_id'];

	$up=mysqli_query($con,"delete from tbl_pembukuan_harian where pembukuan_id='$pembukuan_id'");
	if($up){
		?>
		<script type="text/javascript">
			toastr.success('Data terhapus');
		</script>
		<?php
	}else{
		?>
		<script type="text/javascript">
			toastr.error('Data tidak terhapus');
		</script>
		<?php
	}   

}


/* ---------------------------------------------- akomodasi ------------------------ */
if(isset($_POST['tambah_akomodasi'])){
	$akomodasi_id                 = $_POST['akomodasi_id'];
	$uang_makan                   = $_POST['uang_makan'];
	$uang_transport               = $_POST['uang_transport'];
	$akomodasi_tgl                = $_POST['akomodasi_tgl'];

	if($akomodasi_id!=""){
		$up=mysqli_query($con,"UPDATE tbl_akomodasi set uang_makan='$uang_makan',uang_transport='$uang_transport',
			akomodasi_tgl='$akomodasi_tgl' where akomodasi_id='$akomodasi_id'");

		if($up){
			?>
			<script type="text/javascript">
				toastr.success('Perubahan data berhasil disimpan');
			</script>
			<?php
		}else{
			?>
			<script type="text/javascript">
				toastr.error('Perubahan data gagal disimpan');
			</script>
			<?php
		}
	}else{
          //$pegawai_id = date("Ymdhis");
		$qcek = mysqli_query($con,"SELECT akomodasi_id from tbl_akomodasi where akomodasi_tgl='$akomodasi_tgl' AND cabang = '$cabang'");
		$cek = mysqli_num_rows($qcek);
		if($cek>0){
			?>
			<script type="text/javascript">
				toastr.error('Data tanggal tersebut sudah diinput');
			</script>
			<?php
		}else{

			$akomodasi_id = "AKO".round(microtime(true) * 1000);

			$tanggalInput = date('Y-m-d');
			$up=mysqli_query($con,"insert into tbl_akomodasi (uang_makan,uang_transport,akomodasi_tgl,akomodasi_id,cabang,tgl_input) values('$uang_makan','$uang_transport','$akomodasi_tgl','$akomodasi_id','$cabang','$tanggalInput')");
			if($up){
				?>
				<script type="text/javascript">
					toastr.success('Tambah data berhasil disimpan');
				</script>
				<?php
			}else{
				?>
				<script type="text/javascript">
					toastr.error('Tambah data gagal disimpan');
				</script>
				<?php
			}
		}
	} 
	?>
	<div id="kwitansi">
		<a class="btn btn-danger btn-sm pull-right"  onclick="tutup()">Tutup Kwitansi</a>
		<embed src="cetak_kwitansi.php?jenis=akomodasi&id=<?php echo $akomodasi_id;?>" width="100%" height="500">    
		</div>  
		<?php
	}

	if(isset($_POST['hapus_akomodasi'])){
		$akomodasi_id           = $_POST['akomodasi_id'];

		$up=mysqli_query($con,"delete from tbl_akomodasi where akomodasi_id='$akomodasi_id'");
		if($up){
			?>
			<script type="text/javascript">
				toastr.success('Data terhapus');
			</script>
			<?php
		}else{
			?>
			<script type="text/javascript">
				toastr.error('Data tidak terhapus');
			</script>
			<?php
		}   

	}

	/* ---------------------------------------------- bon prive ------------------------ */
	if(isset($_POST['tambah_bon_prive'])){
		$prive_id                 = $_POST['prive_id'];
		$prive_tgl                = $_POST['prive_tgl'];
		$prive_nominal            = $_POST['prive_nominal'];
		$prive_ket                = $_POST['prive_ket'];
		$pegawai_id               = $_POST['pegawai_id'];


		if($prive_id!=""){
			$up=mysqli_query($con,"update tbl_bon_prive set prive_tgl='$prive_tgl',prive_nominal='$prive_nominal',
				prive_ket='$prive_ket',pegawai_id='$pegawai_id' where prive_id='$prive_id'");

			if($up){
				?>
				<script type="text/javascript">
					toastr.success('Perubahan data berhasil disimpan');
				</script>
				<?php
			}else{
				?>
				<script type="text/javascript">
					toastr.error('Perubahan data gagal disimpan');
				</script>
				<?php
			}
		}else{
          //$pegawai_id = date("Ymdhis");
			$prive_id = "PRIV".round(microtime(true) * 1000);
			$up=mysqli_query($con,"insert into tbl_bon_prive (prive_id,prive_tgl,prive_nominal,prive_ket,pegawai_id, cabang) values('$prive_id','$prive_tgl','$prive_nominal','$prive_ket','$pegawai_id', '$cabang')");
			if($up){
				?>
				<script type="text/javascript">
					toastr.success('Tambah data berhasil disimpan');
				</script>
				<?php
			}else{
				?>
				<script type="text/javascript">
					toastr.error('Tambah data gagal disimpan');
				</script>
				<?php
			}

		}      ?>
		<div id="kwitansi">
			<a class="btn btn-danger btn-sm pull-right"  onclick="tutup()">Tutup Kwitansi</a>
			<embed src="cetak_kwitansi.php?jenis=bon_prive&id=<?php echo $prive_id;?>" width="100%" height="500">    
			</div>   
			<?php
		}

		if(isset($_POST['hapus_bon_prive'])){
			$prive_id           = $_POST['prive_id'];

			$up=mysqli_query($con,"delete from tbl_bon_prive where prive_id='$prive_id'");
			if($up){
				?>
				<script type="text/javascript">
					toastr.success('Data terhapus');
				</script>
				<?php
			}else{
				?>
				<script type="text/javascript">
					toastr.error('Data tidak terhapus');
				</script>
				<?php
			}   

		}

		/* ---------------------------------------------- bon panjer ------------------------ */
		if(isset($_POST['tambah_bon_panjer'])){
			$panjer_id                 = $_POST['panjer_id'];
			$panjer_tgl                = $_POST['panjer_tgl'];
			$panjer_nominal            = $_POST['panjer_nominal'];
			$panjer_ket                = $_POST['panjer_ket'];
			$pegawai_id               = $_POST['pegawai_id'];


			if($panjer_id!=""){
				$up=mysqli_query($con,"update tbl_bon_panjer set panjer_tgl='$panjer_tgl',panjer_nominal='$panjer_nominal',
					panjer_ket='$panjer_ket',pegawai_id='$pegawai_id' where panjer_id='$panjer_id'");

				if($up){
					?>
					<script type="text/javascript">
						toastr.success('Perubahan data berhasil disimpan');
					</script>
					<?php
				}else{
					?>
					<script type="text/javascript">
						toastr.error('Perubahan data gagal disimpan');
					</script>
					<?php
				}
			}else{
          //$pegawai_id = date("Ymdhis");
				$panjer_id = "PANJ".round(microtime(true) * 1000);
				$now = date("Y-m-d H:i:s");
				$up=mysqli_query($con,"insert into tbl_bon_panjer (panjer_id,panjer_tgl,panjer_nominal,panjer_ket,pegawai_id,tgl_input,cabang) values('$panjer_id','$panjer_tgl','$panjer_nominal','$panjer_ket','$pegawai_id','$now','$cabang')");
				if($up){
					?>
					<script type="text/javascript">
						toastr.success('Tambah data berhasil disimpan');
					</script>
					<?php
				}else{
					?>
					<script type="text/javascript">
						toastr.error('Tambah data gagal disimpan');
					</script>
					<?php
				}

			}     
			?>
			<div id="kwitansi">
				<a class="btn btn-danger btn-sm pull-right"  onclick="tutup()">Tutup Kwitansi</a>
				<embed src="cetak_kwitansi.php?jenis=bon_panjer&id=<?php echo $panjer_id;?>" width="100%" height="500">    
				</div>   
				<?php  
			}

			if(isset($_POST['hapus_bon_panjer'])){
				$panjer_id           = $_POST['panjer_id'];

				$up=mysqli_query($con,"delete from tbl_bon_panjer where panjer_id='$panjer_id'");
				if($up){
					?>
					<script type="text/javascript">
						toastr.success('Data terhapus');
					</script>
					<?php
				}else{
					?>
					<script type="text/javascript">
						toastr.error('Data tidak terhapus');
					</script>
					<?php
				}   

			}


			/* ---------------------------------------------- operasional ------------------------ */
			if(isset($_POST['tambah_operasional'])){
				$operasional_id  = $_POST['operasional_id'];
				$operasional_tgl = $_POST['operasional_tgl'];
				$nominal         = $_POST['nominal'];
				$operasional_ket = $_POST['operasional_ket'];
				$bu_id           = $_POST['bu_id'];


				if($operasional_id!=""){
					$up=mysqli_query($con,"update tbl_operasional set operasional_tgl='$operasional_tgl',nominal='$nominal',
						operasional_ket='$operasional_ket',bu_id='$bu_id' where operasional_id='$operasional_id'");

					if($up){
						?>
						<script type="text/javascript">
							toastr.success('Perubahan data berhasil disimpan');
						</script>
						<?php
					}else{
						?>
						<script type="text/javascript">
							toastr.error('Perubahan data gagal disimpan');
						</script>
						<?php
					}
				}else{
          //$pegawai_id = date("Ymdhis");
					$operasional_id = "OPRA".round(microtime(true) * 1000);
					$up=mysqli_query($con,"INSERT INTO tbl_operasional (operasional_id,bu_id,nominal,operasional_ket,operasional_tgl,cabang) values('$operasional_id','$bu_id','$nominal','$operasional_ket','$operasional_tgl','$cabang')");
					if($up){
						?>
						<script type="text/javascript">
							toastr.success('Tambah data berhasil disimpan');
						</script>
						<?php
					}else{
						?>
						<script type="text/javascript">
							toastr.error('Tambah data gagal disimpan');
						</script>
						<?php
					}

				}
				?>
				<div id="kwitansi">
					<a class="btn btn-danger btn-sm pull-right"  onclick="tutup()">Tutup Kwitansi</a>
					<embed src="cetak_kwitansi.php?jenis=operasional&id=<?php echo $operasional_id;?>" width="100%" height="500">    
					</div>   
					<?php         
				}

				if(isset($_POST['tambah_lain'])){
					$operasional_id                 = $_POST['operasional_id'];
					$operasional_tgl                = $_POST['operasional_tgl'];
					$nominal            = $_POST['nominal'];
					$operasional_ket                = $_POST['operasional_ket'];
					$bu_id               = $_POST['bu_id'];


					if($operasional_id!=""){
						$up=mysqli_query($con,"update tbl_operasional set operasional_tgl='$operasional_tgl',nominal='$nominal',
							operasional_ket='$operasional_ket',bu_id='$bu_id' where operasional_id='$operasional_id'");

						if($up){
							?>
							<script type="text/javascript">
								toastr.success('Perubahan data berhasil disimpan');
							</script>
							<?php
						}else{
							?>
							<script type="text/javascript">
								toastr.error('Perubahan data gagal disimpan');
							</script>
							<?php
						}
					}else{
          //$pegawai_id = date("Ymdhis");
						$operasional_id = "LAIN".round(microtime(true) * 1000);
						$up=mysqli_query($con,"insert into tbl_operasional (operasional_id,bu_id,nominal,operasional_ket,operasional_tgl,cabang) values('$operasional_id','$bu_id','$nominal','$operasional_ket','$operasional_tgl','$cabang')");
						if($up){
							?>
							<script type="text/javascript">
								toastr.success('Tambah data berhasil disimpan');
							</script>
							<?php
						}else{
							?>
							<script type="text/javascript">
								toastr.error('Tambah data gagal disimpan');
							</script>
							<?php
						}

					}     
					?>
					<div id="kwitansi">
						<a class="btn btn-danger btn-sm pull-right"  onclick="tutup()">Tutup Kwitansi</a>
						<embed src="cetak_kwitansi.php?jenis=operasional&id=<?php echo $operasional_id;?>" width="100%" height="500">    
						</div>   
						<?php       
					}

					if(isset($_POST['hapus_operasional']) or isset($_POST['hapus_lain'])){
						$operasional_id           = $_POST['operasional_id'];

						$up=mysqli_query($con,"delete from tbl_operasional where operasional_id='$operasional_id'");
						if($up){
							?>
							<script type="text/javascript">
								toastr.success('Data terhapus');
							</script>
							<?php
						}else{
							?>
							<script type="text/javascript">
								toastr.error('Data tidak terhapus');
							</script>
							<?php
						}   

					}

					?>
					<script type="text/javascript">
						function tutup(){
    //alert("titup");
    document.getElementById("kwitansi").style.display = "none";      
};
</script>