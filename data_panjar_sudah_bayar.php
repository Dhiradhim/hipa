<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>DATA PANJAR</title>

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

        $sql = "SELECT * FROM skum WHERE bayar=1 ORDER BY id DESC ";
        $query = mysqli_query($con,$sql);
        $row = mysqli_fetch_assoc($query);
        $no = 1;
      ?>
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Data Taksiran Panjar Pengadilan Agama Kupang</h1>
            
          </div>

          <div class="section-body">
            
          <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Tabel Data Panjar</h4>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-striped" id="table-1">
                        <thead>                                 
                          <tr>
                            <th>No.</th>
                            <th>No. SKUM</th>
                            <th>Tanggal Bayar</th>
                            <th>No. Perkara</th>
                            <th>Nama Penyetor</th>
                            <th>Taksiran Panjar Biaya</th>
                            <th>Uraian</th>
                            <th>Status</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>    
                            <?php
                            do { ?>
                              <tr>
                              <td><?=$no?></td>
                              <td><?=$row['no_skum']?></td>
                              <td><?=$row['tanggal']?></td>
                              <td><?=$row['no_perkara']?></td>
                              <td><?=$row['penyetor']?></td>
                              <td><?=rp($row['biaya']);?></td>
                              <td><?=$row['untuk']?></td>
                              <td>
                                <?php
                                if ($row['bayar']=='0'){
                                  echo '<div class="badge badge-warning">Belum Bayar</div>';
                                } else {
                                echo '<div class="badge badge-success">Sudah Bayar</div>';
                                }
                                ?>
                              </td>
                              <td width=15%>
                                <?php if ($row['bayar']=='0'){ ?>
                                  <a href="cetak_skum2.php?id=<?=$row['id'];?>" target="_blank" class="btn btn-icon btn-success"><i class="fa-solid fa-print" data-toggle="tooltip" data-placement="top" title="Cetak Form Bayar"></i></a>
								  <a href="bayar_panjar.php?id=<?=$row['id'];?>&alur_p=<?=$row['alur']?>" class="btn btn-icon btn-primary" data-toggle="tooltip" data-placement="top" title="Konfirmasi Bayar"><i class="fa-solid fa-money-check-dollar"></i></a>
                                  <a href="hapus_skum.php?id=<?=$row['id'];?>" onClick="return confirm('Hapus Data ini?')" class="btn btn-icon btn-danger" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="fa-solid fa-trash"></i></a>
                                <?php } else {?>
                                  <a href="cetak_skum.php?id=<?=$row['id'];?>" target="_blank" class="btn btn-icon btn-success"><i class="fa-solid fa-print" data-toggle="tooltip" data-placement="top" title="Cetak SKUM"></i></a>
                                  <a href="hapus_skum.php?id=<?=$row['id'];?>" onClick="return confirm('Hapus Data ini?')"  class="btn btn-icon btn-danger" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="fa-solid fa-trash"></i></a>
                                <?php } ?>
                              </td>
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