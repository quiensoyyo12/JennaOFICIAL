<html>

<head>
    <!--Código para acentos y ñ -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>Actualizar los Productos</title>
    <link href="css/css/bootstrap.css"
        type="text/css" rel="stylesheet">
    <title>Actualizacion de Productos</title>

<body>
    <div class="container">
        <div class="row">
            <div class="col"></div>
            <div class="col-6">
            <?php
$servername = "localhost"; // Cambia esto si es necesario
$username = "root"; // Cambia esto por tu usuario de MySQL
$password = ""; // Cambia esto por tu contraseña de MySQL
$dbname = "jennawork";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verificar si se recibieron los datos
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idProductos = $_POST['idProductos'];
    $Tipo_Productos = $_POST['Tipo_Productos'];
    $Nombre_Productos = $_POST['Nombre_Producto'];
    $Marca = $_POST['Marca'];
    $Descripcion_Productos = $_POST['Descripcion_Productos'];
    $Cantidad_Productos = $_POST['Cantidad_Productos'];
    $Precio = $_POST['Precio'];

    // Consulta para actualizar el producto
    $sql = "UPDATE productos SET 
                Tipo_Productos = ?, 
                Nombre_Producto = ?, 
                Marca = ?, 
                Descripcion_Productos = ?, 
                Cantidad_Productos = ?, 
                Precio = ? 
            WHERE idProductos = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssdsi", $Tipo_Productos, $Nombre_Producto, $Marca, $Descripcion_Productos, $Cantidad_Productos, $Precio, $idProductos);

    if ($stmt->execute()) {
        echo "Producto actualizado exitosamente";
    } else {
        echo "Error al actualizar el producto: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>

                <a href="Consultaproductos.php" class="btn btn-outline-primary">
                    Consulta a la tabla
            </div>
            <div class="col"></div>
        </div>

    </div>
</body>
</head>

</html>