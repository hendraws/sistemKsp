<?php
ob_start();
session_start();
error_reporting(0);
if($_SESSION['USERNAME'] != null ){
	$USERNAME   = $_SESSION['USERNAME'];
	$USER_ID       = $_SESSION['USER_ID'];
	$NAMA       = $_SESSION['NAMA'];
	$LEVEL           = $_SESSION['LEVEL'];
	$bulan           = $_SESSION['BULAN'];

	include('lib/mpdf60/mpdf.php');
 //include   "pages/css.php";

	include "lib/koneksi.php";
	$q    = mysqli_query($con,"select * from tbl_owner");
	$data  = mysqli_fetch_array($q,MYSQLI_ASSOC);
	$nama_own   = $data['nama'];
	$alamate     = $data['alamat'];
	$gambar     = $data['gambar'];
	$mpdf  = new mPDF('utf-8',array(290,210),11,'calibri',15, 15, 5, 15, 8, 8);
	$mpdf->AddPage('P');
	?>
	<style type="text/css">
		.table-border{
			border: 1px solid;
			border-collapse: collapse;
		}
	</style>
	<br>
	<br>
	<table width="100%" cellpadding="10">
		<tr>
			<td align="center">
				<h1>LAPORAN BULANAN <br> <?php echo $nama_own;?><br>
					BULAN : <?php echo tanggal($bulan);?></h1>
					<br>
					<br>
					<br>
					<img src="<?php echo $gambar;?>" width="200">
					<br>
					<br>
					<br>
					<br>
					<br>
					<br>
					<br>
					<br>
					<br>
					<br>
					<h3>Alamat : <?php echo $alamate;?></h3>
				</td>
			</tr>
		</table>
		<?php

		?>

		<pagebreak>
			<br>
			<br>
			<table width="100%" cellpadding="10" cellspacing="10">
				<tr>
					<td colspan="2" align="center"><h3>DAFTAR ISI</h3></td>
				</tr>
				<tr>
					<td>
						I. LAPORAN KAS
					</td>
					<td align="right">
						.................................................................................... 
					</td>
				</tr>
				<tr>
					<td>
						II. DAFTAR GAJI
					</td>
					<td align="right">
						.................................................................................... 
					</td>
				</tr>
				<tr>
					<td>
						III. LAPORAN BIAYA UMUM
					</td>
					<td align="right">
						.................................................................................... 
					</td>
				</tr>
				<tr>
					<td>
						IV. DAFTAR INVENTARIS KENDARAAN
					</td>
					<td align="right">
						.................................................................................... 
					</td>
				</tr>
				<tr>
					<td>
						V. REKAPITULASI
					</td>
					<td align="right">
						.................................................................................... 
					</td>
				</tr>
				<tr>
					<td>
						VI. LAPORAN SIMPANAN
					</td>
					<td align="right">
						.................................................................................... 
					</td>
				</tr>
				<tr>
					<td>
						VII. LAPORAN PINJAMAN
					</td>
					<td align="right">
						.................................................................................... 
					</td>
				</tr>
				<tr>
					<td>
						VIII. LAPORAN KEMACETAN
					</td>
					<td align="right">
						.................................................................................... 
					</td>
				</tr>
				<tr>
					<td>
						IX. PERKEMBANGAN
					</td>
					<td align="right">
						.................................................................................... 
					</td>
				</tr>
				<tr>
					<td>
						X. RANGKUMAN PIMPINAN
					</td>
					<td align="right">
						.................................................................................... 
					</td>
				</tr>

			</table>
			<pagebreak>
				<br>
				<br>
				<table width="100%" cellpadding="20">
					<tr >
						<td colspan="2" >
							<h3>I. LAPORAN KAS</h3>
						</td>
					</tr>
					<tr valign="top">
						<td width="50%" valign="top">
							<?php
							$qrek = mysqli_query($con,"select sum(tunai) as tunai, sum(kasbon_pakai) as kasbon_pakai from tbl_rekapitulasi where bulan='$bulan'");
							$hrek=mysqli_fetch_array($qrek);

							$tunai_kas = $hrek['tunai'];
							$kasbon_pakai = $hrek['kasbon_pakai'];
							?>

							<h4>Pemasukan</h4><br>
							<table class="table" width="100%" cellpadding="10">
								<tr class=" bg-gray-dark" bgcolor="gray">
									<td>No</td>
									<td>Perkiraan</td>
									<td align="right">Rincian</td>
								</tr>
								<tr class="">
									<td>1</td>
									<td>Kas Awal</td>
									<td align="right">
										<?php
										$qkas=mysqli_query($con,"select kas_nominal from tbl_kas_awal where kas_bulan like '$bulan%'");
										$dkas=mysqli_fetch_array($qkas);
										$kas_awal = $dkas['kas_nominal'];

										echo str_replace(",", ".", number_format($kas_awal));
										?>
									</td>
								</tr>
								<tr class="" bgcolor="#F5F5F5">
									<td>2</td>
									<td>Tunai Kas</td>
									<td align="right">
										<?php

                            //  $tunai_kas = array_sum($tunai_arr);

										echo str_replace(",", ".", number_format($tunai_kas));
										?>
									</td>
								</tr>
								<?php
								$qgajie = mysqli_query($con,"SELECT sum(gaji_panjer) as panjer,sum(gaji_prive) as prive from tbl_gaji a join tbl_pegawai b on a.pegawai_id=b.pegawai_id WHERE gaji_bulan='$bulan'");
								$hgaji=mysqli_fetch_array($qgajie);
								?>
								<tr class="" bgcolor="">
									<td>3</td>
									<td>Pengembalian BON Tunda</td>
									<td align="right">
										<?php

										$pengembalian_tunda = $hgaji['panjer'];
										$pengembalian_prive = $hgaji['prive'];

										echo str_replace(",", ".", number_format($pengembalian_tunda));
										?>
									</td>
								</tr>
								<tr class="" bgcolor="#F5F5F5">
									<td>4</td>
									<td>Pengembalian BON Prive</td>
									<td align="right">
										<?php



										echo str_replace(",", ".", number_format($pengembalian_prive));
										?>
									</td>
								</tr>
								<tr class="" bgcolor="#F5F5F5">
									<td>5</td>
									<td>Saldo BON</td>
									<td align="right">
										<?php 

										$pengembalian_bon = $pengembalian_tunda+$pengembalian_prive;
										$qprive =mysqli_query($con,"select sum(prive_nominal) as prive_nominal from tbl_bon_prive a  where a.prive_tgl like '$bulan%'");
										$hprive = mysqli_fetch_array($qprive);

										$qpanjer =mysqli_query($con,"select sum(panjer_nominal) as panjer_nominal from tbl_bon_panjer a  where a.panjer_tgl like '$bulan%'");
										$hpanjer = mysqli_fetch_array($qpanjer);

										$bon = $hprive['prive_nominal']+$hpanjer['panjer_nominal'];
                // echo str_replace(",", ".", number_format($bon));
                // echo str_replace(",", ".", number_format($pengembalian_bon));
										echo str_replace(",", ".", number_format($bon-$pengembalian_bon));

										?>
									</td>
								</tr>
								<tr class="" bgcolor="#F5F5F5">
									<td>6</td>
									<td>Kas Masuk</td>
									<td align="right">
										<?php 

										$qKasMasuk =mysqli_query($con,"select sum(nominal) as kas_masuk from tbl_kas_masuk  where tanggal like '$bulan%'");
										$hKasMasuk = mysqli_fetch_array($qKasMasuk);
										$dataKasMasuk = $hKasMasuk['kas_masuk'];
                // echo str_replace(",", ".", number_format($bon));
                // echo str_replace(",", ".", number_format($pengembalian_bon));
										echo str_replace(",", ".", number_format($dataKasMasuk));

										?>
									</td>
								</tr>

								<?php
								$n=7;
								unset($pemasukan_nominal_arr);
								$qpemasukan = mysqli_query($con,"select pemasukan,nominal from tbl_pemasukan where bulan='$bulan'");
								while($hpemasukan= mysqli_fetch_array($qpemasukan)){
									$pemasukan  = $hpemasukan['pemasukan'];
									$pemasukan_nominal = $hpemasukan['nominal'];
									$pemasukan_nominal_arr[]=$pemasukan_nominal;
									if($n%2==0){
										$warna = "#F5F5F5";
									}else{
										$warna = "";
									}
									?>
									<tr class="" bgcolor="<?php echo $warna;?>">
										<td><?php echo $n;?></td>
										<td><?php echo $pemasukan;?></td>
										<td align="right">
											<?php

											echo str_replace(",", ".", number_format($pemasukan_nominal));
											?>
										</td>
									</tr>
									<?php
									$n++;
								}
								?>

								<tr class="bg-gray-dark" bgcolor="gray">
									<td colspan="2">TOTAL PEMASUKAN</td>

									<td align="right">
										<?php
										$total_pemasukan = $kas_awal+$tunai_kas+$pengembalian_tunda+$pengembalian_prive+($bon-$pengembalian_bon)+array_sum($pemasukan_nominal_arr)+$dataKasMasuk;
										echo str_replace(",", ".", number_format($total_pemasukan));
										?>
									</td>
								</tr>
							</table>
						</td>
						<td valign="top">
							<h4>Pengeluaran</h4><br>
							<table class="table" width="100%" cellpadding="10">
								<tr class=" bg-gray-dark" bgcolor="gray">
									<td>No</td>
									<td>Perkiraan</td>
									<td align="right">Rincian</td>
								</tr>
								<tr class="">
									<td>1</td>
									<td>Kasbon Pakai</td>
									<td align="right">
										<?php

                             // $kasbon_pakai_rekap = array_sum($kasbon_pakai_arr);

										echo str_replace(",", ".", number_format($kasbon_pakai));
										?>
									</td>
								</tr>
								<tr class="" bgcolor="#F5F5F5">
									<td>2</td>
									<td>Gaji Karyawan</td>
									<td align="right">
										<?php
										$qgaji = mysqli_query($con,"SELECT sum(gaji_diterima) as gaji from tbl_gaji a join tbl_pegawai b on a.pegawai_id=b.pegawai_id WHERE gaji_bulan='$bulan'");
										$hgaji=mysqli_fetch_array($qgaji);

										$gaji_karyawan = $hgaji['gaji'];

										echo str_replace(",", ".", number_format($gaji_karyawan));
										?>
									</td>
								</tr>
								<tr class="">
									<td>3</td>
									<td>Biaya Umum </td>
									<td align="right">
										<?php
										$qgaji1 = mysqli_query($con,"select sum(a.nominal) as operasional from tbl_operasional a left join tbl_biayaumum b on a.bu_id=b.bu_id where a.operasional_tgl like  '$bulan%' and b.bu_kategori='0' order by a.operasional_tgl asc");
										$hgaji1=mysqli_fetch_array($qgaji1);
										$operasional = $hgaji1['operasional'];

										$qgaji11 = mysqli_query($con,"  select a.*,b.bu_nama from tbl_operasional a left join tbl_biayaumum b on a.bu_id=b.bu_id where a.operasional_tgl like  '$bulan%' and b.bu_kategori='1' order by a.operasional_tgl asc");
										while($hgaji11=mysqli_fetch_array($qgaji11)){
											$lain_lain_arr[] =$hgaji11['nominal'];
										}
										$lain_lain = array_sum($lain_lain_arr);

										$qgaji2 = mysqli_query($con,"SELECT sum(uang_makan+uang_transport) as akomodasi from tbl_akomodasi where akomodasi_tgl like '$bulan%'");
										$hgaji2=mysqli_fetch_array($qgaji2);

										$akomodasi = $hgaji2['akomodasi'];

										echo str_replace(",", ".", number_format($operasional + $lain_lain + $akomodasi));
										?>
									</td>
								</tr>
								<tr class="">
									<td>4</td>
									<td>BON</td>
									<td align="right">
										<?php
										$qgaji21 = mysqli_query($con,"SELECT SUM(panjer_nominal) as bon_panjer from tbl_bon_panjer where panjer_tgl like '$bulan%'");
										$hgaji21=mysqli_fetch_array($qgaji21);

										$bon_panjere = $hgaji21['bon_panjer'];

										$qgaji22 = mysqli_query($con,"SELECT SUM(prive_nominal) as bon_prive from tbl_bon_prive where prive_tgl like '$bulan%'");
										$hgaji22=mysqli_fetch_array($qgaji22);

										$bon_privee = $hgaji22['bon_prive'];

										echo str_replace(",", ".", number_format($bon_panjere+$bon_privee));
										?>
									</td>
								</tr>
								<?php
								$n=5;
								unset($pengeluaran_nominal_arr);
								$qpengeluaran = mysqli_query($con,"select pengeluaran,nominal from tbl_pengeluaran where bulan='$bulan'");
								while($hpengeluaran= mysqli_fetch_array($qpengeluaran)){
									$pengeluaran  = $hpengeluaran['pengeluaran'];
									$pengeluaran_nominal = $hpengeluaran['nominal'];
									$pengeluaran_nominal_arr[]=$pengeluaran_nominal;
									if($n%2==0){
										$warna = "#F5F5F5";
									}else{
										$warna = "";
									}
									?>
									<tr class="" bgcolor="<?php echo $warna;?>">
										<td><?php echo $n;?></td>
										<td><?php echo $pengeluaran;?></td>
										<td align="right">
											<?php

											echo str_replace(",", ".", number_format($pengeluaran_nominal));
											?>
										</td>
									</tr>
									<?php
									$n++;
								}
								?>

								<tr class="bg-gray-dark" bgcolor="gray">
									<td colspan="2">TOTAL PENGELUARAN</td>

									<td align="right">
										<?php
										$total_pengeluaran = $kasbon_pakai+$gaji_karyawan+$operasional+$akomodasi+$bon_privee+$bon_panjere+array_sum($pengeluaran_nominal_arr)+$lain_lain;
										echo str_replace(",", ".", number_format($total_pengeluaran));
										?>
									</td>
								</tr>
							</table>

							<?php 


							$q5       = mysqli_query($con,"select total from tbl_expedisi where bulan='$bulan' ORDER BY tgl desc LIMIT 1 ");
							$h5   = mysqli_fetch_array($q5,MYSQLI_ASSOC);
							$total_kas_expedisi = $h5['total'];


                        //$kembali_kasbon = $kasbon_pagi_total-$kasbon_pakai;
                       // $biaya_lain = array_sum($nominal_lain_arr);
                      //  $bone=$bon_panjere+$bon_privee;
                       // echo "($kas_awal-$kasbon_pagi_total-$akomodasi-$operasional-$bone-$biaya_lain)+$kembali_kasbon+$tunai_kas = ";
                       // $total_kas_expedisi=($kas_awal-$kasbon_pagi_total-$akomodasi-$operasional-$bone-$biaya_lain)+$kembali_kasbon+$tunai_kas;
                      //  echo $total_kas_expedisi;



							?>
						</td>
					</tr>
					<tr bgcolor="gray">
						<td colspan="2">
							<h3>KAS AKHIR : <?php echo str_replace(",", ".", number_format($total_pemasukan-$total_pengeluaran));?></h3>
						</td>
					</tr>

				</table>
				<pagebreak>
					<br>
					<h3>II. DAFTAR GAJI</h3>
					<table cellpadding="5" width="100%" border="0">
						<tr height="19" bgcolor="gray">
							<td rowspan="2" height="38" width="32">
								No
							</td>
							<td rowspan="2" width="96">
								Nama
							</td>
							<td rowspan="2" width="58">
								Jabatan
							</td>

							<td width="84" rowspan="2">
								Gaji Pokok
							</td>
							<td colspan="4" width="350" align="center">
								Tunjangan Tetap
							</td>
							<td width="90" rowspan="2"> 
								Jumlah Gaji
							</td>
							<td colspan="4" width="227" align="center">
								Potongan
							</td>
							<td width="87" rowspan="2">
								Jumlah Potongan
							</td>
							<td rowspan="2" width="64">
								Gaji Diterima
							</td>
						</tr>
						<tr height="19" bgcolor="gray">

							<td align="center">
								Jabatan
							</td>
							<td align="center">
								Masa kerja
							</td>
							<td align="center">
								Pendidikan
							</td>
							<td align="center">
								Kompetensi
							</td>

							<td align="center">
								BON Tunda
							</td>
							<td align="center">
								BON Prive
							</td>
							<td align="center">
								Tab.
							</td>
							<td align="center">
								Lain.
							</td>

						</tr>

						<?php 
						$no=1;
						$q    = mysqli_query($con,"select a.pegawai_id,a.pegawai_nik,a.pegawai_nama,b.jabatan_nama,a.jabatan_id,a.pegawai_jk from tbl_pegawai a join tbl_jabatan b on a.jabatan_id=b.jabatan_id where a.pegawai_id!='admin' and a.jabatan_id!='14' order by b.urutan asc");
						$total_pegawai  = mysqli_num_rows($q);

						while($h    = mysqli_fetch_array($q,MYSQLI_ASSOC)){
							$pegawai_id     = $h['pegawai_id'];
							$pegawai_jk     = $h['pegawai_jk'];
							$jabatan_id     = $h['jabatan_id'];
							if($jabatan_id=="1"){
								$JUMLAH_PIMPINAN_ARR[]=1;
								$TTD_PIMPINAN = $h['pegawai_nama'];
							}
							if($jabatan_id=="7"){

								$TTD_KASIR = $h['pegawai_nama'];
							}

							if($jabatan_id=="3" or $jabatan_id=="5"){
								$JUMLAH_STAFF_ARR[] = 1;
							}if($pegawai_jk=="L"){
								$JUMLAH_KARYAWAN_ARR[]=1;
							}if($pegawai_jk=="P"){
								$JUMLAH_KARYAWATI_ARR[]=1;
							}
							$JUMLAH_KARYAWAN_ALL_ARR[]=1;


							if($no%2==0){
								$warna = "#F5F5F5";
							}else{
								$warna = "";
							}
							?>
							<?php 
                          //echo "select * from tbl_gaji where pegawai_id='$pegawai_id' and gaji_bulan='$bulan'";
							$qgaji = mysqli_query($con,"select * from tbl_gaji where pegawai_id='$pegawai_id' and gaji_bulan='$bulan'");
							$datagaji=mysqli_fetch_array($qgaji);
							$gaji_pokok = $datagaji['gaji_pokok'];
							$gaji_potongan = $datagaji['gaji_potongan'];
							$gaji_tunjangan = $datagaji['gaji_tunjangan'];
							$gaji_diterima  = $datagaji['gaji_diterima'];
							$gaji_jabatan       = $datagaji['gaji_jabatan'];
							$gaji_masa_kerja    = $datagaji['gaji_masa_kerja'];
							$gaji_pendidikan    = $datagaji['gaji_pendidikan'];
							$gaji_kompetensi    = $datagaji['gaji_kompetensi'];
							$gaji_prive          = $datagaji['gaji_prive'];
							$gaji_panjer         = $datagaji['gaji_panjer'];
							$gaji_lain          = $datagaji['gaji_lain'];
							$gaji_tabungan          = $datagaji['gaji_tabungan'];
							$gaji_pokok_arr[]   = $gaji_pokok;
							$gaji_jabatan_arr[] = $gaji_jabatan;
							$gaji_masa_kerja_arr[]  = $gaji_masa_kerja;
							$gaji_pendidikan_arr[]  = $gaji_pendidikan;
							$gaji_kompetensi_arr[]  = $gaji_kompetensi;
							$gaji_total_arr[] = $gaji_tunjangan+$gaji_pokok;
							$gaji_panjer_arr[]  = $gaji_panjer;
							$gaji_prive_arr[]   = $gaji_prive;
							$gaji_lain_arr[]  = $gaji_lain;
							$gaji_potongan_arr[]  = $gaji_potongan;
							$gaji_diterima_arr[]  = $gaji_diterima;
							$gaji_tabungan_arr[] = $gaji_tabungan;
							?>
							<tr class="small" bgcolor="<?php echo $warna;?>">
								<td><?php echo $no;?></td>

								<td width="170"><?php echo $h['pegawai_nama'];?></td>
								<td><?php echo $h['jabatan_nama'];?></td>

								<td align="right"><?php echo str_replace(",", ".", number_format($gaji_pokok));?></td>
								<td align="right"><?php echo str_replace(",", ".", number_format($gaji_jabatan));?></td>
								<td align="right"><?php echo str_replace(",", ".", number_format($gaji_masa_kerja));?></td>
								<td align="right"><?php echo str_replace(",", ".", number_format($gaji_pendidikan));?></td>
								<td align="right"><?php echo str_replace(",", ".", number_format($gaji_kompetensi));?></td>
								<td align="right"><?php echo str_replace(",", ".", number_format($gaji_tunjangan+$gaji_pokok));?></td>
								<td align="right"><?php echo str_replace(",", ".", number_format($gaji_panjer));?></td>
								<td align="right"><?php echo str_replace(",", ".", number_format($gaji_prive));?></td>
								<td align="right"><?php echo str_replace(",", ".", number_format($gaji_tabungan));?></td>
								<td align="right"><?php echo str_replace(",", ".", number_format($gaji_lain));?></td>
								<td align="right"><?php echo str_replace(",", ".", number_format($gaji_potongan));?></td>
								<td align="right"><?php echo str_replace(",", ".", number_format($gaji_diterima));?></td>


							</tr>

							<?php 
							$no++;
						} ?>
						<tr class="small" bgcolor="gray">
							<td colspan="3"><strong>Total</strong></td>

							<td align="right"><?php echo str_replace(",", ".", number_format(array_sum($gaji_pokok_arr)));?></td>
							<td align="right"><?php echo str_replace(",", ".", number_format(array_sum($gaji_jabatan_arr)));?></td>
							<td align="right"><?php echo str_replace(",", ".", number_format(array_sum($gaji_masa_kerja_arr)));?></td>
							<td align="right"><?php echo str_replace(",", ".", number_format(array_sum($gaji_pendidikan_arr)));?></td>
							<td align="right"><?php echo str_replace(",", ".", number_format(array_sum($gaji_kompetensi_arr)));?></td>
							<td align="right"><?php echo str_replace(",", ".", number_format(array_sum($gaji_total_arr)));?></td>
							<td align="right"><?php echo str_replace(",", ".", number_format(array_sum($gaji_panjer_arr)));?></td>
							<td align="right"><?php echo str_replace(",", ".", number_format(array_sum($gaji_prive_arr)));?></td>
							<td align="right"><?php echo str_replace(",", ".", number_format(array_sum($gaji_tabungan_arr)));?></td>
							<td align="right"><?php echo str_replace(",", ".", number_format(array_sum($gaji_lain_arr)));?></td>
							<td align="right"><?php echo str_replace(",", ".", number_format(array_sum($gaji_potongan_arr)));?></td>
							<td align="right"><?php echo str_replace(",", ".", number_format(array_sum($gaji_diterima_arr)));?></td>


						</tr>


					</table>
					<pagebreak>
						<br>
						<h3>III. LAPORAN BIAYA UMUM</h3>
						<table width="60%" cellpadding="7">
							<tr bgcolor="gray">
								<td width="20">No
								</td>
								<td>Keterangan</td>
								<td>No. Kwitansi</td>

								<td align="right">Saldo</td>
							</tr>
							<?php
							$no=1;
							$q=mysqli_query($con,"select bu_id,bu_nama from tbl_biayaumum");
							while($h=mysqli_fetch_array($q)){
								$bu_id = $h['bu_id'];

								$qcari=mysqli_query($con,"select operasional_tgl from tbl_operasional where bu_id='$bu_id' and operasional_tgl like '$bulan%' group by operasional_tgl order by operasional_tgl asc ");
								unset($tgl_trans_arr);

								while($cari = mysqli_fetch_array($qcari)){

									$tgl_trans_arr[]  = substr($cari['operasional_tgl'],8,2);

								}
								$qcari1= mysqli_query($con,"select sum(nominal) as nominal from tbl_operasional where bu_id='$bu_id' and operasional_tgl like '$bulan%'");
								$cari1 = mysqli_fetch_array($qcari1); 
								$nominal = $cari1['nominal'];
								$nominal_arr[] = $nominal;
								if($no%2==0){
									$warna = "#F5F5F5";
								}else{
									$warna = "";
								}
								?>
								<tr class="" bgcolor="<?php echo $warna;?>">
									<td><?php echo $no;?></td>
									<td><?php echo $h['bu_nama'];?></td>
									<td><?php
									$jume=count($tgl_trans_arr);
									for($i=0;$i<$jume;$i++){
										echo $tgl_trans_arr[$i].",";
									}
									?></td>
									<td align="right" width="200"><?php echo str_replace(",", ".", number_format($nominal));?></td>
								</tr>
								<?php
								$no++;
							}
							?>
							<tr class="" bgcolor="<?php echo $warna;?>">
								<td><?php echo $no;?></td>
								<td>Akomodasi</td>
								<td></td>
								<td align="right" width="200">
									<?php 
									$qAkomodasi = mysqli_query($con,"SELECT sum(uang_makan+uang_transport) as akomodasi from tbl_akomodasi where akomodasi_tgl like '$bulan%'");
									$hAkomodasi=mysqli_fetch_array($qAkomodasi);

									$biayaAkomodasi = $hAkomodasi['akomodasi'];

									echo str_replace(",", ".", number_format($biayaAkomodasi));

									?>
								</td>
							</tr>
							<tr bgcolor="gray">
								<td colspan="3"><strong>Total</strong></td>
								<td align="right"><?php 
								$TOTAL_BIAYA_UMUM = array_sum($nominal_arr);
								echo str_replace(",", ".", number_format(array_sum($nominal_arr) + $biayaAkomodasi));?></td>
							</tr>
						</table>
						<pagebreak>
							<br>
							<h3>IV. DAFTAR INVENTARIS KENDARAAN</h3>
							<table width="100%" cellpadding="7">
								<tr bgcolor="gray">
									<td width="20">No
									</td>
									<td>Jenis Kendaraan</td>    
									<td align="center">Nomor Polisi</td>
									<td align="center">Atas Nama STNK</td>
									<td align="center">Jatuh Tempo</td>
									<td align="center">Jabatan</td>
									<td align="center">Transport</td>

									<td align="center">Pemegang</td>
								</tr>
								<?php
								$no=1;
								$q    = mysqli_query($con,"select a.*,b.pegawai_nama,c.jabatan_nama from tbl_inventaris a left join tbl_pegawai b on a.pegawai_id=b.pegawai_id left join tbl_jabatan c on b.jabatan_id=c.jabatan_id where b.pegawai_id !='admin' order by b.jabatan_id asc");
								while($h    = mysqli_fetch_array($q,MYSQLI_ASSOC)){
									$inven_id     = $h['inven_id'];
									if($no%2==0){
										$warna = "#F5F5F5";
									}else{
										$warna = "";
									}
									?>
									<tr class="" bgcolor="<?php echo $warna;?>">
										<td align="center"><?php echo $no;?></td>
										<td><?php echo $h['inven_nama'];?></td>
										<td align="center"><?php echo $h['inven_nopol'];?></td>
										<td align="center"><?php echo $h['inven_stnk'];?></td>
										<td align="center"><?php echo tanggal($h['inven_tempo']);?></td>
										<td align="center"><?php echo $h['jabatan_nama'];?></td>
										<td align="center"><?php echo $h['inven_transport'];?></td>
										<td align="center"><?php echo $h['pegawai_nama'];?></td>  
									</tr>
									<?php
									$no++;
								}
								?>

							</table>
							<pagebreak>
								<br>
								<h3>V. REKAPITULASI</h3>
								<table cellpadding="7" style="width:100%">

									<thead>
										<tr bgcolor="gray">
											<td rowspan="2">RESORT</td>
											<td colspan="4" >
												ANGGOTA
											</td>
											<td rowspan="2" >
												KASBON PAKAI
											</td>
											<td rowspan="2" >
												STORTING
											</td>
											<td colspan="2" >
												POTONGAN
											</td>
											<td rowspan="2" >
												DEBET
											</td>
											<td rowspan="2" >
												DROP
											</td>
											<td rowspan="2" >
												PSP
											</td>
											<td rowspan="2" >
												KREDIT
											</td>
											<td rowspan="2" >
												TUNAI
											</td>
										</tr>
										<tr bgcolor="gray">

											<td >
												L
											</td>
											<td>
												B
											</td>
											<td>
												Klr
											</td>
											<td>Kini</td>
											<td>
												Adm 5%
											</td>
											<td>
												Simp 4%
											</td>
										</tr>
									</thead>
									<tbody>
										<?php 
										$no=1;
										unset($drop_arr);
										unset($storting_arr);
										unset($psp_arr);
										unset($kasbon_pagi_arr);
										unset($kasbon_pakai_arr);
										unset($adm5persen_arr);
										unset($simp4persen_arr);
										unset($debet_arr);
										unset($kredit_arr);
										unset($tunai_arr);


										$q1       = mysqli_query($con,"select resort_id,resort_nama from tbl_resort ");
										while($h1   = mysqli_fetch_array($q1,MYSQLI_ASSOC)){
											$resort_id = $h1['resort_id'];
											$resort_nama = $h1['resort_nama'];
											unset($drop1_arr);
											unset($drop2_arr);
											unset($drop3_arr);
											unset($storting1_arr);
											unset($storting2_arr);
											unset($storting3_arr);
											unset($psp1_arr);
											unset($psp2_arr);
											unset($psp3_arr);
											unset($kasbon_pagi1_arr);
											unset($kasbon_pagi2_arr);
											unset($kasbon_pagi3_arr);
											unset($drop_arr);
											unset($storting_arr);
											unset($psp_arr);
											unset($kasbon_pagi_arr);

											unset($drop1_arr_lalu);
											unset($drop2_arr_lalu);
											unset($drop3_arr_lalu);
											unset($storting1_arr_lalu);
											unset($storting2_arr_lalu);
											unset($storting3_arr_lalu);
											unset($psp1_arr_lalu);
											unset($psp2_arr_lalu);
											unset($psp3_arr_lalu);
											unset($kasbon_pagi1_arr_lalu);
											unset($kasbon_pagi2_arr_lalu);
											unset($kasbon_pagi3_arr_lalu);
											unset($drop_arr_lalu);
											unset($storting_arr_lalu);
											unset($psp_arr_lalu);
											unset($kasbon_pagi_arr_lalu);
											unset($saldo_simpanan1_lalu);
											unset($saldo_simpanan2_lalu);
											unset($saldo_simpanan3_lalu);
											unset($saldo_pinjaman1_lalu);
											unset($saldo_pinjaman2_lalu);
											unset($saldo_pinjaman3_lalu);
											unset($jum_anggota_lama1);
											unset($jum_anggota_baru1);
											unset($jum_anggota_keluar1);
											unset($jum_anggota_lama2);
											unset($jum_anggota_baru2);
											unset($jum_anggota_keluar2);
											unset($jum_anggota_lama3);
											unset($jum_anggota_baru3);
											unset($jum_anggota_keluar3);
											unset($jum_anggota_kini1);
											unset($jum_anggota_kini2);
											unset($jum_anggota_kini3);

											unset($adm5persen1_arr);
											unset($simp4persen1_arr);
											unset($kredit1_arr);
											unset($tunai1_arr);
											unset($kasbon_pakai1_arr);
											unset($debet1_arr);

											unset($adm5persen2_arr);
											unset($simp4persen2_arr);
											unset($kredit2_arr);
											unset($tunai2_arr);
											unset($kasbon_pakai2_arr);
											unset($debet2_arr);

											unset($adm5persen3_arr);
											unset($simp4persen3_arr);
											unset($kredit3_arr);
											unset($tunai3_arr);
											unset($kasbon_pakai3_arr);
											unset($debet3_arr);
											$no=1;
											$q=mysqli_query($con,"select * from tbl_rekapitulasi where resort_id='$resort_id' and bulan='$bulan' ");
											while($h=mysqli_fetch_array($q)){
												$pembukuan_tgl   = $h['tgl'];
												$minggu 		 = $h['minggu'];

                            // $resort_idku            = $h1['resort_id'];    
                            //$bulan_iniku     = substr($pembukuan_tgl_loop, 0,7)."-01";

                          //$jum_anggota_kini[]     = ($jum_anggota_lama+$jum_anggota_baru)-$jum_anggota_keluar;
												$tgl_to_day = strtotime($pembukuan_tgl);
												$day = date('D', $tgl_to_day);

												echo $day.$pembukuan_tgl; 
												$drop_arr[]  = $h['drop'];
												$storting_arr[] = $h['storting'];
												$psp_arr[]     = $h['psp'];
												$kasbon_pagi_arr[] = $h['kasbon_pagi'];
												$anggota_l_arr[]  = $h['L'];
												$anggota_b_arr[]  = $h['B'];
												$anggota_k_arr[]  = $h['K'];
												$anggota_kini_arr[] = $h['kini'];

												$drop  = $h['drop'];
												$storting = $h['storting'];
												$psp     = $h['psp'];
												$kasbon_pagi = $h['kasbon_pagi'];


												if($minggu=="1"){
                              //senn kamis
                              //echo "senin-kamis";
													$drop1_arr[]  = $h['drop'];
													$storting1_arr[] = $h['storting'];
													$psp1_arr[]     = $h['psp'];
													$kasbon_pagi1_arr[] = $h['kasbon_pagi'];
                              // $jum_anggota_lama1 = mysqli_num_rows(mysqli_query($con,"select anggota_id from tbl_anggota where resort_id='$resort_id' and tgl_daftar < '$pembukuan_tgl'"));
                              //$jum_anggota_baru1 = mysqli_num_rows(mysqli_query($con,"select anggota_id from tbl_anggota where resort_id='$resort_id' and tgl_daftar = '$pembukuan_tgl'"));
                              //$jum_anggota_keluar1 = mysqli_num_rows(mysqli_query($con,"select anggota_id from tbl_anggota where resort_id='$resort_id' and tgl_keluar = '$pembukuan_tgl'"));
													$jum_anggota_lama1[]    = $h['L'];
													$jum_anggota_baru1[]    = $h['B'];
													$jum_anggota_keluar1[]  = $h['K'];
													$jum_anggota_kini1[]     = $h['kini'];

                              //////////////////////////////////////////////////////////
													$adm5persen1_arr[]           = $h['adm'];
													$simp4persen1_arr[]          = $h['simp'];
                         // $simp4persen1_lalu     = $drop1_lalu*0.04;

													$kredit1_arr[]               = $h['kredit'];
													$debet_tanpa_kasbon1   = $storting1+$adm5persen1+$simp4persen1;
													$tunai1_arr[]                = $h['tunai'];
                          /*
                          if($tunai1<0){
                            $tunai1              = 0;
                          }else{
                            $tunai1              = $tunai1;
                          }
                          */
                          $kasbon_pakai1_arr[]         = $h['kasbon_pakai'];
                          /*
                          if($kasbon_pakai1<0){
                            $kasbon_pakai1              = 0;
                          }else{
                            $kasbon_pakai1              = $kasbon_pakai1;
                          }
                          */
                          $debet1_arr[]                       = $h['debet'];


                      }
                      if($minggu=="2"){
                              //selasa - jum'at
                      	$drop2_arr[]  = $h['drop'];
                      	$storting2_arr[] = $h['storting'];
                      	$psp2_arr[]     = $h['psp'];
                      	$kasbon_pagi2_arr[] = $h['kasbon_pagi'];
                              // $jum_anggota_lama2 = mysqli_num_rows(mysqli_query($con,"select anggota_id from tbl_anggota where resort_id='$resort_id' and tgl_daftar < '$pembukuan_tgl'"));
                              //$jum_anggota_baru2 = mysqli_num_rows(mysqli_query($con,"select anggota_id from tbl_anggota where resort_id='$resort_id' and tgl_daftar = '$pembukuan_tgl'"));
                              //$jum_anggota_keluar2 = mysqli_num_rows(mysqli_query($con,"select anggota_id from tbl_anggota where resort_id='$resort_id' and tgl_keluar = '$pembukuan_tgl'"));
                      	$jum_anggota_lama2[]    = $h['L'];
                      	$jum_anggota_baru2[]    = $h['B'];
                      	$jum_anggota_keluar2[]  = $h['K'];
                      	$jum_anggota_kini2[]     = $h['kini'];

                               //////////////////////////////////////////////////////////
                      	$adm5persen2_arr[]           = $h['adm'];
                      	$simp4persen2_arr[]          = $h['simp'];
                         // $simp4persen2_lalu     = $drop2_lalu*0.04;

                      	$kredit2_arr[]               = $h['kredit'];
                      	$debet_tanpa_kasbon2   = $storting2+$adm5persen2+$simp4persen2;
                      	$tunai2_arr[]                = $h['tunai'];
                          /*
                          if($tunai2<0){
                            $tunai2              = 0;
                          }else{
                            $tunai2              = $tunai2;
                          } 
                          */
                          $kasbon_pakai2_arr[]         = $h['kasbon_pakai'];
                          /*
                          if($kasbon_pakai2<0){
                            $kasbon_pakai2              = 0;
                          }else{
                            $kasbon_pakai2              = $kasbon_pakai2;
                          }
                          */
                          $debet2_arr[]                       = $h['debet'];
                      }
                      if($minggu=="3"){
                              // rabu  sabtu
                      	$drop3_arr[]  = $h['drop'];
                      	$storting3_arr[] = $h['storting'];
                      	$psp3_arr[]     = $h['psp'];
                      	$kasbon_pagi3_arr[] = $h['kasbon_pagi'];
                               //$jum_anggota_lama3 = mysqli_num_rows(mysqli_query($con,"select anggota_id from tbl_anggota where resort_id='$resort_id' and tgl_daftar < '$pembukuan_tgl'"));
                              //$jum_anggota_baru3 = mysqli_num_rows(mysqli_query($con,"select anggota_id from tbl_anggota where resort_id='$resort_id' and tgl_daftar = '$pembukuan_tgl'"));
                              //$jum_anggota_keluar3 = mysqli_num_rows(mysqli_query($con,"select anggota_id from tbl_anggota where resort_id='$resort_id' and tgl_keluar = '$pembukuan_tgl'"));
                      	$jum_anggota_lama3[]    = $h['L'];
                      	$jum_anggota_baru3[]    = $h['B'];
                      	$jum_anggota_keluar3[]  = $h['K'];
                      	$jum_anggota_kini3[]     = $h['kini'];

                               //////////////////////////////////////////////////////////
                      	$adm5persen3_arr[]           = $h['adm'];
                      	$simp4persen3_arr[]          = $h['simp'];
                         // $simp4persen3_lalu     = $drop3_lalu*0.04;

                      	$kredit3_arr[]               = $h['kredit'];;
                      	$debet_tanpa_kasbon3   = $storting3+$adm5persen3+$simp4persen3;
                      	$tunai3_arr[]                = $h['tunai'];
                          /*
                          if($tunai3<0){
                            $tunai3              = 0;
                          }else{
                            $tunai3              = $tunai3;
                          }
                          */
                          $kasbon_pakai3_arr[]         = $h['kasbon_pakai'];
                          /*
                          if($kasbon_pakai3<0){
                            $kasbon_pakai3              = 0;
                          }else{
                            $kasbon_pakai3              = $kasbon_pakai3;
                          }
                          */
                          $debet3_arr[]                       = $h['debet'];
                      }
                  } 

                          //bulan lalu

                          ////////////////////////

        ///

                  $drop1 = array_sum($drop1_arr);
                  $storting1 = array_sum($storting1_arr);
                  $psp1 = array_sum($psp1_arr);
                  $kasbon_pagi1=array_sum($kasbon_pagi1_arr);

                  $drop2 = array_sum($drop2_arr);
                  $storting2 = array_sum($storting2_arr);
                  $psp2 = array_sum($psp2_arr);
                  $kasbon_pagi2=array_sum($kasbon_pagi2_arr);

                  $drop3 = array_sum($drop3_arr);
                  $storting3 = array_sum($storting3_arr);
                  $psp3 = array_sum($psp3_arr);
                  $kasbon_pagi3=array_sum($kasbon_pagi3_arr);

                  $adm5persen1 = array_sum($adm5persen1_arr);
                  $simp4persen1 = array_sum($simp4persen1_arr);
                  $kredit1    = array_sum($kredit1_arr);
                  $debet1 = array_sum($debet1_arr);
                  $kasbon_pakai1 = array_sum($kasbon_pakai1_arr);
                  $tunai1 = array_sum($tunai1_arr);

                  $adm5persen2 = array_sum($adm5persen2_arr);
                  $simp4persen2 = array_sum($simp4persen2_arr);
                  $kredit2    = array_sum($kredit2_arr);
                  $debet2 = array_sum($debet2_arr);
                  $kasbon_pakai2 = array_sum($kasbon_pakai2_arr);
                  $tunai2 = array_sum($tunai2_arr);

                  $adm5persen3 = array_sum($adm5persen3_arr);
                  $simp4persen3 = array_sum($simp4persen3_arr);
                  $kredit3    = array_sum($kredit3_arr);
                  $debet3 = array_sum($debet3_arr);
                  $kasbon_pakai3 = array_sum($kasbon_pakai3_arr);
                  $tunai3 = array_sum($tunai3_arr);



                          ////lalu///
/*
                          $drop1_lalu           = array_sum($drop1_arr_lalu);
                          $storting1_lalu       = array_sum($storting1_arr_lalu);
                          $psp1_lalu            = array_sum($psp1_arr_lalu);
                          $kasbon_pagi1_lalu    =array_sum($kasbon_pagi1_arr_lalu);

                          $drop2_lalu           = array_sum($drop2_arr_lalu);
                          $storting2_lalu       = array_sum($storting2_arr_lalu);
                          $psp2_lalu            = array_sum($psp2_arr_lalu);
                          $kasbon_pagi2_lalu    = array_sum($kasbon_pagi2_arr_lalu);

                          $drop3_lalu           = array_sum($drop3_arr_lalu);
                          $storting3_lalu       = array_sum($storting3_arr_lalu);
                          $psp3_lalu            = array_sum($psp3_arr_lalu);
                          $kasbon_pagi3_lalu    =array_sum($kasbon_pagi3_arr_lalu);
                          */
                          //////////////////////////////////////////////////////////

                          /*
                          if($kasbon_pakai1<0){
                            $kasbon_pakai1              = 0;
                          }else{
                            $kasbon_pakai1              = $kasbon_pakai1;
                          }
                          */

                          


                          if($no%2==0){
                          	$warna = "#F5F5F5";
                          }else{
                          	$warna = "";
                          }

                          //bulan lalu
                          $tgl1 = $bulan;

                          $bulan_lalu = date('Y-m', strtotime('-1 month', strtotime($tgl1))); 
                          $q100=mysqli_query($con,"SELECT * from tbl_saldo_simpanan where saldo_bulan like '$bulan_lalu%' and resort_id='$resort_id'");


                          while($h1=mysqli_fetch_array($q100)){
                          	$minggu     = $h1['minggu'];
                              //senn kamis
                              //echo "senin-kamis";
                          	if($minggu=="1"){
                          		$saldo_simpanan1_lalu[]  = $h1['saldo_simpanan'];

                          	}
                              //selasa - jum'at
                          	if($minggu=="2"){
                          		$saldo_simpanan2_lalu[]  = $h1['saldo_simpanan'];

                          	}

                              // rabu  sabtu
                          	if($minggu=="3"){
                          		$saldo_simpanan3_lalu[]  = $h1['saldo_simpanan'];

                          	}

                          }

                          $q101=mysqli_query($con,"SELECT * from tbl_saldo_pinjaman where saldo_bulan like '$bulan_lalu%' and resort_id='$resort_id'");


                          while($h1=mysqli_fetch_array($q101)){
                          	$minggu     = $h1['minggu'];
                              //senn kamis
                              //echo "senin-kamis";
                          	if($minggu=="1"){
                          		$saldo_pinjaman1_lalu[]  = $h1['saldo_pinjaman'];

                          	}
                              //selasa - jum'at
                          	if($minggu=="2"){
                          		$saldo_pinjaman2_lalu[]  = $h1['saldo_pinjaman'];

                          	}

                              // rabu  sabtu
                          	if($minggu=="3"){
                          		$saldo_pinjaman3_lalu[]  = $h1['saldo_pinjaman'];

                          	}

                          }
                          ////////////////////////

                          $resort_nama_arr[]    = $resort_nama;
                          $simpanan_masuk1_arr[]  = $simp4persen1;
                          $simpanan_keluar1_arr[] = $psp1;
                          $simpanan_masuk2_arr[]  = $simp4persen2;
                          $simpanan_keluar2_arr[] = $psp2;
                          $simpanan_masuk3_arr[]  = $simp4persen3;
                          $simpanan_keluar3_arr[] = $psp3;
                          //lalau
                          
                          $saldo_simpanan1_lalu_arr[]  = array_sum($saldo_simpanan1_lalu);
                          $saldo_simpanan2_lalu_arr[]  = array_sum($saldo_simpanan2_lalu);
                          $saldo_simpanan3_lalu_arr[]  = array_sum($saldo_simpanan3_lalu);

                          $saldo_pinjaman1_lalu_arr[]  = array_sum($saldo_pinjaman1_lalu);
                          $saldo_pinjaman2_lalu_arr[]  = array_sum($saldo_pinjaman2_lalu);
                          $saldo_pinjaman3_lalu_arr[]  = array_sum($saldo_pinjaman3_lalu);

                          //
                          $drop_data_arr[]             = array_sum($drop_arr);
                          $storting_data_arr[]         = array_sum($storting_arr);

                          $drop1_data_arr[]             = $drop1;
                          $drop2_data_arr[]             = $drop2;
                          $drop3_data_arr[]             = $drop3;
                          
                          $storting1_data_arr[]         = $storting1;
                          $storting2_data_arr[]         = $storting2;
                          $storting3_data_arr[]         = $storting3;



                          ?>
                          <tr bgcolor="gray">
                          	<td colspan="13">
                          		<label><?php echo $resort_nama; //echo "SELECT pembukuan_drop,storting,psp,kasbon_pagi,pembukuan_tgl from tbl_pembukuan_harian where pembukuan_tgl like '$bulan_lalu%' and resort_id='$resort_id'";?></label>
                          	</td>
                          </tr>
                          <tr class="small ">
                          	<td >
                          		Senin.Kamis
                          	</td>
                          	<td align="right">
                          		<?php echo str_replace(",", ".", number_format(array_sum($jum_anggota_lama1)));?>
                          	</td>
                          	<td align="right">
                          		<?php echo str_replace(",", ".", number_format(array_sum($jum_anggota_baru1)));?>
                          	</td>
                          	<td align="right">
                          		<?php echo str_replace(",", ".", number_format(array_sum($jum_anggota_keluar1)));?>
                          	</td>
                          	<td align="right">
                          		<?php echo str_replace(",", ".", number_format(array_sum($jum_anggota_kini1)));?>
                          	</td>
                          	<td align="right">
                          		<?php echo str_replace(",", ".", number_format($kasbon_pakai1));?>
                          	</td>
                          	<td align="right">
                          		<?php echo str_replace(",", ".", number_format($storting1));?>
                          	</td>
                          	<td align="right">
                          		<?php echo str_replace(",", ".", number_format($adm5persen1));?>
                          	</td>
                          	<td align="right">
                          		<?php echo str_replace(",", ".", number_format($simp4persen1));?>
                          	</td>
                          	<td align="right">
                          		<?php echo str_replace(",", ".", number_format($debet1));?>
                          	</td>
                          	<td align="right">
                          		<?php echo str_replace(",", ".", number_format($drop1));?>
                          	</td>
                          	<td align="right">
                          		<?php echo str_replace(",", ".", number_format($psp1));?>
                          	</td>
                          	<td align="right">
                          		<?php echo str_replace(",", ".", number_format($kredit1));?>
                          	</td>
                          	<td align="right">
                          		<?php echo str_replace(",", ".", number_format($tunai1));?>
                          	</td>

                          </tr>
                          <tr class="small" bgcolor="#F5F5F5">
                          	<td >
                          		Selasa.Jum'at
                          	</td>
                          	<td align="right">
                          		<?php echo str_replace(",", ".", number_format(array_sum($jum_anggota_lama2)));?>
                          	</td>
                          	<td align="right">
                          		<?php echo str_replace(",", ".", number_format(array_sum($jum_anggota_baru2)));?>
                          	</td>
                          	<td align="right">
                          		<?php echo str_replace(",", ".", number_format(array_sum($jum_anggota_keluar2)));?>
                          	</td>
                          	<td align="right">
                          		<?php echo str_replace(",", ".", number_format(array_sum($jum_anggota_kini2)));?>
                          	</td>
                          	<td align="right">
                          		<?php echo str_replace(",", ".", number_format($kasbon_pakai2));?>
                          	</td>
                          	<td align="right">
                          		<?php echo str_replace(",", ".", number_format($storting2));?>
                          	</td>
                          	<td align="right">
                          		<?php echo str_replace(",", ".", number_format($adm5persen2));?>
                          	</td>
                          	<td align="right">
                          		<?php echo str_replace(",", ".", number_format($simp4persen2));?>
                          	</td>
                          	<td align="right">
                          		<?php echo str_replace(",", ".", number_format($debet2));?>
                          	</td>
                          	<td align="right">
                          		<?php echo str_replace(",", ".", number_format($drop2));?>
                          	</td>
                          	<td align="right">
                          		<?php echo str_replace(",", ".", number_format($psp2));?>
                          	</td>
                          	<td align="right">
                          		<?php echo str_replace(",", ".", number_format($kredit2));?>
                          	</td>
                          	<td align="right">
                          		<?php echo str_replace(",", ".", number_format($tunai2));?>
                          	</td>

                          </tr>
                          <tr class="small">
                          	<td >
                          		Rabu.Sabtu
                          	</td>
                          	<td align="right">
                          		<?php echo str_replace(",", ".", number_format(array_sum($jum_anggota_lama3)));?>
                          	</td>
                          	<td align="right">
                          		<?php echo str_replace(",", ".", number_format(array_sum($jum_anggota_baru3)));?>
                          	</td>
                          	<td align="right">
                          		<?php echo str_replace(",", ".", number_format(array_sum($jum_anggota_keluar3)));?>
                          	</td>
                          	<td align="right">
                          		<?php echo str_replace(",", ".", number_format(array_sum($jum_anggota_kini3)));?>
                          	</td>
                          	<td align="right">
                          		<?php echo str_replace(",", ".", number_format($kasbon_pakai3));?>
                          	</td>
                          	<td align="right">
                          		<?php echo str_replace(",", ".", number_format($storting3));?>
                          	</td>
                          	<td align="right">
                          		<?php echo str_replace(",", ".", number_format($adm5persen3));?>
                          	</td>
                          	<td align="right">
                          		<?php echo str_replace(",", ".", number_format($simp4persen3));?>
                          	</td>
                          	<td align="right">
                          		<?php echo str_replace(",", ".", number_format($debet3));?>
                          	</td>
                          	<td align="right">
                          		<?php echo str_replace(",", ".", number_format($drop3));?>
                          	</td>
                          	<td align="right">
                          		<?php echo str_replace(",", ".", number_format($psp3));?>
                          	</td>
                          	<td align="right">
                          		<?php echo str_replace(",", ".", number_format($kredit3));?>
                          	</td>
                          	<td align="right">
                          		<?php echo str_replace(",", ".", number_format($tunai3));?>
                          	</td>

                          </tr>
                          <?php
                          $kasbon_pakai_t_arr[]=($kasbon_pakai1+$kasbon_pakai2+$kasbon_pakai3);
                          $storting_t_arr[] = ($storting1+$storting2+$storting3);
                          $adm_t_arr[]  = ($adm5persen1+$adm5persen2+$adm5persen3);
                          $simpanan_t_arr[]=($simp4persen1+$simp4persen2+$simp4persen3);
                          $debet_t_arr[] = ($debet1+$debet2+$debet3);
                          $drop_t_arr[]=($drop1+$drop2+$drop3);
                          $psp_t_arr[]=($psp1+$psp2+$psp3);
                          $kredit_t_arr[]=($kredit1+$kredit2+$kredit3);
                          $tunai_t_arr[]=($tunai1+$tunai2+$tunai3);

                          $jum_l_arr[]    = array_sum($jum_anggota_lama1)+array_sum($jum_anggota_lama2)+array_sum($jum_anggota_lama3);
                          $jum_b_arr[]    = array_sum($jum_anggota_baru1)+array_sum($jum_anggota_baru2)+array_sum($jum_anggota_baru3);
                          $jum_k_arr[]    = array_sum($jum_anggota_keluar1)+array_sum($jum_anggota_keluar2)+array_sum($jum_anggota_keluar3);
                          $jum_kini_arr[] = array_sum($jum_anggota_kini1)+array_sum($jum_anggota_kini2)+array_sum($jum_anggota_kini3);

                          ?>
                          <tr bgcolor="gray">
                          	<td >
                          		<label>Jumlah</label>
                          	</td>
                          	<td align="right">
                          		<?php echo str_replace(",", ".", number_format(array_sum($jum_anggota_lama1)+array_sum($jum_anggota_lama2)+array_sum($jum_anggota_lama3)));?>
                          	</td>
                          	<td align="right">
                          		<?php echo str_replace(",", ".", number_format(array_sum($jum_anggota_baru1)+array_sum($jum_anggota_baru2)+array_sum($jum_anggota_baru3)));?>
                          	</td>
                          	<td align="right">
                          		<?php echo str_replace(",", ".", number_format(array_sum($jum_anggota_keluar1)+array_sum($jum_anggota_keluar2)+array_sum($jum_anggota_keluar3)));?>
                          	</td>
                          	<td align="right">
                          		<?php echo str_replace(",", ".", number_format(array_sum($jum_anggota_kini1)+array_sum($jum_anggota_kini2)+array_sum($jum_anggota_kini3)));?>
                          	</td>
                          	<td align="right">
                          		<?php echo str_replace(",", ".", number_format($kasbon_pakai1+$kasbon_pakai2+$kasbon_pakai3));?>
                          	</td>
                          	<td align="right">
                          		<?php echo str_replace(",", ".", number_format($storting1+$storting2+$storting3));?>
                          	</td>
                          	<td align="right">
                          		<?php echo str_replace(",", ".", number_format($adm5persen1+$adm5persen2+$adm5persen3));?>
                          	</td>
                          	<td align="right">
                          		<?php echo str_replace(",", ".", number_format($simp4persen1+$simp4persen2+$simp4persen3));?>
                          	</td>
                          	<td align="right">
                          		<?php echo str_replace(",", ".", number_format($debet1+$debet2+$debet3));?>
                          	</td>
                          	<td align="right">
                          		<?php echo str_replace(",", ".", number_format($drop1+$drop2+$drop3));?>
                          	</td>
                          	<td align="right">
                          		<?php echo str_replace(",", ".", number_format($psp1+$psp2+$psp3));?>
                          	</td>
                          	<td align="right">
                          		<?php echo str_replace(",", ".", number_format($kredit1+$kredit2+$kredit3));?>
                          	</td>
                          	<td align="right">
                          		<?php echo str_replace(",", ".", number_format($tunai1+$tunai2+$tunai3));?>
                          	</td>

                          </tr>

                          <?php 

                      } ?>
                  </tbody>
                  <tfoot>
                  	<tr class="small" bgcolor="gray">

                  		<td >
                  			<label>Jumlah total</label>
                  		</td>
                  		<td align="right">
                  			<?php echo str_replace(",", ".", number_format(array_sum($jum_l_arr)));?>
                  		</td>
                  		<td align="right">
                  			<?php echo str_replace(",", ".", number_format(array_sum($jum_b_arr)));?>
                  		</td>
                  		<td align="right">
                  			<?php echo str_replace(",", ".", number_format(array_sum($jum_k_arr)));?>
                  		</td>
                  		<td align="right">
                  			<?php echo str_replace(",", ".", number_format(array_sum($jum_kini_arr)));?>
                  		</td>
                  		<td align="right">
                  			<?php echo str_replace(",", ".", number_format(array_sum($kasbon_pakai_t_arr)));?>
                  		</td>
                  		<td align="right">
                  			<?php echo str_replace(",", ".", number_format(array_sum($storting_t_arr)));?>
                  		</td>
                  		<td align="right">
                  			<?php echo str_replace(",", ".", number_format(array_sum($adm_t_arr)));?>
                  		</td>
                  		<td align="right">
                  			<?php echo str_replace(",", ".", number_format(array_sum($simpanan_t_arr)));?>
                  		</td>
                  		<td align="right">
                  			<?php echo str_replace(",", ".", number_format(array_sum($debet_t_arr)));?>
                  		</td>
                  		<td align="right">
                  			<?php echo str_replace(",", ".", number_format(array_sum($drop_t_arr)));?>
                  		</td>
                  		<td align="right">
                  			<?php echo str_replace(",", ".", number_format(array_sum($psp_t_arr)));?>
                  		</td>
                  		<td align="right">
                  			<?php echo str_replace(",", ".", number_format(array_sum($kredit_t_arr)));?>
                  		</td>
                  		<td align="right">
                  			<?php echo str_replace(",", ".", number_format(array_sum($tunai_t_arr)));?>
                  		</td>

                  	</tr>

                  </tfoot>  
              </table>
              <pagebreak>
              	<br>
              	<h3>VI. LAPORAN SIMPANAN</h3>
              	<table cellpadding="7" style="width:100%">
              		<tr bgcolor="gray">
              			<td>
              				Resort
              			</td>
              			<td>Simpanan Lalu</td>
              			<td>Simpanan Masuk</td>
              			<td>Jumlah</td>
              			<td>Simpanan Keluar</td>
              			<td>Saldo Akhir</td>
              		</tr>
              		<?php
              		$jum  = count($resort_nama_arr);
              		for($x=0;$x<$jum;$x++){
              			?>
              			<tr bgcolor="gray">
              				<td colspan="6">
              					<label><?php echo $resort_nama_arr[$x];?></label>
              				</td>
              			</tr>
              			<tr class="small ">
              				<td >
              					Senin.Kamis
              				</td>                            
              				<td align="right">
              					<?php echo str_replace(",", ".", number_format($saldo_simpanan1_lalu_arr[$x]));?>
              				</td>
              				<td align="right">
              					<?php echo str_replace(",", ".", number_format($simpanan_masuk1_arr[$x]));?>
              				</td>
              				<td align="right">
              					<?php echo str_replace(",", ".", number_format($saldo_simpanan1_lalu_arr[$x]+$simpanan_masuk1_arr[$x]));?>
              				</td>
              				<td align="right">
              					<?php echo str_replace(",", ".", number_format($simpanan_keluar1_arr[$x]));?>
              				</td>
              				<td align="right">
              					<?php echo str_replace(",", ".", number_format(($saldo_simpanan1_lalu_arr[$x]+$simpanan_masuk1_arr[$x])-$simpanan_keluar1_arr[$x]));?>
              				</td>

              			</tr>
              			<tr class="small" bgcolor="#F5F5F5">
              				<td >
              					Selasa.Jum'at
              				</td>
              				<td align="right">
              					<?php echo str_replace(",", ".", number_format($saldo_simpanan2_lalu_arr[$x]));?>
              				</td>
              				<td align="right">
              					<?php echo str_replace(",", ".", number_format($simpanan_masuk2_arr[$x]));?>
              				</td>
              				<td align="right">
              					<?php echo str_replace(",", ".", number_format($saldo_simpanan2_lalu_arr[$x]+$simpanan_masuk2_arr[$x]));?>
              				</td>
              				<td align="right">
              					<?php echo str_replace(",", ".", number_format($simpanan_keluar2_arr[$x]));?>
              				</td>
              				<td align="right">
              					<?php echo str_replace(",", ".", number_format(($saldo_simpanan2_lalu_arr[$x]+$simpanan_masuk2_arr[$x])-$simpanan_keluar2_arr[$x]));?>
              				</td>
              			</tr>
              			<tr class="small">
              				<td >
              					Rabu.Sabtu
              				</td>

              				<td align="right">
              					<?php echo str_replace(",", ".", number_format($saldo_simpanan3_lalu_arr[$x]));?>
              				</td>
              				<td align="right">
              					<?php echo str_replace(",", ".", number_format($simpanan_masuk3_arr[$x]));?>
              				</td>
              				<td align="right">
              					<?php echo str_replace(",", ".", number_format($saldo_simpanan3_lalu_arr[$x]+$simpanan_masuk3_arr[$x]));?>
              				</td>
              				<td align="right">
              					<?php echo str_replace(",", ".", number_format($simpanan_keluar3_arr[$x]));?>
              				</td>
              				<td align="right">
              					<?php echo str_replace(",", ".", number_format(($saldo_simpanan3_lalu_arr[$x]+$simpanan_masuk3_arr[$x])-$simpanan_keluar3_arr[$x]));?>
              				</td>

              			</tr>
              			<?php
              			$saldo_simpanan_lalu_arr[]= $saldo_simpanan1_lalu_arr[$x]+$saldo_simpanan2_lalu_arr[$x]+$saldo_simpanan3_lalu_arr[$x];
              			$simpanan_masuk_arr[]=$simpanan_masuk1_arr[$x]+$simpanan_masuk2_arr[$x]+$simpanan_masuk3_arr[$x];
              			$jumlah_simpanan_arr[]=($saldo_simpanan1_lalu_arr[$x]+$saldo_simpanan2_lalu_arr[$x]+$saldo_simpanan3_lalu_arr[$x])+($simpanan_masuk1_arr[$x]+$simpanan_masuk2_arr[$x]+$simpanan_masuk3_arr[$x]);
              			$simpanan_keluar_arr[]=$simpanan_keluar1_arr[$x]+$simpanan_keluar2_arr[$x]+$simpanan_keluar3_arr[$x];
              			$saldo_simpanan_arr[]=($saldo_simpanan1_lalu_arr[$x]+$saldo_simpanan2_lalu_arr[$x]+$saldo_simpanan3_lalu_arr[$x])+($simpanan_masuk1_arr[$x]+$simpanan_masuk2_arr[$x]+$simpanan_masuk3_arr[$x])-($simpanan_keluar1_arr[$x]+$simpanan_keluar2_arr[$x]+$simpanan_keluar3_arr[$x]);
              			?>
              			<tr class="small" bgcolor="gray">
              				<td >
              					<label>Jumlah</label>
              				</td>

              				<td align="right">
              					<?php echo str_replace(",", ".", number_format($saldo_simpanan1_lalu_arr[$x]+$saldo_simpanan2_lalu_arr[$x]+$saldo_simpanan3_lalu_arr[$x]));?>
              				</td>
              				<td align="right">
              					<?php echo str_replace(",", ".", number_format($simpanan_masuk1_arr[$x]+$simpanan_masuk2_arr[$x]+$simpanan_masuk3_arr[$x]));?>
              				</td>
              				<td align="right">
              					<?php echo str_replace(",", ".", number_format(($saldo_simpanan1_lalu_arr[$x]+$saldo_simpanan2_lalu_arr[$x]+$saldo_simpanan3_lalu_arr[$x])+($simpanan_masuk1_arr[$x]+$simpanan_masuk2_arr[$x]+$simpanan_masuk3_arr[$x])));?>
              				</td>
              				<td align="right">
              					<?php echo str_replace(",", ".", number_format($simpanan_keluar1_arr[$x]+$simpanan_keluar2_arr[$x]+$simpanan_keluar3_arr[$x]));?>
              				</td>
              				<td align="right">
              					<?php echo str_replace(",", ".", number_format(($saldo_simpanan1_lalu_arr[$x]+$saldo_simpanan2_lalu_arr[$x]+$saldo_simpanan3_lalu_arr[$x])+($simpanan_masuk1_arr[$x]+$simpanan_masuk2_arr[$x]+$simpanan_masuk3_arr[$x])-($simpanan_keluar1_arr[$x]+$simpanan_keluar2_arr[$x]+$simpanan_keluar3_arr[$x])));?>
              				</td>

              			</tr>
              		<?php }?>
              		<tr class="small" bgcolor="gray">
              			<td >
              				<label>Jumlah Total</label>
              			</td>

              			<td align="right">
              				<?php echo str_replace(",", ".", number_format(array_sum($saldo_simpanan_lalu_arr)));?>
              			</td>
              			<td align="right">
              				<?php echo str_replace(",", ".", number_format(array_sum($simpanan_masuk_arr)));?>
              			</td>
              			<td align="right">
              				<?php echo str_replace(",", ".", number_format(array_sum($jumlah_simpanan_arr)));?>
              			</td>
              			<td align="right">
              				<?php echo str_replace(",", ".", number_format(array_sum($simpanan_keluar_arr)));?>
              			</td>
              			<td align="right">
              				<?php echo str_replace(",", ".", number_format(array_sum($saldo_simpanan_arr)));?>
              			</td>

              		</tr>

              	</table>
              	<pagebreak>
              		<br>
              		<h3>VII. LAPORAN PINJAMAN</h3>
              		<table cellpadding="7" style="width:100%">
              			<tr bgcolor="gray">
              				<td>
              					Resort
              				</td>
              				<td>Pinjaman Lalu</td>
              				<td>DROP</td>
              				<td>Pend. Bunga</td>
              				<td>Jumlah</td>
              				<td>Storting</td>
              				<td>Saldo Akhir</td>
              			</tr>
              			<?php
              			$jum  = count($resort_nama_arr);

              			for($x=0;$x<$jum;$x++){
              				?>

              				<tr bgcolor="gray">
              					<td colspan="6">
              						<label><?php echo $resort_nama_arr[$x];?></label>
              					</td>
              				</tr>
              				<tr class="small ">
              					<td >
              						Senin.Kamis
              					</td>                            
              					<td align="right">
              						<?php echo str_replace(",", ".", number_format($saldo_pinjaman1_lalu_arr[$x]));?>
              					</td>
              					<td align="right">
              						<?php echo str_replace(",", ".", number_format($drop1_data_arr[$x]));?>
              					</td>
              					<td align="right">
              						<?php echo str_replace(",", ".", number_format($drop1_data_arr[$x]*0.2));?>
              					</td>
              					<td align="right">
              						<?php echo str_replace(",", ".", number_format($saldo_pinjaman1_lalu_arr[$x]+$drop1_data_arr[$x]+($drop1_data_arr[$x]*0.2)));?>
              					</td>
              					<td align="right">
              						<?php echo str_replace(",", ".", number_format($storting1_data_arr[$x]));?>
              					</td>
              					<td align="right">
              						<?php echo str_replace(",", ".", number_format(($saldo_pinjaman1_lalu_arr[$x]+$drop1_data_arr[$x]+($drop1_data_arr[$x]*0.2))-$storting1_data_arr[$x]));?>
              					</td>

              				</tr>
              				<tr class="small" bgcolor="#F5F5F5">
              					<td >
              						Selasa.Jum'at
              					</td>
              					<td align="right">
              						<?php echo str_replace(",", ".", number_format($saldo_pinjaman2_lalu_arr[$x]));?>
              					</td>
              					<td align="right">
              						<?php echo str_replace(",", ".", number_format($drop2_data_arr[$x]));?>
              					</td>
              					<td align="right">
              						<?php echo str_replace(",", ".", number_format($drop2_data_arr[$x]*0.2));?>
              					</td>
              					<td align="right">
              						<?php echo str_replace(",", ".", number_format($saldo_pinjaman2_lalu_arr[$x]+$drop2_data_arr[$x]+($drop2_data_arr[$x]*0.2)));?>
              					</td>
              					<td align="right">
              						<?php echo str_replace(",", ".", number_format($storting2_data_arr[$x]));?>
              					</td>
              					<td align="right">
              						<?php echo str_replace(",", ".", number_format(($saldo_pinjaman2_lalu_arr[$x]+$drop2_data_arr[$x]+($drop2_data_arr[$x]*0.2))-$storting2_data_arr[$x]));?>
              					</td>
              				</tr>
              				<tr class="small">
              					<td >
              						Rabu.Sabtu
              					</td>

              					<td align="right">
              						<?php echo str_replace(",", ".", number_format($saldo_pinjaman3_lalu_arr[$x]));?>
              					</td>
              					<td align="right">
              						<?php echo str_replace(",", ".", number_format($drop3_data_arr[$x]));?>
              					</td>
              					<td align="right">
              						<?php echo str_replace(",", ".", number_format($drop3_data_arr[$x]*0.2));?>
              					</td>
              					<td align="right">
              						<?php echo str_replace(",", ".", number_format($saldo_pinjaman3_lalu_arr[$x]+$drop3_data_arr[$x]+($drop3_data_arr[$x]*0.2)));?>
              					</td>
              					<td align="right">
              						<?php echo str_replace(",", ".", number_format($storting3_data_arr[$x]));?>
              					</td>
              					<td align="right">
              						<?php echo str_replace(",", ".", number_format(($saldo_pinjaman3_lalu_arr[$x]+$drop3_data_arr[$x]+($drop3_data_arr[$x]*0.2))-$storting3_data_arr[$x]));?>
              					</td>

              				</tr>

              				<?php
              				$grand_saldo_pinjaman_lalu    = $saldo_pinjaman1_lalu_arr[$x]+$saldo_pinjaman2_lalu_arr[$x]+$saldo_pinjaman3_lalu_arr[$x];


              				$grand_drop                   = $drop_data_arr[$x];
              				$grand_bunga                  = $grand_drop*0.2;
              				$grand_storting               = $storting_data_arr[$x];

              				$grand_saldo_pinjaman_lalu_arr[]    = $grand_saldo_pinjaman_lalu;

              				$grand_drop_arr[]                   = $grand_drop;
              				$grand_bunga_arr[]                  = $grand_bunga;
              				$grand_storting_arr[]               = $grand_storting;
              				$grand_saldo_pinjaman_sekarang_arr[] = $grand_saldo_pinjaman_lalu+$grand_drop+$grand_bunga-$grand_storting;
              				$grand_total_pinjaman_arr[]         = $grand_saldo_pinjaman_lalu+$grand_drop+$grand_bunga;
              				?>

              				<tr class="small" bgcolor="gray">
              					<td >
              						<label>Jumlah</label>
              					</td>

              					<td align="right">
              						<?php echo str_replace(",", ".", number_format($grand_saldo_pinjaman_lalu));?>
              					</td>
              					<td align="right">
              						<?php echo str_replace(",", ".", number_format($grand_drop));?>
              					</td>
              					<td align="right">
              						<?php echo str_replace(",", ".", number_format($grand_bunga));?>
              					</td>
              					<td align="right">
              						<?php echo str_replace(",", ".", number_format($grand_saldo_pinjaman_lalu+$grand_drop+$grand_bunga));?>
              					</td>
              					<td align="right">
              						<?php echo str_replace(",", ".", number_format($grand_storting));?>
              					</td>
              					<td align="right">
              						<?php echo str_replace(",", ".", number_format($grand_saldo_pinjaman_lalu+$grand_drop+$grand_bunga-$grand_storting));?>
              					</td>

              				</tr>

              				<?php
              			}

              			?>


              			<tr class="small" bgcolor="gray">
              				<td >
              					<label>Jumlah Total</label>
              				</td>                               
              				<td align="right">
              					<?php echo str_replace(",", ".", number_format(array_sum($grand_saldo_pinjaman_lalu_arr)));?>
              				</td>
              				<td align="right">
              					<?php echo str_replace(",", ".", number_format(array_sum($grand_drop_arr)));?>
              				</td>
              				<td align="right">
              					<?php echo str_replace(",", ".", number_format(array_sum($grand_bunga_arr)));?>
              				</td>
              				<td align="right">
              					<?php echo str_replace(",", ".", number_format(array_sum($grand_total_pinjaman_arr)));?>
              				</td>
              				<td align="right">
              					<?php echo str_replace(",", ".", number_format(array_sum($grand_storting_arr)));?>
              				</td>
              				<td align="right">
              					<?php echo str_replace(",", ".", number_format(array_sum($grand_saldo_pinjaman_sekarang_arr)));?>
              				</td>

              			</tr>


              		</table>
              		<pagebreak>
              			<br>
              			<h3>VIII. LAPORAN KEMACETAN</h3>
              			<table cellpadding="7" style="width:100%">
              				<tr bgcolor="gray">
              					<td>
              						Resort
              					</td>
              					<td>Macet Baru</td>
              					<td>Angsuran</td>
              					<td>+/-</td>

              				</tr>
              				<?php
              				$no=1;
              				$q1       = mysqli_query($con,"select resort_id,resort_nama from tbl_resort order by resort_id asc");
              				while($h1   = mysqli_fetch_array($q1,MYSQLI_ASSOC)){
              					$resort_id = $h1['resort_id'];
              					$resort_nama = $h1['resort_nama'];


              					$qmacet = mysqli_query($con,"select * from tbl_kemacetan where bulan='$bulan' and resort_id='$resort_id'");
              					$cek=mysqli_num_rows($qmacet);
              					if($cek==0){
              						mysqli_query($con,"insert into tbl_kemacetan(kemacetan_baru,angsuran,plus,minus,bulan,resort_id,minggu) values('0','0','0','0','$bulan','$resort_id','1')");
              						mysqli_query($con,"insert into tbl_kemacetan(kemacetan_baru,angsuran,plus,minus,bulan,resort_id,minggu) values('0','0','0','0','$bulan','$resort_id','2')");
              						mysqli_query($con,"insert into tbl_kemacetan(kemacetan_baru,angsuran,plus,minus,bulan,resort_id,minggu) values('0','0','0','0','$bulan','$resort_id','3')");
              					}else{
              						unset($kemacetan_id_arr);
              						unset($kemacetan_baru_arr);
              						unset($angsuran_arr);
              						unset($plus_arr);
              						unset($minus_arr);
              						while($hmacet=mysqli_fetch_array($qmacet,MYSQLI_ASSOC)){
              							$kemacetan_id_arr[]   = $hmacet['kemacetan_id'];
              							$kemacetan_baru_arr[] = $hmacet['kemacetan_baru'];
              							$angsuran_arr[]       = $hmacet['angsuran'];
              							$plus_arr[]           = $hmacet['plus'];
              							$minus_arr[]          = $hmacet['minus'];

              							$grand_kemacetan_id_arr[]   = $hmacet['kemacetan_id'];
              							$grand_kemacetan_baru_arr[] = $hmacet['kemacetan_baru'];
              							$grand_angsuran_arr[]       = $hmacet['angsuran'];
              							$grand_plus_arr[]           = $hmacet['plus'];
              							$grand_minus_arr[]          = $hmacet['minus'];
              						}
              					}
              					?>
              					<tr class="bg-gray small" bgcolor="gray">
              						<td colspan="4">
              							<label><?php echo $resort_nama;?></label>
              						</td>
              					</tr>
              					<tr class="small ">

              						<td >
              							Senin.Kamis
              						</td>                            
              						<td align="right">

              							<?php echo str_replace(",", ".", number_format($kemacetan_baru_arr[0]));?>
              						</td>
              						<td align="right">
              							<?php echo str_replace(",", ".", number_format($angsuran_arr[0]));?>
              						</td>
              						<td align="right">
              							<?php echo str_replace(",", ".", number_format($angsuran_arr[0]-$kemacetan_baru_arr[0]));?>
              						</td>                     
              					</tr>
              					<tr class="small" bgcolor="#F5F5F5">
              						<td >
              							Selasa.Jum'at
              						</td>
              						<td align="right">

              							<?php echo str_replace(",", ".", number_format($kemacetan_baru_arr[1]));?>
              						</td>
              						<td align="right">
              							<?php echo str_replace(",", ".", number_format($angsuran_arr[1]));?>
              						</td>
              						<td align="right">
              							<?php echo str_replace(",", ".", number_format($angsuran_arr[1]-$kemacetan_baru_arr[1]));?>
              						</td>

              					</tr>
              					<tr class="small">
              						<td >
              							Rabu.Sabtu
              						</td>
              						<td align="right">

              							<?php echo str_replace(",", ".", number_format($kemacetan_baru_arr[2]));?>
              						</td>
              						<td align="right">
              							<?php echo str_replace(",", ".", number_format($angsuran_arr[2]));?>
              						</td>
              						<td align="right">
              							<?php echo str_replace(",", ".", number_format($angsuran_arr[2]-$kemacetan_baru_arr[2]));?>
              						</td>
              					</tr>
              					<tr class="small bg-gray" bgcolor="gray">
              						<td >
              							<label>Jumlah</label>
              						</td>

              						<td align="right">
              							<?php echo str_replace(",", ".", number_format(array_sum($kemacetan_baru_arr)));?>
              						</td>
              						<td align="right">
              							<?php echo str_replace(",", ".", number_format(array_sum($angsuran_arr)));?>
              						</td>
              						<td align="right">
              							<?php echo str_replace(",", ".", number_format(array_sum($angsuran_arr)-array_sum($kemacetan_baru_arr)));?>
              						</td>



              					</tr>
              					<?php 
              					$no++;
              				}?>
              			</tbody>
              			<tr>
              				<td colspan="4">
              				</td>
              			</tr>
              			<tr class="small bg-gray" bgcolor="gray">
              				<td >
              					<label>Jumlah Total</label>
              				</td>

              				<td align="right">
              					<?php echo str_replace(",", ".", number_format(array_sum($grand_kemacetan_baru_arr)));?>
              				</td>
              				<td align="right">
              					<?php echo str_replace(",", ".", number_format(array_sum($grand_angsuran_arr)));?>
              				</td>
              				<td align="right">
              					<?php echo str_replace(",", ".", number_format(array_sum($grand_angsuran_arr)-array_sum($grand_kemacetan_baru_arr)));?>
              				</td>



              			</tr>

              		</table>
              		<pagebreak>
              			<br>
              			<h3>IX. PERKEMBANGAN</h3>
              			<table cellpadding="7" style="width:100%">
              				<tr bgcolor="gray">
              					<td rowspan="2" >
              						Resort
              					</td>
              					<td colspan="4" align="center">
              						Pinjaman
              					</td>
              					<td rowspan="2" align="center">
              						Saldo Akhir Pinjaman
              					</td>
              					<td colspan="3" align="center">
              						Simpanan
              					</td>
              					<td rowspan="2" align="center">
              						Saldo Akhir simpanan
              					</td>
              				</tr>
              				<tr bgcolor="gray">
              					<td >
              						Lalu
              					</td>
              					<td>
              						DROP
              					</td>
              					<td>
              						Pend. Bunga
              					</td>
              					<td>
              						Strorting
              					</td>
              					<td>
              						Lalu
              					</td>
              					<td>
              						Masuk
              					</td>
              					<td>
              						Keluar
              					</td>
              				</tr>
              				<?php
              				for($x=0;$x<$jum;$x++){
              					if($x%2==0){
              						$warna = "#F5F5F5";
              					}else{
              						$warna = "";
              					}
              					?>
              					<tr bgcolor="<?php echo $warna;?>">
              						<td><?php echo $resort_nama_arr[$x];?></td>
              						<td align="right">
              							<?php 
              							$grand_saldo_pinjaman_lalu    = $saldo_pinjaman1_lalu_arr[$x]+$saldo_pinjaman2_lalu_arr[$x]+$saldo_pinjaman3_lalu_arr[$x];
              							$grand_saldo_simpanan_lalu    = $saldo_simpanan1_lalu_arr[$x]+$saldo_simpanan2_lalu_arr[$x]+$saldo_simpanan3_lalu_arr[$x];
              							$grand_simpanan_masuk         = $simpanan_masuk1_arr[$x]+$simpanan_masuk2_arr[$x]+$simpanan_masuk3_arr[$x];
              							$grand_simpanan_keluar        = $simpanan_keluar1_arr[$x]+$simpanan_keluar2_arr[$x]+$simpanan_keluar3_arr[$x];
              							$grand_saldo_simpanan_sekarang = ($grand_saldo_simpanan_lalu+$grand_simpanan_masuk)-$grand_simpanan_keluar;   
              							$grand_drop                   = $drop_data_arr[$x];
              							$grand_bunga                  = $grand_drop*0.2;
              							$grand_storting               = $storting_data_arr[$x];
              							$grand_saldo_pinjaman_sekarang = ($grand_saldo_pinjaman_lalu+$grand_drop+$grand_bunga)-$grand_storting;


                                  //$grand_saldo_pinjaman_lalu_arr[]    = $grand_saldo_pinjaman_lalu;
              							$grand_saldo_simpanan_lalu_arr[]    = $grand_saldo_simpanan_lalu;
              							$grand_simpanan_masuk_arr[]         = $grand_simpanan_masuk;
              							$grand_simpanan_keluar_arr[]        = $grand_simpanan_keluar;
              							$grand_saldo_simpanan_sekarang_arr[] = $grand_saldo_simpanan_sekarang;   
                                //  $grand_drop_arr[]                   = $grand_drop;
                                 // $grand_bunga_arr[]                  = $grand_bunga;
                                  //$grand_storting_arr[]               = $grand_storting;
                                  //$grand_saldo_pinjaman_sekarang_arr[] = $grand_saldo_pinjaman_sekarang;



              							echo str_replace(",", ".", number_format($grand_saldo_pinjaman_lalu));?>
              						</td>
              						<td align="right">
              							<?php echo str_replace(",", ".", number_format($grand_drop));?>
              						</td>
              						<td align="right">
              							<?php echo str_replace(",", ".", number_format($grand_bunga));?>
              						</td>
              						<td align="right">
              							<?php echo str_replace(",", ".", number_format($grand_storting));?>
              						</td>
              						<td align="right">
              							<?php echo str_replace(",", ".", number_format($grand_saldo_pinjaman_sekarang));?>
              						</td>
              						<td align="right">
              							<?php echo str_replace(",", ".", number_format($grand_saldo_simpanan_lalu));?>
              						</td>
              						<td align="right">
              							<?php echo str_replace(",", ".", number_format($grand_simpanan_masuk));?>
              						</td>                              
              						<td align="right">
              							<?php echo str_replace(",", ".", number_format($grand_simpanan_keluar));?>
              						</td>
              						<td align="right">
              							<?php echo str_replace(",", ".", number_format($grand_saldo_simpanan_sekarang));?>
              						</td>
              					</tr>
              				<?php } ?>
              				<tr bgcolor="gray">
              					<td>TOTAL</td>
              					<td><?php
              					$total_saldo_pinjaman_lalu        = array_sum($grand_saldo_pinjaman_lalu_arr);
              					$total_saldo_simpanan_lalu    = array_sum($grand_saldo_simpanan_lalu_arr);
              					$total_simpanan_masuk         = array_sum($grand_simpanan_masuk_arr);
              					$total_simpanan_keluar        = array_sum($grand_simpanan_keluar_arr);
              					$total_saldo_simpanan_sekarang = array_sum($grand_saldo_simpanan_sekarang_arr);
              					$total_drop                   = array_sum($grand_drop_arr);
              					$total_bunga                  = array_sum($grand_bunga_arr);
              					$total_storting               = array_sum($grand_storting_arr);
              					$total_saldo_pinjaman_sekarang = array_sum($grand_saldo_pinjaman_sekarang_arr);

              					echo str_replace(",", ".", number_format($total_saldo_pinjaman_lalu));?>
              				</td>
              				<td align="right">
              					<?php echo str_replace(",", ".", number_format($total_drop));?>
              				</td>
              				<td align="right">
              					<?php echo str_replace(",", ".", number_format($total_bunga));?>
              				</td>
              				<td align="right">
              					<?php echo str_replace(",", ".", number_format($total_storting));?>
              				</td>
              				<td align="right">
              					<?php echo str_replace(",", ".", number_format($total_saldo_pinjaman_sekarang));?>
              				</td>
              				<td align="right">
              					<?php echo str_replace(",", ".", number_format($total_saldo_simpanan_lalu));?>
              				</td>
              				<td align="right">
              					<?php echo str_replace(",", ".", number_format($total_simpanan_masuk));?>
              				</td>                              
              				<td align="right">
              					<?php echo str_replace(",", ".", number_format($total_simpanan_keluar));?>
              				</td>
              				<td align="right">
              					<?php echo str_replace(",", ".", number_format($total_saldo_simpanan_sekarang));?>
              				</td>
              			</tr>

              		</table>
              		<pagebreak>
              			<br>
              			<?php
      //pegawai
              			$qpeg=mysqli_query($con,"select jabatan_id,pegawai_jk from tbl_pegawai where pegawai_id!='admin'")
              			?>
              			<h3>X. RANGKUMAN PIMPINAN</h3>
              			<table cellpadding="3" style="width:100%">
              				<tr bgcolor="gray">
              					<td>No</td>
              					<td>Keterangan</td>
              					<td>Jumlah</td>
              					<td width="20"></td>
              					<td>No</td>
              					<td>Keterangan</td>
              					<td>Jumlah</td>
              				</tr>

              				<tr height="19">
              					<td height="19" width="30">
              						1.
              					</td>
              					<td>
              						Pimpinan
              					</td>
              					<td align="right">
              						<?php echo array_sum($JUMLAH_PIMPINAN_ARR);?>
              					</td>
              					<td>
              					</td>
              					<td width="30">
              						11.
              					</td>
              					<td>
              						Simpanan Awal bulan
              					</td>
              					<td align="right">
              						<?php echo str_replace(",", ".", number_format($total_saldo_simpanan_lalu));?>
              					</td>
              				</tr>
              				<tr height="19">
              					<td height="19">
              					</td>
              					<td>
              						Staff
              					</td>
              					<td align="right">
              						<?php echo array_sum($JUMLAH_STAFF_ARR);?>
              					</td>
              					<td>
              					</td>
              					<td>
              					</td>
              					<td>
              						Simpanan Masuk
              					</td>
              					<td align="right">
              						<?php echo str_replace(",", ".", number_format($total_simpanan_masuk));?>
              					</td>
              				</tr>
              				<tr height="19">
              					<td height="19">
              					</td>
              					<td>
              						Karyawan
              					</td>
              					<td align="right">
              						<?php 
              						if(array_sum($JUMLAH_KARYAWAN_ARR)-array_sum($JUMLAH_PIMPINAN_ARR)-array_sum($JUMLAH_STAFF_ARR)<0){
              							echo 0;
              						}else{
              							echo  array_sum($JUMLAH_KARYAWAN_ARR)-array_sum($JUMLAH_PIMPINAN_ARR)-array_sum($JUMLAH_STAFF_ARR);
              						}?>
              					</td>
              					<td>
              					</td>
              					<td>
              					</td>
              					<td>
              						Simpanan Keluar
              					</td>
              					<td align="right">
              						<?php echo str_replace(",", ".", number_format($total_simpanan_keluar));?>
              					</td>
              				</tr>
              				<tr height="19">
              					<td height="19">
              					</td>
              					<td>
              						karyawati
              					</td>
              					<td align="right">
              						<?php 
                //if(array_sum($JUMLAH_KARYAWATI_ARR)-array_sum($JUMLAH_PIMPINAN_ARR)-array_sum($JUMLAH_STAFF_ARR)<0){
                 // echo 0;
               // }else{
              						echo  array_sum($JUMLAH_KARYAWATI_ARR);
              //}
              						?>
              					</td>
              					<td>
              					</td>
              					<td>
              					</td>
              					<td>
              						Jumlah Simpanan
              					</td>
              					<td align="right">
              						<?php echo str_replace(",", ".", number_format($total_saldo_simpanan_sekarang));?>
              					</td>
              				</tr>
              				<tr height="19">
              					<td height="19">
              					</td>
              					<td>
              						Jumlah
              					</td>
              					<td align="right">
              						<?php echo array_sum($JUMLAH_KARYAWAN_ALL_ARR);?>
              					</td>
              					<td>
              					</td>
              					<td>
              						12.
              					</td>
              					<td>
              						Saldo Macet Awal Bulan
              					</td>
              					<td align="right">
              						<?php 
              						$qsaldo_macet = mysqli_query($con,"select macet_nominal from tbl_saldo_kemacetan where macet_bulan='$bulan_lalu'");
              						$dsaldo_macet = mysqli_fetch_array($qsaldo_macet);
              						$total_saldo_macet_lalu = $dsaldo_macet['macet_nominal'];
              						echo str_replace(",", ".", number_format($total_saldo_macet_lalu));?>
              					</td>
              				</tr>
              				<tr height="19">
              					<td height="19">
              						2.
              					</td>
              					<td>
              						Resort
              					</td>
              					<td align="right">
              						<?php echo $jum;?>
              					</td>
              					<td>
              					</td>
              					<td>
              					</td>
              					<td>
              						Macet baru
              					</td>
              					<td align="right">
              						<?php echo str_replace(",", ".", number_format(array_sum($grand_kemacetan_baru_arr)));?>
              					</td>
              				</tr>

              				<?php
              				$bulan_iniloh = $bulan."-01";
              				$qlamau = mysqli_query($con,"select anggota_awal from tbl_anggota_awal where anggota_bulan = '$bulan_iniloh'");
              				$hlamau = mysqli_fetch_array($qlamau);
              				$lamau = $hlamau['anggota_awal'];

        //$baruu = mysqli_num_rows(mysqli_query($con,"select anggota_id from tbl_anggota where tgl_daftar like  '$bulan%'"));
              				$baruu  = array_sum($anggota_b_arr);
              				$keluaru = array_sum($anggota_k_arr); 

        //$keluaru = mysqli_num_rows(mysqli_query($con,"select anggota_id from tbl_anggota where tgl_keluar like '$bulan%'"));
              				?>

              				<tr height="19">
              					<td height="19">
              						3.
              					</td>
              					<td>
              						Anggota Awal Bulan
              					</td>
              					<td align="right">
              						<?php echo str_replace(",", ".", number_format($lamau));?>
              					</td>
              					<td>
              					</td>
              					<td>
              					</td>
              					<td>
              						Jumlah
              					</td>
              					<td align="right">
              						<?php echo str_replace(",", ".", number_format($total_saldo_macet_lalu+array_sum($grand_kemacetan_baru_arr)));?>
              					</td>
              				</tr>
              				<tr height="19">
              					<td height="19">
              					</td>
              					<td>
              						Anggota Masuk
              					</td>
              					<td align="right">
              						<?php echo str_replace(",", ".", number_format($baruu));?>
              					</td>
              					<td>
              					</td>
              					<td>
              					</td>
              					<td>
              						Angsuran Macet
              					</td>
              					<td align="right">
              						<?php echo str_replace(",", ".", number_format(array_sum($grand_angsuran_arr)));?>
              					</td>
              				</tr>
              				<tr height="19">
              					<td height="19">
              					</td>
              					<td>
              						Anggota Keluar
              					</td>
              					<td align="right">
              						<?php echo str_replace(",", ".", number_format($keluaru));?>
              					</td>
              					<td>
              					</td>
              					<td>
              					</td>
              					<td>
              						Saldo Macet Kini
              					</td>
              					<td align="right">
              						<?php echo str_replace(",", ".", number_format($total_saldo_macet_lalu+array_sum($grand_kemacetan_baru_arr)-array_sum($grand_angsuran_arr)));?>
              					</td>
              				</tr>
              				<tr height="19">
              					<td height="19">
              					</td>
              					<td>
              						Jumlah Anggota
              					</td>
              					<td align="right">
              						<?php echo str_replace(",", ".", number_format($lamau+$baruu-$keluaru));?>
              					</td>
              					<td>
              					</td>
              					<td>
              						13.
              					</td>
              					<td>
              						rata - rata drop / pdl
              					</td>
              					<td align="right">
              						<?php echo str_replace(",", ".", number_format($total_drop/$jum));?>
              					</td>
              				</tr>
              				<tr height="19">
              					<td height="19">
              						4.
              					</td>
              					<td>
              						Anggota Plus / Minus
              					</td>
              					<td align="right">
              						<?php
              						if(($baruu-$keluaru)>0){
              							echo "plus";
              						}else if (($baruu-$keluaru)<0){
              							echo "minus";
              						}else{
              							echo "-";
              						}
              						?>
              					</td>
              					<td>
              					</td>
              					<td>
              						14.
              					</td>
              					<td>
              						Drop Tunda
              					</td>
              					<td align="right">
              						<?php 
              						$qdrop = mysqli_query($con,"select id_drop,drop_tunda from tbl_drop_tunda where bulan like '$bulan%'");
              						$hdrop=mysqli_fetch_array($qdrop);
              						$drop_tundane = $hdrop['drop_tunda'];
              						echo str_replace(",", ".", number_format($drop_tundane));?>
              					</td>
              				</tr>
              				<tr height="19">
              					<td height="19">
              						5.
              					</td>
              					<td>
              						Saldo Pinjaman Awal
              					</td>
              					<td align="right">
              						<?php echo str_replace(",", ".", number_format($total_saldo_pinjaman_lalu));?>
              					</td>
              					<td>
              					</td>
              					<td>
              						15.
              					</td>
              					<td>
              						Jumlah Biaya Umum & Akomodasi
              					</td>
              					<td align="right">
              						<?php echo str_replace(",", ".", number_format(($TOTAL_BIAYA_UMUM)+($akomodasi)));?>
              					</td>
              				</tr>
              				<tr height="19">
              					<td height="19">
              						6.
              					</td>
              					<td>
              						Drop / Pinjaman baru
              					</td>
              					<td align="right">
              						<?php echo str_replace(",", ".", number_format($total_drop));?>
              					</td>
              					<td>
              					</td>
              					<td>
              						16.
              					</td>
              					<td>
              						Jumlah Kas Akhir
              					</td>
              					<td align="right">
              						<?php echo str_replace(",", ".", number_format($total_kas_expedisi));?>
              					</td>
              				</tr>
              				<tr height="19">
              					<td height="19">
              						7.
              					</td>
              					<td>
              						Jasa Pinjaman 20%
              					</td>
              					<td align="right">
              						<?php echo str_replace(",", ".", number_format($total_bunga));?>
              					</td>
              					<td>
              					</td>
              					<td>
              						17.
              					</td>
              					<td >
              						Jumlah Gaji Kotor Karyawan
              					</td>
              					<td align="right">
              						<?php echo str_replace(",", ".", number_format(array_sum($gaji_total_arr)));?>
              					</td>
              				</tr>
              				<tr height="19">
              					<td height="19">
              						8.
              					</td>
              					<td>
              						Jumlah
              					</td>
              					<td align="right">
              						<?php echo str_replace(",", ".", number_format($total_saldo_pinjaman_lalu+$total_bunga+$total_drop));?>
              					</td>
              					<td>
              					</td>
              					<td>
              						18.
              					</td>
              					<td>
              						<?php
              						$qpeng_lain = mysqli_query($con,"select pengeluaran,nominal from tbl_pengeluaran where bulan='$bulan'");
              						while($hpeng=mysqli_fetch_array($qpeng_lain)){
              							$nominal_peng_arr[]=$hpeng['nominal'];
              							echo $hpeng['pengeluaran']."";
              						}
              						?>
              					</td>
              					<td align="right">
              						<?php
              						$jum_peng = count($nominal_peng_arr);
              						for($c=0;$c<$jum_peng;$c++){
              							?>
              							<?php echo str_replace(",", ".", number_format($nominal_peng_arr[$c]));?>
              							<?php
              						}
              						?>

              					</td>
              				</tr>
              				<tr height="19">
              					<td height="19">
              						9.
              					</td>
              					<td>
              						Storting
              					</td>
              					<td align="right">
              						<?php echo str_replace(",", ".", number_format($total_storting));?>
              					</td>
              					<td>
              					</td>
              					<td>
              						19.
              					</td>
              					<td>
              						Pengembalian Bon Prive
              					</td>
              					<td align="right">
              						<?php echo str_replace(",", ".", number_format($pengembalian_prive));?>
              					</td>
              				</tr>
              				<tr height="19">
              					<td height="19">
              						10.
              					</td>
              					<td>
              						Saldo Pinjaman Akhir
              					</td>
              					<td align="right">
              						<?php echo str_replace(",", ".", number_format($total_saldo_pinjaman_sekarang));?>
              					</td>
              					<td>
              					</td>
              					<td>
              						20.
              					</td>
              					<td>
              						Pengembalian Bon Tunda
              					</td>
              					<td align="right">
              						<?php echo str_replace(",", ".", number_format($pengembalian_tunda));?>
              					</td>

              				</tr>


              				<tr height="19">
              					<td height="19">
              					</td>
              					<td>
              					</td>
              					<td>
              					</td>
              					<td>
              					</td>
              					<td>
              						21
              					</td>
              					<td>
              						JUMLAH
              					</td>
              					<td align="right">
              						<?php echo str_replace(",", ".", number_format(($total_kas_expedisi-(array_sum($gaji_total_arr)+($pengeluaran_nominal))+($pengembalian_prive+$pengembalian_tunda))));?>
              					</td>
              				</tr>
              				<tr height="19">
              					<td height="19">
              					</td>
              					<td>
              					</td>
              					<td>
              					</td>
              					<td>
              					</td>
              					<td>
              						22
              					</td>
              					<td>
              						Saldo BON
              					</td>
              					<td align="right">
              						<?php 

              						$pengembalian_bon = $pengembalian_tunda+$pengembalian_prive;
              						$qprive =mysqli_query($con,"select sum(prive_nominal) as prive_nominal from tbl_bon_prive a  where a.prive_tgl like '$bulan%'");
              						$hprive = mysqli_fetch_array($qprive);

              						$qpanjer =mysqli_query($con,"select sum(panjer_nominal) as panjer_nominal from tbl_bon_panjer a  where a.panjer_tgl like '$bulan%'");
              						$hpanjer = mysqli_fetch_array($qpanjer);

              						$bon = $hprive['prive_nominal']+$hpanjer['panjer_nominal'];
                // echo str_replace(",", ".", number_format($bon));
                // echo str_replace(",", ".", number_format($pengembalian_bon));
              						echo str_replace(",", ".", number_format($bon-$pengembalian_bon));

              						?>
              					</td>
              				</tr>
              				<tr height="19">
              					<td height="19">
              					</td>
              					<td>
              					</td>
              					<td>
              					</td>
              					<td>
              					</td>
              					<td>
              						23
              					</td>
              					<td>
              						Kas Akhir
              					</td>
              					<td align="right">
              						<?php echo str_replace(",", ".", number_format(($total_kas_expedisi-(array_sum($gaji_total_arr)+($pengeluaran_nominal))+($pengembalian_prive+$pengembalian_tunda)+($bon-$pengembalian_bon))));?>
              					</td>
              				</tr>
              			</table>
              			<?php
              			$q_unit    = mysqli_query($con,"select unit_nama from tbl_unit");
              			$data_unit  = mysqli_fetch_array($q_unit,MYSQLI_ASSOC);

              			?>
              			<br>
              			<table width="100%">
              				<tr>
              					<td width="50%" align="center">
              						<br>PIMPINAN<br>
              						<br><br><br>
              						(<?php echo $TTD_PIMPINAN;?>)
              					</td>
              					<td>
              						<?php echo $data_unit['unit_nama'];?>, <?php echo tanggal(date("Y-m-d"));?><br>
              						KASIR<br>
              						<br><br><br>
              						(<?php echo $TTD_KASIR;?>)
              					</td>
              				</tr>
              			</table>
              			<pagebreak>
              				<table width="100%" cellpadding="10">
              					<tr>
              						<td align="center"><b>EVALUASI KAS KSP SATRIA MULIA ARTHOMORO BANYUMAS</b></td>
              					</tr>
              				</table>
              				<br>
              				<br>
              				<br>
              				<?php 
              				$q_eval_kas = mysqli_query($con, "SELECT sum(pembukuan_drop) as jumlah_drop, sum(storting) as jumlah_storting, sum(psp) as jumlah_psp FROM tbl_pembukuan_harian where pembukuan_tgl LIKE '$bulan%'") or die(mysqli_error($con));
              				$data_eval_kas  = mysqli_fetch_array($q_eval_kas,MYSQLI_ASSOC);
              				$data_bu = array_sum($nominal_arr) + $biayaAkomodasi;
              				$q_rekapitulasi = mysqli_query($con, "SELECT sum(tunai) as tunai, sum(kasbon_pakai) as kasbon_pakai FROM tbl_rekapitulasi where bulan = '$bulan'");
          					$data_rekapitulasi  = mysqli_fetch_array($q_rekapitulasi,MYSQLI_ASSOC);
          					$q_setor = mysqli_query($con, "SELECT sum(nominal) as nominal  FROM tbl_pengeluaran where bulan = '$bulan'");
          					$data_setor  = mysqli_fetch_array($q_setor,MYSQLI_ASSOC);
              				 ?>
              				<table width="80%">
              					<!-- <tr class=" bg-gray-dark" bgcolor="gray"> -->
              					<tr>
              						<td>DROP</td>
              						<td width="2%" align="center">:</td>
              						<td align="right"><?= str_replace(",", ".", number_format($data_eval_kas['jumlah_drop']))  ?></td>
              						
              					</tr>
              					<tr>
              						<td>STORTING</td>
              						<td align="center">:</td>
              						<td align="right"><?= str_replace(",", ".", number_format($data_eval_kas['jumlah_storting'])) ?></td>
              						<td colspan="4"></td>
              					</tr>
              					<tr>
              						<td>IP STORTING</td>
              						<td align="center">:</td>
              						<td align="right">0</td>
              						<td colspan="4"></td>
              					</tr>
              					<tr>
              						<td>PSP</td>
              						<td align="center">:</td>
              						<td align="right"><?= str_replace(",", ".", number_format($data_eval_kas['jumlah_psp'])) ?></td>
              						<td colspan="4"></td>
              					</tr>
              					<tr>
              						<td>TUNAI KAS</td>
              						<td align="center">:</td>
              						<td align="right"><?= str_replace(",", ".", number_format($data_rekapitulasi['tunai'])) ?></td>
              						<td colspan="4"></td>
              					</tr>
              					<tr>
              						<td>KASBON PAKAI</td>
              						<td align="center">:</td>
              						<td align="right"><?= str_replace(",", ".", number_format($data_rekapitulasi['kasbon_pakai'])) ?></td>
              						<td colspan="4"></td>
              					</tr>
              					<tr>
              						<td>GAJI</td>
              						<td align="center">:</td>
              						<td align="right"><?= str_replace(",", ".", number_format($gaji_karyawan)) ?></td>
              						<td colspan="4"></td>
              					</tr>
              					<tr>
              						<td>BU</td>
              						<td align="center">:</td>
              						<td align="right"><?= str_replace(",", ".", number_format($data_bu)); ?></td>
              						<td colspan="4"></td>
              					</tr>
              					<tr>
              						<td>SETOR</td>
              						<td align="center">:</td>
              						<td align="right"><?= str_replace(",", ".", number_format($data_setor['nominal'])) ?></td>
              						<td colspan="4"></td>
              					</tr>              					
              					<tr>
              						<td colspan="7"></td>
              					</tr>
              					<tr>
              						<td>PENDAPATAN</td>
              						<td>=</td>
              						<td>TUNAI KAS</td>
              						<td>-</td>
              						<td>KASBON PAKAI</td>
              						<td colspan="2"></td>
              					</tr>
              					<tr>
              						<td></td>
              						<td>=</td>
              						<td align="right"><?= str_replace(",", ".", number_format($data_rekapitulasi['tunai'])) ?></td>
              						<td>-</td>
              						<td align="right"><?= str_replace(",", ".", number_format($data_rekapitulasi['kasbon_pakai'])) ?></td>
              						<td colspan="2"></td>
              					</tr>
              					<tr>
              						<td></td>
              						<td>=</td>
              						<td align="right"><?= str_replace(",", ".", number_format($data_rekapitulasi['tunai'] - $data_rekapitulasi['kasbon_pakai'])) ?></td>
              						<td colspan="4">
              					</tr>
              					<tr>
              						<td>PENGELUARAN</td>
              						<td>=</td>
              						<td>GAJI</td>
              						<td>+</td>
              						<td>BIAYA UMUM</td>
              						<td>+</td>
              						<td>SETOR</td>
              					</tr>
              					<tr>
              						<td></td>
              						<td>=</td>
          							<td align="right"><?= str_replace(",", ".", number_format($gaji_karyawan)) ?></td>
              						<td>+</td>
              						<td align="right"><?= str_replace(",", ".", number_format($data_bu)); ?></td>
              						<td>+</td>
              						<td align="right"><?= str_replace(",", ".", number_format($data_setor['nominal'])) ?></td>
              					</tr>
              					<tr>
              						<td></td>
              						<td>=</td>
              						<td align="right"><?= str_replace(",", ".", number_format($data_bu + $gaji_karyawan + $data_setor['nominal'])); ?></td>
              						<td colspan="4"></td>
              					</tr>
              					<tr>
              						<td>KAS -/+</td>
              						<td>=</td>
              						<td>PENDAPATAN</td>
              						<td>-</td>
              						<td>PENGELUARAN</td>
              						<td colspan="2"></td>
              					</tr>
              					<tr>
              						<td></td>
              						<td>=</td>
              						<td align="right"><?= str_replace(",", ".", number_format($data_rekapitulasi['tunai'] - $data_rekapitulasi['kasbon_pakai'])) ?></td>
              						<td>-</td>
              						<td align="right"><?= str_replace(",", ".", number_format($data_bu + $gaji_karyawan + $data_setor['nominal'])); ?></td>
          							<td colspan="2"></td>
              					</tr>
              					<tr>
              						<td></td>
              						<td>=</td>
              						<td align="right"><?= str_replace(",", ".", number_format(($data_rekapitulasi['tunai'] - $data_rekapitulasi['kasbon_pakai'])-($data_bu + $gaji_karyawan + $data_setor['nominal']))) ?></td>
              						<td colspan="4"></td>
              					</tr>
              				</table>
              				<br>
              				<table width="100%">
              				<tr>
              					<td width="50%" align="center">
              						<br>PIMPINAN<br>
              						<br><br><br>
              						(<?php echo $TTD_PIMPINAN;?>)
              					</td>
              					<td>
              						<?php echo $data_unit['unit_nama'];?>, <?php echo tanggal(date("Y-m-d"));?><br>
              						KASIR<br>
              						<br><br><br>
              						(<?php echo $TTD_KASIR;?>)
              					</td>
              				</tr>
              			</table>
              			</pagebreak>

              			<pagebreak>
              				<table width="100%" cellpadding="10">
              					<tr>
              						<td align="center"><b>EVALUASI PENGELUARAN BON KARYAWAN</b></td>
              					</tr>              					
              					<tr>
              						<td align="center"><b>KSP SATRIA MULIA ARTHOMORO</b></td>
              					</tr>			
              					<tr>
              						<td align="center"><b>BULAN <?php echo tanggal($bulan);?></b></td>
              					</tr>              					
              				</table>
              				<br>
              				<br>
              				<br>
              				<table width="100%" cellpadding="4" class="table-border">
              					<thead>
	              					<tr class="table-border">
	              						<th rowspan="2" class="table-border">No.</th>
	              						<th rowspan="2" class="table-border">Nama</th>
	              						<th rowspan="2" class="table-border">Jabatan</th>
	              						<th colspan="3" class="table-border">BON PRIVE</th>
	              						<th colspan="5" class="table-border">BON PANJER</th>
	              						<th rowspan="2" class="table-border">PARAF</th>
	              					</tr>
	              					<tr>
	              						<th class="table-border">Kuota Bon</th>
	              						<th class="table-border">Bon Keluar</th>
	              						<th class="table-border">Status</th>
	              						<th class="table-border">Kuota Bon</th>
	              						<th class="table-border">Bon Keluar</th>
	              						<th class="table-border">Status</th>
	              						<th class="table-border">Angsuran</th>
	              						<th class="table-border">Sisa Bon</th>
	              					</tr>
              					</thead>
              					<tbody>
              						<?php 
              						$no = 1;
              						$qEvaluasi = mysqli_query($con, "SELECT * FROM tbl_pegawai LEFT JOIN tbl_jabatan ON tbl_jabatan.jabatan_id = tbl_pegawai.jabatan_id ORDER BY gaji_pokok DESC");
              						while($rEvaluasi    = mysqli_fetch_array($qEvaluasi,MYSQLI_ASSOC)) : 
              						 ?>
              						<tr>
              							<td><?= $no ?></td>
              							<td><?= $rEvaluasi['pegawai_nama'] ?></td>
              							<td><?= $rEvaluasi['jabatan_nama'] ?></td>
              							<td><?= $rEvaluasi['bon_prive'] ?></td>
              							<?php 
              								$pegawai_id = $rEvaluasi['pegawai_id'];

              								$qBonPrive = mysqli_query($con, "SELECT sum(prive_nominal) as prive_nominal FROM tbl_bon_prive where pegawai_id = '$pegawai_id' and prive_tgl like '$bulan%'");
              								$rBonPrive = mysqli_fetch_array($qBonPrive);

              								$qBonPanjer = mysqli_query($con, "SELECT sum(panjer_nominal) as panjer_nominal FROM tbl_bon_panjer where pegawai_id = '$pegawai_id' and panjer_tgl like '$bulan%'");
              								$rBonPanjer = mysqli_fetch_array($qBonPanjer);

              							 ?>
              							 <td><?= !empty($rBonPrive['prive_nominal']) ? $rBonPrive['prive_nominal'] : 0 ?></td>
              							 <td>SESUAI</td>
              							 <td><?= $rEvaluasi['bon_panjer'] ?></td>
              							 <td><?= !empty($rBonPanjer['panjer_nominal']) ? $rBonPanjer['panjer_nominal'] : 0 ?></td>
              							 <td>SESUAI</td>
              							 <td>0</td>
              							 <td>0</td>
              							 <td><?= $no ?>.</td>
              						</tr>
              						<?php $no++;  endwhile; ?>
              					</tbody>
              				</table>

              			</pagebreak>

              			<?php
              			$tahun=date("Y");
              			$mpdf->SetDisplayMode(100);
              			$mpdf->SetFooter('Laporan Bulanan '.tanggal($bulan).'|| &nbsp; &nbsp;{PAGENO}');
//$mpdf->SetHeader('KOPERASI SIMPAN PINJAM KSP. SATRIA MULIA ARTHOMORO');
              			$html = ob_get_contents();
              			ob_end_clean();

              			$mpdf->WriteHTML(utf8_encode($html));
              			$mpdf->Output("laporan bulanan ".date('d-m-Y H:i:s').".pdf" ,'I');
              		}
              		?>