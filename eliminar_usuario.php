<?php
require 'conexion.php'; // Incluir el archivo de conexiónP
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
// Verificar si se recibió el id_usuario a través de GET
if(isset($_GET['id_usuario'])) {
    // Obtener el id_usuario de la solicitud GET
    $id_usuario = $_GET['id_usuario'];
    
    // Iniciar una transacción para garantizar que todas las operaciones se completen con éxito o ninguna
    $mysqli->begin_transaction();
    
    // Eliminar la contraseña del usuario de la tabla Passwords
    $sql_eliminar_password = "DELETE FROM passwords WHERE id_usuario = '$id_usuario'";
    if($mysqli->query($sql_eliminar_password)) {
        // Si se elimina la contraseña correctamente, eliminar todas las apuestas asociadas a ese usuario
        $sql_eliminar_apuestas = "DELETE FROM apuestas WHERE id_usuario = '$id_usuario'";
        if($mysqli->query($sql_eliminar_apuestas)) {
            // Si se eliminan las apuestas correctamente, eliminar al usuario
            $sql_eliminar_usuario = "DELETE FROM usuarios WHERE id_usuario = '$id_usuario'";
            if($mysqli->query($sql_eliminar_usuario)) {
                // Si se elimina el usuario correctamente, confirmar la transacción y redireccionar a la página principal
                $mysqli->commit();
                header("Location: gestion_usuarios.php");
                exit();
            } else {
                // Si ocurre un error al eliminar al usuario, hacer rollback de la transacción y mostrar un mensaje de error
                $mysqli->rollback();
                header("Location: gestion_usuarios.php");
            }
        } else {
            // Si ocurre un error al eliminar las apuestas, hacer rollback de la transacción y mostrar un mensaje de error
            $mysqli->rollback();
            header("Location: gestion_usuarios.php");
        }
    } else {
        // Si ocurre un error al eliminar la contraseña, hacer rollback de la transacción y mostrar un mensaje de error
        $mysqli->rollback();
        header("Location: gestion_usuarios.php");
    }
} else {
    // Si no se recibió el id_usuario a través de GET, redireccionar a la página principal
    header("Location: index.php");
    exit();
}
?>

</body>
</html>