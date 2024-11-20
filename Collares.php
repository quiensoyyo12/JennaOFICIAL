<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login/styleB.css">
    <link rel="stylesheet" href="css/css/bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/bootstrap.min.js"></script>
    <title>Collares - JennaWork</title>
    
</head>
<style>
    /* Estilo para todas las tarjetas */
    .card {
        height: 100%; /* Asegura que todas tengan la misma altura */
        max-width: 300px; /* Ajusta el ancho máximo */
        margin: 0 auto; /* Centra las tarjetas */
    }

    /* Estilo para las imágenes de las tarjetas */
    .card-img-top {
        height: 200px; /* Altura fija para las imágenes */
        object-fit: cover; /* Asegura que las imágenes se ajusten sin distorsión */
    }

    /* Espaciado entre las tarjetas */
    .row > .col-12.col-md-6.col-lg-4 {
        display: flex;
        justify-content: center; /* Centra las tarjetas dentro de la fila */
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
                    <a href="" class="">Carrito</a>
                </li>
                <li>
                    <a href="" class="">Contacto</a>
                </li>
                <li>
                    <a href="login.php" class="">Iniciar Sesion</a>
                </li>
            </ul>
        </nav>
    </header>
    <script src="script2.js"></script>

    <body>
    <div class="container my-5">
    <h1 class="text-center mb-4">Collares de JennaWork</h1>
    <div class="row">
        <?php
        // Conexión a la base de datos
        $conexion = mysqli_connect("localhost", "root", "", "jennawork") or die("Error en la base de datos.");

        // Consulta para obtener collares de la marca JennaWork
        $consultaCollares = "SELECT * FROM productos WHERE Tipo_Productos = 'Collares' AND Marca = 'JennaWork'";
        $resultadoCollares = mysqli_query($conexion, $consultaCollares);

        // Verificar si hay resultados
        if ($resultadoCollares && mysqli_num_rows($resultadoCollares) > 0) {
            while ($row = mysqli_fetch_assoc($resultadoCollares)) {
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
                echo "<a href='#' class='btn btn-primary'>Comprar</a>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
            }
        } else {
            // Mostrar mensaje si no hay collares
            echo "<p class='text-center col-12'>No hay collares disponibles de la marca JennaWork.</p>";
        }

        // Cerrar conexión
        mysqli_close($conexion);
        ?>
    </div>
</div>

</body>
</html>