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

        function generarNumeroAleatorio($mysqli, $intentos = 0)
        {
            // Si se han intentado 5 veces, imprimir un mensaje y salir
            if ($intentos >= 5) {
                echo '<div class="alert alert-danger" role="alert">La base de datos está llena de usuarios.</div>';
                return false;
            }

            // Generar un número aleatorio
            $num_random = rand(0, 999999);

            // Consultar si ya existe un usuario con ese id_usuario
            $sql = "SELECT COUNT(*) AS count FROM usuarios WHERE id_usuario = '$num_random'";
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

        // Obtener los datos del formulario
        $nombre = $_POST["nombre"];
        $usuario = $_POST["usuario"];
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
        $password = $_POST["password"];
        $password2 = $_POST["password2"];

        $cumpleanos = new DateTime("$fecha_nac");
        $hoy = new DateTime();
        $edad = $hoy->diff($cumpleanos);
        $edad_str = $edad->format('%y');

        // Verificar si el usuario tiene al menos 18 años
        if ($edad_str < 18) {
            echo '<div class="alert alert-danger" role="alert">Debes tener al menos 18 años para registrarte.</div>';
            $error = true;
        }

        $id_usuario = generarNumeroAleatorio($mysqli);

        if (!$id_usuario) {
            echo "<div class='alert alert-danger' role='alert'>No se pudo generar un ID de usuario único.</div>";
            echo "<div class='d-flex justify-content-center'>";
            echo "<p><a href='register.php'><button type='button' class='btn btn-primary'>Volver</button></a></p>";
            echo "</div>";
            exit();
        }

// Verificar si las contraseñas coinciden
if ($password === $password2) {
    // Verificar si ya existe un usuario con el mismo nickname
    $stmt = $mysqli->prepare("SELECT * FROM usuarios WHERE nickname = ?");
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $resultado = $stmt->get_result();
    if ($resultado->num_rows > 0) {
        echo '<div class="alert alert-danger" role="alert">Ya existe un usuario con el mismo nickname.</div>';
        $error = true;
    }
    $stmt->close();

    // Verificar si ya existe un usuario con el mismo correo electrónico
    $stmt = $mysqli->prepare("SELECT * FROM usuarios WHERE correo = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $resultado = $stmt->get_result();
    if ($resultado->num_rows > 0) {
        echo '<div class="alert alert-danger" role="alert">Ya existe un usuario con el mismo correo electrónico.</div>';
        $error = true;
    }
    $stmt->close();

    // Verificar si ya existe un usuario con el mismo DNI
    $stmt = $mysqli->prepare("SELECT * FROM usuarios WHERE dni = ?");
    $stmt->bind_param("s", $dni);
    $stmt->execute();
    $resultado = $stmt->get_result();
    if ($resultado->num_rows > 0) {
        echo '<div class="alert alert-danger" role="alert">Ya existe un usuario con el mismo DNI.</div>';
        $error = true;
    }
    $stmt->close();

    // Verificar si ya existe un usuario con el mismo número de teléfono
    $stmt = $mysqli->prepare("SELECT * FROM usuarios WHERE telefono = ?");
    $stmt->bind_param("s", $telefono);
    $stmt->execute();
    $resultado = $stmt->get_result();
    if ($resultado->num_rows > 0) {
        echo '<div class="alert alert-danger" role="alert">Ya existe un usuario con el mismo número de teléfono.</div>';
        $error = true;
    }
    $stmt->close();

    // Si no se encontraron errores, proceder con el insert
    if (!$error) {
        $stmt = $mysqli->prepare("INSERT INTO usuarios (id_usuario, nombre, apellido, nickname, dni, direccion, pais, ciudad, cod_postal, fecha_nac, genero, correo, telefono, saldo, estado, rol_usuario) 
                                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, '100', 'A', 'usuario')");
        $stmt->bind_param("sssssssssssss", $id_usuario, $nombre, $apellido, $usuario, $dni, $direccion, $pais, $ciudad, $cod_postal, $fecha_nac, $genero, $email, $telefono);
        $resultado = $stmt->execute();

        if ($resultado) {
            // Hash de la contraseña
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Insertar la contraseña en la tabla passwords
            $stmt = $mysqli->prepare("INSERT INTO passwords (id_usuario, contrasena) VALUES (?, ?)");
            $stmt->bind_param("ss", $id_usuario, $hashed_password);
            $resultado = $stmt->execute();

            if ($resultado) {
                echo '<div class="alert alert-success" role="alert">Se ha registrado con éxito.</div>';
                echo "<div class='d-flex justify-content-center'>";
                echo "<p><a href='index.php'><button type='button' class='btn btn-primary'>Volver</button></a></p>";
                echo "</div>";
            } else {
                echo '<div class="alert alert-danger" role="alert">Ha habido un error al insertar la contraseña en la tabla passwords.</div>';
                echo "<div class='d-flex justify-content-center'>";
                echo "<p><a href='register.php'><button type='button' class='btn btn-primary'>Volver</button></a></p>";
                echo "</div>";
            }
            $stmt->close();
        } else {
            echo '<div class="alert alert-danger" role="alert">Ha habido un error al registrar el usuario.</div>';
            echo "<div class='d-flex justify-content-center'>";
            echo "<p><a href='register.php'><button type='button' class='btn btn-primary'>Volver</button></a></p>";
            echo "</div>";
        }
    } else {
        echo '<div class="alert alert-danger" role="alert">Las contraseñas no coinciden.</div>';
        echo "<div class='d-flex justify-content-center'>";
        echo "<p><a href='register.php'><button type='button' class='btn btn-primary'>Volver</button></a></p>";
        echo "</div>";
    }
} else {
    echo "<div class='d-flex justify-content-center'>";
    echo "<p><a href='register.php'><button type='button' class='btn btn-primary'>Volver</button></a></p>";
    echo "</div>";
}
?>
    </div>
</body>

</html>