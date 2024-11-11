<?php
// Conectar a la base de datos
$conexion = mysqli_connect("localhost", "root", "", "jennawork") or die("Error en la conexión con la base de datos");

// Consulta para obtener los productos
$consulta = "SELECT idProductos, Tipo_Productos, Nombre_producto, Precio, imagen FROM productos";
$resultado = mysqli_query($conexion, $consulta);

if (!$resultado) {
    die("Error al obtener los productos: " . mysqli_error($conexion));
}

// Mostrar los productos en cards
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mostrar Productos</title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" />
    <style>
        .card img {
            height: 200px;
            object-fit: cover;
        }

        .card {
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <div class="container my-4">
        <div class="row">
            <?php while ($producto = mysqli_fetch_assoc($resultado)): ?>
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4"> <!-- Añadido margen inferior para separación -->
                    <div class="card h-100"> <!-- Añadido h-100 para que las tarjetas tengan la misma altura -->
                        <?php
                        // Asumiendo que la ruta de la imagen en la base de datos es correcta
                        $imagen = !empty($producto['imagen'])
                            ? htmlspecialchars($producto['imagen'])
                            : 'imagenes/default.jpg'; // Ruta de la imagen por defecto
                            if (!empty($producto['imagen'])) {
                                $imagen = htmlspecialchars($producto['imagen']);
                                if (!file_exists($imagen)) {
                                    error_log("La imagen no existe: " . $imagen);
                                }
                            } else {
                                $imagen = 'imagenes/default.jpg';
                            }
                        ?>
                        <img
                            src="<?php echo $imagen; ?>"
                            class="card-img-top"
                            alt="<?php echo htmlspecialchars($producto['Nombre_producto'] ?? 'Producto'); ?>">
                            
                        <div class="card-body">
                            <h5 class="card-title">
                                <?php echo htmlspecialchars($producto['Nombre_producto'] ?? 'No disponible'); ?>
                            </h5>
                            <p class="card-text">
                                <strong>Categoría:</strong> <?php echo htmlspecialchars($producto['Tipo_Productos'] ?? 'No disponible'); ?><br>
                                <strong>Precio:</strong> $<?php echo is_numeric($producto['Precio']) ? number_format($producto['Precio'], 2) : 'No disponible'; ?>
                            </p>
                            <!-- Botón para agregar al carrito -->
                            <button class="btn btn-primary btn-sm" onclick="agregarAlCarrito(<?php echo (int)$producto['idProductos']; ?>)">
                                Agregar al carrito
                            </button>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>

    <script>
        // Función para agregar productos al carrito
        const agregarAlCarrito = (idProducto) => {
            alert(`Producto con ID ${idProducto} agregado al carrito.`);
            // Aquí puedes implementar la lógica de tu carrito de compras
        };
    </script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
<?php
// Liberar resultados y cerrar conexión
mysqli_free_result($resultado);
mysqli_close($conexion);
?>