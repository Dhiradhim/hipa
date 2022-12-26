<?php  
  
include("koneksi.php");  

  $id = $_GET['id'];
  $sql = "DELETE FROM skum WHERE id='$id'";
  $q = mysqli_query($con,$sql);

  echo "<script type='text/javascript'>alert('Data Sudah Terhapus');</script>";
  echo "<script type='text/javascript'>window.location.href='data_panjar.php'</script>";
  
?>  