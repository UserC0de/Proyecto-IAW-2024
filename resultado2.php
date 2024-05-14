<?php
require 'conexion.php'; // Reemplaza 'conexion.php' por el nombre de tu archivo de conexión

// Verificar si se ha iniciado sesión y si el usuario tiene el rol de administrador
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    // Obtener los datos del formulario
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id_usuario = $_POST['id_usuario'];
        $id_partido = $_POST['id_partido'];
        $ganador = $_POST['resultado'];

        // 1. Obtener todas las apuestas asociadas al partido
        $sql_apuestas = "SELECT * FROM apuestas WHERE id_partido = $id_partido";
        $resultado_apuestas = $mysqli->query($sql_apuestas);

        // 2. Comparar el resultado del partido con las apuestas realizadas
        while ($fila = $resultado_apuestas->fetch_assoc()) {
            $id_apuesta = $fila['id_apuesta'];
            $id_usuario_apuesta = $fila['id_usuario'];
            $monto_apuesta = $fila['monto'];
            $cuota_apuesta = $fila['cuota'];
            $resultado_apuesta = $fila['resultado'];

            if ($resultado_apuesta == $ganador) {
                $sql_saldo_usuario = "SELECT saldo FROM usuarios where id_usuario = $id_usuario_apuesta";
                $resultado_saldo = $mysqli->query($sql_saldo_usuario);
                $fila_saldo = $resultado_saldo->fetch_assoc();
                $saldo_usuario = $fila_saldo['saldo'];

                $nuevo_saldo = ($cuota_apuesta*$monto_apuesta)+$saldo_usuario;

                $sql_update = "UPDATE usuarios set saldo = $nuevo_saldo where id_usuario = $id_usuario_apuesta";
                $resultado_update = $mysqli->query($sql_update);
                
                $sql_update_estado = "UPDATE apuestas SET estado = 'GANADA' WHERE id_apuesta = $id_apuesta";
                $resultado_estado = $mysqli->query($sql_update_estado);

            } else {
                $sql_update_estado = "UPDATE apuestas SET estado = 'PERDIDA' WHERE id_apuesta = $id_apuesta";
                $resultado_estado = $mysqli->query($sql_update_estado);
            }
        }
        $sql_update_partido = "UPDATE partidos set resultado = $ganador where id_partido = $id_partido";
        $resultado_partido = $mysqli->query($sql_update_partido);
        header("location: gestion_partidos.php");
    }
    ?>
</body>

</html>