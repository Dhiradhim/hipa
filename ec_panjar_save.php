<?php
include('koneksi.php');
  $penyetor = $_POST['penyetor'];
  $x_biaya = $_POST['biaya'];
  $biaya = preg_replace("/[^0-9]/", '', $x_biaya);
  $alur=$_POST['alur'];
  $untuk = $_POST['untuk'];
  $sql = "INSERT INTO skum (penyetor,biaya,untuk,alur) VALUES ('$penyetor','$biaya','$untuk','$alur')";
  // echo $sql;
  $query = mysqli_query($con,$sql);
  echo "<script type='text/javascript'>alert('Data Tersimpan');</script>";
  echo "<script type='text/javascript'>window.location.href='data_panjar.php'</script>";