<?php session_start();

      $USERNAME   = $_SESSION['USERNAME'];
      $USER_ID       = $_SESSION['USER_ID'];
      $NAMA       = $_SESSION['NAMA'];
      $LEVEL           = $_SESSION['LEVEL'];
      $bulan           = $_SESSION['BULAN'];
include   "css.php";
include 	"../lib/koneksi.php";
	//baru
	$q		= mysqli_query($con,"select a.anggota_id,anggota_nama,anggota_alamat,b.resort_nama,a.tgl_daftar from tbl_anggota a LEFT JOIN tbl_resort b on a.resort_id=b.resort_id where a.tgl_daftar like '$bulan%'");
	$anggota_baru 	= mysqli_num_rows($q);
	//lama 
	$q1		= mysqli_query($con,"select a.anggota_id,anggota_nama,anggota_alamat,b.resort_nama,a.tgl_daftar from tbl_anggota a LEFT JOIN tbl_resort b on a.resort_id=b.resort_id where a.tgl_daftar not like '$bulan%'");
	$anggota_lama 	= mysqli_num_rows($q1);
	//aktif
	$q2		= mysqli_query($con,"select a.anggota_id,anggota_nama,anggota_alamat,b.resort_nama,a.tgl_daftar from tbl_anggota a LEFT JOIN tbl_resort b on a.resort_id=b.resort_id where a.keterangan ='A'");
	$anggota_aktif 	= mysqli_num_rows($q2);
	//keluar 
	$q3		= mysqli_query($con,"select a.anggota_id,anggota_nama,anggota_alamat,b.resort_nama,a.tgl_daftar from tbl_anggota a LEFT JOIN tbl_resort b on a.resort_id=b.resort_id where a.tgl_keluar like '$bulan%'");
	$anggota_keluar	= mysqli_num_rows($q3);


?>
<br>
 <h2>Data Bulan <?php echo tanggal($bulan);?></h2>


<div class="row">
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box bg-gray">
              <span class="info-box-icon"><i class="far fa-envelope"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Anggota Lalu</span>
                <span class="info-box-number"><?php echo angka($anggota_lama);?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box bg-success">
              <span class="info-box-icon "><i class="far fa-flag"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Anggota Baru</span>
                <span class="info-box-number"><?php echo angka($anggota_baru);?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box bg-danger">
              <span class="info-box-icon "><i class="far fa-copy"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Anggota Keluar</span>
                <span class="info-box-number"><?php echo angka($anggota_keluar);?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box bg-navy">
              <span class="info-box-icon"><i class="far fa-star"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Anggota Saat Ini</span>
                <span class="info-box-number"><?php echo angka($anggota_aktif);?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>

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
                    <table id="example1" class="table table-bordered table-hover" style="width:100%">
                      <thead>
                        <tr class="small bg-gray">
                          <th>No</th>
                          <th>Nama Anggota</th>
                          <th>Alamat</th>
                          <th>Tgl Daftar</th>
                          <th>Resort</th> 
                          <!--
                          <th>Pinjaman</th>
                          <th>Simpanan</th>
                          -->                         
                        </tr>
                      </thead>
                      <tbody>
                      	<?php 
                      	$no=1;
                      	while($haktif		= mysqli_fetch_array($q2,MYSQLI_ASSOC)){
                   		?>
                        <tr class="small">
                          <td><?php echo $no;?></td>
                          <td><?php echo $haktif['anggota_nama'];?></td>
                          <td><?php echo $haktif['anggota_alamat'];?></td>
                          <td><?php echo tanggal($haktif['tgl_daftar']);?></td>
                          <td><?php echo $haktif['resort_nama'];?></td>
                          <!--
                          <td><?php echo angka(0);?></td>
                          <td><?php echo angka(0);?></td>
                        -->
                        </tr>
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
          <!-- /.col -->
          <div class="col-md-6">
            <div class="card">
              <div class="card-header bg-gray-dark" >
                <h5 class="card-title">Data Anggota Baru</h5>

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
                  	<?php
                  	if($anggota_baru==0){
                  		echo "<div class='alert alert-danger'>Tidak ada data</div>";
                  	}else{
                  	?>
                    <table id="example2" class="table table-bordered table-hover" style="width:100%">
                      <thead>
                        <tr class="small bg-gray">
                          <th>No</th>
                          <th>Nama Anggota</th>
                          <th>Alamat</th>
                          <th>Tgl Daftar</th>
                          <th>Resort</th>                          
                        </tr>
                      </thead>
                      <tbody>
                      	<?php 
                      	$no=1;
                      	while($hbaru		= mysqli_fetch_array($q,MYSQLI_ASSOC)){
                   		?>
                        <tr class="small">
                          <td><?php echo $no;?></td>
                          <td><?php echo $hbaru['anggota_nama'];?></td>
                          <td><?php echo $hbaru['anggota_alamat'];?></td>
                          <td><?php echo tanggal($hbaru['tgl_daftar']);?></td>
                          <td><?php echo $hbaru['resort_nama'];?></td>
                        </tr>
                    <?php $no++;} ?>
                      </tbody>
                    </table>
                <?php } ?>
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
          <div class="col-md-6">
            <div class="card">
              <div class="card-header bg-gray-dark" >
                <h5 class="card-title">Data Anggota Keluar</h5>

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
                  	<?php
                  	if($anggota_keluar==0){
                  		echo "<div class='alert alert-danger'>Tidak ada data</div>";
                  	}else{
                  	?>
                    <table id="example3" class="table table-bordered table-hover" style="width:100%">
                      <thead>
                        <tr class="small bg-gray">
                          <th>No</th>
                          <th>Nama Anggota</th>
                          <th>Alamat</th>
                          <th>Tgl Keluar</th>
                          <th>Resort</th>                          
                        </tr>
                      </thead>
                      <tbody>
                      	<?php 
                      	$no=1;
                      	while($hkeluar		= mysqli_fetch_array($q3,MYSQLI_ASSOC)){
                   		?>
                        <tr class="small">
                          <td><?php echo $no;?></td>
                          <td><?php echo $hkeluar['anggota_nama'];?></td>
                          <td><?php echo $hkeluar['anggota_alamat'];?></td>
                          <td><?php echo tanggal($hkeluar['tgl_keluar']);?></td>
                          <td><?php echo $hkeluar['resort_nama'];?></td>
                        </tr>
                    <?php $no++;} ?>
                      </tbody>
                    </table>
                <?php }?>
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
        