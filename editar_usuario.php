<?php
require 'conexion.php'; // Incluir el archivo de conexión
// Verificar si se ha iniciado sesión y si el usuario tiene el rol de administrador
session_start();
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
    // Si no tiene el rol de administrador, se redirige a un videoxd
    header("Location: https://www.youtube.com/watch?v=xvFZjo5PgG0&ab_channel=Duran");
    exit();
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
    function mostrarPassword() {
        var cambio = document.getElementById("txtPassword");
        if (cambio.type == "password") {
            cambio.type = "text";
            $('.icon').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
        } else {
            cambio.type = "password";
            $('.icon').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
        }
    }

    $(document).ready(function() {
        //CheckBox mostrar contraseña
        $('#ShowPassword').click(function() {
            $('#Password').attr('type', $(this).is(':checked') ? 'text' : 'password');
        });
    });

    function mostrarPassword2() {
        var cambio = document.getElementById("txtPassword2");
        if (cambio.type == "password") {
            cambio.type = "text";
            $('.icon').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
        } else {
            cambio.type = "password";
            $('.icon').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
        }
    }

    $(document).ready(function() {
        //CheckBox mostrar contraseña
        $('#ShowPassword').click(function() {
            $('#Password').attr('type', $(this).is(':checked') ? 'text' : 'password');
        });
    });
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
                            <a class="nav-link text-light" href="blog.php ">Blog</a>
                        </li>
                    </ul>
                </div>
                <?php
                // Verificar si hay una sesión iniciada
                if (isset($_SESSION['id_usuario'])) {
                    // Recuperar el ID de usuario de la sesión
                    $id_usuario = $_SESSION['id_usuario'];

                    // Consultar la información del usuario y su saldo desde la base de datos
                    $sql = "SELECT * FROM usuarios WHERE id_usuario = '$id_usuario'";
                    $resultado = $mysqli->query($sql);
                    $row = $resultado->fetch_assoc();


                    $nickname = $row['nickname'];
                    $nombre = $row['nombre'];
                    $apellido = $row['apellido'];
                    $correo = $row['correo'];
                    $dni = $row['dni'];
                    $direccion = $row['direccion'];
                    $pais = $row['pais'];
                    $genero = $row['genero'];
                    $ciudad = $row['ciudad'];
                    $cod_postal = $row['cod_postal'];
                    $fecha_nac = $row['fecha_nac'];
                    $telefono = $row['telefono'];
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

                            if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id_usuario'])) {
                                // Obtener el id_usuario de la solicitud GET
                                $id_usuario = $_GET['id_usuario'];

                                // Realizar la consulta SQL para obtener los detalles del usuario
                                $sql = "SELECT * FROM usuarios WHERE id_usuario = '$id_usuario'";
                                $resultado = $mysqli->query($sql);
                                $row = $resultado->fetch_assoc();

                                $nickname = $row['nickname'];
                                $nombre = $row['nombre'];
                                $apellido = $row['apellido'];
                                $correo = $row['correo'];
                                $dni = $row['dni'];
                                $direccion = $row['direccion'];
                                $pais = $row['pais'];
                                $genero = $row['genero'];
                                $ciudad = $row['ciudad'];
                                $cod_postal = $row['cod_postal'];
                                $fecha_nac = $row['fecha_nac'];
                                $telefono = $row['telefono'];
                                $saldo = $row['saldo'];
                                $estado = $row['estado'];
                                $rol_usuario = $row['rol_usuario'];
                            }
                ?>
            </div>
        </nav>

        <main>
            <div class="d-flex justify-content-center">
                <p class="h1 fw-bold p-4 text-white">EDITAR USUARIO</p>
            </div>
            <div class="row justify-content-center align-items-center h-100">
                <div class="col-12 col-lg-9 col-xl-19">
                    <div class="card shadow-2-strong card-registration rounded-4 bg-dark bg-gradient mb-5">
                        <div class="card-body p-md-5 text-light">
                            <div class="d-flex justify-content-end pb-3">
                                <a href="gestion_usuarios.php" class="btn btn-info text-light">Volver</a>
                            </div>
                            <form action="editar_usuario2.php" method="POST">
                                <input type="hidden" name="id_usuario" value="<?php echo $id_usuario ?>"/>
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <div data-mdb-input-init class="form-outline">
                                            <input type="text" name="nombre" class="form-control" value="<?php echo $nombre ?>" required />
                                            <label class="form-label">Nombre</label>
                                        </div>
                                        <div data-mdb-input-init class="form-outline">
                                            <input type="text" name="apellido" class="form-control" value="<?php echo $apellido ?>" required />
                                            <label class="form-label">Apellido</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <div data-mdb-input-init class="form-outline">
                                            <input type="text" name="usuario" class="form-control" value="<?php echo $nickname ?>" required />
                                            <label class="form-label">Nickname</label>
                                        </div>
                                        <div data-mdb-input-init class="form-outline">
                                            <input type="text" name="dni" class="form-control" pattern="\d{8}[a-zA-Z]" title="El formato del DNI no es válido" value="<?php echo $dni ?>" required />
                                            <label class="form-label">DNI</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-5 mb-4">
                                        <select class="form-control" aria-label="Default select" name="rol_usuario" required>
                                            <option value="usuario" <?php if ($rol_usuario == "usuario") echo " selected"; ?>>Usuario</option>
                                            <option value="admin" <?php if ($rol_usuario == "admin") echo " selected"; ?>>Admin</option>
                                        </select>
                                        <label class="form-label">Rol Usuario</label>
                                    </div>

                                    <div class="col-md-4 mb-4">
                                        <select class="form-control" aria-label="Default select" name="estado" required>
                                            <option value="A" <?php if ($estado == "A") echo " selected"; ?>>Activo</option>
                                            <option value="B" <?php if ($estado == "B") echo " selected"; ?>>Bloqueado</option>
                                        </select>
                                        <label class="form-label">Estado</label>
                                    </div>
                                    <div class="col-md-3 mb-4">
                                        <div data-mdb-input-init class="form-outline">
                                            <input type="number" name="saldo" class="form-control" value="<?php echo $saldo ?>" step="0.01" min="0" required />
                                            <label class="form-label">Saldo</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-center">
                                    <input data-mdb-button-init data-mdb-ripple-init class="btn btn-success btn-lg bg-gradient" type="submit" value="Guardar" />
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php
                        } else {
                            header("location: index.php");
        ?>
    </header>
    </main>

<?php
                        }
                    } else {
                        header("location: usuario_bloq.php");
                    }
                    // Cerrar la conexión a la base de datos
                    $mysqli->close();
                } else {
                    // Si no hay sesión iniciada, mostrar los botones de Login y Register
                    header("location: index.php");
                }
?>
</body>

</html>