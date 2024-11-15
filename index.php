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
    <title>Administrador</title>
    <link rel="stylesheet" href="styleF.css">
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
                    <a href="" class="">Reportes</a>
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
<center>
    <h1><b>Bienvenido a la fuente de control</b></h1>
    <h3><i>¿Qué quieres hacer?</i></h3>
    </center>
    <div class="container">
    <div class="row justify-content-center">
        <!-- Card 1 -->
        <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
            <a href="RegistroEmpleados.html" class="card text-center">
                <img src="reclutamiento.png" alt="Alta empleados">
                <div class="card-body">
                    <h5 class="card-title">Alta empleados</h5>
                </div>
            </a>
        </div>

        <!-- Card 2 -->
        <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
            <a href="Productos.html" class="card text-center">
                <img src="cajas.svg" alt="Alta productos">
                <div class="card-body">
                    <h5 class="card-title">Alta productos</h5>
                </div>
            </a>
        </div>

        <!-- Card 3 -->
        <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
            <a href="PedidosA.php" class="card text-center">
                <img src="cami.svg" alt="Alta pedidos">
                <div class="card-body">
                    <h5 class="card-title">Alta pedidos</h5>
                </div>
            </a>
        </div>

        <!-- Card 4 -->
        <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
            <a href="RegistroProveedor.html" class="card text-center">
                <img src="inventario.png" alt="Alta proveedores">
                <div class="card-body">
                    <h5 class="card-title">Alta proveedores</h5>
                </div>
            </a>
        </div>

        <!-- Card 5 -->
        <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
            <a href="RegistroVentas.html" class="card text-center">
                <img src="dine.svg" alt="Alta ventas">
                <div class="card-body">
                    <h5 class="card-title">Alta ventas</h5>
                </div>
            </a>
        </div>

        <!-- Card 6 -->
        <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
            <a href="TipoEmpleados.html" class="card text-center">
                <img src="tip.svg" alt="Tipo empleados">
                <div class="card-body">
                    <h5 class="card-title">Tipo de empleados</h5>
                </div>
            </a>
        </div>

        <!-- Card 7 -->
        <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
            <a href="Permisos.html" class="card text-center">
                <img src="p.svg" alt="Revisar permisos">
                <div class="card-body">
                    <h5 class="card-title">Revisar permisos</h5>
                </div>
            </a>
        </div>

        <!-- Card 8 -->
        <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
            <a href="Usuarios.html" class="card text-center">
                <img src="usu.svg" alt="Alta usuarios">
                <div class="card-body">
                    <h5 class="card-title">Alta usuarios</h5>
                </div>
            </a>
        </div>

        <!-- Card 9 -->
        <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
            <a href="detalle_pedido1.php" class="card text-center">
                <img src="entre.png" alt="Detalle pedidos">
                <div class="card-body">
                    <h5 class="card-title">Detalle pedidos</h5>
                </div>
            </a>
        </div>

        <!-- Card 10 -->
        <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
            <a href="detalle_venta.html" class="card text-center">
                <img src="venta.png" alt="Detalle ventas">
                <div class="card-body">
                    <h5 class="card-title">Detalle ventas</h5>
                </div>
            </a>
        </div>
    </div>
</div>


    
</body>

</html>