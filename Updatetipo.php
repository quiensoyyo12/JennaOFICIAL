<?php
header('Content-Type: application/json');
$conexion = mysqli_connect("localhost", "root", "", "jennawork") or die("Error de conexión");

$idTiposEmp = $_POST['idTiposEmp'];
$administrador = $_POST['administrador'];
$auxiliar = $_POST['auxiliar'];
$cliente = $_POST['cliente'];

$query = "UPDATE tiposempledos SET 
            administrador = '$administrador', 
            auxiliar = '$auxiliar', 
            cliente = '$cliente'
          WHERE idTiposEmp = '$idTiposEmp'";

if (mysqli_query($conexion, $query)) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => mysqli_error($conexion)]);
}
mysqli_close($conexion);
?>