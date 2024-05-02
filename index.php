<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Casino LA CAMPIÑA</title>
  <script src="script.js"></script>
  <link rel="stylesheet" href="Miestilos.css">
  <link rel="stylesheet" href="css/bootstrap.css">
</head>

<body class="container">
    <header>
      <div class="p-2 container">
        <nav class="navbar navbar-expand text-bg-warning fw-bold rounded-4 border">
          <div class="container-fluid text-uppercase">
            <a class="navbar-brand" href="index.html">
              <img src="fotos/xdxd.png" alt="" class="px-3">
            </a>
            <div class="display-5 text-light">
              <h1 class="fw-bold m-auto ms-3">LA CAMPIÑA</h1>
            </div>
            <ul class="navbar-nav fw-bold">
              <li class="nav-item">
                <a class="nav-link active text-light" aria-current="page" href="#">Apuestas</a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-light" href="#">Ruleta</a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-light" href="#">Blackjack</a>
              </li>
            </ul>
            <ul class="navbar-nav">
              <li class="nav-item m-auto">
                <a href="login.php"><button type="button" class="btn btn-light p-2 me-2 fw-bold text-warning">Entrar</button></a>
              </li>

              <li class="nav-item m-auto p-2">
                <a href="register.php"><button type="button" class="btn btn-light p-2 me-2 fw-bold text-warning">Registrarse</button></a>
              </li>
            </ul>
          </div>
        </nav>
      </div>
  </header>

  <main class="mt-5 border">
    <!-- Tarjetas -->
    <div class="row row-cols border">
      <div class="d-flex col border">
        <div class="card text-white border-light">
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
        <div class="card text-white border-light">
          <img src="fotos/card2.png" class="card-img" alt="..." style="max-width: 600px;">
          <div class="card-img-overlay">
            <h5 class="card-title h4 text-light fw-bold mt-4 mb-lg-3 mx-3">Increíbles cuotas en</h5>
            <p class="card-text h1 fw-bold text-muted mx-3">FÚTBOL</p>
            <p class="card-text h5 text-light fw-bold mx-3 mt-3">Si te haces cliente</p>
          </div>
        </div>
      </div>

      <div class="col">
        <div class="card text-white border-light">
          <img src="fotos/card3.png" class="card-img" alt="..." style="max-width: 600px;">
          <div class="card-img-overlay">
            <h5 class="card-title h4 fw-bold mt-4 mx-3">Toda la previa de</h5>
            <p class="card-text h1 fw-bold mx-3 text-muted">ROLAND GARROS</p>
            <p class="card-text h4 fw-bold mx-3">En streaming</p>
          </div>
        </div>
      </div>
    </div>

    <!-- Tarjetas de servicios -->
    <div class="border border-5 border-dark">
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
  <footer class="text-white text-center text-lg-start bg-dark">
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
            <a type="button" class="btn btn-floating btn-light btn-lg"><img
                src="bootstrap-icons/icons/telegram.svg"></a>
            <!-- Wasap -->
            <a type="button" class="btn btn-floating btn-light btn-lg"><img
                src="bootstrap-icons/icons/whatsapp.svg"></a>
            <!-- Twitter -->
            <a type="button" class="btn btn-floating btn-light btn-lg"><img src="bootstrap-icons/icons/twitter.svg"></a>
            <!-- Facebook -->
            <a type="button" class="btn btn-floating btn-light btn-lg"><img
                src="bootstrap-icons/icons/facebook.svg"></a>
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
            <a href="#!" class="text-reset">Contáctanos</a>
          </p>
        </div>
      </div>
    </div>

    <!-- Copyright -->
    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
      © 2020 Copyright:
      <a class="text-white" href="https://mdbootstrap.com/">Lacampina.es</a>
    </div>
  </footer>

  <script src="js/bootstrap.min.js"></script>
</body>

</html>