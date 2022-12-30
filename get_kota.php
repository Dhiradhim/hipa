<?php
include('koneksi.php');
$prop_name = $_GET['prop_name'];
$sql = "SELECT DISTINCT kabkota FROM data_komdanas WHERE prop_name='$prop_name'";
$query = mysqli_query($con,$sql);
$row = mysqli_fetch_assoc($query);
$data = array();
do {
$data[] = array("kabkota" => $row['kabkota']);
} while($row = mysqli_fetch_assoc($query));
echo json_encode($data);
?>