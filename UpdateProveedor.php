<?php
header('Content-Type: application/json');
include 'conexion.php'; // Asegúrate de que la ruta sea correcta

$id = $_POST['idProveedor'];
$nombre = $_POST['Nombre'];
$apellidoP = $_POST['ApellidoP'];
$apellidoM = $_POST['ApellidoM'];
$rfc = $_POST['rfc'];
$telefono = $_POST['Telefono'];
$domicilio = $_POST['Domicilio'];
$correo = $_POST['correo'];

$query = "UPDATE proveedor SET 
          Nombre = '$nombre', 
          ApellidoP = '$apellidoP', 
          ApellidoM = '$apellidoM', 
          rfc = '$rfc', 
          Telefono = '$telefono', 
          Domicilio = '$domicilio', 
          correo = '$correo' 
          WHERE idProveedor = '$id'";

if (mysqli_query($conexion, $query)) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => mysqli_error($conexion)]);
}
mysqli_close($conexion);
?>
