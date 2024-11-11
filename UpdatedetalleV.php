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
                        $idDetalle_venta=$_POST['idDetalle_venta'];
                        $idVentas=$_POST['idVentas'];
                        $idProductos=$_POST['idProductos'];
                        $Cantidad=$_POST['Cantidad'];
                        echo "idDetalle_venta: ".$idDetalle_venta."<br>";
                        echo "idVentas: ".$idVentas."<br>";
                        echo "idProductos: ".$idProductos."<br>"; 
                        echo "Cantidad: ".$Cantidad."<br>";    
                        $conexion = mysqli_connect("localhost","root","","jennawork") or die ("Error en la B.D.");
                        $consulta="UPDATE detalle_venta SET idVenta='$idVenta', idProductos='$idProductos', Cantidad='$Cantidad'
                        WHERE idDetalle_venta='$idDetalle_venta'";
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
                            <a href="ConsultadetalleV.php" class="btn btn-outline-primary">
                        Consulta a la BD de Tipo de usuarios
                    </div>
                    <div class="col"></div>
                </div>

            </div>
        </body>
    </head>
</html>