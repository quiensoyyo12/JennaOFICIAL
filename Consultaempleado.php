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
    <title>Consulta empleados</title>

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
                    <a href="" class="">inicio</a>
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
        <div class="col-12">
            <h2 class="text-center mb-4">Lista de Empleados</h2>
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>idEmpleados</th>
                            <th>Nombre</th>
                            <th>Apellido Paterno</th>
                            <th>Apellido Materno</th>
                            <th>Correo</th>
                            <th>Contraseña</th>
                            <th>Genero</th>
                            <th>Teléfono</th>
                            <th>RFC</th>
                            <th>Tipo de empleado</th>
                            <th>idUsuarios</th>
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

                        // Consulta con paginación
                        $consulta = "SELECT * FROM empleados LIMIT $registros_por_pagina OFFSET $offset";
                        $resultado = mysqli_query($conexion, $consulta);

                        if (mysqli_num_rows($resultado) > 0) {
                            while ($row = mysqli_fetch_assoc($resultado)) {
                                echo "<tr data-id='{$row['idEmpleados']}'>";
                                echo "<td>{$row['idEmpleados']}</td>";
                                echo "<td class='nombre'>{$row['Nombre']}</td>";
                                echo "<td class='apellido_p'>{$row['Apellido_p']}</td>";
                                echo "<td class='apellido_m'>{$row['Apellido_m']}</td>";
                                echo "<td class='correo'>{$row['correo']}</td>";
                                echo "<td class='contrasena'>{$row['contrasena']}</td>";
                                echo "<td class='genero'>{$row['Genero']}</td>";
                                echo "<td class='telefono'>{$row['Telefono']}</td>";
                                echo "<td class='rfc'>{$row['rfc']}</td>";
                                echo "<td class='idTiposEmp'>{$row['idTiposEmp']}</td>";
                                echo "<td class='idUsuario'>{$row['idUsuario']}</td>";
                                echo "<td>
                    <button class='btn btn-sm btn-warning actualizar-btn' 
                            data-id='{$row['idEmpleados']}'
                            data-nombre='{$row['Nombre']}'
                            data-apellido_p='{$row['Apellido_p']}'
                            data-apellido_m='{$row['Apellido_m']}'
                            data-correo='{$row['correo']}'
                            data-contrasena='{$row['contrasena']}'
                            data-genero='{$row['Genero']}'
                            data-telefono='{$row['Telefono']}'
                            data-rfc='{$row['rfc']}'
                            data-idtipo='{$row['idTiposEmp']}'
                            data-idusuario='{$row['idUsuario']}'>
                        Actualizar
                    </button>
                    <button class='btn btn-sm btn-danger eliminar-btn' data-id='{$row['idEmpleados']}'>Eliminar</button>
                  </td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='12' class='text-center'>No hay datos disponibles</td></tr>";
                        }

                        // Calcular total de páginas
                        $consulta_total = "SELECT COUNT(*) AS total FROM empleados";
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

    <!-- Modal para actualizar empleados -->
    <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateModalLabel">Actualizar Empleado</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="updateForm">
                        <input type="hidden" id="update-id" name="idEmpleados">
                        <div class="mb-3">
                            <label for="update-nombre" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="update-nombre" name="Nombre">
                        </div>
                        <div class="mb-3">
                            <label for="update-apellido-p" class="form-label">Apellido Paterno</label>
                            <input type="text" class="form-control" id="update-apellido-p" name="Apellido_p">
                        </div>
                        <div class="mb-3">
                            <label for="update-apellido-m" class="form-label">Apellido Materno</label>
                            <input type="text" class="form-control" id="update-apellido-m" name="Apellido_m">
                        </div>
                        <div class="mb-3">
                            <label for="update-correo" class="form-label">Correo</label>
                            <input type="email" class="form-control" id="update-correo" name="correo">
                        </div>
                        <div class="mb-3">
                            <label for="update-contrasena" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" id="update-contrasena" name="contrasena">
                        </div>
                        <div class="mb-3">
                            <label for="update-genero" class="form-label">Género</label>
                            <input type="text" class="form-control" id="update-genero" name="Genero">
                        </div>
                        <div class="mb-3">
                            <label for="update-telefono" class="form-label">Teléfono</label>
                            <input type="text" class="form-control" id="update-telefono" name="Telefono">
                        </div>
                        <div class="mb-3">
                            <label for="update-rfc" class="form-label">RFC</label>
                            <input type="text" class="form-control" id="update-rfc" name="rfc">
                        </div>
                        <div class="mb-3">
                            <label for="update-tipo" class="form-label">Tipo de Empleado</label>
                            <input type="text" class="form-control" id="update-tipo" name="idTiposEmp">
                        </div>
                        <div class="mb-3">
                            <label for="update-usuario" class="form-label">ID Usuario</label>
                            <input type="text" class="form-control" id="update-usuario" name="idUsuario">
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
                    document.getElementById('update-apellido-p').value = button.getAttribute('data-apellido_p');
                    document.getElementById('update-apellido-m').value = button.getAttribute('data-apellido_m');
                    document.getElementById('update-correo').value = button.getAttribute('data-correo');
                    document.getElementById('update-contrasena').value = button.getAttribute('data-contrasena');
                    document.getElementById('update-genero').value = button.getAttribute('data-genero');
                    document.getElementById('update-telefono').value = button.getAttribute('data-telefono');
                    document.getElementById('update-rfc').value = button.getAttribute('data-rfc');
                    document.getElementById('update-tipo').value = button.getAttribute('data-idtipo');
                    document.getElementById('update-usuario').value = button.getAttribute('data-idusuario');
                    modal.show();
                });
            });

            // Guardar cambios
            saveChangesBtn.addEventListener('click', () => {
                const formData = new FormData(document.getElementById('updateForm'));
                fetch('Updateempleado.php', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert('Empleado actualizado con éxito.');
                            location.reload(); // Recargar la tabla
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
                        fetch('EliminarEmpleado.php', {
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