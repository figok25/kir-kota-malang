<?php
session_start();
include "pagehead.php";
include "koneksi.php";

if($_POST["nominal"]){
	$pIdQori=$_POST["NamaQori"];
	$pWaktu=$_POST["tanggal"]." ".$_POST["jam"];
	$pNominal=$_POST["nominal"]*-1;
	$StrSQL = "insert into keuangan(IdQori,TglTransaksi,Nominal) values($pIdQori,'$pWaktu',$pNominal)";
	$stmt = sqlsrv_prepare( $conn, $StrSQL);
	sqlsrv_execute($stmt);	
	
}else{
	
	$pIdQori=$_POST["NamaQori"];
	$pWaktu=$_POST["tanggal"]." ".$_POST["jam"];
	$pMulai=$_POST["mulai"];
	$pSelesai=$_POST["selesai"];
	for ($x=$pMulai;$x<=$pSelesai;$x++) {
		$StrSQL = "insert into qmeter(IdQori,RecDate,Halaman) values($pIdQori,'$pWaktu',$x)";
		$stmt = sqlsrv_prepare( $conn, $StrSQL);
		sqlsrv_execute($stmt);
	}	
	
}


?>
<div  style="padding:12 12 12 12;" class="ui-content ui-page-theme-a" data-form="ui-page-theme-a" data-theme="a" role="main">

 <a href="http://besmarty.net/qmeter/" data-theme="a" data-form="ui-btn-up-a" class=" ui-btn ui-btn-a ui-icon-back ui-btn-icon-left ui-shadow ui-corner-all">Kembali</a>
</div> 
<?php

include "pagefoot.php";
?>
	