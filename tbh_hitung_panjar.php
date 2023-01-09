<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>TAMBAH PANJAR</title>

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
            <h1>TAMBAH Panjar Pengadilan Agama Kupang</h1>
          </div>
            <form action="tbh_panjar_save.php" method="post">
              <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                  <div class="card-body" id="dynamic_field_append">
                    <div class="section-title mt-0">Penyetor</div>
                    <div class="row">
                        <div class="form-group col-md-4">
                          <label>No. Perkara</label>
                          <select class="form-control select2" name="no_perkara">
                            <option value="-" hidden>Pilih Perkara</option>
                            <?=getperkarasipp();?>
                          </select>
                        </div>
                        <div class="form-group col-md-4">
                          <label>Nama Penyetor</label>
                          <input type="text" class="form-control" name="penyetor" required>
                        </div>
                      </div>
                      <div class="row">
                        <div class="form-group col-md-4">
                          <label>Biaya Panjar</label>
                          <input type="text" class="form-control" id="rupiah" name="biaya" required>
                        </div>
                        <div class="form-group col-md-4">
                          <label>Untuk: </label>
                          <select class="form-control" name="untuk">
                            <option value="-" hidden>Pilih Jenis Pembayaran</option>
                            <option value="Panjar Biaya Perkara Tingkat Pertama">Panjar Biaya Perkara Tingkat Pertama</option>
                            <option value="Panjar Biaya Perkara Tingkat Pertama">Panjar Biaya Perkara Tingkat Banding</option>
                            <option value="Panjar Biaya Perkara Tingkat Pertama">Panjar Biaya Perkara Tingkat Kasasi</option>
                            <option value="Tambahan Panjar Biaya Perkara Tingkat Pertama">Tambahan Panjar Biaya Perkara Tingkat Pertama</option>
                          </select>
                        </div>
                      </div>
                    
                    </div>
                  </div>
                    <button name="submit" id="submit" value="submit" type=submit class="btn btn-primary">TAMBAH PANJAR</button>
                    <button class="btn btn-danger" onclick="window.history.back()" type="button">BATAL</button>
                </div>
              </div>
            </form>
            <div class="section-body">
          </div>
        </section>
      </div>
      <?php include('footer.php');?>
    </div>
  </div>
  <?php include('js.php');?>  
</body>
</html>
