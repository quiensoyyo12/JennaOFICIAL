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


<?php
include 'conexion.php'; // Asegúrate de que la ruta sea correcta

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
        body {
            background-color: #f0e6ff;
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
                    <a href="inicio.php" class="">inicio</a>
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


    <div class="modal" id="navModal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <ul>
                <li><a href="inicio.php">Inicio</a></li>
                <li><a href="carrito.php">Carrito</a></li>
                <li><a href="#"></a></li>
                <li><a href="#"></a></li>
                <div class="d-flex">
                    <h5 style="color: black; font-size: 1.2rem; font-weight: bold;">
                        <?php
                        echo htmlspecialchars($fila_ciudadano['Nombre']);
                        ?>
                        --
                    </h5>

                    <!-- Button trigger modal -->
                    <a data-bs-toggle="modal" data-bs-target="#exampleModal"><img src="images/cerrar-sesion.png" alt="cerrar sesion" width="40" height="32"></a>

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
                    <div class="card card-hover-interactive h-100">
                        <!-- Imagen con evento para redirigir -->
                        <img
                            src="data:image/jpeg;base64,<?php echo base64_encode($producto['imagen']); ?>"
                            class="card-img-top clickable-image"
                            alt="Imagen del producto"
                            data-url="Detalle_productologeo.php?id=<?php echo $producto['idProductos']; ?>">

                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($producto['Nombre_producto'] ?? 'No disponible'); ?></h5>
                            <p class="card-text">
                                <strong>Categoría:</strong> <?php echo htmlspecialchars($producto['Tipo_Productos'] ?? 'No disponible'); ?><br>
                                <strong>Precio:</strong> $<?php echo is_numeric($producto['Precio']) ? number_format($producto['Precio'], 2) : 'No disponible'; ?>
                            </p>
                        </div>

                        <!-- Hover interactivo -->
                        <div class="hover-container">
                            <div class="cantidad-container">
                                <button class="btn btn-sm btn-secondary cantidad-btn" data-action="decrement" data-id="<?php echo $producto['idProductos']; ?>">-</button>
                                <span class="cantidad">1</span>
                                <button class="btn btn-sm btn-secondary cantidad-btn" data-action="increment" data-id="<?php echo $producto['idProductos']; ?>">+</button>
                            </div>
                            <form method="post" class="agregar-al-carrito-form">
                                <input type="hidden" name="idProductos" value="<?php echo $producto['idProductos']; ?>">
                                <input type="hidden" name="Nombre_producto" value="<?php echo htmlspecialchars($producto['Nombre_producto']); ?>">
                                <input type="hidden" name="Precio" value="<?php echo htmlspecialchars($producto['Precio']); ?>">
                                <input type="hidden" name="imagen" value="<?php echo base64_encode($producto['imagen']); ?>">
                                <input type="hidden" name="Cantidad_Productos" class="cantidad-input" value="1">
                                <button type="submit" class="btn btn-primary btn-sm agregar-al-carrito-btn">Agregar al carrito</button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>

    <script>
        // Redirigir al hacer clic en la imagen
        document.addEventListener("DOMContentLoaded", () => {
            const images = document.querySelectorAll(".clickable-image");
            images.forEach(image => {
                image.addEventListener("click", () => {
                    const url = image.getAttribute("data-url");
                    if (url) {
                        window.location.href = url;
                    }
                });
            });
        });
    </script>



    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <script>
        // Mostrar el hover
        function mostrarHover(card) {
            const hoverContainer = card.querySelector('.hover-container');
            hoverContainer.style.bottom = '0';
        }

        // Ocultar el hover
        function ocultarHover(card) {
            const hoverContainer = card.querySelector('.hover-container');
            hoverContainer.style.bottom = '-100%';
        }
        $(document).ready(function() {
            // Modificar cantidad en la interfaz al hacer clic en + o -
            $('.cantidad-btn').click(function() {
                var action = $(this).data('action');
                var cantidadContainer = $(this).siblings('.cantidad'); // Contenedor de cantidad visual
                var cantidad = parseInt(cantidadContainer.text(), 10);

                if (action === 'increment') {
                    cantidad++;
                } else if (action === 'decrement' && cantidad > 1) { // Evitar cantidades menores a 1
                    cantidad--;
                }

                cantidadContainer.text(cantidad); // Actualizar cantidad en la vista
                $(this).closest('.hover-container').find('.cantidad-input').val(cantidad); // Actualizar campo oculto
            });

            // Manejo de agregar al carrito
            $('.agregar-al-carrito-btn').click(function(e) {
                e.preventDefault(); // Prevenir el envío tradicional

                var form = $(this).closest('.agregar-al-carrito-form');
                var cantidad = parseInt(form.find('.cantidad-input').val(), 10) || 1; // Obtener cantidad seleccionada
                form.find('.cantidad-input').val(cantidad); // Establecer cantidad en el campo oculto

                var formData = form.serialize(); // Serializar los datos del formulario

                $.ajax({
                    type: 'POST',
                    url: 'agregar_al_carrito.php', // Enviar datos al carrito
                    data: formData,
                    success: function(response) {
                        var data = JSON.parse(response);
                        if (data.success) {
                            alert(data.message); // Mostrar mensaje de éxito
                            // Actualizar la cantidad en el inventario
                            actualizarCantidadInventario(data.idProductos, cantidad);
                        } else {
                            alert(data.message); // Mostrar mensaje de error
                        }
                    },
                    error: function() {
                        alert('Error al agregar el producto al carrito.');
                    }
                });
            });

            function actualizarCantidadInventario(idProducto, cantidad) {
                // Llamada para actualizar el inventario
                $.ajax({
                    type: 'POST',
                    url: 'actualizar_cantidad.php', // Ruta del archivo PHP que actualiza el inventario
                    contentType: 'application/json',
                    data: JSON.stringify({
                        idProducto: idProducto,
                        nuevaCantidad: cantidad,
                    }),
                    success: function(response) {
                        var data = JSON.parse(response);
                        if (data.success) {
                            console.log(`Inventario actualizado para el producto ${idProducto}`);
                        } else {
                            console.error(`Error al actualizar inventario: ${data.error}`);
                        }
                    },
                    error: function() {
                        console.error('Error en la actualización del inventario.');
                    }
                });
            }
        });
    </script>



    <script>
        // Función para redirigir al detalle del producto
        const redireccionar = (event, idProducto) => {
            // Verificar si el clic fue en el botón
            if (event.target.classList.contains('agregar-carrito')) {
                return; // No redirigir si se hizo clic en el botón
            }
            window.location.href = `Detalle_productologeo.php?id=${idProducto}`;
        };

        // Función para mostrar el modal
        const mostrarModal = (event) => {
            event.stopPropagation(); // Detener la propagación del evento
            const modal = new bootstrap.Modal(document.getElementById('loginModal'));
            modal.show();
        };
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>

    <footer id="about" style="background-color: #333; color: white; padding: 20px 0;">
        <div class="container">
            <div class="row text-center">
                <div class="col-4 offset-4">
                    <div class="card text-center" style="background-color: transparent; border: none; color: white;">
                        <div class="card-body">
                            <h5 class="card-title" style="color: aquamarine;">Contactos</h5>
                            <p class="card-text">
                                WhatsApp: <a href="tel:9321085721" style="color: aquamarine; text-decoration: none;">932 108
                                    57 21</a><br>
                                Facebook: <a href="https://facebook.com/JennaWork" target="_blank"
                                    style="color: aquamarine; text-decoration: none;">@JennaWork</a><br>
                                Instagram: <a href="https://instagram.com/JennaWork" target="_blank"
                                    style="color: aquamarine; text-decoration: none;">@JennaWork</a>
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
</body>

</html>
<?php
mysqli_free_result($resultado);
mysqli_close($conexion);
?>