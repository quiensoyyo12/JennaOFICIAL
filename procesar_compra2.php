<?php
include 'conexion.php';

// Verificar si los datos se han recibido
$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['idProducto'], $data['total'])) {
    $idProducto = intval($data['idProducto']);
    $total = floatval($data['total']);

    // Insertar en la tabla ventas
    $fechaVenta = date('Y-m-d H:i:s');
    $queryVenta = "INSERT INTO ventas (total, Fecha_venta) VALUES ($total, '$fechaVenta')";

    if (!mysqli_query($conexion, $queryVenta)) {
        echo json_encode([
            'success' => false,
            'message' => "Error al insertar en 'ventas': " . mysqli_error($conexion)
        ]);
        exit;
    }

    // Respuesta exitosa
    echo json_encode([
        'success' => true,
        'message' => 'Compra realizada exitosamente.'
    ]);
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Datos inválidos o incompletos.'
    ]);
}

mysqli_close($conexion);
?>

