<html>

<head>
    <title>Alta de empleados/clientes</title>

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
                <h2>Alta de empleados</h2>
                <?php
                
                $Nombre = $_POST['Nombre'];
                $Apellido_p = $_POST['Apellido_p'];
                $Apellido_m = $_POST['Apellido_m'];
                $Correo = $_POST['Correo'];
                $contrasena = $_POST['contrasena'];
                $genero = $_POST['Genero'];
                $Telefono = $_POST['Telefono'];
                $RFC = $_POST['RFC'];
                $idTiposEmp = $_POST['idTiposEmp'];
                $idUsuario = $_POST['idUsuario'];
                
                echo "Nombre: " . $Nombre . "<br>";
                echo "Apellido_p: " . $Apellido_p . "<br>";
                echo "Apellido_m: " . $Apellido_m . "<br>";
                echo "Correo: " . $Correo . "<br>";
                echo "contrasena: " . $contrasena . "<br>";
                echo "Telefono: " . $Telefono . "<br>";
                echo "RFC: " . $RFC . "<br>";
                echo "idTiposEmp: " . $idTiposEmp . "<br>";
                echo "idUsuario: " . $idUsuario . "<br>";
                $host = "localhost";
                $usuario = "root";
                $password = "";
                $basedatos = "jennawork";
                $conexion = mysqli_connect($host, $usuario, $password, $basedatos);
                //or die ("Error en la B.D.");
                $Consulta = "INSERT INTO empleados VALUES ('$idEmpleados','$Nombre','$Apellido_p','$Apellido_m','$Correo',
                    '$contrasena','$genero','$Telefono','$RFC','$idTiposEmp','$idUsuario')";
                $resultado = mysqli_query($conexion, $Consulta);
                if ($resultado == 1) {
                    echo "<h3> Datos insertados </h3>";
                } else {
                    echo "<h3>Datos no insertados</h3>";
                }

                ?>

            </div>

            <div class="col">

            </div>
        </div>
    </div>


</body>

</html>