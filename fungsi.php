<?php
// Helper escaping untuk mencegah XSS pada output HTML.
function h($teks)
{
    return htmlspecialchars((string) $teks, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

// Ambil koneksi global tanpa include berulang (hindari "headers already sent").
function db_con()
{
    global $con;
    if (!isset($con) || !$con) {
        include_once(__DIR__ . '/koneksi.php');
    }
    return $con;
}

function getvalue_aps($value, $tabel, $where, $cond)
{
    $con_aps = db_con();
    // Batasi $value/$tabel/$where hanya untuk identifier internal (bukan input pengguna).
    // Nilai $cond dikirim sebagai parameter terikat.
    $sql = "SELECT $value FROM $tabel WHERE $where=?";
    $stmt = mysqli_prepare($con_aps, $sql);
    if ($stmt === false) {
        return '';
    }
    mysqli_stmt_bind_param($stmt, 's', $cond);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);
    return isset($row[$value]) ? $row[$value] : '';
}

function kode_satker($kel = "")
{
    $con = db_con();
    if ($kel == 0 || $kel === "") {
        return "";
    }
    $sql  = "SELECT satker_code FROM data_komdanas WHERE kel=? LIMIT 1";
    $stmt = mysqli_prepare($con, $sql);
    if ($stmt === false) {
        return '';
    }
    $kel_str = (string) $kel;
    mysqli_stmt_bind_param($stmt, 's', $kel_str);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);
    return isset($row['satker_code']) ? $row['satker_code'] : '';
}

function biaya($id = "")
{
    $con = db_con();
    if ($id === "") {
        return "";
    }
    $sql  = "SELECT nilai FROM data_komdanas WHERE id=? LIMIT 1";
    $stmt = mysqli_prepare($con, $sql);
    if ($stmt === false) {
        return '';
    }
    $id_int = (int) $id;
    mysqli_stmt_bind_param($stmt, 'i', $id_int);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);
    return isset($row['nilai']) ? $row['nilai'] : 0;
}

function getlokasi()
{
    $con = db_con();
    $text = "";
    $sql  = "SELECT id, kabkota as kota, kec, kel FROM data_komdanas";
    $stmt = mysqli_prepare($con, $sql);
    if ($stmt === false) {
        return $text;
    }
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    while ($row = mysqli_fetch_assoc($result)) {
        $id  = h($row['id']);
        $kel = h($row['kel']);
        $kec = h($row['kec']);
        $kota = h($row['kota']);
        $text .= "<option value=\"$id\">$id. Kel.$kel, Kec.$kec, $kota</option>";
    }
    mysqli_stmt_close($stmt);
    return $text;
}

function getperkara()
{
    $con = db_con();
    $text = "";
    $sql  = "SELECT * FROM jenis_perkara";
    $stmt = mysqli_prepare($con, $sql);
    if ($stmt === false) {
        return $text;
    }
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    while ($row = mysqli_fetch_assoc($result)) {
        $jenis = h($row['jenis_perkara_id']);
        $nama  = h($row['nama']);
        $alur  = h($row['alur']);
        $text .= "<option value=\"$jenis\">$nama [$alur]</option>";
    }
    mysqli_stmt_close($stmt);
    return $text;
}

