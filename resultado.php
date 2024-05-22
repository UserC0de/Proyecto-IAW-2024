<?php
require 'conexion.php';
// Iniciar sesión si no está iniciada
session_start();
if (!isset($_SESSION['id_usuario'])) {
    header("location: index.php");
    exit();

    if ($_SESSION['estado'] !== 'A') {
        header("location: usuario_bloq.php");
    }
}
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['id_partido'])) {
        $id_partido = $_GET['id_partido'];
        // Consultar si existe el partido con el ID proporcionado
        $sql_verificar_partido = "SELECT COUNT(*) AS existe_partido FROM partidos WHERE id_partido = '$id_partido'";
        $resultado_verificar_partido = $mysqli->query($sql_verificar_partido);


        $row_verificar_partido = $resultado_verificar_partido->fetch_assoc();
        $existe_partido = $row_verificar_partido['existe_partido'];

        if ($existe_partido == 0) {
            // El partido no existe, redirigir a index.php
            header("location: index.php");
            exit(); // Asegurar que el script se detenga después de la redirección
        }

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
                        $id_usuario = $_SESSION['id_usuario'];
                        // Consultar la información del usuario y su saldo desde la base de datos
                        $sql = "SELECT nickname, saldo, estado, rol_usuario FROM usuarios WHERE id_usuario = '$id_usuario'";
                        $resultado = $mysqli->query($sql);

                        if ($resultado->num_rows > 0) {
                            $row = $resultado->fetch_assoc();
                            $nickname = $row['nickname'];
                            $saldo = $row['saldo'];

                            if (isset($_SESSION['rol']) && $_SESSION['rol'] == 'admin') {
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
                            </div>
                        </div>';

                        ?>
                    </div>
                </nav>
            </header>

            <main>
                <?php
                            $id_partido = $_GET['id_partido'];

                            $sql_partido = "SELECT jugador_visitante, jugador_local from partidos where id_partido=$id_partido";
                            $resultado_partido = $mysqli->query($sql_partido);
                            $fila = $resultado_partido->fetch_assoc();

                            $sql_cuota = "SELECT cuota_visitante, cuota_local from cuotas where id_partido=$id_partido";
                            $resultado_cuota = $mysqli->query($sql_cuota);
                            $fila_cuota = $resultado_cuota->fetch_assoc();
                ?>
                <div class="container">
                    <div class="d-flex justify-content-center">
                        <p class="h1 fw-bold p-4 text-white">FINALIZAR PARTIDO</p>
                    </div>
                    <div class="container d-flex justify-content-center">
                        <div class="bg-light rounded-4 p-5">
                            <div class="border border-dark rounded-4 p-2">
                                <form action="resultado2.php" method="POST" class="m-4">
                                    <div class="form-row row d-flex justify-content-center">
                                        <input type="hidden" name="id_usuario" value="<?php echo $id_usuario; ?>">
                                        <input type="hidden" name="id_partido" value="<?php echo $id_partido; ?>">
                                        <div class="form-group col-md-6 mb-4">
                                            <label for="jugador1" class="d-flex justify-content-center">Jugador Visitante:</label>
                                            <input type="text" id="jugador1" name="jugador1" class="form-control" value="<?php echo $fila['jugador_visitante']; ?>" disabled>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="jugador2" class="d-flex justify-content-center">Jugador Local:</label>
                                            <input type="text" id="jugador2" name="jugador2" class="form-control" value="<?php echo $fila['jugador_local']; ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="form-row row d-flex justify-content-center">
                                        <div class="form-group col-md-6">   
                                            <select id="ganador" name="resultado" class="form-control" required>
                                                <option value="">Selecciona el Ganador</option>
                                                <option value="1"><?php echo $fila['jugador_visitante'];?> </option>
                                                <option value="2"><?php echo $fila['jugador_local'];?></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-center m-3">
                                        <button type="submit" class="btn btn-primary">Finalizar Partido</button>
                                    </div>
                                </form>
                            </div>
                            <div class="d-flex justify-content-center mt-4">
                                <a href="gestion_partidos.php" class="btn btn-info text-light">Volver</a>
                            </div>
                        </div>
                    </div>
            </main>
        </body>
<?php
                        }
                    } else {
                        header("location: index.php");
                    }
                } else {
                    //header("location: apuestas.php");
                }
            }
                // Cerrar la conexión a la base de datos
                $mysqli->close();
?>

        </html>