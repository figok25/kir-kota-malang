<?php

//server
// $serverName = "192.168.1.10";
// $dbname="db_SIMPKB";
// $UID="sa";
// $password="@abcd1234";

//local
$serverName = "192.168.1.11";
$dbname = "db_SIMPKB";
$UID = "sa";
$password = "@abcd1234";

$connectionInfo = array("Database" => "$dbname", "UID" => "$UID", "PWD" => "$password");


//$connectionInfo = array( "Database"=>"db_SIMPKB");
$conn = sqlsrv_connect($serverName, $connectionInfo);

if ($conn) {
    //echo "Connection established.<br />";
} else {
    echo "Connection could not be established.<br />";
    die(print_r(sqlsrv_errors(), true));
}
