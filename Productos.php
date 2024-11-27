<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['imagen'])) {
    $idProductos = $_POST['idProductos'] ?? '';
    $Tipo_Productos = $_POST['Tipo_Productos'] ?? '';
    $Nombre_producto = $_POST['Nombre_producto'] ?? '';
    $Marca = $_POST['Marca'] ?? '';
    $Descripcion_Productos = $_POST['Descripcion_Productos'] ?? '';
    $Cantidad_Productos = $_POST['Cantidad_Productos'] ?? 0;
    $Precio = $_POST['Precio'] ?? 0;

    if (!is_numeric($Precio)) {
        $Precio = 0.00;
    }

    $imagenBlob = null;
    if ($_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
        $imagenTmp = $_FILES['imagen']['tmp_name'];
        $imagenBlob = file_get_contents($imagenTmp);
    }

    include 'conexion.php'; // Asegúrate de que la ruta sea correcta
    if (!$conexion) {
        header('Location: ProductosAdmin.php?success=false&error=connection');
        exit;
    }

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
            header('Location: ProductosAdmin.php?success=true');
        } else {
            header('Location: ProductosAdmin.php?success=false&error=insert');
        }

        $consulta->close();
    } else {
        header('Location: ProductosAdmin.php?success=false&error=query');
    }

    mysqli_close($conexion);
} else {
    header('Location: ProductosAdmin.php?success=false&error=form');
}
exit;
?>
