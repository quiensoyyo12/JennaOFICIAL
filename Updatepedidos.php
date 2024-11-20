<?php
// Configuración para manejar JSON
header('Content-Type: application/json');

// Conexión a la base de datos
$conexion = mysqli_connect("localhost", "root", "", "jennawork") or die(json_encode(['success' => false, 'message' => 'Error en la conexión a la base de datos.']));

// Obtención de datos enviados desde el formulario
$idPedidos = $_POST['idPedidos'];
$Cantidad_Pedidos = $_POST['Cantidad_Pedidos'];
$FechaEntrega_Pedidos = $_POST['FechaEntrega_Pedidos'];
$Total = $_POST['Total'];
$idProveedor = $_POST['idProveedor'];

// Validación de datos
if (empty($idPedidos) || empty($Cantidad_Pedidos) || empty($FechaEntrega_Pedidos) || empty($Total) || empty($idProveedor)) {
    echo json_encode(['success' => false, 'message' => 'Faltan datos obligatorios.']);
    exit;
}

// Consulta para actualizar los datos
$consulta = "UPDATE pedidos 
             SET Cantidad_Pedidos='$Cantidad_Pedidos', 
                 FechaEntrega_Pedidos='$FechaEntrega_Pedidos', 
                 Total='$Total', 
                 idProveedor='$idProveedor' 
             WHERE idPedidos='$idPedidos'";

// Ejecución de la consulta
$resultado = mysqli_query($conexion, $consulta);

// Verifica si la consulta fue exitosa
if ($resultado) {
    echo json_encode(['success' => true, 'message' => 'Pedido actualizado correctamente.']);
} else {
    echo json_encode(['success' => false, 'message' => 'Error al actualizar el pedido.']);
}

// Cierre de conexión
mysqli_close($conexion);
