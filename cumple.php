<?php session_start(); ?>
<!DOCTYPE html>
<html class="no-js">
<head>
    <?php include("PHPMailer/class.phpmailer.php") ?>
    <?php include("inc/header.inc.php") ?>
</head>
<body> 
    <?php 
    Empleados_Cumpleanos();
    Familiares_Cumpleanos();
    ?>
</body>
</html>
