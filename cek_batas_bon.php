<?php session_start();

    
      $USERNAME   = $_SESSION['USERNAME'];
      $USER_ID       = $_SESSION['USER_ID'];
      $NAMA       = $_SESSION['NAMA'];
      $LEVEL           = $_SESSION['LEVEL'];
      $bulan           = $_SESSION['BULAN'];


        $pegawai_id      = $_POST['pegawai_id'];
        $tampil     = $_POST['tampil'];
        include     "lib/koneksi.php";

        $qplafon = mysqli_query($con,"SELECT bon_prive,bon_panjer from tbl_jabatan a join tbl_pegawai b on a.jabatan_id=b.jabatan_id WHERE pegawai_id='$pegawai_id' ");
        $hplafon = mysqli_fetch_array($qplafon);
        $bon_prive    = $hplafon['bon_prive'];
        $bon_panjer   = $hplafon['bon_panjer'];

        $qprive = mysqli_query($con,"SELECT sum(prive_nominal) as prive_nominal from tbl_bon_prive where pegawai_id='$pegawai_id'");
        $hprive = mysqli_fetch_array($qprive);
        $bon_prive_ambil = $hprive['prive_nominal'];


        $qpanjer = mysqli_query($con,"SELECT sum(panjer_nominal) as panjer_nominal from tbl_bon_panjer where pegawai_id='$pegawai_id'");
        $hpanjer = mysqli_fetch_array($qpanjer);
        $bon_panjer_ambil = $hpanjer['panjer_nominal'];

        $qkembali = mysqli_query($con,"SELECT sum(gaji_panjer) as gaji_panjer, sum(gaji_prive) as gaji_prive from tbl_gaji where pegawai_id='$pegawai_id'");
        $hkembali = mysqli_fetch_array($qkembali);

        $bon_panjer_kembali     = $hkembali['gaji_panjer'];
        $bon_prive_kembali      = $hkembali['gaji_prive'];

        #$bon_panjer_sisa        = "SELECT sum(panjer_nominal) as panjer_nominal from tbl_bon_panjer where pegawai_id='$pegawai_id'";

	if($bon_panjer_ambil > 0){
		$bon_panjer_sisa        = $bon_panjer-($bon_panjer_ambil-$bon_panjer_kembali);
	}else{
		$bon_panjer_sisa        = $bon_panjer;
	}
 	
	if($bon_prive_ambil > 0){
        	$bon_prive_sisa         = $bon_prive-($bon_prive_ambil-$bon_prive_kembali);
	}else{
		$bon_prive_sisa         = $bon_prive;
	}

        if($tampil=="bon_panjer"){
           echo "Kuota BON panjer : ".str_replace(",", ".", number_format($bon_panjer));
	  echo "<br>Sisa Pinjaman BON panjer Sebelumnya :  ".str_replace(",", ".", number_format($bon_panjer_ambil-$bon_panjer_kembali));
          echo "<br><strong>Bon panjer Maksimal yang bisa diambil</strong> : ".str_replace(",", ".", number_format($bon_panjer_sisa));
	  
        }else{
          echo "Bon prive Maksimal : ".str_replace(",", ".", number_format($bon_prive_sisa));
        }
        ?>