function getperkarasipp()
{
    $con_sipp = db_con();
    $text = "";
    $sql = "SELECT nomor_perkara FROM perkara WHERE LEFT(tanggal_pendaftaran,4) IN ('2024','2023','2022') ORDER BY alur_perkara_id ASC, perkara_id DESC";
    $stmt = mysqli_prepare($con_sipp, $sql);
    if ($stmt === false) {
        return $text;
    }
    $text .= "<option value='-' disabled>=== Perkara ===</option>";
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    while ($row = mysqli_fetch_assoc($result)) {
        $nomor_perkara = h($row['nomor_perkara']);
        $text .= "<option value=\"$nomor_perkara\">$nomor_perkara</option>";
    }
    mysqli_stmt_close($stmt);

    $text .= "<option value='-' disabled>=== Perkara Eksekusi ===</option>";
    $sql_eks  = "SELECT nomor_register_eksekusi FROM perkara_eksekusi ORDER BY permohonan_eksekusi DESC";
    $stmt_eks = mysqli_prepare($con_sipp, $sql_eks);
    if ($stmt_eks !== false) {
        mysqli_stmt_execute($stmt_eks);
        $result_eks = mysqli_stmt_get_result($stmt_eks);
        while ($row_eks = mysqli_fetch_assoc($result_eks)) {
            $nomor_register_eksekusi = h($row_eks['nomor_register_eksekusi']);
            $text .= "<option value=\"$nomor_register_eksekusi\">$nomor_register_eksekusi</option>";
        }
        mysqli_stmt_close($stmt_eks);
    }

    $text .= "<option value='-' disabled>=== Perkara Eksekusi Hak Tanggungan ===</option>";
    $sql_eks2  = "SELECT eksekusi_nomor_perkara FROM perkara_eksekusi_ht ORDER BY eksekusi_nomor_perkara DESC";
    $stmt_eks2 = mysqli_prepare($con_sipp, $sql_eks2);
    if ($stmt_eks2 !== false) {
        mysqli_stmt_execute($stmt_eks2);
        $result_eks2 = mysqli_stmt_get_result($stmt_eks2);
        while ($row_eks2 = mysqli_fetch_assoc($result_eks2)) {
            $eksekusi_nomor_perkara = h($row_eks2['eksekusi_nomor_perkara']);
            $text .= "<option value=\"$eksekusi_nomor_perkara\">$eksekusi_nomor_perkara</option>";
        }
        mysqli_stmt_close($stmt_eks2);
    }

    return $text;
}

function rp($angka)
{
    $hasil_rupiah = "Rp" . number_format($angka, 2, ',', '.');
    return $hasil_rupiah;
}
function biaya_pos($biaya_pos)
{
    if ($biaya_pos == "") {
        $biaya_pos = 0;
    } else {
        $biaya_pos = $biaya_pos;
    }
    return $biaya_pos;
}

function field_biaya($jenis_perkara_id, $pihak, $biaya, $urutan, $biaya_pos = 0)
{
    if ($jenis_perkara_id == 346) {
        if ($pihak == '-') {
            $text = '';
        } else if ($pihak == 'P') {
            $nama = 'Penggugat';
            $panggil = 4;
            if ($biaya_pos !== 0) {
                $biaya = $biaya + $biaya_pos + 20000;
            }
            $biaya_tot = $panggil * $biaya;
            $biaya_total = rp($biaya_tot);
            $biaya = rp($biaya);
            $text = "<div class='form-group col-6'><label>Panggilan $nama ($panggil X $biaya)</label><input type='text' class='form-control' readonly value='$biaya_total'></div>";
        } else {
            $nama = 'Tergugat';
            $panggil = 5;
            if ($biaya_pos !== 0) {
                $biaya = $biaya + $biaya_pos + 20000;
            }
            $biaya_tot = $panggil * $biaya;
            $biaya_total = rp($biaya_tot);
            $biaya = rp($biaya);
            $text = "<div class='form-group col-6'><label>Panggilan $nama ($panggil X $biaya)</label><input type='text' class='form-control' readonly value='$biaya_total'></div>";
        }
    } else if ($jenis_perkara_id == 342 || $jenis_perkara_id == 343 || $jenis_perkara_id == 354 || $jenis_perkara_id == 357 || $jenis_perkara_id == 358 || $jenis_perkara_id == 359 || $jenis_perkara_id == 362 || $jenis_perkara_id == 363 || $jenis_perkara_id == 364 || $jenis_perkara_id == 365 || $jenis_perkara_id == 371) {
        if ($pihak == '-') {
            $text = '';
        } else if ($pihak == 'P') {
            $nama = 'Pemohon ' . $urutan;
            $panggil = 3;
            if ($biaya_pos !== 0) {
                $biaya = $biaya + $biaya_pos + 20000;
            }
            $biaya_tot = $panggil * $biaya;
            $biaya_total = rp($biaya_tot);
            $biaya = rp($biaya);
            $text = "<div class='form-group col-6'><label>Panggilan $nama ($panggil X $biaya)</label><input type='text' class='form-control' readonly value='$biaya_total'></div>";
        } else {
            $nama = 'Termohon';
            $panggil = 4;
            if ($biaya_pos !== 0) {
                $biaya = $biaya + $biaya_pos + 20000;
            }
            $biaya_tot = $panggil * $biaya;
            $biaya_total = rp($biaya_tot);
            $biaya = rp($biaya);
            $text = "<div class='form-group col-6'><label>Panggilan $nama ($panggil X $biaya)</label><input type='text' class='form-control' readonly value='$biaya_total'></div>";
        }
    } else {
        if ($pihak == '-') {
            $text = '';
        } else if ($pihak == 'P') {
            $nama = 'Penggugat';
            $panggil = 3;
            if ($biaya_pos !== 0) {
                $biaya = $biaya + $biaya_pos + 20000;
            }
            $biaya_tot = $panggil * $biaya;
            $biaya_total = rp($biaya_tot);
            $biaya = rp($biaya);
            $text = "<div class='form-group col-6'><label>Panggilan $nama ($panggil X $biaya)</label><input type='text' class='form-control' readonly value='$biaya_total'></div>";
        } else {
            $nama = 'Tergugat';
            $panggil = 4;
            if ($biaya_pos !== 0) {
                $biaya = $biaya + $biaya_pos + 20000;
            }
            $biaya_tot = $panggil * $biaya;
            $biaya_total = rp($biaya_tot);
            $biaya = rp($biaya);
            $text = "<div class='form-group col-6'><label>Panggilan $nama ($panggil X $biaya)</label><input type='text' class='form-control' readonly value='$biaya_total'></div>";
        }
    }
    return $text;
}

