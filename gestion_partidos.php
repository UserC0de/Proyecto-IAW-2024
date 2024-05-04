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
                            <a class="nav-link text-light" href="#">Apuestas</a>
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
                      <li><a class="dropdown-item" href="#">Perfil</a></li>
                      <li><a class="dropdown-item" href="#">Gestión de Usuarios</a></li>
                      <li><a class="dropdown-item" href="gestion_partidos.php">Gestión de Partidos</a></li>
                      <li><a class="dropdown-item" href="#">Mis Apuestas</a></li>
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
                <p class="h1 fw-bold p-4 text-white">GESTIÓN DE PATIDOS</p>
            </div>
            <div class="bg-light rounded-4 p-5">
                <div class="d-flex justify-content-center p-2">
                    <a href="registrar.php"><button type="button" class="btn btn-success">Crear partido</button></a>
                </div>
                <div class="border border-dark rounded-4 p-2">
                    <table class="table table-striped caption-top">
                        <caption>Lista de partidos</caption>
                        <thead>
                            <tr class="bg-info text-center">
                                <th scope="col">Competicion</th>
                                <th scope="col">Jugador Visitante</th>
                                <th scope="col">Cuota Visitante</th>
                                <th scope="col">Jugador Local</th>
                                <th scope="col">Cuota Local</th>
                                <th scope="col">Fecha</th>
                                <th scope="col">Hora</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                                    while ($fila = $resultado2->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td>$fila[competicion]</td>";
                                        echo "<td class='text-center'>$fila[jugador_visitante]</td>";
                                        echo "<td class='text-center'>$fila[cuota_visitante]</td>";
                                        echo "<td class='text-center'>$fila[jugador_local]</td>";
                                        echo "<td class='text-center'>$fila[cuota_local]</td>";
                                        echo "<td class='text-center'>$fila[fecha]</td>";
                                        echo "<td class='text-center'>$fila[hora]</td>";
                                        echo "<td class='text-center'><a href='editar_partido.php?id=$fila[id_partido]'><button type='button' class='btn btn-warning'>Editar</button></td>";
                                        echo "<td class='text-center'><a href='eliminar_partido.php?id=$fila[id_partido]'><button type='button' class='btn btn-danger'>Eliminar</button></td>";
                                        echo "</tr>";
                                    }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
    </main>
</body>
<?php
                                } else {
                                    echo '</div>';
                                    echo '<div class="mx-3">';
                                    echo "<div class='nav-item dropdown'>";
                                    echo "<a class='nav-link text-light' href='#'>Saldo: $saldo €</a> <a class='nav-link dropdown-toggle text-light' href='#' role='button' data-bs-toggle='dropdown' aria-expanded='false'>$nickname <i class='fas fa-user'></i></a>";
                                    echo '<ul class="dropdown-menu">
      <li><a class="dropdown-item" href="#">Perfil</a></li>
      <li><a class="dropdown-item" href="#">Mis Apuestas</a></li>
      <li><a class="dropdown-item" href="#">Monedero</a></li>
      <li><hr class="dropdown-divider"></li>
      <li><a class="dropdown-item" href="cerrar_sesion.php">Cerrar sesión</a></li>
    </ul>
  </div>';
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