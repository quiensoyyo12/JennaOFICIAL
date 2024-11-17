<?php
include 'conexion.php';
session_start();

// Validar si se envió el producto
if (isset($_POST['idProductos'])) {
    $idProductos = (int)$_POST['idProductos'];
    $Nombre_producto = mysqli_real_escape_string($conexion, $_POST['Nombre_producto']);
    $Precio = (float)$_POST['Precio'];

    // Establecer cantidad predeterminada a 1
    $Cantidad_Productos = 1;

    // Consultar si el producto ya está en el carrito
    $query = "SELECT * FROM carrito WHERE idProductos = $idProductos";
    $resultado = mysqli_query($conexion, $query);

    if (!$resultado) {
        die("Error en la consulta SELECT: " . mysqli_error($conexion));
    }

    if (mysqli_num_rows($resultado) == 0) {
        // Si el producto no existe, agregarlo con cantidad 1
        $query = "INSERT INTO carrito (idProductos, Nombre_producto, Precio, Cantidad_Productos) 
                  VALUES ($idProductos, '$Nombre_producto', $Precio, $Cantidad_Productos)";
        if (mysqli_query($conexion, $query)) {
            // Devolver respuesta JSON sin redirigir
            echo json_encode(["success" => true, "message" => "Producto agregado al carrito."]);
        } else {
            echo json_encode(["success" => false, "message" => "Error al insertar el producto en el carrito."]);
        }
    } else {
        // Si el producto ya existe, actualizar la cantidad en lugar de solo mostrar un mensaje
        $query = "UPDATE carrito SET Cantidad_Productos = Cantidad_Productos + 1 WHERE idProductos = $idProductos";
        if (mysqli_query($conexion, $query)) {
            echo json_encode(["success" => true, "message" => "Producto actualizado en el carrito."]);
        } else {
            echo json_encode(["success" => false, "message" => "Error al actualizar el carrito."]);
        }
    }
} else {
    echo json_encode(["success" => false, "message" => "Datos del producto no válidos."]);
}



