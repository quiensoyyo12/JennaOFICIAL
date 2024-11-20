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
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login/styleB.css">
    <link rel="stylesheet" href="css/css/bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/bootstrap.min.js"></script>
    <title>Carrito</title>
    <link rel="stylesheet" href="styleCarrito.css">
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
                    <a href="inicio.php" class="">Inicio</a>
                </li>
                <li>
                    <a href="" class="">Tikets</a>
                </li>
                <li>
                    <a href="" class=""></a>
                </li>
                <li>
                    <a href="" class=""></a>
                </li>
                <div class="d-flex">
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

    <div class='container my-5'>
    <h2 class='text-center mb-4'>Carrito de Compras</h2>

    <div class="row">
        <?php
        include 'conexion.php';

        $query = "SELECT * FROM carrito";
        $resultado = mysqli_query($conexion, $query);

        $total = 0;

        if (mysqli_num_rows($resultado) > 0): ?>
            <!-- Contenedor principal -->
            <div class="col-md-8">
                <!-- Lado izquierdo: Lista de productos -->
                <?php while ($producto = mysqli_fetch_assoc($resultado)): 
                    $subtotal = $producto['Precio'] * $producto['Cantidad_Productos'];
                    $total += $subtotal; ?>
                    <div class="card mb-3">
                        <div class="row g-0">
                            <!-- Imagen del producto -->
                            <div class="col-md-4">
                                <img src="data:image/jpeg;base64,<?php echo base64_encode($producto['imagen']); ?>" 
                                    class="img-fluid rounded-start" alt="Producto">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo htmlspecialchars($producto['Nombre_producto']); ?></h5>
                                    <p class="card-text">
                                        <strong>Precio:</strong> $<?php echo number_format($producto['Precio'], 2); ?>
                                    </p>
                                    <p class="card-text">
                                        <strong>Cantidad:</strong>
                                        <button class="btn btn-sm btn-secondary" 
                                            onclick="modificarCantidad(this, -1, <?php echo $producto['idProductos']; ?>)">-</button>
                                        <span class="cantidad"><?php echo intval($producto['Cantidad_Productos']); ?></span>
                                        <button class="btn btn-sm btn-secondary" 
                                            onclick="modificarCantidad(this, 1, <?php echo $producto['idProductos']; ?>)">+</button>
                                    </p>
                                    <p class="card-text">
                                        <strong>Subtotal:</strong> $<?php echo number_format($subtotal, 2); ?>
                                    </p>
                                    <!-- Botón para eliminar producto -->
                                    <form method="post" action="eliminar_del_carrito.php" class="d-inline">
                                        <input type="hidden" name="idProductos" value="<?php echo intval($producto['idProductos']); ?>">
                                        <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>

            <!-- Lado derecho: Resumen -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Resumen</h4>
                        <p class="card-text">
                            <strong>Total:</strong> $<?php echo number_format($total, 2); ?>
                        </p>
                        <form method="post" action="procesar_compra.php">
                            <button type="submit" class="btn btn-success w-100">Finalizar compra</button>
                        </form>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="alert alert-warning text-center">No hay productos en el carrito.</div>
        <?php endif; ?>
    </div>
</div>


</body>

</html>