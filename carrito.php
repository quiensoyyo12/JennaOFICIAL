<?php
include 'conexion.php';

$query = "SELECT * FROM carrito";
$resultado = mysqli_query($conexion, $query);

echo "<h2>Carrito de Compras</h2>";
$total = 0;

if (mysqli_num_rows($resultado) > 0) {
    // Si hay productos en el carrito, los muestra
    while ($producto = mysqli_fetch_assoc($resultado)) {
        echo "<div>";
        echo "<h3>{$producto['Nombre_producto']}</h3>";
        echo "<p>Precio: {$producto['Precio']}</p>";
        echo "<p>Cantidad: {$producto['Cantidad_Productos']}</p>";
        echo "<p>Total: $" . $producto['Precio'] * $producto['Cantidad_Productos'] . "</p>";
        echo "<form method='post' action='eliminar_del_carrito.php'>";
        echo "<input type='hidden' name='idProductos' value='{$producto['idProductos']}'>";
        echo "<button type='submit'>Eliminar</button>";
        echo "</form>";
        $total += $producto['Precio'] * $producto['Cantidad_Productos'];
        echo "</div><hr>";
    }

    echo "<h3>Total a pagar: $" . number_format($total, 2) . "</h3>";
    echo "<form method='post' action='procesar_compra.php'>";
    echo "<button type='submit'>Finalizar compra</button>";
    echo "</form>";
} else {
    // Si no hay productos en el carrito, muestra un mensaje
    echo "<p>No hay productos en el carrito.</p>";
}
?>
