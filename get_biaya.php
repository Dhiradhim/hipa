<?php
include('koneksi.php');
$id_kel = $_GET['id_kel'];
$sql = "SELECT biaya FROM kelurahan WHERE `id` = '$id_kel'";
$query = $mysqli->query($sql);
$row = $query->fetch_array(MYSQLI_ASSOC);
$data = $row['biaya'];

echo json_encode($data);?>