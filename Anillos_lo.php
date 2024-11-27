<?php

session_start();

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

// Ahora puedes acceder al ID del usuario logueado
$id = $_SESSION['id'];

include 'conexion.php'; // Asegúrate de que la ruta sea correcta

$consulta_ciudadanos = "SELECT * FROM usuario where id = '$id'";
$resultado_ciudadanos = mysqli_query($conexion, $consulta_ciudadanos) or die(mysqli_error($conexion));
$fila_ciudadano = mysqli_fetch_assoc($resultado_ciudadanos);
?>
<?php
    include 'conexion.php'; // Asegúrate de que la ruta sea correcta



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login/styleN.css">
    <link rel="stylesheet" href="css/css/bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/bootstrap.min.js"></script>
    <title>Anillos - JennaWork</title>

</head>
<style>
    body {
        background-color: #e4d3fd;
        /* Lavanda claro */
        color: #333;
        /* Gris oscuro */
        font-family: Arial, sans-serif;
        /* Fuente principal */
    }

    /* Estilo general para las cards originales */
    .card {
        height: 300px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        cursor: pointer;
        position: relative;
        /* Permite que los elementos internos se posicionen con precisión */
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

    /* Efecto hover para las cards originales */
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);

    }

    /* Hover container inside the card */
    .hover-container {
        position: absolute;
        bottom: 0;
        /* Aparece al final de la tarjeta */
        left: 0;
        width: 100%;
        background: #fff;
        border-top: 1px solid #ddd;
        padding: 10px;
        box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.1);
        display: flex;
        justify-content: space-between;
        align-items: center;
        opacity: 0;
        visibility: hidden;
        transition: opacity 0.3s ease, visibility 0.3s ease;
        z-index: 10;
        /* Asegura que se muestre encima del contenido */
    }

    .card:hover .hover-container {
        opacity: 1;
        visibility: visible;
    }

    /* Estilos específicos para las cards con hover interactivo */
    .card-hover-interactive {
        position: relative;
        overflow: visible;
        /* Permite que los elementos se extiendan fuera del contenedor */
    }

    .card-hover-interactive .hover-container {
        position: absolute;
        bottom: -100%;
        /* Oculto por defecto */
        left: 0;
        width: 100%;
        background: #fff;
        border-top: 1px solid #ddd;
        padding: 10px;
        box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.1);
        display: flex;
        justify-content: space-between;
        align-items: center;
        transition: bottom 0.3s ease;
    }

    .card-hover-interactive:hover .hover-container {
        bottom: 0;
        /* Aparece cuando se hace hover */
    }

    /* Contenedor de cantidad interactiva */
    .cantidad-container {
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .cantidad {
        font-size: 1rem;
        font-weight: bold;
        min-width: 30px;
        text-align: center;
    }

    /* Ensures the card text and hover align */
    .card-body {
        margin-bottom: 50px;
        /* Deja espacio para el hover-container dentro de la tarjeta */
    }

    /* Quitar subrayado de los enlaces en el menú */
    .nav-bar a {
        text-decoration: none !important;
        /* Quita cualquier subrayado */
    }

    /* Opcional: Cambiar el color del texto al pasar el mouse */
    .nav-bar a:hover {
        text-decoration: none;
        /* Asegura que no se subraye al pasar el mouse */
        color: #000;
        /* Cambia el color del texto si deseas un efecto */
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
                    <a href="inicio.php" class="">Inicio</a>
                </li>
                <li>
                    <a href="carrito.php" class="">Carrito</a>
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

    <div class="container my-5">
        <h1 class="text-center mb-4">Anillos de JennaWork</h1>
        <div class="row">
            <?php
            // Conexión a la base de datos
            include 'conexion.php'; // Asegúrate de que la ruta sea correcta
            // Consulta para obtener los anillos de la marca JennaWork
            $consultaAnillos = "SELECT * FROM productos WHERE Tipo_Productos = 'Anillos' AND Marca = 'JennaWork'";
            $resultadoAnillos = mysqli_query($conexion, $consultaAnillos);

            // Verificar si hay resultados
            if ($resultadoAnillos && mysqli_num_rows($resultadoAnillos) > 0) {
                while ($row = mysqli_fetch_assoc($resultadoAnillos)) {
                    echo "<div class='col-12 col-sm-6 col-md-4 col-lg-3 mb-4'>";
                    echo "<div class='card card-hover-interactive h-100'>";

                    // Mostrar la imagen del producto (usando base64)
                    if (!empty($row['imagen'])) {
                        echo "<img src='data:image/jpeg;base64," . base64_encode($row['imagen']) . "' class='card-img-top' alt='" . htmlspecialchars($row['Nombre_producto']) . "'>";
                    } else {
                        // Imagen por defecto si no hay imagen disponible
                        echo "<img src='images/default.jpg' class='card-img-top' alt='Imagen no disponible'>";
                    }

                    // Mostrar detalles del producto
                    echo "<div class='card-body'>";
                    echo "<h5 class='card-title'>" . htmlspecialchars($row['Nombre_producto']) . "</h5>";
                    echo "<p class='card-text'>" . htmlspecialchars($row['Descripcion_Productos']) . "</p>";
                    echo "<p class='card-text'><strong>Precio:</strong> $" . number_format($row['Precio'], 2) . "</p>";
                    echo "</div>";

                    // Contenedor de hover interactivo
                    echo "<div class='hover-container'>";
                    echo "<div class='cantidad-container'>";
                    echo "<button class='btn btn-sm btn-secondary cantidad-btn' data-action='decrement' data-id='{$row['idProductos']}'>-</button>";
                    echo "<span class='cantidad'>1</span>";
                    echo "<button class='btn btn-sm btn-secondary cantidad-btn' data-action='increment' data-id='{$row['idProductos']}'>+</button>";
                    echo "</div>";
                    echo "<form method='post' class='agregar-al-carrito-form'>";
                    echo "<input type='hidden' name='idProductos' value='{$row['idProductos']}'>";
                    echo "<input type='hidden' name='Nombre_producto' value='" . htmlspecialchars($row['Nombre_producto']) . "'>";
                    echo "<input type='hidden' name='Precio' value='" . htmlspecialchars($row['Precio']) . "'>";
                    echo "<input type='hidden' name='imagen' value='" . base64_encode($row['imagen']) . "'>";
                    echo "<input type='hidden' name='Cantidad_Productos' class='cantidad-input' value='1'>";
                    echo "<button type='submit' class='btn btn-primary btn-sm agregar-al-carrito-btn'>Agregar al carrito</button>";
                    echo "</form>";
                    echo "</div>";

                    echo "</div>"; // Cierre de card
                    echo "</div>"; // Cierre de col
                }
            } else {
                echo "<p class='text-center col-12'>No hay anillos disponibles de la marca JennaWork.</p>";
            }

            // Cerrar conexión
            mysqli_close($conexion);
            ?>


        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            // Manejo de botones de cantidad
            const cantidadBtns = document.querySelectorAll(".cantidad-btn");

            cantidadBtns.forEach((btn) => {
                btn.addEventListener("click", (e) => {
                    e.preventDefault();
                    const action = btn.getAttribute("data-action");
                    const cantidadContainer = btn.closest(".cantidad-container");
                    const cantidadSpan = cantidadContainer.querySelector(".cantidad");
                    let cantidad = parseInt(cantidadSpan.textContent);

                    if (action === "increment") {
                        cantidad++;
                    } else if (action === "decrement" && cantidad > 1) {
                        cantidad--;
                    }

                    cantidadSpan.textContent = cantidad;
                    const inputCantidad = cantidadContainer.parentElement.querySelector(".cantidad-input");
                    if (inputCantidad) {
                        inputCantidad.value = cantidad;
                    }
                });
            });

            // Agregar funcionalidad de agregar al carrito
            const forms = document.querySelectorAll(".agregar-al-carrito-form");
            forms.forEach((form) => {
                form.addEventListener("submit", (e) => {
                    e.preventDefault();
                    const formData = new FormData(form);
                    // Aquí puedes enviar los datos al servidor con fetch o AJAX
                    console.log("Producto agregado al carrito:", Object.fromEntries(formData.entries()));
                    alert("Producto agregado al carrito.");
                });
            });
        });
    </script>

</body>

</html>