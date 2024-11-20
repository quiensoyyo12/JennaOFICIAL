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
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="repor2.css">
    <!--link rel="stylesheet" href="menu.css"-->
    <title>Document</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bungee+Tint&display=swap" rel="stylesheet">
    <nav class="navbar color">
        <div class="container-fluid">
            <a class="navbar-brand lemon-regular" href="#">
                <img src="img/clasificacion.png" alt="Logo" width="40" height="32"
                    class="d-inline-block align-text-top ">
                REPORTES DE SERVICIOS
            </a>
            <div class="d-flex">
                <h5>
                    <?php
                    echo $fila_ciudadano['Nombre'];
                    ?>
                    --
                </h5>
                <!-- Button trigger modal -->
                <a data-bs-toggle="modal" data-bs-target="#exampleModal"><img src="images/cerrar-sesion.png" alt="cerrar sesion" width="40" height="32"></a>

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
        </div>
    </nav>

</head>

<body>
    <ul class="nav nav-tabs mb-3 centrar" id="pills-tab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home"
                type="button" role="tab" aria-controls="pills-home" aria-selected="true">Reportes</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile"
                type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Consultar Reportes</button>
        </li>

    </ul>
    <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab"
            tabindex="0">
            <!-- Centrando el formulario -->
            <div class="d-flex justify-content-center align-items-center vh-100">
                <div class="col-5">
                    <form id="formulario" action="validarMain.php" method="post" class="form">
                        <center>
                            <h1 class="lemon-regular">REALIZA TU REPORTE</h1>
                        </center>
                        <br>
                        <label for="titulo">Titulo del reporte</label>
                        <input id="titulo" name="titulo" type="text" class="form-control" required title="titulo">
                        <br>
                        <label for="causa">Causa</label>
                        <input id="causa" name="causa" type="text" class="form-control" required title="causa">
                        <br>
                        <label for="servicio">Servicio a Reclamar</label>
                        <select id="servicio" name="servicio" title="servicio" class="form-control">
                            <option selected>Seleccione el Servicio</option>
                            <?php
                            if ($result1->num_rows > 0) {
                                while ($row = $result1->fetch_assoc()) {
                                    echo "<option value='" . $row['id_servicio'] . "'>" . $row['nombreServicio'] . " (ID: " . $row['id_servicio'] . ")</option>";
                                }
                            }
                            ?>
                        </select>
                        <br>
                        <label for="descripcion">Descripción</label>
                        <input id="descripcion" name="descripcion" type="text" class="form-control" required
                            title="descripcion">
                        <br>
                        <label for="date">Fecha</label>
                        <input id="date" name="date" type="datetime-local" class="form-control" required title="date">
                        <br>
                        <div class="col">
                            <input type="submit" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#staticBackdrop" title="guardar" value="Guardar">
                            <input id="Borrar" name="Borrar" type="reset" value="Eliminar" class="btn btn-danger btn-mini">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab" tabindex="0">
            <center>
                <h1 class="lemon-regular">Aquí consulta los reportes existentes
                    (<?php
                        $numero = mysqli_num_rows($resultado);
                        echo "$numero";
                        ?>)
                </h1>
                <!-- Formulario de búsqueda -->
                <form id="buscador">
                    <input type="search" id="buscar" placeholder="Buscar..." class="form-control">
                    <br>
                    <button type="submit" class="btn btn-outline-info">Buscar</button>
                </form>
            </center>
            <!-- Tarjetas -->
            <?php while ($fila = mysqli_fetch_assoc($resultado)) { 
                $Id_direccion=$fila['ciudadano']; 
                $consulta_direccion = "SELECT * FROM ciudadanos WHERE id_ciudadano = '$Id_direccion'";
                $resultado_direccion = mysqli_query($conexion, $consulta_direccion) or die(mysqli_error($conexion));
                $fila_direccion = mysqli_fetch_assoc($resultado_direccion);
                ?>
                <div class="card text-center" data-nombre="<?php echo $fila['nombreReporte']; ?>" data-causa="<?php echo $fila['causa']; ?>" data-descripcion="<?php echo $fila['descripcion']; ?>">
                    <div class="card-header">
                        <?php echo $fila['nombreReporte']; ?>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $fila['causa']; ?></h5>
                        <p class="card-text">
                        <?php 
                        echo $fila_direccion['direccion'];?></p>
                        <a href="#" class="btn btn-primary">Ver reporte completo</a>
                    </div>
                    <div class="card-footer text-body-secondary">
                        <?php echo $fila['fecha']; ?>
                    </div>
                </div>
            <?php } ?>


        </div>

</body>
<script>
    // Seleccionar el formulario de búsqueda y el campo de búsqueda
    const buscador = document.getElementById('buscador');
    const buscar = document.getElementById('buscar');

    // Agregar evento de envío al formulario de búsqueda
    buscador.addEventListener('submit', (e) => {
        e.preventDefault();

        // Obtener el valor del campo de búsqueda
        const valorBuscar = buscar.value.toLowerCase();

        // Seleccionar todas las tarjetas
        const tarjetas = document.querySelectorAll('.card');

        // Filtrar las tarjetas según el valor del campo de búsqueda
        tarjetas.forEach((tarjeta) => {
            const nombre = tarjeta.getAttribute('data-nombre').toLowerCase();
            const causa = tarjeta.getAttribute('data-causa').toLowerCase();
            const descripcion = tarjeta.getAttribute('data-descripcion').toLowerCase();

            if (nombre.includes(valorBuscar) || causa.includes(valorBuscar) || descripcion.includes(valorBuscar)) {
                tarjeta.style.display = 'block';
            } else {
                tarjeta.style.display = 'none';
            }
        });
    });
</script>

</html>