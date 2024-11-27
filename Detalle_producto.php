<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login/styleB.css">
    <link rel="stylesheet" href="css/css/bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/bootstrap.min.js"></script>
    <title>Detalle Productos</title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <header>
        <div class="logo">
            <img src="images/logoJenna-removebg-preview.png" alt="Logo de la Empresa" class="logo-img">
        </div>
        <div class="bars">
            <div class="line"></div>
            <div class="line"></div>
            <div class="line"></div>
        </div>
        <nav class="nav-bar">
            <ul>
                <li>
                    <a href="inicio.html" class="">inicio</a>
                </li>
                <li>
                    <!-- Enlace del carrito que activa el modal -->
                    <a href="#" class="" id="btnCarrito" data-bs-toggle="modal" data-bs-target="#loginModal">Carrito</a>
                </li>
                <li>
                    <a href="Mostrar_productos_sinlogueo.php" class="">Productos</a>
                </li>
                <li>
                    <a href="login.php" class="">Iniciar Sesion</a>
                </li>
            </ul>
        </nav>
    </header>
    <script src="script2.js"></script>

    <?php
    // Conexión a la base de datos
    include 'conexion.php'; // Asegúrate de que la ruta sea correcta
    // Obtener el ID del producto de la URL
    $id_producto = isset($_GET['id']) ? intval($_GET['id']) : 0;

    // Consulta para obtener los datos del producto
    $consultaProducto = "SELECT * FROM productos WHERE idProductos = $id_producto";
    $resultado = mysqli_query($conexion, $consultaProducto);
    $producto = mysqli_fetch_assoc($resultado);

    // Cerrar conexión
    mysqli_close($conexion);
    ?>

    <style>
        body {
            background-color: #e4d3fd;
            /* Lavanda claro */
            color: #333;
            /* Gris oscuro */
            font-family: Arial, sans-serif;
            /* Fuente principal */
        }

        .product-img {
            max-width: 100%;
            height: auto;
            object-fit: cover;
        }

        .details-container {
            background: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }

        .btn-container {
            margin-top: 20px;
        }
        /* Quitar subrayado de los enlaces en el menú */
.nav-bar a {
    text-decoration: none !important; /* Quita cualquier subrayado */
}

/* Opcional: Cambiar el color del texto al pasar el mouse */
.nav-bar a:hover {
    text-decoration: none; /* Asegura que no se subraye al pasar el mouse */
    color: #000; /* Cambia el color del texto si deseas un efecto */
}

    </style>

    <div class="container my-5">
        <?php if ($producto): ?>
            <div class="row">
                <!-- Imagen del producto -->
                <div class="col-md-6">
                    <img data-src="data:image/jpeg;base64,<?php echo base64_encode($producto['imagen']); ?>"
                        class="card-img-top lazy-load"
                        alt="<?php echo htmlspecialchars($producto['Nombre_producto']); ?>"
                        style="height: 500px; object-fit: cover;">

                </div>
                <!-- Detalles del producto -->
                <div class="col-md-6">
                    <div class="details-container">
                        <h1><?php echo htmlspecialchars($producto['Nombre_producto']); ?></h1>
                        <p><strong>Categoría:</strong> <?php echo htmlspecialchars($producto['Tipo_Productos']); ?></p>
                        <p><strong>Marca:</strong> <?php echo htmlspecialchars($producto['Marca']); ?></p>
                        <p><strong>Precio:</strong> $<?php echo number_format($producto['Precio'], 2); ?></p>
                        <p><strong>Descripción:</strong> <?php echo htmlspecialchars($producto['Descripcion_Productos']); ?></p>
                        <p><strong>Cantidad disponible:</strong> <?php echo intval($producto['Cantidad_Productos']); ?></p>
                        <div class="btn-container">
                            <!-- Botón Comprar -->
                            <button type="button" class="btn btn-success btn-lg" data-bs-toggle="modal" data-bs-target="#loginModal">
                                Comprar
                            </button>
                            <!-- Botón Agregar al carrito -->
                            <button type="button" class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#loginModal">
                                Agregar al carrito
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <p class="text-center">El producto solicitado no existe.</p>
        <?php endif; ?>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="loginModalLabel">Advertencia</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    Debe iniciar sesión para poder realizar esta acción.
                </div>
                <div class="modal-footer">
                    <a href="login.php" class="btn btn-primary">Iniciar Sesión</a>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Capturar el clic del botón del carrito
        document.getElementById('btnCarrito').addEventListener('click', function(event) {
            console.log('Modal activado desde el menú del carrito');
        });

        // Detectar si el modal fue activado por un botón del producto
        document.querySelectorAll('.btn-container button').forEach(button => {
            button.addEventListener('click', function() {
                console.log('Modal activado desde el producto: ' + this.textContent.trim());
            });
        });
    </script>


    <script>
        document.addEventListener("DOMContentLoaded", () => {
            document.querySelectorAll("img[data-src]").forEach(img => {
                img.src = img.dataset.src;
            });
        });
    </script>

</body>

</html>