<?php session_start();

    //if($_SESSION['USERNAME'] != null){
      $USERNAME   = $_SESSION['USERNAME'];
      $USER_ID       = $_SESSION['USER_ID'];
      $NAMA       = $_SESSION['NAMA'];
      $LEVEL           = $_SESSION['LEVEL'];
      $bulan           = $_SESSION['BULAN'];
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
                <h5 class="card-title">Data Kas Bulanan Bulan <?php echo tanggal($bulan);?></h5>

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
                     echo "<div class='alert bg-gray'><label>Unit $unit_nama</label></div>";
                  
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

                        $q1       = mysqli_query($con,"select resort_id,resort_nama from tbl_resort where unit_id='$unit_id'");
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
                     <div class="row">
                      <div class="col-md-6">
                        <label>Pemasukan</label><br>
                        <table class="table">
                          <tr class=" bg-gray-dark">
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
                           <tr class="">
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
                            <td>4</td>
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
                      </div>
                      <div class="col-md-6">
                        <label>Pengeluaran</label><br>
                        <table class="table">
                          <tr class=" bg-gray-dark">
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
                           <tr class="">
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
                          <tr class="">
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
                            ?>
                            <tr class="">
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

                          <tr class="bg-gray-dark">
                            <td colspan="2">TOTAL PENGELUARAN</td>
                            
                            <td align="right">
                              <?php
                            $total_pengeluaran = $kasbon_pakai+$gaji_karyawan+$operasional+$akomodasi+$bon_privee+$bon_panjere+array_sum($pengeluaran_nominal_arr);
                              echo str_replace(",", ".", number_format($total_pengeluaran));
                              ?>
                            </td>
                          </tr>
                        </table>
                      </div>
                     </div>
                     <div class="alert bg-gray"><label>KAS AKHIR <?php echo str_replace(",", ".", number_format($total_pemasukan-$total_pengeluaran));?></label></div>
                  <?php 
                  //echo array_sum($tunai_grand_arr);
                } ?>
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