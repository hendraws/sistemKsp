<?php session_start();

   
      $USERNAME   = $_SESSION['USERNAME'];
      $USER_ID       = $_SESSION['USER_ID'];
      $NAMA       = $_SESSION['NAMA'];
      $LEVEL           = $_SESSION['LEVEL'];
      $bulan           = $_SESSION['BULAN'];
//$bulan    = date("Y-m");

include   "css.php";
include 	"../lib/koneksi.php";
$resort_id    = $_POST['resort_id'];
	
?>
<br>
 <h2>Data Bulan <?php echo tanggal($bulan);?></h2>




        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header bg-gray-dark" >
                <h5 class="card-title">Data Anggota Saat Ini</h5>

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
                  	<input type="text" id="resort_id" value="<?php echo $resort_id;?>" style="display: none">
				<?php if($resort_id!=""){?>
                  	 <button id="tambah_anggota" class="btn btn-sm btn-info" type="button">Tambah Data</button><br><br>
				<?php } ?>
                    <table id="example1" class="table table-bordered table-hover" style="width:100%">
                      <thead>
                        <tr class="small bg-gray">
                          <th>No</th>
                          <th>Nama Anggota</th>
                          <th>Alamat</th>
                          <th>Tgl Daftar</th>
                          <th>Status</th> 
                         
                          <th></th>                      
                        </tr>
                      </thead>
                      <tbody>
                      	<?php 
                        //aktif
  $q2   = mysqli_query($con,"select anggota_id,anggota_nama,anggota_alamat,tgl_daftar,keterangan,pinjaman_awal,simpanan_awal from tbl_anggota where resort_id like '$resort_id%'");
  $anggota_aktif  = mysqli_num_rows($q2);
                      	$no=1;
                      	while($haktif		= mysqli_fetch_array($q2,MYSQLI_ASSOC)){
                      		$anggota_id 	= $haktif['anggota_id'];
						$tglll = strtotime($haktif['tgl_daftar']);
                   		?>
                        <tr class="small">
                          <td><?php echo $no;?></td>
                          <td><?php echo $haktif['anggota_nama'];?></td>
                          <td><?php echo $haktif['anggota_alamat'];?></td>
                          <td><?php echo hari(date('D',$tglll));?>, <?php echo tanggal($haktif['tgl_daftar']);?> </td>
                          <td><?php echo $haktif['keterangan'];?></td>
                          
                         <td>
                          
                            <button type="button" class="btn btn-xs btn-info" id="edit<?php echo $no;?>"><i class="fa fa-edit"></i> edit</button>
                            <button type="button" class="btn btn-danger btn-xs" id="hapus<?php echo $no;?>"><i class="fa fa-trash"></i> hapus</button>                           
                          </td>    
                        </tr>
                        <script type="text/javascript">
                                      $("#edit<?php echo $no;?>").click(function(){
                                        $('#modal_sedang').modal('show');
                                         $.ajax({
                                            type : 'post',
                                            url: "data_ajax.php",
                                            data: "judul=Edit Anggota&tampil=tambah_anggota&anggota_id=<?php echo $anggota_id;?>",
                                            cache: false,
                                            success: function(msg){
                                                  $("#tampil_modal_sedang").html(msg);
                                              }
                                              });
                                      });
                                      $("#hapus<?php echo $no;?>").click(function(){
                                        $('#modal_kecil').modal('show');
                                         $.ajax({
                                            type : 'post',
                                            url: "data_ajax.php",
                                            data: "judul=Anggota yakin dihapus?&tampil=hapus_anggota&anggota_id=<?php echo $anggota_id;?>",
                                            cache: false,
                                            success: function(msg){
                                                  $("#tampil_modal_kecil").html(msg);
                                              }
                                              });
                                      });
                         </script>
                    <?php $no++;} ?>
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
        
        </div>
        <!-- /.row -->
        <div class="modal fade" id="modal">
            <div class="modal-dialog modal">
              <div id="tampil_modal">Mohon Tunggu..</div>
            </div>
        </div>
        <?php
        include "js.php";
        ?>
        <script type="text/javascript">
                                  /* tambah anggota --------------------------- */
                                      $("#tambah_anggota").click(function(){
                                        $('#modal_sedang').modal('show');
                                          $("#tampil_modal").html("<center><br><br><img src='loader.gif' width='150'></center>");                                     
                                            var resort_id = $("#resort_id").val();               
                                            $.ajax({
                                                 type : 'post',
                                            url: "data_ajax.php",
                                            data: "judul=Input Anggota&tampil=tambah_anggota&resort_id="+resort_id,
                                            cache: false,
                                            success: function(msg){
                                                  $("#tampil_modal_sedang").html(msg);
                                              }
                                              });
                                      });
                                  </script>
        