<?php session_start();
error_reporting(0);

    
      $USERNAME   = $_SESSION['USERNAME'];
      $USER_ID       = $_SESSION['USER_ID'];
      $NAMA       = $_SESSION['NAMA'];
      $LEVEL           = $_SESSION['LEVEL'];
      $bulan           = $_SESSION['BULAN'];
//$bulan 		= date("Y-m");
include   "css.php";
include 	"../lib/koneksi.php";
	//total inven
	$q		= mysqli_query($con,"select a.*,b.pegawai_nama from tbl_inventaris a left join tbl_pegawai b on a.pegawai_id=b.pegawai_id");
	$total 	= mysqli_num_rows($q);
	
	?>
  
<br>
 <h2>Data Bulan <?php echo tanggal($bulan);?></h2>

<div class="row">
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box bg-gray">
              <span class="info-box-icon"><i class="far fa-envelope"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Inventaris</span>
                <span class="info-box-number"><?php echo angka($total);?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          
          
        </div>

        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header bg-gray-dark" >
                <h5 class="card-title">Data Invetaris</h5>

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
                          <th>Nama Inventaris</th>
                          <th>Nomor Polisi</th>
                          <th>Nama STNK</th>
                          <th>Tempo</th> 
                          <th>Transport</th>
                          <th>Pemegang</th>
                          <th></th>                                                  
                        </tr>
                      </thead>
                      <tbody>
                      	<?php 
                      	$no=1;
                      	while($h		= mysqli_fetch_array($q,MYSQLI_ASSOC)){
                          $inven_id     = $h['inven_id'];
                   		?>
                        <tr class="small">
                          <td><?php echo $no;?></td>
                          <td><?php echo $h['inven_nama'];?></td>
                          <td><?php echo $h['inven_nopol'];?></td>
                          <td><?php echo $h['inven_stnk'];?></td>
                          <td><?php echo tanggal($h['inven_tempo']);?></td>
                          <td><?php echo $h['inven_transport'];?></td>
                          <td><?php echo $h['pegawai_nama'];?></td>  
                          <td>
                            <button type="button" class="btn btn-xs btn-info" id="edit<?php echo $inven_id;?>"><i class="fa fa-edit"></i> edit</button>
                            <button type="button" class="btn btn-danger btn-xs" id="hapus<?php echo $inven_id;?>"><i class="fa fa-trash"></i> hapus</button>                           
                          </td>                        
                        </tr>
                        <script type="text/javascript">
                                      $("#edit<?php echo $inven_id;?>").click(function(){
                                        $('#modal_sedang').modal('show');
                                         $.ajax({
                                            type : 'post',
                                            url: "data_ajax.php",
                                            data: "judul=Edit Data Inventaris&tampil=inventaris_add&inven_id=<?php echo $inven_id;?>",
                                            cache: false,
                                            success: function(msg){
                                                  $("#tampil_modal_sedang").html(msg);
                                              }
                                              });
                                      });
                                      $("#hapus<?php echo $inven_id;?>").click(function(){
                                        $('#modal_kecil').modal('show');
                                         $.ajax({
                                            type : 'post',
                                            url: "data_ajax.php",
                                            data: "judul=Data Inventaris yakin dihapus?&tampil=inventaris_del&inven_id=<?php echo $inven_id;?>",
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
                                            data: "judul=Tambah Data Inventaris&tampil=inventaris_add",
                                            cache: false,
                                            success: function(msg){
                                                  $("#tampil_modal_sedang").html(msg);
                                              }
                                              });
                                      });
                                      </script>