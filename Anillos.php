<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login/styleB.css">
    <link rel="stylesheet" href="css/css/bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/bootstrap.min.js"></script>
    <title>Anillos - JennaWork</title>
    
</head>
<style>
        header {
        display: flex;
        align-items: center; /* Centra verticalmente los elementos */
        justify-content: space-between; /* Espacia los elementos a los lados */
        padding: 10px 20px; /* Ajusta según lo necesites */
        background-color: black; /* Color de fondo */
    }
    
    .logo-img {
        max-height: 100px; /* Ajusta la altura máxima para que encaje en el header */
        width: auto; /* Mantiene la proporción de la imagen */
    }
    
 
    .bars .line {
        width: 25px; /* Ancho de las líneas */
        height: 3px; /* Grosor de las líneas */
        background-color: white; /* Color de las líneas */
    }
    
    .nav-bar ul {
        display: flex;
        gap: 15px; /* Espacio entre los enlaces */
        list-style: none;
        padding: 0;
        margin: 0;
    }
    
    .nav-bar a {
        text-decoration: none;
        color: white; /* Color de los enlaces */
        padding: 8px 12px;
        transition: background-color 0.3s;
    }
    
    .nav-bar a:hover {
        background-color: rgba(255, 255, 255, 0.2); /* Efecto hover */
    }
    
    a {
        text-decoration: none;
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
            <img src="./images/logo_of.png" alt="Logo de la Empresa" class="logo-img">
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

    <div class="container my-5">
        <h1 class="text-center mb-4">Anillos de JennaWork</h1>
        <div class="row">
            <?php
            // Conexión a la base de datos
            $conexion = mysqli_connect("localhost", "root", "", "jennawork") or die("Error en la base de datos.");

            // Consulta para obtener los aretes de la marca JennaWork
            $consultaAretes = "SELECT * FROM productos WHERE Tipo_Productos = 'Anillos' AND Marca = 'JennaWork'";
            $resultadoAretes = mysqli_query($conexion, $consultaAretes);

            // Verificar si hay resultados
            if ($resultadoAretes && mysqli_num_rows($resultadoAretes) > 0) {
                while ($row = mysqli_fetch_assoc($resultadoAretes)) {
                    echo "<div class='col-12 col-md-6 col-lg-4 mb-4'>";
                    echo "<div class='card text-center'>";
                    // Mostrar la imagen del producto
                    if (!empty($row['imagen'])) {
                        echo "<img src='uploads/{$row['imagen']}' class='card-img-top' alt='{$row['Nombre_producto']}'>";
                    } else {
                        echo "<img src='images/default.jpg' class='card-img-top' alt='Imagen no disponible'>";
                    }
                    // Mostrar detalles del producto
                    echo "<div class='card-body'>";
                    echo "<h5 class='card-title'>{$row['Nombre_producto']}</h5>";
                    echo "<p class='card-text'>{$row['Descripcion_Productos']}</p>";
                    echo "<p class='card-text'><strong>Precio:</strong> $" . number_format($row['Precio'], 2) . "</p>";
                    echo "<p class='card-text'><strong>Cantidad:</strong> {$row['Cantidad_Productos']} disponibles</p>";
                    echo "<a href='#' class='btn btn-primary'>Comprar</a>";
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                }
            } else {
                echo "<p class='text-center col-12'>No hay aretes disponibles de la marca JennaWork.</p>";
            }

            // Cerrar conexión
            mysqli_close($conexion);
            ?>
        </div>
    </div>
</body>
</html>