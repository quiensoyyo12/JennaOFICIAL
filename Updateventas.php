<html>
    <head>
        <!--Código para acentos y ñ -->
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">


        <title>Actualizar las Ventas</title>
        <link href="css/css/bootstrap.css"
        type="text/css" rel="stylesheet">
        <title>Actualizacion de Ventas</title>
        <body>
            <div class="container">
                <div class="row">
                    <div class="col"></div>
                    <div class="col-6">
                        <?php
                            $idVentas=$_POST['idVentas'];
                            $idProducto=$_POST['idProducto'];
                            $idPedidos=$_POST['idPedidos'];
                            $cantidad=$_POST['cantidad'];
                            $total=$_POST['total'];
                            $Fecha_venta=$_POST['Fecha_venta'];
                            echo "idVentas: ". $idVentas."<br>";
                            echo "idProducto: ". $idProducto."<br>";
                            echo "idPedidos: ". $idPedidos."<br>";
                            echo "cantidad: ". $cantidad."<br>";
                            echo "total: ". $total."<br>";
                            echo "Fecha_venta: ". $Fecha_venta."<br>";
                        $conexion = mysqli_connect("localhost","root","","jennawork") or die ("Error en la B.D.");
                        $consulta="UPDATE ventas SET idProducto='$idProducto', idPedidos='$idPedidos', cantidad='$cantidad',
                        total='$total', Fecha_venta='$Fecha_venta' WHERE idVentas='$idVentas'";
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
                         <a href="ConsultaVentas.php" class="btn btn-outline-primary">
                     Consulta a la BD de Tipo de usuarios
                    </div>
                    <div class="col"></div>
                </div>

            </div>
        </body>
    </head>
</html>