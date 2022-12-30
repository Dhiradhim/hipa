<?php
include('koneksi.php');
$kec = $_GET['kec'];
$sql = "SELECT DISTINCT nilai,kel FROM data_komdanas WHERE kec='$kec'";
$query = mysqli_query($con,$sql);
$row = mysqli_fetch_assoc($query);
$data = array();
do {
$data[] = array("nilai" => $row['nilai'], "kel" => $row['kel']);
} while($row = mysqli_fetch_assoc($query));
echo json_encode($data);
?>