<?php
require 'conexion.php';
// Iniciar sesión si no está iniciada
session_start();

// Verificar si hay una sesión iniciada
if (isset($_SESSION['id_usuario'])) {
    // Recuperar el ID de usuario de la sesión
    $rol_usuario = $_SESSION['rol'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="Miestilos.css">
    <link rel="stylesheet" href="css/bootstrap.css">
</head>

<body class="container vh-100 d-flex align-items-center justify-content-center" style="background-image: url('fotos/casino.jpeg'); background-size: cover; background-position: center">
    <div class="row bg-dark p-5 rounded-4">
        <?php
        require 'conexion.php';
        $error = false;

        if ($rol_usuario == "admin") {
            // Obtener los datos del formulario
            $id_usuario = $_POST["id_usuario"];
            $nombre = $_POST["nombre"];
            $nickname = $_POST["usuario"];
            $apellido = $_POST["apellido"];
            $dni = $_POST["dni"];
            $direccion = $_POST["direccion"];
            $pais = $_POST["pais"];
            $ciudad = $_POST["ciudad"];
            $cod_postal = $_POST["cod_postal"];
            $fecha_nac = $_POST["fecha_nac"];
            $genero = $_POST["genero"];
            $correo = $_POST["email"];
            $telefono = $_POST["telefono"];

            $cumpleanos = new DateTime("$fecha_nac");
            $hoy = new DateTime();
            $edad = $hoy->diff($cumpleanos);
            $edad_str = $edad->format('%y');

        } else {
            // Obtener los datos del formulario
            $id_usuario = $_POST["id_usuario"];
            $nombre = $_POST["nombre"];
            $apellido = $_POST["apellido"];
            $direccion = $_POST["direccion"];
            $pais = $_POST["pais"];
            $ciudad = $_POST["ciudad"];
            $cod_postal = $_POST["cod_postal"];
            $genero = $_POST["genero"];
        }

        if (isset($_POST['nombre'])) {
            $sql_act_nombre = "UPDATE usuarios set nombre='$nombre' where id_usuario = '$id_usuario'";
            $resultado = $mysqli->query($sql_act_nombre);
        }

        if (isset($_POST['apellido'])) {
            $sql_act_apellido = "UPDATE usuarios set apellido='$apellido' where id_usuario = '$id_usuario'";
            $resultado = $mysqli->query($sql_act_apellido);
        }

        if (isset($_POST['direccion'])) {
            $sql_act_direccion = "UPDATE usuarios set direccion='$direccion' where id_usuario = '$id_usuario'";
            $resultado = $mysqli->query($sql_act_direccion);
        }

        if (isset($_POST['pais'])) {
            $sql_act_pais = "UPDATE usuarios set pais='$pais' where id_usuario = '$id_usuario'";
            $resultado = $mysqli->query($sql_act_pais);
        }

        if (isset($_POST['ciudad'])) {
            $sql_act_ciudad = "UPDATE usuarios set ciudad='$ciudad' where id_usuario = '$id_usuario'";
            $resultado = $mysqli->query($sql_act_ciudad);
        }

        if (isset($_POST['cod_postal'])) {
            $sql_act_cod_postal = "UPDATE usuarios set cod_postal='$cod_postal' where id_usuario = '$id_usuario'";
            $resultado = $mysqli->query($sql_act_cod_postal);
        }

        if (isset($_POST['genero'])) {
            $sql_act_genero = "UPDATE usuarios set genero='$genero' where id_usuario = '$id_usuario'";
            $resultado = $mysqli->query($sql_act_genero);
        }
        // Consulta para obtener los datos actuales del usuario
        $sql_datos_usuario = "SELECT * FROM usuarios WHERE id_usuario = '$id_usuario'";
        $resultado_datos_usuario = $mysqli->query($sql_datos_usuario);

        if ($resultado_datos_usuario->num_rows > 0) {
            // Obtener los datos actuales del usuario
            $fila_usuario = $resultado_datos_usuario->fetch_assoc();

            // Recuperar los datos del formulario
            $nombre2 = $fila_usuario["nombre"];
            $apellido2 = $fila_usuario["apellido"];
            $nickname2 = $fila_usuario["nickname"];
            $dni2 = $fila_usuario["dni"];
            $direccion2 = $fila_usuario["direccion"];
            $pais2 = $fila_usuario["pais"];
            $fecha_nac2 = $fila_usuario["fecha_nac"];
            $ciudad2 = $fila_usuario["ciudad"];
            $cod_postal2 = $fila_usuario["cod_postal"];
            $genero2 = $fila_usuario["genero"];
            $correo2 = $fila_usuario["correo"];
            $telefono2 = $fila_usuario["telefono"];
        }


        if (isset($_POST['usuario'])) {
            if ($nickname2 !== $nickname) {
                $sql = "SELECT * FROM usuarios WHERE nickname = '$nickname'";
                $resultado = $mysqli->query($sql);

                if ($resultado->num_rows > 0) {
                    echo '<div class="alert alert-danger" role="alert">Ya existe un usuario con el mismo nickname.</div>';
                    echo "<div class='d-flex justify-content-center'>";
                    echo "<p><a href='perfil_usuario.php'><button type='button' class='btn btn-primary'>Volver</button></a></p>";
                    echo "</div>";
                    exit();
                } else {
                    // Actualizar los datos del usuario en la base de datos
                    $sql_update = "UPDATE usuarios set nickname='$nickname' where id_usuario = '$id_usuario'";
                    $resultado = $mysqli->query($sql_update);
                    header("location: gestion_usuarios.php");
                }
             }
        }

        if (isset($_POST['dni'])) {
            if ($dni2 !== $dni) {
                $sql = "SELECT * FROM usuarios WHERE dni = '$dni'";
                $resultado = $mysqli->query($sql);

                if ($resultado->num_rows > 0) {
                    echo '<div class="alert alert-danger" role="alert">Ya existe un usuario con el mismo dni.</div>';
                    echo "<div class='d-flex justify-content-center'>";
                    echo "<p><a href='perfil_usuario.php'><button type='button' class='btn btn-primary'>Volver</button></a></p>";
                    echo "</div>";
                    exit();
                } else {
                    // Actualizar los datos del usuario en la base de datos
                    $sql_update = "UPDATE usuarios set dni='$dni' where id_usuario = '$id_usuario'";
                    $resultado = $mysqli->query($sql_update);
                    header("location: gestion_usuarios.php");
                }
            }
        }

        if (isset($_POST['fecha_nac'])) {
            if ($fecha_nac2 !== $fecha_nac && $edad_str > 18) {
                    $sql_update = "UPDATE usuarios set fecha_nac='$fecha_nac' where id_usuario = '$id_usuario'";
                    $resultado = $mysqli->query($sql_update);
                    header("location: gestion_usuarios.php");
                } else {
                    echo '<div class="alert alert-danger" role="alert">La edad debe ser mayor de 18 años.</div>';
                    echo "<div class='d-flex justify-content-center'>";
                    echo "<p><a href='perfil_usuario.php'><button type='button' class='btn btn-primary'>Volver</button></a></p>";
                    echo "</div>";
                    exit();
                }
            }

            if (isset($_POST['email'])) {
                if ($correo2 !== $correo) {
                    $sql = "SELECT * FROM usuarios WHERE correo = '$correo'";
                    $resultado = $mysqli->query($sql);
    
                    if ($resultado->num_rows > 0) {
                        echo '<div class="alert alert-danger" role="alert">Ya existe un usuario con el mismo correo.</div>';
                        echo "<div class='d-flex justify-content-center'>";
                        echo "<p><a href='perfil_usuario.php'><button type='button' class='btn btn-primary'>Volver</button></a></p>";
                        echo "</div>";
                        exit();
                    } else {
                        // Actualizar los datos del usuario en la base de datos
                        $sql_update = "UPDATE usuarios set correo='$correo' where id_usuario = '$id_usuario'";
                        $resultado = $mysqli->query($sql_update);
                        header("location: gestion_usuarios.php");
                    }
                }
            }

            if (isset($_POST['telefono'])) {
                if ($telefono2 !== $telefono) {
                    $sql = "SELECT * FROM usuarios WHERE telefono = '$telefono'";
                    $resultado = $mysqli->query($sql);
    
                    if ($resultado->num_rows > 0) {
                        echo '<div class="alert alert-danger" role="alert">Ya existe un usuario con el mismo telefono.</div>';
                        echo "<div class='d-flex justify-content-center'>";
                        echo "<p><a href='perfil_usuario.php'><button type='button' class='btn btn-primary'>Volver</button></a></p>";
                        echo "</div>";
                        exit();
                    } else {
                        // Actualizar los datos del usuario en la base de datos
                        $sql_update = "UPDATE usuarios set telefono='$telefono' where id_usuario = '$id_usuario'";
                        $resultado = $mysqli->query($sql_update);
                        header("location: gestion_usuarios.php");
                    }
                } 
            }
            header("location: gestion_usuarios.php");
        ?>
    </div>
</body>

</html>