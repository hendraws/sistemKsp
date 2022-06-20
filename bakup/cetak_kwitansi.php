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

 $mpdf  = new mPDF('utf-8',array(210,150),11,'calibri',15, 15, 5, 15, 8, 8);
 $mpdf->AddPage('P');
$jenis      = str_replace("'", "`", $_GET['jenis']);
$id      = str_replace("'", "`", $_GET['id']);

include "lib/koneksi.php";
$nomor = round(microtime(true) * 1000);
$qunit		= mysqli_query($con,"select unit_nama from tbl_unit");
$hunit		= mysqli_fetch_array($qunit,MYSQLI_ASSOC);
$unit_nama  = $hunit['unit_nama'];

$qown    = mysqli_query($con,"select * from tbl_owner");
  $data  = mysqli_fetch_array($qown,MYSQLI_ASSOC);
  $nama_own   = $data['nama'];
  $alamate     = $data['alamat'];
  $gambar     = $data['gambar'];
if($jenis=="akomodasi"){
$q=mysqli_query($con,"select uang_makan,uang_transport,akomodasi_tgl from tbl_akomodasi where akomodasi_id='$id'");
$data = mysqli_fetch_array($q);
$uang_makan = $data['uang_makan'];
$tgl 		= $data['akomodasi_tgl'];
$uang_transport = $data['uang_transport'];
$total 		= $uang_makan+$uang_transport;



$guna_membayar ="- Uang Makan : Rp.".number_format($uang_makan)."<br>
- Uang Transport : Rp.".number_format($uang_transport);

}
if($jenis=="bon_prive"){
	$q=mysqli_query($con,"select prive_tgl,prive_nominal,prive_ket,b.pegawai_nama from tbl_bon_prive a left join tbl_pegawai b on a.pegawai_id=b.pegawai_id where a.prive_id='$id'");
	$data = mysqli_fetch_array($q);
	$total  = $data['prive_nominal'];
	$penerima = $data['pegawai_nama'];
	$ket      = $data['prive_ket'];
	$guna_membayar = "Bon Prive atas nama $penerima ($ket)";
	$tgl = $data['prive_tgl'];
	
}
if($jenis=="bon_panjer"){
	$q=mysqli_query($con,"select panjer_tgl,panjer_nominal,panjer_ket,b.pegawai_nama from tbl_bon_panjer a left join tbl_pegawai b on a.pegawai_id=b.pegawai_id where a.panjer_id='$id'");
	$data = mysqli_fetch_array($q);
	$total  = $data['panjer_nominal'];
	$penerima = $data['pegawai_nama'];
	$ket      = $data['panjer_ket'];
	$guna_membayar = "Bon Panjer atas nama $penerima ($ket)";
	$tgl = $data['panjer_tgl'];
	
}
if($jenis=="operasional"){
	$q=mysqli_query($con,"select b.bu_nama,nominal,operasional_ket,operasional_tgl from tbl_operasional a left join tbl_biayaumum b on a.bu_id=b.bu_id where a.operasional_id='$id'");
	$data = mysqli_fetch_array($q);
	$total  = $data['nominal'];
	
	$ket      = $data['operasional_ket'];
	$bu_nama  = $data['bu_nama'];
	$guna_membayar = "Biaya Operasional $bu_nama ($ket)";
	$tgl = $data['operasional_tgl'];
	
}
?>
<table width="100%">
	<tr>
		<td>KOPERASI SIMPAN PINJAM <br><?php echo $nama_own;?> </td>>
		<td>No. <?php echo $nomor;?></td>
	</tr>
</table>
<hr>

<table width="100%">
	<tr>
		<td colspan="2" align="center">
			<h3>KWITANSI</h3>
		</td>
		
	</tr>
	<tr>
		<td width="20%">
			Sudah Terima Dari
		</td>
		<td>: <?php if($unit_nama!=""){echo "Kas Unit ".$unit_nama;}else{ echo "..................................";}?>
		</td>
	</tr>
	<tr>
		<td>
			Banyaknya Uang
		</td>
		<td>
			: Rp. <?php echo number_format($total);?>
		</td>
	</tr>
	<tr>
		<td>
			Untuk Membayar
		</td>
		<td>
			: <?php echo $guna_membayar;?>
		</td>
	</tr>
	<tr>
		<td>
			Terbilang
		</td>
		<td>
			: <?php echo terbilang($total); ?> rupiah.
		</td>
	</tr>
</table>

<table width="100%">
	<tr>
		<td align="right">
			<br>
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
		<td width="30%">
		</td>

		<td>
			<?php echo $unit_nama;?>, <?php echo tanggal($tgl);?><br>
			Penerima,
			<br>
			<br>
			<br>
			<br>
			 <?php if($penerima!=""){echo $penerima;}else{ echo "................";}?><br>
			
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