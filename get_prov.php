<?php
header('Content-Type: application/json; charset=utf-8');
include('koneksi.php');

$data = array();

// Tidak ada input pengguna pada query ini, namun tetap gunakan prepared statement.
$sql  = "SELECT DISTINCT prop_name FROM data_komdanas";
$stmt = mysqli_prepare($con, $sql);
if ($stmt !== false) {
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = array("prop_name" => $row['prop_name']);
    }
    mysqli_stmt_close($stmt);
}

echo json_encode($data);
