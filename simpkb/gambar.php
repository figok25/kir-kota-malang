<?php
header("Content-type: image/jpeg");
include "koneksi.php";
 
$str="select Gambar1 DataKendaraanImg where idWajibUji=25744";
				$stmt = sqlsrv_query($conn,$str);	

if ( sqlsrv_fetch( $stmt ) )  
{  
   $image = sqlsrv_get_field( $stmt, 0,   
                      SQLSRV_PHPTYPE_STREAM(SQLSRV_ENC_BINARY));  
   header("Content-Type: image/jpg");  
   fpassthru($image); 
echo $image;   
} 
		
				
?>