<?php
include 'conexion.php';

// Aquí puedes agregar la lógica para almacenar el pedido en otra tabla de "pedidos", enviar confirmaciones, etc.

$query = "DELETE FROM carrito"; // Vacia el carrito después de la compra
mysqli_query($conexion, $query);

echo "<p>¡Compra realizada con éxito!</p>";
?>
