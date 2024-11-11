<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width" , initial-scale="1.0">
  <title>Login</title>
  <link rel="stylesheet" href="style.css">
  <link href='https://unpkg.com/boxicons@2.1.4/css/
  boxicons.min.css' rel='stylesheet'>
</head>

<body>
  <div class="wrapper">
    <form action="">
      <h1>INICIO DE SESION</h1>
      <div class="input-box">
        <input type="text" placeholder="Nombre de usuario" required>
        <i class='bx bxs-user'></i>
      </div>
      <div class="input-box">
        <input type="contraseña" placeholder="contraseña" required>
        <i class='bx bxs-lock-alt'></i>
      </div>

      <div class="remember-forgot">
        <label><input type="checkbox"> remember me</label>
        <a href="#">¿Olvidaste tu contraseña?</a>
      </div>
      <button type="submit" class="btn">Inicia sesion</button>
      <div class="register-link">
        <p>¿No tienes una cuenta? <a href="Registrate.php">Registrate</a></p>
      </div>
    </form>
  </div>
</body>

</html>