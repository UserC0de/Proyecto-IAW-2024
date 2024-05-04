<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="script.js"></script>
    <link rel="stylesheet" href="css/bootstrap.css">
</head>

<body class="container vh-100 d-flex align-items-center justify-content-center" style="background-image: url('fotos/casino.jpeg'); background-size: cover; background-position: center">
    <div class="row bg-dark p-5 rounded-4">
        <?php
        // Recuperar el nombre de usuario y la contraseña del formulario
        $usuario = $_POST["usuario"];
        $password = $_POST["password"];

        // Conectar a la base de datos
        require 'conexion.php';

        // Consultar la contraseña correspondiente al nombre de usuario ingresado en la tabla passwords
        $sql = "SELECT u.id_usuario, p.contrasena, u.estado, u.rol_usuario FROM usuarios u, passwords p WHERE u.id_usuario=p.id_usuario AND u.nickname LIKE '$usuario'";
        $resultado = $mysqli->query($sql);

        if ($resultado) {
            // Verificar si se encontró una contraseña para el usuario ingresado
            if ($resultado->num_rows > 0) {
                $row = $resultado->fetch_assoc();
                $id_usuario = $row['id_usuario'];
                $contrasena_hash = $row['contrasena'];
                $estado = $row['estado'];
                $rol_usuario = $row['rol_usuario'];

                // Verificar si la contraseña ingresada coincide con la contraseña almacenada en la base de datos
                if (password_verify($password, $contrasena_hash)) {
                    // Iniciar sesión y redirigir al usuario a la página de inicio
                    session_start();
                    $_SESSION['id_usuario'] = $id_usuario;
                    $_SESSION['estado'] = $estado;
                    $_SESSION['rol'] = $rol_usuario;

                    if ($estado === "A") {
                        header("location: index.php");
                        exit();
                    } else {
                        header("location: usuario_bloq.php");
                        exit();
                    }

                    } else {
                        // Contraseña incorrecta
                        echo '<div class="alert alert-danger" role="alert">Contraseña incorrecta.</div>';
                        echo "<div class='d-flex justify-content-center'>";
                        echo "<p><a href='login.php'><button type='button' class='btn btn-primary'>Volver</button></a></p>";
                        echo "</div>";
                    }
                } else {
                    // Usuario no encontrado
                    echo '<div class="alert alert-danger" role="alert">El nombre de usuario ingresado no existe.</div>';
                    echo "<div class='d-flex justify-content-center'>";
                    echo "<p><a href='login.php'><button type='button' class='btn btn-primary'>Volver</button></a></p>";
                    echo "</div>";
                }
            } else {
                // Error en la consulta SQL
                echo '<div class="alert alert-danger" role="alert">Error al intentar iniciar sesión. Por favor, inténtalo de nuevo más tarde.</div>';
                echo "<div class='d-flex justify-content-center'>";
                echo "<p><a href='login.php'><button type='button' class='btn btn-primary'>Volver</button></a></p>";
                echo "</div>";
            }
        // Cerrar la conexión a la base de datos
        $mysqli->close();
        ?>

</body>
</div>

</html>