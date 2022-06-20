<?php session_start();
error_reporting(0);

    
      $USERNAME   = $_SESSION['USERNAME'];
      $USER_ID       = $_SESSION['USER_ID'];
      $NAMA       = $_SESSION['NAMA'];
      $LEVEL           = $_SESSION['LEVEL'];
      $bulan           = $_SESSION['BULAN'];
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
                <h5 class="card-title">Data Unit Bulan <?php echo tanggal($bulan);?></h5>

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
                     <button id="tambah" class="btn btn-sm btn-info" type="button">Tambah Data</button><br><br>
                   -->
                    <table id="example1" class="table table-bordered table-hover table-striped" style="width:100%">
                      <thead>
                        <tr class="small bg-gray">
                          <th>No</th>
                          <th>Unit</th>
                         
                          
                          <th></th>                                                  
                        </tr>
                      </thead>
                      <tbody>
                      	<?php 
                      	$no=1;
                      	while($h		= mysqli_fetch_array($q,MYSQLI_ASSOC)){
                          $unit_id     = $h['unit_id'];
                   		?>
                        <tr class="small">
                          
                          <td><?php echo $no;?></td>
                          <td><?php echo $h['unit_nama'];?></td>
                        
                          
                          <td>
                            <button type="button" class="btn btn-xs btn-info" id="edit<?php echo $unit_id;?>"><i class="fa fa-edit"></i> edit</button>
                            <!--
                            <button type="button" class="btn btn-danger btn-xs" id="hapus<?php echo $unit_id;?>"><i class="fa fa-trash"></i> hapus</button>
                            -->                           
                          </td>                        
                        </tr>
                        <script type="text/javascript">
                                      $("#edit<?php echo $unit_id;?>").click(function(){
                                        $('#modal_sedang').modal('show');
                                         $.ajax({
                                            type : 'post',
                                            url: "data_ajax.php",
                                            data: "judul=Edit Data Unit&tampil=unit_add&unit_id=<?php echo $unit_id;?>",
                                            cache: false,
                                            success: function(msg){
                                                  $("#tampil_modal_sedang").html(msg);
                                              }
                                              });
                                      });
                                      $("#hapus<?php echo $unit_id;?>").click(function(){
                                        $('#modal_kecil').modal('show');
                                         $.ajax({
                                            type : 'post',
                                            url: "data_ajax.php",
                                            data: "judul=Data Unit yakin dihapus?&tampil=unit_del&unit_id=<?php echo $unit_id;?>",
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