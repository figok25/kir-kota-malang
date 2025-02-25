<?php
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://graph.facebook.com/v14.0/108447818703550/messages',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'
	{
		"messaging_product": "whatsapp",
		"to": "628561001080",
		"type": "template",
		"template": {
			"name": "remkir_otp",
			"language": {
				"code": "id"
			},
			"components": [
				{
					"type": "body",
					"parameters": [
						{
							"type": "text",
							"text": "0000"
						}
					]
				}
			]
		}
	}',
  CURLOPT_HTTPHEADER => array(
    'Authorization: Bearer EAAvZAZCfqDXEMBAI23TCwLyyiijlGMPjPUbgxKSX9HcWZB9ZBaC37ZBjIGyCXRnZAX0E8Kf8K9NVRJWxSeg3muYCBYkIsttBEZAO4w6BLkt05mdPIycZB9tQLiuAYAPkD0vomQdEO8ZAzWxQ79ZCZA1Rx42EplijWtiNrRrK4upzl2qCvDOS3ItZA9wenCjy2AoVnfP6W7TZBJygipQZDZD',
    'Content-Type: application/json'
  )
));

$response = curl_exec($curl);

curl_close($curl);
echo "RESP : ".$response;



?>