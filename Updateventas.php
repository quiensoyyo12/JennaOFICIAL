<?php
header('Content-Type: application/json');
include 'conexion.php'; // Asegúrate de que la ruta sea correcta

$idVentas = $_POST['idVentas'];
$total = $_POST['total'];
$fecha = $_POST['Fecha_venta'];
$idPedidos = $_POST['idPedidos'];

$query = "UPDATE ventas SET 
            total = '$total', 
            Fecha_venta = '$fecha',
            idPedidos = '$idPedidos'
          WHERE idVentas = '$idVentas'";

if (mysqli_query($conexion, $query)) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => mysqli_error($conexion)]);
}
mysqli_close($conexion);
?>
