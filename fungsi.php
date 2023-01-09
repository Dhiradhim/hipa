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

function kode_satker($kel="")
{
    include('koneksi.php');
    if ($kel==0){
        $text="";
    }
    $sql = "SELECT satker_code FROM data_komdanas WHERE kel='$kel'";
    $query = mysqli_query($con,$sql);
    $row = mysqli_fetch_assoc($query);
    $text = $row['satker_code'];
    return $text;
}

function biaya($id="")
{
    include('koneksi.php');
    if ($id==""){
        $text="";
    } else {
    $sql = "SELECT nilai FROM data_komdanas WHERE id='$id'";
    $query = mysqli_query($con,$sql);
    $row = mysqli_fetch_assoc($query);
    $text = $row['nilai'];
    }
    return $text;
}

function getlokasi()
{
    include('koneksi.php');
    $sql = "SELECT id,kabkota as kota,kec,kel FROM data_komdanas";
    $query = mysqli_query($con,$sql);
    $row = mysqli_fetch_assoc($query);
    do {
        $id = $row['id'];
        $kel = $row['kel'];
        $kec = $row['kec'];
        $kota = $row['kota'];
        $text .="<option value=$id>$id. Kel.$kel, Kec.$kec, $kota</option>";
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
    $sql = "SELECT nomor_perkara FROM perkara WHERE LEFT(tanggal_pendaftaran,4)='2023' OR LEFT(tanggal_pendaftaran,4)='2022' ORDER BY alur_perkara_id ASC, perkara_id DESC";
    $query = mysqli_query($con_sipp,$sql);
    $row = mysqli_fetch_assoc($query);
    $text .="<option value='-' disabled>=== Perkara ===</option>";
    do {
        $nomor_perkara = $row['nomor_perkara'];
        $text .="<option value=$nomor_perkara>$nomor_perkara</option>";
    } while ($row = mysqli_fetch_assoc($query));
    $text .="<option value='-' disabled>=== Perkara Eksekusi ===</option>";
    $sql_eks = "SELECT nomor_register_eksekusi FROM perkara_eksekusi ORDER BY permohonan_eksekusi DESC";
    $query_eks = mysqli_query($con_sipp,$sql_eks);
    $row_eks = mysqli_fetch_assoc($query_eks);
    do {
        $nomor_register_eksekusi = $row_eks['nomor_register_eksekusi'];
        $text .="<option value=$nomor_register_eksekusi>$nomor_register_eksekusi</option>";
    } while ($row_eks = mysqli_fetch_assoc($query_eks));
    $text .="<option value='-' disabled>=== Perkara Eksekusi Hak Tanggungan ===</option>";
    $sql_eks2 = "SELECT eksekusi_nomor_perkara FROM perkara_eksekusi_ht ORDER BY eksekusi_nomor_perkara DESC";
    $query_eks2 = mysqli_query($con_sipp,$sql_eks2);
    $row_eks2 = mysqli_fetch_assoc($query_eks2);
    do {
        $eksekusi_nomor_perkara = $row_eks2['eksekusi_nomor_perkara'];
        $text .="<option value=$eksekusi_nomor_perkara>$eksekusi_nomor_perkara</option>";
    } while ($row_eks2 = mysqli_fetch_assoc($query_eks2));
    return $text;
}

function rp($angka){
    $hasil_rupiah = "Rp " . number_format($angka,2,',','.');
    return $hasil_rupiah;
  }
function biaya_pos($biaya_pos){
    if($biaya_pos==""){
        $biaya_pos=0;
    } else {
        $biaya_pos=$biaya_pos;
    }
    return $biaya_pos;
  }

function field_biaya($jenis_perkara_id,$pihak,$biaya,$urutan,$biaya_pos=0){
if ($jenis_perkara_id==346){
    if($pihak=='-'){
    $text = '';
    } else if ($pihak=='P'){
    $nama='Penggugat';
    $panggil=4;
    if ($biaya_pos!==0){
        $biaya=$biaya+$biaya_pos+20000;
    } 
    $biaya_tot = $panggil*$biaya;
    $biaya_total = rp($biaya_tot);
    $biaya = rp($biaya);
    $text = "<div class='form-group'><label>Panggilan $nama ($panggil X $biaya)</label><input type='text' class='form-control' readonly value='$biaya_total'></div>";
    } else {
    $nama='Tergugat';
    $panggil=5;
    if ($biaya_pos!==0){
        $biaya=$biaya+$biaya_pos+20000;
    } 
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
    if ($biaya_pos!==0){
        $biaya=$biaya+$biaya_pos+20000;
    } 
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
    if ($biaya_pos!==0){
        $biaya=$biaya+$biaya_pos+20000;
    } 
    $biaya_tot = $panggil*$biaya;
    $biaya_total = rp($biaya_tot);
    $biaya = rp($biaya);
    $text = "<div class='form-group'><label>Panggilan $nama ($panggil X $biaya)</label><input type='text' class='form-control' readonly value='$biaya_total'></div>";
    } else {
    $nama='Tergugat';
    $panggil=4;
    if ($biaya_pos!==0){
        $biaya=$biaya+$biaya_pos+20000;
    } 
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

function biaya_panggilan($jenis_perkara_id,$pihak,$biaya,$urutan,$biaya_pos=0){
if ($jenis_perkara_id==346){
    if($pihak=='-'){
    $biaya_tot = 0;
    } else if ($pihak=='P'){
    $nama='Penggugat';
    $panggil=4;
    if ($biaya_pos!==0){
        $biaya=$biaya+$biaya_pos+20000;
    } 
    $biaya_tot = $panggil*$biaya;
    } else {
    $nama='Tergugat';
    $panggil=5;
    if ($biaya_pos!==0){
        $biaya=$biaya+$biaya_pos+20000;
    } 
    $biaya_tot = $panggil*$biaya;
    }
} else if ($jenis_perkara_id==342 || $jenis_perkara_id==343 || $jenis_perkara_id==354 || $jenis_perkara_id==357 || $jenis_perkara_id==359 || $jenis_perkara_id==362 || $jenis_perkara_id==363 || $jenis_perkara_id==364 || $jenis_perkara_id==365 || $jenis_perkara_id==371){
    if($pihak=='-'){
    $biaya_tot = 0;
    } else if ($pihak=='P'){
    $nama='Pemohon '.$urutan;
    $panggil=3;
    if ($biaya_pos!==0){
        $biaya=$biaya+$biaya_pos+20000;
    } 
    $biaya_tot = $panggil*$biaya;
}} else {
    if($pihak=='-'){
    $biaya_tot = 0;
    } else if ($pihak=='P'){
    $nama='Penggugat';
    $panggil=3;
    if ($biaya_pos!==0){
        $biaya=$biaya+$biaya_pos+20000;
    } 
    $biaya_tot = $panggil*$biaya;
    } else {
    $nama='Tergugat';
    $panggil=4;
    if ($biaya_pos!==0){
        $biaya=$biaya+$biaya_pos+20000;
    } 
    $biaya_tot = $panggil*$biaya;
    }
}
return $biaya_tot;
}

?>