<?php
// Conexión a la base de datos
include 'conexion.php'; // Asegúrate de que la ruta sea correcta
if (!$conexion) {
    die("Conexión fallida: " . mysqli_connect_error());
}

// Comprobar si se ha recibido un idEmpleados
if (isset($_GET['id'])) {
    $idEmpleado = $_GET['id'];

    // Preparar y ejecutar la consulta SQL para eliminar el empleado
    $consulta = "DELETE FROM empleados WHERE idEmpleados = ?";
    $stmt = mysqli_prepare($conexion, $consulta);
    mysqli_stmt_bind_param($stmt, 'i', $idEmpleado);  // 'i' es para tipo entero
    $resultado = mysqli_stmt_execute($stmt);

    if ($resultado) {
        // Redirigir de vuelta a la página principal (o tabla) después de eliminar
        header("Location: Consultaempleado.php");  // Cambia "index.php" por la URL correcta
        exit();
    } else {
        echo "Error al eliminar el registro: " . mysqli_error($conexion);
    }

    // Cerrar la conexión
    mysqli_stmt_close($stmt);
}

mysqli_close($conexion);
?>

