<?php
// Requerir el archivo de conexión para establecer una conexión con la base de datos
require 'conexion.php';

// Iniciar la sesión si no está iniciada
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

<body class="container pt-3 border border-4 rounded-4" style="background-color: #333333;">
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



  <main class="mt-5">
    <!-- Tarjetas -->
    <div class="row row-cols-md-3 mb-5">
      <a href="ruleta.php" class="text-decoration-none">
        <div class="col p-4">
          <div class="card text-white">
            <img src="fotos/card_casino.png" class="card-img" alt="..." width="100%">
          </div>
        </div>
      </a>

      <a href="apuestas.php" class="text-decoration-none">
        <div class="col p-4">
          <div class="card text-white">
            <img src="fotos/card_tenis.png" class="card-img" alt="..." width="100%">
          </div>
        </div>
      </a>

      <a href="apuestas.php" class="text-decoration-none">
        <div class="col p-4">
          <div class="card text-white">
            <img src="fotos/card_tenis2.png" class="card-img" alt="..." width="100%">
          </div>
        </div>
      </a>
    </div>

    <!-- Tarjetas de servicios -->
    <div class="d-flex justify-content-center">
      <div class="row row-cols-md-3 row-cols-sm-6 p-5 border border-5 rounded-5 justify-content-center mb-5">
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
                  <p>RULETA</p>
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
  <footer class="text-white text-center text-lg-start text-bg-warning rounded-4 m-4">
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
            <a href="https://web.telegram.org" type="button" class="btn btn-floating btn-light btn-lg"><img src="bootstrap-icons/icons/telegram.svg"></a>
            <!-- Wasap -->
            <a href="https://web.whatsapp.com/" type="button" class="btn btn-floating btn-light btn-lg"><img src="bootstrap-icons/icons/whatsapp.svg"></a>
            <!-- Twitter -->
            <a href="https://x.com/luckia_es" type="button" class="btn btn-floating btn-light btn-lg"><img src="bootstrap-icons/icons/twitter.svg"></a>
            <!-- Facebook -->
            <a href="https://www.facebook.com/CasinoLuckia/" type="button" class="btn btn-floating btn-light btn-lg"><img src="bootstrap-icons/icons/facebook.svg"></a>
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
            <a href="blog.php" class="text-reset">BLOG</a>
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