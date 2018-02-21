<?php
require('class.antihack.php');

$anti = new Sec_Hack_Dettecter();
$adminMAIL = 'info.';

if($anti->detect_hack(NULL,'SPIDER') == true or $anti->detect_hack($anti->curPageURL()) == true){
        die('U are banned, contact: '.$adminMAIL);         
}

if($anti->detect_hack(NULL,'POST') == true or $anti->detect_hack(NULL,'COOKIE') == true or $anti->detect_hack(NULL,'QUERY') == true){
        die('U are banned, contact: '.$adminMAIL);   
}

if($anti->detect_hack(NULL,'FILES') == true){
        die('U are banned, contact: '.$adminMAIL);   
}

if($anti->detect_hack($_SESSION) == true){
        die('U are banned, contact: '.$adminMAIL);   
}
?>