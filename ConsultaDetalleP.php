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
    <title>Detalles de pedidos</title>
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
                    <a href="index.php" class="">inicio</a>
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
    <div class="row justify-content-center">
        <div class="col-12 col-md-10 col-lg-8">
            <h2 class="text-center mb-4">Detalle del pedido</h2>
            <div class="table-responsive">
                <a href="reporte_detalle_pedido.php" class="btn btn-primary mb-3">Generar Reporte PDF</a>
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>idDetalle_pedido</th>
                            <th>idProductos</th>
                            <th>idPedidos</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Configuración de la paginación
                        $conexion = mysqli_connect("localhost", "root", "", "jennawork") or die("Error de conexión de BD");
                        $registros_por_pagina = 5;
                        $pagina_actual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
                        $offset = ($pagina_actual - 1) * $registros_por_pagina;

                        // Consulta con LIMIT y OFFSET
                        $consulta = "SELECT * FROM detalle_pedido LIMIT $registros_por_pagina OFFSET $offset";
                        $resultado = mysqli_query($conexion, $consulta);

                        // Verificar resultados y mostrar filas
                        if (mysqli_num_rows($resultado) > 0) {
                            while ($row = mysqli_fetch_assoc($resultado)) {
                                echo "<tr data-id='{$row['idDetalle_pedido']}'>";
                                echo "<td>{$row['idDetalle_pedido']}</td>";
                                echo "<td class='productos'>{$row['idProductos']}</td>";
                                echo "<td class='pedido'>{$row['idPedidos']}</td>";
                                echo "<td>
                        <button class='btn btn-sm btn-warning actualizar-btn' 
                                data-id='{$row['idDetalle_pedido']}'
                                data-productos='{$row['idProductos']}'
                                data-pedido='{$row['idPedidos']}'>
                            Actualizar
                        </button>
                        <button class='btn btn-sm btn-danger eliminar-btn' data-id='{$row['idDetalle_pedido']}'>Eliminar</button>
                      </td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='4' class='text-center'>No hay datos disponibles</td></tr>";
                        }

                        // Calcular el total de páginas
                        $consulta_total = "SELECT COUNT(*) AS total FROM detalle_pedido";
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

                        // Botones de número de página
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
    </div>
</div>

    <!-- Modal para actualizar detalle de pedidos -->
    <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateModalLabel">Actualizar Detalle de Pedido</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="updateForm">
                        <input type="hidden" id="update-id" name="idDetalle_pedido">
                        <div class="mb-3">
                            <label for="update-productos" class="form-label">ID Productos</label>
                            <input type="text" class="form-control" id="update-productos" name="idProductos">
                        </div>
                        <div class="mb-3">
                            <label for="update-pedido" class="form-label">ID Pedido</label>
                            <input type="text" class="form-control" id="update-pedido" name="idPedidos">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" id="saveChanges">Actualizar</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const modal = new bootstrap.Modal(document.getElementById('updateModal'));
            const saveChangesBtn = document.getElementById('saveChanges');

            // Abrir modal con datos
            document.querySelectorAll('.actualizar-btn').forEach(button => {
                button.addEventListener('click', () => {
                    document.getElementById('update-id').value = button.getAttribute('data-id');
                    document.getElementById('update-productos').value = button.getAttribute('data-productos');
                    document.getElementById('update-pedido').value = button.getAttribute('data-pedido');
                    modal.show();
                });
            });

            // Guardar cambios
            saveChangesBtn.addEventListener('click', () => {
                const formData = new FormData(document.getElementById('updateForm'));
                fetch('UpdateDetalle.php', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Actualizar los datos en la tabla sin recargar
                            const row = document.querySelector(`tr[data-id="${formData.get('idDetalle_pedido')}"]`);
                            row.querySelector('.productos').textContent = formData.get('idProductos');
                            row.querySelector('.pedido').textContent = formData.get('idPedidos');
                            modal.hide();
                            alert('Detalle de pedido actualizado con éxito.');
                        } else {
                            alert(`Error al actualizar: ${data.message}`);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Error al procesar la solicitud.');
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
                        fetch('EliminarDetalleP.php', {
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