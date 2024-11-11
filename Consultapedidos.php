<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login/styleB.css">
    <link rel="stylesheet" href="css/css/bootstrap.css">
    <link rel="stylesheet" href="styleCon2.css">
    <title>Listado de Pedidos</title>



</head>

<body>
    <header>
        <div class="logo">logo</div>
        <div class="bars">
            <div class="line"></div>
            <div class="line"></div>
            <div class="line"></div>
        </div>
        <nav class="nav-bar">
            <ul>
                <li>
                    <a href="" class="active">inicio</a>
                </li>
                <li>
                    <a href="" class="">Blog</a>
                </li>
                <li>
                    <a href="" class="">Portafolio</a>
                </li>
                <li>
                    <a href="" class="">Contacto</a>
                </li>
            </ul>
        </nav>
    </header>
    <script src="script2.js"></script>

    <div class="container my-4">
    <h2>Listado de Pedidos</h2>
    <div class="table-responsive">
        <table class="table table-success table-striped table-bordered">
            <thead>
                <tr>
                    <th>ID Pedido</th>
                    <th>Cantidad de Productos</th>
                    <th>Fecha de Entrega</th>
                    <th>Total</th>
                    <th>ID Proveedor</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $conexion = mysqli_connect("localhost", "root", "", "jennawork") or die("Error de conexión de BD");
                $consulta = "SELECT * FROM pedidos";
                $resultado = mysqli_query($conexion, $consulta);

                if (mysqli_num_rows($resultado) > 0) {
                    while ($row = mysqli_fetch_assoc($resultado)) {
                        echo "<tr>";
                        echo "<td>{$row['idPedidos']}</td>";
                        echo "<td>{$row['Cantidad_Pedidos']}</td>";
                        echo "<td>{$row['FechaEntrega_Pedidos']}</td>";
                        echo "<td>{$row['Total']}</td>";
                        echo "<td>{$row['idProveedor']}</td>";
                        echo "<td>
                                <button class='btn btn-sm btn-warning actualizar-btn' data-id='{$row['idPedidos']}'>Actualizar</button>
                                <button class='btn btn-sm btn-danger eliminar-btn' data-id='{$row['idPedidos']}'>Eliminar</button>
                              </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No hay pedidos registrados.</td></tr>";
                }
                mysqli_close($conexion);
                ?>
            </tbody>
        </table>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        // Botón Eliminar
        $(".eliminar-btn").click(function () {
            let id = $(this).data("id");
            if (confirm("¿Estás seguro de que deseas eliminar este pedido?")) {
                $.ajax({
                    url: "EliminarProductos.php",
                    type: "POST",
                    data: { idPedidos: id },
                    success: function (response) {
                        alert("El pedido ha sido eliminado.");
                        location.reload(); // Refresca la página después de la acción
                    },
                    error: function () {
                        alert("Ocurrió un error al intentar eliminar el pedido.");
                    }
                });
            }
        });

        // Botón Actualizar
        $(".actualizar-btn").click(function () {
            let id = $(this).data("id");
            $.ajax({
                url: "UpdateProductos.php",
                type: "POST",
                data: { idPedidos: id },
                success: function (response) {
                    alert("El pedido ha sido actualizado.");
                    location.reload(); // Refresca la página después de la acción
                },
                error: function () {
                    alert("Ocurrió un error al intentar actualizar el pedido.");
                }
            });
        });
    });
</script>


</body>

</html>