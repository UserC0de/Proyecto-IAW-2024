<?php
require 'conexion.php'; // Incluir el archivo de conexión
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
    // Verificar si se recibió una solicitud POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Recuperar los datos del formulario
        $id_partido = $_POST['id_partido'];
        $jugador_visitante = $_POST['jug_visitante'];
        $cuota_visitante = $_POST['cuota_visitante'];
        $jugador_local = $_POST['jug_local'];
        $cuota_local = $_POST['cuota_local'];
        $fecha = $_POST['fecha'];
        $hora = $_POST['hora'];
        $competencia = $_POST['competencia'];

        // Realizar las operaciones de actualización en la base de datos
        // Conectar a la base de datos (suponiendo que ya tienes una conexión establecida)

        // Iniciar transacción
        $mysqli->begin_transaction();

        // Preparar la consulta SQL para actualizar el partido
        $sql_partido = "UPDATE partidos SET 
        jugador_visitante = '$jugador_visitante',
        jugador_local = '$jugador_local',
        fecha = '$fecha',
        hora = '$hora',
        competicion = '$competencia'
        WHERE id_partido = $id_partido";

        // Preparar la consulta SQL para actualizar las cuotas
        $sql_cuotas = "UPDATE cuotas SET 
        cuota_visitante = '$cuota_visitante',
        cuota_local = '$cuota_local'
        WHERE id_partido = $id_partido";

        // Ejecutar las consultas
        if ($mysqli->query($sql_partido) === TRUE && $mysqli->query($sql_cuotas) === TRUE) {
            // Confirmar la transacción si ambas consultas se ejecutaron correctamente
            $mysqli->commit();
            // Redirigir al usuario
            header("Location: gestion_partidos.php");
            exit();
        } else {
            // Revertir la transacción si una de las consultas falla
            $mysqli->rollback();
            // Mostrar mensaje de error
            echo '<div class="alert alert-danger" role="alert">Error al actualizar el partido: ' . $mysqli->error . '</div>';
            exit();
        }

        // Cerrar la conexión a la base de datos
        $mysqli->close();
    } else {
        // Si la solicitud no es POST, redirigir al usuario a una página de error o mostrar un mensaje de error
        header("Location: index.php");
        exit();
    }
    ?>


</body>

</html>