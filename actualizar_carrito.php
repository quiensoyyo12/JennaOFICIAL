<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
include('conexion.php'); // Conexión a la base de datos

if (isset($_POST['idProductos']) && isset($_POST['Cantidad_Productos'])) {
    $idProductos = $_POST['idProductos'];
    $Cantidad_Productos = $_POST['Cantidad_Productos'];

    // Actualizar la cantidad del producto en el carrito
    $query = "UPDATE carrito SET Cantidad_Productos = $Cantidad_Productos WHERE idProductos = $idProductos";
    mysqli_query($conexion, $query);
}

// Redirigir de vuelta a la página del carrito
header('Location: Mostrar_Productos_Carrito.php');
exit;
?>

</body>
</html>