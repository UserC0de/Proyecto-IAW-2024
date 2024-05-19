<?php
require 'conexion.php'; // Incluye el archivo de conexión a la base de datos
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CREAR PARTIDO</title>
    <link rel="stylesheet" href="Miestilos.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/bootstrap.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<body>
    <?php
    function generarNumeroAleatorio($mysqli, $intentos = 0)
    {
        // Si se han intentado 5 veces, imprimir un mensaje y salir
        if ($intentos >= 5) {
            echo '<div class="alert alert-danger" role="alert">La base de datos está llena de partidos.</div>';
            return false;
        }

        // Generar un número aleatorio
        $num_random = rand(0, 999999);

        // Consultar si ya existe un partido con ese id_partido
        $num_random = rand(0, 999999);
        $stmt = $mysqli->prepare("SELECT COUNT(*) AS count FROM partidos WHERE id_partido = ?");
        $stmt->bind_param("i", $num_random);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado) {
            $row = $resultado->fetch_assoc();
            $count = $row['count'];
            // Si ya existe un partido con ese id_partido, generar otro número
            if ($count > 0) {
                return generarNumeroAleatorio($mysqli, $intentos + 1);
            } else {
                return $num_random;
            }
        } else {
            // Manejar el error de la consulta
            return false;
        }
    }

    // Verificar si se recibieron los datos del formulario
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Recuperar los datos del formulario
        $jugador_visitante = $mysqli->real_escape_string($_POST["jug_visitante"]);
        $cuota_visitante = $mysqli->real_escape_string($_POST["cuota_visitante"]);
        $jugador_local = $mysqli->real_escape_string($_POST["jug_local"]);
        $cuota_local = $mysqli->real_escape_string($_POST["cuota_local"]);
        $fecha = $mysqli->real_escape_string($_POST["fecha"]);
        $hora = $mysqli->real_escape_string($_POST["hora"]);
        $competencia = $mysqli->real_escape_string($_POST["competencia"]);


        $id_partido = generarNumeroAleatorio($mysqli);

        if (!$id_partido) {
            echo "<div class='alert alert-danger' role='alert'>No se pudo generar un ID de usuario único.</div>";
            echo "<div class='d-flex justify-content-center'>";
            echo "<p><a href='register.php'><button type='button' class='btn btn-primary'>Volver</button></a></p>";
            echo "</div>";
            exit();
        }

        // Insertar los datos del partido en la base de datos
        $sql_partido = "INSERT INTO partidos (id_partido, competicion, jugador_visitante, jugador_local, fecha, hora) 
                VALUES ('$id_partido', '$competencia', '$jugador_visitante', '$jugador_local', '$fecha', '$hora')";
        if ($mysqli->query($sql_partido)) {
            // Éxito al insertar el partido
            echo "El partido se ha creado correctamente.";

            // Insertar las cuotas del partido en la base de datos
            $sql_cuotas = "INSERT INTO Cuotas (id_partido, fecha, cuota_local, cuota_visitante) 
                           VALUES ('$id_partido', CURRENT_TIMESTAMP, '$cuota_local', '$cuota_visitante')";
            if ($mysqli->query($sql_cuotas)) {
                header("Location: gestion_partidos.php");
            } else {
                // Error al insertar las cuotas
                echo "Error al agregar las cuotas: " . $mysqli->error;
            }
        } else {
            // Error al insertar el partido
            echo "Error al crear el partido: " . $mysqli->error;
        }

        // Cerrar la conexión a la base de datos
        $mysqli->close();
    } else {
        // Si se accede directamente a este archivo sin enviar el formulario, redirigir a otra página
        header("Location: index.php");
        exit();
    }
    ?>
</body>

</html>