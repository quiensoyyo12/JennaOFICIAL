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
    <title>Tipos de Empleados</title>


</head>

<body>
    <style>
        /* Quitar subrayado de los enlaces en el menú */
.nav-bar a {
    text-decoration: none !important; /* Quita cualquier subrayado */
}

/* Opcional: Cambiar el color del texto al pasar el mouse */
.nav-bar a:hover {
    text-decoration: none; /* Asegura que no se subraye al pasar el mouse */
    color: #000; /* Cambia el color del texto si deseas un efecto */
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
                <h2 class="text-center mb-4">Tipo de Empleado</h2>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>ID Tipo Empleado</th>
                                <th>Administrador</th>
                                <th>Auxiliar</th>
                                <th>Cliente</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                          include 'conexion.php'; // Asegúrate de que la ruta sea correcta
                            $consulta = "SELECT * FROM tiposempledos";
                            $resultado = mysqli_query($conexion, $consulta);

                            if (mysqli_num_rows($resultado) > 0) {
                                while ($row = mysqli_fetch_assoc($resultado)) {
                                    echo "<tr>";
                                    echo "<td>{$row['idTiposEmp']}</td>";
                                    echo "<td>{$row['administrador']}</td>";
                                    echo "<td>{$row['auxiliar']}</td>";
                                    echo "<td>{$row['cliente']}</td>";
                                    echo "<td>
                <button class='btn btn-sm btn-warning actualizar-btn' 
                        data-id='{$row['idTiposEmp']}' 
                        data-administrador='{$row['administrador']}' 
                        data-auxiliar='{$row['auxiliar']}' 
                        data-cliente='{$row['cliente']}'>
                    Actualizar
                </button>
                <button class='btn btn-sm btn-danger eliminar-btn' data-id='{$row['idTiposEmp']}'>Eliminar</button>
              </td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='5' class='text-center'>No hay tipos de empleados registrados.</td></tr>";
                            }
                            mysqli_close($conexion);
                            ?>
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal para actualizar tipos de empleados -->
    <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateModalLabel">Actualizar Tipo de Empleado</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="updateForm">
                        <input type="hidden" id="update-id" name="idTiposEmp">
                        <div class="mb-3">
                            <label for="update-administrador" class="form-label">Administrador</label>
                            <input type="text" class="form-control" id="update-administrador" name="administrador">
                        </div>
                        <div class="mb-3">
                            <label for="update-auxiliar" class="form-label">Auxiliar</label>
                            <input type="text" class="form-control" id="update-auxiliar" name="auxiliar">
                        </div>
                        <div class="mb-3">
                            <label for="update-cliente" class="form-label">Cliente</label>
                            <input type="text" class="form-control" id="update-cliente" name="cliente">
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
                    document.getElementById('update-administrador').value = button.getAttribute('data-administrador');
                    document.getElementById('update-auxiliar').value = button.getAttribute('data-auxiliar');
                    document.getElementById('update-cliente').value = button.getAttribute('data-cliente');
                    modal.show();
                });
            });

            // Guardar cambios
            saveChangesBtn.addEventListener('click', () => {
                const formData = new FormData(document.getElementById('updateForm'));
                fetch('Updatetipo.php', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert('Tipo de empleado actualizado con éxito.');
                            location.reload(); // Recargar la página para ver cambios
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
                        fetch('EliminarTipoEmp.php', {
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