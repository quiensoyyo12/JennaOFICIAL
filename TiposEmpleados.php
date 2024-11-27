<html>

<head>
    <title>Rango</title>

    <link href="css/css/bootstrap.css"
        rel="stylesheet"
        crossorigin="anonymous">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/css/bootstrap.css"
        rel="stylesheet"
        crossorigin="anonymous">

</head>

<body>
    <div class="container text-center">

        <div class="row">
            <div class="col">

            </div>

            <div class="col-6">
                <h2>Alta de grado</h2>
                <?php
                $idTiposEmp = $_POST['idTiposEmp'];
                $Administrador = $_POST['Administrador'];
                $Auxiliar = $_POST['Auxiliar'];
                $Cliente = $_POST['Cliente'];
                $idPermisos = $_POST['idPermisos'];
                echo "idTiposEmp: " . $idTiposEmp . "<br>";
                echo "Administrador: " . $Administrador . "<br>";
                echo "Auxiliar: " . $Auxiliar . "<br>";
                echo "Cliente: " . $Cliente . "<br>";
                echo "idPermisos: " . $idPermisos . "<br>";
                include 'conexion.php'; // Asegúrate de que la ruta sea correcta

                $Consulta = "INSERT INTO tiposempledos VALUES('$idTiposEmp','$Administrador','$Auxiliar','$Cliente','$idPermisos')";
                $resultado = mysqli_query($conexion, $Consulta);
                if ($resultado == 1) {
                    echo "<h3> datos insertados </h3>";
                } else {
                    echo "<h3>datos no insertados</h3>";
                }

                ?>

            </div>

            <div class="col">

            </div>
        </div>
    </div>


</body>

</html>