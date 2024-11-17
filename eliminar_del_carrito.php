<?php
// Conexión a la base de datos
include('conexion.php');

// Verifica que el formulario haya sido enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener el ID del producto
    $idProducto = $_POST['idProductos'];

    // Eliminar el producto del carrito
    $query = "DELETE FROM carrito WHERE idProductos = '$idProducto'";
    $resultado = mysqli_query($conexion, $query);

    // Verificar si la eliminación fue exitosa
    if ($resultado) {
        // Redirigir a la página de productos en el carrito
        header("Location: " . $_SERVER['HTTP_REFERER']); // Esto redirige a la misma página
        exit(); // Asegúrate de que no se ejecute más código después de la redirección
    } else {
        echo "Error al eliminar el producto: " . mysqli_error($conexion);
    }
}
?>
