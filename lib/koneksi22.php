<?php 
 
$con = mysqli_connect("localhost","hendraws","hendraws","freelance_sistem_ksp");
 
// Check connection
if (mysqli_connect_errno()){
	echo "Koneksi database gagal : " . mysqli_connect_error();
}
 
?>