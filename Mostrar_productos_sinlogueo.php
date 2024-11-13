

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
    <link rel="stylesheet" href="login/styleB.css">
    <link rel="stylesheet" href="css/css/bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/bootstrap.min.js"></script>
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
<header>
<div class="logo">
    <img src="images/logoJenna-removebg-preview.png" alt="Logo de la Empresa" class="logo-img">
</div>
        <nav class="nav-bar">
            <ul>
                <li><a href="inicio.php" class="">Inicio</a></li>
                <li><a href="" class="">Carrito</a></li>
                <li><a href="" class=""></a></li>
                <li><a href="" class="">Contacto</a></li>
            </ul>
        </nav>
    </header>

    <div class="container my-4">
        <div class="row">
            <?php while ($producto = mysqli_fetch_assoc($resultado)): ?>
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
                    <div class="card h-100">
                        <?php
$imagen = !empty($producto['imagen']) 
    ? htmlspecialchars('uploads/' . $producto['imagen']) // Ruta completa al directorio de imágenes
    : 'imagenes/default.jpg'; // Imagen predeterminada si no hay imagen en la base de datos

// Verificar si el archivo realmente existe en el servidor
if (!file_exists($imagen) || !is_file($imagen)) {
    $imagen = 'imagenes/default.jpg'; // Usar la imagen predeterminada si el archivo no es válido
}
?>

<img src="<?php echo $imagen; ?>" class="card-img-top" alt="<?php echo htmlspecialchars($producto['Nombre_producto'] ?? 'Producto'); ?>">

                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($producto['Nombre_producto'] ?? 'No disponible'); ?></h5>
                            <p class="card-text">
                                <strong>Categoría:</strong> <?php echo htmlspecialchars($producto['Tipo_Productos'] ?? 'No disponible'); ?><br>
                                <strong>Precio:</strong> $<?php echo is_numeric($producto['Precio']) ? number_format($producto['Precio'], 2) : 'No disponible'; ?>
                            </p>
                            <!-- Botón para agregar al carrito -->
                            <button class="btn btn-primary btn-sm" onclick="mostrarModal()">
                                Agregar al carrito
                            </button>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>

    <!-- Modal de advertencia -->
    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="loginModalLabel">Advertencia</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Debe iniciar sesión para agregar productos al carrito.
                </div>
                <div class="modal-footer">
                    <a href="login.php" class="btn btn-primary">Iniciar Sesión</a>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Función para mostrar el modal
        const mostrarModal = () => {
            const modal = new bootstrap.Modal(document.getElementById('loginModal'));
            modal.show();
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