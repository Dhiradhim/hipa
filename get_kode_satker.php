<?php
include('koneksi.php');
$kel = $_GET['kel'];
$sql = "SELECT satker_code FROM data_komdanas WHERE kel='$kel'";
$query = mysqli_query($con,$sql);
$row = mysqli_fetch_assoc($query);
$data = array();
do {
$data[] = array("satker_code" => $row['satker_code']);
} while($row = mysqli_fetch_assoc($query));
echo json_encode($data);
?>