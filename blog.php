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

<body class="container pt-3" style="background-color: #333333;">
    <header>
        <nav class="navbar navbar-expand-lg navbar-light text-bg-warning rounded-4">
            <a class="navbar-brand" href="index.php">
                <img src="fotos/xdxd.png" class="mx-3">
            </a>
            <div class="display-5 text-light">
                <h1 class="fw-bold m-auto ms-3">LA CAMPIÑA</h1>
            </div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
                <div class="mx-5">
                    <ul class="navbar-nav nav-tabs fw-bold">
                        <li class="nav-item">
                            <a class="nav-link text-light" href="apuestas.php">Apuestas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="ruleta.php">Ruleta</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="blog.php">Blog</a>
                        </li>
                    </ul>
                </div>
                <?php
                // Verificar si hay una sesión iniciada
                if (isset($_SESSION['id_usuario'])) {
                    // Recuperar el ID de usuario de la sesión
                    $id_usuario = $_SESSION['id_usuario'];

                    // Consultar la información del usuario y su saldo desde la base de datos
                    $sql = "SELECT nickname, saldo, estado, rol_usuario FROM usuarios WHERE id_usuario = '$id_usuario'";
                    $resultado = $mysqli->query($sql);

                    if ($resultado) {
                        // Verificar si se encontraron resultados
                        if ($resultado->num_rows > 0) {
                            $row = $resultado->fetch_assoc();
                            $nickname = $row['nickname'];
                            $saldo = $row['saldo'];
                            $estado = $row['estado'];
                            $rol_usuario = $row['rol_usuario'];

                            if ($estado === "A") {
                                if ($rol_usuario === "admin") {
                                    // Mostrar el nombre de usuario y su saldo con iconos
                                    echo '<div class="mx-3">';
                                    echo "<div class='nav-item dropdown'>";
                                    echo "<a class='nav-link text-light' href='#'>Saldo: $saldo €</a> <a class='nav-link dropdown-toggle text-light' href='#' role='button' data-bs-toggle='dropdown' aria-expanded='false'>$nickname <i class='fas fa-user'></i></a>";
                                    echo '<ul class="dropdown-menu">
                      <li><a class="dropdown-item" href="perfil_usuario.php">Perfil</a></li>
                      <li><a class="dropdown-item" href="gestion_usuarios.php">Gestión de Usuarios</a></li>
                      <li><a class="dropdown-item" href="gestion_partidos.php">Gestión de Partidos</a></li>
                      <li><a class="dropdown-item" href="mis_apuestas.php">Mis Apuestas</a></li>
                      <li><a class="dropdown-item" href="#">Soporte</a></li>
                      <li><hr class="dropdown-divider"></li>
                      <li><a class="dropdown-item" href="cerrar_sesion.php">Cerrar sesión</a></li>
                    </ul>
                  </div>';
                                } else {
                                    echo '</div>';
                                    echo '<div class="mx-3">';
                                    echo "<div class='nav-item dropdown'>";
                                    echo "<a class='nav-link text-light' href='#'>Saldo: $saldo €</a> <a class='nav-link dropdown-toggle text-light' href='#' role='button' data-bs-toggle='dropdown' aria-expanded='false'>$nickname <i class='fas fa-user'></i></a>";
                                    echo '<ul class="dropdown-menu">
                                      <li><a class="dropdown-item" href="perfil_usuario.php">Perfil</a></li>
                                      <li><a class="dropdown-item" href="mis_apuestas.php">Mis Apuestas</a></li>
                                      <li><a class="dropdown-item" href="#">Soporte</a></li>
                                      <li><hr class="dropdown-divider"></li>
                                      <li><a class="dropdown-item" href="cerrar_sesion.php">Cerrar sesión</a></li>
                                    </ul>
                                  </div>';
                                }
                            } else {
                                header("location: usuario_bloq.php");
                            }
                        }
                    }
                    // Cerrar la conexión a la base de datos
                    $mysqli->close();
                } else {
                    // Si no hay sesión iniciada, mostrar los botones de Login y Register
                    echo '<div class="m-2">';
                    echo '<a href="login.php"><button type="button" class="btn btn-light m-2 fw-bold text-warning">Entrar</button></a>';
                    echo '<a href="register.php"><button type="button" class="btn btn-light m-2 fw-bold text-warning">Registrarse</button></a>';
                    echo '</div>';
                }
                ?>
            </div>
        </nav>
    </header>



    <main class="m-5">
        <div class="d-flex justify-content-center">
            <p class="h1 fw-bold p-4 text-white">BLOG</p>
        </div>
        <!-- Blog Posts -->
        <div class="container bg-white rounded-4 p-3">
            <div class="row">
                <div class="col-md-8">


                    <!-- Blog Post 1 -->
                    <div class="border border-3 border-dark rounded-4 mb-4">
                        <div class="blog-post m-4">
                            <h2 class="mb-3">Los Secretos del Éxito en el Casino de Tenis</h2>
                            <p class="text-muted">Fecha: 10 de marzo de 2024</p>
                            <img src="https://via.placeholder.com/800x400" alt="Imagen del Post 1" class="mb-3">
                            <p>Descubre los secretos detrás del éxito en el casino de tenis. Desde estrategias de apuestas hasta consejos para mejorar tu juego, este post te revelará todo lo que necesitas saber.</p>
                            <a href="#" class="btn btn-primary">Leer Más</a>
                        </div>
                    </div>


                    <!-- Blog Post 2 -->
                    <div class="border border-3 border-dark rounded-4 mb-4">
                        <div class="blog-post m-4">
                            <h2 class="mb-3">Las Leyendas del Casino de Tenis</h2>
                            <p class="text-muted">Fecha: 05 de febrero de 2025</p>
                            <img src="https://via.placeholder.com/800x400" alt="Imagen del Post 2" class="mb-3">
                            <p>Explora las historias y hazañas de las leyendas que han dejado su huella en el mundo del tenis y el casino. Desde jugadores icónicos hasta momentos inolvidables, este post te llevará en un viaje emocionante a través del tiempo.</p>
                            <a href="#" class="btn btn-primary">Leer Más</a>
                        </div>
                    </div>


                    <!-- Blog Post 3 -->
                    <div class="border border-3 border-dark rounded-4 mb-4">
                        <div class="blog-post m-4">
                            <h2 class="mb-3">Los Mejores Consejos para Ganar en el Casino de Tenis</h2>
                            <p class="text-muted">Fecha: 15 de marzo de 2025</p>
                            <img src="https://via.placeholder.com/800x400" alt="Imagen del Post 3" class="mb-3">
                            <p>Descubre los mejores consejos y estrategias para aumentar tus posibilidades de ganar en el emocionante mundo del casino de tenis. Desde gestionar tu bankroll hasta aprovechar las oportunidades de apuestas, este post te ayudará a mejorar tu juego.</p>
                            <a href="#" class="btn btn-primary">Leer Más</a>
                        </div>
                    </div>


                    <!-- Blog Post 4 -->
                    <div class="border border-3 border-dark rounded-4 mb-4">
                        <div class="blog-post m-4">
                            <h2 class="mb-3">Historia del Casino de Tenis: Orígenes y Evolución</h2>
                            <p class="text-muted">Fecha: 20 de abril de 2025</p>
                            <img src="https://via.placeholder.com/800x400" alt="Imagen del Post 4" class="mb-3">
                            <p>Sumérgete en la fascinante historia del casino de tenis, desde sus humildes comienzos hasta su evolución como uno de los destinos de entretenimiento más populares del mundo. Este post te llevará en un viaje a través del tiempo para descubrir los momentos más destacados de esta increíble historia.</p>
                            <a href="#" class="btn btn-primary">Leer Más</a>
                        </div>
                    </div>


                    <!-- Blog Post 5 -->
                    <div class="border border-3 border-dark rounded-4 mb-4">
                        <div class="blog-post m-4">
                            <h2 class="mb-3">Los Secretos de los Grandes Apostadores del Casino de Tenis</h2>
                            <p class="text-muted">Fecha: 05 de mayo de 2025</p>
                            <img src="https://via.placeholder.com/800x400" alt="Imagen del Post 5" class="mb-3">
                            <p>Explora los secretos detrás de los grandes apostadores que han dejado una marca indeleble en el mundo del casino de tenis. Desde estrategias de apuestas hasta anécdotas increíbles, este post te llevará detrás de escena para descubrir lo que se necesita para triunfar en el mundo del juego.</p>
                            <a href="#" class="btn btn-primary">Leer Más</a>
                        </div>
                    </div>


                    <!-- Blog Post 6 -->
                    <div class="border border-3 border-dark rounded-4 mb-4">
                        <div class="blog-post m-4">
                            <h2 class="mb-3">El Futuro del Casino de Tenis: Tendencias y Predicciones</h2>
                            <p class="text-muted">Fecha: 10 de junio de 2025</p>
                            <img src="https://via.placeholder.com/800x400" alt="Imagen del Post 6" class="mb-3">
                            <p>Descubre las tendencias emergentes y las predicciones para el futuro del casino de tenis en este emocionante post. Desde la integración de la tecnología hasta la evolución de las experiencias de juego, este post te llevará en un viaje para explorar lo que nos espera en el mundo del entretenimiento y las apuestas.</p>
                            <a href="#" class="btn btn-primary">Leer Más</a>
                        </div>
                    </div>


                </div>
                <div class="col-md-4">
                    <!-- Sidebar Widgets -->
                    <div class="border border-3 border-dark rounded-4 mb-4 vh-100">
                        <div class="m-4">
                            <h3>Últimos Posts</h3>
                            <ul class="list-unstyled">
                                <li><a href="#">Los Secretos del Éxito en el Casino de Tenis</a></li>
                                <li><a href="#">Las Leyendas del Casino de Tenis</a></li>
                                <li><a href="#">Los Mejores Consejos para Ganar en el Casino de Tenis</a></li>
                                <li><a href="#">Historia del Casino de Tenis: Orígenes y Evolución</a></li>
                                <li><a href="#">Los Secretos de los Grandes Apostadores del Casino de Tenis</a></li>
                                <li><a href="#">El Futuro del Casino de Tenis: Tendencias y Predicciones</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        </div>
    </main>

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
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>

</html>