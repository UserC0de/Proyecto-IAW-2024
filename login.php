<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Casino LA CAMPIÑA</title>
  <script src="script.js"></script>
  <link rel="stylesheet" href="css/bootstrap.css">
</head>

<body class="d-flex justify-content-center align-items-center vh-100" style="background-image: url('fotos/casino.jpeg'); background-size: cover; background-position: center">
  <form action="login2.php" method="post">
    <div class="bg-white p-5 rounded-5 text-secondary shadow" style="width: 25rem">
      <div class="d-flex justify-content-center">
        <img src="fotos/login-icon.svg" style="height: 7rem" />
      </div>
      <div class="text-center fs-1 fw-bold">Login</div>
      <div class="input-group mt-4">
        <div class="input-group-text bg-info">
          <img src="fotos/username-icon.svg" style="height: 1rem" />
        </div>
        <input class="form-control bg-light" type="text" placeholder="Username" name="usuario" />
      </div>
      <div class="input-group mt-1">
        <div class="input-group-text bg-info">
          <img src="fotos/password-icon.svg" style="height: 1rem" />
        </div>
        <input class="form-control bg-light" type="password" placeholder="Password" name="password"/>
      </div>
      <div class="d-flex justify-content-around mt-1">
        <div class="pt-1">
          <a href="#" class="text-decoration-none text-info fw-semibold fst-italic" style="font-size: 0.9rem">Forgot your password?</a>
        </div>
      </div>
      <div class="p-2">
        <input class="btn btn-info d-flex text-white fw-semibold shadow-sm m-auto w-100" type="submit" value="Login">
      </div>
      <div class="d-flex gap-1 justify-content-center mt-1">
        <div>Don't have an account?</div>
        <a href="register.php" class="text-decoration-none text-info fw-semibold">Register</a>
      </div>
    </div>
  </form>
</body>

</html>