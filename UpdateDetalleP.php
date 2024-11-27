<?php
header('Content-Type: application/json');
include 'conexion.php'; // Asegúrate de que la ruta sea correcta

$id = $_POST['idDetalle_pedido'];
$idProductos = $_POST['idProductos'];
$idPedidos = $_POST['idPedidos'];

$query = "UPDATE detalle_pedido SET 
          idProductos = '$idProductos', 
          idPedidos = '$idPedidos' 
          WHERE idDetalle_pedido = '$id'";

if (mysqli_query($conexion, $query)) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => mysqli_error($conexion)]);
}
mysqli_close($conexion);
?>
