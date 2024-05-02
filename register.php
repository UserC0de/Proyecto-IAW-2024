<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="javascript" href="script.js">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="Miestilos.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<script type="text/javascript">
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

    $(document).ready(function () {
        //CheckBox mostrar contraseña
        $('#ShowPassword').click(function () {
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

    $(document).ready(function () {
        //CheckBox mostrar contraseña
        $('#ShowPassword').click(function () {
            $('#Password').attr('type', $(this).is(':checked') ? 'text' : 'password');
        });
    });
</script>


<body style="background-image: url('fotos/casino.jpeg');">
    <section class="vh-100">
        <div class="container py-5 h-100">
            <div class="row justify-content-center align-items-center h-100">
                <div class="col-12 col-lg-9 col-xl-19">
                    <div
                        class="card shadow-2-strong card-registration border border-dark rounded-4 bg-dark bg-gradient">
                        <div class="card-body p-md-5 text-light">
                            <div class="d-flex justify-content-end">
                                <a href="index.php" class="btn btn-info text-light">Volver al inicio</a>
                            </div>
                            <h3 class="mb-4 pb-2 pb-md-0 mb-md-5 d-flex justify-content-center fw-bold">REGISTRO</h3>
                            <form action="register2.php" method="POST">
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <div data-mdb-input-init class="form-outline">
                                            <input type="text" name="nombre" class="form-control" required />
                                            <label class="form-label">Nombre</label>
                                        </div>
                                        <div data-mdb-input-init class="form-outline">
                                            <input type="text" name="apellido" class="form-control" required />
                                            <label class="form-label">Apellido</label>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-4">
                                        <div data-mdb-input-init class="form-outline">
                                            <input type="text" name="usuario" class="form-control" required />
                                            <label class="form-label">Nickname</label>
                                        </div>
                                        <div data-mdb-input-init class="form-outline">
                                            <input type="text" name="dni" class="form-control" pattern="\d{8}[a-zA-Z]" title="El formato del DNI no es válido" required />
                                            <label class="form-label">DNI</label>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-4">
                                        <div data-mdb-input-init class="form-outline">
                                            <input type="text" name="direccion" class="form-control" required />
                                            <label class="form-label">Dirección</label>
                                        </div>
                                    </div>

                                    <div class="col-md-2 mb-4">
                                        <div data-mdb-input-init class="form-outline">
                                            <input type="text" name="pais" class="form-control" required />
                                            <label class="form-label">Pais</label>
                                        </div>
                                    </div>

                                    <div class="col-md-2 mb-4">
                                        <div data-mdb-input-init class="form-outline">
                                            <input type="text" name="ciudad" class="form-control" required />
                                            <label class="form-label">Ciudad</label>
                                        </div>
                                    </div>

                                    <div class="col-md-2 mb-4">
                                        <div data-mdb-input-init class="form-outline">
                                            <input type="text" name="cod_postal" class="form-control" required />
                                            <label class="form-label">Código Postal</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-4 d-flex align-items-center">
                                        <div data-mdb-input-init class="form-outline datepicker w-100">
                                            <input type="date" name="fecha_nac" class="form-control" required />
                                            <label class="form-label">Fecha de Nacimiento</label>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-4">
                                        <!-- Categoría -->
                                        <select class="form-control" aria-label="Default select" name="genero" required>
                                            <option value="Masculino">Hombre</option>
                                            <option value="Femenino">Mujer</option>
                                        </select>
                                        <label class="form-label">Género</label>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-4 pb-2">
                                        <div data-mdb-input-init class="form-outline">
                                            <input type="email" name="email" class="form-control" required />
                                            <label class="form-label">Email</label>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-4 pb-2">

                                        <div data-mdb-input-init class="form-outline">
                                            <input type="tel" name="telefono" class="form-control" pattern="[0-9]{9}" title="El formato del teléfono no es válido. Debe contener 9 números." required />
                                            <label class="form-label">Número de teléfono</label>
                                        </div>

                                    </div>
                                    <div class="col-md-6 mb-4 pb-2">
                                        <div data-mdb-input-init class="form-outline input-group">
                                            <div class="input-group-text bg-info">
                                                <img src="fotos/password-icon.svg" style="height: 1rem"/>
                                              </div>
                                            <input type="password" name="password" id="txtPassword"
                                                class="form-control" pattern="(?=.*\d)(?=.*[A-Z]).{8,}" title="Mínimo 8 caráteres, 1 mayuscula y 1 número" required />
                                            <div class="input-group-append">
                                                <button id="show_password" class="btn btn-primary" type="button"
                                                    onclick="mostrarPassword()"> <span
                                                        class="fa fa-eye-slash icon"></span> </button>
                                            </div>
                                        </div>
                                        <label class="form-label">Contraseña</label>
                                    </div>

                                    <div class="col-md-6 mb-4 pb-2">
                                        <div data-mdb-input-init class="form-outline input-group">
                                            <div class="input-group-text bg-info">
                                                <img src="fotos/password-icon.svg" style="height: 1rem"/>
                                              </div>
                                            <input type="password" name="password2" id="txtPassword2"
                                                class="form-control" required />
                                            <div class="input-group-append">
                                                <button id="show_password" class="btn btn-primary" type="button"
                                                    onclick="mostrarPassword2()"> <span
                                                        class="fa fa-eye-slash icon"></span> </button>
                                            </div>
                                        </div>
                                        <label class="form-label">Repite la contraseña</label>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" required>
                                        <label class="form-check-label" for="terminos_condiciones">
                                            Acepto los términos y condiciones
                                        </label>
                                    </div>
                                    <div class="d-flex justify-content-center">
                                        <input data-mdb-button-init data-mdb-ripple-init
                                            class="btn btn-success btn-lg bg-gradient" type="submit"
                                            value="Registrarse" />
                                    </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>