<?php
include('koneksi.php');
$sql = "SELECT * FROM kota";
$query = $mysqli->query($sql);
$data = array();
while($row = $query->fetch_array(MYSQLI_ASSOC)){
$data[] = array("id_kota" => $row['id'], "nama" => $row['nama']);
}
echo json_encode($data);?>