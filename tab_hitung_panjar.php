<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>HITUNG PANJAR</title>

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
      ?>

      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Hitung Panjar Tabayyun Pengadilan Agama Kupang</h1>
          </div>
            <form action="tab_rekap_panjar.php" method="post">
              <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                  <div class="card-body" id="dynamic_field_append">
                    <div class="section-title mt-0">Perkara</div>
                      <div class="row">
                        <div class="form-group col-md-6">
                          <label>Jenis Perkara</label>
                          <select class="form-control select2" name="jenis_perkara_id">
                            <option value="-">Pilih Jenis Perkara</option>
                            <?=getperkara();?>
                          </select>
                        </div>
                        <div class="form-group col-md-4">
                          <label>Nama Penyetor</label>
                          <input type="text" class="form-control" name="penyetor">
                        </div>
                      </div>
                    <div class="section-title mt-0">Pihak</div>
                      <div class="row">
                        <div class="form-group col-md-4">
                          <select class="form-control" name="pihak1">
                            <option value="-" hidden>Pilih Jenis Pihak</option>
                            <option value="P">Pemohon/Penggugat</option>
                            <option value="T">Termohon/Tergugat</option>
                          </select>
                        </div>
                        <div class="form-group col-md-6">
                          <select class="form-control select2" name="biaya1">
                            <option value="-" hidden>Pilih Lokasi</option>
                            <?=getlokasi();?>
                          </select>
                        </div>
                      </div>
                      <div class="row">
                        <div class="form-group col-md-4">
                          <select class="form-control" name="pihak2">
                            <option value="-" hidden>Pilih Jenis Pihak</option>
                            <option value="P">Pemohon/Penggugat</option>
                            <option value="T">Termohon/Tergugat</option>
                          </select>
                        </div>
                        <div class="form-group col-md-6">
                          <input class="form-control" name="biaya2" type="text" id="rupiah" placeholder="Masukkan Biaya Panggilan">
                        </div>
                      </div>
                      <div class="section-title mt-0">Biaya Wesel & Pos</div>
                      <div class="row">
                        <div class="form-group col-md-4">
                          <input class="form-control" disabled value="WESEL">
                        </div>
                        <div class="form-group col-md-6">
                          <input class="form-control" disabled name="wesel" value="<?=rp(20000)?>">
                        </div>
                      </div>
                      <div class="row">
                        <div class="form-group col-md-4">
                          <input class="form-control" disabled value="POS">
                        </div>
                        <div class="form-group col-md-6">
                          <input class="form-control" name="pos" type="text" id="rupiah2" placeholder="Masukkan Biaya Pos">
                        </div>
                      </div>
                      </div>
                    </div>
                  </div>
                    <button name="submit" id="submit" value="submit" type=submit class="btn btn-primary">TAKSIR PANJAR</button>
                    <button class="btn btn-danger" onclick="window.history.back()" type="button">BATAL</button>
                </div>
              </div>
            </form>
            <div class="section-body">
          </div>
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
