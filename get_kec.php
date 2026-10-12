<?php
header('Content-Type: application/json; charset=utf-8');
include('koneksi.php');

$kabkota = isset($_GET['kabkota']) ? (string) $_GET['kabkota'] : '';

$data = array();

// Prepared statement mencegah SQL Injection.
$sql  = "SELECT DISTINCT kec FROM data_komdanas WHERE kabkota=?";
$stmt = mysqli_prepare($con, $sql);
if ($stmt !== false) {
    mysqli_stmt_bind_param($stmt, 's', $kabkota);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = array("kec" => $row['kec']);
    }
    mysqli_stmt_close($stmt);
}

echo json_encode($data);
