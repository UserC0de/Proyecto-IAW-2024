<?php
require 'conexion.php'; // Incluye el archivo de conexión a la base de datos

// Inicia sesión si no está iniciada
session_start();
if (!isset($_SESSION['id_usuario'])) {
    header("location: index.php");
    exit();
}

if ($_SESSION['estado'] !== 'A') {
    header("location: usuario_bloq.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/bootstrap.css">
</head>

<body class="container vh-100 d-flex align-items-center justify-content-center" style="background-image: url('fotos/casino.jpeg'); background-size: cover; background-position: center">
    <div class="row bg-dark p-5 rounded-4">
        <?php
        // Verifica si se recibieron los datos del formulario por POST
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            function generarNumeroAleatorio($mysqli, $intentos = 0)
            {
                // Si se han intentado 5 veces, imprimir un mensaje y salir
                if ($intentos >= 5) {
                    echo '<div class="alert alert-danger" role="alert">La base de datos está llena de apuestas.</div>';
                    return false;
                }

                // Generar un número aleatorio
                $num_random = rand(0, 999999);

                // Consultar si ya existe un usuario con ese id_usuario
                $sql = "SELECT COUNT(*) AS count FROM apuestas WHERE id_apuesta = '$num_random'";
                $resultado = $mysqli->query($sql);

                if ($resultado) {
                    $row = $resultado->fetch_assoc();
                    $count = $row['count'];
                    // Si ya existe un usuario con ese id_usuario, generar otro número
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
            
            // Recuperar los valores del formulario
            $id_apuesta = generarNumeroAleatorio($mysqli);
            $id_usuario = $mysqli->real_escape_string($_POST['id_usuario']);
            $id_partido = $mysqli->real_escape_string($_POST['id_partido']);
            $monto = $mysqli->real_escape_string($_POST['monto']);
            $resultado = $mysqli->real_escape_string($_POST['resultado']);
            $liquidez_casino = 5319.317;

            // Verifica el valor de $resultado y asigna la cuota correspondiente
            if ($resultado == 1 || $resultado == 2) {
                // Hacer la consulta SQL para obtener las cuotas del partido
                $sql_cuotas = "SELECT cuota_visitante, cuota_local FROM cuotas WHERE id_partido = $id_partido";
                $resultado_cuotas = $mysqli->query($sql_cuotas);

                $fila_cuotas = $resultado_cuotas->fetch_assoc();

                // Asignar la cuota correspondiente según el resultado
                if ($resultado == 1) {
                    $cuota = $fila_cuotas['cuota_visitante'];
                } elseif ($resultado == 2) {
                    $cuota = $fila_cuotas['cuota_local'];
                }
            }

            // Verificar si el usuario tiene suficiente saldo para la apuesta
            $sql_saldo_usuario = "SELECT saldo FROM usuarios WHERE id_usuario = '$id_usuario'";
            $resultado_saldo = $mysqli->query($sql_saldo_usuario);

            if ($resultado_saldo) {
                // Verificar si se encontraron resultados
                if ($resultado_saldo->num_rows > 0) {
                    $row_saldo = $resultado_saldo->fetch_assoc();
                    $saldo_usuario = $row_saldo['saldo'];

                    // Verificar si el saldo del usuario es suficiente para la apuesta
                    if ($saldo_usuario >= $monto) {
                        // Restar el monto de la apuesta del saldo del usuario
                        $nuevo_saldo = $saldo_usuario - $monto;
                        
                        // Consulta para obtener el monto total apostado por el usuario en este partido
                        $sql_monto_total_apostado = "SELECT SUM(monto) AS monto_total FROM apuestas WHERE id_usuario = '$id_usuario' AND id_partido = '$id_partido'";
                        $resultado_monto_total = $mysqli->query($sql_monto_total_apostado);

                        if ($resultado_monto_total) {
                            $row_monto_total = $resultado_monto_total->fetch_assoc();
                            $monto_total_apostado = $row_monto_total['monto_total'];

                            // Verificar si el monto total apostado más el nuevo monto de la apuesta supera los 500€
                            if ($monto_total_apostado + $monto <= 500) {
                                // Obtener las cuotas actuales del partido
                                $sql_cuotas = "SELECT cuota_visitante, cuota_local FROM cuotas WHERE id_partido = '$id_partido'";
                                $resultado_cuotas = $mysqli->query($sql_cuotas);

                                if ($resultado_cuotas) {
                                    $row_cuotas = $resultado_cuotas->fetch_assoc();

                                    $cuota_actual_visitante = $row_cuotas['cuota_visitante'];
                                    $cuota_actual_local = $row_cuotas['cuota_local'];

                                    // Actualizar las cuotas según el resultado de la apuesta
                                    // Verificar si la nueva cuota calculada es menor que 1 y ajustarla si es necesario
                                    if ($resultado == 1) {
                                        $cuota_visitante_nueva = $cuota_actual_visitante - ($cuota_actual_visitante * $monto / $liquidez_casino);
                                        if ($cuota_visitante_nueva < 1) {
                                            $cuota_visitante_nueva = 1; // Establecer la cuota mínima como 1
                                        }
                                        $sql_actualizar_cuotas = "UPDATE cuotas SET cuota_visitante = '$cuota_visitante_nueva' WHERE id_partido = '$id_partido'";
                                    } elseif ($resultado == 2) {
                                        $cuota_local_nueva = $cuota_actual_local - ($cuota_actual_local * $monto / $liquidez_casino);
                                        if ($cuota_local_nueva < 1) {
                                            $cuota_local_nueva = 1; // Establecer la cuota mínima como 1
                                        }
                                        $sql_actualizar_cuotas = "UPDATE cuotas SET cuota_local = '$cuota_local_nueva' WHERE id_partido = '$id_partido'";
                                    }

                                    // Ejecutar la consulta para actualizar las cuotas
                                    $resultado_actualizar_cuotas = $mysqli->query($sql_actualizar_cuotas);

                                    if ($resultado_actualizar_cuotas) {
                                        // Actualizar el saldo del usuario
                                        $sql_actualizar_saldo = "UPDATE usuarios SET saldo = '$nuevo_saldo' WHERE id_usuario = '$id_usuario'";
                                        $resultado_actualizar_saldo = $mysqli->query($sql_actualizar_saldo);

                                        if ($resultado_actualizar_saldo) {
                                            // Insertar la apuesta en la base de datos
                                            $sql_insertar_apuesta = "INSERT INTO apuestas (id_apuesta, id_usuario, id_partido, cuota, monto, fecha, resultado) 
                                    VALUES ('$id_apuesta', '$id_usuario', '$id_partido', '$cuota', '$monto', CURRENT_TIMESTAMP, '$resultado')";
                                            $resultado_insertar_apuesta = $mysqli->query($sql_insertar_apuesta);
                                            header("location: apuestas.php");
                                        } else {
                                            // Manejar el error al actualizar el saldo del usuario
                                            echo '<div class="alert alert-danger" role="alert">Error al actualizar el saldo del usuario: ' . $mysqli->error . '</div>';
                                            echo "<div class='d-flex justify-content-center'>";
                                            echo "<p><a href='crear_apuesta.php?id_partido=$id_partido'><button type='button' class='btn btn-primary'>Volver</button></a></p>";
                                            echo "</div>";
                                        }
                                    } else {
                                        // Manejar el error al actualizar las cuotas
                                        echo '<div class="alert alert-danger" role="alert">Error al actualizar las cuotas: ' . $mysqli->error . '</div>';
                                        echo "<div class='d-flex justify-content-center'>";
                                        echo "<p><a href='crear_apuesta.php?id_partido=$id_partido'><button type='button' class='btn btn-primary'>Volver</button></a></p>";
                                        echo "</div>";
                                    }
                                } else {
                                    // Manejar el error al obtener las cuotas del partido
                                    echo '<div class="alert alert-danger" role="alert">Error al obtener las cuotas del partido: ' . $mysqli->error . '</div>';
                                    echo "<div class='d-flex justify-content-center'>";
                                    echo "<p><a href='crear_apuesta.php?id_partido=$id_partido'><button type='button' class='btn btn-primary'>Volver</button></a></p>";
                                    echo "</div>";
                                }
                            } else {
                                // Mostrar mensaje de error y evitar la apuesta
                                echo '<div class="alert alert-danger" role="alert">Error: El monto total apostado por este usuario en este partido no puede superar los 500€.</div>';
                                echo "<div class='d-flex justify-content-center'>";
                                echo "<p><a href='crear_apuesta.php?id_partido=$id_partido'><button type='button' class='btn btn-primary'>Volver</button></a></p>";
                                echo "</div>";
                            }
                        } else {
                            // Manejar el error al obtener el monto total apostado por el usuario
                            echo '<div class="alert alert-danger" role="alert">Error al obtener el monto total apostado por el usuario: ' . $mysqli->error . '</div>';
                            echo "<div class='d-flex justify-content-center'>";
                            echo "<p><a href='crear_apuesta.php?id_partido=$id_partido'><button type='button' class='btn btn-primary'>Volver</button></a></p>";
                            echo "</div>";
                        }
                    } else {
                        // Mostrar mensaje de error si el saldo del usuario es insuficiente
                        echo '<div class="alert alert-danger" role="alert">Saldo insuficiente para realizar la apuesta.</div>';
                        echo "<div class='d-flex justify-content-center'>";
                        echo "<p><a href='crear_apuesta.php?id_partido=$id_partido'><button type='button' class='btn btn-primary'>Volver</button></a></p>";
                        echo "</div>";
                    }
                } else {
                    // Manejar el caso en que no se encuentra el saldo del usuario
                    echo '<div class="alert alert-danger" role="alert">Error: No se encontró el saldo del usuario.</div>';
                    echo "<div class='d-flex justify-content-center'>";
                    echo "<p><a href='crear_apuesta.php?id_partido=$id_partido'><button type='button' class='btn btn-primary'>Volver</button></a></p>";
                    echo "</div>";
                }
            } else {
                // Manejar el error de la consulta de saldo del usuario
                echo '<div class="alert alert-danger" role="alert">Error al consultar el saldo del usuario: ' . $mysqli->error . '</div>';
                echo "<div class='d-flex justify-content-center'>";
                echo "<p><a href='crear_apuesta.php?id_partido=$id_partido'><button type='button' class='btn btn-primary'>Volver</button></a></p>";
                echo "</div>";
            }
        } else {
            header("location: apuestas.php"); // Redirige si el método no es POST
        }
        ?>
    </div>
</body>

</html>
