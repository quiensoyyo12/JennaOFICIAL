<?php
header('Content-Type: application/json');

// Conexión a la base de datos
include 'conexion.php'; // Asegúrate de que la ruta sea correcta

if (!$conexion) {
    echo json_encode(['success' => false, 'message' => 'Error de conexión a la base de datos']);
    exit();
}

// Recuperar datos enviados por POST
$id = $_POST['id'];
$tipo = $_POST['tipo'];
$nombre = $_POST['nombre'];
$marca = $_POST['marca'];
$descripcion = $_POST['descripcion'];
$cantidad = $_POST['cantidad'];
$precio = $_POST['precio'];

// Inicializar variables
$imagen = null;

// Procesar la imagen si está presente
if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
    $fileTmpPath = $_FILES['imagen']['tmp_name'];
    $fileData = file_get_contents($fileTmpPath);
    $imagen = mysqli_real_escape_string($conexion, $fileData); // Escapar para SQL
}

// Construir consulta SQL
$query = "UPDATE productos 
          SET Tipo_Productos = '$tipo', 
              Nombre_producto = '$nombre', 
              Marca = '$marca', 
              Descripcion_Productos = '$descripcion', 
              Cantidad_Productos = '$cantidad', 
              Precio = '$precio'";

// Solo actualizar la imagen si se subió
if ($imagen !== null) {
    $query .= ", imagen = '$imagen'";
}

$query .= " WHERE idProductos = '$id'";

// Ejecutar consulta
if (mysqli_query($conexion, $query)) {
    echo json_encode([
        'success' => true,
        'id' => $id,
        'tipo' => $tipo,
        'nombre' => $nombre,
        'marca' => $marca,
        'descripcion' => $descripcion,
        'cantidad' => $cantidad,
        'precio' => $precio,
        'imagen' => $imagen ? base64_encode($imagen) : null // Devolver la imagen actualizada si existe
    ]);
} else {
    echo json_encode(['success' => false, 'message' => mysqli_error($conexion)]);
}

mysqli_close($conexion);
?>
