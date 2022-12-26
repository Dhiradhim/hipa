<?php
include('koneksi.php');
  $no_perkara = $_POST['no_perkara'];
  $penyetor = $_POST['penyetor'];
  $x_biaya = $_POST['biaya'];
  $biaya = preg_replace("/[^0-9]/", '', $x_biaya);
  $untuk = $_POST['untuk'];
  $alur=substr($no_perkara, -12, 1);
  $sql = "INSERT INTO skum (no_perkara,penyetor,biaya,untuk,alur) VALUES ('$no_perkara','$penyetor','$biaya','$untuk','$alur')";
//   echo $sql;
  $query = mysqli_query($con,$sql);
  echo "<script type='text/javascript'>alert('Data Tersimpan');</script>";
  echo "<script type='text/javascript'>window.location.href='data_panjar.php'</script>";