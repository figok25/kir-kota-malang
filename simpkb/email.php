<?php
$to = "to.vicz@gmail.com";
$subject = "My subject";
$txt = "Hello world!";
$headers = "From: simpkb@besmarty.co.id" . "\r\n" ."CC: somebodyelse@example.com";

mail($to,$subject,$txt,$headers);
?>