<?php  
  
include("koneksi.php");  

  $id = $_GET['id'];
  $tahun = date("Y");  
  $alur_p = $_GET['alur_p'];
  if ($alur_p=='G'){
    $alur='15';
  } else {
    $alur='16';
  }
  $sql_skum = "SELECT COUNT(*) FROM skum WHERE bayar='1'";
  $query_skum = mysqli_query($con,$sql_skum);
  $row_skum = mysqli_fetch_assoc($query_skum);

  $urutan_skum = $row_skum['COUNT(*)']+1;
  $urutan_skum1 = sprintf("%05d", $urutan_skum);
  $no_skum = $kode_satker.'-'.$alur_p.'-'.$urutan_skum1;

  $sql_perkara = "SELECT COUNT(*) FROM perkara WHERE LEFT(tanggal_pendaftaran,4)='$tahun' AND alur_perkara_id='$alur'";
  $query_perkara = mysqli_query($con_sipp,$sql_perkara);
  $row_perkara = mysqli_fetch_assoc($query_perkara);
  $no = $row_perkara['COUNT(*)']+1;
  $no_perkara = $no.'/'.'Pdt.'.$alur_p.'/'.$tahun.'/PA.Kp';
  $tanggal = date("Y-m-d");
  
  $sql_cek_no = "SELECT COUNT(*) FROM skum WHERE no_perkara='$no_perkara'";
  $query_cek_no = mysqli_query($con,$sql_cek_no);
  $row_cek_no = mysqli_fetch_assoc($query_cek_no);

  $sql_cek_perkara = "SELECT no_perkara FROM skum WHERE id='$id'";
  $query_cek_perkara = mysqli_query($con,$sql_cek_perkara);
  $row_cek_perkara = mysqli_fetch_assoc($query_cek_perkara);

  if($row_cek_no['COUNT(*)']==1){
    echo "<script type='text/javascript'>alert('No Perkara $no_perkara belum didaftarkan di SIPP!');</script>";
    echo "<script type='text/javascript'>window.location.href='data_panjar.php'</script>";
  } else if (!empty($row_cek_perkara['no_perkara'])){
    $sql_update = "UPDATE skum SET tanggal='$tanggal', no_skum='$no_skum', bayar='1' WHERE id='$id'";
    $query = mysqli_query($con,$sql_update);
    echo "<script type='text/javascript'>alert('Data Tersimpan');</script>";
    echo "<script type='text/javascript'>window.location.href='data_panjar.php'</script>";
  } else {
    $sql_update = "UPDATE skum SET tanggal='$tanggal', no_skum='$no_skum', no_perkara='$no_perkara', bayar='1' WHERE id='$id'";
    $query = mysqli_query($con,$sql_update);
    echo "<script type='text/javascript'>alert('Data Tersimpan');</script>";
    echo "<script type='text/javascript'>window.location.href='data_panjar.php'</script>";
  }

?>  