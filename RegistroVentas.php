<?php
$idVentas = $_POST['idVentas'] ?? null;
$total = $_POST['total'] ?? 0;
$Fecha_venta = $_POST['Fecha_venta'] ?? null;


include 'conexion.php'; // Asegúrate de que la ruta sea correcta

if ($conexion) {
    $consulta = "INSERT INTO ventas (idVentas, total, Fecha_venta) 
                 VALUES ('$idVentas', '$total', '$Fecha_venta')";

    $resultado = mysqli_query($conexion, $consulta);

    // Redirige con el estado del resultado
    if ($resultado) {
        header("Location: RegistroVentasAdmin.php?success=true");
    } else {
        $error = mysqli_error($conexion);
        header("Location: RegistroVentasAdmin.php?success=false&error=" . urlencode($error));
    }

    mysqli_close($conexion);
} else {
    $error = mysqli_connect_error();
    header("Location: RegistroVentasAdmin.php?success=false&error=" . urlencode($error));
}
?>
