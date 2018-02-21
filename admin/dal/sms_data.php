<?php

include 'sms_cnx.php';

$op = isset($_GET['op']) ? $_GET['op'] : '';
$pagina = isset($_GET['pag']) ? $_GET['pag'] : '';
$pasos = isset($_GET['paso']) ? $_GET['paso'] : '';

require_once ("inc/mod_sms/SendSMS.php");

$sms_username = "estudioroch1";
$sms_password = "gmMISKIn";
$destination = "3564570789";

function mydie($errstr) {
	die("Error: " . $errstr . "\n");
}

function Enviar_SMS($sDe, $sPara, $sTexto) {
	global $sDe, $sPara, $errstr;
    # Construct an SMS object
    $sms = new SMS();

    # Set the destination address 
    $sms->setDA($sDe) or mydie($errstr);

    # Set the source address
    $sms->setSA($sPara) or mydie($errstr);

    # Set the user reference
    $sms->setUR("AF31C0D") or mydie($errstr);

    # Set delivery receipts to 'on'
    $sms->setDR("1") or mydie ($errstr);

    # Set the message content
    $sms->setMSG($sTexto) or mydie ($errstr);

    # Send the message and inspect the responses
    $responses = send_sms_object($sms) or mydie ($errstr);
    echo "Example 7.1 Response:\n";
    foreach ($responses as $response) {
        echo "\t$response\n";
    }
}
?>