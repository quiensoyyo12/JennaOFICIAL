<?php

session_start();

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

// Ahora puedes acceder al ID del usuario logueado
$id = $_SESSION['id'];

$conexion = mysqli_connect("localhost", "root", "", "jennawork");


$consulta_ciudadanos = "SELECT * FROM usuario where id = '$id'";
$resultado_ciudadanos = mysqli_query($conexion, $consulta_ciudadanos) or die(mysqli_error($conexion));
$fila_ciudadano = mysqli_fetch_assoc($resultado_ciudadanos);
?>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "jennawork";
$conn = new mysqli($servername, $username, $password, $dbname);
// Verifica la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}


?>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login/styleB.css">
    <link rel="stylesheet" href="css/css/bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="styleTabla.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <title>Listado de Pedidos</title>



</head>

<body>
    <header>
        <div class="logo">
            <img src="images/logoJenna-removebg-preview.png" alt="Logo de la Empresa" class="logo-img">
        </div>
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
                <div class="d-flex">
                    <h5 style="color: white; font-size: 1.2rem; font-weight: bold;">
                        <?php
                        echo htmlspecialchars($fila_ciudadano['Nombre']);
                        ?>
                        --
                    </h5>
                    <!-- Button trigger modal -->
                    <a data-bs-toggle="modal" data-bs-target="#exampleModal"><img src="images/salir-alt (2).png" alt="cerrar sesion" width="40" height="32"></a>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5 lemon-regular" id="exampleModalLabel">¿Estas Seguro?</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p style="color: black;">Estas a Punto de Cerrar Sesión</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Continuar</button>
                                    <a type="button" class="btn btn-primary" href="cerrarSesion.php">Cerrar Sesión</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </ul>
        </nav>
    </header>
    <script src="script2.js"></script>

    <div class="container my-4">
    <h2>Listado de Pedidos</h2>
    <div class="table-responsive">
        <a href="reporte_pedidos.php" class="btn btn-primary">Generar Reporte PDF</a>
        <table class="table  table-striped table-bordered">
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
                // Configuración de la paginación
                $conexion = mysqli_connect("localhost", "root", "", "jennawork") or die("Error de conexión de BD");
                $registros_por_pagina = 5; // Número de registros por página
                $pagina_actual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
                $offset = ($pagina_actual - 1) * $registros_por_pagina;

                // Consulta con paginación
                $consulta = "SELECT * FROM pedidos LIMIT $registros_por_pagina OFFSET $offset";
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

                // Calcular total de páginas
                $consulta_total = "SELECT COUNT(*) AS total FROM pedidos";
                $resultado_total = mysqli_query($conexion, $consulta_total);
                $total_filas = mysqli_fetch_assoc($resultado_total)['total'];
                $total_paginas = ceil($total_filas / $registros_por_pagina);

                mysqli_close($conexion);
                ?>
            </tbody>
        </table>

        <!-- Paginación -->
        <nav>
            <ul class="pagination justify-content-center">
                <?php
                // Botón "Anterior"
                if ($pagina_actual > 1) {
                    echo '<li class="page-item"><a class="page-link" href="?pagina=' . ($pagina_actual - 1) . '">Anterior</a></li>';
                }

                // Números de página
                for ($i = 1; $i <= $total_paginas; $i++) {
                    $active = ($i == $pagina_actual) ? 'active' : '';
                    echo '<li class="page-item ' . $active . '"><a class="page-link" href="?pagina=' . $i . '">' . $i . '</a></li>';
                }

                // Botón "Siguiente"
                if ($pagina_actual < $total_paginas) {
                    echo '<li class="page-item"><a class="page-link" href="?pagina=' . ($pagina_actual + 1) . '">Siguiente</a></li>';
                }
                ?>
            </ul>
        </nav>
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
                            <input type="number" class="form-control" id="updateTotal" name="Total" required>
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
        $(document).ready(function() {
            // Mostrar el modal al hacer clic en el botón "Actualizar"
            $(".actualizar-btn").click(function() {
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
            $("#saveUpdateBtn").click(function() {
                let formData = $("#updateForm").serialize();

                // Deshabilitar el botón para evitar múltiples clics
                $(this).prop("disabled", true).text("Actualizando...");

                $.ajax({
                    url: "Updatepedidos.php",
                    type: "POST",
                    data: formData,
                    dataType: "json", // Esperamos una respuesta JSON del servidor
                    success: function(response) {
                        if (response.success) {
                            // Mostrar un mensaje de éxito (opcional)
                            alert("Pedido actualizado correctamente.");

                            // Refrescar la página para reflejar cambios
                            location.reload();
                        } else {
                            // Manejar errores específicos del servidor
                            alert("Error al actualizar: " + response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        // Manejar errores del servidor o de conexión
                        alert("Ocurrió un error: " + error);
                    },
                    complete: function() {
                        // Habilitar el botón nuevamente
                        $("#saveUpdateBtn").prop("disabled", false).text("Actualizar");
                    }
                });

                // Cerrar el modal después de enviar la solicitud
                $("#updateModal").modal("hide");
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Manejar evento de eliminar
            document.querySelectorAll('.eliminar-btn').forEach(button => {
                button.addEventListener('click', () => {
                    const id = button.getAttribute('data-id');
                    if (confirm('¿Estás seguro de que deseas eliminar este usuario?')) {
                        fetch('Eliminarpedidos.php', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/x-www-form-urlencoded',
                                },
                                body: `id=${id}`
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    alert('Usuario eliminado con éxito.');
                                    location.reload(); // Recargar para actualizar la tabla
                                } else {
                                    alert(`Error al eliminar: ${data.message}`);
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                alert('Hubo un problema al eliminar el usuario.');
                            });
                    }
                });
            });
        });
    </script>


</body>

</html>