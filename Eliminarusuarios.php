<?php
header('Content-Type: application/json');

// Conexión a la base de datos
$conexion = mysqli_connect("localhost", "root", "", "jennawork") or die("Error de conexión");

// Obtener el ID enviado por POST
$id = $_POST['id'] ?? null;

if ($id) {
    $query = "DELETE FROM usuario WHERE id = '$id'";
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
