<?php
// DATABASE APLIKASI HIPA
$servername = "localhost";
$database = "hipa";
$username = "root";
$password = "";
$con = mysqli_connect($servername, $username, $password, $database);

// DATABASE APLIKASI SIPP
$servername1 = "103.168.132.51";
$database1 = "pakp";
$username1 = "root";
$password1 = "peradilan";
$con_sipp = mysqli_connect($servername1, $username1, $password1, $database1);

// DATABASE APLIKASI APS_BADILAG
$servername2 = "103.168.132.51";
$database2 = "aps_badilag";
$username2 = "root";
$password2 = "peradilan";
$con_aps = mysqli_connect($servername2, $username2, $password2, $database2);

// Kode Satker
$kode_satker = "W23-A1";

// Logo Satker Update di folder "img/logo.png"
?>