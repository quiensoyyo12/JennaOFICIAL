<?php

session_start();

if (!isset($_SESSION['id'])) {
  header("Location: login.php");
  exit();
}

// Ahora puedes acceder al ID del usuario logueado
$id = $_SESSION['id'];

$conexion = mysqli_connect("localhost", "root", "", "jennawork");


$consulta_ciudadanos = "SELECT * FROM usuario where id = '$id'";
$resultado_ciudadanos = mysqli_query($conexion, $consulta_ciudadanos) or die(mysqli_error($conexion));
$fila_ciudadano = mysqli_fetch_assoc($resultado_ciudadanos);
?>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "jennawork";
$conn = new mysqli($servername, $username, $password, $dbname);
// Verifica la conexión
if ($conn->connect_error) {
  die("Conexión fallida: " . $conn->connect_error);
}


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
    <title>Detalle Productos</title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" />
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
                <h5 style="color: white; font-size: 1.2rem; font-weight: bold;">
                        <?php
                        echo htmlspecialchars($fila_ciudadano['Nombre']);
                        ?>
                        --
                    </h5>

                    <!-- Button trigger modal -->
                    <a data-bs-toggle="modal" data-bs-target="#exampleModal"><img src="images/salir-alt (2).png" alt="cerrar sesion" width="40" height="32"></a>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5 lemon-regular" id="exampleModalLabel">¿Estas Seguro?</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p style="color: black;">Estas a Punto de Cerrar Sesión</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Continuar</button>
                                    <a type="button" class="btn btn-primary" href="cerrarSesion.php">Cerrar Sesión</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </ul>
        </nav>
    </header>
    <script src="script2.js"></script>

    <?php
    // Conexión a la base de datos
    $conexion = mysqli_connect("localhost", "root", "", "jennawork") or die("Error en la base de datos.");

    // Obtener el ID del producto de la URL
    $id_producto = isset($_GET['id']) ? intval($_GET['id']) : 0;

    // Consulta para obtener los datos del producto
    $consultaProducto = "SELECT * FROM productos WHERE idProductos = $id_producto";
    $resultado = mysqli_query($conexion, $consultaProducto);
    $producto = mysqli_fetch_assoc($resultado);

    // Cerrar conexión
    mysqli_close($conexion);
    ?>
    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Detalle del Producto</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
        <style>
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
        </style>
    </head>

    <body>
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
                                <!-- Botón Comprar con funcionalidad de modal -->
                                <button type="button" class="btn btn-success btn-lg" data-bs-toggle="modal" data-bs-target="#loginModal">
                                    Comprar
                                </button>
                                <!-- Botón Agregar al carrito con funcionalidad de modal -->
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
        <!-- Modal
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
        </div> -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

        <script>
            document.addEventListener("DOMContentLoaded", () => {
                document.querySelectorAll("img[data-src]").forEach(img => {
                    img.src = img.dataset.src;
                });
            });
        </script>

    </body>

    </html>