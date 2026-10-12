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
  <!-- Start GA -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
  <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
      dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'UA-94034622-3');
  </script>
  <!-- /END GA -->
</head>
<?php
include('koneksi.php');
include('fungsi.php');

// Ambil & validasi input POST agar aman dari tipe data tak terduga.
$jenis_perkara_id = isset($_POST['jenis_perkara_id']) ? (int) $_POST['jenis_perkara_id'] : 0;
$kelurahan1       = isset($_POST['kelurahan1']) ? (int) $_POST['kelurahan1'] : 0;
$kelurahan2       = isset($_POST['kelurahan2']) ? (int) $_POST['kelurahan2'] : 0;

$biaya_pos1 = 0;
$biaya_pos2 = 0;

$biaya1 = biaya($kelurahan1);
$pihak1 = "P";
$field_biaya1 = field_biaya($jenis_perkara_id, $pihak1, $biaya1, '1', $biaya_pos1);
$biaya_panggilan1 = biaya_panggilan($jenis_perkara_id, $pihak1, $biaya1, '1', $biaya_pos1);

$alur = alur($jenis_perkara_id);


if ($kelurahan2 == 0) {
  $field_biaya2 = "<div class='form-group col-6'><label>Panggilan Tergugat/Termohon</label><input type='text' class='form-control' readonly value='Rp0.00'></div>";
  $biaya_panggilan2 = 0;
} else {
  $biaya2 = biaya($kelurahan2);
  $pihak2 = "T";
  $field_biaya2 = field_biaya($jenis_perkara_id, $pihak2, $biaya2, '2', $biaya_pos2);
  $biaya_panggilan2 = biaya_panggilan($jenis_perkara_id, $pihak2, $biaya2, '2', $biaya_pos2);
}

$panjar = $biaya_panggilan1 + $biaya_panggilan2 + 190000;
$rp_panjar = rp($panjar);

// Prepared statement mencegah SQL Injection.
$row = array('nama' => '', 'alur' => '');
$sql  = "SELECT nama, alur FROM jenis_perkara WHERE jenis_perkara_id=? LIMIT 1";
$stmt = mysqli_prepare($con, $sql);
if ($stmt !== false) {
  mysqli_stmt_bind_param($stmt, 'i', $jenis_perkara_id);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);
  $fetched = mysqli_fetch_assoc($result);
  if ($fetched) {
    $row = $fetched;
  }
  mysqli_stmt_close($stmt);
}
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
                <form>
                  <div class="form-divider">
                    Jenis Perkara
                  </div>
                  <div class="row">
                    <div class="form-group col-6">
                      <label>Jenis</label>
                      <input type="text" class="form-control" readonly value="<?= h($row['nama']) ?> [<?= h($row['alur']) ?>]">
                    </div>
                  </div><br><br>

                  <div class="form-divider">
                    Rincian Biaya
                  </div>
                  <div class="row">
                    <div class="form-group col-6">
                      <label>PNBP Pendaftaran</label>
                      <input type="text" class="form-control" readonly value="<?= rp(30000) ?>">
                    </div>
                    <div class="form-group col-6">
                      <label>Biaya Proses</label>
                      <input type="text" class="form-control" readonly value="<?= rp(100000) ?>">
                    </div>
                  </div>
                  <div class="row">
                    <?= $field_biaya1; ?>
                    <?= $field_biaya2; ?>
                  </div>
                  <div class="row">
                    <div class="form-group col-6">
                      <label>Redaksi</label>
                      <input type="text" class="form-control" readonly value="<?= rp(10000) ?>">
                    </div>
                    <div class="form-group col-6">
                      <label>Materai</label>
                      <input type="text" class="form-control" readonly value="<?= rp(10000) ?>">
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-6">
                      <label>PNBP Panggilan</label>
                      <input type="text" class="form-control" readonly value="<?= rp(40000) ?>">
                    </div>
                  </div><br><br>

                  <div class="form-divider">
                    Total Panjar Biaya Perkara
                  </div>
                  <div class="row">
                    <div class="form-group col-6">
                      <input type="text" class="form-control" readonly value="<?= $rp_panjar ?>">
                    </div>
                  </div>
                  <div class="form-divider">
                    Catatan
                  </div>
                  <div class="row">
                    <div class="form-group col-12">
                      <label>* Biaya diatas belum termasuk biaya pengiriman POS jika pihak yang berperkara berada diluar wilayah yurisdiksi Pengadilan Agama Kupang</label>
                      <label>* Untuk mendapatkan biaya yang lebih murah dapat berperkara secara online melalui e-Court. Info lebih lanjut hubungi Whatsapp PTSP PA Kupang (0811 3810 0104)</label>
                      <button class="btn btn-warning" onclick="window.location.href='index.php'" type="button">Kembali ke Halaman Utama</button>
                    </div>
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