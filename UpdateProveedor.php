<html>
    <head>
        <!--Código para acentos y ñ -->
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">


        <title>Actualizar a los Proveedores</title>
        <link href="css/css/bootstrap.css"
        type="text/css" rel="stylesheet">
        <title>Actualizacion de Proveedores</title>
        <body>
            <div class="container">
                <div class="row">
                    <div class="col"></div>
                    <div class="col-6">
                        <?php
                        $idProveedor=$_POST['idProveedor'];
                        $Nombre=$_POST['Nombre'];
                        $ApellidoP=$_POST['ApellidoP'];
                        $ApellidoM=$_POST['ApellidoM'];
                        $RFC=$_POST['RFC'];
                        $Telefono=$_POST['Telefono'];
                        $Domicilio=$_POST['Domicilio'];
                        $Correo=$_POST['Correo'];
                        echo "Nombre: ". $Nombre."<br>";
                        echo "ApellidoP: ". $ApellidoP."<br>";
                        echo "ApellidoM: ". $ApellidoM."<br>";
                        echo "RFC: ". $RFC."<br>";
                        echo "Teléfono: ". $Telefono."<br>";
                        echo "Domicilio: ". $Domicilio."<br>";
                        echo "Correo: ". $Correo."<br>";
                        $conexion = mysqli_connect("localhost","root","","jennawork") or die ("Error en la B.D.");
                        $consulta="UPDATE proveedor SET Nombre='$Nombre', ApellidoP='$ApellidoP', ApellidoM='$ApellidoM',
                        RFC='$RFC', Telefono='$Telefono',Domicilio='$Domicilio', Correo='$Correo' WHERE idProveedor='$idProveedor'";
                        $resultado=mysqli_query($conexion, $consulta);
                        if ($resultado==1)
                        {
                            echo "<h3>Datos actualizados</h3>";
                        }
                        else
                        {
                            echo "<h3>Datos no actualizados</h3>";
                        }
                        ?>
                         <a href="Consultaproveedor.php" class="btn btn-outline-primary">
                     Consulta a la BD de Tipo de usuarios
                    </div>
                    <div class="col"></div>
                </div>

            </div>
        </body>
    </head>
</html>