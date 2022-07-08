       <?php session_start();


       $USERNAME   = $_SESSION['USERNAME'];
       $USER_ID       = $_SESSION['USER_ID'];
       $NAMA       = $_SESSION['NAMA'];
       $CABANG       = $_SESSION['CABANG'];
       $LEVEL           = $_SESSION['LEVEL'];
       $bulan           = $_SESSION['BULAN'];


       $judul      = $_POST['judul'];
       $tampil     = $_POST['tampil'];
       include     "lib/koneksi.php";
       ?>
       <div class="modal-content">            
       	<div class="card">
       		<div class="card-header bg-gray-dark" >
       			<h5 class="card-title"><?php echo $judul;?></h5>

       			<div class="card-tools">

       				<button type="button" class="btn btn-tool" data-dismiss="modal">
       					<i class="fas fa-times"></i>
       				</button>
       			</div>
       		</div>
       		<!-- /.card-header -->
       		<div class="card-body">

       			<?php
       			if($tampil=="profil_add"){
       				$q    = mysqli_query($con,"select * from tbl_owner");
       				$data  = mysqli_fetch_array($q,MYSQLI_ASSOC);
       				$nama_own   = $data['nama'];
       				$alamat     = $data['alamat'];
       				$gambar     = $data['gambar'];
       				?>
       				<form method="POST" action="/profil" enctype="multipart/form-data">
       					<label>Nama KSP</label>
       					<input type="text" name="nama" value="<?php echo $nama_own;?>" class="form-control">
       					<label>Alamat</label>
       					<textarea class="form-control" rows="3" name="alamat"><?php echo $alamat;?></textarea>
       					<label>Logo</label>
       					<input type="file" name="gambar" class="form-control" value="<?php echo $gambar;?>">
       					<img src="<?php echo $gambar;?>" width="150">
       					<br>
       					<input type="submit" name="update" class="btn btn-sm btn-warning pull-right" value="Simpan">
       				</form>
       				<?php
       			}
       			/* tmbah inventaris ------------------------------------------------------- */
       			if($tampil=="inventaris_add"){
       				$inven_id          = $_POST['inven_id'];

       				$q= mysqli_query($con,"select * from tbl_inventaris where inven_id='$inven_id'");
       				$h=mysqli_fetch_array($q,MYSQLI_ASSOC);
       				$inven_nama       = $h['inven_nama'];
       				$inven_nopol     = $h['inven_nopol'];
       				$inven_stnk         = $h['inven_stnk'];
       				$inven_tempo      = $h['inven_tempo'];
       				$inven_transport    = $h['inven_transport'];
       				$pegawai_id         = $pegawai_id;



       				?>
       				<form method="POST" action="/inventaris">
       					<input type="hidden" name="inven_id" value="<?php echo $inven_id;?>">

       					<table class="table">
       						<tr>
       							<td>Nama Invetaris</td>
       							<td>
       								<input type="text" name="inven_nama" class="form-control" value="<?php echo $inven_nama;?>">
       							</td>
       						</tr>
       						<tr>
       							<td>Nopol</td>
       							<td>
       								<input type="text" name="inven_nopol" class="form-control" value="<?php echo $inven_nopol;?>">
       							</td>
       						</tr>
       						<tr>
       							<td>Nama STNK</td>
       							<td>
       								<input type="text" name="inven_stnk" class="form-control" value="<?php echo $inven_stnk;?>">
       							</td>
       						</tr>
       						<tr>
       							<td>Tanggal Tempo</td>
       							<td>
       								<input type="date" name="inven_tempo" class="form-control" style="width: 40%" value="<?php echo $inven_tempo;?>">
       							</td>
       						</tr>
       						<tr>
       							<td>Transport</td>
       							<td>
       								<input type="text" name="inven_transport" class="form-control" value="<?php echo $inven_transport;?>">
       							</td>
       						</tr>
       						<tr>
       							<td>Pemegang</td>
       							<td>
       								<select name="pegawai_id" class="form-control" style="width: 100%" id="keterangan">
       									<option value=""></option>
       									<?php
       									$qpeg = mysqli_query($con,"select pegawai_id,pegawai_nama from tbl_pegawai where status = 'aktif'");
       									while($hpeg=mysqli_fetch_array($qpeg)){
       										$pegawai_idne = $hpeg['pegawai_id'];
       										if($pegawai_id==$pegawai_idne){
       											$pilih = "selected";
       										}else{
       											$pilih = "";
       										}

       										?>
       										<option value="<?php echo $pegawai_idne;?>" <?php echo $pilih;?>><?php echo $hpeg['pegawai_nama'];?></option>


       										<?php

       									}
       									?>
       								</select>
       							</td>
       						</tr>

       						<tr>
       							<td></td>
       							<td>
       								<input type="submit" name="update" class="btn btn-primary" value="Simpan">
       							</td>
       						</tr>

       					</table>

       				</form>


       				<?php


       			}

       			/* tmbah pengeluaran ------------------------------------------------------- */
       			if($tampil=="pengeluaran_add"){
       				$pengeluaran_id         = $_POST['pengeluaran_id'];

       				$q= mysqli_query($con,"select * from tbl_pengeluaran where pengeluaran_id='$pengeluaran_id'");
       				$h=mysqli_fetch_array($q,MYSQLI_ASSOC);
       				$pengeluaran       = $h['pengeluaran'];
       				$nominal     = $h['nominal'];



       				?>
       				<form method="POST" action="/pengeluaran">
       					<input type="hidden" name="pengeluaran_id" value="<?php echo $pengeluaran_id;?>">

       					<table class="table">
       						<tr>
       							<td>Nama Pengeluaran</td>
       							<td>
       								<input type="text" name="pengeluaran" class="form-control" value="<?php echo $pengeluaran;?>">
       							</td>
       						</tr>
       						<tr>
       							<td>Nominal</td>
       							<td>
       								<input type="number" name="nominal" class="form-control" value="<?php echo $nominal;?>">
       							</td>
       						</tr>

       						<tr>
       							<td></td>
       							<td>
       								<input type="submit" name="update" class="btn btn-primary" value="Simpan">
       							</td>
       						</tr>

       					</table>

       				</form>


       				<?php


       			}

       			/* tmbah pemasukan ------------------------------------------------------- */
       			if($tampil=="pemasukan_add"){
       				$pemasukan_id         = $_POST['pemasukan_id'];

       				$q= mysqli_query($con,"select * from tbl_pemasukan where pemasukan_id='$pemasukan_id'");
       				$h=mysqli_fetch_array($q,MYSQLI_ASSOC);
       				$pemasukan       = $h['pemasukan'];
       				$nominal     = $h['nominal'];



       				?>
       				<form method="POST" action="/pemasukan">
       					<input type="hidden" name="pemasukan_id" value="<?php echo $pemasukan_id;?>">

       					<table class="table">
       						<tr>
       							<td>Nama Pemasukan</td>
       							<td>
       								<input type="text" name="pemasukan" class="form-control" value="<?php echo $pemasukan;?>">
       							</td>
       						</tr>
       						<tr>
       							<td>Nominal</td>
       							<td>
       								<input type="number" name="nominal" class="form-control" value="<?php echo $nominal;?>">
       							</td>
       						</tr>

       						<tr>
       							<td></td>
       							<td>
       								<input type="submit" name="update" class="btn btn-primary" value="Simpan">
       							</td>
       						</tr>

       					</table>

       				</form>


       				<?php


       			}
       			/* tmbah resor ------------------------------------------------------- */
       			if($tampil=="resort_add"){
       				$resort_id          = $_POST['resort_id'];

       				$q= mysqli_query($con,"select * from tbl_resort where resort_id='$resort_id'");
       				$h=mysqli_fetch_array($q,MYSQLI_ASSOC);
       				$resort_nama       = $h['resort_nama'];
       				$pegawai_id     = $h['pegawai_id'];
       				$unit_id       = $h['unit_id'];

       				?>
       				<form method="POST" action="/resort">
       					<input type="hidden" name="resort_id" value="<?php echo $resort_id;?>">

       					<table class="table">
       						<tr>
       							<td>Nama Resort</td>
       							<td>
       								<input type="text" name="resort_nama" class="form-control" value="<?php echo $resort_nama;?>">
       							</td>
       						</tr>
       						<tr>
       							<td>Unit</td>
       							<td>
       								<select name="unit_id" class="form-control" style="width: 100%" id="unit_id">
       									<option value=""></option>
       									<?php
       									$qpeg = mysqli_query($con,"select unit_id,unit_nama from tbl_unit ");
       									while($hpeg=mysqli_fetch_array($qpeg)){
       										$unit_idne = $hpeg['unit_id'];
       										if($unit_id==$unit_idne){
       											$pilih = "selected";
       										}else{
       											$pilih = "";
       										}

       										?>
       										<option value="<?php echo $unit_idne;?>" <?php echo $pilih;?>><?php echo $hpeg['unit_nama'];?></option>


       										<?php

       									}
       									?>
       								</select>
       							</td>
       						</tr>

       						<tr>
       							<td>PDL</td>
       							<td>
       								<select name="pegawai_id" class="form-control" style="width: 100%" id="keterangan">
       									<option value=""></option>
       									<?php
       									$qpeg = mysqli_query($con,"select pegawai_id,pegawai_nama from tbl_pegawai a join tbl_jabatan b on a.jabatan_id=b.jabatan_id where b.jabatan_nama like '%PDL%' and status = 'aktif'");
       									while($hpeg=mysqli_fetch_array($qpeg)){
       										$pegawai_idne = $hpeg['pegawai_id'];
       										if($pegawai_id==$pegawai_idne){
       											$pilih = "selected";
       										}else{
       											$pilih = "";
       										}

       										?>
       										<option value="<?php echo $pegawai_idne;?>" <?php echo $pilih;?>><?php echo $hpeg['pegawai_nama'];?></option>


       										<?php

       									}
       									?>
       								</select>
       							</td>
       						</tr>

       						<tr>
       							<td></td>
       							<td>
       								<input type="submit" name="update" class="btn btn-primary" value="Simpan">
       							</td>
       						</tr>

       					</table>

       				</form>


       				<?php


       			}

       			/* tmbah unit ------------------------------------------------------- */
       			if($tampil=="unit_add"){
       				$unit_id          = $_POST['unit_id'];

       				$q= mysqli_query($con,"select * from tbl_unit where unit_id='$unit_id'");
       				$h=mysqli_fetch_array($q,MYSQLI_ASSOC);
       				$unit_nama       = $h['unit_nama'];

       				?>
       				<form method="POST" action="/unit">
       					<input type="hidden" name="unit_id" value="<?php echo $unit_id;?>">

       					<table class="table">
       						<tr>
       							<td>Nama Unit</td>
       							<td>
       								<input type="text" name="unit_nama" class="form-control" value="<?php echo $unit_nama;?>">
       							</td>
       						</tr>



       						<tr>
       							<td></td>
       							<td>
       								<input type="submit" name="update" class="btn btn-primary" value="Simpan">
       							</td>
       						</tr>

       					</table>

       				</form>


       				<?php


       			}

       			/* tmbah resor ------------------------------------------------------- */
       			if($tampil=="proses_gaji_add"){
       				$pegawai_id          = $_POST['pegawai_id'];
       				$jabatan_id 		   = $_POST['jabatan_id'];

       				$q= mysqli_query($con,"select gaji_jabatan,gaji_masa_kerja,gaji_pendidikan,gaji_kompetensi,gaji_prive,gaji_panjer,gaji_lain,gaji_bulan,gaji_pokok,gaji_tunjangan,gaji_potongan,gaji_diterima,gaji_tabungan from tbl_gaji where pegawai_id='$pegawai_id'");
       				$cek = mysqli_num_rows($q);
       				while($h=mysqli_fetch_array($q,MYSQLI_ASSOC)){
       					$gaji_bulan 	= $h['gaji_bulan'];
       					if($gaji_bulan==$bulan){
       						$gaji_pokok       = $h['gaji_pokok'];
       						$gaji_tunjangan     = $h['gaji_tunjangan'];
       						$gaji_prive 		= $h['gaji_prive'];
       						$gaji_panjer 		= $h['gaji_panjer'];
       						$gaji_lain 			= $h['gaji_lain'];
       						$gaji_tabungan = $h['gaji_tabungan'];
       						$gaji_diterima 		= $h['gaji_diterima'];
       						$gaji_jabatan       = $h['gaji_jabatan'];
       						$gaji_masa_kerja    = $h['gaji_masa_kerja'];
       						$gaji_pendidikan    = $h['gaji_pendidikan'];
       						$gaji_kompetensi    = $h['gaji_kompetensi'];

       						$gaji_prive_arr[] 		= $h['gaji_prive'];
       						$gaji_panjer_arr[] 		= $h['gaji_panjer'];
                        //$gaji_lain_arr[] 			= $h['gaji_lain'];
       					}else{
       						$gaji_prive_arr[] 		= $h['gaji_prive'];
       						$gaji_panjer_arr[] 		= $h['gaji_panjer'];
		                      //  $gaji_lain_arr[] 			= $h['gaji_lain'];
       					}
       				}

       				$qgapok = mysqli_query($con,"select gaji_pokok from tbl_jabatan where jabatan_id='$jabatan_id'");
       				$dgapok = mysqli_fetch_array($qgapok);
       				if($gaji_pokok==""){
       					$gaji_pokok = $dgapok['gaji_pokok'];
       				}else{
       					$gaji_pokok = $gaji_pokok;
       				}

       				if($gaji_lain==""){
       					$gaji_lain =0;
       				}else{
       					$gaji_lain=$gaji_lain;
       				}
       				if($gaji_tabungan==""){
       					$gaji_tabungan =0;
       				}else{
       					$gaji_tabungan=$gaji_tabungan;
       				}

       				if($gaji_tunjangan==""){
       					$gaji_tunjangan =0;
       				}else{
       					$gaji_tunjangan=$gaji_tunjangan;
       				}

       				$cicilan_prive = array_sum($gaji_prive_arr);
       				$cicilan_panjer = array_sum($gaji_panjer_arr);


       				$qbonp = mysqli_query($con,"select sum(prive_nominal) as bon_prive from tbl_bon_prive where pegawai_id='$pegawai_id'");
       				$bonp=mysqli_fetch_array($qbonp);

       				$bon_prive = $bonp['bon_prive']-$cicilan_prive;

       				$qbonpj = mysqli_query($con,"select sum(panjer_nominal) as bon_panjer from tbl_bon_panjer where pegawai_id='$pegawai_id'");
       				$bonpj=mysqli_fetch_array($qbonpj);

       				$bon_panjer = $bonpj['bon_panjer']-$cicilan_panjer;

       				if($gaji_diterima==""){
       					$gaji_diterima = ($gaji_pokok+$gaji_tunjangan)-$bon_prive-$bon_panjer-$gaji_lain-$gaji_tabungan;
       				}else{
       					$gaji_diterima=$gaji_diterima;
       				}

       				if($gaji_prive!=""){
       					$bon_prive = $gaji_prive;
       				}else{
       					$bon_prive = $bon_prive;
       				}

       				if($gaji_panjer!=""){
       					$bon_panjer = $gaji_panjer;
       				}else{
       					$bon_panjer = $bon_panjer;
       				}


       				?>
       				<form method="POST" action="/proses_gaji">
       					<input type="hidden" name="pegawai_id" value="<?php echo $pegawai_id;?>">

       					<table class="table">
       						<tr>
       							<td>Gaji Pokok</td>
       							<td>
       								<input type="number" name="gaji_pokok" class="form-control" value="<?php echo $gaji_pokok;?>" >
       							</td>
       						</tr>
       						<tr>
       							<td>Tunjangan Jabatan</td>
       							<td>
       								<input type="number" name="gaji_jabatan" class="form-control" value="<?php echo $gaji_jabatan;?>" >
       							</td>
       						</tr>
       						<tr>
       							<td>Tunjangan Masa Kerja</td>
       							<td>
       								<input type="number" name="gaji_masa_kerja" class="form-control" value="<?php echo $gaji_masa_kerja;?>" >
       							</td>
       						</tr>
       						<tr>
       							<td>Tunjangan Pendidikan</td>
       							<td>
       								<input type="number" name="gaji_pendidikan" class="form-control" value="<?php echo $gaji_pendidikan;?>" >
       							</td>
       						</tr>
       						<tr>
       							<td>Tunjangan Kompetensi</td>
       							<td>
       								<input type="number" name="gaji_kompetensi" class="form-control" value="<?php echo $gaji_kompetensi;?>" >
       							</td>
       						</tr>
       						<tr>
       							<td>Potongan Bon Prive</td>
       							<td>
       								<input type="number" name="gaji_prive" class="form-control" value="<?php echo $bon_prive;?>" >
       							</td>
       						</tr>
       						<tr>
       							<td>Potongan Bon Panjer</td>
       							<td>
       								<input type="number" name="gaji_panjer" class="form-control" value="<?php echo $bon_panjer;?>" >
       							</td>
       						</tr>
       						<tr>
       							<td>Potongan Tabungan</td>
       							<td>
       								<input type="number" name="gaji_tabungan" class="form-control" value="<?php echo $gaji_tabungan;?>" >
       							</td>
       						</tr>
       						<tr>
       							<td>Potongan Lain</td>
       							<td>
       								<input type="number" name="gaji_lain" class="form-control" value="<?php echo $gaji_lain;?>" >
       							</td>
       						</tr>
       						<tr>
       							<td>Gaji Yang diterima</td>
       							<td>
       								<input type="number" name="gaji_diterima" class="form-control" value="<?php echo $gaji_diterima;?>" readonly>
       							</td>
       						</tr>


       						<tr>
       							<td></td>
       							<td>
       								<input type="submit" name="update" class="btn btn-primary" value="Simpan">
       							</td>
       						</tr>

       					</table>

       				</form>


       				<?php


       			}
       			/* tmbah jabatan ------------------------------------------------------- */
       			if($tampil=="jabatan_add"){
       				$jabatan_id          = $_POST['jabatan_id'];

       				$q= mysqli_query($con,"select * from tbl_jabatan where jabatan_id='$jabatan_id'");
       				$h=mysqli_fetch_array($q,MYSQLI_ASSOC);
       				$jabatan_nama       = $h['jabatan_nama'];
       				$bon_prive     = $h['bon_prive'];
       				$bon_panjer         = $h['bon_panjer'];
       				$gaji_pokok      = $h['gaji_pokok'];


       				?>
       				<form method="POST" action="/gaji">
       					<input type="hidden" name="jabatan_id" value="<?php echo $jabatan_id;?>">

       					<table class="table">
       						<tr>
       							<td>Nama Jabatan</td>
       							<td>
       								<input type="text" name="jabatan_nama" class="form-control" value="<?php echo $jabatan_nama;?>">
       							</td>
       						</tr>
       						<tr>
       							<td>Jatah Bon Prive</td>
       							<td>
       								<input type="text" name="bon_prive" class="form-control" value="<?php echo $bon_prive;?>">
       							</td>
       						</tr>
       						<tr>
       							<td>Jatah Bon Panjer</td>
       							<td>
       								<input type="text" name="bon_panjer" class="form-control" value="<?php echo $bon_panjer;?>">
       							</td>
       						</tr>
       						<tr>
       							<td>Gaji Pokok</td>
       							<td>
       								<input type="text" name="gaji_pokok" class="form-control"  value="<?php echo $gaji_pokok;?>">
       							</td>
       						</tr>


       						<tr>
       							<td></td>
       							<td>
       								<input type="submit" name="update" class="btn btn-primary" value="Simpan">
       							</td>
       						</tr>

       					</table>

       				</form>


       				<?php


       			}
       			if($tampil=="slip_gaji"){
       				$pegawai_id = $_POST['pegawai_id'];
       				?>
       				<embed src="cetak_gaji.php?pegawai_id=<?php echo $pegawai_id;?>" width="100%" height="500">    
       					<?php
       				}
       				if($tampil=="kwitansi"){
       					$jenis = $_POST['jenis'];
       					$id    = $_POST['id'];
       					?>
       					<embed src="cetak_kwitansi.php?jenis=<?php echo $jenis;?>&id=<?php echo $id;?>" width="100%" height="500">    
       						<?php
       					}

       					/* tmbah anggota ------------------------------------------------------- */
       					if($tampil=="tambah_anggota"){
       						$resort_id          = $_POST['resort_id'];
       						$anggota_id         = $_POST['anggota_id'];
       						$q= mysqli_query($con,"select * from tbl_anggota where anggota_id='$anggota_id'");
       						$h=mysqli_fetch_array($q,MYSQLI_ASSOC);
       						$anggota_nama       = $h['anggota_nama'];
       						$anggota_alamat     = $h['anggota_alamat'];
       						$keterangan         = $h['keterangan'];
       						$tgl_daftar         = substr($h['tgl_daftar'],0,10);
       						$tgl_keluar         = substr($h['tgl_keluar'],0,10);
       						if($tgl_keluar=="1900-01-01"){
       							$tgl_keluar="";
       						}else{
       							$tgl_keluar=$tgl_keluar;
       						}

       						if($resort_id==""){
       							$resort_id=$h['resort_id'];
       						}else{
       							$resort_id = $resort_id;
       						}
       						?>
       						<form method="POST" action="/anggota">
       							<input type="hidden" name="anggota_id" value="<?php echo $anggota_id;?>">
       							<input type="hidden" name="resort_id" value="<?php echo $resort_id;?>">
       							<table class="table">
       								<tr>
       									<td>Nama</td>
       									<td>
       										<input type="text" name="anggota_nama" class="form-control" value="<?php echo $anggota_nama;?>">
       									</td>
       								</tr>
       								<tr>
       									<td>Alamat</td>
       									<td>
       										<textarea name="anggota_alamat" class="form-control"><?php echo $anggota_alamat;?></textarea>
       									</td>
       								</tr>
       								<tr>
       									<td>Tanggal Daftar</td>
       									<td>
       										<input type="date" name="tgl_daftar" class="form-control" style="width: 40%" value="<?php echo $tgl_daftar;?>">
       									</td>
       								</tr>
       								<tr>
       									<td>Status Anggota</td>
       									<td>
       										<select name="keterangan" class="form-control" style="width: 20%" id="keterangan">
       											<?php
       											if($keterangan=="A"){
       												$piliha="selected";
       											}if($keterangan=="K"){
       												$pilihk="selected";
       											}
       											?>
       											<option value="A" <?php echo $piliha;?>>A</option>
       											<option value="K" <?php echo $pilihk;?>>K</option>

       										</select>
       									</td>
       								</tr>
       								<tr>
       									<?php
       									if($keterangan=="A" or $keterangan==""){
       										$readonly = "readonly";
       									}else{
       										$readonly="";
       									}
       									?>
       									<td>Tanggal Keluar</td>
       									<td>
       										<input type="date" name="tgl_keluar" class="form-control" style="width: 40%" value="<?php echo $tgl_keluar;?>" <?php echo $readonly;?> id="tgl_keluar">
       									</td>
       								</tr>
       								<tr>
       									<td></td>
       									<td>
       										<input type="submit" name="tambah_anggota" class="btn btn-primary" value="Simpan">
       									</td>
       								</tr>

       							</table>

       						</form>
       						<script type="text/javascript">
       							$("#keterangan").change(function(){
       								var keterangan = $("#keterangan").val();                                            
       								if(keterangan=="K"){
       									document.getElementById("tgl_keluar").readOnly = false;

       								}else{
       									document.getElementById("tgl_keluar").readOnly = true;
       									document.getElementById("tgl_keluar").value = "";
       								}               

       							});
       						</script>

       						<?php


       					}
       					/* tambah simpanan ----------------------------------------------------------------------- */
       					if($tampil=="tambah_simpanan"){
       						$simpanan_tgl            = $_POST['pdl_tgl'];
       						$resort_id      = $_POST['pdl_resort_id'];
       						$simpanan_id        = $_POST['simpanan_id'];
                      //echo $resort_id."aaaaaaaaaaa".$simpanan_tgl;

       						$q= mysqli_query($con,"select * from tbl_simpanan where simpanan_id='$simpanan_id'");
       						$h=mysqli_fetch_array($q,MYSQLI_ASSOC);
       						$anggota_id         = $h['anggota_id'];
       						$resort_idne          = $h['resort_id'];
       						$pinjaman           = $h['pinjaman'];
       						$pinjaman_ke        = $h['pinjaman_ke'];

       						if($pinjaman_ke!=""){
       							$pinjaman_ke=$pinjaman_ke;
       						}else{
       							$pinjaman_ke="B";
       						}

       						if($resort_idne!=""){
       							$resort_id = $resort_idne;
       						}else {
       							$resort_id = $resort_id;
       						}
       						?>
       						<form method="POST" action="/pdl">
       							<input type="hidden" name="tab" value="1">
       							<input type="hidden" name="simpanan_id" value="<?php echo $simpanan_id;?>">
       							<input type="hidden" name="simpanan_tgl" value="<?php echo $simpanan_tgl;?>">
       							<label>Rekap tanggal <?php echo tanggal($simpanan_tgl);?></label>
       							<table class="table">
       								<tr>
       									<td>
       										Resort
       									</td>
       									<td>
                              <?php //echo $resort_id;
                              ?>
                              <select name="resort_id" class="form-control" style="width: 50%" required>
                              	<option value="">Pilih resort</option>
                              	<?php 
                              	$qresort = mysqli_query($con,"select * from tbl_resort where resort_id='$resort_id' ");
                              	while($data_resort    = mysqli_fetch_array($qresort,MYSQLI_ASSOC)){
                              		$resort_id_data     = $data_resort['resort_id'];
                              		if($resort_id_data==$resort_id){
                              			$pilih   = "selected";
                              		}else{
                              			$pilih   = "";
                              		}
                              		?>
                              		<option value="<?php echo $data_resort['resort_id']?>" <?php echo $pilih;?>><?php echo $data_resort['resort_nama']?></option>
                              	<?php } ?>
                              </select>
                          </td>
                      </tr>
                      <tr>

                      	<td width="30%">Nama Anggota</td>
                      	<td>
                      		<select name="anggota_id" class="form-control" style="width: 50%" required>
                      			<option value="">Pilih Anggota</option>
                      			<?php 
                      			$qanggota = mysqli_query($con,"select anggota_id,anggota_nama from tbl_anggota where resort_id = '$resort_id' order by anggota_nama asc");
                      			while($data_anggota    = mysqli_fetch_array($qanggota,MYSQLI_ASSOC)){
                      				$anggota_id_data     = $data_anggota['anggota_id'];
                      				if($anggota_id_data==$anggota_id){
                      					$pilih   = "selected";
                      				}else{
                      					$pilih   = "";
                      				}
                      				?>
                      				<option value="<?php echo $data_anggota['anggota_id']?>" <?php echo $pilih;?>><?php echo $data_anggota['anggota_nama']?></option>
                      			<?php } ?>
                      		</select>
                      	</td>

                      </tr>
                      <tr>
                      	<td>Pinjaman Ke</td>
                      	<td>
                      		<select name="pinjaman_ke" class="form-control" style="width: 30%" required>
                      			<option value="B">B</option>
                      			<?php 
                      			for ($ke=2;$ke<=100;$ke++){
                      				if($ke==$pinjaman_ke){
                      					$pilih="selected";
                      				}else{
                      					$pilih="";
                      				}
                      				?>
                      				<option value="<?php echo $ke;?>" <?php echo $pilih;?>><?php echo $ke;?></option>
                      			<?php } ?>
                      		</select>
                      	</td>
                      </tr>
                      <tr>
                      	<td>
                      		Pinjaman
                      	</td>
                      	<td>
                      		<input type="number" name="pinjaman" value="<?php echo $pinjaman;?>" class="form-control" style="width: 40%">
                      	</td>
                      </tr>
                      <tr>
                      	<td></td>
                      	<td>
                      		<input type="submit" name="tambah_simpanan" value="Simpan" class="btn btn-sm btn-primary">
                      	</td>
                      </tr>

                  </table>

              </form>

              <?php

          }
          if($tampil=="inventaris_del"){
          	$inven_id           = $_POST['inven_id'];
          	?>
          	<table width="100%">
          		<tr valign="top">
          			<td align="right">
          				<form method="POST" action="/inventaris" >

          					<input type="hidden" name="inven_id" value="<?php echo $inven_id;?>">
          					<input type="submit" name="delete" class="btn btn-sm btn-danger" value="Yakin">
          				</form>
          			</td>
          			<td>
          				<button type="button" class="btn btn-sm btn-success" data-dismiss="modal">Batal </button>
          			</td>
          		</table>
          		<?php
          	}

          	if($tampil=="pemasukan_del"){
          		$pemasukan_id           = $_POST['pemasukan_id'];
          		?>
          		<table width="100%">
          			<tr valign="top">
          				<td align="right">
          					<form method="POST" action="/pemasukan" >

          						<input type="hidden" name="pemasukan_id" value="<?php echo $pemasukan_id;?>">
          						<input type="submit" name="delete" class="btn btn-sm btn-danger" value="Yakin">
          					</form>
          				</td>
          				<td>
          					<button type="button" class="btn btn-sm btn-success" data-dismiss="modal">Batal </button>
          				</td>
          			</table>
          			<?php
          		}

          		if($tampil=="pengeluaran_del"){
          			$pengeluaran_id           = $_POST['pengeluaran_id'];
          			?>
          			<table width="100%">
          				<tr valign="top">
          					<td align="right">
          						<form method="POST" action="/pengeluaran" >

          							<input type="hidden" name="pengeluaran_id" value="<?php echo $pengeluaran_id;?>">
          							<input type="submit" name="delete" class="btn btn-sm btn-danger" value="Yakin">
          						</form>
          					</td>
          					<td>
          						<button type="button" class="btn btn-sm btn-success" data-dismiss="modal">Batal </button>
          					</td>
          				</table>
          				<?php
          			}

          			if($tampil=="resort_del"){
          				$resort_id           = $_POST['resort_id'];
          				?>
          				<table width="100%">
          					<tr valign="top">
          						<td align="right">
          							<form method="POST" action="/resort" >

          								<input type="hidden" name="resort_id" value="<?php echo $resort_id;?>">
          								<input type="submit" name="delete" class="btn btn-sm btn-danger" value="Yakin">
          							</form>
          						</td>
          						<td>
          							<button type="button" class="btn btn-sm btn-success" data-dismiss="modal">Batal </button>
          						</td>
          					</table>
          					<?php
          				}

          				if($tampil=="unit_del"){
          					$unit_id           = $_POST['unit_id'];
          					?>
          					<table width="100%">
          						<tr valign="top">
          							<td align="right">
          								<form method="POST" action="/unit" >

          									<input type="hidden" name="unit_id" value="<?php echo $unit_id;?>">
          									<input type="submit" name="delete" class="btn btn-sm btn-danger" value="Yakin">
          								</form>
          							</td>
          							<td>
          								<button type="button" class="btn btn-sm btn-success" data-dismiss="modal">Batal </button>
          							</td>
          						</table>
          						<?php
          					}

          					if($tampil=="jabatan_del"){
          						$jabatan_id           = $_POST['jabatan_id'];
          						?>
          						<table width="100%">
          							<tr valign="top">
          								<td align="right">
          									<form method="POST" action="/gaji" >

          										<input type="hidden" name="jabatan_id" value="<?php echo $jabatan_id;?>">
          										<input type="submit" name="delete" class="btn btn-sm btn-danger" value="Yakin">
          									</form>
          								</td>
          								<td>
          									<button type="button" class="btn btn-sm btn-success" data-dismiss="modal">Batal </button>
          								</td>
          							</table>
          							<?php
          						}
                    /*
                  
                    ------------------------------------------------------------------------------------------------ */
                    if($tampil=="hapus_simpanan"){
                    	$simpanan_id           = $_POST['simpanan_id'];
                    	?>
                    	<table width="100%">
                    		<tr valign="top">
                    			<td align="right">
                    				<form method="POST" action="/pdl" >
                    					<input type="hidden" name="tab" value="1">
                    					<input type="hidden" name="simpanan_id" value="<?php echo $simpanan_id;?>">
                    					<input type="submit" name="hapus_simpanan" class="btn btn-sm btn-danger" value="Yakin">
                    				</form>
                    			</td>
                    			<td>
                    				<button type="button" class="btn btn-sm btn-success" data-dismiss="modal">Batal </button>
                    			</td>
                    		</table>
                    		<?php
                    	}
                    	/* tambah pinjaman ----------------------------------------------------------------------- */
                    	if($tampil=="tambah_pinjaman"){
                    		$pinjaman_tgl            = $_POST['pdl_tgl'];
                    		$resort_id      = $_POST['pdl_resort_id'];
                    		$pinjaman_id        = $_POST['pinjaman_id'];
                      //echo $resort_id."aaaaaaaaaaa".$pinjaman_tgl;

                    		$q= mysqli_query($con,"select * from tbl_pinjaman where pinjaman_id='$pinjaman_id'");
                    		$h=mysqli_fetch_array($q,MYSQLI_ASSOC);
                    		$anggota_id         = $h['anggota_id'];
                    		$resort_idne          = $h['resort_id'];
                    		$bp           = $h['bp'];
                    		$pinjaman_ke        = $h['pinjaman_ke'];

                    		if($pinjaman_ke!=""){
                    			$pinjaman_ke=$pinjaman_ke;
                    		}else{
                    			$pinjaman_ke="B";
                    		}

                    		if($resort_idne!=""){
                    			$resort_id = $resort_idne;
                    		}else {
                    			$resort_id = $resort_id;
                    		}
                    		?>
                    		<form method="POST" action="/pdl">
                    			<input type="hidden" name="pinjaman_id" value="<?php echo $pinjaman_id;?>">
                    			<input type="hidden" name="tab" value="2">
                    			<input type="hidden" name="pinjaman_tgl" value="<?php echo $pinjaman_tgl;?>">
                    			<label>Rekap tanggal <?php echo tanggal($pinjaman_tgl);?></label>
                    			<table class="table">
                    				<tr>
                    					<td>
                    						Resort
                    					</td>
                    					<td>

                    						<select name="resort_id" class="form-control" style="width: 50%" required>
                    							<option value="">Pilih resort</option>
                    							<?php 
                    							$qresort = mysqli_query($con,"select * from tbl_resort where resort_id='$resort_id'");
                    							while($data_resort    = mysqli_fetch_array($qresort,MYSQLI_ASSOC)){
                    								$resort_id_data     = $data_resort['resort_id'];
                    								if($resort_id_data==$resort_id){
                    									$pilih   = "selected";
                    								}else{
                    									$pilih   = "";
                    								}
                    								?>
                    								<option value="<?php echo $data_resort['resort_id']?>" <?php echo $pilih;?>><?php echo $data_resort['resort_nama']?></option>
                    							<?php } ?>
                    						</select>
                    					</td>
                    				</tr>
                    				<tr>

                    					<td width="30%">Nama Anggota</td>
                    					<td>
                    						<select name="anggota_id" class="form-control" style="width: 50%" required>

                    							<?php 
                    							$qanggota = mysqli_query($con,"select anggota_id,anggota_nama from tbl_anggota where resort_id='$resort_id' order by anggota_nama asc");
                    							while($data_anggota    = mysqli_fetch_array($qanggota,MYSQLI_ASSOC)){
                    								$anggota_id_data     = $data_anggota['anggota_id'];
                    								if($anggota_id_data==$anggota_id){
                    									$pilih   = "selected";
                    								}else{
                    									$pilih   = "";
                    								}
                    								?>
                    								<option value="<?php echo $data_anggota['anggota_id']?>" <?php echo $pilih;?>><?php echo $data_anggota['anggota_nama']?></option>
                    							<?php } ?>
                    						</select>
                    					</td>

                    				</tr>
                    				<tr>
                    					<td>Pinjaman Ke</td>
                    					<td>
                    						<select name="pinjaman_ke" class="form-control" style="width: 30%" required>
                    							<option value="B">B</option>
                    							<?php 
                    							for ($ke=2;$ke<=100;$ke++){
                    								if($ke==$pinjaman_ke){
                    									$pilih="selected";
                    								}else{
                    									$pilih="";
                    								}
                    								?>
                    								<option value="<?php echo $ke;?>" <?php echo $pilih;?>><?php echo $ke;?></option>
                    							<?php } ?>
                    						</select>
                    					</td>
                    				</tr>
                    				<tr>
                    					<td>
                    						B/P
                    					</td>
                    					<td>
                    						<input type="number" name="bp" value="<?php echo $bp;?>" class="form-control" style="width: 40%">
                    					</td>
                    				</tr>
                    				<tr>
                    					<td></td>
                    					<td>
                    						<input type="submit" name="tambah_pinjaman" value="Simpan" class="btn btn-sm btn-primary">
                    					</td>
                    				</tr>

                    			</table>

                    		</form>

                    		<?php

                    	}
                    /*
                    ------------------------------------------------------------------------------------------------ */



                    if($tampil=="hapus_pinjaman"){
                    	$pinjaman_id           = $_POST['pinjaman_id'];
                    	?>
                    	<table width="100%">
                    		<tr valign="top">
                    			<td align="right">
                    				<form method="POST" action="/pdl" >
                    					<input type="hidden" name="tab" value="2">
                    					<input type="hidden" name="pinjaman_id" value="<?php echo $pinjaman_id;?>">
                    					<input type="submit" name="hapus_pinjaman" class="btn btn-sm btn-danger" value="Yakin">
                    				</form>
                    			</td>
                    			<td>
                    				<button type="button" class="btn btn-sm btn-success" data-dismiss="modal">Batal </button>
                    			</td>
                    		</table>
                    		<?php
                    	}

                    	/* ------------------------------------------ juru buku ------------------------------- */
                    	if($tampil=="validasi_simpanan_jurubuku"){                     
                    		$simpanan_id        = $_POST['simpanan_id'];
                    		$valid              = $_POST['validasi'];

                    		$q= mysqli_query($con,"update tbl_simpanan set validasi='$valid' where simpanan_id='$simpanan_id'");


                    	}
                    	if($tampil=="validasi_pinjaman_jurubuku"){                     
                    		$pinjaman_id        = $_POST['pinjaman_id'];
                    		$valid              = $_POST['validasi'];

                    		$q= mysqli_query($con,"update tbl_pinjaman set validasi='$valid' where pinjaman_id='$pinjaman_id'");


                    	}
                    	/* tambah simpanan ----------------------------------------------------------------------- */
                    	if($tampil=="tambah_simpananjurubuku"){
                    		$simpanan_tgl            = $_POST['pdl_tgl'];
                    		$resort_id      = $_POST['pdl_resort_id'];
                    		$simpanan_id        = $_POST['simpanan_id'];
                      //echo $resort_id."aaaaaaaaaaa".$simpanan_tgl;

                    		$q= mysqli_query($con,"select * from tbl_simpanan where simpanan_id='$simpanan_id'");
                    		$h=mysqli_fetch_array($q,MYSQLI_ASSOC);
                    		$anggota_id         = $h['anggota_id'];
                    		$resort_idne          = $h['resort_id'];
                    		$pinjaman           = $h['pinjaman'];
                    		$pinjaman_ke        = $h['pinjaman_ke'];

                    		if($pinjaman_ke!=""){
                    			$pinjaman_ke=$pinjaman_ke;
                    		}else{
                    			$pinjaman_ke="B";
                    		}

                    		if($resort_idne!=""){
                    			$resort_id = $resort_idne;
                    		}else {
                    			$resort_id = $resort_id;
                    		}
                    		?>
                    		<form method="POST" action="/jurubuku">
                    			<input type="hidden" name="tab" value="1">
                    			<input type="hidden" name="simpanan_id" value="<?php echo $simpanan_id;?>">
                    			<input type="hidden" name="simpanan_tgl" value="<?php echo $simpanan_tgl;?>">
                    			<label>Rekap tanggal <?php echo tanggal($simpanan_tgl);?></label>
                    			<table class="table">
                    				<tr>
                    					<td>
                    						Resort
                    					</td>
                    					<td>
                              <?php //echo $resort_id;
                              ?>
                              <select name="resort_id" class="form-control" style="width: 50%" required>
                              	<option value="">Pilih resort</option>
                              	<?php 
                              	$qresort = mysqli_query($con,"select * from tbl_resort where resort_id='$resort_id'");
                              	while($data_resort    = mysqli_fetch_array($qresort,MYSQLI_ASSOC)){
                              		$resort_id_data     = $data_resort['resort_id'];
                              		if($resort_id_data==$resort_id){
                              			$pilih   = "selected";
                              		}else{
                              			$pilih   = "";
                              		}
                              		?>
                              		<option value="<?php echo $data_resort['resort_id']?>" <?php echo $pilih;?>><?php echo $data_resort['resort_nama']?></option>
                              	<?php } ?>
                              </select>
                          </td>
                      </tr>
                      <tr>

                      	<td width="30%">Nama Anggota</td>
                      	<td>
                      		<select name="anggota_id" class="form-control" style="width: 50%" required>
                      			<option value="">Pilih Anggota</option>
                      			<?php 
                      			$qanggota = mysqli_query($con,"select anggota_id,anggota_nama from tbl_anggota where resort_id = '$resort_id'");
                      			while($data_anggota    = mysqli_fetch_array($qanggota,MYSQLI_ASSOC)){
                      				$anggota_id_data     = $data_anggota['anggota_id'];
                      				if($anggota_id_data==$anggota_id){
                      					$pilih   = "selected";
                      				}else{
                      					$pilih   = "";
                      				}
                      				?>
                      				<option value="<?php echo $data_anggota['anggota_id']?>" <?php echo $pilih;?>><?php echo $data_anggota['anggota_nama']?></option>
                      			<?php } ?>
                      		</select>
                      	</td>

                      </tr>
                      <tr>
                      	<td>Pinjaman Ke</td>
                      	<td>
                      		<select name="pinjaman_ke" class="form-control" style="width: 30%" required>
                      			<option value="B">B</option>
                      			<?php 
                      			for ($ke=2;$ke<=100;$ke++){
                      				if($ke==$pinjaman_ke){
                      					$pilih="selected";
                      				}else{
                      					$pilih="";
                      				}
                      				?>
                      				<option value="<?php echo $ke;?>" <?php echo $pilih;?>><?php echo $ke;?></option>
                      			<?php } ?>
                      		</select>
                      	</td>
                      </tr>
                      <tr>
                      	<td>
                      		Pinjaman
                      	</td>
                      	<td>
                      		<input type="number" name="pinjaman" value="<?php echo $pinjaman;?>" class="form-control" style="width: 40%">
                      	</td>
                      </tr>
                      <tr>
                      	<td></td>
                      	<td>
                      		<input type="submit" name="tambah_simpanan" value="Simpan" class="btn btn-sm btn-primary">
                      	</td>
                      </tr>

                  </table>

              </form>

              <?php

          }
                    /*
                    ------------------------------------------------------------------------------------------------ */
                    if($tampil=="hapus_simpananjurubuku"){
                    	$simpanan_id           = $_POST['simpanan_id'];
                    	?>
                    	<table width="100%">
                    		<tr valign="top">
                    			<td align="right">
                    				<form method="POST" action="/jurubuku" >
                    					<input type="hidden" name="tab" value="1">
                    					<input type="hidden" name="simpanan_id" value="<?php echo $simpanan_id;?>">
                    					<input type="submit" name="hapus_simpanan" class="btn btn-sm btn-danger" value="Yakin">
                    				</form>
                    			</td>
                    			<td>
                    				<button type="button" class="btn btn-sm btn-success" data-dismiss="modal">Batal </button>
                    			</td>
                    		</table>
                    		<?php
                    	}
                    	/* tambah pinjaman ----------------------------------------------------------------------- */
                    	if($tampil=="tambah_pinjamanjurubuku"){
                    		$pinjaman_tgl            = $_POST['pdl_tgl'];
                    		$resort_id      = $_POST['pdl_resort_id'];
                    		$pinjaman_id        = $_POST['pinjaman_id'];
                      //echo $resort_id."aaaaaaaaaaa".$pinjaman_tgl;

                    		$q= mysqli_query($con,"select * from tbl_pinjaman where pinjaman_id='$pinjaman_id'");
                    		$h=mysqli_fetch_array($q,MYSQLI_ASSOC);
                    		$anggota_id         = $h['anggota_id'];
                    		$resort_idne          = $h['resort_id'];
                    		$bp           = $h['bp'];
                    		$pinjaman_ke        = $h['pinjaman_ke'];

                    		if($pinjaman_ke!=""){
                    			$pinjaman_ke=$pinjaman_ke;
                    		}else{
                    			$pinjaman_ke="B";
                    		}

                    		if($resort_idne!=""){
                    			$resort_id = $resort_idne;
                    		}else {
                    			$resort_id = $resort_id;
                    		}
                    		?>
                    		<form method="POST" action="/jurubuku">
                    			<input type="hidden" name="pinjaman_id" value="<?php echo $pinjaman_id;?>">
                    			<input type="hidden" name="tab" value="2">
                    			<input type="hidden" name="pinjaman_tgl" value="<?php echo $pinjaman_tgl;?>">
                    			<label>Rekap tanggal <?php echo tanggal($pinjaman_tgl);?></label>
                    			<table class="table">
                    				<tr>
                    					<td>
                    						Resort
                    					</td>
                    					<td>

                    						<select name="resort_id" class="form-control" style="width: 50%" required>
                    							<option value="">Pilih resort</option>
                    							<?php 
                    							$qresort = mysqli_query($con,"select * from tbl_resort where resort_id='$resort_id'");
                    							while($data_resort    = mysqli_fetch_array($qresort,MYSQLI_ASSOC)){
                    								$resort_id_data     = $data_resort['resort_id'];
                    								if($resort_id_data==$resort_id){
                    									$pilih   = "selected";
                    								}else{
                    									$pilih   = "";
                    								}
                    								?>
                    								<option value="<?php echo $data_resort['resort_id']?>" <?php echo $pilih;?>><?php echo $data_resort['resort_nama']?></option>
                    							<?php } ?>
                    						</select>
                    					</td>
                    				</tr>
                    				<tr>

                    					<td width="30%">Nama Anggota</td>
                    					<td>
                    						<select name="anggota_id" class="form-control" style="width: 50%" required>

                    							<?php 
                    							$qanggota = mysqli_query($con,"select anggota_id,anggota_nama from tbl_anggota where resort_id='$resort_id'");
                    							while($data_anggota    = mysqli_fetch_array($qanggota,MYSQLI_ASSOC)){
                    								$anggota_id_data     = $data_anggota['anggota_id'];
                    								if($anggota_id_data==$anggota_id){
                    									$pilih   = "selected";
                    								}else{
                    									$pilih   = "";
                    								}
                    								?>
                    								<option value="<?php echo $data_anggota['anggota_id']?>" <?php echo $pilih;?>><?php echo $data_anggota['anggota_nama']?></option>
                    							<?php } ?>
                    						</select>
                    					</td>

                    				</tr>
                    				<tr>
                    					<td>Pinjaman Ke</td>
                    					<td>
                    						<select name="pinjaman_ke" class="form-control" style="width: 30%" required>
                    							<option value="B">B</option>
                    							<?php 
                    							for ($ke=2;$ke<=100;$ke++){
                    								if($ke==$pinjaman_ke){
                    									$pilih="selected";
                    								}else{
                    									$pilih="";
                    								}
                    								?>
                    								<option value="<?php echo $ke;?>" <?php echo $pilih;?>><?php echo $ke;?></option>
                    							<?php } ?>
                    						</select>
                    					</td>
                    				</tr>
                    				<tr>
                    					<td>
                    						B/P
                    					</td>
                    					<td>
                    						<input type="number" name="bp" value="<?php echo $bp;?>" class="form-control" style="width: 40%">
                    					</td>
                    				</tr>
                    				<tr>
                    					<td></td>
                    					<td>
                    						<input type="submit" name="tambah_pinjaman" value="Simpan" class="btn btn-sm btn-primary">
                    					</td>
                    				</tr>

                    			</table>

                    		</form>

                    		<?php

                    	}
                    /*
                    ------------------------------------------------------------------------------------------------ */



                    if($tampil=="hapus_pinjamanjurubuku"){
                    	$pinjaman_id           = $_POST['pinjaman_id'];
                    	?>
                    	<table width="100%">
                    		<tr valign="top">
                    			<td align="right">
                    				<form method="POST" action="/jurubuku" >
                    					<input type="hidden" name="tab" value="2">
                    					<input type="hidden" name="pinjaman_id" value="<?php echo $pinjaman_id;?>">
                    					<input type="submit" name="hapus_pinjaman" class="btn btn-sm btn-danger" value="Yakin">
                    				</form>
                    			</td>
                    			<td>
                    				<button type="button" class="btn btn-sm btn-success" data-dismiss="modal">Batal </button>
                    			</td>
                    		</table>
                    		<?php
                    	}


                    	/* pembukuan harian ----------------------------------------------------------------------- */
                    	if($tampil=="tambah_pembukuan_harian"){
                    		$pembukuan_id           = $_POST['pembukuan_id'];

                    		$qpembukuan             = mysqli_query($con,"select * from tbl_pembukuan_harian where pembukuan_id='$pembukuan_id'");
                    		$data                   = mysqli_fetch_array($qpembukuan,MYSQLI_ASSOC);

                    		$drop                   = $data['pembukuan_drop'];
                    		$L                      = $data['L'];
                    		$B                      = $data['B'];
                    		$K                      = $data['K'];
                    		$storting               = $data['storting'];
                    		$psp                    = $data['psp'];
                    		$kasbon_pagi            = $data['kasbon_pagi'];
                    		$resort_id              = $data['resort_id'];
                    		$pembukuan_tgl          = $data['pembukuan_tgl'];

                    		if($pembukuan_tgl==""){
                    			$pembukuan_tgl = date("Y-m-d");
                    		}else{
                    			$pembukuan_tgl = $pembukuan_tgl;
                    		}

                    		?>
                    		<form method="POST" action="/kasir" onsubmit="return confirm('Yakin data sudah benar?')">
                    			<input type="hidden" name="pembukuan_id" value="<?php echo $pembukuan_id;?>">
                    			<table class="table">
                    				<tr>
                    					<td width="30%">
                    						Tanggal Pelaporan
                    					</td>
                    					<td>
                    						<input type="date" name="pembukuan_tgl" value="<?php echo $pembukuan_tgl;?>" class="form-control" style="width: 50%" required>
                    					</td>
                    				</tr>
                    				<tr>
                    					<td>
                    						Anggota Lama
                    					</td>
                    					<td>
                    						<input type="number" name="L" value="<?php echo $L;?>" class="form-control" style="width: 40%" required>
                    					</td>
                    				</tr>
                    				<tr>
                    					<td>
                    						Anggota Baru
                    					</td>
                    					<td>
                    						<input type="number" name="B" value="<?php echo $B;?>" class="form-control" style="width: 40%" required>
                    					</td>
                    				</tr>
                    				<tr>
                    					<td>
                    						Anggota Keluar
                    					</td>
                    					<td>
                    						<input type="number" name="K" value="<?php echo $K;?>" class="form-control" style="width: 40%" required>
                    					</td>
                    				</tr>
                    				<tr>
                    					<td>
                    						DROP
                    					</td>
                    					<td>
                    						<input type="number" name="drop" value="<?php echo $drop;?>" class="form-control" style="width: 40%" required>
                    					</td>
                    				</tr>
                    				<tr>
                    					<td>
                    						STORTING
                    					</td>
                    					<td>
                    						<input type="number" name="storting" value="<?php echo $storting;?>" class="form-control" style="width: 40%" required>
                    					</td>
                    				</tr>
                    				<tr>
                    					<td>
                    						PSP
                    					</td>
                    					<td>
                    						<input type="number" name="psp" value="<?php echo $psp;?>" class="form-control" style="width: 40%" required>
                    					</td>
                    				</tr>
                    				<tr>
                    					<td>
                    						Kasbon Pagi
                    					</td>
                    					<td>
                    						<input type="number" name="kasbon_pagi" value="<?php echo $kasbon_pagi;?>" class="form-control" style="width: 40%" required>
                    					</td>
                    				</tr>
                    				<tr>
                    					<td>
                    						Resort
                    					</td>
                    					<td>
                    						<select name="resort_id" class="form-control" style="width: 50%" required>
                    							<option value="">Pilih resort</option>
                    							<?php 

                    							if($LEVEL == 1){
	                    							$qresort = mysqli_query($con,"select * from tbl_resort");
                    							}else{
	                    							$qresort = mysqli_query($con,"select * from tbl_resort where unit_id = '$CABANG'");
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
                    							<?php } ?>
                    						</select>
                    					</td>
                    				</tr>
                    				<tr>
                    					<td>

                    					</td>
                    					<td>
                    						<input type="submit" name="tambah_pembukuan_harian" value="Simpan" class="btn btn-primary btn-sm" >
                    					</td>
                    				</tr>

                    			</table>

                    		</form>

                    		<?php
                    	}
                    	/* ------------------------------------------------------------------------------------------------ */
                    	if($tampil=="hapus_pembukuan_harian"){
                    		$pembukuan_id           = $_POST['pembukuan_id'];
                    		?>
                    		<table width="100%">
                    			<tr valign="top">
                    				<td align="right">
                    					<form method="POST" action="/kasir" >
                    						<input type="hidden" name="pembukuan_id" value="<?php echo $pembukuan_id;?>">
                    						<input type="submit" name="hapus_pembukuan_harian" class="btn btn-sm btn-danger" value="Yakin">
                    					</form>
                    				</td>
                    				<td>
                    					<button type="button" class="btn btn-sm btn-success" data-dismiss="modal">Batal </button>
                    				</td>
                    			</table>
                    			<?php
                    		}

                    		/* akomodasi -------------------------------------------------------------------------------------- */
                    		if($tampil=="tambah_akomodasi"){
                    			$akomodasi_id           = $_POST['akomodasi_id'];

                    			$qakomodasi             = mysqli_query($con,"select * from tbl_akomodasi where akomodasi_id='$akomodasi_id'");
                    			$data                   = mysqli_fetch_array($qakomodasi,MYSQLI_ASSOC);

                    			$uang_makan                   = $data['uang_makan'];
                    			$uang_transport               = $data['uang_transport'];
                    			$akomodasi_tgl                = $data['akomodasi_tgl'];

                    			if($akomodasi_tgl==""){
                    				$akomodasi_tgl = date("Y-m-d");
                    			}else{
                    				$akomodasi_tgl = $akomodasi_tgl;
                    			}

                    			?>
                    			<form method="POST" action="/kasir" onsubmit="return confirm('Yakin data sudah benar?')">
                    				<input type="hidden" name="akomodasi_id" value="<?php echo $akomodasi_id;?>">
                    				<table class="table">
                    					<tr>
                    						<td width="30%">
                    							Tanggal Pelaporan
                    						</td>
                    						<td>
                    							<input type="date" name="akomodasi_tgl" value="<?php echo $akomodasi_tgl;?>" class="form-control" style="width: 50%" required>
                    						</td>
                    					</tr>
                    					<tr>
                    						<td>
                    							Uang Makan
                    						</td>
                    						<td>
                    							<input type="number" name="uang_makan" value="<?php echo $uang_makan;?>" class="form-control" style="width: 40%" required>
                    						</td>
                    					</tr>
                    					<tr>
                    						<td>
                    							Uang Transport
                    						</td>
                    						<td>
                    							<input type="number" name="uang_transport" value="<?php echo $uang_transport;?>" class="form-control" style="width: 40%" required>
                    						</td>
                    					</tr>

                    					<tr>
                    						<td>

                    						</td>
                    						<td>
                    							<input type="submit" name="tambah_akomodasi" value="Simpan" class="btn btn-primary btn-sm" >
                    						</td>
                    					</tr>

                    				</table>

                    			</form>

                    			<?php
                    		}
                    		/* --------------------------------hapus akomodasi---------------------------------------------------------------- */
                    		if($tampil=="hapus_akomodasi"){
                    			$akomodasi_id           = $_POST['akomodasi_id'];
                    			?>
                    			<table width="100%">
                    				<tr valign="top">
                    					<td align="right">
                    						<form method="POST" action="/kasir" >
                    							<input type="hidden" name="akomodasi_id" value="<?php echo $akomodasi_id;?>">
                    							<input type="submit" name="hapus_akomodasi" class="btn btn-sm btn-danger" value="Yakin">
                    						</form>
                    					</td>
                    					<td>
                    						<button type="button" class="btn btn-sm btn-success" data-dismiss="modal">Batal </button>
                    					</td>
                    				</table>
                    				<?php
                    			}

                    			if($tampil=="hapus_anggota"){
                    				$anggota_id           = $_POST['anggota_id'];
                    				?>
                    				<table width="100%">
                    					<tr valign="top">
                    						<td align="right">
                    							<form method="POST" action="/anggota" >
                    								<input type="hidden" name="anggota_id" value="<?php echo $anggota_id;?>">
                    								<input type="submit" name="hapus_anggota" class="btn btn-sm btn-danger" value="Yakin">
                    							</form>
                    						</td>
                    						<td>
                    							<button type="button" class="btn btn-sm btn-success" data-dismiss="modal">Batal </button>
                    						</td>
                    					</table>
                    					<?php
                    				}



                    				/* operasional -------------------------------------------------------------------------------------- */
                    				if($tampil=="tambah_operasional"){
                    					$operasional_id           = $_POST['operasional_id'];
                    					$bu_kategori 			  = $_POST['bu_kategori'];

                    					$qoper             = mysqli_query($con,"select * from tbl_operasional where operasional_id='$operasional_id'");
                    					$data                   = mysqli_fetch_array($qoper,MYSQLI_ASSOC);

                    					$bu_id                   = $data['bu_id'];
                    					$nominal               	  = $data['nominal'];
                    					$operasional_tgl            	  = $data['operasional_tgl'];
                    					$operasional_ket               	  = $data['operasional_ket'];

                    					if($operasional_tgl==""){
                    						$operasional_tgl = date("Y-m-d");
                    					}else{
                    						$operasional_tgl = $operasional_tgl;
                    					}

                    					?>
                    					<form method="POST" action="/kasir" onsubmit="return confirm('Yakin data sudah benar?')">
                    						<input type="hidden" name="operasional_id" value="<?php echo $operasional_id;?>">
                    						<table class="table">
                    							<tr>
                    								<td width="30%">
                    									Tanggal Pelaporan
                    								</td>
                    								<td>
                    									<input type="date" name="operasional_tgl" value="<?php echo $operasional_tgl;?>" class="form-control" style="width: 50%" required>
                    								</td>
                    							</tr>
                    							<tr>
                    								<td>
                    									Biaya Umum
                    								</td>
                    								<td>
                    									<select name="bu_id" class="form-control" style="width: 50%" required>
                    										<option value="">--pilih biaya Umum--</option>
                    										<?php 
                    										$qbu = mysqli_query($con,"select bu_id,bu_nama from tbl_biayaumum where bu_kategori='$bu_kategori' ");
                    										while($data_bu    = mysqli_fetch_array($qbu,MYSQLI_ASSOC)){
                    											$bu_id_data     = $data_bu['bu_id'];
                    											if($bu_id_data==$bu_id){
                    												$pilih   = "selected";
                    											}else{
                    												$pilih   = "";
                    											}
                    											?>
                    											<option value="<?php echo $data_bu['bu_id']?>" <?php echo $pilih;?>><?php echo $data_bu['bu_nama']?></option>
                    										<?php } ?>
                    									</select>
                    								</td>
                    							</tr>
                    							<tr>
                    								<td>
                    									Nominal 
                    								</td>
                    								<td>
                    									<input type="number" name="nominal" value="<?php echo $nominal;?>" class="form-control" style="width: 40%" required>
                    								</td>
                    							</tr>
                    							<tr>
                    								<td>
                    									Keterangan
                    								</td>
                    								<td>
                    									<textarea name="operasional_ket" class="form-control" style="width: 80%" required> <?php echo $operasional_ket;?></textarea>
                    								</td>
                    							</tr>

                    							<tr>
                    								<td>

                    								</td>
                    								<td>
                    									<input type="submit" name="tambah_operasional" value="Simpan" class="btn btn-primary btn-sm" >
                    								</td>
                    							</tr>

                    						</table>

                    					</form>

                    					<?php
                    				}
                    				/* --------------------------------hapus operasional--------------------------------------------------------------- */
                    				if($tampil=="hapus_operasional"){
                    					$operasional_id           = $_POST['operasional_id'];
                    					?>
                    					<table width="100%">
                    						<tr valign="top">
                    							<td align="right">
                    								<form method="POST" action="/kasir" >
                    									<input type="hidden" name="operasional_id" value="<?php echo $operasional_id;?>">
                    									<input type="submit" name="hapus_operasional" class="btn btn-sm btn-danger" value="Yakin">
                    								</form>
                    							</td>
                    							<td>
                    								<button type="button" class="btn btn-sm btn-success" data-dismiss="modal">Batal </button>
                    							</td>
                    						</table>
                    						<?php
                    					}


                    					/* operasional -lain------------------------------------------------------------------------------------- */
                    					if($tampil=="tambah_lain"){
                    						$operasional_id           = $_POST['operasional_id'];
                    						$bu_kategori 			  = $_POST['bu_kategori'];

                    						$qoper             = mysqli_query($con,"select * from tbl_operasional where operasional_id='$operasional_id'");
                    						$data                   = mysqli_fetch_array($qoper,MYSQLI_ASSOC);

                    						$bu_id                   = $data['bu_id'];
                    						$nominal               	  = $data['nominal'];
                    						$operasional_tgl            	  = $data['operasional_tgl'];
                    						$operasional_ket               	  = $data['operasional_ket'];

                    						if($operasional_tgl==""){
                    							$operasional_tgl = date("Y-m-d");
                    						}else{
                    							$operasional_tgl = $operasional_tgl;
                    						}

                    						?>
                    						<form method="POST" action="/kasir" onsubmit="return confirm('Yakin data sudah benar?')">
                    							<input type="hidden" name="operasional_id" value="<?php echo $operasional_id;?>">
                    							<table class="table">
                    								<tr>
                    									<td width="30%">
                    										Tanggal Pelaporan
                    									</td>
                    									<td>
                    										<input type="date" name="operasional_tgl" value="<?php echo $operasional_tgl;?>" class="form-control" style="width: 50%" required>
                    									</td>
                    								</tr>
                    								<tr>
                    									<td>
                    										Biaya Umum
                    									</td>
                    									<td>
                    										<select name="bu_id" class="form-control" style="width: 50%" required>
                    											<option value="">--pilih biaya Umum--</option>
                    											<?php 
                    											$qbu = mysqli_query($con,"select bu_id,bu_nama from tbl_biayaumum where bu_kategori='$bu_kategori' ");
                    											while($data_bu    = mysqli_fetch_array($qbu,MYSQLI_ASSOC)){
                    												$bu_id_data     = $data_bu['bu_id'];
                    												if($bu_id_data==$bu_id){
                    													$pilih   = "selected";
                    												}else{
                    													$pilih   = "";
                    												}
                    												?>
                    												<option value="<?php echo $data_bu['bu_id']?>" <?php echo $pilih;?>><?php echo $data_bu['bu_nama']?></option>
                    											<?php } ?>
                    										</select>
                    									</td>
                    								</tr>
                    								<tr>
                    									<td>
                    										Nominal 
                    									</td>
                    									<td>
                    										<input type="number" name="nominal" value="<?php echo $nominal;?>" class="form-control" style="width: 40%" required>
                    									</td>
                    								</tr>
                    								<tr>
                    									<td>
                    										Keterangan
                    									</td>
                    									<td>
                    										<textarea name="operasional_ket" class="form-control" style="width: 80%" required> <?php echo $operasional_ket;?></textarea>
                    									</td>
                    								</tr>

                    								<tr>
                    									<td>

                    									</td>
                    									<td>
                    										<input type="submit" name="tambah_lain" value="Simpan" class="btn btn-primary btn-sm" >
                    									</td>
                    								</tr>

                    							</table>

                    						</form>

                    						<?php
                    					}
                    					/* --------------------------------hapus lain--------------------------------------------------------------- */
                    					if($tampil=="hapus_lain"){
                    						$operasional_id           = $_POST['operasional_id'];
                    						?>
                    						<table width="100%">
                    							<tr valign="top">
                    								<td align="right">
                    									<form method="POST" action="/kasir" >
                    										<input type="hidden" name="operasional_id" value="<?php echo $operasional_id;?>">
                    										<input type="submit" name="hapus_lain" class="btn btn-sm btn-danger" value="Yakin">
                    									</form>
                    								</td>
                    								<td>
                    									<button type="button" class="btn btn-sm btn-success" data-dismiss="modal">Batal </button>
                    								</td>
                    							</table>
                    							<?php
                    						}



                    						/* bon prive -------------------------------------------------------------------------------------- */
                    						if($tampil=="tambah_bon_prive"){
                    							$prive_id           = $_POST['prive_id'];

                    							$qprive             = mysqli_query($con,"select * from tbl_bon_prive where prive_id='$prive_id'");
                    							$data                   = mysqli_fetch_array($qprive,MYSQLI_ASSOC);

                    							$pegawai_id                   = $data['pegawai_id'];
                    							$prive_ket               	  = $data['prive_ket'];
                    							$prive_nominal            	  = $data['prive_nominal'];
                    							$prive_tgl                	  = $data['prive_tgl'];

                    							if($prive_tgl==""){
                    								$prive_tgl = date("Y-m-d");
                    							}else{
                    								$prive_tgl = $prive_tgl;
                    							}

                    							?>
                    							<form method="POST" action="/kasir" onsubmit="return confirm('Yakin data sudah benar?')">
                    								<input type="hidden" name="prive_id" value="<?php echo $prive_id;?>">
                    								<table class="table">
                    									<tr>
                    										<td width="30%">
                    											Tanggal Pelaporan
                    										</td>
                    										<td>
                    											<input type="date" name="prive_tgl" value="<?php echo $prive_tgl;?>" class="form-control" style="width: 50%" required>
                    										</td>
                    									</tr>
                    									<tr>
                    										<td>
                    											Pegawai
                    										</td>
                    										<td>
                    											<select name="pegawai_id" class="form-control" style="width: 50%" required id="pegawai_id_cek">
                    												<option value="">--pilih pegawai--</option>
                    												<?php 
                    												$qpegawai = mysqli_query($con,"select pegawai_id,pegawai_nama from tbl_pegawai where status = 'aktif'");
                    												while($data_pegawai    = mysqli_fetch_array($qpegawai,MYSQLI_ASSOC)){
                    													$pegawai_id_data     = $data_pegawai['pegawai_id'];
                    													if($pegawai_id_data==$pegawai_id){
                    														$pilih   = "selected";
                    													}else{
                    														$pilih   = "";
                    													}
                    													?>
                    													<option value="<?php echo $data_pegawai['pegawai_id']?>" <?php echo $pilih;?>><?php echo $data_pegawai['pegawai_nama']?></option>
                    												<?php } ?>
                    											</select>
                    										</td>
                    									</tr>
                    									<tr>
                    										<td>
                    											Nominal BON
                    										</td>
                    										<td>
                    											<input type="number" name="prive_nominal" id="prive_nominal" value="<?php echo $prive_nominal;?>" class="form-control" style="width: 40%" required>
                    											<div id="alert_batas_prive"></div>
                    										</td>
                    									</tr>
                    									<tr>
                    										<td>
                    											Keterangan
                    										</td>
                    										<td>
                    											<textarea name="prive_ket" class="form-control" style="width: 80%" required> <?php echo $prive_ket;?></textarea>
                    										</td>
                    									</tr>

                    									<tr>
                    										<td>

                    										</td>
                    										<td>
                    											<input type="submit" name="tambah_bon_prive" value="Simpan" id="simpan" class="btn btn-primary btn-sm" >
                    										</td>
                    									</tr>

                    								</table>

                    							</form>
                    							<script type="text/javascript">
                    								$("#pegawai_id_cek").change(function(){
				                                       // $('#modal_sedang').modal('show');
				                                       var pegawai_id_cek = $("#pegawai_id_cek").val();
				                                       $.ajax({
				                                       	type : 'post',
				                                       	url: "cek_batas_bon.php",
				                                       	data: "tampil=bon_prive&pegawai_id="+pegawai_id_cek,
				                                       	cache: false,
				                                       	success: function(msg){
				                                       		$("#alert_batas_prive").html(msg);
				                                       	}
				                                       });
				                                       $('#prive_nominal').keyup(function(e){
					                           				if(parseInt($(this).val()) > parseInt($('#batas_bon').val())){
					                           					alert('Nominal Tidak Boleh lebih dari kuota Bon');
					                           					$(this).val(0);
					                           					$('#simpan').attr('disabled',true);
					                           				}else{
					                           					$('#simpan').attr('disabled',false);
					                           				}
					                           			})
                                   });

                               </script>

                               <?php
                           }
                           /* --------------------------------hapus bon prive---------------------------------------------------------------- */
                           if($tampil=="hapus_bon_prive"){
                           	$prive_id           = $_POST['prive_id'];
                           	?>
                           	<table width="100%">
                           		<tr valign="top">
                           			<td align="right">
                           				<form method="POST" action="/kasir" >
                           					<input type="hidden" name="prive_id" value="<?php echo $prive_id;?>">
                           					<input type="submit" name="hapus_bon_prive" class="btn btn-sm btn-danger" value="Yakin">
                           				</form>
                           			</td>
                           			<td>
                           				<button type="button" class="btn btn-sm btn-success" data-dismiss="modal">Batal </button>
                           			</td>
                           		</table>
                           		<?php
                           	}

                           	/* bon panjer -------------------------------------------------------------------------------------- */
                           	if($tampil=="tambah_bon_panjer"){
                           		$panjer_id           = $_POST['panjer_id'];

                           		$qpanjer             = mysqli_query($con,"select * from tbl_bon_panjer where panjer_id='$panjer_id'");
                           		$data                   = mysqli_fetch_array($qpanjer,MYSQLI_ASSOC);

                           		$panjer_id                   = $data['panjer_id'];
                           		$panjer_ket               	  = $data['panjer_ket'];
                           		$panjer_nominal            	  = $data['panjer_nominal'];
                           		$panjer_tgl                	  = $data['panjer_tgl'];
                           		$pegawai_id                	  = $data['pegawai_id'];

                           		if($prive_tgl==""){
                           			$panjer_tgl = date("Y-m-d");
                           		}else{
                           			$panjer_tgl = $panjer_tgl;
                           		}

                           		?>
                           		<form method="POST" action="/kasir" onsubmit="return confirm('Yakin data sudah benar?')">
                           			<input type="hidden" name="panjer_id" value="<?php echo $panjer_id;?>">
                           			<table class="table">
                           				<tr>
                           					<td width="30%">
                           						Tanggal Pelaporan
                           					</td>
                           					<td>
                           						<input type="date" name="panjer_tgl" value="<?php echo $panjer_tgl;?>" class="form-control" style="width: 50%" required>
                           					</td>
                           				</tr>
                           				<tr>
                           					<td>
                           						Pegawai
                           					</td>
                           					<td>
                           						<select name="pegawai_id" class="form-control" style="width: 50%" required id="pegawai_id_cek">
                           							<option value="">--pilih pegawai--</option>
                           							<?php 
                           							$qpegawai = mysqli_query($con,"select pegawai_id,pegawai_nama from tbl_pegawai where status = 'aktif' ");
                           							while($data_pegawai    = mysqli_fetch_array($qpegawai,MYSQLI_ASSOC)){
                           								$pegawai_id_data     = $data_pegawai['pegawai_id'];
                           								if($pegawai_id_data==$pegawai_id){
                           									$pilih   = "selected";
                           								}else{
                           									$pilih   = "";
                           								}
                           								?>
                           								<option value="<?php echo $data_pegawai['pegawai_id']?>" <?php echo $pilih;?>><?php echo $data_pegawai['pegawai_nama']?></option>
                           							<?php } ?>
                           						</select>
                           					</td>
                           				</tr>
                           				<tr>
                           					<td>
                           						Nominal BON
                           					</td>
                           					<td>
                           						<input type="number" name="panjer_nominal" value="<?php echo $panjer_nominal;?>" id="panjer_nominal" class="form-control" style="width: 40%" required>
                           						<div id="alert_batas_panjer"></div>
                           					</td>
                           				</tr>
                           				<tr>
                           					<td>
                           						Keterangan
                           					</td>
                           					<td>
                           						<textarea name="panjer_ket" class="form-control" style="width: 80%" required> <?php echo $panjer_ket;?></textarea>
                           					</td>
                           				</tr>

                           				<tr>
                           					<td>

                           					</td>
                           					<td>
                           						<input type="submit" name="tambah_bon_panjer" value="Simpan" id="simpan" class="btn btn-primary btn-sm" >
                           					</td>
                           				</tr>

                           			</table>

                           		</form>

                           		<script type="text/javascript">
                           			$("#pegawai_id_cek").change(function(){
                                       // $('#modal_sedang').modal('show');
                                       var pegawai_id_cek = $("#pegawai_id_cek").val();
                                       $.ajax({
                                       	type : 'post',
                                       	url: "cek_batas_bon.php",
                                       	data: "tampil=bon_panjer&pegawai_id="+pegawai_id_cek,
                                       	cache: false,
                                       	success: function(msg){
                                       		$("#alert_batas_panjer").html(msg);
                                       	}
                                       });
                                   });

                           			$('#panjer_nominal').keyup(function(e){
                           				if(parseInt($(this).val()) > parseInt($('#batas_bon').val())){
                           					alert('Nominal Tidak Boleh lebih dari kuota Bon');
                           					$(this).val(0);
                           					$('#simpan').attr('disabled',true);
                           				}else{
                           					$('#simpan').attr('disabled',false);
                           				}	
                           			})

                               </script>

                               <?php
                           }
                           /* --------------------------------hapus bon panjer---------------------------------------------------------------- */
                           if($tampil=="hapus_bon_panjer"){
                           	$panjer_id           = $_POST['panjer_id'];
                           	?>
                           	<table width="100%">
                           		<tr valign="top">
                           			<td align="right">
                           				<form method="POST" action="/kasir" >
                           					<input type="hidden" name="panjer_id" value="<?php echo $panjer_id;?>">
                           					<input type="submit" name="hapus_bon_panjer" class="btn btn-sm btn-danger" value="Yakin">
                           				</form>
                           			</td>
                           			<td>
                           				<button type="button" class="btn btn-sm btn-success" data-dismiss="modal">Batal </button>
                           			</td>
                           		</table>
                           		<?php
                           	}
                           	/* ------------------------------------------------------------------------------------------------ */
                           	if($tampil=="pegawai_del"){
                           		$pegawai_id           = $_POST['pegawai_id'];
                           		?>

                           		<table width="100%">
                           			<tr valign="top">
                           				<td align="right">
                           					<form method="post" action="/pegawai">
                           						<input type="hidden" name="pegawai_id" value="<?php echo $pegawai_id;?>">
                           						<input type="submit" name="delete" class="btn btn-sm btn-danger" value="Yakin" >
                           					</form>
                           				</td>
                           				<td>
                           					<button type="button" class="btn btn-sm btn-success" data-dismiss="modal">Tidak                   
                           					</button>
                           				</td>
                           			</tr>

                           		</table>

                           		<?php
                           	}

                           	if($tampil=="pegawai_berhenti"){
                           		$pegawai_id           = $_POST['pegawai_id'];
                           		?>

                           		<table width="100%">
                           			<tr valign="top">
                           				<td align="right">
                           					<form method="post" action="/pegawai">
                           						<input type="hidden" name="pegawai_id" value="<?php echo $pegawai_id;?>">
                           						<input type="submit" name="berhenti" class="btn btn-sm btn-danger" value="Yakin" >
                           					</form>
                           				</td>
                           				<td>
                           					<button type="button" class="btn btn-sm btn-success" data-dismiss="modal">Tidak                   
                           					</button>
                           				</td>
                           			</tr>

                           		</table>

                           		<?php
                           	}

                           	/* ----------------------------------------------------------------------------------------------- */
                           	if($tampil=="pegawai_add"){
                           		$pegawai_id           = $_POST['pegawai_id'];

                           		$q          = mysqli_query($con,"select * from tbl_pegawai a left join tbl_user b on a.pegawai_id=b.user_name where a.pegawai_id='$pegawai_id' and status = 'aktif'");
                           		$cek        = mysqli_num_rows($q);
                           		if($cek>0){
                           			$data     = mysqli_fetch_array($q,MYSQLI_ASSOC);
                           			$pegawai_nama   = $data['pegawai_nama'];
                           			$pegawai_jk     = $data['pegawai_jk'];
                           			$pegawai_telp   = $data['pegawai_telp'];
                           			$pegawai_nik    = $data['pegawai_nik'];
                           			$jabatan_id     = $data['jabatan_id'];
                           			$user_name      = $data['user_name'];

                           		}

                           		?>
                           		<form action="/pegawai" method="POST" >
                           			<input type="hidden" name="pegawai_id" value="<?php echo $pegawai_id;?>">
                           			<table width="100%" cellpadding="5" cellspacing="5">
                           				<tr>
                           					<td>
                           						NIK
                           					</td>                          
                           					<td>
                           						<input type="text" name="pegawai_nik" class="form-control" value="<?php echo $pegawai_nik;?>">
                           					</td>
                           				</tr>
                           				<tr>
                           					<td>
                           						Nama
                           					</td>                          
                           					<td>
                           						<input type="text" name="pegawai_nama" class="form-control" value="<?php echo $pegawai_nama;?>">
                           					</td>
                           				</tr>
                           				<tr>
                           					<td>
                           						Jenis Kelamin
                           					</td>                          
                           					<td>
                           						<select class="form-control" name="pegawai_jk">
                           							<option value="L">L</option>
                           							<option value="P">P</option>
                           						</select>
                           					</td>
                           				</tr>
                           				<tr>
                           					<td>
                           						Telp
                           					</td>                          
                           					<td>
                           						<input type="number" name="pegawai_telp" class="form-control" value="<?php echo $pegawai_telp;?>">
                           					</td>
                           				</tr>
                           				<tr>
                           					<td>
                           						Jabatan
                           					</td>                          
                           					<td>
                           						<select class="form-control" name="jabatan_id">
                           							<?php
                           							$qjab           = mysqli_query($con,"select * from tbl_jabatan ");
                           							while($datajab    = mysqli_fetch_array($qjab,MYSQLI_ASSOC)){
                           								if($datajab['jabatan_id']==$jabatan_id){
                           									$pilih = "selected";
                           								}else{
                           									$pilih = "";
                           								}
                           								?>
                           								<option value="<?php echo $datajab['jabatan_id'];?>" <?php echo $pilih;?>><?php echo $datajab['jabatan_nama'];?></option>

                           								<?php
                           							}
                           							?>
                           						</select>
                           					</td>
                           				</tr>
                           				<tr>
                           					<td>
                           						Username
                           					</td>                          
                           					<td>
                           						<input type="text" name="user_name" class="form-control" readonly="readonly" value="<?php echo $pegawai_id;?>">
                           					</td>
                           				</tr>
                           				<tr>
                           					<td>
                           						Password
                           					</td>                          
                           					<td>
                           						<input type="password" name="user_pass" class="form-control" >
                           					</td>
                           				</tr>
                           				<tr>
                           					<td>
                           					</td>
                           					<td>
                           						<input type="submit" name="update" value="Simpan" class="btn btn-info btn-sm">
                           					</td>
                           				</tr>
                           			</table>
                           		</form>
                           		<?php
                           	}
                           	?>

                           	<?php 
                           	if($tampil == 'master_data_pilihan'){ 
                           		$id           = $_POST['bu_id'];
                           		$query          = mysqli_query($con,"select * from tbl_biayaumum where bu_id = '$id'");
                           		$cek        = mysqli_num_rows($query);
                           		if($cek>0){
                           			$data     = mysqli_fetch_array($query,MYSQLI_ASSOC);
                           			$bu_nama     = $data['bu_nama'];
                           			$bu_kategori     = $data['bu_kategori'];
                           		}
                           		?>
                           		<form method="POST" action="pages/master_pilihan.php" id="formMasterKategoriUpdate">
                           			<label>Kategori</label>
                           			<select class="form-control" style="width: 50%" name="bu_kategori" id="bu_kategori">
                           				<option value="0" <?= $bu_kategori == 0 ? 'selected' : '' ?> >Biaya Umum Operasional</option>
                           				<option value="1" <?= $bu_kategori == 1 ? 'selected' : '' ?> >Biaya Umum Lain-lain</option>
                           			</select>
                           			<label>Nama</label>
                           			<input type="text" class="form-control" name="bu_nama" id="bu_nama" value="<?= $bu_nama ?>" style="width: 50%">
                           			<br>
                           			<input type="hidden" name="bu_id" value="<?= $id ?>">
                           			<input type="submit" class="btn btn-sm btn-primary" name="update" value="Simpan">
                           		</form>
                           	<?php } ?>

                           	<?php 
                           	if($tampil == 'master_data_pilihan_del'){ 
                           		$id           = $_POST['bu_id'];
                           		$query          = mysqli_query($con,"select * from tbl_biayaumum where bu_id = '$id'");
                           		$cek        = mysqli_num_rows($query);
                           		if($cek>0){
                           			$data     = mysqli_fetch_array($query,MYSQLI_ASSOC);
                           			$bu_nama     = $data['bu_nama'];
                           			$bu_kategori     = $data['bu_kategori'];
                           		}
                           		?>
                           		<table width="100%">
                           			<tr valign="top">
                           				<td align="right">
                           					<form method="POST" action="/pages/master_pilihan.php" >
                           						<input type="hidden" name="bu_id" value="<?php echo $id;?>">
                           						<input type="submit" name="delete" class="btn btn-sm btn-danger" value="Yakin">
                           					</form>
                           				</td>
                           				<td>
                           					<button type="button" class="btn btn-sm btn-success" data-dismiss="modal">Batal </button>
                           				</td>
                           			</table>
                           		<?php } ?>

                           		<!-- MASTER CABANG EDIT & DELETE -->
                           		<?php 
                           		if($tampil == 'master_data_cabang'){ 
                           			$id           = $_POST['unit_id'];
                           			$query          = mysqli_query($con,"select * from tbl_unit where unit_id = '$id'");
                           			$cek        = mysqli_num_rows($query);
                           			if($cek>0){
                           				$data     = mysqli_fetch_array($query,MYSQLI_ASSOC);
                           				$unitNama     = $data['unit_nama'];
                           			}
                           			?>
                           			<form method="POST" action="pages/master_cabang.php">
                           				<label>Cabang</label>
                           				<input type="text" class="form-control" name="unit_nama" id="unit_nama" value="<?= $unitNama ?>" style="width: 50%">
                           				<br>
                           				<input type="hidden" name="unit_id" value="<?= $id ?>">
                           				<input type="submit" class="btn btn-sm btn-primary" name="update" value="Simpan">
                           			</form>
                           		<?php } ?>

                           		<?php 
                           		if($tampil == 'master_data_cabang_del'){ 
                           			$id           = $_POST['unit_id'];
                           			// $query          = mysqli_query($con,"select * from tbl_unit where unit_id = '$id'");
                           			// $cek        = mysqli_num_rows($query);
                           			// if($cek>0){
                           			// 	$data     = mysqli_fetch_array($query,MYSQLI_ASSOC);
                           			// 	$bu_nama     = $data['bu_nama'];
                           			// 	$bu_kategori     = $data['bu_kategori'];
                           			// }
                           			?>
                           			<table width="100%">
                           				<tr valign="top">
                           					<td align="right">
                           						<form method="POST" action="/pages/master_cabang.php" >
                           							<input type="hidden" name="unit_id" value="<?php echo $id;?>">
                           							<input type="submit" name="delete" class="btn btn-sm btn-danger" value="Yakin">
                           						</form>
                           					</td>
                           					<td>
                           						<button type="button" class="btn btn-sm btn-success" data-dismiss="modal">Batal </button>
                           					</td>
                           				</table>
                           			<?php } ?>

                           			<!-- TUTUPMASTERCABANG -->

                           			<!-- MASTER USER EDIT & DELETE -->
                           			<?php 
                           			if($tampil == 'master_data_user_kasir'){ 
                           				$id           = $_POST['user_id'];
                           				$query          = mysqli_query($con,"SELECT * FROM tbl_user WHERE user_id = '$id'");
                           				$queryCabang = mysqli_query($con,"SELECT * FROM tbl_unit") or die(mysqli_error($con));
                           				$cek        = mysqli_num_rows($query);
                           				if($cek>0){
                           					$data     = mysqli_fetch_array($query,MYSQLI_ASSOC);
                           				}
                           				?>
                           				<form method="POST" action="/pages/master_user_kasir.php">
                           					<label>Nama</label>
                           					<input type="text" class="form-control" name="user_nama" required value="<?= $data['user_nama'] ?>" style="width: 50%">
                           					<label>Username</label>
                           					<input type="text" class="form-control formfield" name="user_name" required value="<?= $data['user_name'] ?>" style="width: 50%">
                           					<label>Cabang</label>
                           					<select class="form-control" style="width: 50%" name="cabang" required>
                           						<?php while($dataCabang = mysqli_fetch_array($queryCabang)) : ?>
                           							<option value="<?= $dataCabang['unit_id'] ?>" <?= $data['cabang'] == $dataCabang['unit_id'] ? 'selected' : '' ?>><?= $dataCabang['unit_nama'] ?></option>
                           						<?php endwhile ?>
                           					</select>
                           					<input type="hidden" name="user_id" value="<?php echo $id;?>">
                           					<br>
                           					<input type="submit" class="btn btn-sm btn-primary" name="update" value="Simpan">
                           				</form>
                           				<script type="text/javascript">
                           					$(function(){
                           						$('.formfield').on('keypress', function(e){
                           							if(e.which == 32)
                           								return false;
                           						})
                           					})
                           				</script>
                           			<?php } ?>

                           			<?php 
                           			if($tampil == 'master_data_user_kasir_del'){ 
                           				$id           = $_POST['user_id'];
                           			// $query          = mysqli_query($con,"select * from tbl_unit where unit_id = '$id'");
                           			// $cek        = mysqli_num_rows($query);
                           			// if($cek>0){
                           			// 	$data     = mysqli_fetch_array($query,MYSQLI_ASSOC);
                           			// 	$bu_nama     = $data['bu_nama'];
                           			// 	$bu_kategori     = $data['bu_kategori'];
                           			// }
                           				?>
                           				<table width="100%">
                           					<tr valign="top">
                           						<td align="right">
                           							<form method="POST" action="/pages/master_user_kasir.php" >
                           								<input type="hidden" name="user_id" value="<?php echo $id;?>">
                           								<input type="submit" name="delete" class="btn btn-sm btn-danger" value="Yakin">
                           							</form>
                           						</td>
                           						<td>
                           							<button type="button" class="btn btn-sm btn-success" data-dismiss="modal">Batal </button>
                           						</td>
                           					</table>
                           				<?php } ?>

                           				<?php 
                           			if($tampil == 'permission_kasir'){

                           				$id           = $_POST['user_id'];
                           				$status           = $_POST['status'];
                           			// $query          = mysqli_query($con,"select * from tbl_unit where unit_id = '$id'");
                           			// $cek        = mysqli_num_rows($query);
                           			// if($cek>0){
                           			// 	$data     = mysqli_fetch_array($query,MYSQLI_ASSOC);
                           			// 	$bu_nama     = $data['bu_nama'];
                           			// 	$bu_kategori     = $data['bu_kategori'];
                           			// }
                           				?>
                           				<table width="100%">
                           					<tr valign="top">
                           						<td align="right">
                           							<form method="POST" action="/pages/master_user_kasir.php" >
                           								<input type="hidden" name="user_id" value="<?php echo $id;?>">
                           								<input type="hidden" name="status" value="<?php echo $status;?>">
                           								<input type="submit" name="permission" class="btn btn-sm btn-danger" value="Yakin">
                           							</form>
                           						</td>
                           						<td>
                           							<button type="button" class="btn btn-sm btn-success" data-dismiss="modal">Batal </button>
                           						</td>
                           					</table>
                           				<?php } ?>

                           				<!-- TUTUPMASTERUSER -->
                           			</div>
                           		</div>

                           	</div>