<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>REKAP PANJAR</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="assets/modules/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/modules/fontawesome/css/all.min.css">

  <!-- CSS Libraries -->
  <link rel="stylesheet" href="assets/modules/bootstrap-daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="assets/modules/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css">
  <link rel="stylesheet" href="assets/modules/select2/dist/css/select2.min.css">
  <link rel="stylesheet" href="assets/modules/jquery-selectric/selectric.css">
  <link rel="stylesheet" href="assets/modules/bootstrap-timepicker/css/bootstrap-timepicker.min.css">
  <link rel="stylesheet" href="assets/modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.css">

  <!-- Template CSS -->
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/components.css">
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <!-- Start GA -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-94034622-3');
</script>
<!-- /END GA -->
</head>

<body>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>
      <?php 
      include('navbar.php'); 
      include('sidebar.php');
      include('koneksi.php');
      include('fungsi.php');

      $jenis_perkara_id=$_POST['jenis_perkara_id'];
      $penyetor=$_POST['penyetor'];
      $kelurahan1=$_POST['kelurahan1'];
      $kelurahan2=$_POST['kelurahan2'];
      $kelurahan3=$_POST['kelurahan3'];
      $kelurahan4=$_POST['kelurahan4'];
      $kelurahan5=$_POST['kelurahan5'];
      $kelurahan6=$_POST['kelurahan6'];
      $kelurahan7=$_POST['kelurahan7'];
      $kelurahan8=$_POST['kelurahan8'];
      $kelurahan9=$_POST['kelurahan9'];
      $kelurahan10=$_POST['kelurahan10'];
      $biaya_pos1=$_POST['biaya_pos1'];
      $biaya_pos2=$_POST['biaya_pos2'];
      $biaya_pos3=$_POST['biaya_pos3'];
      $biaya_pos4=$_POST['biaya_pos4'];
      $biaya_pos5=$_POST['biaya_pos5'];
      $biaya_pos6=$_POST['biaya_pos6'];
      $biaya_pos7=$_POST['biaya_pos7'];
      $biaya_pos8=$_POST['biaya_pos8'];
      $biaya_pos9=$_POST['biaya_pos9'];
      $biaya_pos10=$_POST['biaya_pos10'];
      $biaya_pos1=biaya_pos($biaya_pos1);
      $biaya_pos2=biaya_pos($biaya_pos2);
      $biaya_pos3=biaya_pos($biaya_pos3);
      $biaya_pos4=biaya_pos($biaya_pos4);
      $biaya_pos5=biaya_pos($biaya_pos5);
      $biaya_pos6=biaya_pos($biaya_pos6);
      $biaya_pos7=biaya_pos($biaya_pos7);
      $biaya_pos8=biaya_pos($biaya_pos8);
      $biaya_pos9=biaya_pos($biaya_pos9);
      $biaya_pos10=biaya_pos($biaya_pos10);
      $biaya1=biaya($kelurahan1);
      $biaya2=biaya($kelurahan2);
      $biaya3=biaya($kelurahan3);
      $biaya4=biaya($kelurahan4);
      $biaya5=biaya($kelurahan5);
      $biaya6=biaya($kelurahan6);
      $biaya7=biaya($kelurahan7);
      $biaya8=biaya($kelurahan8);
      $biaya9=biaya($kelurahan9);
      $biaya10=biaya($kelurahan10);
      $pihak1=$_POST['pihak1'];
      $pihak2=$_POST['pihak2'];
      $pihak3=$_POST['pihak3'];
      $pihak4=$_POST['pihak4'];
      $pihak5=$_POST['pihak5'];
      $pihak6=$_POST['pihak6'];
      $pihak7=$_POST['pihak7'];
      $pihak8=$_POST['pihak8'];
      $pihak9=$_POST['pihak9'];
      $pihak10=$_POST['pihak10'];

      $alur=alur($jenis_perkara_id);
      
      $field_biaya1=field_biaya($jenis_perkara_id,$pihak1,$biaya1,'1',$biaya_pos1);
      $field_biaya2=field_biaya($jenis_perkara_id,$pihak2,$biaya2,'2',$biaya_pos2);
      $field_biaya3=field_biaya($jenis_perkara_id,$pihak3,$biaya3,'3',$biaya_pos3);
      $field_biaya4=field_biaya($jenis_perkara_id,$pihak4,$biaya4,'4',$biaya_pos4);
      $field_biaya5=field_biaya($jenis_perkara_id,$pihak5,$biaya5,'5',$biaya_pos5);
      $field_biaya6=field_biaya($jenis_perkara_id,$pihak6,$biaya6,'6',$biaya_pos6);
      $field_biaya7=field_biaya($jenis_perkara_id,$pihak7,$biaya7,'7',$biaya_pos7);
      $field_biaya8=field_biaya($jenis_perkara_id,$pihak8,$biaya8,'8',$biaya_pos8);
      $field_biaya9=field_biaya($jenis_perkara_id,$pihak9,$biaya9,'9',$biaya_pos9);
      $field_biaya10=field_biaya($jenis_perkara_id,$pihak10,$biaya10,'10',$biaya_pos10);

      $biaya_panggilan1=biaya_panggilan($jenis_perkara_id,$pihak1,$biaya1,'1',$biaya_pos1);
      $biaya_panggilan2=biaya_panggilan($jenis_perkara_id,$pihak2,$biaya2,'2',$biaya_pos2);
      $biaya_panggilan3=biaya_panggilan($jenis_perkara_id,$pihak3,$biaya3,'3',$biaya_pos3);
      $biaya_panggilan4=biaya_panggilan($jenis_perkara_id,$pihak4,$biaya4,'4',$biaya_pos4);
      $biaya_panggilan5=biaya_panggilan($jenis_perkara_id,$pihak5,$biaya5,'5',$biaya_pos5);
      $biaya_panggilan6=biaya_panggilan($jenis_perkara_id,$pihak6,$biaya6,'6',$biaya_pos6);
      $biaya_panggilan7=biaya_panggilan($jenis_perkara_id,$pihak7,$biaya7,'7',$biaya_pos7);
      $biaya_panggilan8=biaya_panggilan($jenis_perkara_id,$pihak8,$biaya8,'8',$biaya_pos8);
      $biaya_panggilan9=biaya_panggilan($jenis_perkara_id,$pihak9,$biaya9,'9',$biaya_pos9);
      $biaya_panggilan10=biaya_panggilan($jenis_perkara_id,$pihak10,$biaya10,'10',$biaya_pos10);
      
      $panjar = $biaya_panggilan1 + $biaya_panggilan2 + $biaya_panggilan3 + $biaya_panggilan4 + $biaya_panggilan5 + $biaya_panggilan6 + $biaya_panggilan7 + $biaya_panggilan8 + $biaya_panggilan9 + $biaya_panggilan10 + 190000;
      $rp_panjar = rp($panjar);

      $sql = "SELECT nama, alur FROM jenis_perkara where jenis_perkara_id='$jenis_perkara_id'";
      $query = mysqli_query($con,$sql);
      $row = mysqli_fetch_assoc($query);
      ?>

      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Taksiran Panjar Biaya Perkara Pengadilan Agama Kupang</h1>
          </div>
            <form action="rekap_panjar_save.php" method="post">
              <div class="row">
                <div class="col-12 col-md-6 col-lg-6">
                    <div class="card">
                      <div class="card-body">
                        <div class="section-title mt-0">Taksiran Panjar Perkara</div>
                        <div class="form-group">
                          <label>Jenis Perkara</label>
                          <input type="text" class="form-control" readonly value="<?=$row['nama']?> [<?=$row['alur']?>]">
                        </div>
                        <div class="form-group">
                          <label>Nama Penyetor</label>
                          <input type="text" class="form-control" name="penyetor" readonly value="<?=$penyetor?>">
                        </div>
                        <div class="form-group">
                          <label>Total Taksiran Panjar Perkara</label>
                          <input type="text" class="form-control" readonly value="<?=$rp_panjar?>">
                          <input type="hidden" class="form-control" name="biaya" value="<?=$panjar?>">
                          <input type="hidden" class="form-control" name="untuk" value="Panjar Biaya Perkara Tingkat Pertama">
                          <input type="hidden" class="form-control" name="alur" value="<?=$alur?>">
                        </div>
                        <button name="simpan" id="simpan" value="simpan" type=submit class="btn btn-primary">SIMPAN</button>
                        <button class="btn btn-danger" onclick="window.history.back()" type="button">BATAL</button>
                      </div>
                    </div>
                  </div>
                  <div class="section-body">
                </div>
                <div class="col-12 col-md-6 col-lg-6">
                    <div class="card">
                      <div class="card-body">
                      <div class="section-title mt-0">Rincian Biaya</div>
                        <div class="form-group">
                          <label>PNBP Pendaftaran</label>
                          <input type="text" class="form-control" readonly value="<?=rp(30000)?>">
                        </div>
                        <div class="form-group">
                          <label>Biaya Proses</label>
                          <input type="text" class="form-control" readonly value="<?=rp(100000)?>">
                        </div>
                        <?=$field_biaya1;?>
                        <?=$field_biaya2;?>
                        <?=$field_biaya3;?>
                        <?=$field_biaya4;?>
                        <?=$field_biaya5;?>
                        <?=$field_biaya6;?>
                        <?=$field_biaya7;?>
                        <?=$field_biaya8;?>
                        <?=$field_biaya9;?>
                        <?=$field_biaya10;?>
                        <div class="form-group">
                          <label>Redaksi</label>
                          <input type="text" class="form-control" readonly value="<?=rp(10000)?>">
                        </div>
                        <div class="form-group">
                          <label>Materai</label>
                          <input type="text" class="form-control" readonly value="<?=rp(10000)?>">
                        </div>
                        <div class="form-group">
                          <label>PNBP Panggilan (PBT)</label>
                          <input type="text" class="form-control" readonly value="<?=rp(40000)?>">
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="section-body">
                </div>
              </div>
           </form>
        </section>
      </div>
      <footer class="main-footer">
        <div class="footer-left">
          Copyright &copy; 2023 <div class="bullet"></div> Pengadilan Agama Kupang</a>
        </div>
        <div class="footer-right">
          
        </div>
      </footer>
    </div>
  </div>
  <?php include('js.php');?> 
</body>
</html>
