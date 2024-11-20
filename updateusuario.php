<?php
header('Content-Type: application/json');
$conexion = mysqli_connect("localhost", "root", "", "jennawork") or die("Error de conexión");

$id = $_POST['id'];
$nombre = $_POST['nombre'];
$apellido_paterno = $_POST['apellido_paterno'];
$apellido_materno = $_POST['apellido_materno'];
$correo = $_POST['correo'];
$contrasena = $_POST['contrasena'];
$tipo_usuario = $_POST['tipo_usuario'];

$query = "UPDATE usuario SET 
            Nombre = '$nombre', 
            Apellido_paterno = '$apellido_paterno', 
            Apellido_materno = '$apellido_materno', 
            correo = '$correo', 
            contrasena = '$contrasena', 
            tipo_usuario = '$tipo_usuario'
          WHERE id = '$id'";

if (mysqli_query($conexion, $query)) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => mysqli_error($conexion)]);
}
mysqli_close($conexion);
?>
