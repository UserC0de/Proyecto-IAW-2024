<?php
    // Nueva conexion de la clase mysql
    // Parámetros: ubicación del servidor, nombre de usuario, contraseña, base de datos

    $mysqli = new mysqli("localhost","root","","casino");

    if ($mysqli -> connect_errno) {
        echo "Fallo al conectar a MySQL: (", $mysqli->connect_errno ,")" , $mysqli->connect_error;
    } else {
        echo "";
    }
?>