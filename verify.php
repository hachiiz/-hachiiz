<?php
$access_token = 'yATEFXRiGBMdLHONoWTkIduiBN5t2tAlhI3qsH6bvSMnlslg6Ve6ax5CHvXW3LgTsDPO5h/z6VmbX6GHh7hx28AiV3FW/ZqoP1cZJxqDu8WoXl7hoq46PCT6gJoTCuodQl3qPHugynJ18leRiS09IgdB04t89/1O/w1cDnyilFU=';

$url = 'https://api.line.me/v1/oauth/verify';

$headers = array('Authorization: Bearer ' . $access_token);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);

echo $result;
?>