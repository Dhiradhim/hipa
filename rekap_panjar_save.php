 <?php 
include("koneksi.php");  
  
if(isset($_POST['simpan']))  
{  
  $penyetor = $_POST['penyetor'];
  $biaya = $_POST['biaya'];
  $untuk = $_POST['untuk'];
  $alur = $_POST['alur'];
  $sql = "INSERT INTO skum (penyetor,biaya,untuk,alur) VALUES ('$penyetor','$biaya','$untuk','$alur')";
//   echo $sql;
  $query = mysqli_query($con,$sql);
  echo "<script type='text/javascript'>alert('Data Tersimpan');</script>";
  echo "<script type='text/javascript'>window.location.href='data_panjar.php'</script>";
}  