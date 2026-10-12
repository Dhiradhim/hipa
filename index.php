<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Hitung Perkiraan Panjar Biaya Perkara</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="assets/modules/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/modules/fontawesome/css/all.min.css">

  <!-- CSS Libraries -->
  <link rel="stylesheet" href="assets/modules/jquery-selectric/selectric.css">

  <!-- Template CSS -->
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/components.css">
</head>
<?php
include('koneksi.php');
include('fungsi.php');
?>

<body>
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
            <div class="login-brand">
              <img src="assets/img/pakp.png" alt="logo" width="100" class="shadow-light rounded-circle">
            </div>
            <div class="card card-primary">
              <div class="card-header">
                <h4>Hitung Perkiraan Panjar Biaya Perkara</h4>
              </div>

              <div class="card-body">
                <form method="POST" action="hitung.php">
                  <div class="form-divider">
                    Jenis Perkara
                  </div>
                  <div class="row">
                    <div class="form-group col-6">
                      <label>Jenis</label>
                      <select class="form-control" name="jenis_perkara_id" required>
                        <option value="-" hidden>Pilih Jenis Perkara</option>
                        <?= getperkara(); ?>
                      </select>
                    </div>
                  </div><br>

                  <div class="form-divider">
                    Domisili Pihak Penggugat/Pemohon
                  </div>
                  <div class="row">
                    <div class="form-group col-6">
                      <label>Provinsi</label>
                      <select disabled class="form-control" name="provinsi1" id="provinsi1">
                      </select>
                    </div>
                    <div class="form-group col-6">
                      <label>Kota/Kabupaten</label>
                      <select class="form-control" name="kabupaten1" id="kabupaten1">
                      </select>
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-6">
                      <label>Kecamatan</label>
                      <select class="form-control" name="kecamatan1" id="kecamatan1">
                      </select>
                    </div>
                    <div class="form-group col-6">
                      <label>Kelurahan</label>
                      <select class="form-control" name="kelurahan1" id="kelurahan1">
                      </select>
                    </div>
                  </div><br>

                  <div class="form-divider">
                    Domisili Pihak Tergugat/Termohon
                  </div>
                  <div class="row">
                    <div class="form-group col-6">
                      <label>Provinsi</label>
                      <select class="form-control" name="provinsi2" id="provinsi2">
                      </select>
                    </div>
                    <div class="form-group col-6">
                      <label>Kota/Kabupaten</label>
                      <select class="form-control" name="kabupaten2" id="kabupaten2">
                      </select>
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-6">
                      <label>Kecamatan</label>
                      <select class="form-control" name="kecamatan2" id="kecamatan2">
                      </select>
                    </div>
                    <div class="form-group col-6">
                      <label>Kelurahan</label>
                      <select class="form-control" name="kelurahan2" id="kelurahan2">
                      </select>
                    </div>
                  </div>

                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block">
                      Submit
                    </button>
                  </div>
                </form>
              </div>
            </div>
            <div class="simple-footer">
              Copyright &copy; Pengadilan Agama Kupang 2024
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <!-- General JS Scripts -->
  <script src="assets/modules/jquery.min.js"></script>
  <script src="assets/modules/popper.js"></script>
  <script src="assets/modules/tooltip.js"></script>
  <script src="assets/modules/bootstrap/js/bootstrap.min.js"></script>
  <script src="assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
  <script src="assets/modules/moment.min.js"></script>
  <script src="assets/js/stisla.js"></script>

  <!-- JS Libraies -->
  <script src="assets/modules/jquery-pwstrength/jquery.pwstrength.min.js"></script>
  <script src="assets/modules/jquery-selectric/jquery.selectric.min.js"></script>

  <!-- Page Specific JS File -->
  <script src="assets/js/page/auth-register.js"></script>

  <!-- Template JS File -->
  <script src="assets/js/scripts.js"></script>
  <script src="assets/js/custom.js"></script>

  <?php include('js.php'); ?>
  <?php include('getlokasi.php'); ?>
</body>

</html>