<?php
require 'conexion.php';
// Iniciar sesión si no está iniciada
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Casino LA CAMPIÑA</title>
    <script src="script.js"></script>
    <link rel="stylesheet" href="Miestilos.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/bootstrap.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<body class="container" style="background-color: #333333;">
    <header>
        <nav class="navbar navbar-expand-lg navbar-light text-bg-warning rounded-4 mt-3">
            <a class="navbar-brand" href="index.php">
                <img src="fotos/xdxd.png" class="mx-4">
            </a>
            <div class="display-6 text-light">
                <p class="fw-bold m-auto">LA CAMPIÑA</p>
            </div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
                <div class="">
                    <ul class="navbar-nav fw-bold">
                        <li class="nav-item">
                            <a class="nav-link active text-light" href="#">Apuestas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="#">Ruleta</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="#">Blackjack</a>
                        </li>
                    </ul>
                </div>
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <?php
                        // Verificar si hay una sesión iniciada
                        if (isset($_SESSION['id_usuario'])) {
                            // Recuperar el ID de usuario de la sesión
                            $id_usuario = $_SESSION['id_usuario'];

                            // Consultar la información del usuario y su saldo desde la base de datos
                            $sql = "SELECT nickname, saldo FROM usuarios WHERE id_usuario = '$id_usuario'";
                            $resultado = $mysqli->query($sql);
                            if ($resultado) {
                                // Verificar si se encontraron resultados
                                if ($resultado) {
                                    // Verificar si se encontraron resultados
                                    if ($resultado->num_rows > 0) {
                                        $row = $resultado->fetch_assoc();
                                        $nickname = $row['nickname'];
                                        $saldo = $row['saldo'];
                                        // Mostrar el nombre de usuario y su saldo con iconos
                                        echo "<li class='nav-item dropdown'>";
                                        echo "<a class='nav-link dropdown-toggle text-light' href='#' id='navbarDropdown' role='button' data-bs-toggle='dropdown' aria-expanded='false'>$saldo &euro; <i class='fas fa-user'></i> $nickname</a>";
                                        echo "<ul class='dropdown-menu' aria-labelledby='navbarDropdown'>";
                                        echo "<li><a class='dropdown-item' href='cerrar_sesion.php'>Cerrar Sesión</a></li>";
                                        echo "</ul>";
                                        echo "</li>";
                                    }
                                }
                            }

                            // Cerrar la conexión a la base de datos
                            $mysqli->close();
                        } else {
                            // Si no hay sesión iniciada, mostrar los botones de Login y Register
                            echo '<div class="border">';
                            echo '<a href="login.php"><button type="button" class="btn btn-light m-2 fw-bold text-warning">Entrar</button></a>';
                            echo '<a href="register.php"><button type="button" class="btn btn-light m-2 fw-bold text-warning">Registrarse</button></a>';
                            echo '</div>';
                        }
                        ?>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <div class="container mt-5">
        <h1 class="text-center mb-4">Contacto</h1>
        <div class="row">
            <div class="col-md-6">
                <h2>Ubicación</h2>
                <p>
                    <strong>Casino La Campiña</strong><br>
                    C. Las Hermandades, 1<br>
                    21750 El Rocío, Huelva<br>
                    España
                </p>
                <h2>Teléfono</h2>
                <p>+34 954 844 223</p>
                <h2>Correo Electrónico</h2>
                <p>info@lacampina.com</p>
            </div>
            <div class="col-md-6">
                <h2>Envíanos un mensaje</h2>
                <form>
                    <div class="form-group">
                        <label for="nombre">Nombre:</label>
                        <input type="text" class="form-control" id="nombre" placeholder="Tu nombre">
                    </div>
                    <div class="form-group">
                        <label for="correo">Correo Electrónico:</label>
                        <input type="email" class="form-control" id="correo" placeholder="Tu correo electrónico">
                    </div>
                    <div class="form-group">
                        <label for="mensaje">Mensaje:</label>
                        <textarea class="form-control" id="mensaje" rows="5" placeholder="Escribe tu mensaje"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Enviar mensaje</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="text-white text-center text-lg-start text-bg-warning rounded-4">
        <div class="container p-4">
            <div class="row mt-4">
                <div class="col-lg-4 col-md-12 mb-4 mb-md-0">
                    <h5 class="text-uppercase mb-4">Sobre nosotros</h5>
                    <p>La campiña está autorizado por la Dirección General de Ordenación del Juego
                    </p>
                    <p>
                        La campiña es una de las principales casas españolas en apuestas online y juegos de Casino.
                        Diviértete con nosotros y disfruta de una experiencia de juego segura.
                    </p>
                    <div class="mt-4">
                        <!-- Telegram -->
                        <a type="button" class="btn btn-floating btn-light btn-lg"><img src="bootstrap-icons/icons/telegram.svg"></a>
                        <!-- Wasap -->
                        <a type="button" class="btn btn-floating btn-light btn-lg"><img src="bootstrap-icons/icons/whatsapp.svg"></a>
                        <!-- Twitter -->
                        <a type="button" class="btn btn-floating btn-light btn-lg"><img src="bootstrap-icons/icons/twitter.svg"></a>
                        <!-- Facebook -->
                        <a type="button" class="btn btn-floating btn-light btn-lg"><img src="bootstrap-icons/icons/facebook.svg"></a>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 mb-4 mb-md-0">
                    <h5 class="text-uppercase mb-4 pb-1">Buscador</h5>
                    <!--Barra de buscar-->
                    <div class="form-outline form-white mb-4">
                        <input type="text" id="formControlLg" class="form-control form-control-lg" />
                        <button class="btn btn-light mt-3">Search</button>
                    </div>
                    <ul class="fa-ul" style="margin-left: 1.65em;">
                        <li class="mb-3">
                            <span class="fa-li"><i class="fas fa-home"></i></span><span class="ms-2">C. las Hermandades, 1, 21750 El
                                Rocío, Huelva</span>
                        </li>
                        <li class="mb-3">
                            <span class="fa-li"><i class="fas fa-envelope"></i></span><span class="ms-2">clientes@lacampina.es</span>
                        </li>
                        <li class="mb-3">
                            <span class="fa-li"><i class="fas fa-phone"></i></span><span class="ms-2">954 844 223</span>
                        </li>
                    </ul>
                </div>

                <div class="col-md-2 col-lg-4 col-xl-2 mx-auto">
                    <!-- Ayuda -->
                    <h5 class="text-uppercase mb-4 pb-1">
                        Ayuda
                    </h5>
                    <p>
                        <a href="#!" class="text-reset">Preguntas frecuentes</a>
                    </p>
                    <p>
                        <a href="#!" class="text-reset">Pagos</a>
                    </p>
                    <p>
                        <a href="#!" class="text-reset">Juego Responsable</a>
                    </p>
                    <p>
                        <a href="#!" class="text-reset">Legal</a>
                    </p>
                    <p>
                        <a href="contacto.php" class="text-reset">Contáctanos</a>
                    </p>
                </div>
            </div>
        </div>

        <!-- Copyright -->
        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
            © 2024 Copyright:
            <a class="text-white text-decoration-none" href="index.php">Lacampina.es</a>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>