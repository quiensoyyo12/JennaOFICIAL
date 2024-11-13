<?php
header('Content-Type: application/json');

// Conexión a la base de datos
$conexion = mysqli_connect("localhost", "root", "", "jennawork");

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

// Actualizar datos en la base de datos
$query = "UPDATE productos 
          SET Tipo_Productos = '$tipo', 
              Nombre_producto = '$nombre', 
              Marca = '$marca', 
              Descripcion_Productos = '$descripcion', 
              Cantidad_Productos = '$cantidad', 
              Precio = '$precio' 
          WHERE idProductos = '$id'";

if (mysqli_query($conexion, $query)) {
    echo json_encode([
        'success' => true,
        'id' => $id,
        'tipo' => $tipo,
        'nombre' => $nombre,
        'marca' => $marca,
        'descripcion' => $descripcion,
        'cantidad' => $cantidad,
        'precio' => $precio
    ]);
} else {
    echo json_encode(['success' => false, 'message' => mysqli_error($conexion)]);
}

mysqli_close($conexion);
?>
