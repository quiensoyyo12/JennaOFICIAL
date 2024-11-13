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
    <title>Lista de venta</title>

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
    <div class="row justify-content-center">
        <div class="col-12 col-md-10 col-lg-8">
            <h2 class="text-center mb-4">Lista de Ventas</h2>
            <div class="table-responsive">
                <table class="table  table-striped table-bordered table-hover">
                <thead>
    <tr>
        <th>id</th>
        <th>idVentas</th>
        <th>idProductos</th>
        <th>Cantidad</th>
        <th>Acciones</th>
    </tr>
</thead>
<tbody>
    <?php
    $conexion = mysqli_connect("localhost", "root", "", "jennawork") or die("Error de conexión de BD");
    $consulta = "SELECT * FROM detalle_venta";
    $resultado = mysqli_query($conexion, $consulta);

    if (mysqli_num_rows($resultado) > 0) {
        while ($row = mysqli_fetch_assoc($resultado)) {
            echo "<tr data-id='{$row['idDetalle_venta']}'>";
            echo "<td>{$row['idDetalle_venta']}</td>";
            echo "<td class='idVenta'>{$row['idVenta']}</td>";
            echo "<td class='idProductos'>{$row['idProductos']}</td>";
            echo "<td class='cantidad'>{$row['Cantidad']}</td>";
            echo "<td>
                    <button class='btn btn-sm btn-warning actualizar-btn' 
                            data-id='{$row['idDetalle_venta']}'
                            data-idVenta='{$row['idVenta']}'
                            data-idProductos='{$row['idProductos']}'
                            data-cantidad='{$row['Cantidad']}'>
                        Actualizar
                    </button>
                    <button class='btn btn-sm btn-danger eliminar-btn' data-id='{$row['id']}'>Eliminar</button>
                  </td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='5' class='text-center'>No hay datos disponibles</td></tr>";
    }
    mysqli_close($conexion);
    ?>
</tbody>

                </table>
            </div>
        </div>
    </div>
</div>
<!-- Modal para actualizar detalle de ventas -->
<div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateModalLabel">Actualizar Detalle de Venta</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="updateForm">
                    <input type="hidden" id="update-id" name="idDetalle_venta">
                    <div class="mb-3">
                        <label for="update-idVentas" class="form-label">ID Ventas</label>
                        <input type="text" class="form-control" id="update-idVentas" name="idVenta">
                    </div>
                    <div class="mb-3">
                        <label for="update-idProductos" class="form-label">ID Productos</label>
                        <input type="text" class="form-control" id="update-idProductos" name="idProductos">
                    </div>
                    <div class="mb-3">
                        <label for="update-cantidad" class="form-label">Cantidad</label>
                        <input type="text" class="form-control" id="update-cantidad" name="Cantidad">
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
            document.getElementById('update-idVentas').value = button.getAttribute('data-idVentas');
            document.getElementById('update-idProductos').value = button.getAttribute('data-idProductos');
            document.getElementById('update-cantidad').value = button.getAttribute('data-cantidad');
            modal.show();
        });
    });

    // Guardar cambios
    saveChangesBtn.addEventListener('click', () => {
        const formData = new FormData(document.getElementById('updateForm'));
        fetch('UpdatedetalleV.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Actualizar los datos en la tabla sin recargar
                const row = document.querySelector(`tr[data-id="${formData.get('id')}"]`);
                row.querySelector('.idVentas').textContent = formData.get('idVentas');
                row.querySelector('.idProductos').textContent = formData.get('idProductos');
                row.querySelector('.cantidad').textContent = formData.get('Cantidad');
                modal.hide();
                alert('Detalle de venta actualizado con éxito.');
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
                fetch('EliminardetalleV.php', {
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