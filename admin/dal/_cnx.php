<?php

function Conectarse() {
	
	$dbhost = 'localhost';
	$dbuser = 'w1361331_rocha';
	$dbpass = 'faAr2010';
	$dbname = 'w1361331_implecor';
	/**/
	// NOTA: Reemplace password por el password de su cuenta de hosting
	
	//"tv5_luque","2261494","tv5luque"
	
	$connId = mysql_connect($dbhost, $dbuser, $dbpass) or die('Ocurrió un error al conectarse al servidor mysql');

	mysql_select_db($dbname, $connId);		    
    //mysql_query("SET NAMES utf8");		 
	
	return $connId;
}


function Conectarse_Mysqli() {
	$connId = mysqli_connect("localhost","w1361331_rocha","faAr2010","w1361331_implecor") or die("Error en el server".mysqli_error($con));
	//mysql_query("SET NAMES utf8");		 	
	return $connId;
}



?>