function alur($jenis_perkara_id)
{
    if ($jenis_perkara_id == 342 || $jenis_perkara_id == 343 || $jenis_perkara_id == 354 || $jenis_perkara_id == 357 || $jenis_perkara_id == 359 || $jenis_perkara_id == 362 || $jenis_perkara_id == 363 || $jenis_perkara_id == 364 || $jenis_perkara_id == 365 || $jenis_perkara_id == 371) {
        $alur = 'P';
    } else {
        $alur = 'G';
    }
    return $alur;
}

function biaya_panggilan($jenis_perkara_id, $pihak, $biaya, $urutan, $biaya_pos = 0)
{
    if ($jenis_perkara_id == 346) {
        if ($pihak == '-') {
            $biaya_tot = 0;
        } else if ($pihak == 'P') {
            $nama = 'Penggugat';
            $panggil = 4;
            if ($biaya_pos !== 0) {
                $biaya = $biaya + $biaya_pos + 20000;
            }
            $biaya_tot = $panggil * $biaya;
        } else {
            $nama = 'Tergugat';
            $panggil = 5;
            if ($biaya_pos !== 0) {
                $biaya = $biaya + $biaya_pos + 20000;
            }
            $biaya_tot = $panggil * $biaya;
        }
    } else if ($jenis_perkara_id == 342 || $jenis_perkara_id == 343 || $jenis_perkara_id == 354 || $jenis_perkara_id == 357 || $jenis_perkara_id == 359 || $jenis_perkara_id == 362 || $jenis_perkara_id == 363 || $jenis_perkara_id == 364 || $jenis_perkara_id == 365 || $jenis_perkara_id == 371) {
        if ($pihak == '-') {
            $biaya_tot = 0;
        } else if ($pihak == 'P') {
            $nama = 'Pemohon ' . $urutan;
            $panggil = 3;
            if ($biaya_pos !== 0) {
                $biaya = $biaya + $biaya_pos + 20000;
            }
            $biaya_tot = $panggil * $biaya;
        }
    } else {
        if ($pihak == '-') {
            $biaya_tot = 0;
        } else if ($pihak == 'P') {
            $nama = 'Penggugat';
            $panggil = 3;
            if ($biaya_pos !== 0) {
                $biaya = $biaya + $biaya_pos + 20000;
            }
            $biaya_tot = $panggil * $biaya;
        } else {
            $nama = 'Tergugat';
            $panggil = 4;
            if ($biaya_pos !== 0) {
                $biaya = $biaya + $biaya_pos + 20000;
            }
            $biaya_tot = $panggil * $biaya;
        }
    }
    return $biaya_tot;
}
