<?php		
include('koneksi.php');
$sql_del = "DELETE FROM data_komdanas";
$query_del = mysqli_query($con,$sql_del);

$tarik="http://komdanas.mahkamahagung.go.id/jsons/radius04.json";
$tarik=file_get_contents($tarik);
$d=json_decode($tarik, true);

foreach($d as $r)
{
//get the employee details
$satker_name = $r['satker_name'];
$satker_code = $r['satker_code'];
$prop = $r['prop'];
$prop_name = $r['prop_name'];
$kabkota = $r['kabkota'];
$kec = $r['kec'];
$kel = $r['kel'];
$nomor_radius = $r['nomor_radius'];
$nilai = $r['nilai'];

//insert into db
$sql_insert = "INSERT into data_komdanas (satker_name,satker_code,prop,prop_name,kabkota,kec,kel,nomor_radius,nilai) VALUES ('$satker_name','$satker_code','$prop','$prop_name','$kabkota','$kec','$kel','$nomor_radius','$nilai')";
$query_insert = mysqli_query($con,$sql_insert);
}
?>