<?php
header("Content-Type: application/json");

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "jennawork";

try {
    // Crear conexión
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Preparar consulta
    $stmt = $conn->prepare("SELECT * FROM productos");
    $stmt->execute();

    // Obtener resultados como array asociativo
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($result); // Enviar los datos como JSON
} catch (PDOException $e) {
    echo json_encode(["error" => $e->getMessage()]);
}
?>

