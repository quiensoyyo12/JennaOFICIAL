<html>

<head>
    <title>Productos</title>

    <link href="css/css/bootstrap.css"
        rel="stylesheet"
        crossorigin="anonymous">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/css/bootstrap.css"
        rel="stylesheet"
        crossorigin="anonymous">

</head>

<body>
    <div class="container text-center">

        <div class="row">
            <div class="col">

            </div>
            <div class="col-6">
    <h2>Alta de productos</h2>
    <?php
// Validar que los datos del formulario están definidos
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['imagen'])) {
    $idProductos = $_POST['idProductos'] ?? '';
    $Tipo_Productos = $_POST['Tipo_Productos'] ?? '';
    $Nombre_producto = $_POST['Nombre_producto'] ?? '';
    $Marca = $_POST['Marca'] ?? '';
    $Descripcion_Productos = $_POST['Descripcion_Productos'] ?? '';
    $Cantidad_Productos = $_POST['Cantidad_Productos'] ?? 0;
    $Precio = $_POST['Precio'] ?? 0;

    // Validar si el precio es un número
    if (!is_numeric($Precio)) {
        $Precio = 0.00;
    }

    // Procesar la imagen
    $imagenBlob = null;
    if ($_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
        $imagenTmp = $_FILES['imagen']['tmp_name'];
        $imagenBlob = file_get_contents($imagenTmp);
    } else {
        echo "<h3>No se subió ninguna imagen.</h3>";
    }

    // Conectar a la base de datos
    $conexion = mysqli_connect("localhost", "root", "", "jennawork");

    if (!$conexion) {
        die("<h3>Error en la conexión con la base de datos: " . mysqli_connect_error() . "</h3>");
    }

    // Usar consultas preparadas para mayor seguridad
    $consulta = $conexion->prepare(
        "INSERT INTO productos (idProductos, Tipo_Productos, Nombre_producto, Marca, Descripcion_Productos, Cantidad_Productos, Precio, imagen) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)"
    );

    if ($consulta) {
        $consulta->bind_param(
            "issssids",
            $idProductos,
            $Tipo_Productos,
            $Nombre_producto,
            $Marca,
            $Descripcion_Productos,
            $Cantidad_Productos,
            $Precio,
            $imagenBlob
        );

        if ($consulta->execute()) {
            echo "<h3>Datos insertados correctamente.</h3>";
        } else {
            echo "<h3>Error al insertar datos: " . $consulta->error . "</h3>";
        }

        $consulta->close();
    } else {
        echo "<h3>Error al preparar la consulta: " . $conexion->error . "</h3>";
    }

    // Cerrar la conexión
    mysqli_close($conexion);
} else {
    echo "<h3>Por favor, complete el formulario correctamente.</h3>";
}
?>

</div>



</body>

</html>