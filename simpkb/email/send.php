<?php
$to=$_GET["to"];
$otp=$_GET["otp"];
$str="KirimEmail.exe $to " .chr(34) ."Pendaftaran Online Kir Kota Samarinda".chr(34)." " .chr(34) ."Nomor Verifikasi : $otp Pengujian Kendaraan Bemotor, Dinas Perhubungan Kota Samarinda.".chr(34);
//echo $str;
$answer = shell_exec($str );
echo $answer;
?>