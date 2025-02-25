<?php

$serverName = "192.168.1.11";
$dbname="db_FO";
$UID="simpkb";
$password="abcd1234";
$connectionInfo = array( "Database"=>"$dbname", "UID"=>"$UID", "PWD"=>"$password");
$conn = sqlsrv_connect( $serverName, $connectionInfo);

if( $conn ) {
     //echo "Connection established.<br />";
}else{
     echo "Connection could not be established.<br />";
     die( print_r( sqlsrv_errors(), true));
}

?>




