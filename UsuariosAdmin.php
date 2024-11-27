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

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login/styleB.css">
    <link rel="stylesheet" href="css/css/bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/bootstrap.min.js"></script>
    <title>Usuarios</title>
</head>
<style>
    body {
        background-color: #f0e6ff;
        /* Lavanda claro */
        color: #333;
        /* Gris oscuro */
        font-family: Arial, sans-serif;
    }

    .form-control,
    .form-select {
        background-color: transparent;
        border: 1px solid #7a57d1;
        /* Bordes morado oscuro */
        color: #333;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #4b27a6;
        /* Bordes más oscuros al enfocar */
        box-shadow: 0 0 8px rgba(75, 39, 166, 0.5);
        /* Sombra suave */
    }

    .btn-primary {
        background-color: #7a57d1;
        border-color: #7a57d1;
    }

    .btn-primary:hover {
        background-color: #4b27a6;
        border-color: #4b27a6;
    }

    .btn-danger {
        background-color: #e74c3c;
        border-color: #e74c3c;
    }

    .btn-danger:hover {
        background-color: #c0392b;
        border-color: #c0392b;
    }

    .btn-success {
        background-color: #28a745;
        border-color: #28a745;
    }

    .btn-success:hover {
        background-color: #218838;
        border-color: #218838;
    }

    .btn-info {
        background-color: #17a2b8;
        border-color: #17a2b8;
    }

    .btn-info:hover {
        background-color: #138496;
        border-color: #138496;
    }

    h2 {
        color: #4b27a6;
        /* Morado oscuro */
        font-weight: bold;
    }

    table {
        margin: 20px auto;
        border-collapse: collapse;
        width: 100%;
        max-width: 800px;
    }

    table th,
    table td {
        border: 1px solid #7a57d1;
        padding: 10px;
        text-align: center;
    }

    table th {
        background-color: #7a57d1;
        color: white;
    }

    table tr:nth-child(even) {
        background-color: #f8f0ff;
    }

    table tr:hover {
        background-color: #e0d4ff;
    }
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

    <div class="container text-center">
        <div class="row">
            <div class="col order-last">

            </div>
            <div class="col tu-clase">
                <h2>Alta usuarios</h2>

                <!-- Mensaje dinámico -->
                <?php if (isset($_GET['success'])): ?>
                    <div id="mensaje" class="alert <?= $_GET['success'] === 'true' ? 'alert-success' : 'alert-danger'; ?>" role="alert">
                        <?= $_GET['success'] === 'true'
                            ? 'Datos del usuario guardados correctamente.'
                            : 'Error al guardar los datos del usuario.'; ?>
                    </div>
                <?php endif; ?>

                <form id="frmUsuarios" action="Usuarios.php" method="post">
                    <tr>
                        <td></td>
                        <td>
                            <input id="id" name="id" type="hidden" class="form-control">
                        </td>
                    </tr>
                    <tr>
                        <td>Nombre</td>
                        <td>
                            <input id="Nombre" name="Nombre" type="text" class="form-control">
                        </td>
                    </tr>
                    <tr>
                        <td>Apellido Paterno</td>
                        <td>
                            <input id="Apellido_paterno" name="Apellido_paterno" type="text" class="form-control">
                        </td>
                    </tr>
                    <tr>
                        <td>Apellido Materno</td>
                        <td>
                            <input id="Apellido_materno" name="Apellido_materno" type="text" class="form-control">
                        </td>
                    </tr>
                    <tr>
                        <td>Correo</td>
                        <td>
                            <input id="correo" name="correo" type="text" class="form-control">
                        </td>
                    </tr>
                    <tr>
                        <td>Contraseña:</td>
                        <td>
                            <input id="contrasena" name="contrasena" type="password" class="form-control">
                        </td>
                    </tr>
                    <br>
                    <tr>
                        <td>
                            <input id="Guardar" name="Guardar" type="submit" value="Guardar" class="btn btn-primary btn-mini">
                        </td>
                        <td>
                            <input id="Borrar" type="reset" value="Borrar" class="btn btn-danger btn-mini">
                        </td>
                    </tr>
                    <button type="button" onclick="enviarFormulario('Consultausuario.php')" class="btn btn-info btn-mini">Consultar</button>
                </form>
            </div>

            <!-- Script para ocultar el mensaje dinámico -->
            <script>
                setTimeout(() => {
                    const mensaje = document.getElementById('mensaje');
                    if (mensaje) {
                        mensaje.style.transition = 'opacity 0.5s';
                        mensaje.style.opacity = '0';
                        setTimeout(() => mensaje.remove(), 500);
                    }
                }, 3000);
            </script>

            <div class="col order-first">
                <button class="toggle-table btn btn-primary mb-3">Mostrar Tabla</button>
                <ul class="hidden-table list-unstyled">
                    <li><a href="detalle_ventaAdmin.php" class="btn btn-secondary mb-2">Alta Detalle de ventas</a></li>
                    <li><a href="detalle_pedido1.php" class="btn btn-secondary mb-2">Alta Detalle de pedido</a></li>
                    <li><a href="ProductosAdmin.php" class="btn btn-secondary mb-2">Alta Productos</a></li>
                    <li><a href="PedidosA.php" class="btn btn-secondary mb-2">Alta Pedidos</a></li>
                    <li><a href="PermisosAdmin.php" class="btn btn-secondary mb-2">Permisos</a></li>
                    <li><a href="RegistroProveedorAdmin.php" class="btn btn-secondary mb-2">Alta Proveedor</a></li>
                    <li><a href="RegistroVentasAdmin.php" class="btn btn-secondary mb-2">Alta Ventas</a></li>
                    <li><a href="TipoEmpleadosAdmin.php" class="btn btn-secondary mb-2">Rol de empleado</a></li>
                    <li><a href="UsuariosAdmin.php" class="btn btn-secondary mb-2">Alta Usuarios</a></li>
                </ul>
            </div>
        </div>
    </div>
    <script>
        function enviarFormulario(url) {
            // Obtener el formulario
            var form = document.getElementById("frmUsuarios");
            // Establecer la acción del formulario al URL deseado
            form.action = url;
            // Enviar el formulario
            form.submit();
        }
    </script>
    <script>
        const toggleButton = document.querySelector('.toggle-table');
        const hiddenTable = document.querySelector('.hidden-table');

        toggleButton.addEventListener('click', () => {
            hiddenTable.classList.toggle('show-table');
            toggleButton.textContent = hiddenTable.classList.contains('show-table') ? 'Ocultar Tabla' : 'Mostrar Tabla';
        });

        function name(params) {
            show - table;
            {
                display: table; /* Muestra la tabla */
            }
        }
    </script>
</body>

</html>