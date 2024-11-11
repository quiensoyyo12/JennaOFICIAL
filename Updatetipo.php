<html>
    <head>
        <!--Código para acentos y ñ -->
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">


        <title>Actualizar a los Rangos</title>
        <link href="css/css/bootstrap.css"
        type="text/css" rel="stylesheet">
        <title>Actualizacion de Rangos</title>
        <body>
            <div class="container">
                <div class="row">
                    <div class="col"></div>
                    <div class="col-6">
                        <?php
                       $idTiposEmp=$_POST['idTiposEmp'];
                       $Administrador=$_POST['Administrador'];
                       $Auxiliar=$_POST['Auxiliar'];
                       $Cliente=$_POST['Cliente'];
                       $idPermisos=$_POST['idPermisos'];
                       echo "idTiposEmp: ".$idTiposEmp."<br>";
                       echo "Administrador: ".$Administrador."<br>";
                       echo "Auxiliar: ".$Auxiliar."<br>"; 
                       echo "Cliente: ".$Cliente."<br>";
                       echo "idPermisos: ".$idPermisos."<br>";
                       $conexion = mysqli_connect("localhost","root","","jennawork")
                       or die ("Error en la B.D.");
                        $consulta="UPDATE tiposempledos SET Administrador='$Administrador', Auxiliar='$Auxiliar', Cliente='$Cliente',
                        idPermisos='$idPermisos' WHERE idTiposEmp='$idTiposEmp'";
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
                         <a href="Consultatipo.php" class="btn btn-outline-primary">
                     Consulta a la BD de Tipo de usuarios
                    </div>
                    <div class="col"></div>
                </div>

            </div>
        </body>
    </head>
</html>