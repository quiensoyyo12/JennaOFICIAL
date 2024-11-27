<?php
header('Content-Type: application/json');

// Conexión a la base de datos
include 'conexion.php'; // Asegúrate de que la ruta sea correcta
if ($conexion->connect_error) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Error de conexión a la base de datos']);
    exit;
}

// Verifica el método HTTP
if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    // Leer el cuerpo de la solicitud
    parse_str(file_get_contents("php://input"), $data);

    // Validar datos recibidos
    $idEmpleados = $conexion->real_escape_string($data['idEmpleados'] ?? '');
    $nombre = $conexion->real_escape_string($data['Nombre'] ?? '');
    $apellido = $conexion->real_escape_string($data['Apellido_p'] ?? '');
    $apellidom = $conexion->real_escape_string($data['Apellido_m'] ?? '');
    $correo = $conexion->real_escape_string($data['correo'] ?? '');
    $genero = $conexion->real_escape_string($data['Genero'] ?? '');
    $telefono = $conexion->real_escape_string($data['Telefono'] ?? '');
    $rfc = $conexion->real_escape_string($data['rfc'] ?? '');
    $idtipo = $conexion->real_escape_string($data['idTiposEmp'] ?? '');
    $idusuario = $conexion->real_escape_string($data['idUsuario'] ?? '');

    // Verifica que el ID y los campos requeridos no estén vacíos
    if (!$idEmpleados || !$nombre || !$apellido) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Faltan datos obligatorios']);
        exit;
    }

    // Actualizar datos
    $query = "UPDATE empleados SET 
                Nombre = '$nombre', 
                Apellido_p = '$apellido', 
                Apellido_m = '$apellidom', 
                correo = '$correo', 
                Genero = '$genero', 
                Telefono = '$telefono', 
                rfc = '$rfc', 
                idTiposEmp = '$idtipo', 
                idUsuario = '$idusuario'
              WHERE idEmpleados = '$idEmpleados'";

    if ($conexion->query($query)) {
        echo json_encode(['success' => true]);
    } else {
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => $conexion->error]);
    }
} else {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Método no permitido']);
}

$conexion->close();
?>
