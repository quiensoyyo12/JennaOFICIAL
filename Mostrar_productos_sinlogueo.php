<?php
// Conectar a la base de datos
$conexion = mysqli_connect("localhost", "root", "", "jennawork") or die("Error en la conexión con la base de datos");

// Consulta para obtener los productos
$consulta = "SELECT idProductos, Tipo_Productos, Nombre_producto, Precio, imagen FROM productos";
$resultado = mysqli_query($conexion, $consulta);

if (!$resultado) {
    die("Error al obtener los productos: " . mysqli_error($conexion));
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login/StyleN.css">
    <link rel="stylesheet" href="css/css/bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/bootstrap.min.js"></script>
    <title>Mostrar Productos</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" />
    <style>
        .card {
            height: 300px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .card-img-top {
            height: 150px;
            object-fit: cover;
        }

        .card-body {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        .card:hover {
            cursor: pointer;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transition: box-shadow 0.3s ease-in-out;
        }
    </style>
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
                    <a href="" class="">Carrito</a>
                </li>
                <li>
                    <a href="" class="">Portafolio</a>
                </li>
                <li>
                    <a href="" class="">Contacto</a>
                </li>
            </ul>
        </nav>
    </header>


    <div class="modal" id="navModal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <ul>
                <li><a href="inicio.html">Inicio</a></li>
                <li><a href="#">Carrito</a></li>
                <li><a href="#">Contacto</a></li>
                <li><a href="login.php">Iniciar Sesión</a></li>
            </ul>
        </div>
    </div>

    <script>
        // Obtener los elementos
        const bars = document.querySelector(".bars");
        const modal = document.getElementById("navModal");
        const closeBtn = document.querySelector(".close");

        // Mostrar el modal cuando se haga clic en el icono de las barras
        bars.onclick = function() {
            modal.style.display = "block";
        };

        // Cerrar el modal cuando se haga clic en la "X"
        closeBtn.onclick = function() {
            modal.style.display = "none";
        };

        // Cerrar el modal si se hace clic fuera del modal
        window.onclick = function(event) {
            if (event.target === modal) {
                modal.style.display = "none";
            }
        };
    </script>

    <div class="container my-4">
        <div class="row">
            <?php while ($producto = mysqli_fetch_assoc($resultado)): ?>
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
                    <div class="card h-100" onclick="redireccionar(event, <?php echo $producto['idProductos']; ?>)">
                        <img data-src="data:image/jpeg;base64,<?php echo base64_encode($producto['imagen']); ?>"
                            class="card-img-top lazy-load">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($producto['Nombre_producto'] ?? 'No disponible'); ?></h5>
                            <p class="card-text">
                                <strong>Categoría:</strong> <?php echo htmlspecialchars($producto['Tipo_Productos'] ?? 'No disponible'); ?><br>
                                <strong>Precio:</strong> $<?php echo is_numeric($producto['Precio']) ? number_format($producto['Precio'], 2) : 'No disponible'; ?>
                            </p>
                            <!-- Evitar redirección al hacer clic en este botón -->
                            <button class="btn btn-primary btn-sm agregar-carrito" onclick="mostrarModal(event)">
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
        // Función para redirigir al detalle del producto
        const redireccionar = (event, idProducto) => {
            // Verificar si el clic fue en el botón
            if (event.target.classList.contains('agregar-carrito')) {
                return; // No redirigir si se hizo clic en el botón
            }
            window.location.href = `Detalle_producto.php?id=${idProducto}`;
        };

        // Función para mostrar el modal
        const mostrarModal = (event) => {
            event.stopPropagation(); // Detener la propagación del evento
            const modal = new bootstrap.Modal(document.getElementById('loginModal'));
            modal.show();
        };
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            document.querySelectorAll("img[data-src]").forEach(img => {
                img.src = img.dataset.src;
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
<?php
mysqli_free_result($resultado);
mysqli_close($conexion);
?>