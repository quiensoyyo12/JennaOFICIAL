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
                        $idPedidos=$_POST['idPedidos'];
                        $Cantidad_Pedidos=$_POST['Cantidad_Pedidos'];
                        $FechaEntrega_Pedidos=$_POST['FechaEntrega_Pedidos'];
                        $Total=$_POST['Total'];
                        $idProveedor=$_POST['idProveedor'];
                        echo "idPedidos: ".$idPedidos."<br>";
                        echo "Cantidad_Pedidos: ".$Cantidad_Pedidos."<br>";
                        echo "FechaEntrega_Pedidos: ".$FechaEntrega_Pedidos."<br>";
                        echo "Total: ".$Total."<br>";   
                        echo "idProveedor: ".$idProveedor."<br>";     
                        $conexion = mysqli_connect("localhost","root","","jennawork") or die ("Error en la B.D.");
                        $consulta="UPDATE pedidos SET Cantidad_Pedidos='$Cantidad_Pedidos',FechaEntrega_Pedidos='$FechaEntrega_Pedidos',
                        Total='$Total', idProveedor='$idProveedor' WHERE idPedidos='$idPedidos'";
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
                         <a href="Consultapedidos.php" class="btn btn-outline-primary">
                     Consulta a la BD de Tipo de usuarios
                    </div>
                    <div class="col"></div>
                </div>

            </div>
        </body>
    </head>
</html>