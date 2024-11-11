<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <title>Inicio sesion</title>
</head>
<body>
    <div class="container" id="container">
        <div class="form-container sign-up">
            <form action="Registro.php" method="post">
                <h1>Crea tu cuenta</h1>
                <div class="social-icons">
                    <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
                </div>
                <br>
                <?php if (isset($_GET['error'])) { ?>
                    <p class="error"><?php echo $_GET['error']; ?></p>
                <?php } ?>
                <br>
                <?php if (isset($_GET['success'])) { ?>
                    <p class="success"><?php echo $_GET['success']; ?></p>
                <?php } ?>
                <br>
                <span></span>
                <input type="text" placeholder="Nombre completo" name="Nombre_Completo" required>
                <input type="text" placeholder="Usuario" name="usuario" required>
                <input type="password" placeholder="Contraseña" name="contrasena" required>
                <input type="password" placeholder="Repetir Contraseña" name="Rcontrasena" required>
                <button>Registrarse</button>
            </form>
        </div>
        <div class="form-container sign-in">
            <form action="validar.php" method="post">
                <h1>Inicio de sesión</h1>
                <div class="social-icons">
                    <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
                </div>
                <span>Apúrate</span>
                <input type="text" placeholder="Usuario" name="usuario" required>
                <input type="password" placeholder="Password" name="contrasena" required>
                <a href="#">¿Olvidaste tu contraseña?</a>
                <button type="submit" class="button">Iniciar sesión</button>
            </form>
        </div>
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1>Inicia sesión si tienes cuenta</h1>
                    <p>No pierdas el tiempo y realiza tu sesión</p>
                    <button class="hidden" id="login">Iniciar sesión</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <h1>¿No tienes cuenta?</h1>
                    <p>Entra aquí para realizar tu registro</p>
                    <button class="hidden" id="register">Registrarse</button>
                </div>
            </div>
        </div>
    </div>
    <script src="script.js"></script>
</body>
</html>