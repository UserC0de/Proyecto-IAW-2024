<?php
// Iniciar sesión si no está iniciada
session_start();

// Destruir todas las variables de sesión
$_SESSION = array();

// Borrar la cookie de sesión si existe
if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time()-42000, '/');
}

// Destruir la sesión
session_destroy();

// Redirigir al usuario al index o a donde desees
header("Location: index.php");
exit;
?>
