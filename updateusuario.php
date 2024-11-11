<html>
    <head>
        <!--Código para acentos y ñ -->
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">


        <title>Actualizar a los usuarios</title>
        <link href="css/css/bootstrap.css"
        type="text/css" rel="stylesheet">
        <title>Actualizacion de usuarios</title>
        <body>
            <div class="container">
                <div class="row">
                    <div class="col"></div>
                    <div class="col-6">
                        <?php
                        $idUsuarios=$_POST['idUsuarios'];
                        $Correo=$_POST['Correo'];
                        $Password=$_POST['Password'];
                        echo "idUsuarios: ".$idUsuarios."<br>";
                        echo "Correo: ".$Correo."<br>";
                        echo "Password: ".$Password."<br>";
                        $conexion=mysqli_connect("localhots","root","","jennawork")
                        or die("Error enla conexion de la BD");
                        $consulta="UPDATE usuarios SET Correo='$Correo', Password='$Password'
                         WHERE idUsuarios='$idUsuarios'";
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
                         <a href="Consultausuario.php" class="btn btn-outline-primary">
                     Consulta a la BD de usuarios
                    </div>
                    <div class="col"></div>
                </div>

            </div>
        </body>
    </head>
</html>