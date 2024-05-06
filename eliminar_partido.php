<?php
require 'conexion.php'; // Incluir el archivo de conexión
// Verificar si se ha iniciado sesión y si el usuario tiene el rol de administrador
session_start();
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
    // Si no tiene el rol de administrador, redirigir a algún lugar o mostrar un mensaje de error
    header("Location: https://www.youtube.com/watch?v=xvFZjo5PgG0&ab_channel=Duran");
    exit();
}
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
    // Verificar si se recibió una solicitud GET con el parámetro id
    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id_partido'])) {
        // Recuperar el ID del partido desde la URL
        $id_partido = $_GET['id_partido'];

        // Preparar la consulta SQL para obtener las apuestas asociadas al partido
        $sql_apuestas = "SELECT id_usuario, monto FROM apuestas WHERE id_partido = $id_partido";

        // Ejecutar la consulta para obtener las apuestas
        $resultado_apuestas = $mysqli->query($sql_apuestas);
        if ($resultado_apuestas) {
            // Recorrer las apuestas y devolver el saldo apostado a los usuarios correspondientes
            while ($fila_apuesta = $resultado_apuestas->fetch_assoc()) {
                $id_usuario = $fila_apuesta['id_usuario'];
                $monto_apostado = $fila_apuesta['monto'];

                // Preparar la consulta SQL para actualizar el saldo del usuario devolviendo el monto apostado
                $sql_devolver_saldo = "UPDATE usuarios SET saldo = saldo + $monto_apostado WHERE id_usuario = $id_usuario";

                // Ejecutar la consulta para devolver el saldo
                $mysqli->query($sql_devolver_saldo);
            }
        }

        // Preparar la consulta SQL para eliminar las cuotas asociadas al partido
        $sql_delete_cuotas = "DELETE FROM cuotas WHERE id_partido = $id_partido";

        // Ejecutar la consulta para eliminar las apuestas
        if ($mysqli->query($sql_delete_cuotas) === TRUE) {
            // Preparar la consulta SQL para eliminar las apuestas asociadas al partidop

            $sql_delete_apuestas = "DELETE FROM apuestas WHERE id_partido = $id_partido";

            // Ejecutar la consulta para eliminar las apuestas
            if ($mysqli->query($sql_delete_apuestas) === TRUE) {
                // Preparar la consulta SQL para eliminar el partido
                $sql_delete_partido = "DELETE FROM partidos WHERE id_partido = $id_partido";


                // Ejecutar la consulta para eliminar el partido
                if ($mysqli->query($sql_delete_partido) === TRUE) {
                    // Redirigir al usuario a la página de gestión de partidos si la eliminación fue exitosa
                    header("Location: gestion_partidos.php");
                    exit();
                } else {
                    // Mostrar un mensaje de error si la eliminación del partido falla
                    echo '<div class="alert alert-danger" role="alert">Error al eliminar el partido: ' . $mysqli->error . '</div>';
                    exit();
                }
            } else {
                // Mostrar un mensaje de error si la eliminación de las cuotas asociadas al partido falla
                echo '<div class="alert alert-danger" role="alert">Error al eliminar las cuotas asociadas al partido: ' . $mysqli->error . '</div>';
                exit();
            }
        } else {
            // Mostrar un mensaje de error si la eliminación de las apuestas asociadas al partido falla
            echo '<div class="alert alert-danger" role="alert">Error al eliminar las apuestas asociadas al partido: ' . $mysqli->error . '</div>';
            exit();
        }

        // Cerrar la conexión a la base de datos
        $mysqli->close();
    } else {
        // Si no se proporcionó un ID de partido, redirigir al usuario a una página de error o mostrar un mensaje de error
        echo '<div class="alert alert-danger" role="alert">No se proporcionó un ID de partido válido.</div>';
        exit();
    }
    ?>
</body>

</html>