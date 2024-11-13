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
                    <a href="" class="active">inicio</a>
                </li>
                <li>
                    <a href="" class="">Blog</a>
                </li>
                <li>
                    <a href="" class="">Portafolio</a>
                </li>
                <li>
                    <a href="" class="">Contacto</a>
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

    <h1>Bienvenido a la fuente de control.</h1>
<br>
<center>
    <h3>¿Que quieres hacer?</h3>
</center>

    <form id="frmindex" action="" method="post"></form>
    <div class="container">
        <div class="cuadro">
            <a href="RegistroEmpleados.html"> Alta empleados</a><br>
            <label for="">
                <img width="55px" src="reclutamiento.png" alt="">
            </label>
        </div>
        <div class="cuadro">
            <a href="Productos.html">Alta productos</a><br>
            <label for="">
                <img width="55px" src="cajas.svg" alt="">
            </label>
        </div>
        <div class="cuadro">
            <i class="fi fi-sr-shopping-cart"></i>
            <a href="PedidosA.php">Alta pedidos</a><br>
            <label for="">
                <img width="55px" src="cami.svg" alt="">
            </label>
        </div>
        <div class="cuadro">
            <a href="RegistroProveedor.html">Alta proveedores</a><br>
            <label for="">
                <img  width="50px" src="inventario.png" alt="">
            </label>
        </div>
        <div class="cuadro">
            <a href="RegistroVentas.html">Alta Ventas</a><br>
            <label for="">
                <img width="50px" src="dine.svg" alt="">
            </label>
        </div>
        <div class="cuadro">
            <a href="TipoEmpleados.html">Tipo de empleados</a><br>
            <label for="">
                <img width="50px" src="tip.svg" alt="">
            </label>
        </div>
        <div class="cuadro">
            <a href="Permisos.html">Revisar los Permisos</a><br>
            <label for="">
                <img width="50px" src="p.svg" alt="">
            </label>
        </div>
        <div class="cuadro">
            <a href="Usuarios.html">Alta Usuarios</a><br>
            <label for="">
                <img width="50px" src="usu.svg" alt="">
            </label>
        </div>
        <div class="cuadro">
            <a href="detalle_pedido1.php">Detalle de pedidos</a><br>
            <label for="">
                <img width="50px" src="entre.png" alt="">
            </label>
        </div>
        <div class="cuadro">
            <a href="detalle_venta.html">Detalles de venta</a><br>
            <label for="">
                <img width="50px" src="venta.png" alt="">
            </label>
        </div>
    </div>

</body>

</html>