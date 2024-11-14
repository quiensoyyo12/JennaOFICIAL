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
    <!--Código para acentos y ñ -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login/styleB.css">
    <link rel="stylesheet" href="css/css/bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/bootstrap.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>JennaWork</title>
</head>

<!-- Diseño de fondo de la pagina web-->
<style>
    body {
        background-color: #f0e6ff;
        /* Lavanda claro */
        color: #333;
        /* Gris oscuro */
        font-family: Arial, sans-serif;
        /* Fuente principal */
    }

    /* Estilo para garantizar que todas las cards tengan el mismo tamaño */
    .card {
        height: 350px;
        /* Altura fija para todas las cards */
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .card-img-top {
        height: 200px;
        /* Altura fija para las imágenes */
        object-fit: cover;
        /* Ajustar imágenes sin distorsionarlas */
    }

    .card-body {
        display: flex;
        flex-direction: column;
        justify-content: center;
    }
</style>

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
                    <a href="Mostrar_Productos.php" class="">Productos</a>
                </li>
                <li>
                    <a href="" class="">Carrito</a>
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

    <section class="carousel-section my-5">
        <div id="carouselExampleInterval" class="carousel slide mx-auto" style="width: 100%; max-width: 100%;" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active" data-bs-interval="100">
                    <img src="images/anim.jpg" class="d-block w-100" style="height: 300px; object-fit: cover;" alt="...">
                </div>
                <div class="carousel-item" data-bs-interval="2000">
                    <img src="images/anime.jpg" class="d-block w-100" style="height: 300px; object-fit: cover;" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="images/Cartel.png" class="d-block w-100" style="height: 300px; object-fit: cover;" alt="...">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </section>


    <script src="script2.js"></script>



    <section class="productos my-5">
        <h2 class="text-center my-5">Nuestros productos</h2>
        <div class="container my-5">
            <div class="row justify-content-center">
                <div class="col-12 col-md-6 col-lg-4 mb-4">
                    <div class="card text-center">
                        <img src="images/aretes.jpg" class="card-img-top" alt="Aretes">
                        <div class="card-body">
                            <h5 class="card-title">Aretes</h5>
                            <a href="#" class="btn btn-primary">Conozca más</a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4 mb-4">
                    <div class="card text-center">
                        <img src="images/anillos.jpg" class="card-img-top" alt="Anillos">
                        <div class="card-body">
                            <h5 class="card-title">Anillos</h5>
                            <a href="#" class="btn btn-primary">Conozca más</a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4 mb-4">
                    <div class="card text-center">
                        <img src="images/colar.jpg" class="card-img-top" alt="Collares">
                        <div class="card-body">
                            <h5 class="card-title">Collares</h5>
                            <a href="#" class="btn btn-primary">Conozca más</a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4 mb-4">
                    <div class="card text-center">
                        <img src="images/albumes.jpg" class="card-img-top" alt="Álbumes">
                        <div class="card-body">
                            <h5 class="card-title">Álbumes</h5>
                            <a href="#" class="btn btn-primary">Conozca más</a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4 mb-4">
                    <div class="card text-center">
                        <img src="images/photocard.jpg" class="card-img-top" alt="Photo cards">
                        <div class="card-body">
                            <h5 class="card-title">Photo cards coreanos</h5>
                            <a href="#" class="btn btn-primary">Conozca más</a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4 mb-4">
                    <div class="card text-center">
                        <img src="images/pulsera.jpg" class="card-img-top" alt="Pulseras">
                        <div class="card-body">
                            <h5 class="card-title">Pulseras</h5>
                            <a href="#" class="btn btn-primary">Conozca más</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</body>

<body>
    <section class="Nosotros my-5">
        <h2 class="text-center my-5">Marcas asociadas</h2>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-6 col-lg-4 mb-4">
                    <div class="card text-center h-100">
                        <img src="images/logo4tito.jpg" class="card-img-top" alt="4tito Shop">
                        <div class="card-body">
                            <h5 class="card-title">4tito Shop</h5>
                            <p class="card-text">Productos de anime, K-pop y comida coreana.</p>
                            <a href="#" class="btn btn-primary">Conozca más</a>
                        </div>
                    </div>
                </div>

                <!-- Repite la estructura de arriba para las demás marcas, aquí algunos ejemplos: -->
                <div class="col-12 col-md-6 col-lg-4 mb-4">
                    <div class="card text-center h-100">
                        <img src="images/logoLoteriChoca.png" class="card-img-top" alt="Lotería Choca">
                        <div class="card-body">
                            <h5 class="card-title">Lotería Choca</h5>
                            <p class="card-text">Accesorios y juegos de temática tabasqueña.</p>
                            <a href="#" class="btn btn-primary">Conozca más</a>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-4 mb-4">
                    <div class="card text-center h-100">
                        <img src="images/LogoHildaTejidos.png" class="card-img-top" alt="Hilda Tejidos">
                        <div class="card-body">
                            <h5 class="card-title">Hilda Tejidos</h5>
                            <p class="card-text">Accesorios y adornos hechos a mano.</p>
                            <a href="#" class="btn btn-primary">Conozca más</a>
                        </div>
                    </div>
                </div>
                <!-- Continúa con las demás tarjetas de marcas -->
            </div>
        </div>
    </section>

</body>

<footer id="about" style="background-color: #333; color: white; padding: 20px 0;">
    <div class="container">
        <div class="row text-center">
            <div class="col-4 offset-4">
                <div class="card text-center" style="background-color: transparent; border: none; color: white;">
                    <div class="card-body">
                        <h5 class="card-title" style="color: aquamarine;">Contactos</h5>
                        <p class="card-text">
                            WhatsApp: <a href="tel:9321085721" style="color: aquamarine; text-decoration: none;">932 108 57 21</a><br>
                            Facebook: <a href="https://facebook.com/JennaWork" target="_blank" style="color: aquamarine; text-decoration: none;">@JennaWork</a><br>
                            Instagram: <a href="https://instagram.com/JennaWork" target="_blank" style="color: aquamarine; text-decoration: none;">@JennaWork</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center mt-3">
            <p>&copy; 2024 JennaWork. Todos los derechos reservados.</p>
        </div>
    </div>
</footer>

</html>