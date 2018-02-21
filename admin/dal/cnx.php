<?php

header('Content-type: text/html; charset=utf-8');
define("BASE_URL", "http://rocha.com/clubzf/sitio");

function Conectarse()
{


    $dbhost = '127.0.0.1';
    $dbuser = 'root';
    $dbpass = '';
    $dbname = 'clubzf';
    /*
    $mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
    if ($mysqli->connect_errno) {
        echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }
    $mysqli->set_charset("utf8");
    mysqli_set_charset($mysqli,"utf8mb4");
    return $mysqli;
    */
//return $connId;


    $mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

    /* check connection */
    if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    }

    /* change character set to utf8 */
    if (!$mysqli->set_charset("utf8")) {
        printf("Error loading character set utf8: %s\n", $mysqli->error);
    } else {
        //printf("Current character set: %s\n", $mysqli->character_set_name());
    }

    return $mysqli;

}

?>



