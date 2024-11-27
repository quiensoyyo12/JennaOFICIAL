<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    include 'conexion.php'; // Asegúrate de que la ruta sea correcta
    if (!$conexion) {
        die("Error de conexión: " . mysqli_connect_error());
    }

    // Validar y escapar datos
    $idEmpleados = intval($_POST['idEmpleados']);
    $Nombre = mysqli_real_escape_string($conexion, $_POST['Nombre']);
    $Apellido_p = mysqli_real_escape_string($conexion, $_POST['Apellido_p']);
    $Apellido_m = mysqli_real_escape_string($conexion, $_POST['Apellido_m']);
    $Correo = mysqli_real_escape_string($conexion, $_POST['Correo']);

    $Genero = mysqli_real_escape_string($conexion, $_POST['Genero']);
    $Telefono = mysqli_real_escape_string($conexion, $_POST['Telefono']);
    $RFC = mysqli_real_escape_string($conexion, $_POST['RFC']);
    $idTiposEmp = intval($_POST['idTiposEmp']);
    $idUsuario = intval($_POST['idUsuario']);

    // Consulta
    $Consulta = "INSERT INTO empleados (idEmpleados, Nombre, Apellido_p, Apellido_m, Correo,  Genero, Telefono, RFC, idTiposEmp, idUsuario) 
                 VALUES ('$idEmpleados', '$Nombre', '$Apellido_p', '$Apellido_m', '$Correo', '$Genero', '$Telefono', '$RFC', '$idTiposEmp', '$idUsuario')";

    // Ejecutar consulta
    if (mysqli_query($conexion, $Consulta)) {
        // Redirigir con mensaje de éxito
        header('Location: RegistroEmpleadosAdmin.php?success=true');
        exit;
    } else {
        echo "Error: " . $Consulta . "<br>" . mysqli_error($conexion);
    }

    // Cerrar conexión
    mysqli_close($conexion);
}
?>
