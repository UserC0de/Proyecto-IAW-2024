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
                                    <li><a class="dropdown-item" href="#">Mis Apuestas</a></li>
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
                                    <li><a class="dropdown-item" href="#">Mis Apuestas</a></li>
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
                <p class="h1 fw-bold p-4 text-white">MIS APUESTAS</p>
            </div>
            <div class="bg-light rounded-4 p-5">
                <div class="border border-dark rounded-4 p-2">
                    <?php

                    // Número de partidos por página
                    $partidos_por_pagina = 5;

                    // Calcular el total de partidos
                    $sql_total_partidos = "SELECT COUNT(*) AS total_partidos FROM apuestas where id_usuario=$id_usuario";
                    $resultado_total_partidos = $mysqli->query($sql_total_partidos);
                    $fila_total_partidos = $resultado_total_partidos->fetch_assoc();
                    $total_partidos = $fila_total_partidos['total_partidos'];
                    $total_paginas = ceil($total_partidos / $partidos_por_pagina);

                    // Obtener el número de página actual
                    $pagina_actual = isset($_GET['pagina']) ? $_GET['pagina'] : 1;

                    // Calcular el offset para la consulta SQL
                    $offset = ($pagina_actual - 1) * $partidos_por_pagina;

                    // Realizar la consulta SQL con limit y offset
                    $sql_apuestas = "SELECT * from apuestas where id_usuario=$id_usuario LIMIT $offset, $partidos_por_pagina";
                    $resultado_apuestas = $mysqli->query($sql_apuestas);

                    // Generar la tabla de partidos
                    echo "<caption>Lista de tus apuestas ($total_partidos)</caption>";
                    echo '<table class="table table-striped caption-top">';
                    echo '<thead>';
                    echo '<tr class="bg-info bg-gradient text-center">';
                    echo '<th scope="col">Competicion</th>';
                    echo '<th scope="col">Jugador Visitante</th>';
                    echo '<th scope="col"></th>';
                    echo '<th scope="col">Jugador Local</th>';
                    echo '<th scope="col">Monto Apostado</th>';
                    echo '<th scope="col">Cuota</th>';
                    echo '<th scope="col">Gana</th>';
                    echo '<th scope="col">Premio</th>';
                    echo '<th scope="col">Fecha</th>';
                    echo '</tr>';
                    echo '</thead>';
                    echo '<tbody>';

                    while ($fila = $resultado_apuestas->fetch_assoc()) {
                        $id_partido = $fila['id_partido'];
                        $sql_partidos = "select competicion, jugador_visitante, jugador_local from partidos where id_partido=$id_partido";
                        $resultado_partidos = $mysqli->query($sql_partidos);
                        $fila_partidos = $resultado_partidos->fetch_assoc();
                        $competicion = $fila_partidos['competicion'];
                        $jugador_visitante = $fila_partidos['jugador_visitante'];
                        $jugador_local = $fila_partidos['jugador_local'];

                        if ($fila['resultado'] == 1) {
                            $gana = "$jugador_visitante";
                        } else {
                            $gana = "$jugador_local";
                        }

                        $premio = $fila['cuota'] * $fila['monto'];

                        $premio_si_cancela = $fila['monto'] * 0.40;
                        echo "<tr>";
                        echo "<td>$competicion</td>";
                        echo "<td class='text-center'>$jugador_visitante</td>";
                        echo "<td class='text-center'>X</td>";
                        echo "<td class='text-center'>$jugador_local</td>";
                        echo "<td class='text-center small'>$fila[monto] €</td>";
                        echo "<td class='text-center small'>$fila[cuota]</td>";
                        echo "<td class='text-center'>$gana</td>";
                        echo "<td class='text-center text-success fw-bold small'>$premio €</td>";
                        echo "<td class='text-center'>$fila[fecha]</td>";
                        echo "<td class='text-center><a href='eliminar_apuesta.php?id_apuesta=$fila[id_apuesta]'><button type='button' class='btn btn-danger text-dark btn-sm border w-100'><div>Cancelar <div>[$premio_si_cancela €]</div></div></button></td>";
                        echo "</tr>";
                    }

                    echo '</tbody>';
                    echo '</table>';

                    // Mostrar los enlaces de paginación
                    // Mostrar la paginación    
                    echo '<nav aria-label="Page navigation example">';
                    echo '<ul class="pagination justify-content-center">';
                    for ($i = 1; $i <= $total_paginas; $i++) {
                        echo "<li class='page-item'><a class='page-link' href='?pagina=$i'>$i</a></li>";
                    }
                    echo '</ul>';
                    echo '</nav>';
                    ?>

                </div>
            </div>
    </main>
</body>
<?php
                }
                // Cerrar la conexión a la base de datos
                $mysqli->close();
?>

</html>