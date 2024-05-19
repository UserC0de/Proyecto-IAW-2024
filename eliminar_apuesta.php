<?php
require 'conexion.php'; // Incluir el archivo de conexión a la base de datos

// Iniciar la sesión
session_start();

// Obtener el ID del usuario de la sesión
$id_usuario = $_SESSION['id_usuario'];

// Verificar si se recibió el ID de la apuesta por GET
if (isset($_GET['id_apuesta'])) {
    // Obtener el ID de la apuesta desde la solicitud GET
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
        $liquidez_casino = 5319.317; // Valor de liquidez del casino, usado para calcular las nuevas cuotas

        // Consulta SQL para eliminar la apuesta
        $sql_eliminar_apuesta = "DELETE FROM apuestas WHERE id_apuesta = '$id_apuesta'";

        // Ejecutar la consulta para eliminar la apuesta
        if ($mysqli->query($sql_eliminar_apuesta)) {
            // Obtener las cuotas actuales del partido
            $sql_cuotas = "SELECT cuota_visitante, cuota_local FROM cuotas WHERE id_partido = '$id_partido'";
            $resultado_cuotas = $mysqli->query($sql_cuotas);

            $row_cuotas = $resultado_cuotas->fetch_assoc();
            $cuota_actual_visitante = $row_cuotas['cuota_visitante'];
            $cuota_actual_local = $row_cuotas['cuota_local'];

            // Calcular las nuevas cuotas basadas en el resultado de la apuesta eliminada
            if ($resultado == 1) {
                // Calcular nueva cuota para el visitante
                $cuota_visitante_nueva = $cuota_actual_visitante + ($cuota_actual_visitante * $monto_apuesta / $liquidez_casino);
                $cuota_visitante_nueva = max(1, $cuota_visitante_nueva); // Establecer la cuota mínima como 1
                $sql_actualizar_cuotas = "UPDATE cuotas SET cuota_visitante = '$cuota_visitante_nueva' WHERE id_partido = '$id_partido'";
            } elseif ($resultado == 2) {
                // Calcular nueva cuota para el local
                $cuota_local_nueva = $cuota_actual_local + ($cuota_actual_local * $monto_apuesta / $liquidez_casino);
                $cuota_local_nueva = max(1, $cuota_local_nueva); // Establecer la cuota mínima como 1
                $sql_actualizar_cuotas = "UPDATE cuotas SET cuota_local = '$cuota_local_nueva' WHERE id_partido = '$id_partido'";
            }

            // Ejecutar la consulta para actualizar las cuotas
            $resultado_actualizar_cuotas = $mysqli->query($sql_actualizar_cuotas);

            // Ejecutar la consulta para eliminar la apuesta (esto parece redundante ya que la apuesta ya fue eliminada anteriormente)
            if ($mysqli->query($sql_eliminar_apuesta)) {
                // Consulta SQL para obtener el saldo del usuario
                $sql_saldo_usuario = "SELECT saldo FROM usuarios WHERE id_usuario = $id_usuario";
                $resultado_saldo_usuario = $mysqli->query($sql_saldo_usuario);

                if ($resultado_saldo_usuario) {
                    // Obtener el saldo del usuario
                    $fila_saldo_usuario = $resultado_saldo_usuario->fetch_assoc();
                    $saldo_usuario = $fila_saldo_usuario['saldo'];

                    // Calcular el nuevo saldo del usuario sumando el 41.73% del monto apostado
                    $monto_a_sumar = $monto_apuesta * 0.4173;
                    $nuevo_saldo = $saldo_usuario + $monto_a_sumar;

                    // Actualizar el saldo del usuario en la base de datos
                    $sql_sumar_saldo = "UPDATE usuarios SET saldo = $nuevo_saldo WHERE id_usuario = $id_usuario";

                    // Ejecutar la consulta para actualizar el saldo del usuario
                    if ($mysqli->query($sql_sumar_saldo)) {
                        // Redirigir al usuario a la página de apuestas si la operación fue exitosa
                        header("Location: mis_apuestas.php");
                        exit();
                    } else {
                        // Mostrar un mensaje de error si no se pudo actualizar el saldo del usuario
                        echo "Error al actualizar el saldo del usuario: " . $mysqli->error;
                    }
                } else {
                    // Mostrar un mensaje de error si no se pudo obtener el saldo del usuario
                    echo "Error al obtener el saldo del usuario: " . $mysqli->error;
                }
            } else {
                // Mostrar un mensaje de error si no se pudo eliminar la apuesta (aunque ya se eliminó antes)
                echo "Error al eliminar la apuesta: " . $mysqli->error;
            }
        } else {
            // Mostrar un mensaje de error si no se pudo eliminar la apuesta
            echo "Error: No se encontró el monto apostado para esta apuesta.";
        }
    } else {
        // Mostrar un mensaje de error si no se pudo obtener la información de la apuesta
        echo "Error: No se proporcionó el ID de la apuesta.";
    }
}
// Cerrar la conexión a la base de datos
$mysqli->close();
?>
