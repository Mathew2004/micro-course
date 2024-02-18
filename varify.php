<?php

if(isset($_POST['g-recaptcha-response']))

$secretKey = '6LdxCF8pAAAAALn9c2RFHCWQgQ-sH-T0oSBmEItB';
$ip = $_SERVER['REMOTE_ADDR'];
$response = $_POST['g-recaptcha-response'];
$url = "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$response&remoteip=$ip";
$fire = file_get_contents($url);
$data = json_decode($fire);
echo $fire;
//echo var_dump($data->success);
if($data->success == true){
    echo "seucc";
}
else{
    echo "fuck";
}


?>