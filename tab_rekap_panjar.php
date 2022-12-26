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
      $biaya1=$_POST['biaya1'];
      $x_biaya2=$_POST['biaya2'];
      $x_pos=$_POST['pos'];
      $pos = preg_replace("/[^0-9]/", '', $x_pos);
      $xx_biaya2 = preg_replace("/[^0-9]/", '', $x_biaya2);
      $biaya2 = $xx_biaya2 + $pos + 20000;
      $pihak1=$_POST['pihak1'];
      $pihak2=$_POST['pihak2'];

      $alur=alur($jenis_perkara_id);
      
      $field_biaya1=field_biaya($jenis_perkara_id,$pihak1,$biaya1,'1');
      $field_biaya2=field_biaya($jenis_perkara_id,$pihak2,$biaya2,'2');

      $biaya_panggilan1=biaya_panggilan($jenis_perkara_id,$pihak1,$biaya1,'1');
      $biaya_panggilan2=biaya_panggilan($jenis_perkara_id,$pihak2,$biaya2,'2');

      $panjar = $biaya_panggilan1 + $biaya_panggilan2 + 190000;
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
            <form action="rekap_panjar.php" method="post">
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

<?php  
  
include("koneksi.php");  
  
if(isset($_POST['simpan']))  
{  
  $penyetor = $_POST['penyetor'];
  $biaya = $_POST['biaya'];
  $untuk = $_POST['untuk'];
  $alur = $_POST['alur'];
  $sql = "INSERT INTO skum (penyetor,biaya,untuk,alur) VALUES ('$penyetor','$biaya','$untuk','$alur')";
  // echo $sql;
  $query = mysqli_query($con,$sql);
  echo "<script type='text/javascript'>alert('Data Tersimpan');</script>";
  echo "<script type='text/javascript'>window.location.href='data_panjar.php'</script>";
}  
?>  