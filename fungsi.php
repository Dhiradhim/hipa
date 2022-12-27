<?php
function getvalue_aps($value,$tabel,$where,$cond)
{
    include('koneksi.php');
    $sql = "SELECT $value FROM $tabel WHERE $where='$cond'";
    $query = mysqli_query($con_aps,$sql);
    $row = mysqli_fetch_assoc($query);
    $text=$row[$value];
    return $text;
}

function getlokasi()
{
    include('koneksi.php');
    $sql = "SELECT k1.id as id, k1.nama as kel, k2.nama as kec, k3.nama as kota, k1.biaya as biaya FROM kelurahan k1 left join kecamatan k2 on k1.id_kecamatan=k2.id left join kota k3 on k1.id_kota=k3.id";
    $query = mysqli_query($con,$sql);
    $row = mysqli_fetch_assoc($query);
    do {
        $id = $row['id'];
        $kel = $row['kel'];
        $kec = $row['kec'];
        $kota = $row['kota'];
        $biaya = $row['biaya'];
        $text .="<option value=$biaya>$id. Kel.$kel, Kec.$kec, $kota</option>";
    } while ($row = mysqli_fetch_assoc($query));
    return $text;
}

function getperkara()
{
    include('koneksi.php');
    $sql = "SELECT * FROM jenis_perkara";
    $query = mysqli_query($con,$sql);
    $row = mysqli_fetch_assoc($query);
    do {
        $id = $row['id'];
        $jenis = $row['jenis_perkara_id'];
        $nama = $row['nama'];
        $alur = $row['alur'];
        $text .="<option value=$jenis>$nama [$alur]</option>";
    } while ($row = mysqli_fetch_assoc($query));
    return $text;
}

function getperkarasipp()
{
    include('koneksi.php');
    $sql = "SELECT perkara_id, nomor_perkara FROM perkara WHERE LEFT(tanggal_pendaftaran,4)='2022' ORDER BY alur_perkara_id ASC, perkara_id ASC";
    $query = mysqli_query($con_sipp,$sql);
    $row = mysqli_fetch_assoc($query);
    do {
        $id = $row['id'];
        $nomor_perkara = $row['nomor_perkara'];
        $text .="<option value=$nomor_perkara>$nomor_perkara</option>";
    } while ($row = mysqli_fetch_assoc($query));
    return $text;
}

function rp($angka){
    $hasil_rupiah = "Rp " . number_format($angka,2,',','.');
    return $hasil_rupiah;
  }

function field_biaya($jenis_perkara_id,$pihak,$biaya,$urutan){
if ($jenis_perkara_id==346){
    if($pihak=='-'){
    $text = '';
    } else if ($pihak=='P'){
    $nama='Penggugat';
    $panggil=4;
    $biaya_tot = $panggil*$biaya;
    $biaya_total = rp($biaya_tot);
    $biaya = rp($biaya);
    $text = "<div class='form-group'><label>Panggilan $nama ($panggil X $biaya)</label><input type='text' class='form-control' readonly value='$biaya_total'></div>";
    } else {
    $nama='Tergugat';
    $panggil=5;
    $biaya_tot = $panggil*$biaya;
    $biaya_total = rp($biaya_tot);
    $biaya = rp($biaya);
    $text = "<div class='form-group'><label>Panggilan $nama ($panggil X $biaya)</label><input type='text' class='form-control' readonly value='$biaya_total'></div>";
    }
} else if ($jenis_perkara_id==342 || $jenis_perkara_id==343 || $jenis_perkara_id==354 || $jenis_perkara_id==357 || $jenis_perkara_id==359 || $jenis_perkara_id==362 || $jenis_perkara_id==363 || $jenis_perkara_id==364 || $jenis_perkara_id==365 || $jenis_perkara_id==371){
    if($pihak=='-'){
    $text = '';
    } else if ($pihak=='P'){
    $nama='Pemohon '.$urutan;
    $panggil=3;
    $biaya_tot = $panggil*$biaya;
    $biaya_total = rp($biaya_tot);
    $biaya = rp($biaya);
    $text = "<div class='form-group'><label>Panggilan $nama ($panggil X $biaya)</label><input type='text' class='form-control' readonly value='$biaya_total'></div>";          
}} else {
    if($pihak=='-'){
    $text = '';
    } else if ($pihak=='P'){
    $nama='Penggugat';
    $panggil=3;
    $biaya_tot = $panggil*$biaya;
    $biaya_total = rp($biaya_tot);
    $biaya = rp($biaya);
    $text = "<div class='form-group'><label>Panggilan $nama ($panggil X $biaya)</label><input type='text' class='form-control' readonly value='$biaya_total'></div>";
    } else {
    $nama='Tergugat';
    $panggil=4;
    $biaya_tot = $panggil*$biaya;
    $biaya_total = rp($biaya_tot);
    $biaya = rp($biaya);
    $text = "<div class='form-group'><label>Panggilan $nama ($panggil X $biaya)</label><input type='text' class='form-control' readonly value='$biaya_total'></div>";
    }
}
return $text;
}

function alur($jenis_perkara_id){
if ($jenis_perkara_id==342 || $jenis_perkara_id==343 || $jenis_perkara_id==354 || $jenis_perkara_id==357 || $jenis_perkara_id==359 || $jenis_perkara_id==362 || $jenis_perkara_id==363 || $jenis_perkara_id==364 || $jenis_perkara_id==365 || $jenis_perkara_id==371){
    $alur='P';
    } else {
    $alur='G';
}
return $alur;
}

function biaya_panggilan($jenis_perkara_id,$pihak,$biaya,$urutan){
if ($jenis_perkara_id==346){
    if($pihak=='-'){
    $biaya_tot = 0;
    } else if ($pihak=='P'){
    $nama='Penggugat';
    $panggil=4;
    $biaya_tot = $panggil*$biaya;
    } else {
    $nama='Tergugat';
    $panggil=5;
    $biaya_tot = $panggil*$biaya;
    }
} else if ($jenis_perkara_id==342 || $jenis_perkara_id==343 || $jenis_perkara_id==354 || $jenis_perkara_id==357 || $jenis_perkara_id==359 || $jenis_perkara_id==362 || $jenis_perkara_id==363 || $jenis_perkara_id==364 || $jenis_perkara_id==365 || $jenis_perkara_id==371){
    if($pihak=='-'){
    $biaya_tot = 0;
    } else if ($pihak=='P'){
    $nama='Pemohon '.$urutan;
    $panggil=3;
    $biaya_tot = $panggil*$biaya;
}} else {
    if($pihak=='-'){
    $biaya_tot = 0;
    } else if ($pihak=='P'){
    $nama='Penggugat';
    $panggil=3;
    $biaya_tot = $panggil*$biaya;
    } else {
    $nama='Tergugat';
    $panggil=4;
    $biaya_tot = $panggil*$biaya;
    }
}
return $biaya_tot;
}

?>