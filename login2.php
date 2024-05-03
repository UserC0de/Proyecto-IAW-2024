<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="script.js"></script>
    <link rel="stylesheet" href="css/bootstrap.css">
</head>

<body>
    <?php
    // Verificar si se envió el formulario
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Recuperar el nombre de usuario y la contraseña del formulario
        $usuario = $_POST["usuario"];
        $password = $_POST["password"];

        // Conectar a la base de datos
        require 'conexion.php';

        // Consultar la contraseña correspondiente al nombre de usuario ingresado en la tabla passwords
        $sql = "SELECT id_usuario, contrasena FROM passwords WHERE id_usuario IN (SELECT id_usuario FROM usuarios WHERE nickname = '$usuario')";
        $resultado = $mysqli->query($sql);

        if ($resultado) {
            // Verificar si se encontró una contraseña para el usuario ingresado
            if ($resultado->num_rows > 0) {
                $row = $resultado->fetch_assoc();
                $id_usuario = $row['id_usuario'];
                $contrasena_hash = $row['contrasena'];

                // Verificar si la contraseña ingresada coincide con la contraseña almacenada en la base de datos
                if (password_verify($password, $contrasena_hash)) {
                    // Iniciar sesión y redirigir al usuario a la página de inicio
                    session_start();
                    $_SESSION['id_usuario'] = $id_usuario;
                    header("location: index.php");
                    exit();
                } else {
                    // Contraseña incorrecta
                    echo '<div class="alert alert-danger" role="alert">Contraseña incorrecta.</div>';
                }
            } else {
                // Usuario no encontrado
                echo '<div class="alert alert-danger" role="alert">El nombre de usuario ingresado no existe.</div>';
            }
        } else {
            // Error en la consulta SQL
            echo '<div class="alert alert-danger" role="alert">Error al intentar iniciar sesión. Por favor, inténtalo de nuevo más tarde.</div>';
        }

        // Cerrar la conexión a la base de datos
        $mysqli->close();
    }
    ?>

</body>

</html>