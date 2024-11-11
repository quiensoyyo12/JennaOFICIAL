<html>

<head>
    <title>Productos</title>
   
    <link href="css/css/bootstrap.css" 
            rel="stylesheet"
            crossorigin="anonymous">
            <meta charset="utf-8">
                <meta name="viewport" content="width=device-width, initial-scale=1" >
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
// Recibir los datos del formulario
$idProductos = $_POST['idProductos'];
$Tipo_Productos = $_POST['Tipo_Productos'];
$Nombre_producto = $_POST['Nombre_producto'];
$Marca = $_POST['Marca'];
$Descripcion_Productos = $_POST['Descripcion_Productos'];
$Cantidad_Productos = $_POST['Cantidad_Productos'];
$Precio = $_POST['Precio'];

// Procesar la imagen
if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
    // Ruta de destino
    $imagenTmp = $_FILES['imagen']['tmp_name'];
    $imagenNombre = uniqid() . "-" . $_FILES['imagen']['name'];
    $rutaDestino = __DIR__ . "/imagenes/" . $imagenNombre;


    // Mover la imagen al destino
    if (move_uploaded_file($imagenTmp, $rutaDestino)) {
        echo "Imagen subida exitosamente";
    } else {
        echo "Error al subir la imagen.<br>";
        $rutaDestino = null; // Si no se sube, el valor será NULL
    }
} else {
    echo "No se subió ninguna imagen.<br>";
    $rutaDestino = null;
}

// Conectar a la base de datos
$conexion = mysqli_connect("localhost", "root", "", "jennawork") or die("Error en la B.D.");

// Insertar en la base de datos
$Consulta = "INSERT INTO productos (idProductos, Tipo_Productos, Nombre_producto, Marca, Descripcion_Productos, Cantidad_Productos, Precio, imagen)
             VALUES ('$idProductos', '$Tipo_Productos', '$Nombre_producto', '$Marca', '$Descripcion_Productos', '$Cantidad_Productos', '$Precio', '$rutaDestino')";
$resultado = mysqli_query($conexion, $Consulta);

if ($resultado) {
    echo "<h3>Datos insertados correctamente.</h3>";
} else {
    echo "<h3>Error al insertar datos: " . mysqli_error($conexion) . "</h3>";
}

// Cerrar la conexión
mysqli_close($conexion);
?>

            </div>
            <div class="col">
            
            </div>
        </div>
    </div>
    

</body>
</html>