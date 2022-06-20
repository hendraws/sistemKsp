<?php session_start();
error_reporting(0);

    
      $USERNAME   = $_SESSION['USERNAME'];
      $USER_ID       = $_SESSION['USER_ID'];
      $NAMA       = $_SESSION['NAMA'];
      $LEVEL           = $_SESSION['LEVEL'];
      $bulan           = $_SESSION['BULAN'];

      $pdl_resort_id    = $_POST['pdl_resort_id'];
      $pdl_tgl          = $_POST['pdl_tgl'];
      $tab              = $_POST['tab'];

include   "css.php";
include   "../lib/koneksi.php"; 
///kas awal


if($tab=="1"){
  $tab_aktif1   = "active";
}else if($tab=="2"){
  $tab_aktif2   = "active";
}else{
$tab_aktif1     = "active";
  }
  ?>

<br>
 <div class="row">
  <div class="col-md-12">
    <div class="card card-primary card-tabs">
              <div class="card-header p-0 pt-1 bg-gray-dark">
                <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link <?php echo $tab_aktif1;?>" id="pembukuan-harian-tab" data-toggle="pill" href="#pembukuan-harian" role="tab" aria-controls="pembukuan-harian" aria-selected="true">Simpanan</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link <?php echo $tab_aktif2;?>" id="akomodasi-tab" data-toggle="pill" href="#akomodasi" role="tab" aria-controls="akomodasi" aria-selected="false">Pinjaman</a>
                  </li>
                  
                </ul>
              </div>
              <div class="card-body">
                <div class="tab-content" id="custom-tabs-one-tabContent">
                  <div class="tab-pane fade show <?php echo $tab_aktif1;?>" id="pembukuan-harian" role="tabpanel" aria-labelledby="pembukuan-harian-tab">
                    
                    <!-- The time line -->
            <div class="timeline">

                   
                  <!-- timeline time label -->
              <div class="time-label">
                <span class="bg-gray-dark">Tanggal : <?php echo tanggal($pdl_tgl);?></span>
              </div>
              <!-- /.timeline-label -->
              <!-- timeline item -->
              <div>
                <i class="fas fa-clock bg-gray"></i>
                <div class="timeline-item">
                  <span class="time"><i class="fas fa-clock-"></i> </span>
                  <h3 class="timeline-header"><a href="#"></a> </h3>

                  <div class="timeline-body">
                      <table  class="table table-bordered table-hover table-striped" style="width:100%">
                      <thead>
                        <tr class="small bg-gray">
                          <th>No</th>
                         
                          <th>Resort</th>
                          <th>Nama</th>
                          <th>Alamat</th>
                          <th>Pinjaman ke-</th>
                          <th>Pinjaman</th>
                          <th>PSP</th>
                          <th>Jumlah</th>
                          <th>
                          </th> 
                          <th>
                          </th>                                                  
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                       
                        
                        $q1       = mysqli_query($con,"select resort_id,resort_nama from tbl_resort where resort_id like '$pdl_resort_id%'");

                        while($h1   = mysqli_fetch_array($q1,MYSQLI_ASSOC)){
                          $resort_id    = $h1['resort_id'];
                          $resort_nama  = $h1['resort_nama'];
                          $resort_id_arr[] = $resort_id;
                          $resort_nama_arr[]= $resort_nama;
                          $no=1;
                        unset($pinjaman_arr);
                        unset($psp_arr);
                          $q2     = mysqli_query($con,"SELECT a.validasi,a.simpanan_id,b.anggota_id,b.anggota_nama,b.anggota_alamat,a.pinjaman_ke,a.pinjaman,a.psp from tbl_simpanan a LEFT JOIN tbl_anggota b on a.anggota_id=b.anggota_id where a.resort_id='$resort_id' and a.simpanan_tgl='$pdl_tgl'");
                          while ($h2=mysqli_fetch_array($q2,MYSQLI_ASSOC)) {
                            $pinjaman_arr[]     = $h2['pinjaman'];
                            $psp_arr[]          = $h2['psp'];
                            $simpanan_id        = $h2['simpanan_id'];
                            $validasi           = $h2['validasi'];
                            if($validasi=="1"){
                              $ceked  = "checked";
                            }else{
                              $ceked  = "";
                            }
                            # code...
                          
                      ?>
                        <tr class="small">
                          <td><?php echo $no;?></td>
                          
                          <td><?php echo $resort_nama;?></td>
                          <td align="right"><?php echo $h2['anggota_nama'];?></td>
                          <td align="right"><?php echo $h2['anggota_alamat'];?></td>
                          <td align="right"><?php echo $h2['pinjaman_ke'];?></td>
                          <td align="right"><?php echo str_replace(",",".",number_format($h2['pinjaman']));?></td>
                          <td align="right"><?php echo str_replace(",",".",number_format($h2['psp']));?></td>
                          <td></td>
                          <td>
                            <button type="button" class="btn btn-xs btn-info" id="edit<?php echo $simpanan_id;?>"><i class="fa fa-edit"></i> edit</button>
                            <button type="button" class="btn btn-danger btn-xs" id="hapus<?php echo $simpanan_id;?>"><i class="fa fa-trash"></i> hapus</button> 
                          </td>
                          <td>
                            <input type="checkbox" id="validasi<?php echo $simpanan_id;?>" <?php echo $ceked;?>>
                            <label>Validasi</label>
                          </td>                        
                        </tr>
                        <script type="text/javascript">
                                      $("#edit<?php echo $simpanan_id;?>").click(function(){
                                        $('#modal_sedang').modal('show');
                                        $("#tampil_modal_sedang").html("<center><br><br><img src='loader.gif' width='150'></center>"); 
                                         $.ajax({
                                            type : 'post',
                                            url: "data_ajax.php",
                                            data: "judul=Edit Data Simpanan&tampil=tambah_simpananjurubuku&simpanan_id=<?php echo $simpanan_id;?>",
                                            cache: false,
                                            success: function(msg){
                                                  $("#tampil_modal_sedang").html(msg);
                                              }
                                              });
                                      });
                                      $("#hapus<?php echo $simpanan_id;?>").click(function(){
                                        $('#modal_kecil').modal('show');
                                        $("#tampil_modal_kecil").html("<center><br><br><img src='loader.gif' width='150'></center>"); 
                                         $.ajax({
                                            type : 'post',
                                            url: "data_ajax.php",
                                            data: "judul=Simpanan yakin dihapus?&tampil=hapus_simpananjurubuku&simpanan_id=<?php echo $simpanan_id;?>",
                                            cache: false,
                                            success: function(msg){
                                                  $("#tampil_modal_kecil").html(msg);
                                              }
                                              });
                                      });

                                      $("#validasi<?php echo $simpanan_id;?>").click(function(){

                                       
                                        var cekbox = document.getElementById("validasi<?php echo $simpanan_id;?>");
                                        if(cekbox.checked==true){
                                          var valid="1";
                                        }else{
                                          var valid="0";
                                        }
                                        
                                         $.ajax({
                                            type : 'post',
                                            url: "data_ajax.php",
                                            data: "tampil=validasi_simpanan_jurubuku&simpanan_id=<?php echo $simpanan_id;?>&validasi="+valid,
                                            cache: false,
                                            success: function(msg){
                                                  
                                              }
                                           
                                              });                                       
                                        
                                      });
                         </script>
                      <?php $no++;} ?>
                      <tr class="small bg-light">
                        <td colspan="5">Total Resort <?php echo $resort_nama;?></td>
                        <td align="right"><?php echo str_replace(",",".",number_format(array_sum($pinjaman_arr)));?></td>
                        <td align="right"><?php echo str_replace(",",".",number_format(array_sum($psp_arr)));?></td>
                        <td align="right"><?php echo str_replace(",",".",number_format(array_sum($psp_arr)));?></td>
                        <td></td>
                        <td></td>
                      </tr>
                    <?php 
                    $pinjaman_total_arr[]       = array_sum($pinjaman_arr);
                    $psp_total_arr[]            = array_sum($psp_arr);
                    } ?>
                      </tbody>
                      <tfoot>
                        <tr class="small bg-gray">
                          <td colspan="5"><label>Total</label></td>
                          
                          
                          <td align="right"><?php echo str_replace(",",".",number_format(array_sum($pinjaman_total_arr)));?></td>
                          <td align="right"><?php echo str_replace(",",".",number_format(array_sum($psp_total_arr)));?></td>
                          <td align="right"><?php echo str_replace(",",".",number_format(array_sum($psp_total_arr)));?></td>
                           <td></td>
                           <td></td>
                        </tr>
                      </tfoot>
                    </table> 
                    
                  </div>     
                  <!-- --end body timeline -->             
                </div>
              </div>
              <!-- END timeline item -->
                    
                       
                        
                    </div>
                    <!--- end timeline -->       
                  </div>
                  <div class="tab-pane fade show <?php echo $tab_aktif2;?>" id="akomodasi" role="tabpanel" aria-labelledby="akomodasi-tab">

                    <!-- The time line -->
            <div class="timeline">

                   
                  <!-- timeline time label -->
              <div class="time-label">
                <span class="bg-gray-dark">Tanggal : <?php echo tanggal($pdl_tgl);?></span>
              </div>
              <!-- /.timeline-label -->
              <!-- timeline item -->
              <div>
                <i class="fas fa-clock bg-gray"></i>
                <div class="timeline-item">
                  <span class="time"><i class="fas fa-clock-"></i> </span>
                  <h3 class="timeline-header"><a href="#"></a> </h3>

                  <div class="timeline-body">
                    <table id="example2" class="table table-bordered table-hover table-striped" style="width:100%">
                      <thead>
                        <tr class="small bg-gray">
                          <th>No</th>
                          <th>Resort</th>
                          <th>Nama</th>
                          <th>Alamat</th>
                          
                          <th>Pinjaman_ke</th>
                          <th>B/P</th>
                          <th>20%</th>
                          <th>Jumlah</th>
                          <th>simp 4%</th>
                          <th>Total Drop</th>
                          <th></th>    
                          <th></th>                                              
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                        $no=1;
                        $jum = count($resort_id_arr);
                        for($x=0;$x<$jum;$x++){
                          $resort_id  = $resort_id_arr[$x];
                          $resort_nama = $resort_nama_arr[$x];
                          unset($bp_arr);
                          unset($duapuluh_arr);
                          unset($jumlah_pinjaman_arr);
                          unset($empat_arr);

                       $q3     = mysqli_query($con,"SELECT a.validasi,a.pinjaman_id,b.anggota_id,b.anggota_nama,b.anggota_alamat,a.pinjaman_ke,a.bp from tbl_pinjaman a LEFT JOIN tbl_anggota b on a.anggota_id=b.anggota_id where a.resort_id='$resort_id' and a.pinjaman_tgl='$pdl_tgl'");
                          while ($h3=mysqli_fetch_array($q3,MYSQLI_ASSOC)) {
                            $pinjaman_id      = $h3['pinjaman_id'];
                            $bp_arr[]         = $h3['bp'];
                            $duapuluh_arr[]         = $h3['bp']*0.2;
                            $jumlah_pinjaman_arr[] = $h3['bp']*1.2;
                            $empat_arr[]          = $h3['bp']*0.04;
                            $validasi             = $h3['validasi'];
                            if($validasi=="1"){
                              $ceked1  = "checked";
                            }else{
                              $ceked1  = "";
                            }
                        ?>
                        <tr class="small">
                          <td><?php echo $no;?></td>
                          <td><?php echo $resort_nama;?></td>
                          <td><?php echo $h3['anggota_nama'];?></td>
                          <td><?php echo $h3['anggota_alamat'];?></td>
                          
                          <td ><?php echo $h3['pinjaman_ke'];?></td>
                          <td align="right"><?php echo str_replace(",",".",number_format($h3['bp']));?></td>
                          <td align="right"><?php echo str_replace(",",".",number_format($h3['bp']*0.2));?></td>
                          <td align="right"><?php echo str_replace(",",".",number_format($h3['bp']*1.2));?></td>
                          <td align="right"><?php echo str_replace(",",".",number_format($h3['bp']*0.04));?></td>
                          <td></td>
                          <td>
                            <button type="button" class="btn btn-xs btn-info" id="edit<?php echo $pinjaman_id;?>"><i class="fa fa-edit"></i> edit</button>
                            <button type="button" class="btn btn-danger btn-xs" id="hapus<?php echo $pinjaman_id;?>"><i class="fa fa-trash"></i> hapus</button>
                          </td>
                          <td>
                            <input type="checkbox" id="validasi<?php echo $pinjaman_id;?>" <?php echo $ceked1;?>>  
                            <label>Validasi</label>
                          </td>
                        </tr>
                        
                     
                        <script type="text/javascript">
                                      $("#edit<?php echo $pinjaman_id;?>").click(function(){
                                        $('#modal_sedang').modal('show');
                                         $("#tampil_modal_sedang").html("<center><br><br><img src='loader.gif' width='150'></center>"); 
                                         $.ajax({
                                            type : 'post',
                                            url: "data_ajax.php",
                                            data: "judul=Edit Data Pinjaman&tampil=tambah_pinjamanjurubuku&pinjaman_id=<?php echo $pinjaman_id;?>",
                                            cache: false,
                                            success: function(msg){
                                                  $("#tampil_modal_sedang").html(msg);
                                              }
                                              });
                                      });
                                      $("#hapus<?php echo $pinjaman_id;?>").click(function(){
                                        $('#modal_kecil').modal('show');
                                         $("#tampil_modal_kecil").html("<center><br><br><img src='loader.gif' width='150'></center>"); 
                                         $.ajax({
                                            type : 'post',
                                            url: "data_ajax.php",
                                            data: "judul=Pinjaman yakin dihapus?&tampil=hapus_pinjamanjurubuku&pinjaman_id=<?php echo $pinjaman_id;?>",
                                            cache: false,
                                            success: function(msg){
                                                  $("#tampil_modal_kecil").html(msg);
                                              }
                                              });
                                      });

                                      $("#validasi<?php echo $pinjaman_id;?>").click(function(){
                                       
                                        var cekbox = document.getElementById("validasi<?php echo $pinjaman_id;?>");
                                        if(cekbox.checked==true){
                                          var valid="1";
                                        }else{
                                          var valid="0";
                                        }
                                         $.ajax({
                                            type : 'post',
                                            url: "data_ajax.php",
                                            data: "tampil=validasi_pinjaman_jurubuku&pinjaman_id=<?php echo $pinjaman_id;?>&validasi="+valid,
                                            cache: false,
                                           
                                              });                                       
                                        
                                      });
                         </script>
                    <?php 
                    
                    $no++;
                  } ?>
                  <tr class="small bg-light">
                        <td colspan="5">Total Resort <?php echo $resort_nama;?></td>
                        <td align="right"><?php echo str_replace(",",".",number_format(array_sum($bp_arr)));?></td>
                        <td align="right"><?php echo str_replace(",",".",number_format(array_sum($duapuluh_arr)));?></td>
                        <td align="right"><?php echo str_replace(",",".",number_format(array_sum($jumlah_pinjaman_arr)));?></td>
                        <td align="right"><?php echo str_replace(",",".",number_format(array_sum($empat_arr)));?></td>
                        <td align="right"><?php echo str_replace(",",".",number_format(array_sum($bp_arr)));?></td>
                        <td></td>
                        <td></td>
                      </tr>
                    <?php 
                    $bp_total_arr[]             = array_sum($bp_arr);
                    
                    } ?>
                      </tbody>
                      <tfoot>
                        <tr class="small bg-gray">
                          <td colspan="5"><label>Total</label></td>
                          
                          <td align="right"><?php echo str_replace(",",".",number_format(array_sum($bp_total_arr)));?></td>
                          <td align="right"><?php echo str_replace(",",".",number_format(array_sum($bp_total_arr)*0.2));?></td>
                          <td align="right"><?php echo str_replace(",",".",number_format(array_sum($bp_total_arr)*1.2));?></td>
                          <td align="right"><?php echo str_replace(",",".",number_format(array_sum($bp_total_arr)*0.04));?></td>
                          <td align="right"><?php echo str_replace(",",".",number_format(array_sum($bp_total_arr)));?></td>
                           <td></td>
                           <td></td>
                        </tr>
                      </tfoot>
                      </tbody>
                    </table>
                     </div>
                </div>
              </div>
            </div>

                  </div>
                 
                </div>
              </div>
              <!-- /.card -->
            </div>
          </div>
</div>

       
        
        <?php
        include "js.php";
        ?>
                                