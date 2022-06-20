<?php session_start();

    
      $USERNAME   = $_SESSION['USERNAME'];
      $USER_ID       = $_SESSION['USER_ID'];
      $NAMA       = $_SESSION['NAMA'];
      $LEVEL           = $_SESSION['LEVEL'];
      $bulan           = $_SESSION['BULAN'];

include   "css.php";
include   "../lib/koneksi.php";
///kas awal
$q=mysqli_query($con,"select kas_id,kas_nominal from tbl_kas_awal where kas_bulan like '$bulan%'");

$data=mysqli_fetch_array($q,MYSQLI_ASSOC);
//$kas_id   = $data['kas_id'];
$kas_awal = $data['kas_nominal'];


$q=mysqli_query($con,"select anggota_awal_id,anggota_awal from tbl_anggota_awal where anggota_bulan like '$bulan%'");
$cek=mysqli_num_rows($q);
$data=mysqli_fetch_array($q,MYSQLI_ASSOC);
$anggota_awal_id   = $data['anggota_awal_id'];
$anggota_awal = $data['anggota_awal'];


$tab      = $_POST['tab'];
if($tab=="2"){
  $tab_aktif2   = "active";
}else if($tab=="3"){
  $tab_aktif3   = "active";
}else if($tab=="4"){
  $tab_aktif4   = "active";
}else if($tab=="5"){
  $tab_aktif5   = "active";
}else if($tab=="6"){
  $tab_aktif6  = "active";
}else if($tab=="7"){
  $tab_aktif7   = "active";
}else if($tab=="8"){
  $tab_aktif8   = "active";
}else if($tab=="9"){
  $tab_aktif9   = "active";
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
                    <a class="nav-link <?php echo $tab_aktif1;?>" id="pembukuan-harian-tab" data-toggle="pill" href="#pembukuan-harian" role="tab" aria-controls="pembukuan-harian" aria-selected="true">Pembukuan Harian</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link <?php echo $tab_aktif2;?>" id="akomodasi-tab" data-toggle="pill" href="#akomodasi" role="tab" aria-controls="akomodasi" aria-selected="false">Akomodasi</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link <?php echo $tab_aktif3;?>" id="bon-panjer-tab" data-toggle="pill" href="#bon-panjer" role="tab" aria-controls="bon-panjer" aria-selected="false">BON Panjer</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link <?php echo $tab_aktif4;?>" id="bon-prive-tab" data-toggle="pill" href="#bon-prive" role="tab" aria-controls="bon-prive" aria-selected="false">BON Prive</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link <?php echo $tab_aktif5;?>" id="operasional-tab" data-toggle="pill" href="#operasional" role="tab" aria-controls="operasional" aria-selected="false">Operasional</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link <?php echo $tab_aktif7;?>" id="lain-tab" data-toggle="pill" href="#lain" role="tab" aria-controls="lain" aria-selected="false">Lain-Lain</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link <?php echo $tab_aktif8;?>" id="rekapitulasi-tab" data-toggle="pill" href="#rekapitulasi" role="tab" aria-controls="rekapitulasi" aria-selected="false">Rekapitulasi</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link <?php echo $tab_aktif6;?>" id="expedisi-tab" data-toggle="pill" href="#expedisi" role="tab" aria-controls="expedisi" aria-selected="false">Expedisi</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link <?php echo $tab_aktif9;?>" id="kas-tab" data-toggle="pill" href="#kas" role="tab" aria-controls="kas" aria-selected="false">Kas Harian</a>
                  </li>
                </ul>
              </div>
              <div class="card-body">
                <div class="tab-content" id="custom-tabs-one-tabContent">
                  <div class="tab-pane fade show <?php echo $tab_aktif1;?>" id="pembukuan-harian" role="tabpanel" aria-labelledby="pembukuan-harian-tab">

                    <button id="tambah_pembukuan_harian" class="btn btn-sm btn-info" type="button">Tambah Data</button><br><br>
			<div id="aatas"></div>	
<label>Tanggal</label>
			<?php
				
             $qpenunjuk       = mysqli_query($con,"select pembukuan_tgl from tbl_pembukuan_harian where pembukuan_tgl like '$bulan%' group by pembukuan_tgl order by pembukuan_tgl asc");
                  while($hpen   = mysqli_fetch_array($qpenunjuk,MYSQLI_ASSOC)){
                  	$penunjuk_arr[]=$hpen['pembukuan_tgl'];
				?>
				<a href="#a<?php echo $hpen['pembukuan_tgl'];?>"><?php echo substr($hpen['pembukuan_tgl'],8,2);?></a> | 
				<?php
				}

				?>
			<hr>
                    <!-- The time line -->
            <div class="timeline" >

                    <?php
             $q11       = mysqli_query($con,"select pembukuan_tgl from tbl_pembukuan_harian where pembukuan_tgl like '$bulan%' group by pembukuan_tgl order by pembukuan_tgl asc");
                  while($h11   = mysqli_fetch_array($q11,MYSQLI_ASSOC)){
                  $pembukuan_tgl_loop    = $h11['pembukuan_tgl'];
                  $pembukuan_tgl_loop_arr[]=$pembukuan_tgl_loop;
                          ?>
                  <!-- timeline time label -->
              <div class="time-label" id="a<?php echo $pembukuan_tgl_loop;?>">
                <span class="bg-gray-dark"><?php
                $day = date('D', strtotime($pembukuan_tgl_loop));
                echo hari($day);

                ?>, Tanggal : <?php echo tanggal($pembukuan_tgl_loop);?></span> <a href="#aatas">keatas</a>
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
                          <th>DROP</th>
                          <th>STORTING</th>
                          <th>PSP</th>
                          <th>Kasbon pagi</th>
                          <th></th>                                                  
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                        $no=1;
                        unset($drop_arr);
                        unset($storting_arr);
                        unset($psp_arr);
                        unset($kasbon_pagi_arr);
                        $q1       = mysqli_query($con,"select a.*,b.resort_nama from tbl_pembukuan_harian a 
                                  left join tbl_resort b on a.resort_id=b.resort_id where a.pembukuan_tgl = '$pembukuan_tgl_loop'");
                        while($h1   = mysqli_fetch_array($q1,MYSQLI_ASSOC)){
                          $pembukuan_id    = $h1['pembukuan_id'];
                          $drop_arr[]       = $h1['pembukuan_drop'];
                          $storting_arr[]       = $h1['storting'];
                          $psp_arr[]       = $h1['psp'];
                          $kasbon_pagi_arr[]       = $h1['kasbon_pagi'];
                      ?>
                        <tr class="small">
                          <td><?php echo $no;?></td>
                          
                          <td><?php echo $h1['resort_nama'];?></td>
                          <td align="right"><?php echo str_replace(",",".",number_format($h1['pembukuan_drop']));?></td>
                          <td align="right"><?php echo str_replace(",",".",number_format($h1['storting']));?></td>
                          <td align="right"><?php echo str_replace(",",".",number_format($h1['psp']));?></td>
                          <td align="right"><?php echo str_replace(",",".",number_format($h1['kasbon_pagi']));?></td>
                          
                          <td>
                            <button type="button" class="btn btn-xs btn-info" id="edit<?php echo $pembukuan_id;?>"><i class="fa fa-edit"></i> edit</button>
                            <button type="button" class="btn btn-danger btn-xs" id="hapus<?php echo $pembukuan_id;?>"><i class="fa fa-trash"></i> hapus</button>                           
                          </td>                        
                        </tr>
                        <script type="text/javascript">
                                      $("#edit<?php echo $pembukuan_id;?>").click(function(){
                                        $('#modal_sedang').modal('show');
                                         $.ajax({
                                            type : 'post',
                                            url: "data_ajax.php",
                                            data: "judul=Edit Data Pembukuan Harian&tampil=tambah_pembukuan_harian&pembukuan_id=<?php echo $pembukuan_id;?>",
                                            cache: false,
                                            success: function(msg){
                                                  $("#tampil_modal_sedang").html(msg);
                                              }
                                              });
                                      });
                                      $("#hapus<?php echo $pembukuan_id;?>").click(function(){
                                        $('#modal_kecil').modal('show');
                                         $.ajax({
                                            type : 'post',
                                            url: "data_ajax.php",
                                            data: "judul=Pembukuan yakin dihapus?&tampil=hapus_pembukuan_harian&pembukuan_id=<?php echo $pembukuan_id;?>",
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
                          <td colspan="2"><label>Total</label></td>
                          
                          
                          <td align="right"><?php echo str_replace(",",".",number_format(array_sum($drop_arr)));?></td>
                          <td align="right"><?php echo str_replace(",",".",number_format(array_sum($storting_arr)));?></td>
                          <td align="right"><?php echo str_replace(",",".",number_format(array_sum($psp_arr)));?></td>
                          <td align="right"><?php echo str_replace(",",".",number_format(array_sum($kasbon_pagi_arr)));?></td>
                          <?php $kasbon_pagi_total_arr[]=array_sum($kasbon_pagi_arr);?>
                          <td></td>
                        </tr>
                      </tfoot>
                    </table> 
                    
                  </div>     
                  <!-- --end body timeline -->             
                </div>
              </div>
              <!-- END timeline item -->
                    
                       
                    <?php } ?>          
                    </div>
                    <!--- end timeline -->       
                  </div>
                  <div class="tab-pane fade show <?php echo $tab_aktif2;?>" id="akomodasi" role="tabpanel" aria-labelledby="akomodasi-tab">
                     <button id="tambah_akomodasi" class="btn btn-sm btn-info" type="button">Tambah Data</button><br><br>
                    <table id="--example2" class="table table-bordered table-hover table-striped" style="width:100%">
                      <thead>
                        <tr class="small bg-gray">
                          <th >No</th>
                          <th >Tanggal</th>
                          <th >Uang Makan</th>
                          <th >Uang Transport</th>
                          <th >Jumlah</th>
                          <th >Jumlah lalu</th>
                          <th >Total</th>
                          
                          <th width="30%"></th>                                                  
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                        $no=1;
                        $jum = count($pembukuan_tgl_loop_arr);
                        for($x=0;$x<$jum;$x++){
                          $pembukuan_tgl_loop  = $pembukuan_tgl_loop_arr[$x];

                        $q2       = mysqli_query($con,"select * from tbl_akomodasi where akomodasi_tgl = '$pembukuan_tgl_loop' order by akomodasi_tgl asc");
                       $cek = mysqli_num_rows($q2);
                       if($cek==0){
                        $uang_makan_arr[] = 0;
                        $uang_transport_arr[] = 0;
                        ?>
                        <tr class="small">
                          <td><?php echo $no;?></td>
                          <td><?php
                $day = date('D', strtotime($pembukuan_tgl_loop));
                echo hari($day);

                ?>, <?php echo tanggal($pembukuan_tgl_loop);?></td>
                          <td align="right">0</td>
                          <td align="right">0</td>
                          <td>
                          </td>
                        </tr>
                        <?php
                       }
                        while($h2    = mysqli_fetch_array($q2,MYSQLI_ASSOC)){
                          $akomodasi_id     = $h2['akomodasi_id'];
                          $uang_makan_arr[] = $h2['uang_makan'];
                          $uang_transport_arr[] = $h2['uang_transport'];

                          $akomodasi_total= $h2['uang_makan']+$h2['uang_transport'];
                            $akomodasi_sebelumnya = $akomodasi_sebelumnya_kini[$x-1];
                            $akomodasi_sekarang  = $akomodasi_total+$akomodasi_sebelumnya;
                            $akomodasi_sebelumnya_kini[$x]=$akomodasi_sekarang;


                      ?>
                        <tr class="small">
                          <td><?php echo $no;?></td>
                          <td><?php   $day = date('D', strtotime($h2['akomodasi_tgl']));

                          echo hari($day).", ".tanggal($h2['akomodasi_tgl']);?></td>
                          <td align="right"><?php echo str_replace(",",".",number_format($h2['uang_makan']));?></td>
                          <td align="right"><?php echo str_replace(",",".",number_format($h2['uang_transport']));?></td>
                          <td align="right"><?php echo str_replace(",",".",number_format($akomodasi_total));?></td>
                           <td align="right"><?php echo str_replace(",",".",number_format($akomodasi_sebelumnya));?></td>
                            <td align="right"><?php echo str_replace(",",".",number_format($akomodasi_sekarang));?></td>
                          
                          
                          <td>
                            <button type="button" class="btn btn-xs btn-info" id="edit<?php echo $akomodasi_id;?>"><i class="fa fa-edit"></i> edit</button>
                            <button type="button" class="btn btn-danger btn-xs" id="hapus<?php echo $akomodasi_id;?>"><i class="fa fa-trash"></i> hapus</button>  
                            <button type="button" class="btn btn-xs btn-warning" id="cetak<?php echo $akomodasi_id;?>"><i class="fa fa-print"></i> Kwitansi</button>                         
                          </td>                        
                        </tr>
                        <script type="text/javascript">
                                      $("#edit<?php echo $akomodasi_id;?>").click(function(){
                                        $('#modal_sedang').modal('show');
                                         $.ajax({
                                            type : 'post',
                                            url: "data_ajax.php",
                                            data: "judul=Edit Data Akomodasi&tampil=tambah_akomodasi&akomodasi_id=<?php echo $akomodasi_id;?>",
                                            cache: false,
                                            success: function(msg){
                                                  $("#tampil_modal_sedang").html(msg);
                                              }
                                              });
                                      });

                                      $("#cetak<?php echo $akomodasi_id;?>").click(function(){
                                        $('#modal_sedang').modal('show');
                                         $.ajax({
                                            type : 'post',
                                            url: "data_ajax.php",
                                            data: "judul=Kwitansi&tampil=kwitansi&jenis=akomodasi&id=<?php echo $akomodasi_id;?>",
                                            cache: false,
                                            success: function(msg){
                                                  $("#tampil_modal_sedang").html(msg);
                                              }
                                              });
                                      });
                                      $("#hapus<?php echo $akomodasi_id;?>").click(function(){
                                        $('#modal_kecil').modal('show');
                                         $.ajax({
                                            type : 'post',
                                            url: "data_ajax.php",
                                            data: "judul=Akomodasi yakin dihapus?&tampil=hapus_akomodasi&akomodasi_id=<?php echo $akomodasi_id;?>",
                                            cache: false,
                                            success: function(msg){
                                                  $("#tampil_modal_kecil").html(msg);
                                              }
                                              });
                                      });
                         </script>
                    <?php 
                    }
                    $no++;
                  } ?>
                      </tbody>
                    </table>

                  </div>
                  <div class="tab-pane fade show <?php echo $tab_aktif3;?>" id="bon-panjer" role="tabpanel" aria-labelledby="bon-panjer-tab">
                     <button id="tambah_bon_panjer" class="btn btn-sm btn-info" type="button">Tambah Data</button><br><br>
                     <div id="batas"></div>
                     <?php $jum_penunjuk=count($penunjuk_arr);
                     for($i=0;$i<$jum_penunjuk;$i++){
                     	$penunjuk= $penunjuk_arr[$i];
                     	?>
                     	<a href="#b<?php echo $penunjuk;?>"><?php echo substr($penunjuk,8,2);?></a> | 
                     	<?php
                     }
                     ?>
            <!-- The time line -->
            <div class="timeline">
              <?php
            $jum    = count($pembukuan_tgl_loop_arr);
            for($x=0;$x<$jum;$x++){             
              $pembukuan_tgl_loop     = $pembukuan_tgl_loop_arr[$x];
            
            ?>
            <!-- timeline time label -->
              <div class="time-label">
                <span class="bg-gray-dark" id="b<?php echo $pembukuan_tgl_loop;?>"><?php
                $day = date('D', strtotime($pembukuan_tgl_loop));
                echo hari($day);

                ?>, Tanggal : <?php echo tanggal($pembukuan_tgl_loop);?></span> <a href="#batas">keatas</a>
              </div>
              <!-- /.timeline-label -->
              <!-- timeline item -->
              <div>
                <i class="fas fa-clock bg-gray"></i>
                <div class="timeline-item">
                  <span class="time"><i class="fas fa-clock-"></i> </span>
                  <h3 class="timeline-header"><a href="#"></a> </h3>
                  <div class="timeline-body">
                      <table id="example3" class="table table-bordered table-hover table-striped" style="width:100%">
                      <thead>
                        <tr class="small bg-gray">
                          <th width="5%">No</th>
                          
                          <th width="30%">Keterangan</th>
                          <th width="30%">Pegawai</th>
                          <th width="20%">BON</th>
                          
                          <th width="15%"></th>                                                  
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                        $no=1;
                        unset($panjer_nominal_arr);
                        $q3       = mysqli_query($con,"select a.*,b.pegawai_nama from tbl_bon_panjer a 
                                  left join tbl_pegawai b on a.pegawai_id=b.pegawai_id where a.panjer_tgl =  '$pembukuan_tgl_loop' order by a.panjer_tgl asc");
                        while($h3   = mysqli_fetch_array($q3,MYSQLI_ASSOC)){
                          $panjer_id     = $h3['panjer_id'];
                          $panjer_nominal_arr[]= $h3['panjer_nominal'];
                      ?>
                        <tr class="small">
                          <td><?php echo $no;?></td>
                          
                          <td><?php echo $h3['panjer_ket'];?></td>
                          <td><?php echo $h3['pegawai_nama'];?></td>
                          <td align="right"><?php echo str_replace(",", ".", number_format($h3['panjer_nominal']));?></td>
                          
                          <td>
                            <button type="button" class="btn btn-xs btn-info" id="edit<?php echo $panjer_id;?>"><i class="fa fa-edit"></i> edit</button>
                            <button type="button" class="btn btn-danger btn-xs" id="hapus<?php echo $panjer_id;?>"><i class="fa fa-trash"></i> hapus</button>     
                            <button type="button" class="btn btn-xs btn-warning" id="cetak<?php echo $panjer_id;?>"><i class="fa fa-print"></i> Kwitansi</button>                       
                          </td>                        
                        </tr>
                        <script type="text/javascript">
                                      $("#edit<?php echo $panjer_id;?>").click(function(){
                                        $('#modal_sedang').modal('show');
                                         $.ajax({
                                            type : 'post',
                                            url: "data_ajax.php",
                                            data: "judul=Edit BON PANJER&tampil=tambah_bon_panjer&panjer_id=<?php echo $panjer_id;?>",
                                            cache: false,
                                            success: function(msg){
                                                  $("#tampil_modal_sedang").html(msg);
                                              }
                                              });
                                      });
                                      $("#cetak<?php echo $panjer_id;?>").click(function(){
                                        $('#modal_sedang').modal('show');
                                         $.ajax({
                                            type : 'post',
                                            url: "data_ajax.php",
                                            data: "judul=Kwitansi&tampil=kwitansi&jenis=bon_panjer&id=<?php echo $panjer_id;?>",
                                            cache: false,
                                            success: function(msg){
                                                  $("#tampil_modal_sedang").html(msg);
                                              }
                                              });
                                      });
                                      $("#hapus<?php echo $panjer_id;?>").click(function(){
                                        $('#modal_kecil').modal('show');
                                         $.ajax({
                                            type : 'post',
                                            url: "data_ajax.php",
                                            data: "judul=BON PANJER yakin dihapus?&tampil=hapus_bon_panjer&panjer_id=<?php echo $panjer_id;?>",
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
                          <td colspan="3">Jumlah</td>
                          
                            <?php
                            $panjer_nominal_total = array_sum($panjer_nominal_arr);
                            $panjer_nominal_total_arr[]=$panjer_nominal_total;

                            $panjer_nominal_sebelumnya = $panjer_nominal_sebelumnya_kini[$x-1];
                            $panjer_nominal_sekarang  = $panjer_nominal_total+$panjer_nominal_sebelumnya;
                            $panjer_nominal_sebelumnya_kini[$x]=$panjer_nominal_sekarang;
                            ?>
                            <td align="right"><?php echo str_replace(",", ".", number_format($panjer_nominal_total));?></td>
                          
                          
                          <td></td>
                        </tr>
                        <tr class="small bg-gray">
                          <td colspan="3">Jumlah Lalu</td>
                            <td align="right"><?php echo str_replace(",", ".", number_format($panjer_nominal_sebelumnya));?></td>
                          <td></td>
                        </tr>
                        <tr class="small bg-gray">
                          <td colspan="3">Total </td>
                            <td align="right"><?php echo str_replace(",", ".", number_format($panjer_nominal_sekarang));?></td>
                          <td></td>
                        </tr>
                      </tfoot>
                    </table>
                  </div>
                </div>
              </div>
            <?php } ?>
            </div>

                    
                  </div>
                  <div class="tab-pane fade show <?php echo $tab_aktif4;?>" id="bon-prive" role="tabpanel" aria-labelledby="bon-prive-tab">
                     <button id="tambah_bon_prive" class="btn btn-sm btn-info" type="button">Tambah Data</button><br><br>
                     <div id="catas"></div>
                     <?php
                      for($i=0;$i<$jum_penunjuk;$i++){
                     	$penunjuk= $penunjuk_arr[$i];
                     	?>
                     	<a href="#c<?php echo $penunjuk;?>"><?php echo substr($penunjuk,8,2);?></a> | 
                     	<?php
                     }
                     ?>
            <!-- The time line -->
            <div class="timeline">
              <?php
            $jum    = count($pembukuan_tgl_loop_arr);
            for($x=0;$x<$jum;$x++){             
              $pembukuan_tgl_loop     = $pembukuan_tgl_loop_arr[$x];
            
            ?>
            <!-- timeline time label -->
              <div class="time-label">
                <span class="bg-gray-dark" id="c<?php echo $pembukuan_tgl_loop;?>"><?php
                $day = date('D', strtotime($pembukuan_tgl_loop));
                echo hari($day);

                ?>, Tanggal : <?php echo tanggal($pembukuan_tgl_loop);?></span> <a href="#catas">keatas</a>
              </div>
              <!-- /.timeline-label -->
              <!-- timeline item -->
              <div>
                <i class="fas fa-clock bg-gray"></i>
                <div class="timeline-item">
                  <span class="time"><i class="fas fa-clock-"></i> </span>
                  <h3 class="timeline-header"><a href="#"></a> </h3>
                  <div class="timeline-body">
                    <table id="example4" class="table table-bordered table-hover table-striped" style="width:100%">
                      <thead>
                        <tr class="small bg-gray">
                         <th width="5%">No</th>
                          
                          <th width="30%">Keterangan</th>
                          <th width="30%">Pegawai</th>
                          <th width="20%">BON</th>
                          
                          <th width="15%"></th>                                               
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                        $no=1;
                        unset($prive_nominal_arr);
                       $q4       = mysqli_query($con,"select a.*,b.pegawai_nama from tbl_bon_prive a 
                                  left join tbl_pegawai b on a.pegawai_id=b.pegawai_id where a.prive_tgl =  '$pembukuan_tgl_loop' order by a.prive_tgl asc");
                        while($h4   = mysqli_fetch_array($q4,MYSQLI_ASSOC)){
                          $prive_id     = $h4['prive_id'];
                          $prive_nominal_arr[] = $h4['prive_nominal'];
                      ?>
                        <tr class="small">
                          <td><?php echo $no;?></td>
                         
                          <td><?php echo $h4['prive_ket'];?></td>
                          <td><?php echo $h4['pegawai_nama'];?></td>
                          <td align="right"><?php echo str_replace(",", ".", number_format($h4['prive_nominal']));?></td>
                          
                          
                          <td>
                            <button type="button" class="btn btn-xs btn-info" id="edit<?php echo $prive_id;?>"><i class="fa fa-edit"></i> edit</button>
                            <button type="button" class="btn btn-danger btn-xs" id="hapus<?php echo $prive_id;?>"><i class="fa fa-trash"></i> hapus</button>     
                            <button type="button" class="btn btn-xs btn-warning" id="cetak<?php echo $prive_id;?>"><i class="fa fa-print"></i> Kwitansi</button>                       
                          </td>                        
                        </tr>
                        <script type="text/javascript">
                                      $("#edit<?php echo $prive_id;?>").click(function(){
                                        $('#modal_sedang').modal('show');
                                         $.ajax({
                                            type : 'post',
                                            url: "data_ajax.php",
                                            data: "judul=Edit BON PRIVE&tampil=tambah_bon_prive&prive_id=<?php echo $prive_id;?>",
                                            cache: false,
                                            success: function(msg){
                                                  $("#tampil_modal_sedang").html(msg);
                                              }
                                              });
                                      });
                                      $("#cetak<?php echo $prive_id;?>").click(function(){
                                        $('#modal_sedang').modal('show');
                                         $.ajax({
                                            type : 'post',
                                            url: "data_ajax.php",
                                            data: "judul=Kwitansi&tampil=kwitansi&jenis=bon_prive&id=<?php echo $prive_id;?>",
                                            cache: false,
                                            success: function(msg){
                                                  $("#tampil_modal_sedang").html(msg);
                                              }
                                              });
                                      });
                                      $("#hapus<?php echo $prive_id;?>").click(function(){
                                        $('#modal_kecil').modal('show');
                                         $.ajax({
                                            type : 'post',
                                            url: "data_ajax.php",
                                            data: "judul=BON Prive yakin dihapus?&tampil=hapus_bon_prive&prive_id=<?php echo $prive_id;?>",
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
                          <td colspan="3">Jumlah</td>
                          
                            <?php
                            $prive_nominal_total = array_sum($prive_nominal_arr);
                            $prive_nominal_total_arr[]=$prive_nominal_total;

                            $prive_nominal_sebelumnya = $prive_nominal_sebelumnya_kini[$x-1];
                            $prive_nominal_sekarang  = $prive_nominal_total+$prive_nominal_sebelumnya;
                            $prive_nominal_sebelumnya_kini[$x]=$prive_nominal_sekarang;
                            ?>
                            <td align="right"><?php echo str_replace(",", ".", number_format($prive_nominal_total));?></td>
                             <td></td>
                          </tr>
                            <tr class="small bg-gray">
                          <td colspan="3">Jumlah Lalu</td>
                            <td align="right"><?php echo str_replace(",", ".", number_format($prive_nominal_sebelumnya));?></td>
                          <td></td>
                        </tr>
                        <tr class="small bg-gray">
                          <td colspan="3">Total</td>
                            <td align="right"><?php echo str_replace(",", ".", number_format($prive_nominal_sekarang));?></td>
                          <td></td>
                        </tr>
                          
                          
                      </tfoot>
                    </table>
                  </div>
                </div>
              </div>
            <?php } ?>
            </div>
            </div>
                  <div class="tab-pane fade show <?php echo $tab_aktif5;?>" id="operasional" role="tabpanel" aria-labelledby="operasional-tab">
                    <button id="tambah_operasional" class="btn btn-sm btn-info" type="button">Tambah Data</button><br><br>
                    <div id="datas"></div>
                    <?php
                     for($i=0;$i<$jum_penunjuk;$i++){
                     	$penunjuk= $penunjuk_arr[$i];
                     	?>
                     	<a href="#d<?php echo $penunjuk;?>"><?php echo substr($penunjuk,8,2);?></a> | 
                     	<?php
                     }?>

              <!-- The time line -->
            <div class="timeline">
              <?php
            $jum    = count($pembukuan_tgl_loop_arr);
            for($x=0;$x<$jum;$x++){             
              $pembukuan_tgl_loop     = $pembukuan_tgl_loop_arr[$x];
            
            ?>
            <!-- timeline time label -->
              <div class="time-label">
                <span class="bg-gray-dark" id="d<?php echo $pembukuan_tgl_loop;?>"><?php
                $day = date('D', strtotime($pembukuan_tgl_loop));
                echo hari($day);

                ?>, Tanggal : <?php echo tanggal($pembukuan_tgl_loop);?></span> <a href="#datas">keatas</a></span>
              </div>
              <!-- /.timeline-label -->
              <!-- timeline item -->
              <div>
                <i class="fas fa-clock bg-gray"></i>
                <div class="timeline-item">
                  <span class="time"><i class="fas fa-clock-"></i> </span>
                  <h3 class="timeline-header"><a href="#"></a> </h3>
                  <div class="timeline-body">
                    <table id="example5" class="table table-bordered table-hover table-striped" style="width:100%">
                      <thead>
                        <tr class="small bg-gray">
                          <th width="5%">No</th>
                          <th width="20%">Tanggal</th>
                          <th width="30%">Biaya Umum</th>
                          <th width="15%">Jumlah</th>
                          
                          <th width="30%"></th>                                                  
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                        $no=1;
                        unset($nominal_arr);
                          $q5       = mysqli_query($con,"select a.*,b.bu_nama from tbl_operasional a left join tbl_biayaumum b on a.bu_id=b.bu_id where a.operasional_tgl = '$pembukuan_tgl_loop' and b.bu_kategori='0' order by a.operasional_tgl asc");
                        while($h5   = mysqli_fetch_array($q5,MYSQLI_ASSOC)){
                          $operasional_id     = $h5['operasional_id'];
                          $nominal_arr[]      = $h5['nominal'];
                      ?>
                        <tr class="small">
                          <td><?php echo $no;?></td>
                          <td><?php
                $day = date('D', strtotime($pembukuan_tgl_loop));
                echo hari($day);

                ?>, Tanggal : <?php echo tanggal($pembukuan_tgl_loop);?></td>
                          <td><?php echo $h5['bu_nama'];?>
                            <?php echo $h5['operasional_ket'];?>
                          </td>
                          <td align="right"><?php echo str_replace(",", ".", number_format($h5['nominal']));?></td>
                          
                          
                          <td>
                            <button type="button" class="btn btn-xs btn-info" id="edit<?php echo $operasional_id;?>"><i class="fa fa-edit"></i> edit </button>
                            <button type="button" class="btn btn-danger btn-xs" id="hapus<?php echo $operasional_id;?>"><i class="fa fa-trash"></i> hapus</button>          
                            <button type="button" class="btn btn-xs btn-warning" id="cetak<?php echo $operasional_id;?>"><i class="fa fa-print"></i> Kwitansi</button>                  
                          </td>                        
                        </tr>
                        <script type="text/javascript">
                                      $("#edit<?php echo $operasional_id;?>").click(function(){
                                        $('#modal_sedang').modal('show');
                                         $.ajax({
                                            type : 'post',
                                            url: "data_ajax.php",
                                            data: "judul=Edit Data Operasional&tampil=tambah_operasional&bu_kategori=0&operasional_id=<?php echo $operasional_id;?>",
                                            cache: false,
                                            success: function(msg){
                                                  $("#tampil_modal_sedang").html(msg);
                                              }
                                              });
                                      });
                                      $("#cetak<?php echo $operasional_id;?>").click(function(){
                                        $('#modal_sedang').modal('show');
                                         $.ajax({
                                            type : 'post',
                                            url: "data_ajax.php",
                                            data: "judul=Kwitansi&tampil=kwitansi&jenis=operasional&id=<?php echo $operasional_id;?>",
                                            cache: false,
                                            success: function(msg){
                                                  $("#tampil_modal_sedang").html(msg);
                                              }
                                              });
                                      });
                                      $("#hapus<?php echo $operasional_id;?>").click(function(){
                                        $('#modal_kecil').modal('show');
                                         $.ajax({
                                            type : 'post',
                                            url: "data_ajax.php",
                                            data: "judul=Operasional yakin dihapus?&tampil=hapus_operasional&operasional_id=<?php echo $operasional_id;?>",
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
                          <td colspan="3">
                            Jumlah
                          </td>
                          <td align="right">
                            <?php 
                            $nominal_operasional_arr[]=array_sum($nominal_arr);
                            echo str_replace(",", ".", number_format(array_sum($nominal_arr)));
                            $nominal_operasional_total= array_sum($nominal_arr);
                            $nominal_operasional_sebelumnya = $nominal_operasional_sebelumnya_kini[$x-1];
                            $nominal_operasional_sekarang  = $nominal_operasional_total+$nominal_operasional_sebelumnya;
                            $nominal_operasional_sebelumnya_kini[$x]=$nominal_operasional_sekarang;
                            ?>
                          </td>
                          <td></td>
                        </tr>
                        <tr class="small bg-gray">
                          <td colspan="3">
                            Jumlah Lalu
                          </td>
                          <td align="right">
                            <?php                            
                            echo str_replace(",", ".", number_format($nominal_operasional_sebelumnya));
                           ?>
                          </td>
                          <td></td>
                        </tr>
                        <tr class="small bg-gray">
                          <td colspan="3">
                            Total
                          </td>
                          <td align="right">
                            <?php                            
                            echo str_replace(",", ".", number_format($nominal_operasional_sekarang));
                           ?>
                          </td>
                          <td></td>
                        </tr>
                      </tfoot>
                    </table>
                    
                    </div>
                    </div>
                  </div>
                <?php } ?>
              </div>
                  </div>

                  <div class="tab-pane fade show <?php echo $tab_aktif7;?>" id="lain" role="tabpanel" aria-labelledby="lain-tab">
                    <button id="tambah_lain" class="btn btn-sm btn-info" type="button">Tambah Data</button><br><br>
                    <div id="eatas"></div>
                    <?php
                     for($i=0;$i<$jum_penunjuk;$i++){
                     	$penunjuk= $penunjuk_arr[$i];
                     	?>
                     	<a href="#e<?php echo $penunjuk;?>"><?php echo substr($penunjuk,8,2);?></a> | 
                     	<?php
                     }
                     ?>
                     <!-- The time line -->
            <div class="timeline">
              <?php
            $jum    = count($pembukuan_tgl_loop_arr);
            for($x=0;$x<$jum;$x++){             
              $pembukuan_tgl_loop     = $pembukuan_tgl_loop_arr[$x];
            
            ?>
            <!-- timeline time label -->
              <div class="time-label">
                <span class="bg-gray-dark" id="e<?php echo $pembukuan_tgl_loop;?>"><?php
                $day = date('D', strtotime($pembukuan_tgl_loop));
                echo hari($day);

                ?>, Tanggal : <?php echo tanggal($pembukuan_tgl_loop);?></span> <a href="#eatas">keatas</a>
              </div>
              <!-- /.timeline-label -->
              <!-- timeline item -->
              <div>
                <i class="fas fa-clock bg-gray"></i>
                <div class="timeline-item">
                  <span class="time"><i class="fas fa-clock-"></i> </span>
                  <h3 class="timeline-header"><a href="#"></a> </h3>
                  <div class="timeline-body">
                    <table id="example5" class="table table-bordered table-hover table-striped" style="width:100%">
                      <thead>
                        <tr class="small bg-gray">
                          <th width="5%">No</th>
                          <th width="20%">Tanggal</th>
                          <th width="30%">Biaya Umum</th>
                          <th width="15%">Jumlah</th>
                          
                          <th width="30%"></th>                                                        
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                        $no=1;
                        unset($nominal_arr);
                          $q5       = mysqli_query($con,"select a.*,b.bu_nama from tbl_operasional a left join tbl_biayaumum b on a.bu_id=b.bu_id where a.operasional_tgl = '$pembukuan_tgl_loop' and b.bu_kategori='1' order by a.operasional_tgl asc");
                        while($h5   = mysqli_fetch_array($q5,MYSQLI_ASSOC)){
                          $operasional_id     = $h5['operasional_id'];
                          $nominal_arr[]      = $h5['nominal'];
                      ?>
                        <tr class="small">
                          <td><?php echo $no;?></td>
                          <td><?php
                $day = date('D', strtotime($pembukuan_tgl_loop));
                echo hari($day);

                ?>, Tanggal : <?php echo tanggal($pembukuan_tgl_loop);?></td>
                          <td><?php echo $h5['bu_nama'];?>
                            <?php echo $h5['operasional_ket'];?>
                          </td>
                          <td align="right"><?php echo str_replace(",", ".", number_format($h5['nominal']));?></td>
                          
                          
                          <td>
                            <button type="button" class="btn btn-xs btn-info" id="edit<?php echo $operasional_id;?>"><i class="fa fa-edit"></i> edit</button>
                            <button type="button" class="btn btn-danger btn-xs" id="hapus<?php echo $operasional_id;?>"><i class="fa fa-trash"></i> hapus</button> 
                             <button type="button" class="btn btn-xs btn-warning" id="cetak<?php echo $operasional_id;?>"><i class="fa fa-print"></i> Kwitansi</button>                          
                          </td>                        
                        </tr>
                        <script type="text/javascript">
                                      $("#edit<?php echo $operasional_id;?>").click(function(){
                                        $('#modal_sedang').modal('show');
                                         $.ajax({
                                            type : 'post',
                                            url: "data_ajax.php",
                                            data: "judul=Edit Data Operasional&tampil=tambah_lain&bu_kategori=1&operasional_id=<?php echo $operasional_id;?>",
                                            cache: false,
                                            success: function(msg){
                                                  $("#tampil_modal_sedang").html(msg);
                                              }
                                              });
                                      });
                                      $("#cetak<?php echo $operasional_id;?>").click(function(){
                                        $('#modal_sedang').modal('show');
                                         $.ajax({
                                            type : 'post',
                                            url: "data_ajax.php",
                                            data: "judul=Kwitansi&tampil=kwitansi&jenis=operasional&id=<?php echo $operasional_id;?>",
                                            cache: false,
                                            success: function(msg){
                                                  $("#tampil_modal_sedang").html(msg);
                                              }
                                              });
                                      });
                                      $("#hapus<?php echo $operasional_id;?>").click(function(){
                                        $('#modal_kecil').modal('show');
                                         $.ajax({
                                            type : 'post',
                                            url: "data_ajax.php",
                                            data: "judul=Operasional yakin dihapus?&tampil=hapus_lain&operasional_id=<?php echo $operasional_id;?>",
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
                          <td colspan="3">
                            Jumlah
                          </td>
                          <td align="right">
                            <?php 
                            $nominal_lain_arr[]=array_sum($nominal_arr);
                            echo str_replace(",", ".", number_format(array_sum($nominal_arr)));
                            $nominal_lain_total= array_sum($nominal_arr);
                            $nominal_lain_sebelumnya = $nominal_lain_sebelumnya_kini[$x-1];
                            $nominal_lain_sekarang  = $nominal_lain_total+$nominal_lain_sebelumnya;
                            $nominal_lain_sebelumnya_kini[$x]=$nominal_lain_sekarang;

                            ?>
                          </td>
                          <td></td>
                        </tr>
                         <tr class="small bg-gray">
                          <td colspan="3">
                            Jumlah Lalu
                          </td>
                          <td align="right">
                            <?php                            
                            echo str_replace(",", ".", number_format($nominal_lain_sebelumnya));
                           ?>
                          </td>
                          <td></td>
                        </tr>
                        <tr class="small bg-gray">
                          <td colspan="3">
                            Total
                          </td>
                          <td align="right">
                            <?php                            
                            echo str_replace(",", ".", number_format($nominal_lain_sekarang));
                           ?>
                          </td>
                          <td></td>
                        </tr>
                      </tfoot>
                    </table>
                    
                    </div>
                    </div>
                  </div>
                <?php } ?>
              </div>                     
                  </div>

                  <div class="tab-pane fade show <?php echo $tab_aktif8;?>" id="rekapitulasi" role="tabpanel" aria-labelledby="rekapitulasi-tab">
                    <div id="fatas"></div>
                  	<?php
                  	 for($i=0;$i<$jum_penunjuk;$i++){
                     	$penunjuk= $penunjuk_arr[$i];
                     	?>
                     	<a href="#f<?php echo $penunjuk;?>"><?php echo substr($penunjuk,8,2);?></a> | 
                     	<?php
                     }
                     ?>
                    <br>
                    
                    <?php
                  $jum_tgl = count($pembukuan_tgl_loop_arr);
                  //$index=0;
                   mysqli_query($con,"delete from tbl_rekapitulasi where bulan='$bulan'");
                  for($x=0;$x<$jum_tgl;$x++){
                    $pembukuan_tgl_loop = $pembukuan_tgl_loop_arr[$x];

                          ?>
                          <label><?php
                $day = date('D', strtotime($pembukuan_tgl_loop));
                echo hari($day);

                ?>, Tanggal : <?php echo tanggal($pembukuan_tgl_loop);?></span> <a href="#fatas">keatas</a></label>
                    <table  class="table table-bordered table-hover table-striped" style="width:100%" id="f<?php echo $pembukuan_tgl_loop;?>">
                      
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
                        unset($jum_anggota_lama_arr);
                        unset($jum_anggota_baru_arr);
                        unset($jum_anggota_keluar_arr);
                        unset($jum_anggota_kini_arr);
                        $q1       = mysqli_query($con,"select a.*,b.resort_nama from tbl_pembukuan_harian a 
                                   join tbl_resort b on a.resort_id=b.resort_id where a.pembukuan_tgl = '$pembukuan_tgl_loop'");
                        while($h1   = mysqli_fetch_array($q1,MYSQLI_ASSOC)){
                          $pembukuan_id    = $h1['pembukuan_id'];
                          $drop_arr[]       = $h1['pembukuan_drop'];
                          $storting_arr[]       = $h1['storting'];
                          $psp_arr[]       = $h1['psp'];
                          $kasbon_pagi_arr[]       = $h1['kasbon_pagi'];

                          $storting             = $h1['storting'];
                          $drop                 = $h1['pembukuan_drop'];
                          $psp                  = $h1['psp'];
                          $kasbon_pagi          = $h1['kasbon_pagi'];

                          $adm5persen           = $drop*0.05;
                          $simp4persen          = $drop*0.04;
                          
                          $kredit               = $drop+$psp;
                          $debet_tanpa_kasbon   = $storting+$adm5persen+$simp4persen;
                          $tunai                = $debet_tanpa_kasbon-$kredit;
                          
                          if($tunai<0){
                            $tunai              = 0;
                          }else{
                            $tunai              = $tunai;
                          }
                          
                          $kasbon_pakai         = $kredit-$debet_tanpa_kasbon;
                          
                          if($kasbon_pakai<0){
                            $kasbon_pakai              = 0;
                          }else{
                            $kasbon_pakai              = $kasbon_pakai;
                          }
                          
                          $debet                       = $kasbon_pakai+$storting+$adm5persen+$simp4persen;
                          $kasbon_pakai_arr[]          = $kasbon_pakai;
                          $adm5persen_arr[]            = $adm5persen;
                          $simp4persen_arr[]           = $simp4persen;
                          $debet_arr[]                 = $debet;
                          $kredit_arr[]                = $kredit;
                          $tunai_arr[]                 = $tunai;

                          $resort_idku 				   = $h1['resort_id'];		
                             //$bulan_iniku 		= substr($pembukuan_tgl_loop, 0,7)."-01";
                         // $jum_anggota_lama = mysqli_num_rows(mysqli_query($con,"select anggota_id from tbl_anggota where resort_id='$resort_idku' and tgl_daftar < '$pembukuan_tgl_loop'"));
                          //$jum_anggota_baru = mysqli_num_rows(mysqli_query($con,"select anggota_id from tbl_anggota where resort_id='$resort_idku' and tgl_daftar = '$pembukuan_tgl_loop'"));
                          //$jum_anggota_keluar = mysqli_num_rows(mysqli_query($con,"select anggota_id from tbl_anggota where resort_id='$resort_idku' and tgl_keluar = '$pembukuan_tgl_loop'"));
                          $jum_anggota_lama       = $h1['L'];
                          $jum_anggota_baru       = $h1['B'];
                          $jum_anggota_keluar     = $h1['K'];
                          $jum_anggota_kini 		= ($jum_anggota_lama+$jum_anggota_baru)-$jum_anggota_keluar;

                          $jum_anggota_lama_arr[] = $jum_anggota_lama;
                          $jum_anggota_baru_arr[] = $jum_anggota_baru;
                          $jum_anggota_keluar_arr[] = $jum_anggota_keluar;
                          $jum_anggota_kini_arr[] = $jum_anggota_kini;

                          $jum_anggota_baru_global_arr[]= $jum_anggota_baru;
                           $jum_anggota_keluar_global_arr[] = $jum_anggota_keluar;

                           $resort_id_rekap = $h1['resort_id'];

                      ?>
                        <tr class="small">
                              <td >
                                  <?php echo $h1['resort_nama'];
                                  //echo "select anggota_id from tbl_anggota where resort_id='$resort_idku' and tgl_daftar < '$pembukuan_tgl_loop'";

                                  //echo "select anggota_id from tbl_anggota where resort_id='$resort_idku' and tgl_daftar >= '$pembukuan_tgl_loop'";?>
                              </td>
                              <td align="right">
                                  <?php echo str_replace(",", ".", number_format($jum_anggota_lama));?>
                              </td>
                              <td align="right">
                                  <?php echo str_replace(",", ".", number_format($jum_anggota_baru));?>
                              </td>
                              <td align="right">
                                  <?php echo str_replace(",", ".", number_format($jum_anggota_keluar));?>
                              </td>
                              <td align="right">
                                  <?php echo str_replace(",", ".", number_format($jum_anggota_kini));?>
                              </td>
                              <td align="right">
                                  <?php echo str_replace(",", ".", number_format($kasbon_pakai));?>
                              </td>
                              <td align="right">
                                  <?php echo str_replace(",", ".", number_format($storting));?>
                              </td>
                              <td align="right">
                                  <?php echo str_replace(",", ".", number_format($adm5persen));?>
                              </td>
                              <td align="right">
                                  <?php echo str_replace(",", ".", number_format($simp4persen));?>
                              </td>
                              <td align="right">
                                  <?php echo str_replace(",", ".", number_format($debet));?>
                              </td>
                              <td align="right">
                                  <?php echo str_replace(",", ".", number_format($drop));?>
                              </td>
                              <td align="right">
                                  <?php echo str_replace(",", ".", number_format($psp));?>
                              </td>
                              <td align="right">
                                  <?php echo str_replace(",", ".", number_format($kredit));?>
                              </td>
                              <td align="right">
                                  <?php echo str_replace(",", ".", number_format($tunai));?>
                              </td>
                              
                          </tr>
                        <?php 
                        if($day=="Mon" or $day=="Thu"){
                            $minggu=1;
                            }
                            if($day=="Tue" or $day=="Fri"){
                            $minggu=2;
                            }
                            if($day=="Wed" or $day=="Sat"){
                              $minggu=3;
                            }
                       mysqli_query($con,"insert into tbl_rekapitulasi(resort_id,L,B,K,kini,kasbon_pakai,storting,adm,simp,debet,`drop`,psp,kredit,tunai,bulan,minggu,tgl) 
                        values('$resort_id_rekap','$jum_anggota_lama','$jum_anggota_baru','$jum_anggota_keluar','$jum_anggota_kini','$kasbon_pakai','$storting','$adm5persen','$simp4persen','$debet','$drop','$psp','$kredit','$tunai','$bulan','$minggu','$pembukuan_tgl_loop')");

                       
                      } ?>
                      </tbody>
                      <tfoot>
                        <?php
                        
                        $jumlah_anggota_kini_sebelum[$x]=array_sum($jum_anggota_kini_arr);
                        $jumlah_anggota_kini_lalu_sebelum[$x]=array_sum($jum_anggota_kini_arr)+$jumlah_anggota_kini_lalu_sebelum[$x-1];

                         $jumlah_anggota_lama_sebelum[$x]=array_sum($jum_anggota_lama_arr);
                        $jumlah_anggota_lama_lalu_sebelum[$x]=array_sum($jum_anggota_lama_arr)+$jumlah_anggota_lama_lalu_sebelum[$x-1];


                        
                        
                        ?>
                        <tr class="small bg-gray-dark">
                            <td >
                                  Jumlah 
                              </td>
                              <td align="right">
                                  <?php echo str_replace(",", ".", number_format(array_sum($jum_anggota_lama_arr)));?>
                              </td>
                              <td align="right">
                                  <?php echo str_replace(",", ".", number_format(array_sum($jum_anggota_baru_arr)));?>
                              </td>
                              <td align="right">
                                  <?php echo str_replace(",", ".", number_format(array_sum($jum_anggota_keluar_arr)));?>
                              </td>
                              <td align="right">
                                  <?php echo str_replace(",", ".", number_format(array_sum($jum_anggota_kini_arr)));?>
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
                                  Jumlah Lalu
                              </td>
                              <td align="right">
                                   <?php echo str_replace(",", ".", number_format($jumlah_anggota_lama_lalu_sebelum[$x-1]));?>
                              </td>
                              <td align="right">
                                  <?php echo str_replace(",", ".", number_format(array_sum($jum_anggota_baru_global_arr)-array_sum($jum_anggota_baru_arr)));?>
                              </td>
                              <td align="right">
                                  <?php echo str_replace(",", ".", number_format(array_sum($jum_anggota_keluar_global_arr)-array_sum($jum_anggota_keluar_arr)));?>
                              </td>
                               <td align="right">
                                  <?php echo str_replace(",", ".", number_format($jumlah_anggota_kini_lalu_sebelum[$x-1]));?>
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
                                  Total
                              </td>
                                <td align="right">
                                   <?php echo str_replace(",", ".", number_format($jumlah_anggota_lama_lalu_sebelum[$x-1]+array_sum($jum_anggota_lama_arr)));?>
                              </td>
                              <td align="right">
                                    <?php echo str_replace(",", ".", number_format(array_sum($jum_anggota_baru_global_arr)));?>
                              </td>
                              <td align="right">
                                 <?php echo str_replace(",", ".", number_format(array_sum($jum_anggota_keluar_global_arr)));?>
                              </td>
                             
                               <td align="right">
                                   <?php echo str_replace(",", ".", number_format($jumlah_anggota_kini_lalu_sebelum[$x-1]+array_sum($jum_anggota_kini_arr)));?>
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
                    </table>    
                    <?php } ?>                 
                  </div>


                  <div class="tab-pane fade show <?php echo $tab_aktif6;?>" id="expedisi" role="tabpanel" aria-labelledby="expedisi-tab">
                     
                     <table  class="table table-bordered table-hover table-striped" style="width:100%">
                      <thead>
                        <tr class="small bg-gray">
                          <th>No</th>
                          <th>Tanggal</th>
                          <th>Kas Awal</th>
                          <th>Kasbon Pagi</th>
                          <th>Transport</th>
                          <th>Makan</th>
                          <th>Lain-lain</th>
                          <th>BON</th>
                          <th>BOP</th>
                          <th>Jumlah</th> 
                          <th>Kembali Kasbon</th>
                          <th>Tunai</th>
                          <th>Total</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                        $no=1;
                         mysqli_query($con,"delete from tbl_expedisi where bulan='$bulan'");
                         for($x=0;$x<$jum_tgl;$x++){
                          $pembukuan_tgl_loop   = $pembukuan_tgl_loop_arr[$x];
                          $exp1 = $no;
                         
                $day = date('D', strtotime($pembukuan_tgl_loop));
               

                          $exp2 = hari($day).", ".tanggal($pembukuan_tgl_loop);
                          if($x==0){
                            $exp3 = $kas_awal;
                          }else{
                            $exp3 = $kas_lalu[$x-1];
                          }
                          $exp4 = $kasbon_pagi_total_arr[$x];
                          $exp5 = $uang_transport_arr[$x];
                          $exp6 = $uang_makan_arr[$x];
                          $exp7 = $nominal_lain_arr[$x];
                          $exp8 = $panjer_nominal_total_arr[$x]+$prive_nominal_total_arr[$x];
                          $exp9 = $nominal_operasional_arr[$x];
                          $exp10 = $exp3-$exp4-$exp5-$exp6-$exp7-$exp8-$exp9;
                          $exp11 = $exp4-$kasbon_pakai_expedisi_arr[$x];
                          $exp12 = $tunai_expedisi_arr[$x];
                          $exp13 = $exp10+$exp11+$exp12;
                          if($exp3==""){
                            $exp3=0;
                          }else{
                            $exp3=$exp3;
                          }
                          if($exp4==""){
                            $exp4=0;
                          }else{
                            $exp4=$exp4;
                          }
                          if($exp5==""){
                            $exp5=0;
                          }else{
                            $exp5=$exp5;
                          }
                          if($exp6==""){
                            $exp6=0;
                          }else{
                            $exp6=$exp6;
                          }
                          if($exp7==""){
                            $exp7=0;
                          }else{
                            $exp7=$exp7;
                          }
                          if($exp8==""){
                            $exp8=0;
                          }else{
                            $exp8=$exp8;
                          }if($exp9==""){
                            $exp9=0;
                          }else{
                            $exp9=$exp9;
                          }if($exp10==""){
                            $exp10=0;
                          }else{
                            $exp10=$exp10;
                          }
                          if($exp11==""){
                            $exp11=0;
                          }else{
                            $exp11=$exp11;
                          }if($exp12==""){
                            $exp12=0;
                          }else{
                            $exp12=$exp12;
                          }if($exp13==""){
                            $exp13=0;
                          }else{
                            $exp13=$exp13;
                          }
                          
                          $kas_lalu[]=$exp13;

                      ?>
                        <tr class="small">
                          <td><?php echo $exp1;?></td>
                          <td><?php echo $exp2;?></td>
                          <td align="right"><?php echo str_replace(",", ".", number_format($exp3));?></td>
                          <td align="right"><?php echo str_replace(",", ".", number_format($exp4));?></td>
                          <td align="right"><?php echo str_replace(",", ".", number_format($exp5));?></td>
                          <td align="right"><?php echo str_replace(",", ".", number_format($exp6));?></td>
                          <td align="right"><?php echo str_replace(",", ".", number_format($exp7));?></td>
                          <td align="right"><?php echo str_replace(",", ".", number_format($exp8));?></td>
                          <td align="right"><?php echo str_replace(",", ".", number_format($exp9));?></td>
                          <td align="right"><?php echo str_replace(",", ".", number_format($exp10));?></td>
                          <td align="right"><?php echo str_replace(",", ".", number_format($exp11));?></td>
                          <td align="right"><?php echo str_replace(",", ".", number_format($exp12));?></td>
                          <td align="right"><?php echo str_replace(",", ".", number_format($exp13));?></td>

                        </tr>
                       
                    <?php 
                    $no++;
                    mysqli_query($con,"insert into tbl_expedisi(tgl,kas_awal,kasbon_pagi,transport,makan,lain,bon,bop,jumlah,kembali_kasbon,tunai,total,bulan) values('$pembukuan_tgl_loop','$exp3','$exp4','$exp5','$exp6','$exp7','$exp8','$exp9','$exp10','$exp11','$exp12','$exp13','$bulan')");

                  // echo "insert into tbl_expedisi(tgl,kas_awal,kasbon_pagi,transport,makan,lain,bon,bop,jumlah,kembali_kasbon,tunai,total,bulan) values('$pembukuan_tgl_loop','$exp3','$exp4','$exp5','$exp6','$exp7','$exp8','$exp9','$exp10','$exp11','$exp12','$exp13','$bulan')";
                  } ?>
                      </tbody>
                    </table> 
                  </div>


                  <div class="tab-pane fade show <?php echo $tab_aktif9;?>" id="kas" role="tabpanel" aria-labelledby="kas-tab">
                   
                    <table  class="table table-bordered table-hover table-striped" style="width:100%">
                      <thead>
                        <tr class="small bg-gray">
                          <th>No</th>
                          <th>Tanggal</th>
                          <th>Kas Awal</th>
                          <th>Kasbon Pakai</th>
                          <th>Tunai</th>
                          <th>Transport</th>
                          <th>U/M</th>
                          <th>BON</th>
                          <th>BOP</th>
                          <th>Lain-lain</th> 
                          <th>Kas</th>                                           
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                        $no=1;
                       
                         for($x=0;$x<$jum_tgl;$x++){
                          $pembukuan_tgl_loop   = $pembukuan_tgl_loop_arr[$x];
                          $exp1 = $no;
                            $day = date('D', strtotime($pembukuan_tgl_loop));
               

                          $exp2 = hari($day).", ".tanggal($pembukuan_tgl_loop);
                          if($x==0){
                            $exp3 = $kas_awal;
                          }else{
                            $exp3 = $kas_lalu[$x-1];
                          }
                          $exp4 = $kasbon_pakai_expedisi_arr[$x];
                          $exp5 = $tunai_expedisi_arr[$x];
                          $exp6 = $uang_transport_arr[$x];
                          $exp7 = $uang_makan_arr[$x];
                          $exp8 = $panjer_nominal_total_arr[$x]+$prive_nominal_total_arr[$x];
                          $exp9 = $nominal_operasional_arr[$x];
                          $exp10 = $nominal_lain_arr[$x];
                          $exp11 = ($exp3+$exp5)-$exp4-$exp6-$exp7-$exp8-$exp9-$exp10;
                           $kas_lalu[]=$exp11;
                         
                      ?>
                        <tr class="small">
                          <td><?php echo $exp1;?></td>
                          <td><?php echo $exp2;?></td>
                          <td align="right"><?php echo str_replace(",", ".", number_format($exp3));?></td>
                          <td align="right"><?php echo str_replace(",", ".", number_format($exp4));?></td>
                          <td align="right"><?php echo str_replace(",", ".", number_format($exp5));?></td>
                          <td align="right"><?php echo str_replace(",", ".", number_format($exp6));?></td>
                          <td align="right"><?php echo str_replace(",", ".", number_format($exp7));?></td>
                          <td align="right"><?php echo str_replace(",", ".", number_format($exp8));?></td>
                          <td align="right"><?php echo str_replace(",", ".", number_format($exp9));?></td>
                          <td align="right"><?php echo str_replace(",", ".", number_format($exp10));?></td>
                          <td align="right"><?php echo str_replace(",", ".", number_format($exp11));?></td>
                        </tr>
                       
                    <?php 
                    $no++;


                  } ?>
                      </tbody>
                    </table>                     
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
                                  <script type="text/javascript">
                                  /* tambah pembukuan harian --------------------------- */
                                      $("#tambah_pembukuan_harian").click(function(){
                                        $('#modal_sedang').modal('show');
                                          $("#tampil_modal").html("<center><br><br><img src='loader.gif' width='150'></center>");                                     
                                            
                                            $.ajax({
                                                 type : 'post',
                                            url: "data_ajax.php",
                                            data: "judul=Input Data Pembukuan Harian&tampil=tambah_pembukuan_harian",
                                            cache: false,
                                            success: function(msg){
                                                  $("#tampil_modal_sedang").html(msg);
                                              }
                                              });
                                      });

                                      /* tambah akomodasi ------------------------------------- */
                                      $("#tambah_akomodasi").click(function(){
                                        $('#modal_sedang').modal('show');
                                          $("#tampil_modal").html("<center><br><br><img src='loader.gif' width='150'></center>");                                     
                                            
                                            $.ajax({
                                                 type : 'post',
                                            url: "data_ajax.php",
                                            data: "judul=Input Data Akomodasi&tampil=tambah_akomodasi",
                                            cache: false,
                                            success: function(msg){
                                                  $("#tampil_modal_sedang").html(msg);
                                              }
                                              });
                                      });
                                       /* tambah bon prive ------------------------------------- */
                                      $("#tambah_bon_prive").click(function(){
                                        $('#modal_sedang').modal('show');
                                          $("#tampil_modal").html("<center><br><br><img src='loader.gif' width='150'></center>");                                     
                                            
                                            $.ajax({
                                                 type : 'post',
                                            url: "data_ajax.php",
                                            data: "judul=Input BON PRIVE&tampil=tambah_bon_prive",
                                            cache: false,
                                            success: function(msg){
                                                  $("#tampil_modal_sedang").html(msg);
                                              }
                                              });
                                      });
                                      /* tambah bon panjer ------------------------------------- */
                                      $("#tambah_bon_panjer").click(function(){
                                        $('#modal_sedang').modal('show');
                                          $("#tampil_modal").html("<center><br><br><img src='loader.gif' width='150'></center>");                                     
                                            
                                            $.ajax({
                                                 type : 'post',
                                            url: "data_ajax.php",
                                            data: "judul=Input BON PANJER&tampil=tambah_bon_panjer",
                                            cache: false,
                                            success: function(msg){
                                                  $("#tampil_modal_sedang").html(msg);
                                              }
                                              });
                                      });

                                      /* tambah operasional ------------------------------------- */
                                      $("#tambah_operasional").click(function(){
                                        $('#modal_sedang').modal('show');
                                          $("#tampil_modal").html("<center><br><br><img src='loader.gif' width='150'></center>");                                     
                                            
                                            $.ajax({
                                                 type : 'post',
                                            url: "data_ajax.php",
                                            data: "judul=Input Operasional&tampil=tambah_operasional&bu_kategori=0",
                                            cache: false,
                                            success: function(msg){
                                                  $("#tampil_modal_sedang").html(msg);
                                              }
                                              });
                                      });
                                      /* tambah lain ------------------------------------- */
                                      $("#tambah_lain").click(function(){
                                        $('#modal_sedang').modal('show');
                                          $("#tampil_modal").html("<center><br><br><img src='loader.gif' width='150'></center>");                                     
                                            
                                            $.ajax({
                                                 type : 'post',
                                            url: "data_ajax.php",
                                            data: "judul=Input Operasional&tampil=tambah_lain&bu_kategori=1",
                                            cache: false,
                                            success: function(msg){
                                                  $("#tampil_modal_sedang").html(msg);
                                              }
                                              });
                                      });
                                      </script>