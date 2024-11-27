<?php
// Configuración para manejar JSON
header('Content-Type: application/json');
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Conexión a la base de datos
include 'conexion.php'; // Asegúrate de que la ruta sea correcta

if (!$conexion) {
    echo json_encode(['success' => false, 'message' => 'Error en la conexión a la base de datos: ' . mysqli_connect_error()]);
    exit;
}

// Obtención de datos enviados desde el formulario
$idPedidos = mysqli_real_escape_string($conexion, $_POST['idPedidos']);
$Cantidad_Pedidos = mysqli_real_escape_string($conexion, $_POST['Cantidad_Pedidos']);
$FechaEntrega_Pedidos = mysqli_real_escape_string($conexion, $_POST['FechaEntrega_Pedidos']);
$Total = mysqli_real_escape_string($conexion, $_POST['Total']);

// Validación de datos
if (empty($idPedidos) || empty($Cantidad_Pedidos) || empty($FechaEntrega_Pedidos) || empty($Total)) {
    echo json_encode(['success' => false, 'message' => 'Faltan datos obligatorios.']);
    exit;
}

// Consulta para actualizar los datos
$consulta = "UPDATE pedidos 
             SET Cantidad_Pedidos='$Cantidad_Pedidos', 
                 FechaEntrega_Pedidos='$FechaEntrega_Pedidos', 
                 Total='$Total'
             WHERE idPedidos='$idPedidos'";

// Ejecución de la consulta
$resultado = mysqli_query($conexion, $consulta);

if (!$resultado) {
    echo json_encode([
        'success' => false,
        'message' => 'Error al ejecutar la consulta: ' . mysqli_error($conexion)
    ]);
} else {
    echo json_encode(['success' => true, 'message' => 'Pedido actualizado correctamente.']);
}

// Cierre de conexión
mysqli_close($conexion);
?>