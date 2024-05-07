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
              <a class="nav-link text-light" href="#">Ruleta</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-light" href="#">Blackjack</a>
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
                                      <li><a class="dropdown-item" href="#">Monedero</a></li>
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



  <main class="mt-5">
    <!-- Tarjetas -->
    <div class="row row-cols">
      <div class="d-flex col">
        <div class="card text-white">
          <div>
            <img src="fotos/card1.png" class="card-img" alt="...">
          </div>
          <div class="card-img-overlay">
            <h1 class="card-title fw-bold text-light mt-4 mx-3">Más de</h1>
            <p class="card-text h2 fw-bold text-muted mx-3">60 mesas</p>
            <p class="card-text h4 fw-bold text-light mx-3">Ruletas, Blackjack...</p>
          </div>
        </div>
      </div>

      <div class="col">
        <div class="card text-white">
          <img src="fotos/card2.png" class="card-img" alt="...">
          <div class="card-img-overlay">
            <h5 class="card-title h4 text-light fw-bold mt-4 mb-lg-3 mx-3">Increíbles cuotas en</h5>
            <p class="card-text h1 fw-bold text-muted mx-3">FÚTBOL</p>
            <p class="card-text h5 text-light fw-bold mx-3 mt-3">Si te haces cliente</p>
          </div>
        </div>
      </div>

      <div class="col">
        <div class="card text-white">
          <img src="fotos/card3.png" class="card-img" alt="...">
          <div class="card-img-overlay">
            <h5 class="card-title h4 fw-bold mt-4 mx-3">Toda la previa de</h5>
            <p class="card-text h1 fw-bold mx-3 text-muted">ROLAND GARROS</p>
            <p class="card-text h4 fw-bold mx-3">En streaming</p>
          </div>
        </div>
      </div>
    </div>

    <!-- Tarjetas de servicios -->
    <div class="">
      <div class="row row-cols-md-4 row-cols-sm-6 p-5">
        <div class="col p-4">
          <a href="#" class="text-decoration-none">
            <div class="bg-light rounded-4">
              <div class="d-flex justify-content-center">
                <img src="fotos/cardapuestas.png" alt="..." width="100%">
              </div>
              <div class="card-body">
                <div class="d-flex justify-content-center">
                  <img src="fotos/football-outline-circle.svg" alt="" width="50%">
                </div>
                <div class="fw-bold h5 justify-content-center d-flex text-dark font-italic">
                  <p>APUESTAS</p>
                </div>
              </div>
            </div>
          </a>
        </div>

        <div class="col p-4">
          <a href="#" class="text-decoration-none">
            <div class="bg-light rounded-4">
              <div class="d-flex justify-content-center">
                <img src="fotos/cardcasino.png" alt="..." width="100%">
              </div>
              <div class="card-body">
                <div class="d-flex justify-content-center">
                  <img src="fotos/card3_files/roulette-outline-circle.svg" alt="" width="50%">
                </div>
                <div class="fw-bold h5 justify-content-center d-flex text-dark font-italic">
                  <p>CASINO</p>
                </div>
              </div>
            </div>
          </a>
        </div>

        <div class="col p-4">
          <a href="#" class="text-decoration-none">
            <div class="bg-light rounded-4">
              <div class="d-flex justify-content-center">
                <img src="fotos/cardslots.png" alt="..." width="100%">
              </div>
              <div class="card-body">
                <div class="d-flex justify-content-center">
                  <img src="fotos/slot-outline-circle.svg" alt="" width="50%">
                </div>
                <div class="fw-bold h5 justify-content-center d-flex text-dark font-italic">
                  <p>BLACKJACK</p>
                </div>
              </div>
            </div>
          </a>
        </div>

        <div class="col p-4">
          <a href="#" class="text-decoration-none">
            <div class="bg-light rounded-4">
              <div class="d-flex justify-content-center">
                <img src="fotos/cardblog.png" alt="..." width="100%">
              </div>
              <div class="card-body">
                <div class="d-flex justify-content-center">
                  <img src="fotos/Blog-icon.svg" alt="" width="50%">
                </div>
                <div class="fw-bold h5 justify-content-center d-flex text-dark font-italic">
                  <p>BLOG</p>
                </div>
              </div>
            </div>
          </a>
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