<?php
session_start();
include('db.php');

// Verificar conexión a la base de datos
if (mysqli_connect_errno()) {
    die("Error de conexión a la base de datos: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usu = mysqli_real_escape_string($conexion, $_POST['usuario']);
    $pass = mysqli_real_escape_string($conexion, $_POST['contrasena']);

    // Depuración: Mostrar los valores recibidos
    echo "Usuario recibido: " . htmlspecialchars($usu) . "<br>";
    echo "Contraseña recibida: " . htmlspecialchars($pass) . "<br>";

    // Consulta directa para obtener la contraseña almacenada
    $consulta = "SELECT contrasena FROM usuarios WHERE usuario = '$usu'";
    $resultado = mysqli_query($conexion, $consulta);

    // Depuración: Verificar si la consulta tiene errores
    if (!$resultado) {
        die('Error en la consulta: ' . mysqli_error($conexion));
    }

    $filas = mysqli_num_rows($resultado);

    // Depuración: Mostrar el número de filas encontradas
    echo "Número de filas encontradas: " . $filas . "<br>";

    if ($filas > 0) {
        $row = mysqli_fetch_assoc($resultado);
        $hashed_password = $row['contrasena'];

        // Depuración: Mostrar la contraseña almacenada
        echo "Contraseña almacenada (hash): " . htmlspecialchars($hashed_password) . "<br>";

        // Verificar la contraseña
        if (password_verify($pass, $hashed_password)) {
            $_SESSION['usuario'] = $usu;
            header("Location: ../index.html");
            exit();
        } else {
            echo '<script>
            alert("Contraseña incorrecta");
            window.location = "index.php";
            </script>';
            exit();
        }
    } else {
        echo '<script>
        alert("Usuario no existe");
        window.location = "index.php";
        </script>';
        exit();
    }

    mysqli_free_result($resultado);
    mysqli_close($conexion);
} else {
    echo '<script>
    alert("Método de solicitud no permitido");
    window.location = "index.php";
    </script>';
    exit();
}
?>