<?php

include "koneksi.php";

$sql="select Gambar1 from vFotoKendaraan where NoUji='BF13C20009841'";
$stmt = sqlsrv_query($conn, $sql);
echo $stmt;
if ( sqlsrv_fetch($stmt) )
{
    // get stream from sqlsrv:
    $data = sqlsrv_get_field($stmt, 0, SQLSRV_PHPTYPE_STREAM(SQLSRV_ENC_BINARY));
    // write stream directly to output buffer:
	echo $data[1];
	die;
    header("Content-Type: image/jpeg");
    fpassthru($data);
}

?>