<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login/styleB.css">
    <link rel="stylesheet" href="css/css/bootstrap.css">
    <link rel="stylesheet" href="styleCon2.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

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
                <button class='btn btn-sm btn-warning actualizar-btn' 
                        data-id='{$row['idPedidos']}' 
                        data-cantidad='{$row['Cantidad_Pedidos']}' 
                        data-fecha='{$row['FechaEntrega_Pedidos']}' 
                        data-total='{$row['Total']}' 
                        data-proveedor='{$row['idProveedor']}'>
                    Actualizar
                </button>
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
<!-- Modal para Actualizar Pedido -->
<div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateModalLabel">Actualizar Pedido</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <form id="updateForm">
                    <input type="hidden" id="updateId" name="idPedidos">
                    <div class="mb-3">
                        <label for="updateCantidad" class="form-label">Cantidad de Productos</label>
                        <input type="number" class="form-control" id="updateCantidad" name="Cantidad_Pedidos" required>
                    </div>
                    <div class="mb-3">
                        <label for="updateFechaEntrega" class="form-label">Fecha de Entrega</label>
                        <input type="date" class="form-control" id="updateFechaEntrega" name="FechaEntrega_Pedidos" required>
                    </div>
                    <div class="mb-3">
                        <label for="updateTotal" class="form-label">Total</label>
                        <input type="number" step="0.01" class="form-control" id="updateTotal" name="Total" required>
                    </div>
                    <div class="mb-3">
                        <label for="updateIdProveedor" class="form-label">ID Proveedor</label>
                        <input type="number" class="form-control" id="updateIdProveedor" name="idProveedor" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="saveUpdateBtn">Actualizar</button>
            </div>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
   $(document).ready(function () {
    // Mostrar el modal al hacer clic en el botón "Actualizar"
    $(".actualizar-btn").click(function () {
        let id = $(this).data("id");
        let cantidad = $(this).data("cantidad");
        let fecha = $(this).data("fecha");
        let total = $(this).data("total");
        let proveedor = $(this).data("proveedor");

        $("#updateId").val(id);
        $("#updateCantidad").val(cantidad);
        $("#updateFechaEntrega").val(fecha);
        $("#updateTotal").val(total);
        $("#updateIdProveedor").val(proveedor);

        $("#updateModal").modal("show");
    });

    // Manejar la actualización
    $("#saveUpdateBtn").click(function () {
        let formData = $("#updateForm").serialize();

        $.ajax({
            url: "Updatepedidos.php",
            type: "POST",
            data: formData,
            dataType: "json", // Esperamos una respuesta JSON del servidor
            success: function (response) {
                if (response.status === "success") {
                    alert(response.message); // Muestra el mensaje del servidor
                    location.reload(); // Refresca la página para reflejar cambios
                } else {
                    alert("Error: " + response.message); // Muestra el error específico
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.error("Detalles del error:", textStatus, errorThrown);
                alert("Ocurrió un problema al procesar la solicitud. Por favor, intenta de nuevo.");
            }
        });

        // Cerrar el modal
        $("#updateModal").modal("hide");
    });
});

</script>


</body>

</html>