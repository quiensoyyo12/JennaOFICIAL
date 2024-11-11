<html>

<head>
    <title>Pedidos</title>
    <link href="css/css/bootstrap.css"
        rel="stylesheet"
        crossorigin="anonymous">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/css/bootstrap.css"
        rel="stylesheet"
        crossorigin="anonymous">

</head>

<body>
    <div class="container text-center">
        <div class="row">
            <div class="col">

            </div>
            <div class="col-6">
                <h2>Alta de pedidos</h2>
                <?php
                // Conexión a la base de datos
                $conexion = mysqli_connect("localhost", "root", "", "jennawork") or die("Error de conexión de BD");

                // Recibir datos del formulario
                $idPedidos = $_POST['idPedidos']; // Este campo puede estar vacío, ya que es autoincremental en la base de datos
                $Cantidad_Pedidos = $_POST['Cantidad_Pedidos'];
                $FechaEntrega_Pedidos = $_POST['FechaEntrega_Pedidos'];
                $Total = $_POST['Total'];
                $idProveedor = $_POST['idProveedor'];

                // Validar que los datos no estén vacíos
                if (!empty($Cantidad_Pedidos) && !empty($FechaEntrega_Pedidos) && !empty($Total) && !empty($idProveedor)) {
                    // Insertar datos en la tabla "pedidos"
                    $consulta = "INSERT INTO pedidos (CantidadProductos, FechaEntrega, Total, idProveedor) 
                 VALUES ('$Cantidad_Pedidos', '$FechaEntrega_Pedidos', '$Total', '$idProveedor')";

                    $resultado = mysqli_query($conexion, $consulta);

                    if ($resultado) {
                        echo "<h3>Pedido registrado correctamente.</h3>";
                    } else {
                        echo "<h3>Error al registrar el pedido: " . mysqli_error($conexion) . "</h3>";
                    }
                } else {
                    echo "<h3>Por favor, complete todos los campos.</h3>";
                }

                // Cerrar la conexión
                mysqli_close($conexion);
                ?>


            </div>
            <div class="col">

            </div>
        </div>
    </div>

</body>

</html>