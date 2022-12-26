<?php
include('koneksi.php');
$id_kota = $_GET['id_kota'];
$sql = "SELECT * FROM kecamatan WHERE `id_kota` = '$id_kota'";
$query = $mysqli->query($sql);
$data = array();
while($row = $query->fetch_array(MYSQLI_ASSOC)){
$data[] = array("id_kec" => $row['id'], "nama" => $row['nama']);
}
echo json_encode($data);?>