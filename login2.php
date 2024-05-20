<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Definir la codificación de caracteres como UTF-8 -->
    <meta charset="UTF-8">
    <!-- Definir la viewport para que la página se ajuste al tamaño de la pantalla -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Título de la página -->
    <title>Login</title>
    <!-- Enlazar archivo JavaScript externo -->
    <script src="script.js"></script>
    <!-- Enlazar hoja de estilos CSS externa -->
    <link rel="stylesheet" href="css/bootstrap.css">
</head>

<body class="container vh-100 d-flex align-items-center justify-content-center" style="background-image: url('fotos/casino.jpeg'); background-size: cover; background-position: center">
    <!-- Contenedor principal de la página -->
    <div class="row bg-dark p-5 rounded-4">
        <?php
        // Recuperar el nombre de usuario y la contraseña del formulario
        $usuario = $_POST["usuario"];
        $password = $_POST["password"];

        // Conectar a la base de datos
        require 'conexion.php';

        // Consultar la contraseña correspondiente al nombre de usuario ingresado en la tabla passwords
        $sql = "SELECT u.id_usuario, p.contrasena, u.estado, u.rol_usuario FROM usuarios u, passwords p WHERE u.id_usuario=p.id_usuario AND u.nickname LIKE?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("s", $usuario);
        $stmt->execute();
        $resultado = $stmt->get_result();

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
                    // Iniciar sesión
                    session_start();
                    $_SESSION['id_usuario'] = $id_usuario;
                    $_SESSION['estado'] = $estado;
                    $_SESSION['rol'] = $rol_usuario;

                    if ($estado === "A") {
                        // Redirigir al usuario a la página de inicio si su estado es "A"
                        header("location: index.php");
                        exit();
                    } else {
                        // Redirigir al usuario a la página de usuario bloqueado si su estado no es "A"
                        header("location: usuario_bloq.php");
                        exit();
                    }
                } else {
                    // Mostrar mensaje de error si la contraseña es incorrecta
                    echo '<div class="alert alert-danger" role="alert">Contraseña incorrecta.</div>';
                    echo "<div class='d-flex justify-content-center'>";
                    echo "<p><a href='login.php'><button type='button' class='btn btn-primary'>Volver</button></a></p>";
                }
                    echo "</div>";
            } else {
                // Mostrar mensaje de error si no se encontró el usuario
                echo '<div class="alert alert-danger" role="alert">El nombre de usuario ingresado no existe.</div>';
                echo "<div class='d-flex justify-content-center'>";
                echo "<p><a href='login.php'><button type='button' class='btn btn-primary'>Volver</button></a></p>";
                echo "</div>";
            }   
        } else {
            // Mostrar mensaje de error si hubo un error en la consulta SQL
            echo '<div class="alert alert-danger" role="alert">Error al intentar iniciar sesión. Por favor, inténtalo de nuevo más tarde.</div>';
            echo "<div class='d-flex justify-content-center'>";
            echo "<p><a href='login.php'><button type='button' class='btn btn-primary'>Volver</button></a></p>";
            echo "</div>";
        }
        // Cerrar la conexión a la base de datos
        $mysqli->close();
        ?>

    </div>

</body>

</html>