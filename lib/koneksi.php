<?php
// error_reporting(0);
date_default_timezone_set('Asia/Jakarta');
$con=mysqli_connect("localhost","hendraws","hendraws") or die("Koneksi sql akd Gagal !" );
mysqli_select_db($con,"freelance_sistem_ksp");

function umur($tgllhr){
	$tglskrg=date("Y-m-d");
	$umur=$tglskrg-$tgllhr;
	return $umur;

}
function anti($param){
	$antine=str_replace("'","`",$param);
	return $antine;
}
function jam($tgl){
	$jam=substr($tgl,11,8);
	return $jam;
}


function tanggal($tgl){
	$t=substr($tgl,8,2);
	$bln=substr($tgl,5,2);
	$thn=substr($tgl,0,4);

	if($bln=="01"){
		$bulan="Januari";
	}else if($bln=="02"){
		$bulan="Februari";
	}else if($bln=="03"){
		$bulan="Maret";
	}else if($bln=="04"){
		$bulan="April";
	}else if($bln=="05"){
		$bulan="Mei";
	}else if($bln=="06"){
		$bulan="Juni";
	}else if($bln=="07"){
		$bulan="Juli";
	}else if($bln=="08"){
		$bulan="Agustus";
	}else if($bln=="09"){
		$bulan="September";
	}else if($bln=="10"){
		$bulan="Oktober";
	}else if($bln=="11"){
		$bulan="November";
	}else if($bln=="12"){
		$bulan="Desember";
	}
	return $t." ".$bulan." ".$thn;
}
function angka($angka){
	return str_replace(",", ".", number_format($angka));
}
function hari($tgl){

	if($tgl=="Mon"){
		$bulan="Senin";
	}else if($tgl=="Tue"){
		$bulan="Selasa";
	}else if($tgl=="Wed"){
		$bulan="Rabu";
	}else if($tgl=="Thu"){
		$bulan="Kamis";
	}else if($tgl=="Fri"){
		$bulan="Jum`at";
	}else if($tgl=="Sat"){
		$bulan="Sabtu";
	}else if($tgl=="Sun"){
		$bulan="Minggu";
	}
	return $bulan;
}
function tanggal_pendek($tgl){
	$t=substr($tgl,8,2);
	$bln=substr($tgl,5,2);
	$thn=substr($tgl,2,2);

	if($bln=="01"){
		$bulan="Jan";
	}else if($bln=="02"){
		$bulan="Feb";
	}else if($bln=="03"){
		$bulan="Mar";
	}else if($bln=="04"){
		$bulan="Apr";
	}else if($bln=="05"){
		$bulan="Mei";
	}else if($bln=="06"){
		$bulan="Jun";
	}else if($bln=="07"){
		$bulan="Jul";
	}else if($bln=="08"){
		$bulan="Agu";
	}else if($bln=="09"){
		$bulan="Sep";
	}else if($bln=="10"){
		$bulan="Okt";
	}else if($bln=="11"){
		$bulan="Nov";
	}else if($bln=="12"){
		$bulan="Des";
	}
	return $t."/".$bln."/".$thn;
}
function terbilang($nilai) {
	$huruf = array("", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas");
	if($nilai==0){
            //return "Kosong";
	}elseif ($nilai < 12&$nilai!=0) {
		return "" . $huruf[$nilai];
	} elseif ($nilai < 20) {
		return Terbilang($nilai - 10) . " Belas ";
	} elseif ($nilai < 100) {
		return Terbilang($nilai / 10) . " Puluh " . Terbilang($nilai % 10);
	} elseif ($nilai < 200) {
		return " Seratus " . Terbilang($nilai - 100);
	} elseif ($nilai < 1000) {
		return Terbilang($nilai / 100) . " Ratus " . Terbilang($nilai % 100);
	} elseif ($nilai < 2000) {
		return " Seribu " . Terbilang($nilai - 1000);
	} elseif ($nilai < 1000000) {
		return Terbilang($nilai / 1000) . " Ribu " . Terbilang($nilai % 1000);
	} elseif ($nilai < 1000000000) {
		return Terbilang($nilai / 1000000) . " Juta " . Terbilang($nilai % 1000000);
	}elseif ($nilai < 1000000000000) {
		return Terbilang($nilai / 1000000000) . " Milyar " . Terbilang($nilai % 1000000000);
	}elseif ($nilai < 100000000000000) {
		return Terbilang($nilai / 1000000000000) . " Trilyun " . Terbilang($nilai % 1000000000000);
	}elseif ($nilai <= 100000000000000) {
		return "Maaf Tidak Dapat di Prose Karena Jumlah nilai Terlalu Besar ";
	}
}
function konversi($x){

	$x = abs($x);
	$angka = array ("","satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
	$temp = "";

	if($x < 12){
		$temp = " ".$angka[$x];
	}else if($x<20){
		$temp = konversi($x - 10)." belas";
	}else if ($x<100){
		$temp = konversi($x/10)." puluh". konversi($x%10);
	}else if($x<200){
		$temp = " seratus".konversi($x-100);
	}else if($x<1000){
		$temp = konversi($x/100)." ratus".konversi($x%100);   
	}else if($x<2000){
		$temp = " seribu".konversi($x-1000);
	}else if($x<1000000){
		$temp = konversi($x/1000)." ribu".konversi($x%1000);   
	}else if($x<1000000000){
		$temp = konversi($x/1000000)." juta".konversi($x%1000000);
	}else if($x<1000000000000){
		$temp = konversi($x/1000000000)." milyar".konversi($x%1000000000);
	}

	return $temp;
}

function tkoma($x){
	$str = stristr($x,",");
	$ex = explode('.',$x);

	if(($ex[1]/10) >= 1){
		$a = abs($ex[1]);
	}
	$string = array("nol", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan",   "sembilan","sepuluh", "sebelas");
	$temp = "";

	$a2 = $ex[1]/10;
	$pjg = strlen($str);
	$i =1;


	if($a>=1 && $a< 12){   
		$temp .= " ".$string[$a];
	}else if($a>12 && $a < 20){   
		$temp .= konversi($a - 10)." belas";
	}else if ($a>20 && $a<100){   
		$temp .= konversi($a / 10)." puluh". konversi($a % 10);
	}else{
		if($a2<1){

			while ($i<$pjg){     
				$char = substr($str,$i,1);     
				$i++;
				$temp .= " ".$string[$char];
			}
		}
	}  
	return $temp;
}

function terbilang1($x){
	if($x<0){
		$hasil = "minus ".trim(konversi(x));
	}else{
		$poin = trim(tkoma($x));
		$hasil = trim(konversi($x));
	}

	if($poin){
		$hasil = $hasil." koma ".$poin;
	}else{
		$hasil = $hasil;
	}
	return $hasil;  
}

?>
