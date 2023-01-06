<html>
	<head>
		<title>..::DATA TRANSAKSI KEUANGAN SIPP::..</title>
	</head>
	<body >
	<!--onLoad="window.print(); window.close();"-->
	<?php 
    include('koneksi.php');
    include('fungsi.php');
    $nm_bln=array('01'=>'Januari','02'=>'Februari','03'=>'Maret','04'=>'April','05'=>'Mei','06'=>'Juni',
               '07'=>'Juli','08'=>'Agustus','09'=>'September','10'=>'Oktober','11'=>'November','12'=>'Desember');
        $id=$_GET['id'];
		$sql_skum = "SELECT * FROM skum WHERE id='$id'";
        $query_skum = mysqli_query($con,$sql_skum);
        $row_skum = mysqli_fetch_assoc($query_skum);
        foreach($row_skum as $key=>$value) {$$key=$value;}
		$nm_kasir=getvalue_aps('value','keu_config','kd','nm_kasir');
		$nip_kasir=getvalue_aps('value','keu_config','kd','nip_kasir');
		$tanggal = date('Y-m-d');
        $tanggal_panjang=substr($tanggal,8,2).' '.$nm_bln[substr($tanggal,5,2)].' '.substr($tanggal,0,4);
        
function Terbilang($x)
{
  $abil = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
  if ($x < 12)
    return " " . $abil[$x];
  elseif ($x < 20)
    return Terbilang($x - 10) . "belas";
  elseif ($x < 100)
    return Terbilang($x / 10) . " puluh" . Terbilang($x % 10);
  elseif ($x < 200)
    return " seratus" . Terbilang($x - 100);
  elseif ($x < 1000)
    return Terbilang($x / 100) . " ratus" . Terbilang($x % 100);
  elseif ($x < 2000)
    return " seribu" . Terbilang($x - 1000);
  elseif ($x < 1000000)
    return Terbilang($x / 1000) . " ribu" . Terbilang($x % 1000);
  elseif ($x < 1000000000)
    return Terbilang($x / 1000000) . " juta" . Terbilang($x % 1000000);
}
$ter_bi=Terbilang($biaya);	
//==================================================== END TERBILANG =====================
//===================================== BLANKO ===============================================
			?>
            
<table border='0' width='100%' cellpadding='5' cellspacing='0'>
	<tr>
		<td width="6%"><img src="img/logo.png" width="120%"</td>
		<td><span style="font-size: medium; font-family: arial,helvetica,sans-serif;"><strong>Pengadilan Agama Kupang</strong></span><br/>
			<span style="font-size: medium; font-family: arial,helvetica,sans-serif;"><strong>Jl. Kejora, Kota Kupang</strong></span>
		</td>
		<td align='right'><span style="font-size: medium; font-family: arial,helvetica,sans-serif;"><strong></strong></span>
		</td>
	</tr>
</table>				

<p style="text-align: center;"><span style="font-size: x-large; font-family: arial,helvetica,sans-serif;"><strong><span style="text-decoration: underline;">
	Taksiran Panjar Biaya Perkara</span></strong></span><br/>
 <span style="font-size: medium; font-family: arial,helvetica,sans-serif;"><strong></strong></span></p>
 <table width='100%'>
	<tr>
		<td><span style="font-size: medium; font-family: arial,helvetica,sans-serif;">Nomor Perkara</span></td>
		<td>:</td>
		<td><span style="font-size: medium; font-family: arial,helvetica,sans-serif;">-</span></td>
	</tr>
	<tr>
		<td><span style="font-size: medium; font-family: arial,helvetica,sans-serif;">a. Nama</span></td>
		<td>:</td>
		<td><span style="font-size: medium; font-family: arial,helvetica,sans-serif;"><?php echo $penyetor; ?></span></td>
	</tr>
	<tr>
		<td><span style="font-size: medium; font-family: arial,helvetica,sans-serif;">b. Panjar Biaya Perkara</span></td>
		<td>:</td>
		<td><span style="font-size: medium; font-family: arial,helvetica,sans-serif;"><?php echo 'Rp. '.number_format($biaya,2,',','.').' ('.$ter_bi.' rupiah)'; ?></span></td>
	</tr>
	<tr>
		<td><span style="font-size: medium; font-family: arial,helvetica,sans-serif;">c. Untuk pembayaran</span></td>
		<td>:</td>
		<td><span style="font-size: medium; font-family: arial,helvetica,sans-serif;"><?php echo $untuk; ?></span></td>
	</tr>
 </table>
<br/>
<table width='100%'>
	<tr >
		<td width='70%'>&nbsp;
		</td>
		<td width='30%' align='center'>
			<p><span style="font-size: medium; font-family: arial,helvetica,sans-serif;">Kupang, <?php echo $tanggal_panjang; ?></span><br/>
			<span style="font-size: medium; font-family: arial,helvetica,sans-serif;">Kasir,</span></p>
			<br/>
			<br/>
			<p><span style="font-size: medium; font-family: arial,helvetica,sans-serif;">
				<strong><span style="text-decoration: underline;">
				(</span></strong><strong><span style="text-decoration: underline;"><?=$nm_kasir?>)</span></strong></span><br/>
			<span style="font-size: medium; font-family: arial,helvetica,sans-serif;"><strong>NIP.<?=$nip_kasir?></strong><strong></strong></span></p>
		</td>
	</tr>
</table><br><br><br><br>
<center>----------------------------------------------------------------------------------------------------------------------------------------


	</body>
</html>