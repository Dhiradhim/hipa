<?php
include('koneksi.php');
$sql = "SELECT k1.nama as kel, k2.nama as kec, k3.nama as kota, k1.biaya FROM kelurahan k1 left join kecamatan k2 on k1.id_kecamatan=k2.id left join kota k3 on k1.id_kota=k3.id";
$query = $mysqli->query($sql);
$data = array();
while($row = $query->fetch_array(MYSQLI_ASSOC)){
$data[] = array("kel" => $row['kel'], "kec" => $row['kec'], "kota" => $row['kota'], "biaya" => $row['biaya']);
}
echo json_encode($data);?>