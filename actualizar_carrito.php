<?php
include 'conexion.php';
header('Content-Type: application/json');

$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['idProductos'], $data['action'])) {
    $idProductos = intval($data['idProductos']);
    $action = $data['action'];

    // Obtener cantidad actual
    $query = "SELECT * FROM carrito WHERE idProductos = $idProductos";
    $resultado = mysqli_query($conexion, $query);
    if ($producto = mysqli_fetch_assoc($resultado)) {
        $cantidadActual = intval($producto['Cantidad_Productos']);
        $precio = floatval($producto['Precio']);

        // Modificar cantidad según la acción
        if ($action === "increment") {
            $cantidadActual++;
        } elseif ($action === "decrement" && $cantidadActual > 1) {
            $cantidadActual--;
        } else {
            echo json_encode(["success" => false, "message" => "Cantidad mínima alcanzada."]);
            exit;
        }

        // Actualizar la base de datos
        $updateQuery = "UPDATE carrito SET Cantidad_Productos = $cantidadActual WHERE idProductos = $idProductos";
        mysqli_query($conexion, $updateQuery);

        // Calcular subtotal y total
        $newSubtotal = $cantidadActual * $precio;

        $totalQuery = "SELECT SUM(Precio * Cantidad_Productos) AS total FROM carrito";
        $totalResult = mysqli_query($conexion, $totalQuery);
        $newTotal = mysqli_fetch_assoc($totalResult)['total'];

        echo json_encode([
            "success" => true,
            "newQuantity" => $cantidadActual,
            "newSubtotal" => $newSubtotal,
            "newTotal" => $newTotal,
        ]);
    } else {
        echo json_encode(["success" => false, "message" => "Producto no encontrado."]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Datos incompletos."]);
}
?>
