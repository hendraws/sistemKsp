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
<table width="100%" class="table">
<tr>
<td width="50%">
                    <?php
            $qrek = mysqli_query($con,"select sum(tunai) as tunai, sum(kasbon_pakai) as kasbon_pakai from tbl_rekapitulasi where bulan='$bulan'");
                             $hrek=mysqli_fetch_array($qrek);

                              $tunai_kas = $hrek['tunai'];
                              $kasbon_pakai = $hrek['kasbon_pakai'];
                              ?>
                   
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
                             
                            //  $tunai_kas = array_sum($tunai_arr);

                              echo str_replace(",", ".", number_format($tunai_kas));
                              ?>
                            </td>
                          </tr>
                          <?php
                           $qgajie = mysqli_query($con,"SELECT sum(gaji_panjer) as panjer,sum(gaji_prive) as prive from tbl_gaji a join tbl_pegawai b on a.pegawai_id=b.pegawai_id WHERE gaji_bulan='$bulan'");
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
                          <tr class="" bgcolor="#F5F5F5">
                            <td>5</td>
                            <td>Saldo BON</td>
                            <td align="right">
                              <?php 

                 $pengembalian_bon = $pengembalian_tunda+$pengembalian_prive;
                 $qprive =mysqli_query($con,"select sum(prive_nominal) as prive_nominal from tbl_bon_prive a  where a.prive_tgl like '$bulan%'");
                 $hprive = mysqli_fetch_array($qprive);

                 $qpanjer =mysqli_query($con,"select sum(panjer_nominal) as panjer_nominal from tbl_bon_panjer a  where a.panjer_tgl like '$bulan%'");
                 $hpanjer = mysqli_fetch_array($qpanjer);

                 $bon = $hprive['prive_nominal']+$hpanjer['panjer_nominal'];
                // echo str_replace(",", ".", number_format($bon));
                // echo str_replace(",", ".", number_format($pengembalian_bon));
                 echo str_replace(",", ".", number_format($bon-$pengembalian_bon));

                 ?>
                            </td>
                          </tr>
                          <?php
                          $n=6;
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
                            $total_pemasukan = $kas_awal+$tunai_kas+$pengembalian_tunda+$pengembalian_prive+($bon-$pengembalian_bon)+array_sum($pemasukan_nominal_arr);
                              echo str_replace(",", ".", number_format($total_pemasukan));
                              ?>
                            </td>
                          </tr>
                        </table>
     	</td><td>
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
                              
                             // $kasbon_pakai_rekap = array_sum($kasbon_pakai_arr);

                              echo str_replace(",", ".", number_format($kasbon_pakai));
                              ?>
                            </td>
                          </tr>
                           <tr class="" bgcolor="#F5F5F5">
                            <td>2</td>
                            <td>Gaji Karyawan</td>
                            <td align="right">
                              <?php
                             $qgaji = mysqli_query($con,"SELECT sum(gaji_pokok+gaji_tunjangan) as gaji from tbl_gaji a join tbl_pegawai b on a.pegawai_id=b.pegawai_id WHERE gaji_bulan='$bulan'");
                             $hgaji=mysqli_fetch_array($qgaji);

                              $gaji_karyawan = $hgaji['gaji'];

                              echo str_replace(",", ".", number_format($gaji_karyawan));
                              ?>
                            </td>
                          </tr>
                           <tr class="">
                            <td>3</td>
                            <td>Biaya Umum / Operasional </td>
                            <td align="right">
                              <?php
                             $qgaji1 = mysqli_query($con,"select sum(a.nominal) as operasional from tbl_operasional a left join tbl_biayaumum b on a.bu_id=b.bu_id where a.operasional_tgl like  '$bulan%' and b.bu_kategori='0' order by a.operasional_tgl asc");
                             $hgaji1=mysqli_fetch_array($qgaji1);

                              $operasional = $hgaji1['operasional'];

                              echo str_replace(",", ".", number_format($operasional));
                              ?>
                            </td>
                          </tr>
                           <tr class="">
                            <td>4</td>
                            <td>Biaya lain - lain </td>
                            <td align="right">
                              <?php
                             $qgaji11 = mysqli_query($con,"  select a.*,b.bu_nama from tbl_operasional a left join tbl_biayaumum b on a.bu_id=b.bu_id where a.operasional_tgl like  '$bulan%' and b.bu_kategori='1' order by a.operasional_tgl asc");
                             while($hgaji11=mysqli_fetch_array($qgaji11)){
                              $lain_lain_arr[] =$hgaji11['nominal'];
                             }

                              $lain_lain = array_sum($lain_lain_arr);

                              echo str_replace(",", ".", number_format($lain_lain));
                              ?>
                            </td>
                          </tr>


                        
                          <tr class="" bgcolor="#F5F5F5">
                            <td>5</td>
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
                            <td>6</td>
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
                          $n=7;
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
                            $total_pengeluaran = $kasbon_pakai+$gaji_karyawan+$operasional+$akomodasi+$bon_privee+$bon_panjere+array_sum($pengeluaran_nominal_arr)+$lain_lain;
                              echo str_replace(",", ".", number_format($total_pengeluaran));
                              ?>
                            </td>
                          </tr>
                        </table>

                        <?php 

                       
                          $q5       = mysqli_query($con,"select total from tbl_expedisi where bulan='$bulan' ORDER BY tgl desc LIMIT 1 ");
                        $h5   = mysqli_fetch_array($q5,MYSQLI_ASSOC);
                        $total_kas_expedisi = $h5['total'];
                         
                          
                        //$kembali_kasbon = $kasbon_pagi_total-$kasbon_pakai;
                       // $biaya_lain = array_sum($nominal_lain_arr);
                      //  $bone=$bon_panjere+$bon_privee;
                       // echo "($kas_awal-$kasbon_pagi_total-$akomodasi-$operasional-$bone-$biaya_lain)+$kembali_kasbon+$tunai_kas = ";
                       // $total_kas_expedisi=($kas_awal-$kasbon_pagi_total-$akomodasi-$operasional-$bone-$biaya_lain)+$kembali_kasbon+$tunai_kas;
                      //  echo $total_kas_expedisi;



                        ?>
      </td>
    </tr>
    <tr bgcolor="gray">
      <td colspan="2">
        <h3>KAS AKHIR : <?php echo str_replace(",", ".", number_format($total_pemasukan-$total_pengeluaran));?></h3>
      </td>
    </tr>
    
  </table>
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