<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login/styleB.css">
    <link rel="stylesheet" href="css/css/bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/bootstrap.min.js"></script>
    <title>Pulseras - JennaWork</title>

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

    /* Estilo para todas las tarjetas */
    .card {
        height: 100%;
        /* Asegura que todas tengan la misma altura */
        max-width: 300px;
        /* Ajusta el ancho máximo */
        margin: 0 auto;
        /* Centra las tarjetas */
    }

    /* Estilo para las imágenes de las tarjetas */
    .card-img-top {
        height: 200px;
        /* Altura fija para las imágenes */
        object-fit: cover;
        /* Asegura que las imágenes se ajusten sin distorsión */
    }

    /* Espaciado entre las tarjetas */
    .row>.col-12.col-md-6.col-lg-4 {
        display: flex;
        justify-content: center;
        /* Centra las tarjetas dentro de la fila */
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
                    <a href="inicio.html" class="">Inicio</a>
                </li>
                <li>
                    <a href="#" id="carrito" class="">Carrito</a>
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

    <div class="container my-5">
        <h1 class="text-center mb-4">Pulseras de JennaWork</h1>
        <div class="row">
            <?php
            // Conexión a la base de datos
            include 'conexion.php'; // Asegúrate de que la ruta sea correcta

            // Consulta para obtener pulseras de la marca JennaWork
            $consultaPulseras = "SELECT * FROM productos WHERE Tipo_Productos = 'Pulseras' AND Marca = 'JennaWork'";
            $resultadoPulseras = mysqli_query($conexion, $consultaPulseras);

            // Verificar si hay resultados
            if ($resultadoPulseras && mysqli_num_rows($resultadoPulseras) > 0) {
                while ($row = mysqli_fetch_assoc($resultadoPulseras)) {
                    echo "<div class='col-12 col-md-6 col-lg-4 mb-4'>";
                    echo "<div class='card text-center'>";

                    // Mostrar la imagen del producto (usando base64)
                    if (!empty($row['imagen'])) {
                        echo "<img src='data:image/jpeg;base64," . base64_encode($row['imagen']) . "' class='card-img-top' alt='" . htmlspecialchars($row['Nombre_producto']) . "' style='height: 200px; object-fit: cover;'>";
                    } else {
                        // Imagen por defecto si no hay imagen disponible
                        echo "<img src='images/default.jpg' class='card-img-top' alt='Imagen no disponible' style='height: 200px; object-fit: cover;'>";
                    }

                    // Mostrar detalles del producto
                    echo "<div class='card-body'>";
                    echo "<h5 class='card-title'>" . htmlspecialchars($row['Nombre_producto']) . "</h5>";
                    echo "<p class='card-text'>" . htmlspecialchars($row['Descripcion_Productos']) . "</p>";
                    echo "<p class='card-text'><strong>Precio:</strong> $" . number_format($row['Precio'], 2) . "</p>";
                    echo "<p class='card-text'><strong>Cantidad:</strong> " . intval($row['Cantidad_Productos']) . " disponibles</p>";
                    // Cambiar el botón para que tenga la clase 'btn-comprar'
                    echo "<a href='#' class='btn btn-primary comprar-btn'>Comprar</a>";
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                }
            } else {
                echo "<p class='text-center col-12'>No hay pulseras disponibles de la marca JennaWork.</p>";
            }

            // Cerrar conexión
            mysqli_close($conexion);
            ?>

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
                    <p id="modalMessage">Debe iniciar sesión para continuar.</p>
                </div>
                <div class="modal-footer">
                    <a href="login.php" class="btn btn-primary">Iniciar Sesión</a>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Inicializar el modal de advertencia
        const loginModal = new bootstrap.Modal(document.getElementById("loginModal"), {});

        // Referencia al mensaje del modal
        const modalMessage = document.getElementById("modalMessage");

        // Manejar clic en los botones "Comprar"
        const botonesComprar = document.querySelectorAll(".comprar-btn");
        botonesComprar.forEach(boton => {
            boton.addEventListener("click", function(event) {
                event.preventDefault(); // Evitar redirección o acciones predeterminadas
                modalMessage.textContent = "Debe iniciar sesión para agregar productos al carrito."; // Personalizar el mensaje
                loginModal.show(); // Mostrar el modal
            });
        });

        // Manejar clic en el enlace del carrito
        const enlaceCarrito = document.getElementById("carrito");
        if (enlaceCarrito) {
            enlaceCarrito.addEventListener("click", function(event) {
                event.preventDefault(); // Evitar redirección o acciones predeterminadas
                modalMessage.textContent = "Debe iniciar sesión para acceder al carrito."; // Personalizar el mensaje
                loginModal.show(); // Mostrar el modal
            });
        }
    </script>


</body>

</html>