<?php
header('Content-Type: application/json');
include 'conexion.php'; // Asegúrate de que la ruta sea correcta

$id = $_POST['id'];
$idVentas = $_POST['idVentas'];
$idProductos = $_POST['idProductos'];
$cantidad = $_POST['Cantidad'];

$query = "UPDATE detalle_venta SET 
          idVentas = '$idVentas', 
          idProductos = '$idProductos', 
          Cantidad = '$cantidad' 
          WHERE id = '$id'";

if (mysqli_query($conexion, $query)) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => mysqli_error($conexion)]);
}
mysqli_close($conexion);
?>
