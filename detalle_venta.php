<?php
$idDetalle_venta = $_POST['idDetalle_venta'] ?? null;
$idVenta = $_POST['idVentas'] ?? '';
$idProductos = $_POST['idProductos'] ?? '';
$Cantidad = $_POST['Cantidad'] ?? '';

include 'conexion.php'; // Asegúrate de que la ruta sea correcta

if ($conexion) {
    $Consulta = "INSERT INTO detalle_venta (idDetalle_venta, idVentas, idProductos, Cantidad) 
                 VALUES ('$idDetalle_venta', '$idVenta', '$idProductos', '$Cantidad')";
    $resultado = mysqli_query($conexion, $Consulta);

    if ($resultado) {
        header("Location: detalle_ventaAdmin.php?success=true");
    } else {
        $error = mysqli_error($conexion);
        header("Location: detalle_ventaAdmin.php?success=false&error=" . urlencode($error));
    }

    mysqli_close($conexion);
} else {
    $error = mysqli_connect_error();
    header("Location: detalle_ventaAdmin.php?success=false&error=" . urlencode($error));
}
?>
