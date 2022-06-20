<?php session_start();
error_reporting(0); 
include "lib/koneksi.php";
$qown 	= mysqli_query($con,"select * from tbl_owner");
$own 	= mysqli_fetch_array($qown,MYSQLI_ASSOC);
$nama_own 	= $own['nama'];
$alamat = $own['alamat'];
$gambar = $own['gambar']; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login </title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="login/images/icons/favicon.ico"/>
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login/vendor/bootstrap/css/bootstrap.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login/vendor/animate/animate.css">
	<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="login/vendor/css-hamburgers/hamburgers.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login/vendor/animsition/css/animsition.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login/vendor/select2/select2.min.css">
	<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="login/vendor/daterangepicker/daterangepicker.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login/css/util.css">
	<link rel="stylesheet" type="text/css" href="login/css/main.css">
	<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100" style="background-color: #DAD5D4;">
			<div class="wrap-login100 p-l-110 p-r-110 p-t-62 p-b-33">
				<form action="" method="post" class="login100-form validate-form flex-sb flex-w">
					
					
					<div class="row">
						<div class="col-md-12">
							<span >
								<center>
									<img src="<?php echo $gambar;?>" width="200">
								</center>
						<h3 align="center" >
						<?php echo $nama_own;?></h3>
					</span>
						</div>
						
					
					<div class="p-t-31 p-b-9">
						<span class="txt1">
						User
						</span>
					</div>
					<div class="wrap-input100 validate-input" data-validate = "Username is required">
						<input class="input100" type="text" name="username" >
						<span class="focus-input100"></span>
					</div>
					
					<div class="p-t-13 p-b-9">
						<span class="txt1">
							Password
						</span>

						
					</div>
					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<input class="input100" type="password" name="password" >
						<span class="focus-input100"></span>
					</div>
					<div class="p-t-31 p-b-9">
						<span class="txt1">
							Login Sebagai
						</span>

					</div>
					<div class="wrap-input100 " data-validate = "Login sebagai">
					<input type="radio" name="login_sebagai" value="1" checked="checked"> Admin
					<input type="radio" name="login_sebagai" value="2"> PDL
					<input type="radio" name="login_sebagai" value="3"> Kasir
					<input type="radio" name="login_sebagai" value="4"> Juru Buku
				</div>


					<div class="p-t-31 p-b-9">
						<span class="txt1">
						Bulan
						</span>
					</div>
					<div class="wrap-input100 validate-input" data-validate = "Bulan Pelaporan">
						<?php
						$m 		= date("m");
						if($m=="01"){
							$pilih1 	= "selected";
						}else if($m=="02"){
							$pilih2 	= "selected";
						}else if($m=="03"){
							$pilih3 	= "selected";
						}else if($m=="04"){
							$pilih4 	= "selected";
						}else if($m=="05"){
							$pilih5 	= "selected";
						}else if($m=="06"){
							$pilih6 	= "selected";
						}else if($m=="07"){
							$pilih7 	= "selected";
						}else if($m=="08"){
							$pilih8 	= "selected";
						}else if($m=="09"){
							$pilih9 	= "selected";
						}else if($m=="10"){
							$pilih10 	= "selected";
						}else if($m=="11"){
							$pilih11 	= "selected";
						}else if($m=="12"){
							$pilih12 	= "selected";
						} 
						?>
						<select name="bulan" class="input100">
							<option value="01" <?php echo $pilih1;?>>Januari</option>
							<option value="02" <?php echo $pilih2;?>>Februari</option>
							<option value="03" <?php echo $pilih3;?>>Maret</option>
							<option value="04" <?php echo $pilih4;?>>April</option>
							<option value="05" <?php echo $pilih5;?>>Mei</option>
							<option value="06" <?php echo $pilih6;?>>Juni</option>
							<option value="07" <?php echo $pilih7;?>>Juli</option>
							<option value="08" <?php echo $pilih8;?>>Agustus</option>
							<option value="09" <?php echo $pilih9;?>>September</option>
							<option value="10" <?php echo $pilih10;?>>Oktober</option>
							<option value="11" <?php echo $pilih11;?>>November</option>
							<option value="12" <?php echo $pilih12;?>>Desember</option>
						</select>
						<span class="focus-input100"></span>
					</div>
					<div class="p-t-13 p-b-9">
						<span class="txt1">
							Tahun
						</span>

						
					</div>
					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<select name="tahun" class="input100">
							<?php 
							$t 		= date("Y");
							for($x=$t;$x>=2021;$x--){

							
							?>
							<option value="<?php echo $x;?>"> <?php echo $x;?></option>
						<?php } ?>
							
						</select>
						<span class="focus-input100"></span>
					</div>


					<div class="container-login100-form-btn m-t-17">
						<button class="login100-form-btn">
							MASUK
						</button>
					</div>

					
				</form>
				
				<?php
				if(isset($_POST['username'])){
				   
				    $username   = str_replace("'","`",$_POST['username']);
				    $pass       = md5(str_replace("'","`",$_POST['password']));
				    var_dump($pass);
				    $bulan 		=str_replace("'","`",$_POST['tahun'])."-".str_replace("'","`",$_POST['bulan']);
				    $login_sebagai  = str_replace("'", "", $_POST['login_sebagai']);
				   
				      //  include "lib/koneksi.php";
				         $qcek=mysqli_query($con,"SELECT * from tbl_user where user_name='$username' and user_pass='$pass' and user_level='$login_sebagai'");
                        
                        $cek=mysqli_num_rows($qcek);
                        $data=mysqli_fetch_array($qcek,MYSQLI_ASSOC);
                       
                        if($cek>0){
                            
                            $_SESSION['USER_ID']           = $data['user_id'];
                            $_SESSION['USERNAME']           = $username;
                            $_SESSION['NAMA']               = $data['user_nama'];
                            $_SESSION['LEVEL']					= $data['user_level'];
                            $_SESSION['BULAN']					= $bulan;
                            $_SESSION['NAMA_OWNER']					= $nama_own;

                            $q=mysqli_query($con,"select kas_id,kas_nominal from tbl_kas_awal where kas_bulan like '$bulan%'");
							$cek=mysqli_num_rows($q);
							if($cek==0){
							?>
                            <meta http-equiv="refresh" content='0; url=/sistem_ksp/kas' />
                            <?php
							}else{
                            ?>
                            <meta http-equiv="refresh" content='0; url=index.php' />
                            <?php
                        	}
                        }else{
                            ?>
                            <br>
                            <div class="alert alert-danger">Username dan password tidak sesuai</div>
                            <?php
                        }
				        
				    
				}
				?>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
	
	<!--===============================================================================================-->
	<script src="login/vendor/jquery/jquery-3.2.1.min.js"></script>
	<!--===============================================================================================-->
	<script src="login/vendor/animsition/js/animsition.min.js"></script>
	<!--===============================================================================================-->
	<script src="login/vendor/bootstrap/js/popper.js"></script>
	<script src="login/vendor/bootstrap/js/bootstrap.min.js"></script>
	<!--===============================================================================================-->
	<script src="login/vendor/select2/select2.min.js"></script>
	<!--===============================================================================================-->
	<script src="login/vendor/daterangepicker/moment.min.js"></script>
	<script src="login/vendor/daterangepicker/daterangepicker.js"></script>
	<!--===============================================================================================-->
	<script src="login/vendor/countdowntime/countdowntime.js"></script>
	<!--===============================================================================================-->
	<script src="login/js/main.js"></script>

</body>
</html>