<?php
header('Content-Type: application/json; charset=utf-8');
include('koneksi.php');

$kec = isset($_GET['kec']) ? (string) $_GET['kec'] : '';

$data = array();

// Prepared statement mencegah SQL Injection.
$sql  = "SELECT DISTINCT id, kel FROM data_komdanas WHERE kec=?";
$stmt = mysqli_prepare($con, $sql);
if ($stmt !== false) {
    mysqli_stmt_bind_param($stmt, 's', $kec);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = array("id" => $row['id'], "kel" => $row['kel']);
    }
    mysqli_stmt_close($stmt);
}

echo json_encode($data);
