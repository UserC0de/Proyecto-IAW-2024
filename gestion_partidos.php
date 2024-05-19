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
                                        </div>
                                    </div>';
                ?>
            </div>
        </nav>
    </header>

    <main>
        <div class="container">
            <div class="d-flex justify-content-center">
                <p class="h1 fw-bold p-4 text-white">GESTIÓN DE PATIDOS</p>
            </div>
            <div class="bg-light rounded-4 p-5">
                <div class="d-flex justify-content-center p-2">
                    <a href="crear_partido.php"><button type="button" class="btn btn-success">Crear partido</button></a>
                </div>
                <div class="border border-dark rounded-4 p-2">
                    <form action="gestion_partidos.php" method="GET">
                        <div class="row mb-3">
                            <div class="">
                                <select name="filtro_competencia">
                                    <option value="">Cualquiera competicion</option>
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
                            <div class="col-md-2">
                                <select class="form-control" name="filtro_estado">
                                    <option value="">Pendientes</option>
                                    <option value="1">Finalizadas</option>
                                </select>
                            </div>
                            <div class="col-md-3 d-flex align-items-center border ">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" id="filtro_mayor_saldo" name="filtro_mayor_cuota">
                                    <label class="form-check-label" for="filtro_mayor_cuota">
                                        Ordenar por mayor cuota
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary">Filtrar</button>
                            </div>
                        </div>
                    </form>
                    <?php
                                    // Obtener el valor del filtro de estado si está presente en la URL

                                    $filtro_mayor_cuota = isset($_GET['filtro_mayor_cuota']) ? $_GET['filtro_mayor_cuota'] : '';
                                    $filtro_estado = isset($_GET['filtro_estado']) ? $_GET['filtro_estado'] : '';
                                    $filtro_competencia = isset($_GET['filtro_competencia']) ? $_GET['filtro_competencia'] : '';

                                    // Realizar la consulta SQL con el filtro de estado si está presente
                                    $sql_partidos = "SELECT * FROM partidos p, cuotas c where p.id_partido = c.id_partido;";

                                    // Construir la parte WHERE de la consulta SQL basada en los filtros
                                    $where = [];
                                    if (!empty($filtro_estado)) {
                                        $where[] = "resultado is not null";
                                    } else {
                                        $where[] = "resultado is null";
                                    }

                                    if (!empty($filtro_competencia)) {
                                        $where[] = "competicion LIKE '%$filtro_competencia%'";
                                    }

                                    // Verificar si el checkbox de filtro por mayor saldo está marcado
                                    if (!empty($filtro_mayor_cuota)) {
                                        // Construir la parte ORDER BY de la consulta SQL solo si el checkbox está marcado
                                        $order_by = " ORDER BY c.cuota_visitante DESC, c.cuota_local DESC"; // Ordenar en orden descendente (mayor saldo primero)
                                    } else {
                                        // De lo contrario, no se necesita ordenar por saldo
                                        $order_by = " ORDER BY competicion"; // No se aplica ningún ordenamiento
                                    }
                                    // Combinar todos los filtros con AND
                                    $where_clause = !empty($where) ? ' AND ' . implode(' AND ', $where) : '';
                                    $where_clause2 = !empty($where) ? ' WHERE ' . implode(' AND ', $where) : '';
                                    
                                    // Número de partidos por página
                                    $partidos_por_pagina = 5;

                                    // Calcular el total de partidos
                                    $sql_total_partidos = "SELECT COUNT(*) AS total_partidos FROM partidos";
                                    $sql_total_partidos .= $where_clause2;
                                    $resultado_total_partidos = $mysqli->query($sql_total_partidos);
                                    $fila_total_partidos = $resultado_total_partidos->fetch_assoc();
                                    $total_partidos = $fila_total_partidos['total_partidos'];
                                    $total_paginas = ceil($total_partidos / $partidos_por_pagina);

                                    // Obtener el número de página actual
                                    $pagina_actual = isset($_GET['pagina']) ? $_GET['pagina'] : 1;

                                    // Calcular el offset para la consulta SQL
                                    $offset = ($pagina_actual - 1) * $partidos_por_pagina;

                                    // Realizar la consulta SQL con limit y offset
                                    $sql_partidos = "SELECT * FROM partidos p, cuotas c where p.id_partido=c.id_partido";

                                    $sql_partidos .= $where_clause; // Agregar la cláusula WHERE si hay filtros
                                    $sql_partidos .= $order_by; // Agregar la cláusula ORDER BY solo si el checkbox está marcado
                                    $sql_partidos .= " LIMIT $offset, $partidos_por_pagina";

                                    $resultado_partidos = $mysqli->query($sql_partidos);

                                    // Generar la tabla de partidos
                                    echo '<table class="table table-striped caption-top">';
                                    echo "<caption>Lista total de partidos: ($total_partidos)</caption>";
                                    echo '<thead>';
                                    echo '<tr class="bg-info bg-gradient text-center">';
                                    echo '<th scope="col">Competicion</th>';
                                    echo '<th scope="col">Jugador Visitante</th>';
                                    echo '<th scope="col">Cuota Visitante</th>';
                                    echo '<th scope="col">Jugador Local</th>';
                                    echo '<th scope="col">Cuota Local</th>';
                                    echo '<th scope="col">Fecha</th>';
                                    echo '<th scope="col">Hora</th>';
                                            echo '<th scope="col">Ganador</th>';
                                    echo '</tr>';
                                    echo '</thead>';
                                    echo '<tbody>';

                                    while ($fila = $resultado_partidos->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td>$fila[competicion]</td>";
                                        echo "<td class='text-center'>$fila[jugador_visitante]</td>";
                                        echo "<td class='text-center'>$fila[cuota_visitante]</td>";
                                        echo "<td class='text-center'>$fila[jugador_local]</td>";
                                        echo "<td class='text-center'>$fila[cuota_local]</td>";
                                        echo "<td class='text-center'>$fila[fecha]</td>";
                                        echo "<td class='text-center'>$fila[hora]</td>";

                                        if ($fila['resultado'] > 0) {
                                            $ganador = $fila['resultado'];
                                            if ($ganador == 1) {
                                                $ganador = "Local";
                                            } else {
                                                $ganador = "Visitante";
                                            }
                                            echo "<td class='text-center'>$ganador</td>";
                                            echo "<td class='text-center'><a href='eliminar_partido.php?id_partido=$fila[id_partido]'><button type='button' class='btn btn-danger'>Eliminar</button></td>";

                                        } else {

                                            echo "<td class='text-center'><a href='resultado.php?id_partido=$fila[id_partido]'><button type='button' class='btn btn-info'>Finalizar</button></td>";
                                            echo "<td class='text-center'><a href='editar_partido.php?id_partido=$fila[id_partido]'><button type='button' class='btn btn-warning'>Editar</button></td>";
                                            echo "<td class='text-center'><a href='eliminar_partido.php?id_partido=$fila[id_partido]'><button type='button' class='btn btn-danger'>Eliminar</button></td>";
                                        }
                                        echo "</tr>";
                                    }

                                    echo '</tbody>';
                                    echo '</table>';

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