<?php
include 'conexion.php';

// Obtener datos del carrito
$queryCarrito = "SELECT * FROM carrito";
$resultadoCarrito = mysqli_query($conexion, $queryCarrito);

if (mysqli_num_rows($resultadoCarrito) > 0) {
    // Calcular el total de la venta
    $total = 0;
    $productos = [];

    while ($producto = mysqli_fetch_assoc($resultadoCarrito)) {
        $subtotal = $producto['Precio'] * $producto['Cantidad_Productos'];
        $total += $subtotal;

        // Guardar datos del producto para detalle_venta y pedidos
        $productos[] = [
            'idProductos' => $producto['idProductos'],
            'Cantidad_Productos' => $producto['Cantidad_Productos']
        ];
    }

    // Insertar en la tabla ventas
    $fechaVenta = date('Y-m-d H:i:s');
    $queryVenta = "INSERT INTO ventas (total, Fecha_venta) VALUES ($total, '$fechaVenta')";
    if (!mysqli_query($conexion, $queryVenta)) {
        die("Error al insertar en 'ventas': " . mysqli_error($conexion));
    }

    // Obtener el ID de la venta recién creada
    $idVenta = mysqli_insert_id($conexion);
    if (!$idVenta) {
        die("Error: No se pudo obtener el ID de la venta.");
    }

    // Vaciar el carrito
    $queryVaciarCarrito = "DELETE FROM carrito";
    if (!mysqli_query($conexion, $queryVaciarCarrito)) {
        die("Error al vaciar el carrito: " . mysqli_error($conexion));
    }

    // Redirigir con mensaje de éxito
    header('Location: carrito.php?mensaje=compra_exitosa');
    exit;
} else {
    echo "El carrito está vacío. No se puede procesar la compra.";
}

mysqli_close($conexion);
?>
