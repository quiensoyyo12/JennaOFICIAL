<?php
$idUsuarios = $_POST['id'] ?? null;
$usuario = $_POST['Nombre'] ?? '';
$Apellido = $_POST['Apellido_paterno'] ?? '';
$ApellidoM = $_POST['Apellido_materno'] ?? '';
$Correo = $_POST['correo'] ?? '';
$Password = $_POST['contrasena'] ?? '';

include 'conexion.php'; // Asegúrate de que la ruta sea correcta

if ($conexion) {
    $Consulta = "INSERT INTO usuario (id, nombre, apellido_paterno, apellido_materno, correo, contrasena) 
                 VALUES ('$idUsuarios', '$usuario', '$Apellido', '$ApellidoM', '$Correo', '$Password')";
    $resultado = mysqli_query($conexion, $Consulta);

    // Redirección con el estado del resultado
    if ($resultado) {
        header("Location: UsuariosAdmin.php?success=true");
    } else {
        $error = mysqli_error($conexion);
        header("Location: UsuariosAdmin.php?success=false&error=" . urlencode($error));
    }

    mysqli_close($conexion);
} else {
    $error = mysqli_connect_error();
    header("Location: UsuariosAdmin.php?success=false&error=" . urlencode($error));
}
?>
