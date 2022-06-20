<?php
 ob_start();
 session_start();
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
      VIII. LAPORAN KEMACETA
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
                         unset($tunai_grand_arr);
                         //unset($kasbon_pakai_arr);

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
                          $q=mysqli_query($con,"SELECT pembukuan_drop,storting,psp,kasbon_pagi,pembukuan_tgl from tbl_pembukuan_harian where pembukuan_tgl like '$bulan%' and resort_id='$resort_id'");
                          while($h=mysqli_fetch_array($q)){
                            $pembukuan_tgl   = $h['pembukuan_tgl'];
                            $tgl_to_day = strtotime($pembukuan_tgl);
                            $day = date('D', $tgl_to_day);
                              $drop_arr[]  = $h['pembukuan_drop'];
                              $storting_arr[] = $h['storting'];
                              $psp_arr[]     = $h['psp'];
                              $kasbon_pagi_arr[] = $h['kasbon_pagi'];

                              $drop  = $h['pembukuan_drop'];
                              $storting = $h['storting'];
                              $psp     = $h['psp'];
                              $kasbon_pagi = $h['kasbon_pagi'];

                            //echo $day.$pembukuan_tgl;
                            if($day=="Mon" or $day=="Thu"){
                              //senn kamis
                              //echo "senin-kamis";
                              $drop1_arr[]  = $h['pembukuan_drop'];
                              $storting1_arr[] = $h['storting'];
                              $psp1_arr[]     = $h['psp'];
                              $kasbon_pagi1_arr[] = $h['kasbon_pagi'];
                            }
                            if($day=="Tue" or $day=="Fri"){
                              //selasa - jum'at
                              $drop2_arr[]  = $h['pembukuan_drop'];
                              $storting2_arr[] = $h['storting'];
                              $psp2_arr[]     = $h['psp'];
                              $kasbon_pagi2_arr[] = $h['kasbon_pagi'];
                            }
                            if($day=="Wed" or $day=="Sat"){
                              // rabu  sabtu
                              $drop3_arr[]  = $h['pembukuan_drop'];
                              $storting3_arr[] = $h['storting'];
                              $psp3_arr[]     = $h['psp'];
                              $kasbon_pagi3_arr[] = $h['kasbon_pagi'];
                            }
                          } 

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
                          //////////////////////////////////////////////////////////
                          $adm5persen           = $drop*0.05;
                          $simp4persen          = $drop*0.04;
                          
                          $kredit               = $drop+$psp;
                          $debet_tanpa_kasbon1   = $storting+$adm5persen+$simp4persen;
                          $tunai                = $debet_tanpa_kasbon-$kredit;
                          if($tunai1<0){
                            $tunai1              = 0;
                          }else{
                            $tunai1              = $tunai1;
                          }
                          $kasbon_pakai1         = $kredit1-$debet_tanpa_kasbon1;
                          if($kasbon_pakai1<0){
                            $kasbon_pakai1              = 0;
                          }else{
                            $kasbon_pakai1              = $kasbon_pakai1;
                          }
                          $debet1                       = $kasbon_pakai1+$storting1+$adm5persen1+$simp4persen1;
                          //////////////////////////////////////////////////////////
                          $adm5persen1           = $drop1*0.05;
                          $simp4persen1          = $drop1*0.04;
                          
                          $kredit1               = $drop1+$psp1;
                          $debet_tanpa_kasbon1   = $storting1+$adm5persen1+$simp4persen1;
                          $tunai1                = $debet_tanpa_kasbon1-$kredit1;
                          if($tunai1<0){
                            $tunai1              = 0;
                          }else{
                            $tunai1              = $tunai1;
                          }
                          $kasbon_pakai1         = $kredit1-$debet_tanpa_kasbon1;
                          if($kasbon_pakai1<0){
                            $kasbon_pakai1              = 0;
                          }else{
                            $kasbon_pakai1              = $kasbon_pakai1;
                          }
                          $debet1                       = $kasbon_pakai1+$storting1+$adm5persen1+$simp4persen1;
                          //////////////////////////////////////////////////////////
                          $adm5persen2           = $drop2*0.05;
                          $simp4persen2          = $drop2*0.04;
                          
                          $kredit2               = $drop2+$psp2;
                          $debet_tanpa_kasbon2   = $storting2+$adm5persen2+$simp4persen2;
                          $tunai2                = $debet_tanpa_kasbon2-$kredit2;
                          if($tunai2<0){
                            $tunai2              = 0;
                          }else{
                            $tunai2              = $tunai2;
                          }
                          $kasbon_pakai2         = $kredit2-$debet_tanpa_kasbon2;
                          if($kasbon_pakai2<0){
                            $kasbon_pakai2              = 0;
                          }else{
                            $kasbon_pakai2              = $kasbon_pakai2;
                          }
                          $debet2                       = $kasbon_pakai2+$storting2+$adm5persen2+$simp4persen2;
                          //////////////////////////////////////////////////////////
                          $adm5persen3           = $drop3*0.05;
                          $simp4persen3          = $drop3*0.04;
                          
                          $kredit3               = $drop3+$psp3;
                          $debet_tanpa_kasbon3   = $storting3+$adm5persen3+$simp4persen3;
                          $tunai3                = $debet_tanpa_kasbon3-$kredit3;
                          if($tunai3<0){
                            $tunai3              = 0;
                          }else{
                            $tunai3              = $tunai3;
                          }
                          $kasbon_pakai3         = $kredit3-$debet_tanpa_kasbon3;
                          if($kasbon_pakai3<0){
                            $kasbon_pakai3              = 0;
                          }else{
                            $kasbon_pakai3              = $kasbon_pakai3;
                          }
                          $debet3                       = $kasbon_pakai3+$storting3+$adm5persen3+$simp4persen3;
                          $tunai_grand_arr[]            = $tunai1+$tunai2+$tunai3;
                          $kasbon_pakai_arr[]           = $kasbon_pakai1+$kasbon_pakai2+$kasbon_pakai3;

                      } ?>
                     
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
                             
                              $tunai_kas = array_sum($tunai_grand_arr);

                              echo str_replace(",", ".", number_format($tunai_kas));
                              ?>
                            </td>
                          </tr>
                          <?php
                           $qgajie = mysqli_query($con,"SELECT sum(gaji_panjer) as panjer,sum(gaji_prive) as prive from tbl_gaji WHERE gaji_bulan='$bulan'");
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
                            <td>3</td>
                            <td>Pengembalian BON Prive</td>
                            <td align="right">
                              <?php
                             
                           

                              echo str_replace(",", ".", number_format($pengembalian_prive));
                              ?>
                            </td>
                          </tr>
                          <?php
                          $n=5;
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
                            $total_pemasukan = $kas_awal+$tunai_kas+$pengembalian_tunda+$pengembalian_prive+array_sum($pemasukan_nominal_arr);
                              echo str_replace(",", ".", number_format($total_pemasukan));
                              ?>
                            </td>
                          </tr>
                        </table>
			</td>
			<td>
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
                              
                              $kasbon_pakai = array_sum($kasbon_pakai_arr);

                              echo str_replace(",", ".", number_format($kasbon_pakai));
                              ?>
                            </td>
                          </tr>
                           <tr class="" bgcolor="#F5F5F5">
                            <td>2</td>
                            <td>Gaji Karyawan</td>
                            <td align="right">
                              <?php
                             $qgaji = mysqli_query($con,"SELECT sum(gaji_pokok+gaji_tunjangan) as gaji from tbl_gaji WHERE gaji_bulan='$bulan'");
                             $hgaji=mysqli_fetch_array($qgaji);

                              $gaji_karyawan = $hgaji['gaji'];

                              echo str_replace(",", ".", number_format($gaji_karyawan));
                              ?>
                            </td>
                          </tr>
                           <tr class="">
                            <td>3</td>
                            <td>Biaya Umum / Operasional</td>
                            <td align="right">
                              <?php
                             $qgaji1 = mysqli_query($con,"SELECT sum(nominal) as operasional from tbl_operasional where operasional_tgl like '$bulan%'");
                             $hgaji1=mysqli_fetch_array($qgaji1);

                              $operasional = $hgaji1['operasional'];

                              echo str_replace(",", ".", number_format($operasional));
                              ?>
                            </td>
                          </tr>
                          <tr class="" bgcolor="#F5F5F5">
                            <td>4</td>
                            <td>Transport dan Uang Makan</td>
                            <td align="right">
                              <?php
                             $qgaji2 = mysqli_query($con,"SELECT sum(uang_makan+uang_transport) as akomodasi from tbl_akomodasi where akomodasi_tgl like '$bulan%'");
                             $hgaji2=mysqli_fetch_array($qgaji2);

                              $akomodasi = $hgaji2['akomodasi'];

                              echo str_replace(",", ".", number_format($akomodasi));
                              ?>
                            </td>
                          </tr>
                          <tr class="">
                            <td>5</td>
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
                          $n=6;
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
                            $total_pengeluaran = $kasbon_pakai+$gaji_karyawan+$operasional+$akomodasi+$bon_privee+$bon_panjere+array_sum($pengeluaran_nominal_arr);
                              echo str_replace(",", ".", number_format($total_pengeluaran));
                              ?>
                            </td>
                          </tr>
                        </table>
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
            <td colspan="3" width="227" align="center">
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
           
        </tr>
                     
                      	<?php 
                      	$no=1;
                        $q    = mysqli_query($con,"select a.pegawai_id,a.pegawai_nik,a.pegawai_nama,b.jabatan_nama,a.jabatan_id,a.pegawai_jk from tbl_pegawai a left join tbl_jabatan b on a.jabatan_id=b.jabatan_id ");
                        $total_pegawai  = mysqli_num_rows($q);
  
                      	while($h		= mysqli_fetch_array($q,MYSQLI_ASSOC)){
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
						    $gaji_pokok_arr[] 	= $gaji_pokok;
						    $gaji_jabatan_arr[]	= $gaji_jabatan;
						    $gaji_masa_kerja_arr[] 	= $gaji_masa_kerja;
						    $gaji_pendidikan_arr[] 	= $gaji_pendidikan;
						    $gaji_kompetensi_arr[] 	= $gaji_kompetensi;
						    $gaji_total_arr[]	= $gaji_tunjangan+$gaji_pokok;
						    $gaji_panjer_arr[] 	= $gaji_panjer;
						    $gaji_prive_arr[] 	= $gaji_prive;
						    $gaji_lain_arr[]	= $gaji_lain;
						    $gaji_potongan_arr[]	= $gaji_potongan;
						    $gaji_diterima_arr[]	= $gaji_diterima;
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
				<tr bgcolor="gray">
					<td colspan="2"><strong>Total</strong></td>
					<td align="right"><?php 
          $TOTAL_BIAYA_UMUM = array_sum($nominal_arr);
          echo str_replace(",", ".", number_format(array_sum($nominal_arr)));?></td>
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
					$q		= mysqli_query($con,"select a.*,b.pegawai_nama from tbl_inventaris a left join tbl_pegawai b on a.pegawai_id=b.pegawai_id");
					while($h		= mysqli_fetch_array($q,MYSQLI_ASSOC)){
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
                          <td align="center"><?php echo $h['inven_transport'];?></td>
                          <td></td>
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
                              <td colspan="3" >
                                  ANGGOTA
                              </td>
                              <td rowspan="2" width="200">
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
                                  K
                              </td>
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


                        $q1       = mysqli_query($con,"select resort_id,resort_nama from tbl_resort order by resort_id asc");
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
                          $no=1;
                          $q=mysqli_query($con,"SELECT pembukuan_drop,storting,psp,kasbon_pagi,pembukuan_tgl from tbl_pembukuan_harian where pembukuan_tgl like '$bulan%' and resort_id='$resort_id'");
                          while($h=mysqli_fetch_array($q)){
                            $pembukuan_tgl   = $h['pembukuan_tgl'];

                            // $resort_idku            = $h1['resort_id'];    
                             //$bulan_iniku     = substr($pembukuan_tgl_loop, 0,7)."-01";
                         
                          //$jum_anggota_kini[]     = ($jum_anggota_lama+$jum_anggota_baru)-$jum_anggota_keluar;
                            $tgl_to_day = strtotime($pembukuan_tgl);
                            $day = date('D', $tgl_to_day);
                              $drop_arr[]  = $h['pembukuan_drop'];
                              $storting_arr[] = $h['storting'];
                              $psp_arr[]     = $h['psp'];
                              $kasbon_pagi_arr[] = $h['kasbon_pagi'];

                              $drop  = $h['pembukuan_drop'];
                              $storting = $h['storting'];
                              $psp     = $h['psp'];
                              $kasbon_pagi = $h['kasbon_pagi'];

                            //echo $day.$pembukuan_tgl;
                            if($day=="Mon" or $day=="Thu"){
                              //senn kamis
                              //echo "senin-kamis";
                              $drop1_arr[]  = $h['pembukuan_drop'];
                              $storting1_arr[] = $h['storting'];
                              $psp1_arr[]     = $h['psp'];
                              $kasbon_pagi1_arr[] = $h['kasbon_pagi'];
                              $jum_anggota_lama1 = mysqli_num_rows(mysqli_query($con,"select anggota_id from tbl_anggota where resort_id='$resort_id' and tgl_daftar < '$pembukuan_tgl'"));
                              $jum_anggota_baru1 = mysqli_num_rows(mysqli_query($con,"select anggota_id from tbl_anggota where resort_id='$resort_id' and tgl_daftar = '$pembukuan_tgl'"));
                              $jum_anggota_keluar1 = mysqli_num_rows(mysqli_query($con,"select anggota_id from tbl_anggota where resort_id='$resort_id' and tgl_keluar = '$pembukuan_tgl'"));
                            }
                            if($day=="Tue" or $day=="Fri"){
                              //selasa - jum'at
                              $drop2_arr[]  = $h['pembukuan_drop'];
                              $storting2_arr[] = $h['storting'];
                              $psp2_arr[]     = $h['psp'];
                              $kasbon_pagi2_arr[] = $h['kasbon_pagi'];
                              $jum_anggota_lama2 = mysqli_num_rows(mysqli_query($con,"select anggota_id from tbl_anggota where resort_id='$resort_id' and tgl_daftar < '$pembukuan_tgl'"));
                              $jum_anggota_baru2 = mysqli_num_rows(mysqli_query($con,"select anggota_id from tbl_anggota where resort_id='$resort_id' and tgl_daftar = '$pembukuan_tgl'"));
                              $jum_anggota_keluar2 = mysqli_num_rows(mysqli_query($con,"select anggota_id from tbl_anggota where resort_id='$resort_id' and tgl_keluar = '$pembukuan_tgl'"));
                            }
                            if($day=="Wed" or $day=="Sat"){
                              // rabu  sabtu
                              $drop3_arr[]  = $h['pembukuan_drop'];
                              $storting3_arr[] = $h['storting'];
                              $psp3_arr[]     = $h['psp'];
                              $kasbon_pagi3_arr[] = $h['kasbon_pagi'];
                              $jum_anggota_lama3 = mysqli_num_rows(mysqli_query($con,"select anggota_id from tbl_anggota where resort_id='$resort_id' and tgl_daftar < '$pembukuan_tgl'"));
                              $jum_anggota_baru3 = mysqli_num_rows(mysqli_query($con,"select anggota_id from tbl_anggota where resort_id='$resort_id' and tgl_daftar = '$pembukuan_tgl'"));
                              $jum_anggota_keluar3 = mysqli_num_rows(mysqli_query($con,"select anggota_id from tbl_anggota where resort_id='$resort_id' and tgl_keluar = '$pembukuan_tgl'"));
                            }
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
                          $adm5persen           = $drop*0.05;
                          $simp4persen          = $drop*0.04;
                          
                          $kredit               = $drop+$psp;
                          $debet_tanpa_kasbon1   = $storting+$adm5persen+$simp4persen;
                          $tunai                = $debet_tanpa_kasbon-$kredit;
                          if($tunai1<0){
                            $tunai1              = 0;
                          }else{
                            $tunai1              = $tunai1;
                          }
                          $kasbon_pakai1         = $kredit1-$debet_tanpa_kasbon1;
                          if($kasbon_pakai1<0){
                            $kasbon_pakai1              = 0;
                          }else{
                            $kasbon_pakai1              = $kasbon_pakai1;
                          }
                          $debet1                       = $kasbon_pakai1+$storting1+$adm5persen1+$simp4persen1;
                          //////////////////////////////////////////////////////////
                          $adm5persen1           = $drop1*0.05;
                          $simp4persen1          = $drop1*0.04;
                         // $simp4persen1_lalu     = $drop1_lalu*0.04;
                          
                          $kredit1               = $drop1+$psp1;
                          $debet_tanpa_kasbon1   = $storting1+$adm5persen1+$simp4persen1;
                          $tunai1                = $debet_tanpa_kasbon1-$kredit1;
                          if($tunai1<0){
                            $tunai1              = 0;
                          }else{
                            $tunai1              = $tunai1;
                          }
                          $kasbon_pakai1         = $kredit1-$debet_tanpa_kasbon1;
                          if($kasbon_pakai1<0){
                            $kasbon_pakai1              = 0;
                          }else{
                            $kasbon_pakai1              = $kasbon_pakai1;
                          }
                          $debet1                       = $kasbon_pakai1+$storting1+$adm5persen1+$simp4persen1;
                          //////////////////////////////////////////////////////////
                          $adm5persen2           = $drop2*0.05;
                          $simp4persen2          = $drop2*0.04;
                         // $simp4persen2_lalu     = $drop2_lalu*0.04;
                          
                          $kredit2               = $drop2+$psp2;
                          $debet_tanpa_kasbon2   = $storting2+$adm5persen2+$simp4persen2;
                          $tunai2                = $debet_tanpa_kasbon2-$kredit2;
                          if($tunai2<0){
                            $tunai2              = 0;
                          }else{
                            $tunai2              = $tunai2;
                          } 
                          $kasbon_pakai2         = $kredit2-$debet_tanpa_kasbon2;
                          if($kasbon_pakai2<0){
                            $kasbon_pakai2              = 0;
                          }else{
                            $kasbon_pakai2              = $kasbon_pakai2;
                          }
                          $debet2                       = $kasbon_pakai2+$storting2+$adm5persen2+$simp4persen2;
                          //////////////////////////////////////////////////////////
                          $adm5persen3           = $drop3*0.05;
                          $simp4persen3          = $drop3*0.04;
                         // $simp4persen3_lalu     = $drop3_lalu*0.04;
                          
                          $kredit3               = $drop3+$psp3;
                          $debet_tanpa_kasbon3   = $storting3+$adm5persen3+$simp4persen3;
                          $tunai3                = $debet_tanpa_kasbon3-$kredit3;
                          if($tunai3<0){
                            $tunai3              = 0;
                          }else{
                            $tunai3              = $tunai3;
                          }
                          $kasbon_pakai3         = $kredit3-$debet_tanpa_kasbon3;
                          if($kasbon_pakai3<0){
                            $kasbon_pakai3              = 0;
                          }else{
                            $kasbon_pakai3              = $kasbon_pakai3;
                          }
                          $debet3                       = $kasbon_pakai3+$storting3+$adm5persen3+$simp4persen3;
                          if($no%2==0){
                            $warna = "#F5F5F5";
                          }else{
                            $warna = "";
                          }


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
                                  <?php echo str_replace(",", ".", number_format($jum_anggota_lama1));?>
                              </td>
                              <td align="right">
                                   <?php echo str_replace(",", ".", number_format($jum_anggota_baru1));?>
                              </td>
                              <td align="right">
                                   <?php echo str_replace(",", ".", number_format($jum_anggota_keluar1));?>
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
                                  <?php echo str_replace(",", ".", number_format($jum_anggota_lama2));?>
                              </td>
                              <td align="right">
                                   <?php echo str_replace(",", ".", number_format($jum_anggota_baru2));?>
                              </td>
                              <td align="right">
                                   <?php echo str_replace(",", ".", number_format($jum_anggota_keluar2));?>
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
                                  <?php echo str_replace(",", ".", number_format($jum_anggota_lama3));?>
                              </td>
                              <td align="right">
                                   <?php echo str_replace(",", ".", number_format($jum_anggota_baru3));?>
                              </td>
                              <td align="right">
                                   <?php echo str_replace(",", ".", number_format($jum_anggota_keluar3));?>
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
					
					
					?>

                          <tr class="small" bgcolor="gray">
                              <td >
                                  <label>Jumlah</label>
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
                                  -
                              </td>
                              <td align="right">
                                  -
                              </td>
                              <td align="right">
                                  -
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
                                  <?php echo str_replace(",", ".", number_format(($simpanan_masuk2_arr_lalu[$x]+$simpanan_masuk2_arr[$x])-$simpanan_keluar2_arr[$x]));?>
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
       // for($x=0;$x<$jum;$x++){
        ?>
        <!--
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
                                  <?php echo str_replace(",", ".", number_format($drop1_data_arr[$x]*0.02));?>
                              </td>
                               <td align="right">
                                  <?php echo str_replace(",", ".", number_format($saldo_pinjaman1_lalu_arr[$x]+$drop1_data_arr[$x]+($drop1_data_arr[$x]*0.02)));?>
                              </td>
                              <td align="right">
                                  <?php echo str_replace(",", ".", number_format($storting1_data_arr[$x]));?>
                              </td>
                              <td align="right">
                                  <?php echo str_replace(",", ".", number_format(($saldo_pinjaman1_lalu_arr[$x]+$drop1_data_arr[$x]+($drop1_data_arr[$x]*0.02))-$storting1_data_arr[$x]));?>
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
                                  <?php echo str_replace(",", ".", number_format($drop2_data_arr[$x]*0.02));?>
                              </td>
                               <td align="right">
                                  <?php echo str_replace(",", ".", number_format($saldo_pinjaman2_lalu_arr[$x]+$drop2_data_arr[$x]+($drop2_data_arr[$x]*0.02)));?>
                              </td>
                              <td align="right">
                                  <?php echo str_replace(",", ".", number_format($storting2_data_arr[$x]));?>
                              </td>
                              <td align="right">
                                  <?php echo str_replace(",", ".", number_format(($saldo_pinjaman2_lalu_arr[$x]+$drop2_data_arr[$x]+($drop2_data_arr[$x]*0.02))-$storting2_data_arr[$x]));?>
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
                                  <?php echo str_replace(",", ".", number_format($drop3_data_arr[$x]*0.02));?>
                              </td>
                               <td align="right">
                                  <?php echo str_replace(",", ".", number_format($saldo_pinjaman3_lalu_arr[$x]+$drop3_data_arr[$x]+($drop3_data_arr[$x]*0.02)));?>
                              </td>
                              <td align="right">
                                  <?php echo str_replace(",", ".", number_format($storting3_data_arr[$x]));?>
                              </td>
                              <td align="right">
                                  <?php echo str_replace(",", ".", number_format(($saldo_pinjaman3_lalu_arr[$x]+$drop3_data_arr[$x]+($drop3_data_arr[$x]*0.02))-$storting3_data_arr[$x]));?>
                              </td>
                              
                          </tr>
         <!--
                          <tr class="small" bgcolor="gray">
                              <td >
                                  <label>Jumlah</label>
                              </td>
                              
                               <td align="right">
                                  <?php echo str_replace(",", ".", number_format($saldo_pinjaman1_lalu[$x]+$saldo_pinjaman2_lalu[$x]+$saldo_pinjaman3_lalu[$x]));?>
                              </td>
                              <td align="right">
                                  <?php echo str_replace(",", ".", number_format($drop1_arr[$x]+$drop2_arr[$x]+$drop3_arr[$x]));?>
                              </td>
                              <td align="right">
                                  <?php echo str_replace(",", ".", number_format($drop1_arr[$x]*0.02+$drop2_arr[$x]*0.02+$drop3_arr[$x]*0.02));?>
                              </td>
                              <td align="right">
                                  <?php echo str_replace(",", ".", number_format(($saldo_pinjaman1_lalu[$x]+$saldo_pinjaman2_lalu[$x]+$saldo_pinjaman3_lalu[$x])+($drop1_arr[$x]+$drop2_arr[$x]+$drop3_arr[$x])+($drop1_arr[$x]*0.02+$drop2_arr[$x]*0.02+$drop3_arr[$x]*0.02))));?>
                              </td>
                              <td align="right">
                                  <?php echo str_replace(",", ".", number_format($storting1_arr[$x]+$storting2_arr[$x]+$storting3_arr[$x]));?>
                              </td>
                              <td align="right">
                                  <?php echo str_replace(",", ".", number_format(($saldo_pinjaman1_lalu[$x]+$saldo_pinjaman2_lalu[$x]+$saldo_pinjaman3_lalu[$x])+($drop1_arr[$x]+$drop2_arr[$x]+$drop3_arr[$x])+($drop1_arr[$x]*0.02+$drop2_arr[$x]*0.02+$drop3_arr[$x]*0.02))-($storting1_arr[$x]+$storting2_arr[$x]+$storting3_arr[$x])));?>
                              </td>
                              
                          </tr>
                        -->
                        <?php
                         //}
                         ?>

                        <!--
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
                        -->

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
          <td>+</td>
          <td>-</td>
          
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
                        <td colspan="5">
                          <label><?php echo $resort_nama;?></label>
                        </td>
                      </tr>
                        <tr class="small ">
                          
                              <td >
                                  Senin.Kamis
                              </td>                            
                              <td align="right">
                               
                          <?php echo $kemacetan_baru_arr[0];?>
                              </td>
                              <td align="right">
                                  <?php echo $angsuran_arr[0];?>
                              </td>
                              <td align="right">
                                  <?php echo $plus_arr[0];?>
                              </td>
                              <td align="right">
                                 <?php echo $minus_arr[0];?>
                              </td>                            
                          </tr>
                          <tr class="small" bgcolor="#F5F5F5">
                              <td >
                                  Selasa.Jum'at
                              </td>
                              <td align="right">
                                
                                <?php echo $kemacetan_baru_arr[1];?>
                              </td>
                              <td align="right">
                                 <?php echo $angsuran_arr[1];?>
                              </td>
                              <td align="right">
                                  <?php echo $plus_arr[1];?>
                              </td>
                              <td align="right">
                                  <?php echo $minus_arr[1];?>
                              </td>
                          </tr>
                          <tr class="small">
                              <td >
                                  Rabu.Sabtu
                              </td>
                              <td align="right">
                                
                               <?php echo $kemacetan_baru_arr[2];?>
                              </td>
                              <td align="right">
                                 <?php echo $angsuran_arr[2];?>
                              </td>
                              <td align="right">
                                  <?php echo $plus_arr[2];?>
                              </td>
                              <td align="right">
                                 <?php echo $minus_arr[2];?>
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
                                  <?php echo str_replace(",", ".", number_format(array_sum($plus_arr)));?>
                              </td>
                              <td align="right">
                                  <?php echo str_replace(",", ".", number_format(array_sum($minus_arr)));?>
                              </td>
                              
                              
                          </tr>
                        <?php 
                        $no++;
                      }?>
                      </tbody>
                      <tr>
                        <td colspan="5">
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
                                  <?php echo str_replace(",", ".", number_format(array_sum($grand_plus_arr)));?>
                              </td>
                              <td align="right">
                                  <?php echo str_replace(",", ".", number_format(array_sum($grand_minus_arr)));?>
                              </td>
                              
                              
                          </tr>

      </table>
                           <pagebreak>
      <br>
      <h3>VIII. PERKEMBANGAN</h3>
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


                                  $grand_saldo_pinjaman_lalu_arr[]    = $grand_saldo_pinjaman_lalu;
                                  $grand_saldo_simpanan_lalu_arr[]    = $grand_saldo_simpanan_lalu;
                                  $grand_simpanan_masuk_arr[]         = $grand_simpanan_masuk;
                                  $grand_simpanan_keluar_arr[]        = $grand_simpanan_keluar;
                                  $grand_saldo_simpanan_sekarang_arr[] = $grand_saldo_simpanan_sekarang;   
                                  $grand_drop_arr[]                   = $grand_drop;
                                  $grand_bunga_arr[]                  = $grand_bunga;
                                  $grand_storting_arr[]               = $grand_storting;
                                  $grand_saldo_pinjaman_sekarang_arr[] = $grand_saldo_pinjaman_sekarang;



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
      $qpeg=mysqli_query($con,"select jabatan_id,pegawai_jk from tbl_pegawai ")
      ?>
      <h3>IX. RANGKUMAN PIMPINAN</h3>
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
                if(array_sum($JUMLAH_KARYAWATI_ARR)-array_sum($JUMLAH_PIMPINAN_ARR)-array_sum($JUMLAH_STAFF_ARR)<0){
                  echo 0;
                }else{
                echo  array_sum($JUMLAH_KARYAWATI_ARR)-array_sum($JUMLAH_PIMPINAN_ARR)-array_sum($JUMLAH_STAFF_ARR);
              }?>
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
                 <?php echo str_replace(",", ".", number_format($total_saldo_macet_lalu));?>
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
                 <?php echo str_replace(",", ".", number_format($total_macet_baru));?>
            </td>
        </tr>

        <?php
        $bulan_iniloh = $bulan."-01";
        $lamau = mysqli_num_rows(mysqli_query($con,"select anggota_id from tbl_anggota where tgl_daftar < '$bulan_iniloh'"));
        $baruu = mysqli_num_rows(mysqli_query($con,"select anggota_id from tbl_anggota where tgl_daftar like  '$bulan%'"));
        $keluaru = mysqli_num_rows(mysqli_query($con,"select anggota_id from tbl_anggota where tgl_keluar like '$bulan%'"));
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
                 <?php echo str_replace(",", ".", number_format($total_saldo_macet_sekarang));?>
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
                -
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
              ?
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
                Jumlah Biaya Umum
            </td>
            <td align="right">
                 <?php echo str_replace(",", ".", number_format($TOTAL_BIAYA_UMUM));?>
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
                Jumlah Kas Awal
            </td>
            <td align="right">
               <?php echo str_replace(",", ".", number_format($kas_awal));?>
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
                Setor Pusat
            </td>
            <td align="right">
                
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
                Jumlah
            </td>
            <td align="right">
                
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
                Pengembalian Bon Prive
            </td>
            <td align="right">
                0
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
                21.
            </td>
            <td>
                Pengembalian Bon Tunda
            </td>
            <td align="right">
                0
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
                 <?php echo str_replace(",", ".", number_format($total_pemasukan-$total_pengeluaran));?>
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