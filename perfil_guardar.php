<?php
require 'conexion.php';
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
        $email = $_POST["email"];
        $telefono = $_POST["telefono"];


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
            $ciudad2 = $fila_usuario["ciudad"];
            $cod_postal2 = $fila_usuario["cod_postal"];
            $fecha_nac2 = $fila_usuario["fecha_nac"];
            $genero2 = $fila_usuario["genero"];
            $email2 = $fila_usuario["correo"];
            $telefono2 = $fila_usuario["telefono"];
            
        }
        $cumpleanos = new DateTime("$fecha_nac");
        $hoy = new DateTime();
        $edad = $hoy->diff($cumpleanos);
        $edad_str = $edad->format('%y');

        // Verificar si el usuario tiene al menos 18 años
        if ($edad_str < 18) {
            echo '<div class="alert alert-danger" role="alert">Debes tener al menos 18 años para registrarte.</div>';
            $error = true;
        }

        if (!$id_usuario) {
            echo "<div class='alert alert-danger' role='alert'>No se pudo generar un ID de usuario único.</div>";
            echo "<div class='d-flex justify-content-center'>";
            echo "<p><a href='register.php'><button type='button' class='btn btn-primary'>Volver</button></a></p>";
            echo "</div>";
            exit();
        }

            // Obtener los datos actuales del usuario
            $fila_usuario = $resultado_datos_usuario->fetch_assoc();
            // Verificar si ya existe un usuario con el mismo nickname
            $sql_datos_usuario = "SELECT nickname FROM usuarios where id_usuario = '$id_usuario'";
            $resultado_datos_usuario = $mysqli->query($sql_datos_usuario);
            $fila_datos_usuario = $resultado_datos_usuario->fetch_assoc();

            if ($nickname2 !== $nickname){
                $sql = "SELECT * FROM usuarios WHERE nickname = '$nickname'";
                $resultado = $mysqli->query($sql);
            if ($resultado->num_rows > 0) {
                echo '<div class="alert alert-danger" role="alert">Ya existe un usuario con el mismo nickname.</div>';
                echo "<div class='d-flex justify-content-center'>";
                echo "<p><a href='perfil_usuario.php'><button type='button' class='btn btn-primary'>Volver</button></a></p>";
                echo "</div>";
                $error = true;
            } else {
                // Actualizar los datos del usuario en la base de datos
                $sql_update = "UPDATE usuarios set nickname='$nickname' where id_usuario = '$id_usuario'";
                $resultado = $mysqli->query($sql_update);
                header("location: index.php");
            }
        } else {
            header("location: index.php");
        }
        ?>
    </div>
</body>

</html>