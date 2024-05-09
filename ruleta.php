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
    function enviarDatos(dato, idBoton) {
        var campoOculto = document.getElementById('datos_seleccionados');
        var boton = document.getElementById(idBoton);
        if (boton.classList.contains('btn-success')) {
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
        boton.classList.toggle('btn-success');
        boton.classList.toggle('border');
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
                            <a class="nav-link text-light" href="#">Ruleta</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="#">Blackjack</a>
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
                    } else {
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
                <p class="h1 fw-bold p-4 text-white">PARTIDOS TENIS</p>
            </div>
            <div class="bg-light rounded-4 p-5">
                <div class="border border-dark rounded-4 p-2">
                    <div class="table-responsive">
                        <form id="formulario" action="ruleta.php" method="get">
                            <table class="table text-center">
                                <tbody>
                                    <tr>
                                        <input type="hidden" id="datos_seleccionados" name="datos_seleccionados">
                                        <td class="table-success"></td>
                                        <td class="table-danger">
                                            <div class="btn btn-primary" id="boton3" onclick="enviarDatos('3', 'boton3')">3</div>
                                        </td>
                                        <td style="background-color:#424242">
                                            <div class="btn btn-primary" id="boton6" onclick="enviarDatos('6', 'boton6')">6</div>
                                        </td>
                                        <td>
                                            <div class="btn btn-primary" id="boton9" onclick="enviarDatos('9','boton9')">9</div>
                                        </td>
                                        <td>
                                            <div class="btn btn-primary" id="boton12" onclick="enviarDatos('12','boton12')">12</div>
                                        </td>
                                        <td>
                                            <div class="btn btn-primary" id="boton15" onclick="enviarDatos('15','boton15')">15</div>
                                        </td>
                                        <td>
                                            <div class="btn btn-primary" id="boton18" onclick="enviarDatos('18','boton18')">18</div>
                                        </td>
                                        <td>
                                            <div class="btn btn-primary" id="boton21" onclick="enviarDatos('21','boton21')">21</div>
                                        </td>
                                        <td>
                                            <div class="btn btn-primary" id="boton24" onclick="enviarDatos('24','boton24')">24</div>
                                        </td>
                                        <td>
                                            <div class="btn btn-primary" id="boton27" onclick="enviarDatos('27','boton27')">27</div>
                                        </td>
                                        <td>
                                            <div class="btn btn-primary" id="boton30" onclick="enviarDatos('30','boton30')">30</div>
                                        </td>
                                        <td>
                                            <div class="btn btn-primary" id="boton33" onclick="enviarDatos('33','boton33')">33</div>
                                        </td>
                                        <td>
                                            <div class="btn btn-primary" id="boton36" onclick="enviarDatos('36','boton36')">36</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="table-success">
                                            <div class="btn btn-primary" id="boton0" onclick="enviarDatos('0', 'boton0')">0</div>
                                        </td>
                                        <td>
                                            <div class="btn btn-primary" id="boton2" onclick="enviarDatos('2','boton2')">2</div>
                                        </td>
                                        <td>
                                            <div class="btn btn-primary" id="boton5" onclick="enviarDatos('5','boton5')">5</div>
                                        </td>
                                        <td>
                                            <div class="btn btn-primary" id="boton8" onclick="enviarDatos('8','boton8')">8</div>
                                        </td>
                                        <td>
                                            <div class="btn btn-primary" id="boton11" onclick="enviarDatos('11','boton11')">11</div>
                                        </td>
                                        <td>
                                            <div class="btn btn-primary" id="boton14" onclick="enviarDatos('14','boton14')">14</div>
                                        </td>
                                        <td>
                                            <div class="btn btn-primary" id="boton17" onclick="enviarDatos('17','boton17')">17</div>
                                        </td>
                                        <td>
                                            <div class="btn btn-primary" id="boton20" onclick="enviarDatos('20','boton20')">20</div>
                                        </td>
                                        <td>
                                            <div class="btn btn-primary" id="boton23" onclick="enviarDatos('23','boton23')">23</div>
                                        </td>
                                        <td>
                                            <div class="btn btn-primary" id="boton26" onclick="enviarDatos('26','boton26')">26</div>
                                        </td>
                                        <td>
                                            <div class="btn btn-primary" id="boton29" onclick="enviarDatos('29','boton29')">29</div>
                                        </td>
                                        <td>
                                            <div class="btn btn-primary" id="boton32" onclick="enviarDatos('32','boton32')">32</div>
                                        </td>
                                        <td>
                                            <div class="btn btn-primary" id="boton35" onclick="enviarDatos('35','boton35')">35</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="table-success"></td>
                                        <td>
                                            <div class="btn btn-primary" id="boton1" onclick="enviarDatos('1','boton1')">1</div>
                                        </td>
                                        <td>
                                            <div class="btn btn-primary" id="boton4" onclick="enviarDatos('4','boton4')">4</div>
                                        </td>
                                        <td>
                                            <div class="btn btn-primary" id="boton7" onclick="enviarDatos('7','boton7')">7</div>
                                        </td>
                                        <td>
                                            <div class="btn btn-primary" id="boton10" onclick="enviarDatos('10','boton10')">10</div>
                                        </td>
                                        <td>
                                            <div class="btn btn-primary" id="boton13" onclick="enviarDatos('13','boton13')">13</div>
                                        </td>
                                        <td>
                                            <div class="btn btn-primary" id="boton16" onclick="enviarDatos('16','boton16')">16</div>
                                        </td>
                                        <td>
                                            <div class="btn btn-primary" id="boton19" onclick="enviarDatos('19','boton19')">19</div>
                                        </td>
                                        <td>
                                            <div class="btn btn-primary" id="boton22" onclick="enviarDatos('22','boton22')">22</div>
                                        </td>
                                        <td>
                                            <div class="btn btn-primary" id="boton25" onclick="enviarDatos('25','boton25')">25</div>
                                        </td>
                                        <td>
                                            <div class="btn btn-primary" id="boton28" onclick="enviarDatos('28','boton28')">28</div>
                                        </td>
                                        <td>
                                            <div class="btn btn-primary" id="boton31" onclick="enviarDatos('31','boton31')">31</div>
                                        </td>
                                        <td>
                                            <div class="btn btn-primary" id="boton34" onclick="enviarDatos('34','boton34')">34</div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="form-group col-md-1 mb-3">
                                <label>Apuesta:</label>
                                <input type="number" name="monto" class="form-control" step="0.001" min="0" max="50" required>
                            </div>
                            <input class="btn btn-primary" type="submit" value="Girar">
                        </form>
                    </div>
                    <?php
                    // Verificar si se han recibido los datos por el método GET
                    if ($_SERVER["REQUEST_METHOD"] == "GET") {
                        // Verificar si se ha recibido el dato seleccionado
                        if (isset($_GET['datos_seleccionados'])) {
                            // Recolectar el dato seleccionado
                            $datos_seleccionados = $_GET['datos_seleccionados'];
                            $monto = $_GET['monto'];
                            // Convertir la cadena de datos en un array
                            $array_datos = explode(',', $datos_seleccionados);
                            // Generar un número aleatorio entre 1 y 36
                            $numero_aleatorio = rand(1, 36);

                            // Verificar si el número aleatorio coincide con alguno de los datos seleccionados
                            $coincidencia = false;
                            foreach ($array_datos as $dato) {
                                if ($numero_aleatorio == $dato) {
                                    $coincidencia = true;
                                    break;
                                }
                            }

                            if ($coincidencia) {
                                $premio = $monto * 35;
                            } else {
                                $premio = 0;
                            }
                        } else {
                            // Manejar el caso en el que falta el dato seleccionado
                            echo "No se ha recibido el dato seleccionado.";
                        }
                    } else {
                        // Manejar el caso en el que se accede directamente a este archivo sin enviar el formulario
                        echo "Este script espera recibir datos a través del método GET.";
                    }


                    // Imprimir la recompensa
                    echo "Número ganador: $numero_aleatorio<br>";
                    echo "Números seleccionados: $datos_seleccionados<br>";
                    echo "Monto apostado: $monto<br>";
                    echo "Recompensa: $premio";
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