<?php
include('koneksi.php');
$id_kec = $_GET['id_kec'];
$sql = "SELECT * FROM kelurahan WHERE `id_kecamatan` = '$id_kec'";
$query = $mysqli->query($sql);
$data = array();
while($row = $query->fetch_array(MYSQLI_ASSOC)){
$data[] = array("id_kel" => $row['id'], "nama" => $row['nama']);
}
echo json_encode($data);?>