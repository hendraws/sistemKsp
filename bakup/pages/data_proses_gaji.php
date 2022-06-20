<?php session_start();

   
      $USERNAME   = $_SESSION['USERNAME'];
      $USER_ID       = $_SESSION['USER_ID'];
      $NAMA       = $_SESSION['NAMA'];
      $LEVEL           = $_SESSION['LEVEL'];
      $bulan           = $_SESSION['BULAN'];
//$bulan 		= date("Y-m");
include   "css.php";
include 	"../lib/koneksi.php";
	//total pegawai
	
	?>
  
<br>
 <h2>Data Bulan <?php echo tanggal($bulan);?></h2>


        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header bg-gray-dark" >
                <h5 class="card-title">Data Gaji Pegawai</h5>

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
                    
                    <table id="example1" class="table table-bordered table-hover table-striped" style="width:100%">
                      <thead>
                        <tr class="small bg-gray">
                          <th>No</th>
                          <th></th>
                          <th>NIK</th>
                          <th>Nama Pegawai</th>                           
                          <th>Jabatan</th>
                          <th>Gaji Pokok</th>
                          <th>Tunjangan</th>
                          <th>Potongan</th>
                          <th>Diterima</th>
                                                                            
                        </tr>
                      </thead>
                      <tbody>
                      	<?php 
                      	$no=1;
                        $q    = mysqli_query($con,"select a.pegawai_id,a.pegawai_nik,a.pegawai_nama,b.jabatan_nama,a.jabatan_id from tbl_pegawai a left join tbl_jabatan b on a.jabatan_id=b.jabatan_id ");
                        $total_pegawai  = mysqli_num_rows($q);
  
                      	while($h		= mysqli_fetch_array($q,MYSQLI_ASSOC)){
                          $pegawai_id     = $h['pegawai_id'];
                          $jabatan_id     = $h['jabatan_id'];
                   		?>
                       <?php 
                          //echo "select * from tbl_gaji where pegawai_id='$pegawai_id' and gaji_bulan='$bulan'";
                          $qgaji = mysqli_query($con,"select * from tbl_gaji where pegawai_id='$pegawai_id' and gaji_bulan='$bulan'");
                          $datagaji=mysqli_fetch_array($qgaji);
                          $gaji_pokok = $datagaji['gaji_pokok'];
                          $gaji_potongan = $datagaji['gaji_potongan'];
                          $gaji_tunjangan = $datagaji['gaji_tunjangan'];
                          $gaji_diterima  = $datagaji['gaji_diterima'];
                          ?>
                        <tr class="small">
                          <td><?php echo $no;?></td>
                          <td>
                            <button type="button" class="btn btn-xs btn-info" id="edit<?php echo $pegawai_id;?>"><i class="fa fa-edit"></i> Bayarkan</button>
                           <?php
                           if($gaji_pokok!=""){
                            ?>
                            <button type="button" class="btn btn-xs btn-warning" id="cetak<?php echo $pegawai_id;?>"><i class="fa fa-print"></i> Slip</button>
                            <?php
                            //echo "<span class='alert alert-success'>Gaji sudah dibayarkan</span>";
                           }else{
                            echo "<span class='btn btn-danger btn-xs'>blm dibayarkan</span>";
                           }
                           ?>                           
                          </td>    
                          <td><?php echo $h['pegawai_nik'];?></td>
                          <td><?php echo $h['pegawai_nama'];?></td>
                          <td><?php echo $h['jabatan_nama'];?></td>
                         
                          <td align="right"><?php echo str_replace(",", ".", number_format($gaji_pokok));?></td>
                          <td align="right"><?php echo str_replace(",", ".", number_format($gaji_tunjangan));?></td>
                          <td align="right"><?php echo str_replace(",", ".", number_format($gaji_potongan));?></td>
                          <td align="right"><?php echo str_replace(",", ".", number_format($gaji_diterima));?></td>
                           
                                              
                        </tr>
                        <script type="text/javascript">
                                      $("#edit<?php echo $pegawai_id;?>").click(function(){
                                        $('#modal_sedang').modal('show');
                                         $.ajax({
                                            type : 'post',
                                            url: "data_ajax.php",
                                            data: "judul=Pembayaran Gaji Pegawai&tampil=proses_gaji_add&pegawai_id=<?php echo $pegawai_id;?>&jabatan_id=<?php echo $jabatan_id;?>",
                                            cache: false,
                                            success: function(msg){
                                                  $("#tampil_modal_sedang").html(msg);
                                              }
                                              });
                                      });

                                      $("#cetak<?php echo $pegawai_id;?>").click(function(){
                                        $('#modal_sedang').modal('show');
                                         $.ajax({
                                            type : 'post',
                                            url: "data_ajax.php",
                                            data: "judul=Slip Gaji Pegawai&tampil=slip_gaji&pegawai_id=<?php echo $pegawai_id;?>&jabatan_id=<?php echo $jabatan_id;?>",
                                            cache: false,
                                            success: function(msg){
                                                  $("#tampil_modal_sedang").html(msg);
                                              }
                                              });
                                      });
                                      
                         </script>
                    <?php 
                    $no++;
                  } ?>
                      </tbody>
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
                                            data: "judul=Tambah Data Pegawai&tampil=pegawai_add",
                                            cache: false,
                                            success: function(msg){
                                                  $("#tampil_modal_sedang").html(msg);
                                              }
                                              });
                                      });
                                      </script>