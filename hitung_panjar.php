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
            <h1>Hitung Panjar Pengadilan Agama Kupang</h1>
          </div>
            <form action="rekap_panjar.php" method="post">
              <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                  <div class="card-body" id="dynamic_field_append">
                    <div class="section-title mt-0">Perkara</div>
                      <div class="row">
                        <div class="form-group col-md-6">
                          <label>Jenis Perkara</label>
                          <select class="form-control select2" name="jenis_perkara_id" required>
                            <option value="-">Pilih Jenis Perkara</option>
                            <?=getperkara();?>
                          </select>
                        </div>
                        <div class="form-group col-md-4">
                          <label>Nama Penyetor</label>
                          <input type="text" class="form-control" name="penyetor" required>
                        </div>
                      </div>
                    <div class="section-title mt-0">Pihak</div>
                      <div class="row">
                        <div class="form-group col-md-4">
                          <select class="form-control" name="pihak1">
                            <option value="-" hidden>Pilih Jenis Pihak 1</option>
                            <option value="P">Pemohon/Penggugat</option>
                            <option value="T">Termohon/Tergugat</option>
                          </select>
                        </div>
                        <div class="form-group col-md-4">
                          <select class="form-control select2" name="provinsi1" id="provinsi1">
                          </select>
                        </div>
                        <div class="form-group col-md-4">
                          <select class="form-control select2" name="kabupaten1" id="kabupaten1">
                          </select>
                        </div>
                        <div class="form-group col-md-4">
                          <select class="form-control select2" name="kecamatan1" id="kecamatan1">
                          </select>
                        </div>
                        <div class="form-group col-md-4">
                          <select class="form-control select2" name="kelurahan1" id="kelurahan1">
                          </select>
                        </div>
                        <div class="form-group col-md-4">
                          <input class="form-control" name="biaya_pos1" placeholder="Biaya Pos (Tabayyun)">
                          </select>
                        </div>
                      </div>
                      <div class="row">
                        <div class="form-group col-md-4">
                          <select class="form-control" name="pihak2">
                            <option value="-" hidden>Pilih Jenis Pihak 2</option>
                            <option value="P">Pemohon/Penggugat</option>
                            <option value="T">Termohon/Tergugat</option>
                          </select>
                        </div>
                        <div class="form-group col-md-4">
                          <select class="form-control select2" name="provinsi2" id="provinsi2">
                          </select>
                        </div>
                        <div class="form-group col-md-4">
                          <select class="form-control select2" name="kabupaten2" id="kabupaten2">
                          </select>
                        </div>
                        <div class="form-group col-md-4">
                          <select class="form-control select2" name="kecamatan2" id="kecamatan2">
                          </select>
                        </div>
                        <div class="form-group col-md-4">
                          <select class="form-control select2" name="kelurahan2" id="kelurahan2">
                          </select>
                        </div>
                        <div class="form-group col-md-4">
                          <input class="form-control" name="biaya_pos2" placeholder="Biaya Pos (Tabayyun)">
                          </select>
                        </div>
                      </div>
                      <div class="row">
                        <div class="form-group col-md-4">
                          <select class="form-control" name="pihak3">
                            <option value="-" hidden>Pilih Jenis Pihak 3</option>
                            <option value="P">Pemohon/Penggugat</option>
                            <option value="T">Termohon/Tergugat</option>
                          </select>
                        </div>
                        <div class="form-group col-md-4">
                          <select class="form-control select2" name="provinsi3" id="provinsi3">
                          </select>
                        </div>
                        <div class="form-group col-md-4">
                          <select class="form-control select2" name="kabupaten3" id="kabupaten3">
                          </select>
                        </div>
                        <div class="form-group col-md-4">
                          <select class="form-control select2" name="kecamatan3" id="kecamatan3">
                          </select>
                        </div>
                        <div class="form-group col-md-4">
                          <select class="form-control select2" name="kelurahan3" id="kelurahan3">
                          </select>
                        </div>
                        <div class="form-group col-md-4">
                          <input class="form-control" name="biaya_pos3" placeholder="Biaya Pos (Tabayyun)">
                          </select>
                        </div>
                      </div>
                      <div class="row">
                        <div class="form-group col-md-4">
                          <select class="form-control" name="pihak4">
                            <option value="-" hidden>Pilih Jenis Pihak 4</option>
                            <option value="P">Pemohon/Penggugat</option>
                            <option value="T">Termohon/Tergugat</option>
                          </select>
                        </div>
                        <div class="form-group col-md-4">
                          <select class="form-control select2" name="provinsi4" id="provinsi4">
                          </select>
                        </div>
                        <div class="form-group col-md-4">
                          <select class="form-control select2" name="kabupaten4" id="kabupaten4">
                          </select>
                        </div>
                        <div class="form-group col-md-4">
                          <select class="form-control select2" name="kecamatan4" id="kecamatan4">
                          </select>
                        </div>
                        <div class="form-group col-md-4">
                          <select class="form-control select2" name="kelurahan4" id="kelurahan4">
                          </select>
                        </div>
                        <div class="form-group col-md-4">
                          <input class="form-control" name="biaya_pos4" placeholder="Biaya Pos (Tabayyun)">
                          </select>
                        </div>
                      </div>
                      <div class="row">
                        <div class="form-group col-md-4">
                          <select class="form-control" name="pihak5">
                            <option value="-" hidden>Pilih Jenis Pihak 5</option>
                            <option value="P">Pemohon/Penggugat</option>
                            <option value="T">Termohon/Tergugat</option>
                          </select>
                        </div>
                        <div class="form-group col-md-4">
                          <select class="form-control select2" name="provinsi5" id="provinsi5">
                          </select>
                        </div>
                        <div class="form-group col-md-4">
                          <select class="form-control select2" name="kabupaten5" id="kabupaten5">
                          </select>
                        </div>
                        <div class="form-group col-md-4">
                          <select class="form-control select2" name="kecamatan5" id="kecamatan5">
                          </select>
                        </div>
                        <div class="form-group col-md-4">
                          <select class="form-control select2" name="kelurahan5" id="kelurahan5">
                          </select>
                        </div>
                        <div class="form-group col-md-4">
                          <input class="form-control" name="biaya_pos5" placeholder="Biaya Pos (Tabayyun)">
                          </select>
                        </div>
                      </div>
                      <div class="row">
                        <div class="form-group col-md-4">
                          <select class="form-control" name="pihak6">
                            <option value="-" hidden>Pilih Jenis Pihak 6</option>
                            <option value="P">Pemohon/Penggugat</option>
                            <option value="T">Termohon/Tergugat</option>
                          </select>
                        </div>
                        <div class="form-group col-md-4">
                          <select class="form-control select2" name="provinsi6" id="provinsi6">
                          </select>
                        </div>
                        <div class="form-group col-md-4">
                          <select class="form-control select2" name="kabupaten6" id="kabupaten6">
                          </select>
                        </div>
                        <div class="form-group col-md-4">
                          <select class="form-control select2" name="kecamatan6" id="kecamatan6">
                          </select>
                        </div>
                        <div class="form-group col-md-4">
                          <select class="form-control select2" name="kelurahan6" id="kelurahan6">
                          </select>
                        </div>
                        <div class="form-group col-md-4">
                          <input class="form-control" name="biaya_pos6" placeholder="Biaya Pos (Tabayyun)">
                          </select>
                        </div>
                      </div>
                      <div class="row">
                        <div class="form-group col-md-4">
                          <select class="form-control" name="pihak7">
                            <option value="-" hidden>Pilih Jenis Pihak 7</option>
                            <option value="P">Pemohon/Penggugat</option>
                            <option value="T">Termohon/Tergugat</option>
                          </select>
                        </div>
                        <div class="form-group col-md-4">
                          <select class="form-control select2" name="provinsi7" id="provinsi7">
                          </select>
                        </div>
                        <div class="form-group col-md-4">
                          <select class="form-control select2" name="kabupaten7" id="kabupaten7">
                          </select>
                        </div>
                        <div class="form-group col-md-4">
                          <select class="form-control select2" name="kecamatan7" id="kecamatan7">
                          </select>
                        </div>
                        <div class="form-group col-md-4">
                          <select class="form-control select2" name="kelurahan7" id="kelurahan7">
                          </select>
                        </div>
                        <div class="form-group col-md-4">
                          <input class="form-control" name="biaya_pos7" placeholder="Biaya Pos (Tabayyun)">
                          </select>
                        </div>
                      </div>
                      <div class="row">
                        <div class="form-group col-md-4">
                          <select class="form-control" name="pihak8">
                            <option value="-" hidden>Pilih Jenis Pihak 8</option>
                            <option value="P">Pemohon/Penggugat</option>
                            <option value="T">Termohon/Tergugat</option>
                          </select>
                        </div>
                        <div class="form-group col-md-4">
                          <select class="form-control select2" name="provinsi8" id="provinsi8">
                          </select>
                        </div>
                        <div class="form-group col-md-4">
                          <select class="form-control select2" name="kabupaten8" id="kabupaten8">
                          </select>
                        </div>
                        <div class="form-group col-md-4">
                          <select class="form-control select2" name="kecamatan8" id="kecamatan8">
                          </select>
                        </div>
                        <div class="form-group col-md-4">
                          <select class="form-control select2" name="kelurahan8" id="kelurahan8">
                          </select>
                        </div>
                        <div class="form-group col-md-4">
                          <input class="form-control" name="biaya_pos8" placeholder="Biaya Pos (Tabayyun)">
                          </select>
                        </div>
                      </div>
                      <div class="row">
                        <div class="form-group col-md-4">
                          <select class="form-control" name="pihak9">
                            <option value="-" hidden>Pilih Jenis Pihak 9</option>
                            <option value="P">Pemohon/Penggugat</option>
                            <option value="T">Termohon/Tergugat</option>
                          </select>
                        </div>
                        <div class="form-group col-md-4">
                          <select class="form-control select2" name="provinsi9" id="provinsi9">
                          </select>
                        </div>
                        <div class="form-group col-md-4">
                          <select class="form-control select2" name="kabupaten9" id="kabupaten9">
                          </select>
                        </div>
                        <div class="form-group col-md-4">
                          <select class="form-control select2" name="kecamatan9" id="kecamatan9">
                          </select>
                        </div>
                        <div class="form-group col-md-4">
                          <select class="form-control select2" name="kelurahan9" id="kelurahan9">
                          </select>
                        </div>
                        <div class="form-group col-md-4">
                          <input class="form-control" name="biaya_pos9" placeholder="Biaya Pos (Tabayyun)">
                          </select>
                        </div>
                      </div>
                      <div class="row">
                        <div class="form-group col-md-4">
                          <select class="form-control" name="pihak10">
                            <option value="-" hidden>Pilih Jenis Pihak 10</option>
                            <option value="P">Pemohon/Penggugat</option>
                            <option value="T">Termohon/Tergugat</option>
                          </select>
                        </div>
                        <div class="form-group col-md-4">
                          <select class="form-control select2" name="provinsi10" id="provinsi10">
                          </select>
                        </div>
                        <div class="form-group col-md-4">
                          <select class="form-control select2" name="kabupaten10" id="kabupaten10">
                          </select>
                        </div>
                        <div class="form-group col-md-4">
                          <select class="form-control select2" name="kecamatan10" id="kecamatan10">
                          </select>
                        </div>
                        <div class="form-group col-md-4">
                          <select class="form-control select2" name="kelurahan10" id="kelurahan10">
                          </select>
                        </div>
                        <div class="form-group col-md-4">
                          <input class="form-control" name="biaya_pos10" placeholder="Biaya Pos (Tabayyun)">
                          </select>
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
  <?php include('getlokasi.php');?>  
</body>
</html>
