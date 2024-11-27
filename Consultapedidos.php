<?php

session_start();

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

// Ahora puedes acceder al ID del usuario logueado
$id = $_SESSION['id'];

include 'conexion.php'; // Asegúrate de que la ruta sea correcta

$consulta_ciudadanos = "SELECT * FROM usuario where id = '$id'";
$resultado_ciudadanos = mysqli_query($conexion, $consulta_ciudadanos) or die(mysqli_error($conexion));
$fila_ciudadano = mysqli_fetch_assoc($resultado_ciudadanos);
?>
<?php
    include 'conexion.php'; // Asegúrate de que la ruta sea correcta

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
    <style>
        /* Quitar subrayado de los enlaces en el menú */
        .nav-bar a {
            text-decoration: none !important;
            /* Quita cualquier subrayado */
        }

        /* Opcional: Cambiar el color del texto al pasar el mouse */
        .nav-bar a:hover {
            text-decoration: none;
            /* Asegura que no se subraye al pasar el mouse */
            color: #000;
            /* Cambia el color del texto si deseas un efecto */
        }
    </style>
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
                    <a href="inicioAdmin.php" class="">inicio</a>
                </li>
                <li>
                    <a href="#" class="">Reportes</a>
                </li>
                <li>
                    <a href="#" class="">Tikects</a>
                </li>
                <li>
                    <a href="#" class=""></a>
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

                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Configuración de la paginación
                    include 'conexion.php'; // Asegúrate de que la ruta sea correcta                    $registros_por_pagina = 5; // Número de registros por página
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

                            echo "<td>
               <button class='btn btn-sm btn-warning actualizar-btn' 
        data-id='{$row['idPedidos']}' 
        data-cantidad='{$row['Cantidad_Pedidos']}' 
        data-fecha='{$row['FechaEntrega_Pedidos']}' 
        data-total='{$row['Total']}'>
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
                            <input type="number" class="form-control" id="updateCantidad" name="Cantidad_Pedidos">
                        </div>
                        <div class="mb-3">
                            <label for="updateFechaEntrega" class="form-label">Fecha de Entrega</label>
                            <input type="date" class="form-control" id="updateFechaEntrega" name="FechaEntrega_Pedidos">
                        </div>
                        <div class="mb-3">
                            <label for="updateTotal" class="form-label">Total</label>
                            <input type="number" class="form-control" id="updateTotal" name="Total">
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

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Cuando se haga clic en el botón "Actualizar"
            document.querySelectorAll(".actualizar-btn").forEach(button => {
                button.addEventListener("click", function() {
                    // Obtener los datos del pedido
                    const id = this.getAttribute("data-id");
                    const cantidad = this.getAttribute("data-cantidad");
                    const fecha = this.getAttribute("data-fecha");
                    const total = this.getAttribute("data-total");

                    // Cargar los datos en el formulario del modal
                    document.getElementById("updateId").value = id;
                    document.getElementById("updateCantidad").value = cantidad;
                    document.getElementById("updateFechaEntrega").value = fecha;
                    document.getElementById("updateTotal").value = total;

                    // Mostrar el modal
                    const modal = new bootstrap.Modal(document.getElementById("updateModal"));
                    modal.show();
                });
            });

            // Manejo del botón "Actualizar" en el modal
            document.getElementById("saveUpdateBtn").addEventListener("click", function() {
                const formData = new FormData(document.getElementById("updateForm"));

                // Realizar la solicitud de actualización
                fetch("Updatepedidos.php", {
                        method: "POST",
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert(data.message);
                            location.reload(); // Recargar la página para reflejar los cambios
                        } else {
                            alert("Error: " + data.message);
                        }
                    })
                    .catch(error => {
                        console.error("Error:", error);
                        alert("Ocurrió un error al actualizar el pedido.");
                    });
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