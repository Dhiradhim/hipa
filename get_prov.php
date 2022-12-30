<?php
include('koneksi.php');
$sql = "SELECT DISTINCT prop_name FROM data_komdanas";
$query = mysqli_query($con,$sql);
$row = mysqli_fetch_assoc($query);
$data = array();
do {
$data[] = array("prop_name" => $row['prop_name']);
} while($row = mysqli_fetch_assoc($query));
echo json_encode($data);
?>