<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Archivos Bosststrap-->
    <link rel="stylesheet" href="css/css/bootstrap.css" type="text/css">
    <link href="css/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <title>Eliminación de productos</title>
</head>
<body>
    <div class="container text-center">
        <div class="row">
            <div class="col">
            </div>
            <div class="col-6">
                <h2>Eliminación de productos</h2>
                <?php
$idProductos = $_POST['idProductos'] ?? null;

if (!$idProductos) {
    die("ID no proporcionado.");
}

echo "ID recibido: $idProductos<br>"; // Depuración
$conexion = mysqli_connect("localhost", "root", "", "jennawork");

if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

$consulta = "DELETE FROM productos WHERE idProductos='$idProductos'";
$resultado = mysqli_query($conexion, $consulta);

if ($resultado && mysqli_affected_rows($conexion) > 0) {
    echo "<h3>Datos borrados</h3>";
} else {
    echo "<h3>Error al borrar los datos o el ID no existe</h3>";
}

mysqli_close($conexion);
?>

                <a href="Consultaproductos.html" class="btn btn-outline-primary">Regresar a la tabla</a>
            </div>
            <div class="col">
            </div>
        </div>
    </div>
</body>
</html>