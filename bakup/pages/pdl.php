     <?php
     include  "lib/koneksi.php";

  /* ---------------------------------------------- simpanan ------------------------ */
  if(isset($_POST['tambah_simpanan'])){
    $simpanan_id                 = $_POST['simpanan_id'];
    $simpanan_tgl                   = $_POST['simpanan_tgl'];
    $resort_id               = $_POST['resort_id'];
    $anggota_id                = $_POST['anggota_id'];
    $pinjaman_ke            = $_POST['pinjaman_ke'];
    $pinjaman               = $_POST['pinjaman'];
    $psp                    = $pinjaman*0.04;
 

    
        if($simpanan_id!=""){
          $up=mysqli_query($con,"update tbl_simpanan set resort_id='$resort_id',
            anggota_id='$anggota_id',pinjaman_ke='$pinjaman_ke',pinjaman='$pinjaman',psp='$psp' where simpanan_id='$simpanan_id'");
          
          if($up){
            ?>
            <script type="text/javascript">
              toastr.success('Perubahan data berhasil disimpan');
            </script>
            <?php
          }else{
            ?>
            <script type="text/javascript">
              toastr.error('Perubahan data gagal disimpan');
            </script>
            <?php
          }
        }else{
          //$pegawai_id = date("Ymdhis");
/*
          $qcek = mysqli_query($con,"select simpanan_id from tbl_simpanan where simpanan_tgl='$simpanan_tgl' and anggota_id='$anggota_id'");
          
          $cek = mysqli_num_rows($qcek);
          if($cek>0){
            ?>
            <script type="text/javascript">
              alert("Data Peserta tanggal tersebut sudah diinput");
              toastr.error('Data Peserta tanggal tersebut sudah diinput');
            </script>
            <?php
          }else{
  */        
           $simpanan_id = "SIMP".round(microtime(true) * 1000);
          
          //echo "insert into tbl_simpanan (simpanan_id,simpanan_tgl,resort_id,anggota_id,pinjaman,pinjaman_ke,psp) values('$simpanan_id','$simpanan_tgl','$resort_id','$anggota_id','$pinjaman','$pinjaman_ke','$psp')";
          $up=mysqli_query($con,"insert into tbl_simpanan (simpanan_id,simpanan_tgl,resort_id,anggota_id,pinjaman,pinjaman_ke,psp) values('$simpanan_id','$simpanan_tgl','$resort_id','$anggota_id','$pinjaman','$pinjaman_ke','$psp')");
         
          if($up){
            ?>
            <script type="text/javascript">
              toastr.success('Tambah data berhasil disimpan');
            </script>
            <?php
          }else{
            ?>
            <script type="text/javascript">
              toastr.error('Tambah data gagal disimpan');
            </script>
            <?php
    //      }
         }
        }       
      }

if(isset($_POST['hapus_simpanan'])){
    $simpanan_id           = $_POST['simpanan_id'];
   
      $up=mysqli_query($con,"delete from tbl_simpanan where simpanan_id='$simpanan_id'");
      if($up){
        ?>
        <script type="text/javascript">
          toastr.success('Data terhapus');
        </script>
        <?php
      }else{
        ?>
        <script type="text/javascript">
          toastr.error('Data tidak terhapus');
        </script>
        <?php
      }   
    
  }

  /* ---------------------------------------------- simpanan ------------------------ */
  if(isset($_POST['tambah_pinjaman'])){
    $pinjaman_id                 = $_POST['pinjaman_id'];
    $pinjaman_tgl                   = $_POST['pinjaman_tgl'];
    $resort_id               = $_POST['resort_id'];
    $anggota_id                = $_POST['anggota_id'];
    $pinjaman_ke            = $_POST['pinjaman_ke'];
    $bp               = $_POST['bp'];
   
    
        if($pinjaman_id!=""){
          $up=mysqli_query($con,"update tbl_pinjaman set resort_id='$resort_id',
            anggota_id='$anggota_id',pinjaman_ke='$pinjaman_ke',bp='$bp' where pinjaman_id='$pinjaman_id'");
          
          if($up){
            ?>
            <script type="text/javascript">
              toastr.success('Perubahan data berhasil disimpan');
            </script>
            <?php
          }else{
            ?>
            <script type="text/javascript">
              toastr.error('Perubahan data gagal disimpan');
            </script>
            <?php
          }
        }else{
          //$pegawai_id = date("Ymdhis");
          /*
          $qcek = mysqli_query($con,"select pinjaman_id from tbl_pinjaman where pinjaman_tgl='$pinjaman_tgl' and anggota_id='$anggota_id'");
          
          $cek = mysqli_num_rows($qcek);
          if($cek>0){
            ?>
            <script type="text/javascript">
              alert("Data Peserta tanggal tersebut sudah diinput");
              toastr.error('Data Peserta tanggal tersebut sudah diinput');
            </script>
            <?php
          }else{
          */
           $pinjaman_id = "PINJ".round(microtime(true) * 1000);
          
          
          $up=mysqli_query($con,"insert into tbl_pinjaman (pinjaman_id,pinjaman_tgl,resort_id,anggota_id,bp,pinjaman_ke) values('$pinjaman_id','$pinjaman_tgl','$resort_id','$anggota_id','$bp','$pinjaman_ke')");
         
          if($up){
            ?>
            <script type="text/javascript">
              toastr.success('Tambah data berhasil disimpan');
            </script>
            <?php
          }else{
            ?>
            <script type="text/javascript">
              toastr.error('Tambah data gagal disimpan');
            </script>
            <?php
          }
         //}
        }       
      }

if(isset($_POST['hapus_pinjaman'])){
    $pinjaman_id           = $_POST['pinjaman_id'];
   
      $up=mysqli_query($con,"delete from tbl_pinjaman where pinjaman_id='$pinjaman_id'");
      if($up){
        ?>
        <script type="text/javascript">
          toastr.success('Data terhapus');
        </script>
        <?php
      }else{
        ?>
        <script type="text/javascript">
          toastr.error('Data tidak terhapus');
        </script>
        <?php
      }   
    
  }

   
?>
<div class="row">
  <div class="col-md-12">
    <br>
    <br>
    <div class="card">
              <div class="card-header bg-gray-dark" >
                <h5 class="card-title">Filter Data</h5>

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
                <div class="col-md-3">
                  <label>Resort</label><br>
                <select id="pdl_resort_id" class="form-control select2" style="width: 100%" required>
                                 <?php 
                                if($LEVEL=="1"){
                                  $qresort = mysqli_query($con,"select * from tbl_resort ");
                                }else{
                                    $qresort = mysqli_query($con,"select * from tbl_resort where pegawai_id = '$USERNAME'");
                                }
                                while($data_resort    = mysqli_fetch_array($qresort,MYSQLI_ASSOC)){
                                  $resort_id_data     = $data_resort['resort_id'];
                                  if($resort_id_data==$resort_id){
                                    $pilih   = "selected";
                                  }else{ 
                                    $pilih   = "";
                                  }
                                ?>
                                  <option value="<?php echo $data_resort['resort_id']?>" <?php echo $pilih;?>><?php echo $data_resort['resort_nama']?></option>
                              <?php } 
                              if($LEVEL=="1"){                     ?>
                               <option value="">Semua resort</option>
                             <?php } ?>
                              </select>
                  </div>
                  <div class="col-md-3">
                    <label>Tanggal</label><br>
              <select id="pdl_tgl" class="form-control select2" style="width: 100%" required>
                                  <option value="">Pilih Tanggal</option>

            <?php
            $kalender     = CAL_GREGORIAN;
                    $bulan_get    = substr($bulan, 5,2);
                    $tahun_get    = substr($bulan, 0,4);
                    $jum_hari     = cal_days_in_month($kalender, $bulan_get, $tahun_get);

            for($x=1;$x<=$jum_hari;$x++){
              if($x<10){
                $tgl_ini = $bulan."-0".$x;
              }else{
                $tgl_ini = $bulan."-".$x;
              }
              if($tgl_ini==date("Y-m-d")){
                                    $pilih   = "selected";
                                  }else{
                                    $pilih   = "";
                                  }
                                ?>
                                  <option value="<?php echo $tgl_ini;?>" <?php echo $pilih;?>><?php echo tanggal($tgl_ini);?></option>

           <?php
            }
              
              ?>
            </select>
            <input type="hidden" id="tab" value="<?php echo $_POST['tab'];?>">
          </div>
		<div class="col-md-3">
		<label>Nama Anggota</label><br>
		<input type="text" id="nama" class="form-control">
		</div>
          <div class="col-md-2">
            <br>

            <button class="btn btn-primary btn-sm" id="tampil_data_pdl">Tampilkan</button>
          </div>
        </div>
              </div>
            </div>
          </div> 
</div>