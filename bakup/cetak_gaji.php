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

include "lib/koneksi.php";
 $mpdf  = new mPDF('utf-8',array(210,150),11,'calibri',15, 15, 5, 15, 8, 8);
 $mpdf->AddPage('P');
$pegawai_id      = str_replace("'", "`", $_GET['pegawai_id']);

$qown    = mysqli_query($con,"select * from tbl_owner");
  $data  = mysqli_fetch_array($qown,MYSQLI_ASSOC);
  $nama_own   = $data['nama'];
  $alamate     = $data['alamat'];
  $gambar     = $data['gambar'];

$q=mysqli_query($con,"select a.*,b.pegawai_nama,pegawai_nik from tbl_gaji a left join tbl_pegawai b on a.pegawai_id=b.pegawai_id where a.pegawai_id='$pegawai_id' and a.gaji_bulan='$bulan'");
$datagaji=mysqli_fetch_array($q);
						$gaji_pokok = $datagaji['gaji_pokok'];
                          $gaji_potongan = $datagaji['gaji_potongan'];
                          $gaji_tunjangan = $datagaji['gaji_tunjangan'];
                          $gaji_diterima  = $datagaji['gaji_diterima'];
                          $gaji_prive    = $datagaji['gaji_prive'];
                          $gaji_panjer  = $datagaji['gaji_panjer'];
                          $gaji_lain 		= $datagaji['gaji_lain'];
                          $gaji_tabungan 		= $datagaji['gaji_tabungan'];
                          $pegawai_nama = $datagaji['pegawai_nama'];
                          $pegawai_nik = $datagaji['pegawai_nik'];
                          $gaji_jabatan       = $datagaji['gaji_jabatan'];
    $gaji_masa_kerja    = $datagaji['gaji_masa_kerja'];
    $gaji_pendidikan    = $datagaji['gaji_pendidikan'];
    $gaji_kompetensi    = $datagaji['gaji_kompetensi'];

    $qunit		= mysqli_query($con,"select unit_nama from tbl_unit");
$hunit		= mysqli_fetch_array($qunit,MYSQLI_ASSOC);
$unit_nama  = $hunit['unit_nama'];


?>
<table width="100%">
	<tr>
		<td width="70%">KOPERASI SIMPAN PINJAM <br><?php echo $nama_own;?></td>>
		<td>Bulan : <?php echo tanggal($bulan);?>
			<br>
			Nama : <?php echo $pegawai_nama;?><br>
			NIK : <?php echo $pegawai_nik;?>

		</td>
	</tr>
</table>
<hr>

<table width="100%">
	<tr>
		<td colspan="2" align="center">
			<h3>SLIP GAJI</h3>
		</td>
		
	</tr>
	<tr>
		<td width="50%">
			
			<br>
			<strong>Gaji</strong>
		</td>
		<td>
			
			<br>
			<strong>Potongan</strong>
		</td>
	</tr>
	<tr valign="top">
		<td>
			<table width="100%">
				<tr>
					<td>
						- Gaji Pokok
					</td>
					<td align="right">
						<?php echo str_replace(",", ".", number_format($gaji_pokok));?>
					</td>
				</tr>
				<tr>
					<td>
						- Tunjangan Jabatan
					</td>
					<td align="right">
						<?php echo str_replace(",", ".", number_format($gaji_jabatan));?>
					</td>
				</tr>
				<tr>
					<td>
						- Tunjangan Masa Kerja
					</td>
					<td align="right">
						<?php echo str_replace(",", ".", number_format($gaji_masa_kerja));?>
					</td>
				</tr>
				<tr>
					<td>
						- Tunjangan Pendidikan
					</td>
					<td align="right">
						<?php echo str_replace(",", ".", number_format($gaji_pendidikan));?>
					</td>
				</tr>
				<tr>
					<td>
						- Tunjangan Kompetensi
					</td>
					<td align="right">
						<?php echo str_replace(",", ".", number_format($gaji_kompetensi));?>
					</td>
				</tr>
			</table>
		</td>
		<td>
			<table width="100%">
				<tr valign="top">
					<td>
						- Bon Prive
					</td>
					<td align="right">
						<?php echo str_replace(",", ".", number_format($gaji_prive));?>
					</td>
				</tr>
				<tr>
					<td>
						- Bon Panjer
					</td>
					<td align="right">
						<?php echo str_replace(",", ".", number_format($gaji_panjer));?>
					</td>
				</tr>
				<tr>
					<td>
						- Tabungan
					</td>
					<td align="right">
						<?php echo str_replace(",", ".", number_format($gaji_tabungan));?>
					</td>
				</tr>
				<tr>
					<td>
						- Lain-lain
					</td>
					<td align="right">
						<?php echo str_replace(",", ".", number_format($gaji_lain));?>
					</td>
				</tr>
			</table>
			
		</td>
	</tr>
	<tr>
		<td align="right">
			<hr>
			<?php echo str_replace(",", ".", number_format($gaji_pokok+$gaji_tunjangan));?>
		</td>
		<td align="right">
			<hr>
			<?php echo str_replace(",", ".", number_format($gaji_potongan));?>
		</td>
	</tr>
	<tr>
		<td>
			<br>
			
			<strong>Gaji Diterima</strong>
		</td>
		<td>
			<br>
			
			<strong>
			<?php echo str_replace(",", ".", number_format($gaji_diterima));?><br></strong>
			<i><?php echo terbilang($gaji_diterima);?></i>
		</td>
	</tr>
</table>

<table width="100%">
	<tr>
		<td align="right" width="70%">
			
			
		</td>
		

		<td>
			<?php echo $unit_nama;?>, <?php echo tanggal(date("Y-m-d"));?><br>
			
			Kasir,
			<br>
			<br>
			<br>
			<br>
			<?php
			$qkasir = mysqli_query($con,"select pegawai_nama,pegawai_nik from tbl_pegawai where jabatan_id='7'");
			$datakasir = mysqli_fetch_array($qkasir);
			$kasir 	= $datakasir['pegawai_nama'];
			$nik 	= $datakasir['pegawai_nik']; 
			echo "$kasir<br>NIK. $nik";
			?>
			
		</td>
	</tr>
</table>
<?php
$tahun=date("Y");
$mpdf->SetDisplayMode(100);
$mpdf->SetFooter('Koperasi Simpan Pinjam'.'|| &nbsp; &nbsp;{PAGENO}');
//$mpdf->SetHeader('<img src="images/kop.png">');
$html = ob_get_contents();
ob_end_clean();

$mpdf->WriteHTML(utf8_encode($html));
$mpdf->Output("Kwitansi".date('d-m-Y H:i:s').".pdf" ,'I');
}
?>