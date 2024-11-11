<html>
    <head>
        <!--Código para acentos y ñ -->
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Actualizar detalles</title>
        <link href="css/css/bootstrap.css"
        type="text/css" rel="stylesheet">
        <title>Actualizacion de los detalles</title>
        <body>
            <div class="container">
                <div class="row">
                    <div class="col"></div>
                    <div class="col-6">
                        <?php
                        $idDetalle_peddido=$_POST['id_control'];
                        $idProductos=$_POST['idProductos'];
                        $idPedidos=$_POST['idPedidos'];
                        echo "idDetalle_peddido: ".$idDetalle_peddido."<br>";
                        echo "idProductos: ".$idProductos."<br>"; 
                        echo "idPedidos: ".$idPedidos."<br>";      
                        $conexion = mysqli_connect("localhost","root","","jennawork") or die ("Error en la B.D.");
                        $consulta="UPDATE detalle_pedido SET  idProductos='$idProductos', idPedidos='$idPedidos'
                        WHERE idDetalle_peddido='$idDetalle_peddido'";
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
                            <a href="ConsultaDetalleP.php" class="btn btn-outline-primary">
                        Consulta a la BD de peidos
                    </div>
                    <div class="col"></div>
                </div>
            </div>
        </body>
    </head>
</html>