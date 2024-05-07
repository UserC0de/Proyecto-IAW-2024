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
                            <a class="nav-link text-light" href="apuestas.phpç">Apuestas</a>
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
                                             <li><a class="dropdown-item" href="perfil_usuario.php">Perfil</a>  </li>
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
        </nav>
    </header>

    <main>
        <div class="container">
            <div class="d-flex justify-content-center">
                <p class="h1 fw-bold p-4 text-white">GESTIÓN DE USUARIOS</p>
            </div>
            <div class="bg-light rounded-4 p-5">
                <div class="border border-dark rounded-4 p-2">
                    <form action="gestion_usuarios.php" method="GET">
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <input type="text" class="form-control" name="filtro_nickname" placeholder="Nickname">
                            </div>
                            <div class="col-md-2">
                                <select class="form-control" name="filtro_estado">
                                    <option value="">Todos los estados</option>
                                    <option value="A">Activo</option>
                                    <option value="B">Bloqueado</option>
                                </select>
                                <select class="form-control" name="filtro_rol">
                            </div>
                            <div class="col-md-2">
                                    <option value="">Todos los roles</option>
                                    <option value="usuario">Usuario</option>
                                    <option value="admin">Admin</option>
                                </select>
                            </div>
                            <div class="col-md-3 d-flex align-items-center border ">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" id="filtro_mayor_saldo" name="filtro_mayor_saldo">
                                    <label class="form-check-label" for="filtro_mayor_saldo">
                                        Ordenar por mayor saldo
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

                                    $filtro_mayor_saldo = isset($_GET['filtro_mayor_saldo']) ? $_GET['filtro_mayor_saldo'] : '';
                                    $filtro_rol = isset($_GET['filtro_rol']) ? $_GET['filtro_rol'] : '';
                                    $filtro_estado = isset($_GET['filtro_estado']) ? $_GET['filtro_estado'] : '';
                                    $filtro_nickname = isset($_GET['filtro_nickname']) ? $_GET['filtro_nickname'] : '';

                                    // Realizar la consulta SQL con el filtro de estado si está presente
                                    $sql_usuarios = "SELECT id_usuario, nickname, nombre, apellido, correo, saldo, estado, rol_usuario FROM usuarios";

                                    // Construir la parte WHERE de la consulta SQL basada en los filtros
                                    $where = [];
                                    if (!empty($filtro_rol)) {
                                        $where[] = "rol_usuario = '$filtro_rol'";
                                    }
                                    if (!empty($filtro_estado)) {
                                        $where[] = "estado = '$filtro_estado'";
                                    }
                                    if (!empty($filtro_nickname)) {
                                        $where[] = "nickname LIKE '%$filtro_nickname%'";
                                    }

                                    // Verificar si el checkbox de filtro por mayor saldo está marcado
                                    if (!empty($filtro_mayor_saldo)) {
                                        // Construir la parte ORDER BY de la consulta SQL solo si el checkbox está marcado
                                        $order_by = " ORDER BY saldo DESC"; // Ordenar en orden descendente (mayor saldo primero)
                                    } else {
                                        // De lo contrario, no se necesita ordenar por saldo
                                        $order_by = " ORDER BY nombre"; // No se aplica ningún ordenamiento
                                    }
                                    // Combinar todos los filtros con AND
                                    $where_clause = !empty($where) ? ' WHERE ' . implode(' AND ', $where) : '';

                                    // Número de partidos por página
                                    $usuarios_por_pagina = 5;

                                    // Calcular el total de partidos
                                    $sql_total_usuarios = "SELECT COUNT(*) AS total_usuarios FROM usuarios";
                                    $sql_total_usuarios .= $where_clause; // Utilizamos la misma cláusula WHERE que se aplica a la lista de usuarios
                                    $resultado_total_usuarios = $mysqli->query($sql_total_usuarios);
                                    $fila_total_usuarios = $resultado_total_usuarios->fetch_assoc();

                                    $total_usuarios = $fila_total_usuarios['total_usuarios'];
                                    $total_paginas = ceil($total_usuarios / $usuarios_por_pagina);

                                    // Obtener el número de página actual
                                    $pagina_actual = isset($_GET['pagina']) ? $_GET['pagina'] : 1;

                                    // Calcular el offset para la consulta SQL
                                    $offset = ($pagina_actual - 1) * $usuarios_por_pagina;

                                    // Agregar el WHERE a la consulta SQL
                                    $sql_usuarios = "SELECT id_usuario, nickname, nombre, apellido, correo, saldo, estado, rol_usuario FROM usuarios";
                                    $sql_usuarios .= $where_clause; // Agregar la cláusula WHERE si hay filtros
                                    $sql_usuarios .= $order_by; // Agregar la cláusula ORDER BY solo si el checkbox está marcado
                                    $sql_usuarios .= " LIMIT $offset, $usuarios_por_pagina";

                                    $resultado_usuarios = $mysqli->query($sql_usuarios);

                                    // Generar la tabla de partidos
                                    echo '<table class="table table-striped caption-top">';
                                    echo "<caption>Lista total de usuarios ($total_usuarios)</caption>";
                                    echo '<thead>';
                                    echo '<tr class="bg-info bg-gradient text-center">';
                                    echo '<th scope="col">Nickname</th>';
                                    echo '<th scope="col">Nombre</th>';
                                    echo '<th scope="col">Apellido</th>';
                                    echo '<th scope="col">Correo</th>';
                                    echo '<th scope="col">Saldo</th>';
                                    echo '<th scope="col">Estado</th>';
                                    echo '<th scope="col">Rol</th>';
                                    echo '</tr>';
                                    echo '</thead>';
                                    echo '<tbody>';

                                    while ($fila = $resultado_usuarios->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td><a class='text-dark' href='perfil_usuario.php?id_usuario=$fila[id_usuario]'>$fila[nickname]</td>";
                                        echo "<td class='text-center'>$fila[nombre]</td>";
                                        echo "<td class='text-center'>$fila[apellido]</td>";
                                        echo "<td class='text-center'>$fila[correo]</td>";
                                        echo "<td class='text-center'>$fila[saldo] €</td>";
                                        echo "<td class='text-center'>$fila[estado]</td>";
                                        echo "<td class='text-center'>$fila[rol_usuario]</td>";
                                        echo "<td class='text-center'><a href='editar_usuario.php?id_usuario=$fila[id_usuario]'><button type='button' class='btn btn-warning'>Editar</button></td>";
                                        echo "<td class='text-center'><a href='eliminar_usuario.php?id_usuario=$fila[id_usuario]'><button type='button' class='btn btn-danger'>Eliminar</button></td>";
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
                }
?>

</html>