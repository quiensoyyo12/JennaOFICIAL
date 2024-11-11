<html>

<head>
    <title>Control</title>
    <link href="css/css/bootstrap.css" rel="stylesheet" crossorigin="anonymous">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/css/bootstrap.css" rel="stylesheet" crossorigin="anonymous">

</head>

<body>
    <div class="container text-center">

        <div class="row">
            <div class="col">

            </div>
            <div class="col-6">
                <h2>Detalle de pedido</h2>
                <?php
                // Conectar a la base de datos
                $conexion = mysqli_connect("localhost", "root", "", "jennawork");

                if (!$conexion) {
                    die("Error de conexión: " . mysqli_connect_error());
                }

                // Consultar IDs de productos
                $query_productos = "SELECT idProducto FROM productos";
                $resultado_productos = mysqli_query($conexion, $query_productos);

                // Consultar IDs de pedidos
                $query_pedidos = "SELECT idPedido FROM pedidos";
                $resultado_pedidos = mysqli_query($conexion, $query_pedidos);

                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $idDetalle_peddido = $_POST['id_control'];
                    $idProductos = $_POST['productos'];
                    $idPedidos = $_POST['pedidos'];

                    // Insertar los datos en la tabla detalle_pedido
                    $consulta = "INSERT INTO detalle_pedido (idDetalle, idProducto, idPedido) VALUES ('$idDetalle_peddido', '$idProductos', '$idPedidos')";
                    $resultado = mysqli_query($conexion, $consulta);

                    if ($resultado) {
                        echo "<h3>Datos insertados</h3>";
                    } else {
                        echo "<h3>Datos no insertados: " . mysqli_error($conexion) . "</h3>";
                    }
                }

                // Guardar los resultados en variables para usarlos en el HTML
                $productos_options = '';
                while ($row = mysqli_fetch_assoc($resultado_productos)) {
                    $productos_options .= "<option value='" . $row['idProducto'] . "'>" . $row['idProducto'] . "</option>";
                }

                $pedidos_options = '';
                while ($row = mysqli_fetch_assoc($resultado_pedidos)) {
                    $pedidos_options .= "<option value='" . $row['idPedido'] . "'>" . $row['idPedido'] . "</option>";
                }

                // Liberar resultados y cerrar la conexión
                mysqli_free_result($resultado_productos);
                mysqli_free_result($resultado_pedidos);
                mysqli_close($conexion);
                ?>

            </div>
            <div class="col">

            </div>
        </div>
    </div>


</body>

</html>