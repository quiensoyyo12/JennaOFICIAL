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

<?php
// Conectar a la base de datos
$conexion = mysqli_connect("localhost", "root", "", "jennawork");

if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

// Consultar IDs de productos
$query_productos = "SELECT idProductos FROM productos";
$resultado_productos = mysqli_query($conexion, $query_productos);

// Consultar IDs de pedidos
$query_pedidos = "SELECT idPedidos FROM pedidos";
$resultado_pedidos = mysqli_query($conexion, $query_pedidos);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $idDetalle_peddido = $_POST['idDetalle_pedido'];
    $idProductos = $_POST['idProductos'];
    $idPedidos = $_POST['idPedidos'];

    // Insertar los datos en la tabla detalle_pedido
    $consulta = "INSERT INTO detalle_pedido (idDetalle_pedido, idProductos, idPedidos) VALUES ('$idDetalle_peddido', '$idProductos', '$idPedidos')";
    $resultado = mysqli_query($conexion, $consulta);

    if ($resultado) {
        echo '<script>
        alert("Datos insertados");
        window.location = "detalle_pedido1.php";
        </script>';
        exit();
    } else {
        echo '<script>
        alert("Datos no insertados: " . mysqli_error($conexion)");
        window.location = "detalle_pedido1.php";
        </script>';
        exit();
    }
}
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
    <title>Detalle de pedidos</title>
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

    <div class="container text-center">
        <div class="row">
            <div class="col order-last">
                <button class="toggle-table">Mostrar Tabla</button>
                <ul class="hidden-table">
                    <li>Celda 1</li>
                    <li>Celda 2</li>
                    <li>Celda 3</li>
                </ul>
            </div>
            <div class="col tu-clase">
                <h2>Detalle del pedido</h2>
                <form id="frmdetalle" action="" method="post">
                    <tr>
                        <td>
                            idDetalle:
                        </td>
                        <td>
                            <input id="idDetalle_pedido" name="idDetalle_pedido" type="text" class="form-control">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            *idProducto:
                        </td>
                        <td>
                            <select id="idProductos" name="idProductos" class="form-control">
                                <?php
                                // Llenar el menú desplegable con los IDs de productos
                                while ($row = mysqli_fetch_assoc($resultado_productos)) {
                                    echo "<option value='" . $row['idProductos'] . "'>" . $row['idProductos'] . "</option>";
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            *idPedido:
                        </td>
                        <td>
                            <select id="idPedidos" name="idPedidos" class="form-control">
                                <?php
                                // Llenar el menú desplegable con los IDs de pedidos
                                while ($row = mysqli_fetch_assoc($resultado_pedidos)) {
                                    echo "<option value='" . $row['idPedidos'] . "'>" . $row['idPedidos'] . "</option>";
                                }
                                ?>
                            </select>
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
                    <!-- Botón para eliminar -->
                    <button type="button" onclick="enviarFormulario('EliminarDetalleP.php')" class="btn btn-danger btn-mini">Eliminar</button>
                    <!-- Botón para actualizar -->
                    <button type="button" onclick="enviarFormulario('UpdateDetalleP.php')" class="btn btn-success btn-mini">Actualizar</button>
                    <!-- Botón para consultar -->
                    <button type="button" onclick="enviarFormulario('ConsultaDetalleP.php')" class="btn btn-info btn-mini">Consultar</button>
                </form>
            </div>
            <div class="col order-first">
                Third in DOM, ordered first
            </div>
        </div>
    </div>
    <script>
        function enviarFormulario(url) {
            // Obtener el formulario
            var form = document.getElementById("frmdetalle");
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

<?php
// Liberar resultados y cerrar la conexión
mysqli_free_result($resultado_productos);
mysqli_free_result($resultado_pedidos);
mysqli_close($conexion);
?>