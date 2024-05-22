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
<script>
    // Espera a que la página se cargue completamente
    window.onload = function() {
        // Elimina los parámetros GET de la URL
        window.history.replaceState({}, document.title, window.location.pathname);

    };

    function enviarDatos(dato, idBoton) {
        var campoOculto = document.getElementById('datos_seleccionados');
        var boton = document.getElementById(idBoton);
        if (boton.classList.contains('btn-info')) {
            // Si el botón ya está seleccionado, lo deseleccionamos y eliminamos el dato
            campoOculto.value = campoOculto.value.split(',').filter(item => item !== dato).join(',');
        } else {
            // Si el botón no está seleccionado, lo seleccionamos y agregamos el dato
            if (campoOculto.value === '') {
                campoOculto.value = dato;
            } else {
                campoOculto.value += ',' + dato;
            }
        }
        boton.classList.toggle('btn-info');
        boton.classList.toggle('px-3');
    }
</script>

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
                // Verificar si se han recibido los datos del formulario de apuest
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
                    } else {
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
                                </div>
                            </div>';
                    }

                ?>
            </div>
        </nav>
    </header>
    <main>
        <div class="container">
            <div class="d-flex justify-content-center">
                <p class="h1 fw-bold p-4 text-white">RULETA</p>
            </div>
            <div class="bg-light rounded-4 p-5">
                <?php
                    $haydatos = false;
                    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['monto']) || !empty($_GET['color'])) {
                        $datos_seleccionados = $_GET['datos_seleccionados'];
                        $numero_aleatorio = mt_rand(0, 36);

                        if (empty($datos_seleccionados)) {
                            $haydatos = false;
                        } else {
                            $haydatos = true;
                        }
                        $array_datos = explode(',', $datos_seleccionados);
                        $sql = "INSERT INTO ruleta (numero_aleatorio) VALUES ($numero_aleatorio)";
                        $resultado = $mysqli->query($sql);
                    } else {
                        $numero_aleatorio = NULL;
                    }

                    $sql_numeros = "SELECT numero_aleatorio from ruleta order by id desc limit 50";
                    $resultado_numeros = $mysqli->query($sql_numeros);

                    echo "Historial números: ";
                    while ($fila = $resultado_numeros->fetch_assoc()) {
                        echo $fila['numero_aleatorio'], " ";
                    }

                    $numero_rojo = false;
                    $numero_negro = false;
                    // Determinar el color del número apostado
                    if ($numero_aleatorio == 1 || $numero_aleatorio == 3 || $numero_aleatorio == 5 || $numero_aleatorio == 9 || $numero_aleatorio == 7 || $numero_aleatorio == 12 || $numero_aleatorio == 14 || $numero_aleatorio == 18 || $numero_aleatorio == 16 || $numero_aleatorio == 19 || $numero_aleatorio == 21 || $numero_aleatorio == 23 || $numero_aleatorio == 25 || $numero_aleatorio == 27 || $numero_aleatorio == 30 || $numero_aleatorio == 32 || $numero_aleatorio == 34 || $numero_aleatorio == 36) {
                        $color = "rojo";
                    } elseif ($numero_aleatorio == 2 || $numero_aleatorio == 4 || $numero_aleatorio == 5 || $numero_aleatorio == 10 || $numero_aleatorio == 8 || $numero_aleatorio == 13 || $numero_aleatorio == 15 || $numero_aleatorio == 19 || $numero_aleatorio == 17 || $numero_aleatorio == 20 || $numero_aleatorio == 22 || $numero_aleatorio == 24 || $numero_aleatorio == 26 || $numero_aleatorio == 28 || $numero_aleatorio == 31 || $numero_aleatorio == 33 || $numero_aleatorio == 35) {
                        $color = "negro";
                    } else {
                        $color = "verde";
                    }

                    // Verificar si se ha apostado al rojo y/o al negro
                    if ($color == "rojo") {
                        $numero_rojo = true;
                    } else {
                        $numero_negro = true;
                    }
                ?>
                <div class="">
                    <?php
                    echo "<div class='d-flex justify-content-center'>";
                    echo "<h2 class='fw-bold display-4'>$numero_aleatorio</h2>";
                    echo "</div>";
                    ?>
                    <div class="table-responsive">
                        <form id="formulario" action="ruleta.php" method="get">
                            <div class="border border-dark rounded border-3 d-flex justify-content-center">
                                <table class="table table-borderless text-center mb-0">
                                    <tbody>
                                        <tr>
                                            <input type="hidden" id="datos_seleccionados" name="datos_seleccionados">
                                            <td style="background-color: #5bb957;"></td>
                                            <td style="background-color: #ff5252" class="border-start border-dark">
                                                <div class="btn fs-4 border text-white" id="boton3" onclick="enviarDatos('3', 'boton3')">3</div>
                                            </td>
                                            <td style="background-color:#424242">
                                                <div class="btn fs-4 border text-white" id="boton6" onclick="enviarDatos('6', 'boton6')">6</div>
                                            </td>
                                            <td style="background-color: #ff5252">
                                                <div class="btn fs-4 border text-white" id="boton9" onclick="enviarDatos('9','boton9')">9</div>
                                            </td>
                                            <td style="background-color: #ff5252">
                                                <div class="btn fs-4 border text-white" id="boton12" onclick="enviarDatos('12','boton12')">12</div>
                                            </td>
                                            <td style="background-color:#424242" class="border-start border-dark">
                                                <div class="btn fs-4 border text-white" id="boton15" onclick="enviarDatos('15','boton15')">15</div>
                                            </td>
                                            <td style="background-color: #ff5252">
                                                <div class="btn fs-4 border text-white" id="boton18" onclick="enviarDatos('18','boton18')">18</div>
                                            </td>
                                            <td style="background-color: #ff5252">
                                                <div class="btn fs-4 border text-white" id="boton21" onclick="enviarDatos('21','boton21')">21</div>
                                            </td>
                                            <td style="background-color:#424242">
                                                <div class="btn fs-4 border text-white" id="boton24" onclick="enviarDatos('24','boton24')">24</div>
                                            </td>
                                            <td style="background-color: #ff5252" class="border-start border-dark">
                                                <div class="btn fs-4 border text-white" id="boton27" onclick="enviarDatos('27','boton27')">27</div>
                                            </td>
                                            <td style="background-color: #ff5252">
                                                <div class="btn fs-4 border text-white" id="boton30" onclick="enviarDatos('30','boton30')">30</div>
                                            </td>
                                            <td style="background-color:#424242">
                                                <div class="btn fs-4 border text-white" id="boton33" onclick="enviarDatos('33','boton33')">33</div>
                                            </td>
                                            <td style="background-color: #ff5252">
                                                <div class="btn fs-4 border text-white" id="boton36" onclick="enviarDatos('36','boton36')">36</div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="background-color: #5bb957;">
                                                <div class="btn fs-4 border text-white" id="boton0" onclick="enviarDatos('00','boton0')">0</div>
                                            </td>
                                            <td style="background-color:#424242" class="border-start border-dark">
                                                <div class="btn fs-4 border text-white" id="boton2" onclick="enviarDatos('2','boton2')">2</div>
                                            </td>
                                            <td style="background-color: #ff5252">
                                                <div class="btn fs-4 border text-white" id="boton5" onclick="enviarDatos('5','boton5')">5</div>
                                            </td>
                                            <td style="background-color:#424242">
                                                <div class="btn fs-4 border text-white" id="boton8" onclick="enviarDatos('8','boton8')">8</div>
                                            </td>
                                            <td style="background-color:#424242">
                                                <div class="btn fs-4 border text-white" id="boton11" onclick="enviarDatos('11','boton11')">11</div>
                                            </td>
                                            <td style="background-color: #ff5252" class="border-start border-dark">
                                                <div class="btn fs-4 border text-white" id="boton14" onclick="enviarDatos('14','boton14')">14</div>
                                            </td>
                                            <td style="background-color:#424242">
                                                <div class="btn fs-4 border text-white" id="boton17" onclick="enviarDatos('17','boton17')">17</div>
                                            </td>
                                            <td style="background-color:#424242">
                                                <div class="btn fs-4 border text-white" id="boton20" onclick="enviarDatos('20','boton20')">20</div>
                                            </td>
                                            <td style="background-color: #ff5252">
                                                <div class="btn fs-4 border text-white" id="boton23" onclick="enviarDatos('23','boton23')">23</div>
                                            </td>
                                            <td style="background-color:#424242" class="border-start border-dark">
                                                <div class="btn fs-4 border text-white" id="boton26" onclick="enviarDatos('26','boton26')">26</div>
                                            </td>
                                            <td style="background-color:#424242">
                                                <div class="btn fs-4 border text-white" id="boton29" onclick="enviarDatos('29','boton29')">29</div>
                                            </td>
                                            <td style="background-color: #ff5252">
                                                <div class="btn fs-4 border text-white" id="boton32" onclick="enviarDatos('32','boton32')">32</div>
                                            </td>
                                            <td style="background-color:#424242">
                                                <div class="btn fs-4 border text-white" id="boton35" onclick="enviarDatos('35','boton35')">35</div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="background-color: #5bb957;">
                                            <td style="background-color: #ff5252" class="border-start border-dark">
                                                <div class="btn fs-4 border text-white" id="boton1" onclick="enviarDatos('1','boton1')">1</div>
                                            </td>
                                            <td style="background-color:#424242">
                                                <div class="btn fs-4 border text-white" id="boton4" onclick="enviarDatos('4','boton4')">4</div>
                                            </td>
                                            <td style="background-color: #ff5252">
                                                <div class="btn fs-4 border text-white" id="boton7" onclick="enviarDatos('7','boton7')">7</div>
                                            </td>
                                            <td style="background-color:#424242">
                                                <div class="btn fs-4 border text-white" id="boton10" onclick="enviarDatos('10','boton10')">10</div>
                                            </td>
                                            <td style="background-color:#424242" class="border-start border-dark">
                                                <div class="btn fs-4 border text-white" id="boton13" onclick="enviarDatos('13','boton13')">13</div>
                                            </td>
                                            <td style="background-color: #ff5252">
                                                <div class="btn fs-4 border text-white" id="boton16" onclick="enviarDatos('16','boton16')">16</div>
                                            </td>
                                            <td style="background-color: #ff5252">
                                                <div class="btn fs-4 border text-white" id="boton19" onclick="enviarDatos('19','boton19')">19</div>
                                            </td>
                                            <td style="background-color:#424242">
                                                <div class="btn fs-4 border text-white" id="boton22" onclick="enviarDatos('22','boton22')">22</div>
                                            </td>
                                            <td style="background-color: #ff5252" class="border-start border-dark">
                                                <div class="btn fs-4 border text-white" id="boton25" onclick="enviarDatos('25','boton25')">25</div>
                                            </td>
                                            <td style="background-color:#424242">
                                                <div class="btn fs-4 border text-white" id="boton28" onclick="enviarDatos('28','boton28')">28</div>
                                            </td>
                                            <td style="background-color:#424242">
                                                <div class="btn fs-4 border text-white" id="boton31" onclick="enviarDatos('31','boton31')">31</div>
                                            </td>
                                            <td style="background-color: #ff5252">
                                                <div class="btn fs-4 border text-white" id="boton34" onclick="enviarDatos('34','boton34')">34</div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="d-flex justify-content-center">
                                <div class="form-group col-md-2 mb-2">
                                    <div class="d-flex justify-content-center">
                                        <h2 class="fw-bold">Color</h2>
                                    </div>
                                    <div class="mt-1">
                                    <select class="form-select text-center" name="color">
                                            <option value="">Elige un color</option>
                                            <option value="rojo">ROJO</option>
                                            <option value="negro">NEGRO</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-center">
                                <div class="form-group col-md-1 mb-2">
                                    <div class="d-flex justify-content-center">
                                        <h2 class="fw-bold">Apuesta</h2>
                                    </div>
                                    <div class="mt-1">
                                        <select class="form-select text-center" name="monto">
                                            <option value="0.50">0.50€</option>
                                            <option value="1">1€</option>
                                            <option value="2">2€</option>
                                            <option value="3">3€</option>
                                            <option value="4">4€</option>
                                            <option value="5">5€</option>
                                            <option value="10">10€</option>
                                            <option value="25">25€</option>
                                            <option value="50">50€</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center">
                                <input class="btn btn-success col-md-2 fw-bold m-3" id="submit" type="submit" value="Girar">
                            </div>
                        </form>
                    </div>
                    <?php
                    // Verificar si se han recibido los datos por el método GET
                    if ($_SERVER["REQUEST_METHOD"] == "GET") {
                        $sql_saldo = "SELECT saldo FROM usuarios WHERE id_usuario = $id_usuario";

                        $resultado = $mysqli->query($sql_saldo);
                        $fila_saldo = $resultado->fetch_assoc();
                        $saldo_usuario = $fila_saldo['saldo'];

                        if (isset($_GET['color']) && isset($_GET['monto'])) {
                            $color_apostado = $_GET['color'];
                            $monto = $_GET['monto'];
                        }

                        if ($haydatos == true) {
                            // Verificar si se ha recibido el dato seleccionado
                            if (isset($_GET['datos_seleccionados'])) {
                                // Recolectar el dato seleccionado
                                $monto = $_GET['monto'];
                                $monto_total = 0;
                                // Convertir la cadena de datos en un array
                                $array_numeros = explode(',', $datos_seleccionados);

                                // Verificar si el número aleatorio coincide con alguno de los datos seleccionados
                                $coincidencia = false;

                                foreach ($array_numeros as $numero) {
                                    if ($numero_aleatorio == $numero) {
                                        $coincidencia = true;
                                    }
                                    $monto_total += $monto;
                                }

                                if ($saldo_usuario >= $monto_total) {
                                    if ($coincidencia) {
                                        if (isset($_GET['monto'])) {
                                            $premio = $monto * 35;
                                            // Calcula el nuevo saldo del usuario después de ganar la apuesta
                                            $nuevo_saldo = ($saldo_usuario + $premio) - $monto_total;
                                            $sql_update = "UPDATE usuarios SET saldo = $nuevo_saldo WHERE id_usuario = $id_usuario";
                                            $resultado = $mysqli->query($sql_update);
                                            echo "<div class=''>";
                                            echo "<div class='alert alert-success text-center display-6' role='alert'>WIN $premio €!!</div>";
                                            echo "</div>";
                                        }
                                    } else {
                                        if (isset($_GET['monto'])) {
                                            $premio = 0;

                                            // Calcula el nuevo saldo del usuario después de ganar la apuesta
                                            $nuevo_saldo = $saldo_usuario - $monto_total;
                                            $sql_update = "UPDATE usuarios SET saldo = $nuevo_saldo WHERE id_usuario = $id_usuario";
                                            $resultado = $mysqli->query($sql_update);
                                            echo "<div class=''>";
                                            echo "<div class='alert alert-danger text-center display-6' role='alert'>Has perdido $monto_total €!!</div>";
                                            echo "</div>";
                                        }
                                    }
                                } else {
                                    echo "<div class=''>";
                                    echo "<div class='alert alert-danger text-center display-6' role='alert'>Saldo insuficiente</div>";
                                    echo "</div>";
                                    exit();
                                }
                                exit();
                            }
                        } else {
                            // Manejar el caso en el que se accede directamente a este archivo sin enviar el formulario
                            //echo '<div class="alert alert-danger" role="alert">Este script espera recibir datos a través del método GET.</div>';
                        }
                    }

                    if (isset($_GET['color']) && !empty($_GET['color'])) {
                        if ($saldo_usuario >= $monto) {
                            if ($color == $color_apostado) {
                                $premio = $monto * 2;

                                // Calcula el nuevo saldo del usuario después de ganar la apuesta
                                $nuevo_saldo = ($saldo_usuario + $premio) - $monto;
                                $sql_update = "UPDATE usuarios SET saldo = $nuevo_saldo WHERE id_usuario = $id_usuario";
                                $resultado = $mysqli->query($sql_update);

                                echo "<div class=''>";
                                echo "<div class='alert alert-success text-center display-6' role='alert'>WIN $premio €!!</div>";
                                echo "</div>";
                            } else {
                                $premio = 0;
                                // Calcula el nuevo saldo del usuario después de ganar la apuesta
                                $nuevo_saldo = $saldo_usuario - $monto;
                                $sql_update = "UPDATE usuarios SET saldo = $nuevo_saldo WHERE id_usuario = $id_usuario";
                                $resultado = $mysqli->query($sql_update);

                                echo "<div class=''>";
                                echo "<div class='alert alert-danger text-center display-6' role='alert'>Has perdido $monto €!!</div>";
                                echo "</div>";
                            }
                        } else {
                            echo "<div class=''>";
                            echo "<div class='alert alert-danger text-center display-6' role='alert'>Saldo insuficiente</div>";
                            echo "</div>";
                            exit();
                        }
                    }
                    ?>

                </div>
            </div>
</body>
<?php
                }
                // Cerrar la conexión a la base de datos
                $mysqli->close();

?>

</html>