<?php
$json = file_get_contents('php://input');
date_default_timezone_set("Asia/Jakarta");
$current_datetime = date("Y-m-d H:i:s");
$current_date = date("Ymd");
file_put_contents("jatimlog_".$current_date.".txt", "$current_datetime $json\n" ,FILE_APPEND);


$data = json_decode($json);
$va=$data->VirtualAccount; 
$ref=$data->Reference;
$Amount=$data->Amount;
$Tanggal=$data->Tanggal;
$tgl=str_replace(" ","X",$Tanggal);

$ch = curl_init(); 
curl_setopt($ch, CURLOPT_URL, "http://36.94.180.43/simpkb/daftar/payment.php?va=".$va."&ref=".$ref."&tgl=".$tgl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
$output = curl_exec($ch); 
curl_close($ch);      
$output=trim($output,"\r\n");
    
$rcErr="False";
$ErrorDesc="Success";
switch($output){
    case "00":
        $rcErr="False";
        $ErrorDesc="Success";
        break;
    case "01":
        $rcErr="True";
        $ErrorDesc="Nomor Virtual Account tidak ditemukan / Expired"; 
        break;
    default:
        $rcErr="True";
        $ErrorDesc="Uknown Error";
        break;
}
header("Content-Type: application/json");

$response = array(
        "VirtualAccount" => $va,
        "Amount"=> $Amount,
        "Tanggal"=> $Tanggal,
        "Status"=>array(
            "IsError" => $rcErr,
            "ResponseCode"=> $output,
            "ErrorDesc"=> $ErrorDesc
        )
    );

echo json_encode($response); 

?>