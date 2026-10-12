<?php
header('Content-Type: application/json; charset=utf-8');
include('koneksi.php');

$prop_name = isset($_GET['prop_name']) ? (string) $_GET['prop_name'] : '';

$data = array();

// Prepared statement mencegah SQL Injection.
$sql  = "SELECT DISTINCT kabkota FROM data_komdanas WHERE prop_name=?";
$stmt = mysqli_prepare($con, $sql);
if ($stmt !== false) {
    mysqli_stmt_bind_param($stmt, 's', $prop_name);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = array("kabkota" => $row['kabkota']);
    }
    mysqli_stmt_close($stmt);
}

echo json_encode($data);
