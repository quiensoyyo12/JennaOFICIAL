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
    <title>Consulta</title>



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
        <div class="row justify-content-center">
            <div class="col-12">
                <h2 class="text-center mb-4">Lista de Proveedores</h2>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>idProveedor</th>
                                <th>Nombre</th>
                                <th>Apellido Paterno</th>
                                <th>Apellido Materno</th>
                                <th>RFC</th>
                                <th>Teléfono</th>
                                <th>Domicilio</th>
                                <th>Correo</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Configuración de la paginación
                            include 'conexion.php'; // Asegúrate de que la ruta sea correcta
                            $registros_por_pagina = 5; // Número de registros por página
                            $pagina_actual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
                            $offset = ($pagina_actual - 1) * $registros_por_pagina;

                            // Consulta con paginación
                            $consulta = "SELECT * FROM proveedor LIMIT $registros_por_pagina OFFSET $offset";
                            $resultado = mysqli_query($conexion, $consulta);

                            if (mysqli_num_rows($resultado) > 0) {
                                while ($row = mysqli_fetch_assoc($resultado)) {
                                    echo "<tr data-id='{$row['idProveedor']}'>";
                                    echo "<td>{$row['idProveedor']}</td>";
                                    echo "<td class='nombre'>{$row['Nombre']}</td>";
                                    echo "<td class='apellidoP'>{$row['ApellidoP']}</td>";
                                    echo "<td class='apellidoM'>{$row['ApellidoM']}</td>";
                                    echo "<td class='rfc'>{$row['rfc']}</td>";
                                    echo "<td class='telefono'>{$row['Telefono']}</td>";
                                    echo "<td class='domicilio'>{$row['Domicilio']}</td>";
                                    echo "<td class='correo'>{$row['correo']}</td>";
                                    echo "<td>
                                        <button class='btn btn-sm btn-warning actualizar-btn' 
                                            data-id='{$row['idProveedor']}'
                                            data-nombre='{$row['Nombre']}'
                                            data-apellidoP='{$row['ApellidoP']}'
                                            data-apellidoM='{$row['ApellidoM']}'
                                            data-rfc='{$row['rfc']}'
                                            data-telefono='{$row['Telefono']}'
                                            data-domicilio='{$row['Domicilio']}'
                                            data-correo='{$row['correo']}'>
                                            Actualizar
                                        </button>
                                        <button class='btn btn-sm btn-danger eliminar-btn' data-id='{$row['idProveedor']}'>Eliminar</button>
                                      </td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='9' class='text-center'>No hay proveedores registrados.</td></tr>";
                            }

                            // Calcular total de páginas
                            $consulta_total = "SELECT COUNT(*) AS total FROM proveedor";
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
        </div>
    </div>


    <!-- Modal para actualizar proveedores -->
    <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateModalLabel">Actualizar Proveedor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="updateForm">
                        <input type="hidden" id="update-id" name="idProveedor">
                        <div class="mb-3">
                            <label for="update-nombre" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="update-nombre" name="Nombre">
                        </div>
                        <div class="mb-3">
                            <label for="update-apellidoP" class="form-label">Apellido Paterno</label>
                            <input type="text" class="form-control" id="update-apellidoP" name="ApellidoP">
                        </div>
                        <div class="mb-3">
                            <label for="update-apellidoM" class="form-label">Apellido Materno</label>
                            <input type="text" class="form-control" id="update-apellidoM" name="ApellidoM">
                        </div>
                        <div class="mb-3">
                            <label for="update-rfc" class="form-label">RFC</label>
                            <input type="text" class="form-control" id="update-rfc" name="rfc">
                        </div>
                        <div class="mb-3">
                            <label for="update-telefono" class="form-label">Teléfono</label>
                            <input type="text" class="form-control" id="update-telefono" name="Telefono">
                        </div>
                        <div class="mb-3">
                            <label for="update-domicilio" class="form-label">Domicilio</label>
                            <textarea class="form-control" id="update-domicilio" name="Domicilio"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="update-correo" class="form-label">Correo</label>
                            <input type="email" class="form-control" id="update-correo" name="correo">
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
                    document.getElementById('update-nombre').value = button.getAttribute('data-nombre');
                    document.getElementById('update-apellidoP').value = button.getAttribute('data-apellidoP');
                    document.getElementById('update-apellidoM').value = button.getAttribute('data-apellidoM');
                    document.getElementById('update-rfc').value = button.getAttribute('data-rfc');
                    document.getElementById('update-telefono').value = button.getAttribute('data-telefono');
                    document.getElementById('update-domicilio').value = button.getAttribute('data-domicilio');
                    document.getElementById('update-correo').value = button.getAttribute('data-correo');
                    modal.show();
                });
            });

            // Guardar cambios
            saveChangesBtn.addEventListener('click', () => {
                const formData = new FormData(document.getElementById('updateForm'));
                fetch('UpdateProveedor.php', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Actualizar los datos en la tabla sin recargar
                            const row = document.querySelector(`tr[data-id="${formData.get('idProveedor')}"]`);
                            row.querySelector('.nombre').textContent = formData.get('Nombre');
                            row.querySelector('.apellidoP').textContent = formData.get('ApellidoP');
                            row.querySelector('.apellidoM').textContent = formData.get('ApellidoM');
                            row.querySelector('.rfc').textContent = formData.get('rfc');
                            row.querySelector('.telefono').textContent = formData.get('Telefono');
                            row.querySelector('.domicilio').textContent = formData.get('Domicilio');
                            row.querySelector('.correo').textContent = formData.get('correo');
                            modal.hide();
                            alert('Proveedor actualizado con éxito.');
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
        document.querySelectorAll('.eliminar-btn').forEach(button => {
            button.addEventListener('click', function() {
                const idEmpleado = this.getAttribute('data-id');

                // Confirmar la eliminación
                if (confirm("¿Estás seguro de que deseas eliminar este proveedor?")) {
                    // Realizar la eliminación mediante una redirección
                    window.location.href = `Eliminarproveedores.php?id=${idEmpleado}`;
                }
            });
        });
    </script>
</body>

</html>