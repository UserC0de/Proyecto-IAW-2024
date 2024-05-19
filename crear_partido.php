<?php
require 'conexion.php';
$sql2 = "select p.id_partido, p.competicion, p.jugador_visitante, p.jugador_local, p.fecha, p.hora, c.cuota_local, c.cuota_visitante from partidos p, cuotas c where p.id_partido=c.id_partido order by p.fecha";
$resultado2 = $mysqli->query($sql2);
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
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
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
                ?>
            </div>
        </nav>
    </header>

    <main>
        <div class="container">
            <div class="d-flex justify-content-center">
                <p class="h1 fw-bold p-4 text-white">CREAR PARTIDOS</p>
            </div>
            <div class="bg-light rounded-4 p-5">
                <form action="crear_partido2.php" method="POST">
                    <div class="d-flex justify-content-end">
                        <a href="gestion_partidos.php" class="btn btn-info text-light">Volver</a>
                    </div>
                    <div class="row d-flex justify-content-center">
                        <div class="col-md-3 mb-4">
                            <div class="input-group">
                                <div class="input-group-text bg-dark bg-gradient">
                                    <img src="fotos/username-icon.svg" style="height: 1rem" />
                                </div>
                                <input class="form-control  bg-light" type="text" name="jug_visitante" required />
                            </div>
                            <label class="form-label">Jugador Visitante</label>
                        </div>
                        <div class="col-md-1 mb-4">
                            <div data-mdb-input-init class="form-outline">
                                <input type="number" name="cuota_visitante" class="form-control bg-light" placeholder="1.50" required step="0.01" min="1" max="3"/>
                                <label class="form-label">Cuota</label>
                            </div>
                        </div>
                    </div>

                    <div class="row d-flex justify-content-center">
                        <div class="col-md-3 mb-4">
                            <div class="input-group">
                                <div class="input-group-text bg-dark bg-gradient">
                                    <img src="fotos/username-icon.svg" style="height: 1rem" />
                                </div>
                                <input class="form-control bg-light" type="text" name="jug_local" required/>
                            </div>
                            <label class="form-label">Jugador Local</label>
                        </div>
                        <div class="col-md-1 mb-4">
                            <div data-mdb-input-init class="form-outline">
                                <input type="number" name="cuota_local" class="form-control bg-light" placeholder="1.50" required step="0.01" min="1" max="3"/>
                                <label class="form-label">Cuota</label>
                            </div>
                        </div>
                    </div>

                    <div class="row d-flex justify-content-center">
                        <div class="col-md-2 mb-4 d-flex align-items-center">
                            <div data-mdb-input-init class="form-outline datepicker w-100">
                                <input type="date" class="form-control" name="fecha" required />
                                <label class="form-label">Fecha</label>
                            </div>
                        </div>
                        <div class="col-md-1 mb-4 pb-2">
                            <div data-mdb-input-init class="form-outline">
                                <input type="time" name="hora" class="form-control" required />
                                <label class="form-label">Hora</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="d-flex justify-content-center">
                            <select name="competencia" required>
                                <option value="Abierto de Australia">Abierto de Australia (Australian Open)</option>
                                <option value="Roland Garros">Roland Garros (Abierto de Francia, French Open)</option>
                                <option value="Wimbledon">Wimbledon (Campeonato de Wimbledon, The Championships)</option>
                                <option value="Abierto de Estados Unidos">Abierto de Estados Unidos (US Open)</option>
                                <option value="ATP Tour Finals">ATP Tour Finals</option>
                                <option value="WTA Tour Championships">WTA Tour Championships</option>
                                <option value="Masters 1000">Masters 1000</option>
                                <option value="Masters 500">Masters 500</option>
                                <option value="ATP Tour 250">ATP Tour 250</option>
                                <option value="WTA Premier Mandatory">WTA Premier Mandatory</option>
                                <option value="WTA Premier 5">WTA Premier 5</option>
                                <option value="WTA Premier">WTA Premier</option>
                                <option value="Copa Hopman">Copa Hopman</option>
                                <option value="ATP Cup">ATP Cup</option>
                                <option value="Laver Cup">Laver Cup</option>
                                <option value="Copa Davis">Copa Davis (Masculina)</option>
                                <option value="Billie Jean King Cup">Billie Jean King Cup (Femenina)</option>
                                <option value="Copa Fed">Copa Fed (Femenina)</option>
                                <option value="Copa ATP">Copa ATP (Anteriormente Copa del Mundo por Equipos)</option>
                                <option value="Copa Masters">Copa Masters (Anteriormente Copa de Maestros)</option>
                                <option value="Abierto de Madrid">Abierto de Madrid</option>
                            </select>
                            <label class="form-label select-label">Elige una competición</label>
                        </div>
                    </div>
                    <div class="mt-4 pt-2 d-flex justify-content-center">
                        <input data-mdb-button-init data-mdb-ripple-init class="btn btn-success" type="submit" value="Crear partido" />
                    </div>
                </form>
            </div>
        </div>
    </main>
</body>
<?php
                                } else {
                                    header("location: index.php");
                                }
                            } else {
                                header("location: usuario_bloq.php");
                            }
                        }
                    }
                    // Cerrar la conexión a la base de datos
                    $mysqli->close();
                } else {
                    header("location: index.php");
                    // Si no hay sesión iniciada, mostrar los botones de Login y Register
                    echo '<div class="m-2">';
                    echo '<a href="login.php"><button type="button" class="btn btn-light m-2 fw-bold text-warning">Entrar</button></a>';
                    echo '<a href="register.php"><button type="button" class="btn btn-light m-2 fw-bold text-warning">Registrarse</button></a>';
                    echo '</div>';
                }
?>

</html>