<?php
header('Content-Type: application/json');

// Conexión a la base de datos
include 'conexion.php'; // Asegúrate de que la ruta sea correcta
// Obtener el ID enviado por POST
$id = $_POST['id'] ?? null;

if ($id) {
    $query = "DELETE FROM pedidos WHERE idPedidos = '$id'";
    if (mysqli_query($conexion, $query)) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => mysqli_error($conexion)]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'ID no válido']);
}

mysqli_close($conexion);
?>
