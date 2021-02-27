<?php 
    $host = "localhost";
    $user = "root";
    $pass = "";
    $db = "clinica";
    $tb1 = "usuarios";
    $tb2 = "medico";
    $conexion = new mysqli($host, $user, $pass, $db);

    error_reporting(0);

    if ($conexion->connect_errno) {
        echo "Ups, hubo un error, estamos trabajando para solucionarlo";
    }
?>