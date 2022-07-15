<?php session_start();

    
      $USERNAME   = $_SESSION['USERNAME'];
      $USER_ID       = $_SESSION['USER_ID'];
      $NAMA       = $_SESSION['NAMA'];
      $LEVEL           = $_SESSION['LEVEL'];
      $bulan           = $_SESSION['BULAN'];
      $cabang           = $_SESSION['CABANG'];
include   "css.php";
include 	"../lib/koneksi.php";
	//total inven
	$q		= mysqli_query($con,"select * from tbl_pemasukan where bulan ='$bulan' and cabang = '$cabang'");
	$total 	= mysqli_num_rows($q);
	
	?>
  
<br>
 <h2>Data Bulan <?php echo tanggal($bulan);?></h2>

        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header bg-gray-dark" >
                <h5 class="card-title">Data Pemasukan Lain</h5>

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
                    <button id="tambah" class="btn btn-sm btn-info" type="button">Tambah Data</button><br><br>
                    <table id="example1" class="table table-bordered table-hover table-striped" style="width:100%">
                      <thead>
                        <tr class="small bg-gray">   
                        <th>No</th>                        
                          <th></th>   
                          
                          <th>Nama Pemasukan</th>
                          <th>Tgl Input</th>
                          <th>Nominal</th>
                                                                       
                        </tr>
                      </thead>
                      <tbody>
                      	<?php 
                      	$no=1;
                      	while($h		= mysqli_fetch_array($q,MYSQLI_ASSOC)){
                          $pemasukan_id     = $h['pemasukan_id'];
                          $nominal_arr[]=$h['nominal'];
                   		?>
                        <tr class="small">
                          <td><?php echo $no;?></td>
                           <td>
                            <button type="button" class="btn btn-xs btn-info" id="edit<?php echo $pemasukan_id;?>"><i class="fa fa-edit"></i> edit</button>
                            <button type="button" class="btn btn-danger btn-xs" id="hapus<?php echo $pemasukan_id;?>"><i class="fa fa-trash"></i> hapus</button>                        
                          </td>  
                          
                          <td><?php echo $h['pemasukan'];?></td>                          
                          <td><?php echo tanggal($h['tgl_input']);?></td>
                          <td align="right"><?php echo str_replace(",", ".", number_format($h['nominal']));?></td>                       
                                               
                        </tr>
                        <script type="text/javascript">
                                      $("#edit<?php echo $pemasukan_id;?>").click(function(){
                                        $('#modal_sedang').modal('show');
                                         $.ajax({
                                            type : 'post',
                                            url: "data_ajax.php",
                                            data: "judul=Edit Data Pemasukan&tampil=pemasukan_add&pemasukan_id=<?php echo $pemasukan_id;?>",
                                            cache: false,
                                            success: function(msg){
                                                  $("#tampil_modal_sedang").html(msg);
                                              }
                                              });
                                      });
                                      $("#hapus<?php echo $pemasukan_id;?>").click(function(){
                                        $('#modal_kecil').modal('show');
                                         $.ajax({
                                            type : 'post',
                                            url: "data_ajax.php",
                                            data: "judul=Data Pemasukan yakin dihapus?&tampil=pemasukan_del&pemasukan_id=<?php echo $pemasukan_id;?>",
                                            cache: false,
                                            success: function(msg){
                                                  $("#tampil_modal_kecil").html(msg);
                                              }
                                              });
                                      });
                         </script>
                    <?php 
                    $no++;
                  } ?>
                      </tbody>
                      <tfoot>
                        <tr class="small bg-gray">   
                        <td colspan="4">Total</td>                        
                         <td align="right"><?php echo str_replace(",", ".", number_format(array_sum($nominal_arr)));?></td>                            
                        </tr>
                      </tfoot>
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
                                            data: "judul=Tambah Data Pemasukan&tampil=pemasukan_add",
                                            cache: false,
                                            success: function(msg){
                                                  $("#tampil_modal_sedang").html(msg);
                                              }
                                              });
                                      });
                                      </script>