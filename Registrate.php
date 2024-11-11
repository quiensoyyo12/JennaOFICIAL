<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style5.css">
    <title>Registro</title>
</head>

<body>
    <section class="wrapper">
        <form action="Registrarse.php" method="post">
            <h1>Registrate</h1>

            <br>
            <?php if (isset($_GET['error'])) { ?>
                <p class="error"><?php echo $_GET['error'] ?></p>
                <?php }?>
            <br>
            <?php if (isset($_GET['success'])) { ?>
                <p class="success"><?php echo $_GET['success'] ?></p>
                <?php }?>
                <br>

            <div class="input-box">
                <input type="text" placeholder="Usuario" name="usuario" required>
                <i class='bx bxs-user'></i>
            </div>
            <div class="input-box">
                <input type="text" placeholder="Nombre completo" name="Nombre_Completo" required>
                <i class='bx bxs-user'></i>
            </div>
            <div class="input-box">
                <input type="password" placeholder="Contraseña" name="contrasena" required>
                <i class='bx bxs-lock-alt'></i>
            </div>
            <div class="input-box">
                <input type="password" placeholder="Repetir Contraseña" name="Rcontrasena" required>
                <i class='bx bxs-lock-alt'></i>
            </div>
            <input type="submit" class="btn" value="Registrarse"></input>
            <a href="index.php" class="Boton_ingresar">Iniciar sesion</a>
            </div>
    
    </form>
    </section>
</body>
</html>