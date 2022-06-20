<?php session_start();

   
      $USERNAME   = $_SESSION['USERNAME'];
      $USER_ID       = $_SESSION['USER_ID'];
      $NAMA       = $_SESSION['NAMA'];
      $LEVEL           = $_SESSION['LEVEL'];
      $bulan           = $_SESSION['BULAN'];
//$bulan 		= date("Y-m");
include   "css.php";
include 	"../lib/koneksi.php";
	//total inven
	$q		= mysqli_query($con,"select * from tbl_unit");
	$total 	= mysqli_num_rows($q);


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
                     $qunit = mysqli_query($con,"select unit_id,unit_nama from tbl_unit");
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
				   $pemisah = 1;

                        $q1       = mysqli_query($con,"select resort_id,resort_nama from tbl_resort where unit_id='$unit_id' order by resort_id asc");
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

                          $q=mysqli_query($con,"SELECT pembukuan_drop,storting,psp,kasbon_pagi,pembukuan_tgl,L,B,K from tbl_pembukuan_harian where pembukuan_tgl like '$bulan%' and resort_id='$resort_id'");
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
                              // $jum_anggota_lama1 = mysqli_num_rows(mysqli_query($con,"select anggota_id from tbl_anggota where resort_id='$resort_id' and tgl_daftar < '$pembukuan_tgl'"));
                              //$jum_anggota_baru1 = mysqli_num_rows(mysqli_query($con,"select anggota_id from tbl_anggota where resort_id='$resort_id' and tgl_daftar = '$pembukuan_tgl'"));
                              //$jum_anggota_keluar1 = mysqli_num_rows(mysqli_query($con,"select anggota_id from tbl_anggota where resort_id='$resort_id' and tgl_keluar = '$pembukuan_tgl'"));
                              $jum_anggota_lama1[]    = $h['L'];
                              $jum_anggota_baru1[]    = $h['B'];
                              $jum_anggota_keluar1[]  = $h['K'];
                              $jum_anggota_kini1[]     = ($h['L']+$h['B'])-$h['K'];
                            }
                            if($day=="Tue" or $day=="Fri"){
                              //selasa - jum'at
                              $drop2_arr[]  = $h['pembukuan_drop'];
                              $storting2_arr[] = $h['storting'];
                              $psp2_arr[]     = $h['psp'];
                              $kasbon_pagi2_arr[] = $h['kasbon_pagi'];
                              // $jum_anggota_lama2 = mysqli_num_rows(mysqli_query($con,"select anggota_id from tbl_anggota where resort_id='$resort_id' and tgl_daftar < '$pembukuan_tgl'"));
                              //$jum_anggota_baru2 = mysqli_num_rows(mysqli_query($con,"select anggota_id from tbl_anggota where resort_id='$resort_id' and tgl_daftar = '$pembukuan_tgl'"));
                              //$jum_anggota_keluar2 = mysqli_num_rows(mysqli_query($con,"select anggota_id from tbl_anggota where resort_id='$resort_id' and tgl_keluar = '$pembukuan_tgl'"));
                               $jum_anggota_lama2[]    = $h['L'];
                              $jum_anggota_baru2[]    = $h['B'];
                              $jum_anggota_keluar2[]  = $h['K'];
                              $jum_anggota_kini2[]     = ($h['L']+$h['B'])-$h['K'];
                            }
                            if($day=="Wed" or $day=="Sat"){
                              // rabu  sabtu
                              $drop3_arr[]  = $h['pembukuan_drop'];
                              $storting3_arr[] = $h['storting'];
                              $psp3_arr[]     = $h['psp'];
                              $kasbon_pagi3_arr[] = $h['kasbon_pagi'];
                               //$jum_anggota_lama3 = mysqli_num_rows(mysqli_query($con,"select anggota_id from tbl_anggota where resort_id='$resort_id' and tgl_daftar < '$pembukuan_tgl'"));
                              //$jum_anggota_baru3 = mysqli_num_rows(mysqli_query($con,"select anggota_id from tbl_anggota where resort_id='$resort_id' and tgl_daftar = '$pembukuan_tgl'"));
                              //$jum_anggota_keluar3 = mysqli_num_rows(mysqli_query($con,"select anggota_id from tbl_anggota where resort_id='$resort_id' and tgl_keluar = '$pembukuan_tgl'"));
                               $jum_anggota_lama3[]    = $h['L'];
                              $jum_anggota_baru3[]    = $h['B'];
                              $jum_anggota_keluar3[]  = $h['K'];
                              $jum_anggota_kini3[]     = ($h['L']+$h['B'])-$h['K'];
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
                          $debet_tanpa_kasbon   = $storting+$adm5persen+$simp4persen;
                          $tunai                = $debet_tanpa_kasbon-$kredit;
                          
                          if($tunai<0){
                            $tunai              = 0;
                          }else{
                            $tunai              = $tunai1;
                          }
                          
                          $kasbon_pakai         = $kredit-$debet_tanpa_kasbon;
                          if($kasbon_pakai<0){
                            $kasbon_pakai              = 0;
                          }else{
                            $kasbon_pakai              = $kasbon_pakai;
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
                          <tr class="small">
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
                          <tr class="small bg-gray">
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
					$no++;
					
					if($no==5){
						$no=1;
					}
                      } ?>
                      </tbody>
				<tfoot>
					<tr class="small bg-gray-dark">
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