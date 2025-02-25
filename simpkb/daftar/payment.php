<?php

include "koneksi.php";
$va=$_GET["va"]; 
$ref=$_GET["ref"];
$Tanggal=$_GET["tgl"];
$tgl=str_replace("X"," ",$Tanggal);


	$str="select 1 as ada from pengujian where TglRegistrasi>=cast('$tgl' as date) and '10029' + dbo.PadLeft(NoReg, 0, 10)='$va'";
	$rs = sqlsrv_query($conn,$str);	
	$r=sqlsrv_fetch_array($rs);	
	if($r["ada"]=="1"){
		$StrSQL = "update pengujian set jatim_ref='$ref',jatim_paydate='$tgl' where aktif=1 and '10029' + dbo.PadLeft(NoReg, 0, 10)='$va'";
		$stmt = sqlsrv_prepare( $conn, $StrSQL);
		sqlsrv_execute($stmt);
			
		$rs = sqlsrv_query($conn,"select jatim_ref from pengujian where jatim_ref='$ref'");	
		$r=sqlsrv_fetch_array($rs);	
		if($r["jatim_ref"]==$ref){
			$response ="00";
		}else{
		
			$response ="99";
		}
	}else{
		$response ="01";
	}
	
	


echo $response; 

?>