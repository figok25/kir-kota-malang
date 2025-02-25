<?php
include "koneksi.php";

	$sql="update IKM set Resppuas=Resppuas+1";

	$stmt = sqlsrv_prepare( $conn, $sql);
	sqlsrv_execute($stmt);

	header("Location: index.php");

?>