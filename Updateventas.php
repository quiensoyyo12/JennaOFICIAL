<?php
header('Content-Type: application/json');
$conexion = mysqli_connect("localhost", "root", "", "jennawork") or die("Error de conexión");

$idVentas = $_POST['idVentas'];
$total = $_POST['total'];
$fecha = $_POST['Fecha_venta'];
$idEmpleados = $_POST['idEmpleados'];
$idPedidos = $_POST['idPedidos'];

$query = "UPDATE ventas SET 
            total = '$total', 
            Fecha_venta = '$fecha', 
            idEmpleados = '$idEmpleados', 
            idPedidos = '$idPedidos'
          WHERE idVentas = '$idVentas'";

if (mysqli_query($conexion, $query)) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => mysqli_error($conexion)]);
}
mysqli_close($conexion);
?>