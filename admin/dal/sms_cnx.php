<?php

function ConSms() {
	
	$dbhost = 'localhost';
	$dbuser = 'root';
	$dbpass = '';
	$dbname = 'sms_db';
	/**/
	// NOTA: Reemplace password por el password de su cuenta de hosting
	
	$connId = mysql_connect($dbhost, $dbuser, $dbpass) or die('Ocurrió un error al conectarse al servidor mysql');

	
	mysql_select_db($dbname, $connId);
		    
    mysql_query("SET NAMES utf8");		 
	
	return $connId;
}


?>
