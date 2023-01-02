<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>DATA KOMDANAS</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="assets/modules/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/modules/fontawesome/css/all.min.css">

  <!-- CSS Libraries -->
  <link rel="stylesheet" href="assets/modules/datatables/datatables.min.css">
  <link rel="stylesheet" href="assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="assets/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css">

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
<!-- /END GA --></head>

<body>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>
      <?php
      function rp($angka){
        $hasil_rupiah = "Rp " . number_format($angka,2,',','.');
        return $hasil_rupiah;
      }
        include('navbar.php'); 
        include('sidebar.php');
        include('koneksi.php');

        $sql = "SELECT * FROM data_komdanas";
        $query = mysqli_query($con,$sql);
        $row = mysqli_fetch_assoc($query);
        $no = 1;
      ?>
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Data Biaya Panggilan Seluruh Indonesia</h1>
            
          </div>

          <div class="section-body">
            
          <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Tabel Data Biaya Panggilan</h4>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-striped" id="table-1">
                        <thead>                                 
                          <tr>
                            <th>No.</th>
                            <th>Nama Satker</th>
                            <th>Kode Satker</th>
                            <th>Kota/Kab</th>
                            <th>Kecamatan</th>
                            <th>Kelurahan</th>
                            <th>Biaya Panggilan</th>
                          </tr>
                        </thead>
                        <tbody>    
                            <?php
                            do { ?>
                              <tr>
                              <td><?=$no?></td>
                              <td><?=$row['satker_name']?></td>
                              <td><?=$row['satker_code']?></td>
                              <td><?=$row['kabkota']?></td>
                              <td><?=$row['kec']?></td>
                              <td><?=$row['kel']?></td>
                              <td><?=rp($row['nilai'])?></td>
                              </tr>
                            <?php
                            $no++;
                            } while ($row = mysqli_fetch_assoc($query));
                            ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
      <?php include('footer.php');?>
    </div>
  </div>
  <?php include('js.php');?>
  
</body>
</html>