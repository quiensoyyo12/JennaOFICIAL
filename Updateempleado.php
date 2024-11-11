<html>
    <head>
        <!--Código para acentos y ñ -->
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">


        <title>Actualizar a los empleados</title>
        <link href="css/css/bootstrap.css"
        type="text/css" rel="stylesheet">
        <title>Actualizacion de Empleados</title>
        <body>
            <div class="container">
                <div class="row">
                    <div class="col"></div>
                    <div class="col-6">
                        <?php
                        $idEmpleados=$_POST['idEmpleados'];
                        $Nombre=$_POST['Nombre'];
                        $Apellido_p=$_POST['Apellido_p'];
                        $Apellido_m=$_POST['Apellido_m'];
                        $Correo=$_POST['Correo'];
                        $Password=$_POST['Password'];
                        $Telefono=$_POST['Telefono'];
                        $RFC=$_POST['RFC'];
                        $idTiposEmp=$_POST['idTiposEmp'];
                        $idUsuario=$_POST['idUsuario'];
                        echo "idEmpleados: ".$idEmpleados."<br>";
                        echo "Nombre: ".$Nombre."<br>";
                        echo "Apellido_p: ".$Apellido_p."<br>";
                        echo "Apellido_m: ".$Apellido_m."<br>";
                        echo "Correo: ".$Correo."<br>";
                        echo "Password: ".$Password."<br>";
                        echo "Telefono: ".$Telefono."<br>";
                        echo "RFC: ".$RFC."<br>";
                        echo "idTiposEmp: ".$idTiposEmp."<br>";
                        echo "idUsuario: ".$idUsuario."<br>";
                        $conexion = mysqli_connect("localhost","root","","jennawork") or die ("Error en la B.D.");
                        $consulta="UPDATE empleados SET Nombre='$Nombre',Apellido_p='$Apellido_p', Apellido_m='$Apellido_m',
                        Correo='$Correo', Password='$Password',Telefono='$Telefono', RFC='$RFC', idTiposEmp='$idTiposEmp',
                        idUsuario='$idUsuario'  WHERE idEmpleados='$idEmpleados'";
                        $resultado=mysqli_query($conexion, $consulta);
                        if ($resultado==1)
                        {
                            echo "<h3>Datos del producto actualizando</h3>";
                        }
                        else
                        {
                            echo "<h3>Datos del producto no se guaradron</h3>";
                        }
                        ?>
                         <a href="Consultaempleados.php" class="btn btn-outline-primary">
                     Consulta a la BD de Tipo de usuarios
                    </div>
                    <div class="col"></div>
                </div>

            </div>
        </body>
    </head>
</html>