<?php
// Conectar a la base de datos
include 'conexion.php'; // Asegúrate de que la ruta sea correcta
if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

// Consultar IDs de productos
$query_productos = "SELECT idProducto FROM productos";
$resultado_productos = mysqli_query($conexion, $query_productos);

// Consultar IDs de pedidos
$query_pedidos = "SELECT idPedido FROM pedidos";
$resultado_pedidos = mysqli_query($conexion, $query_pedidos);

// Si se envían datos por POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $idDetalle_pedido = $_POST['idDetalle_pedido'];
    $idProductos = $_POST['idProductos'];
    $idPedidos = $_POST['idPedidos'];

    // Insertar los datos en la tabla detalle_pedido
    $consulta = "INSERT INTO detalle_pedido (idDetalle, idProducto, idPedido) VALUES ('$idDetalle_pedido', '$idProductos', '$idPedidos')";
    $resultado = mysqli_query($conexion, $consulta);

    if ($resultado) {
        // Redirigir con éxito
        header("Location: detalle_pedido1.php?success=true");
    } else {
        // Redirigir con error
        $error = mysqli_error($conexion);
        header("Location: detalle_pedido1.php?success=false&error=" . urlencode($error));
    }
}

// Guardar los resultados en variables para usarlos en el HTML
$productos_options = '';
while ($row = mysqli_fetch_assoc($resultado_productos)) {
    $productos_options .= "<option value='" . $row['idProducto'] . "'>" . $row['idProducto'] . "</option>";
}

$pedidos_options = '';
while ($row = mysqli_fetch_assoc($resultado_pedidos)) {
    $pedidos_options .= "<option value='" . $row['idPedido'] . "'>" . $row['idPedido'] . "</option>";
}

// Liberar resultados y cerrar la conexión
mysqli_free_result($resultado_productos);
mysqli_free_result($resultado_pedidos);
mysqli_close($conexion);
?>
