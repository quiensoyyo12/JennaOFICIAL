<?php
header('Content-Type: application/json');
$conexion = mysqli_connect("localhost", "root", "", "jennawork") or die("Error de conexión");

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