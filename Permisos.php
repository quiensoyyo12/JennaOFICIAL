<html>

<head>
    <title>Permisos</title>

    <link href="css/css/bootstrap.css" rel="stylesheet" crossorigin="anonymous">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/css/bootstrap.css" rel="stylesheet" crossorigin="anonymous">

</head>

<body>
    <div class="container text-center">

        <div class="row">
            <div class="col">

            </div>

            <div class="col-6">
                <h2>Alta de permisos</h2>
                <?php
                $idPermisos = $_POST['idPermisos'];
                $Reportes = $_POST['Reportes'];
                $Consultas = $_POST['Consultas'];
                echo "idPermisos: " . $idPermisos . "<br>";
                echo "Reportes: " . $Reportes . "<br>";
                echo "Consultas: " . $Consultas . "<br>";
                $conexion = mysqli_connect("localhost", "root", "", "jennawork")
                    or die("Error en la B.D.");
                $Consulta = "INSERT INTO permisos VALUES('$idPermisos','$Reportes','$Consultas')";
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