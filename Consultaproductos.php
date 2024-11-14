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
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login/styleB.css">
    <link rel="stylesheet" href="css/css/bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/bootstrap.min.js"></script>
    <title>Listado de productos</title>
    <!-- Custom CSS -->
    <link rel="stylesheet" href="styleTabla.css" />
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
        <div class="row">
            <div class="col-12">
                <div class="table-responsive">
                <a href="reporte_productos.php" class="btn btn-primary">Generar Reporte PDF</a>
                    <table id="datatable_products" class="table table-striped table-bordered">
                        <caption></caption>

                        <?php
                        // Conectar a la base de datos
                        $conexion = mysqli_connect("localhost", "root", "", "jennawork") or die("Error en la B.D.");

                        // Número de productos por página
                        $productosPorPagina = 5;

                        // Obtener el número total de productos
                        $consultaTotalProductos = "SELECT COUNT(*) FROM productos";
                        $resultadoTotal = mysqli_query($conexion, $consultaTotalProductos);
                        $fila = mysqli_fetch_row($resultadoTotal);
                        $totalProductos = $fila[0];

                        // Calcular el total de páginas
                        $totalPaginas = ceil($totalProductos / $productosPorPagina);

                        // Obtener el número de la página actual
                        $paginaActual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
                        $paginaActual = max($paginaActual, 1); // Asegurarse de que la página no sea menor a 1
                        $paginaActual = min($paginaActual, $totalPaginas); // No exceder el total de páginas

                        // Calcular el inicio de los productos para la consulta
                        $inicio = ($paginaActual - 1) * $productosPorPagina;

                        // Consulta para obtener los productos de la página actual
                        $consultaProductos = "SELECT * FROM productos LIMIT $inicio, $productosPorPagina";
                        $resultadoProductos = mysqli_query($conexion, $consultaProductos);

                        // Mostrar los productos
                        if ($resultadoProductos && mysqli_num_rows($resultadoProductos) > 0) {
                            echo "<table class='table'>";
                            echo "<thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tipo</th>
                                    <th>Nombre</th>
                                    <th>Marca</th>
                                    <th>Descripción</th>
                                    <th>Cantidad</th>
                                    <th>Precio</th>
                                    <th>Imagen</th>
                                    <th>Disponibilidad</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>";
                            echo "<tbody>";

                            while ($row = mysqli_fetch_assoc($resultadoProductos)) {
                                // Escapar caracteres especiales
                                $idProducto = htmlspecialchars($row['idProductos']);
                                $tipoProducto = htmlspecialchars($row['Tipo_Productos']);
                                $nombreProducto = htmlspecialchars($row['Nombre_producto']);
                                $marcaProducto = htmlspecialchars($row['Marca']);
                                $descripcionProducto = htmlspecialchars($row['Descripcion_Productos']);
                                $cantidadProducto = htmlspecialchars($row['Cantidad_Productos']);
                                $precioProducto = htmlspecialchars($row['Precio']);
                                $imagenBase64 = htmlspecialchars($row['imagen']);

                                echo "<tr>";
                                echo "<td class='text-center'>{$idProducto}</td>";
                                echo "<td class='text-center'>{$tipoProducto}</td>";
                                echo "<td class='text-center'>{$nombreProducto}</td>";
                                echo "<td class='text-center'>{$marcaProducto}</td>";
                                echo "<td class='text-center'>{$descripcionProducto}</td>";
                                echo "<td class='text-center'>{$cantidadProducto}</td>";
                                echo "<td class='text-center'>$" . number_format($precioProducto, 2) . "</td>";

                                if (!empty($row['imagen'])) {
                                    $imagenBase64 = 'data:image/jpeg;base64,' . base64_encode($row['imagen']);
                                    echo "<td class='text-center'><img src='{$imagenBase64}' alt='Producto' style='width: 100px; height: auto;'></td>";
                                } else {
                                    echo "<td class='text-center'>Sin imagen</td>";
                                }
                                

                                echo "<td class='text-center'>" . ($cantidadProducto > 0 ? 'Disponible' : 'Agotado') . "</td>";
                                echo "<td class='text-center'>
                                    <button class='btn btn-sm btn-warning actualizar-btn' 
                                            data-id='{$idProducto}' 
                                            data-tipo='{$tipoProducto}' 
                                            data-nombre='{$nombreProducto}' 
                                            data-marca='{$marcaProducto}' 
                                            data-descripcion='{$descripcionProducto}' 
                                            data-cantidad='{$cantidadProducto}' 
                                            data-precio='{$precioProducto}' 
                                            data-imagen='{$imagenBase64}'>
                                        Actualizar
                                    </button>
                            <button class='btn btn-sm btn-danger eliminar-btn' data-id='{$row['idProductos']}'>Eliminar</button>
                        </td>";
                                echo "</tr>";
                            }

                            echo "</tbody>";
                            echo "</table>";
                        } else {
                            echo "<p class='text-center'>No hay productos disponibles.</p>";
                        }

                        // Cerrar la conexión
                        mysqli_close($conexion);
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Paginación -->
    <nav aria-label="Paginación de productos">
        <ul class="pagination justify-content-center">
            <?php
            // Número máximo de botones de páginas visibles
            $maxBotones = 5;

            // Calcular el rango de páginas a mostrar
            $inicioRango = max(1, $paginaActual - floor($maxBotones / 2));
            $finRango = min($totalPaginas, $inicioRango + $maxBotones - 1);

            if ($paginaActual > 1) {
                echo "<li class='page-item'><a class='page-link' href='?pagina=" . ($paginaActual - 1) . "'>Anterior</a></li>";
            }

            for ($i = $inicioRango; $i <= $finRango; $i++) {
                $active = ($i == $paginaActual) ? 'active' : '';
                echo "<li class='page-item $active'><a class='page-link' href='?pagina=$i'>$i</a></li>";
            }

            if ($paginaActual < $totalPaginas) {
                echo "<li class='page-item'><a class='page-link' href='?pagina=" . ($paginaActual + 1) . "'>Siguiente</a></li>";
            }
            ?>
        </ul>
    </nav>



    <!-- Modal para actualizar productos -->
    <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateModalLabel">Actualizar Producto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="updateForm">
                        <input type="hidden" id="update-id" name="id">
                        <div class="mb-3">
                            <label for="update-tipo" class="form-label">Tipo de Producto</label>
                            <input type="text" class="form-control" id="update-tipo" name="tipo">
                        </div>
                        <div class="mb-3">
                            <label for="update-nombre" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="update-nombre" name="nombre">
                        </div>
                        <div class="mb-3">
                            <label for="update-marca" class="form-label">Marca</label>
                            <input type="text" class="form-control" id="update-marca" name="marca">
                        </div>
                        <div class="mb-3">
                            <label for="update-descripcion" class="form-label">Descripción</label>
                            <textarea class="form-control" id="update-descripcion" name="descripcion"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="update-cantidad" class="form-label">Cantidad</label>
                            <input type="number" class="form-control" id="update-cantidad" name="cantidad">
                        </div>
                        <div class="mb-3">
                            <label for="update-precio" class="form-label">Precio</label>
                            <input type="number" step="0.01" class="form-control" id="update-precio" name="precio">
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
            // Manejar clic en botón "Actualizar" dentro de la tabla
            document.querySelectorAll('.actualizar-btn').forEach(button => {
                button.addEventListener('click', () => {
                    // Cargar los datos en el formulario
                    const modal = new bootstrap.Modal(document.getElementById('updateModal'));
                    document.getElementById('update-id').value = button.getAttribute('data-id');
                    document.getElementById('update-tipo').value = button.getAttribute('data-tipo');
                    document.getElementById('update-nombre').value = button.getAttribute('data-nombre');
                    document.getElementById('update-marca').value = button.getAttribute('data-marca');
                    document.getElementById('update-descripcion').value = button.getAttribute('data-descripcion');
                    document.getElementById('update-cantidad').value = button.getAttribute('data-cantidad');
                    document.getElementById('update-precio').value = button.getAttribute('data-precio');

                    modal.show();
                });
            });

            // Manejar clic en el botón "Guardar Cambios" dentro del modal
            const saveChangesBtn = document.getElementById('saveChanges');
            saveChangesBtn.addEventListener('click', () => {
                const form = document.getElementById('updateForm');
                const formData = new FormData(form);

                // Desactivar botón mientras se procesa la solicitud
                saveChangesBtn.disabled = true;
                saveChangesBtn.textContent = "Actualizando...";

                fetch('Updateproductos.php', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Actualizar la fila correspondiente en la tabla
                            const row = document.querySelector(`tr[data-id="${formData.get('id')}"]`);
                            row.querySelector('.tipo').textContent = formData.get('tipo');
                            row.querySelector('.nombre').textContent = formData.get('nombre');
                            row.querySelector('.marca').textContent = formData.get('marca');
                            row.querySelector('.descripcion').textContent = formData.get('descripcion');
                            row.querySelector('.cantidad').textContent = formData.get('cantidad');
                            row.querySelector('.precio').textContent = `$${parseFloat(formData.get('precio')).toFixed(2)}`;

                            // Cerrar el modal
                            const modal = bootstrap.Modal.getInstance(document.getElementById('updateModal'));
                            modal.hide();

                            alert('Producto actualizado con éxito.');
                        } else {
                            alert(`Error al actualizar el producto: ${data.message}`);
                        }
                    })
                    .catch(error => {
                        console.error('Error en la actualización:', error);
                        alert('Hubo un error al procesar la solicitud.');
                    })
                    .finally(() => {
                        // Reactivar el botón
                        saveChangesBtn.disabled = false;
                        saveChangesBtn.textContent = "Actualizar";
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
                        fetch('EliminarProductos.php', {
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