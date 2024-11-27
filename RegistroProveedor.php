<?php
$idProveedor = $_POST['idProveedor'] ?? null;
$Nombre = $_POST['Nombre'] ?? '';
$ApellidoP = $_POST['ApellidoP'] ?? '';
$ApellidoM = $_POST['ApellidoM'] ?? '';
$RFC = $_POST['RFC'] ?? '';
$Telefono = $_POST['Telefono'] ?? '';
$Domicilio = $_POST['Domicilio'] ?? '';
$Correo = $_POST['Correo'] ?? '';

include 'conexion.php'; // Asegúrate de que la ruta sea correcta

if ($conexion) {
    $consulta = "INSERT INTO proveedor (idProveedor, Nombre, ApellidoP, ApellidoM, RFC, Telefono, Domicilio, Correo) 
                 VALUES ('$idProveedor', '$Nombre', '$ApellidoP', '$ApellidoM', '$RFC', '$Telefono', '$Domicilio', '$Correo')";

    $resultado = mysqli_query($conexion, $consulta);

    // Redirige con el estado del resultado
    if ($resultado) {
        header("Location: RegistroProveedorAdmin.php?success=true");
    } else {
        $error = mysqli_error($conexion);
        header("Location: RegistroProveedorAdmin.php?success=false&error=" . urlencode($error));
    }

    mysqli_close($conexion);
} else {
    $error = mysqli_connect_error();
    header("Location: RegistroProveedorAdmin.php?success=false&error=" . urlencode($error));
}
?>
