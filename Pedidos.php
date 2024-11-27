<?php
// Conexión a la base de datos
include 'conexion.php'; // Asegúrate de que la ruta sea correcta

// Recibir datos del formulario
$idPedidos = $_POST['idPedidos']; // Este campo puede estar vacío, ya que es autoincremental
$Cantidad_Pedidos = $_POST['Cantidad_Pedidos'];
$FechaEntrega_Pedidos = $_POST['FechaEntrega_Pedidos'];
$Total = $_POST['Total'];

// Validar que los datos no estén vacíos
if (!empty($Cantidad_Pedidos) && !empty($FechaEntrega_Pedidos) && !empty($Total)) {
    // Insertar datos en la tabla "pedidos"
    $consulta = "INSERT INTO pedidos (Cantidad_Pedidos, FechaEntrega_Pedidos, Total) 
                 VALUES ('$Cantidad_Pedidos', '$FechaEntrega_Pedidos', '$Total')";

    $resultado = mysqli_query($conexion, $consulta);

    // Redirigir con éxito o error
    if ($resultado) {
        header("Location: PedidosA.php?success=true");
    } else {
        $error = mysqli_error($conexion);
        header("Location: PedidosA.php?success=false&error=" . urlencode($error));
    }
} else {
    header("Location: PedidosA.php?success=false&error=" . urlencode("Por favor, complete todos los campos."));
}

// Cerrar la conexión
mysqli_close($conexion);
?>
