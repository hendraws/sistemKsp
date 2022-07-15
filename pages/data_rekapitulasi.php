<?php session_start();


$USERNAME   = $_SESSION['USERNAME'];
$USER_ID       = $_SESSION['USER_ID'];
$NAMA       = $_SESSION['NAMA'];
$LEVEL           = $_SESSION['LEVEL'];
$bulan           = $_SESSION['BULAN'];
$cabang           = $_SESSION['CABANG'];
//$bulan    = date("Y-m");
include   "css.php";
include   "../lib/koneksi.php";
  //total inven
$q    = mysqli_query($con,"select * from tbl_unit");
$total  = mysqli_num_rows($q);


?>

<br>

<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header bg-gray-dark" >
				<h5 class="card-title">Data Rekapitulasi Bulan <?php echo tanggal($bulan);?></h5>

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
                    <!--
                     <button id="update" class="btn btn-sm btn-info" type="button">Update Data</button><br><br>
                 -->
                 <?php

                 $qunit = mysqli_query($con,"select unit_id,unit_nama from tbl_unit where unit_id = '$cabang'");
                 while($hunit=mysqli_fetch_array($qunit)){

                 	$unit_id = $hunit['unit_id'];
                 	$unit_nama = $hunit['unit_nama'];
                 	echo "<label>$unit_nama</label>";
                 	?>

                 	<table  class="table table-bordered table-hover table-striped" style="width:100%">

                 		<thead>
                 			<tr class="small bg-gray-dark">
                 				<td rowspan="2">RESORT</td>
                 				<td colspan="4" >
                 					ANGGOTA
                 				</td>
                 				<td rowspan="2">
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
                 			<tr class="small bg-gray-dark">

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
                 			$no=0;
                 			$qresort = mysqli_query($con,"select resort_id,resort_nama from tbl_resort where unit_id = '$unit_id' order by resort_id asc");
                 			while($hresort=mysqli_fetch_array($qresort)){        
                 				$resort_id = $hresort["resort_id"];
                 				$resort_nama = $hresort["resort_nama"];

                 				$qrekap1 = mysqli_query($con,"select sum(L) as L,sum(B) as B,sum(K) as K,sum(kini) as kini,sum(kasbon_pakai) as kasbon_pakai,
                 					sum(storting) as storting,sum(adm) as adm,sum(simp) as simp,sum(debet) as debet,
                 					sum(`drop`) as `drop`,sum(psp) as psp,sum(kredit) as kredit,sum(tunai) as tunai from tbl_rekapitulasi where resort_id='$resort_id' and bulan='$bulan' and minggu='1'");
                 				$data1=mysqli_fetch_array($qrekap1);
                 				$lama1 = $data1['L'];
                 				$baru1 = $data1['B'];
                 				$keluar1 = $data1['K'];
                 				$kini1 = $data1['kini'];
                 				$kasbon_pakai1  = $data1['kasbon_pakai'];
                 				$storting1      = $data1['storting'];
                 				$adm5persen1    = $data1['adm'];
                 				$simp4persen1   = $data1['simp'];
                 				$debet1         = $data1['debet'];
                 				$drop1          = $data1['drop'];
                 				$psp1            = $data1['psp'];
                 				$kredit1        = $data1['kredit'];
                 				$tunai1         = $data1['tunai'];

                 				$qrekap2 = mysqli_query($con,"select sum(L) as L,sum(B) as B,sum(K) as K,sum(kini) as kini,sum(kasbon_pakai) as kasbon_pakai,
                 					sum(storting) as storting,sum(adm) as adm,sum(simp) as simp,sum(debet) as debet,
                 					sum(`drop`) as `drop`,sum(psp) as psp,sum(kredit) as kredit,sum(tunai) as tunai from tbl_rekapitulasi where resort_id='$resort_id' and bulan='$bulan' and minggu='2'");
                 				$data2=mysqli_fetch_array($qrekap2);
                 				$lama2 = $data2['L'];
                 				$baru2 = $data2['B'];
                 				$keluar2 = $data2['K'];
                 				$kini2 = $data2['kini'];
                 				$kasbon_pakai2  = $data2['kasbon_pakai'];
                 				$storting2      = $data2['storting'];
                 				$adm5persen2    = $data2['adm'];
                 				$simp4persen2   = $data2['simp'];
                 				$debet2         = $data2['debet'];
                 				$drop2          = $data2['drop'];
                 				$psp2            = $data2['psp'];
                 				$kredit2        = $data2['kredit'];
                 				$tunai2         = $data2['tunai'];

                 				$qrekap3 = mysqli_query($con,"select sum(L) as L,sum(B) as B,sum(K) as K,sum(kini) as kini,sum(kasbon_pakai) as kasbon_pakai,
                 					sum(storting) as storting,sum(adm) as adm,sum(simp) as simp,sum(debet) as debet,
                 					sum(`drop`) as `drop`,sum(psp) as psp,sum(kredit) as kredit,sum(tunai) as tunai from tbl_rekapitulasi where resort_id='$resort_id' and bulan='$bulan' and minggu='3'");
                 				$data3=mysqli_fetch_array($qrekap3);
                 				$lama3 = $data3['L'];
                 				$baru3 = $data3['B'];
                 				$keluar3 = $data3['K'];
                 				$kini3 = $data3['kini'];
                 				$kasbon_pakai3  = $data3['kasbon_pakai'];
                 				$storting3      = $data3['storting'];
                 				$adm5persen3    = $data3['adm'];
                 				$simp4persen3   = $data3['simp'];
                 				$debet3         = $data3['debet'];
                 				$drop3          = $data3['drop'];
                 				$psp3            = $data3['psp'];
                 				$kredit3        = $data3['kredit'];
                 				$tunai3         = $data3['tunai'];

                 				$lama_arr[] = $lama1+$lama2+$lama3;
                 				$baru_arr[] = $baru1+$baru2+$baru3;
                 				$keluar_arr[] = $keluar1+$keluar2+$keluar3;
                 				$kini_arr[]   = $kini1+$kini2+$kini3;
                 				$kasbon_pakai_arr[] = $kasbon_pakai1+$kasbon_pakai2+$kasbon_pakai3;
                 				$storting_arr[] = $storting1+$storting2+$storting3;
                 				$adm5persen_arr[] = $adm5persen1+$adm5persen2+$adm5persen3;
                 				$simp4persen_arr[] = $simp4persen1+$simp4persen2+$simp4persen3;
                 				$debet_arr[] = $debet1+$debet2+$debet3;
                 				$drop_arr[] = $drop1+$drop2+$drop3;
                 				$psp_arr[] = $psp1+$psp2+$psp3;
                 				$kredit_arr[] = $kredit1+$kredit2+$kredit3;
                 				$tunai_arr[] = $tunai1+$tunai2+$tunai3;

                 				if($no==4){
                 					?>
                 					<tr class="small bg-gray-dark">
                 						<td rowspan="2">RESORT</td>
                 						<td colspan="4" >
                 							ANGGOTA
                 						</td>
                 						<td rowspan="2">
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
                 					<tr class="small bg-gray-dark">

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
                 					<?php
                 				}
                 				?>
                 				<tr class="small bg-gray">
                 					<td colspan="14">
                 						<label><?php echo $resort_nama;?></label>
                 					</td>
                 				</tr>
                 				<tr class="small ">
                 					<td >
                 						Senin.Kamis
                 					</td>
                 					<td align="right">
                 						<?php echo str_replace(",", ".", number_format($lama1));?>
                 					</td>
                 					<td align="right">
                 						<?php echo str_replace(",", ".", number_format($baru1));?>
                 					</td>
                 					<td align="right">
                 						<?php echo str_replace(",", ".", number_format($keluar1));?>
                 					</td>
                 					<td align="right">
                 						<?php echo str_replace(",", ".", number_format($kini1));?>
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
                 				<tr class="small">
                 					<td >
                 						Selasa.Jum'at
                 					</td>
                 					<td align="right">
                 						<?php echo str_replace(",", ".", number_format($lama2));?>
                 					</td>
                 					<td align="right">
                 						<?php echo str_replace(",", ".", number_format($baru2));?>
                 					</td>
                 					<td align="right">
                 						<?php echo str_replace(",", ".", number_format($keluar2));?>
                 					</td>
                 					<td align="right">
                 						<?php echo str_replace(",", ".", number_format($kini2));?>
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
                 						<?php echo str_replace(",", ".", number_format($lama3));?>
                 					</td>
                 					<td align="right">
                 						<?php echo str_replace(",", ".", number_format($baru3));?>
                 					</td>
                 					<td align="right">
                 						<?php echo str_replace(",", ".", number_format($keluar3));?>
                 					</td>
                 					<td align="right">
                 						<?php echo str_replace(",", ".", number_format($kini3));?>
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

                 				<tr class="small bg-gray">
                 					<td >
                 						<label>Jumlah</label>
                 					</td>
                 					<td align="right">
                 						<?php echo str_replace(",", ".", number_format($lama1+$lama2+$lama3));?>
                 					</td>
                 					<td align="right">
                 						<?php echo str_replace(",", ".", number_format($baru1+$baru2+$baru3));?>
                 					</td>
                 					<td align="right">
                 						<?php echo str_replace(",", ".", number_format($keluar1+$keluar2+$keluar3));?>
                 					</td>
                 					<td align="right">
                 						<?php echo str_replace(",", ".", number_format($kini1+$kini2+$kini3));?>
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
                 				$no++;

                 				if($no==5){
                 					$no=1;
                 				}
                 			}?>
                 		</tbody>
                 		<tfoot>
                 			<tr class="small bg-gray-dark">
                 				<td >
                 					<label>Jumlah total</label>
                 				</td>
                 				<td align="right">
                 					<?php echo str_replace(",", ".", number_format(array_sum($lama_arr)));?>
                 				</td>
                 				<td align="right">
                 					<?php echo str_replace(",", ".", number_format(array_sum($baru_arr)));?>
                 				</td>
                 				<td align="right">
                 					<?php echo str_replace(",", ".", number_format(array_sum($keluar_arr)));?>
                 				</td>
                 				<td align="right">
                 					<?php echo str_replace(",", ".", number_format(array_sum($kini_arr)));?>
                 				</td>
                 				<td align="right">
                 					<?php echo str_replace(",", ".", number_format(array_sum($kasbon_pakai_arr)));?>
                 				</td>
                 				<td align="right">
                 					<?php echo str_replace(",", ".", number_format(array_sum($storting_arr)));?>
                 				</td>
                 				<td align="right">
                 					<?php echo str_replace(",", ".", number_format(array_sum($adm5persen_arr)));?>
                 				</td>
                 				<td align="right">
                 					<?php echo str_replace(",", ".", number_format(array_sum($simp4persen_arr)));?>
                 				</td>
                 				<td align="right">
                 					<?php echo str_replace(",", ".", number_format(array_sum($debet_arr)));?>
                 				</td>
                 				<td align="right">
                 					<?php echo str_replace(",", ".", number_format(array_sum($drop_arr)));?>
                 				</td>
                 				<td align="right">
                 					<?php echo str_replace(",", ".", number_format(array_sum($psp_arr)));?>
                 				</td>
                 				<td align="right">
                 					<?php echo str_replace(",", ".", number_format(array_sum($kredit_arr)));?>
                 				</td>
                 				<td align="right">
                 					<?php echo str_replace(",", ".", number_format(array_sum($tunai_arr)));?>
                 				</td>

                 			</tr>

                 		</tfoot>
                      <!--
                      <tfoot>
                        <tr class="small bg-gray-dark">
                          
                            <td >
                                  Jumlah Lalu
                              </td>
                              <td align="right">
                                  -
                              </td>
                              <td align="right">
                                  -
                              </td>
                              <td align="right">
                                  -
                              </td>
                              <td align="right">
                                  <?php echo str_replace(",", ".", number_format(array_sum($kasbon_pakai_arr_total)));?>
                              </td>
                              <td align="right">
                                  <?php echo str_replace(",", ".", number_format(array_sum($storting_arr_total)));?>
                              </td>
                              <td align="right">
                                  <?php echo str_replace(",", ".", number_format(array_sum($adm5persen_arr_total)));?>
                              </td>
                              <td align="right">
                                  <?php echo str_replace(",", ".", number_format(array_sum($simp4persen_arr_total)));?>
                              </td>
                              <td align="right">
                                  <?php echo str_replace(",", ".", number_format(array_sum($debet_arr_total)));?>
                              </td>
                              <td align="right">
                                  <?php echo str_replace(",", ".", number_format(array_sum($drop_arr_total)));?>
                              </td>
                              <td align="right">
                                  <?php echo str_replace(",", ".", number_format(array_sum($psp_arr_total)));?>
                              </td>
                              <td align="right">
                                  <?php echo str_replace(",", ".", number_format(array_sum($kredit_arr_total)));?>
                              </td>
                              <td align="right">
                                  <?php echo str_replace(",", ".", number_format(array_sum($tunai_arr_total)));?>
                              </td>
                        </tr>
                        <tr class="small bg-gray-dark">
                            <td >
                                  Jumlah
                              </td>
                              <td align="right">
                                  -
                              </td>
                              <td align="right">
                                  -
                              </td>
                              <td align="right">
                                  -
                              </td>
                              <td align="right">
                                <?php 
                                $kasbon_pakai_expedisi_arr[]=array_sum($kasbon_pakai_arr);
                                $tunai_expedisi_arr[] = array_sum($tunai_arr);
                                
                                ?>
                                  <?php echo str_replace(",", ".", number_format(array_sum($kasbon_pakai_arr)));?>
                              </td>
                              <td align="right">
                                  <?php echo str_replace(",", ".", number_format(array_sum($storting_arr)));?>
                              </td>
                              <td align="right">
                                  <?php echo str_replace(",", ".", number_format(array_sum($adm5persen_arr)));?>
                              </td>
                              <td align="right">
                                  <?php echo str_replace(",", ".", number_format(array_sum($simp4persen_arr)));?>
                              </td>
                              <td align="right">
                                  <?php echo str_replace(",", ".", number_format(array_sum($debet_arr)));?>
                              </td>
                              <td align="right">
                                  <?php echo str_replace(",", ".", number_format(array_sum($drop_arr)));?>
                              </td>
                              <td align="right">
                                  <?php echo str_replace(",", ".", number_format(array_sum($psp_arr)));?>
                              </td>
                              <td align="right">
                                  <?php echo str_replace(",", ".", number_format(array_sum($kredit_arr)));?>
                              </td>
                              <td align="right">
                                  <?php echo str_replace(",", ".", number_format(array_sum($tunai_arr)));?>
                              </td>
                        </tr>
                        <tr class="small bg-gray-dark">
                            <td >
                                  Total
                              </td>
                              <td align="right">
                                  -
                              </td>
                              <td align="right">
                                  -
                              </td>
                              <td align="right">
                                  -
                              </td>
                              <td align="right">
                                  <?php echo str_replace(",", ".", number_format(array_sum($kasbon_pakai_arr_total)+array_sum($kasbon_pakai_arr)));?>
                              </td>
                              <td align="right">
                                  <?php echo str_replace(",", ".", number_format(array_sum($storting_arr_total)+array_sum($storting_arr)));?>
                              </td>
                              <td align="right">
                                  <?php echo str_replace(",", ".", number_format(array_sum($adm5persen_arr_total)+array_sum($adm5persen_arr)));?>
                              </td>
                              <td align="right">
                                  <?php echo str_replace(",", ".", number_format(array_sum($simp4persen_arr_total)+array_sum($simp4persen_arr)));?>
                              </td>
                              <td align="right">
                                  <?php echo str_replace(",", ".", number_format(array_sum($debet_arr_total)+array_sum($debet_arr)));?>
                              </td>
                              <td align="right">
                                  <?php echo str_replace(",", ".", number_format(array_sum($drop_arr_total)+array_sum($drop_arr)));?>
                              </td>
                              <td align="right">
                                  <?php echo str_replace(",", ".", number_format(array_sum($psp_arr_total)+array_sum($psp_arr)));?>
                              </td>
                              <td align="right">
                                  <?php echo str_replace(",", ".", number_format(array_sum($kredit_arr_total)+array_sum($kredit_arr)));?>
                              </td>
                              <td align="right">
                                  <?php echo str_replace(",", ".", number_format(array_sum($tunai_arr_total)+array_sum($tunai_arr)));?>
                              </td>
                        </tr>
                        <?php
                                $kasbon_pakai_arr_total[]        =array_sum($kasbon_pakai_arr);
                                $storting_arr_total[]            =array_sum($storting_arr);
                                $adm5persen_arr_total[]            =array_sum($adm5persen_arr);
                                $simp4persen_arr_total[]            =array_sum($simp4persen_arr);
                                $debet_arr_total[]            =array_sum($debet_arr);
                                $drop_arr_total[]            =array_sum($drop_arr);
                                $psp_arr_total[]            =array_sum($psp_arr);
                                $kredit_arr_total[]            =array_sum($kredit_arr);
                                $tunai_arr_total[]            =array_sum($tunai_arr);

                        ?>
                      </tfoot>
                  -->
              </table>   
          <?php } ?>
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
			data: "judul=Tambah Data Unit&tampil=unit_add",
			cache: false,
			success: function(msg){
				$("#tampil_modal_sedang").html(msg);
			}
		});
	});
</script>