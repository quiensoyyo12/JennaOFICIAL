<?php
// Conexión a la base de datos
include 'conexion.php'; // Asegúrate de que la ruta sea correcta
if (!$conexion) {
    die("Error al conectar con la base de datos: " . mysqli_connect_error());
}

// Iniciar sesión
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    $correo = $_POST['correo'];
    $contrasena = $_POST['contrasena'];

    // Consulta para verificar credenciales
    $consulta = "SELECT * FROM usuario WHERE correo = '$correo' AND contrasena = '$contrasena'";
    $resultado = mysqli_query($conexion, $consulta);
    $fila = mysqli_fetch_assoc($resultado);

    // Si hay una fila en el resultado, las credenciales son correctas
    if(mysqli_num_rows($resultado) > 0) {
        session_start();
        $_SESSION['id'] = $fila['id'];
        $_SESSION['tipo_usuario'] = $fila['tipo_usuario']; // Guardar el tipo de usuario en la sesión

        // Redirigir según el tipo de usuario
        if ($_SESSION['tipo_usuario'] == 'admin') {
            header("Location: inicioAdmin.php"); // Redirigir a la página de administrador
        } elseif ($_SESSION['tipo_usuario'] == 'cliente') {
            header("Location: inicio.php"); // Redirigir a la página de cliente
        } elseif ($_SESSION['tipo_usuario'] == 'auxiliar') {
            header("Location: inicio2.php"); // Redirigir a la página de auxiliar
        } else {
            $error = "Tipo de usuario no reconocido";
        }
        exit();
    } else {
        $error = "Correo o contraseña incorrectos";
    }
}

// Registro de usuarios
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['registro'])) {
    $nombre = $_POST['Nombre'];
    $apellido_paterno = $_POST['Apellido_paterno'];
    $apellido_materno = $_POST['Apellido_materno'];
    $correo2 = $_POST['correo'];
    $password = $_POST['contrasena'];

    include 'conexion.php'; // Asegúrate de que la ruta sea correcta
    // Insertar nuevo usuario en la base de datos
    $consulta_insertar = "INSERT INTO `usuario`(`Nombre`, `Apellido_paterno`, `Apellido_materno`, `correo`, `contrasena`, `tipo_usuario`) 
    VALUES ('$nombre', '$apellido_paterno', '$apellido_materno', '$correo2', '$password', 'cliente')"; // Se agrega 'cliente' por defecto

    $resultado = mysqli_query($conexion2, $consulta_insertar);

    if ($resultado == 1) {
        header("Location: index.php");
        mysqli_close($conexion2); // Cierra la conexión a la base de datos
    } else {
        $error_registro = "Error al registrar el usuario: " . mysqli_error($conexion2);
        mysqli_close($conexion2); // Cierra la conexión a la base de datos
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="logins.css">
    <title>Login Registro</title>
</head>

<body>
    <main>
        <div class="container_general">
            <div class="fondo_general col-11">
                <div class="fondo_login">
                    <h3 class="lemon-regular">¿Ya tienes una Cuenta?</h3>
                    <p><i>Inicia Sesión para entrar a la Página</i></p>
                    <button id="btn_sesion">Iniciar Sesión</button>
                </div>
                <div class="fondo_registro">
                    <h3 class="lemon-regular">¿Aún no tienes una Cuenta?</h3>
                    <p><i>Regístrate para que puedas Iniciar Sesión</i></p>
                    <button id="btn_registro">Registrate</button>
                </div>
            </div>

            <div class="container_login_registro">
                <!--Formulario de login-->
                <form class="form_login" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                    <h2 class="lemon-regular">Iniciar Sesión</h2>

                    <!-- Mostrar error si existe -->
                    <?php if (isset($error)) {
                        echo "<p style='color: red;'>$error</p>";
                    } ?>

                    <input type="email" id="correo" name="correo" placeholder="Correo Electrónico" required>
                    <input type="password" id="contrasena" name="contrasena" placeholder="Contraseña" required>
                    <input type="submit" name="login" value="Entrar">
                </form>

                <!--Formulario de registro-->
                <form class="form_registro" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <h2 class="lemon-regular">Registrate</h2>
                    <?php
                    if (isset($error_registro)) {
                        echo "<p>$error_registro</p>";
                    }
                    ?>

                    <input type="text" name="Nombre" id="Nombre" placeholder="Nombre Completo">
                    <input type="text" name="Apellido_paterno" id="Apellido_paterno" placeholder="Apellido Paterno">
                    <input type="text" name="Apellido_materno" id="Apellido_materno" placeholder="Apellido Materno">
                    <input type="email" name="correo" id="correo" placeholder="Correo Electronico">
                    <input type="password" name="contrasena" id="contrasena" placeholder="Password">
                    <input type="submit" value="Registarase" name="registro">
                </form>

            </div>
        </div>
        <script>
            document.getElementById("btn_registro").addEventListener("click", register);
            document.getElementById("btn_sesion").addEventListener("click", sesion);
            window.addEventListener("resize", anchopagina);
            //declaración de variables
            var container_login_registro = document.querySelector(".container_login_registro");
            var form_login = document.querySelector(".form_login");
            var form_registro = document.querySelector(".form_registro");
            var fondo_login = document.querySelector(".fondo_login");
            var fondo_registro = document.querySelector(".fondo_registro");

            function anchopagina() {
                if (window.innerWidth > 850) {
                    fondo_login.style.display = "block";
                    fondo_registro.style.display = "block";
                } else {
                    fondo_registro.style.display = "block";
                    fondo_registro.style.opacity = "1";
                    fondo_login.style.display = "none";
                    form_login.style.display = "block";
                    form_registro.style.display = "none";
                    container_login_registro.style.left = "0px";
                }
            }

            anchopagina();

            function sesion() {
                if (window.innerWidth > 850) {
                    container_login_registro.style.left = "10px";
                    form_registro.style.display = "none";
                    form_login.style.display = "block";
                    fondo_registro.style.opacity = "1";
                    fondo_login.style.opacity = "0";
                } else {
                    container_login_registro.style.left = "0px";
                    form_registro.style.display = "none";
                    form_login.style.display = "block";
                    fondo_registro.style.display = "block";
                    fondo_login.style.display = "none";
                }
            }

            function register() {
                if (window.innerWidth > 850) {
                    container_login_registro.style.left = "410px";
                    form_registro.style.display = "block";
                    form_login.style.display = "none";
                    fondo_registro.style.opacity = "0";
                    fondo_login.style.opacity = "1";
                } else {
                    container_login_registro.style.left = "0px";
                    form_registro.style.display = "block";
                    form_login.style.display = "none";
                    fondo_registro.style.display = "none";
                    fondo_login.style.display = "block";
                    fondo_login.style.opacity = "1";
                }
            }
        </script>
    </main>



</body>

</html>