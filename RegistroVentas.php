<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Regristo de Ventas</title>
    <link href="css/bootstrap-5.0.2-dist/css/bootstrap.css" type="text/css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col"></div>
            <div class="col-6">
                <?php
                    $idVentas=$_POST['idVentas'];
                    $total=$_POST['total'];
                    $Fecha_venta=$_POST['Fecha_venta'];
                    $idEmpleados=$_POST['idEmpleados'];
                    $idPedidos=$_POST['idPedidos'];
                    echo "idVentas: ". $idVentas."<br>";
                    echo "total: ". $total."<br>";
                    echo "Fecha_venta: ". $Fecha_venta."<br>";
                    echo "idEmpleados: ". $idEmpleados."<br>";
                    echo "idPedidos: ". $idPedidos."<br>";
                    $conexion = mysqli_connect("localhost","root","","jennawork");
                    $consulta = "INSERT INTO ventas VALUES ('$idVentas', '$total', '$Fecha_venta', '$idEmpleados', '$idPedidos' )";
                    $resultado=mysqli_query($conexion,$consulta);
                    if($resultado==1){
                        echo "<h3>Datos de la venta guardados</h3>";
                    }
                    else{
                        echo "<h3>Datos de la venta no guardados</h3>";
                    }
                ?>
                <a href="ConsultasVentas.php">Consulta las Ventas</a>
            </div>
            <div class="col"></div>
        </div>
    </div>
    
</body>
</html>