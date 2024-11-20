<?php
include 'conexion.php';
session_start();

if (isset($_POST['idProductos'])) {
    $idProductos = (int)$_POST['idProductos'];
    $Nombre_producto = mysqli_real_escape_string($conexion, $_POST['Nombre_producto']);
    $Precio = (float)$_POST['Precio'];
    $Cantidad_Productos = (int)$_POST['Cantidad_Productos'];
    $imagen = $_POST['imagen']; // Imagen codificada en base64

    // Consultar si el producto ya está en el carrito
    $query = "SELECT * FROM carrito WHERE idProductos = $idProductos";
    $resultado = mysqli_query($conexion, $query);

    if (!$resultado) {
        die("Error en la consulta SELECT: " . mysqli_error($conexion));
    }

    if (mysqli_num_rows($resultado) == 0) {
        // Si el producto no existe, agregarlo con la cantidad seleccionada
        $query = "INSERT INTO carrito (idProductos, Nombre_producto, Precio, Cantidad_Productos, imagen) 
                  VALUES ($idProductos, '$Nombre_producto', $Precio, $Cantidad_Productos, '$imagen')";
        if (mysqli_query($conexion, $query)) {
            echo json_encode(["success" => true, "message" => "Producto agregado al carrito."]);
        } else {
            echo json_encode(["success" => false, "message" => "Error al insertar el producto en el carrito."]);
        }
    } else {
        // Si el producto ya existe, actualizar la cantidad
        $query = "UPDATE carrito SET Cantidad_Productos = Cantidad_Productos + $Cantidad_Productos WHERE idProductos = $idProductos";
        if (mysqli_query($conexion, $query)) {
            echo json_encode(["success" => true, "message" => "Producto actualizado en el carrito."]);
        } else {
            echo json_encode(["success" => false, "message" => "Error al actualizar el carrito."]);
        }
    }
} else {
    echo json_encode(["success" => false, "message" => "Datos del producto no válidos."]);
}
