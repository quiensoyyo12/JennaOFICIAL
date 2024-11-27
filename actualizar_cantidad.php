<?php
// Conexión a la base de datos
include 'conexion.php'; // Asegúrate de que la ruta sea correcta
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);

    $idProducto = $input['idProducto'];
    $nuevaCantidad = $input['nuevaCantidad'];

    // Validar los datos
    if (is_numeric($idProducto) && is_numeric($nuevaCantidad) && $nuevaCantidad >= 0) {
        // Actualizar la cantidad en la base de datos
        $consulta = "UPDATE productos SET Cantidad_Productos = Cantidad_Productos - $nuevaCantidad WHERE idProductos = $idProducto";
        $resultado = mysqli_query($conexion, $consulta);

        if ($resultado) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Error en la consulta.']);
        }
    } else {
        echo json_encode(['success' => false, 'error' => 'Datos inválidos.']);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Método no permitido.']);
}

// Cerrar la conexión
mysqli_close($conexion);
