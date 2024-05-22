<?php
require 'conexion.php'; // Incluir el archivo de conexión
// Verificar si se ha iniciado sesión y si el usuario tiene el rol de administrador
session_start();
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
    // Si no tiene el rol de administrador, redirigir a algún lugar o mostrar un mensaje de error
    header("Location: https://www.youtube.com/watch?v=xvFZjo5PgG0&ab_channel=Duran");
    exit();
}
// Verificar si se han enviado datos mediante POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $id_usuario = $_POST['id_usuario'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $nickname = $_POST['usuario'];
    $dni = $_POST['dni'];
    $rol_usuario = $_POST['rol_usuario'];
    $estado = $_POST['estado'];
    $saldo = $_POST['saldo'];

    // Evitar inyección SQL utilizando consultas preparadas
    $sql = "UPDATE usuarios SET nombre=?, apellido=?, nickname=?, dni=?, rol_usuario=?, estado=?, saldo=? WHERE id_usuario=?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("ssssssdi", $nombre, $apellido, $nickname, $dni, $rol_usuario, $estado, $saldo, $id_usuario);
    
    // Ejecutar la consulta preparada
    if ($stmt->execute()) {
        // Redireccionar a la página de gestión de usuarios
        header("Location: gestion_usuarios.php");
        exit();
    } else {
        // Mostrar un mensaje de error en caso de fallo en la ejecución de la consulta
        echo "Error al actualizar los datos: " . $mysqli->error;
    }

    // Cerrar la consulta preparada
    $stmt->close();
} else {
    // Si no se enviaron datos mediante POST, redirigir a alguna página apropiada
    header("Location: index.php");
    exit();
}
?>
