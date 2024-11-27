<?php
header('Content-Type: application/json');
include 'conexion.php'; // Asegúrate de que la ruta sea correcta

$idPermisos = $_POST['idPermisos'];
$reportes = $_POST['reportes'];
$consultas = $_POST['consultas'];

$query = "UPDATE permisos SET 
            reportes = '$reportes', 
            consultas = '$consultas'
          WHERE idPermisos = '$idPermisos'";

if (mysqli_query($conexion, $query)) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => mysqli_error($conexion)]);
}
mysqli_close($conexion);
?>
