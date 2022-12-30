<?php
include('koneksi.php');
$kabkota = $_GET['kabkota'];
$sql = "SELECT DISTINCT kec FROM data_komdanas WHERE kabkota='$kabkota'";
$query = mysqli_query($con,$sql);
$row = mysqli_fetch_assoc($query);
$data = array();
do {
$data[] = array("kec" => $row['kec']);
} while($row = mysqli_fetch_assoc($query));
echo json_encode($data);
?>