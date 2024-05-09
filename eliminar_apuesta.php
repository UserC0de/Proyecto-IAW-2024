<?php
require 'conexion.php'; // Reemplaza 'conexion.php' por el nombre de tu archivo de conexión

// Verificar si se ha iniciado sesión y si el usuario tiene el rol de administrador
session_start();
// if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
//     // Si no tiene el rol de administrador, redirigir a algún lugar o mostrar un mensaje de error
//     header("Location: https://www.youtube.com/watch?v=xvFZjo5PgG0&ab_channel=Duran");
//     exit();
// }
$id_usuario = $_SESSION['id_usuario'];
// Verificar si se recibió el ID de la apuesta por GET
if (isset($_GET['id_apuesta'])) {
    // Obtener el ID de la apuesta
    $id_apuesta = $_GET['id_apuesta'];

    // Consulta SQL para obtener la información de la apuesta
    $sql_apuesta = "SELECT id_partido, monto, resultado, cuota FROM apuestas WHERE id_apuesta = '$id_apuesta'";
    $resultado_apuesta = $mysqli->query($sql_apuesta);

    if ($resultado_apuesta) {
        // Obtener la información de la apuesta
        $fila_apuesta = $resultado_apuesta->fetch_assoc();

        $id_partido = $fila_apuesta['id_partido'];
        $monto_apuesta = $fila_apuesta['monto'];
        $resultado = $fila_apuesta['resultado'];
        $cuota_apostada = $fila_apuesta['cuota'];
        $liquidez_casino = 5319.317;

        // Consulta SQL para eliminar la apuesta
        $sql_eliminar_apuesta = "DELETE FROM apuestas WHERE id_apuesta = '$id_apuesta'";


        // Ejecutar la consulta para eliminar la apuesta
        if ($mysqli->query($sql_eliminar_apuesta)) {

            $sql_cuotas = "SELECT cuota_visitante, cuota_local FROM cuotas WHERE id_partido = '$id_partido'";
            $resultado_cuotas = $mysqli->query($sql_cuotas);

            $row_cuotas = $resultado_cuotas->fetch_assoc();

            $cuota_actual_visitante = $row_cuotas['cuota_visitante'];
            $cuota_actual_local = $row_cuotas['cuota_local'];

            // Obtener la cantidad total apostada para cada resultado
            if ($resultado == 1) {

                $cuota_visitante_nueva = $cuota_actual_visitante + ($cuota_actual_visitante * $monto_apuesta / $liquidez_casino);

                if ($cuota_visitante_nueva < 1) {
                    $cuota_visitante_nueva = 1; // Establecer la cuota mínima como 1
                }
                $sql_actualizar_cuotas = "UPDATE cuotas SET cuota_visitante = '$cuota_visitante_nueva' WHERE id_partido = '$id_partido'";
            } elseif ($resultado == 2) {
                $cuota_local_nueva = $cuota_actual_local + ($cuota_actual_local * $monto_apuesta / $liquidez_casino);

                if ($cuota_local_nueva < 1) {
                    $cuota_local_nueva = 1; // Establecer la cuota mínima como 1
                }
                $sql_actualizar_cuotas = "UPDATE cuotas SET cuota_local = '$cuota_local_nueva' WHERE id_partido = '$id_partido'";
            }

            // Ejecutar la consulta para actualizar las cuotas
            $resultado_actualizar_cuotas = $mysqli->query($sql_actualizar_cuotas);

            // Ejecutar la consulta para eliminar la apuesta
            if ($mysqli->query($sql_eliminar_apuesta)) {
                // Consulta SQL para sumar el monto al saldo del usuario
                $sql_saldo_usuario = "SELECT saldo FROM usuarios where id_usuario=$id_usuario";


                // Ejecutar la consulta para obtener el saldo del usuario
                $resultado_saldo_usuario = $mysqli->query($sql_saldo_usuario);
                // Obtener el saldo del usuario
                $fila_saldo_usuario = $resultado_saldo_usuario->fetch_assoc();
                $saldo_usuario = $fila_saldo_usuario['saldo'];


                // Calcular el 40% del monto apostado
                $monto_a_sumar = $monto_apuesta * 0.4173;
                $nuevo_saldo = $saldo_usuario + $monto_a_sumar;
                // Sumar el monto al saldo del usuario
                $sql_sumar_saldo = "UPDATE usuarios SET saldo = $nuevo_saldo WHERE id_usuario=$id_usuario";

                // Ejecutar la consulta para sumar el monto al saldo del usuario
                if ($mysqli->query($sql_sumar_saldo)) {
                    // Si la eliminación y la actualización del saldo fueron exitosas, redirigir a la página de apuestas
                    header("Location: mis_apuestas.php");
                    exit();
                } else {
                    // Si hubo un error al actualizar el saldo, mostrar un mensaje de error
                    echo "Error al actualizar el saldo del usuario: " . $mysqli->error;
                }
            } else {
                // Si hubo un error al eliminar la apuesta, mostrar un mensaje de error
                echo "Error al eliminar la apuesta: " . $mysqli->error;
            }
        } else {
            // Si no se encontró el monto apostado, mostrar un mensaje de error
            echo "Error: No se encontró el monto apostado para esta apuesta.";
        }
    } else {
        // Si no se recibió el ID de la apuesta, mostrar un mensaje de error
        echo "Error: No se proporcionó el ID de la apuesta.";
    }
}
// Cerrar la conexión
$mysqli->close();
