<?php
header('Content-Type: application/json');
$conexion = mysqli_connect("localhost", "root", "", "jennawork") or die("Error de conexión");

$idEmpleados = $_POST['idEmpleados'];
$nombre = $_POST['Nombre'];
$apellido = $_POST['Apellido_p'];
$apellidom = $_POST['Apellido_m'];
$correo = $_POST['correo'];
$contrasena = $_POST['contrasena'];
$genero = $_POST['Genero'];
$telefono = $_POST['Telefono'];
$rfc = $_POST['rfc'];
$idtipo = $_POST['idTiposEmp'];
$idusuario = $_POST['idUsuario'];

$query = "UPDATE empleados SET 
            Nombre = '$nombre', 
            Apellido_p = '$apellido', 
            Apellido_m = '$apellidom', 
            correo = '$correo', 
            contrasena = '$contrasena', 
            Genero = '$genero', 
            Telefono = '$telefono', 
            rfc = '$rfc', 
            idTiposEmp = '$idtipo', 
            idUsuario = '$idusuario'
            WHERE idEmpleados = '$idEmpleados'";

if (mysqli_query($conexion, $query)) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => mysqli_error($conexion)]);
}
mysqli_close($conexion);
?>