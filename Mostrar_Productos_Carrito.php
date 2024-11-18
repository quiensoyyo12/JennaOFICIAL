<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <header>
        
    </header>
<?php
include 'conexion.php';
session_start();

// Consultar los productos en el carrito
$query = "SELECT * FROM carrito";
$resultado = mysqli_query($conexion, $query);

if (!$resultado) {
    die("Error al cargar los productos del carrito: " . mysqli_error($conexion));
}

$total = 0;

if (mysqli_num_rows($resultado) > 0): ?>
    <table>
        <thead>
            <tr>
                <th>Producto</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Total</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        <?php while ($producto = mysqli_fetch_assoc($resultado)): ?>
            <tr>
                <td><?php echo htmlspecialchars($producto['Nombre_producto']); ?></td>
                <td>$<?php echo number_format($producto['Precio'], 2); ?></td>
                <td>
                    <form action="actualizar_carrito.php" method="post">
                        <input type="hidden" name="idProductos" value="<?php echo $producto['idProductos']; ?>">
                        <input type="number" name="Cantidad_Productos" value="<?php echo $producto['Cantidad_Productos']; ?>" min="1">
                        <button type="submit">Actualizar</button>
                    </form>
                </td>
                <td>$<?php echo number_format($producto['Precio'] * $producto['Cantidad_Productos'], 2); ?></td>
                <td>
                    <form action="eliminar_del_carrito.php" method="post">
                        <input type="hidden" name="idProductos" value="<?php echo $producto['idProductos']; ?>">
                        <button type="submit">Eliminar</button>
                    </form>
                </td>
            </tr>
            <?php $total += $producto['Precio'] * $producto['Cantidad_Productos']; ?>
        <?php endwhile; ?>
        </tbody>
    </table>
    <h3>Total: $<?php echo number_format($total, 2); ?></h3>
    <form method="post" action="procesar_compra.php">
        <button type="submit">Finalizar compra</button>
    </form>
<?php else: ?>
    <p>No hay productos en el carrito.</p>
<?php endif; ?>





</body>
</html>
