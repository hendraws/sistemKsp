<?php session_start();

    
      $USERNAME   = $_SESSION['USERNAME'];
      $USER_ID       = $_SESSION['USER_ID'];
      $NAMA       = $_SESSION['NAMA'];
      $LEVEL           = $_SESSION['LEVEL'];
      $bulan           = $_SESSION['BULAN'];
include   "css.php";
include   "../lib/koneksi.php";

$bulan_saldo = date('Y-m', strtotime('-1 month', strtotime($bulan)));
//echo $bulan_saldo;


?>
  
<br>
 <h2>Data Saldo simpanan Awal Bulan <?php echo tanggal($bulan);?></h2>

        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header bg-gray-dark" >
                <h5 class="card-title">Data Saldo Simpanan Awal bulan <?php echo tanggal($bulan);?></h5>

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
                  
                   <form method="POST" action="" method="POST">
                    <table id="example1" class="table table-bordered table-hover table-striped" style="width:100%">
                      <thead>
                        <tr class="bg-gray-dark">
          <td>
            Resort
          </td>
          <td>Saldo Awal Bulan</td>
       
          
        </tr>
      </thead>
        <tbody>
        <?php
        $no=1;
       $q1       = mysqli_query($con,"select resort_id,resort_nama from tbl_resort ");
                        while($h1   = mysqli_fetch_array($q1,MYSQLI_ASSOC)){
                          $resort_id = $h1['resort_id'];
                          $resort_nama = $h1['resort_nama'];


                          $qmacet = mysqli_query($con,"select * from tbl_saldo_simpanan where saldo_bulan='$bulan_saldo' and resort_id='$resort_id'");
                          $cek=mysqli_num_rows($qmacet);
                          if($cek==0){
                            mysqli_query($con,"insert into tbl_saldo_simpanan(saldo_simpanan,saldo_bulan,resort_id,minggu) values('0','$bulan_saldo','$resort_id','1')");
                            mysqli_query($con,"insert into tbl_saldo_simpanan(saldo_simpanan,saldo_bulan,resort_id,minggu) values('0','$bulan_saldo','$resort_id','2')");
                            mysqli_query($con,"insert into tbl_saldo_simpanan(saldo_simpanan,saldo_bulan,resort_id,minggu) values('0','$bulan_saldo','$resort_id','3')");
                          }else{
                            unset($saldo_id_arr);
                            unset($saldo_simpanan_arr);
                          
                          while($hmacet=mysqli_fetch_array($qmacet,MYSQLI_ASSOC)){
                            $saldo_id_arr[]   = $hmacet['saldo_id'];
                            $saldo_simpanan_arr[] = $hmacet['saldo_simpanan'];
                          
                            $grand_saldo_id_arr[]   = $hmacet['saldo_id'];
                            $grand_saldo_simpanan_arr[] = $hmacet['saldo_simpanan'];
                            
                          }
                        }
        ?>
        <tr class="bg-gray small">
                        <td colspan="5">
                          <label><?php echo $resort_nama;?></label>
                        </td>
                      </tr>
                        <tr class="small ">
                          
                              <td >
                                  Senin.Kamis
                              </td>                            
                              <td align="right">
                                <input type="hidden" name="saldo_id[]" value="<?php echo $saldo_id_arr[0];?>">
                                <input type="number" name="saldo_simpanan[]" class="form-control" value="<?php echo $saldo_simpanan_arr[0];?>">
                              </td>
                                       
                          </tr>
                          <tr class="small" bgcolor="#F5F5F5">
                              <td >
                                  Selasa.Jum'at
                              </td>
                              <td align="right">
                                <input type="hidden" name="saldo_id[]" value="<?php echo $saldo_id_arr[1];?>">
                                <input type="number" name="saldo_simpanan[]" class="form-control" value="<?php echo $saldo_simpanan_arr[1];?>">
                              </td>
                          </tr>
                          <tr class="small">
                              <td >
                                  Rabu.Sabtu
                              </td>
                              <td align="right">
                                <input type="hidden" name="saldo_id[]" value="<?php echo $saldo_id_arr[2];?>">
                                <input type="number" name="saldo_simpanan[]" class="form-control" value="<?php echo $saldo_simpanan_arr[2];?>">
                              </td>
                          </tr>
                          <tr class="small bg-gray">
                              <td >
                                  <label>Jumlah</label>
                              </td>
                              
                               <td align="right">
                                  <?php echo str_replace(",", ".", number_format(array_sum($saldo_simpanan_arr)));?>
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
                       <tr class="small bg-gray">
                              <td >
                                  <label>Jumlah Total</label>
                              </td>
                              
                               <td align="right">
                                  <?php echo str_replace(",", ".", number_format(array_sum($grand_saldo_simpanan_arr)));?>
                              </td>
                            
                              
                              
                          </tr>
                          <tr>
                            <td colspan="2" align="right">
                              <input type="submit" name="update_saldo" value="Simpan / Update data" class="btn btn-warning pull-right">
                            </td>
                          </tr>
                    </table>
                    
                  </form>
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
                                            data: "judul=Tambah Data Jabatan&tampil=jabatan_add",
                                            cache: false,
                                            success: function(msg){
                                                  $("#tampil_modal_sedang").html(msg);
                                              }
                                              });
                                      });
                                      </script>