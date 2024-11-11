<html>

<head>
    <title>Detalle de venta</title>
    <link href="css/css/bootstrap.css" 
        rel="stylesheet"
         crossorigin="anonymous">
         <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1" >
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
                <h2>Detalle de venta</h2>
                <?php
                    $idDetalle_venta=$_POST['idDetalle_venta'];
                    $idVenta=$_POST['idVenta'];
                    $idProductos=$_POST['idProductos'];
                    $Cantidad=$_POST['Cantidad'];
                    echo "idDetalle_venta: ".$idDetalle_venta."<br>";
                    echo "idVenta: ".$idVenta."<br>";
                    echo "idProductos: ".$idProductos."<br>"; 
                    echo "Cantidad: ".$Cantidad."<br>";                  
                    $conexion = mysqli_connect("localhost","root","","jennawork")
                    or die ("Error en la B.D.");
                    $Consulta="INSERT INTO detalle_venta VALUES('idDetalle_venta','$idVenta','$idProductos','$Cantidad')";
                    $resultado=mysqli_query($conexion,$Consulta);
                    if($resultado==1)
                    {
                        echo "<h3> datos insertados </h3>";
                    }
                    else
                    {
                        echo "<h3>datos no insertados</h3>";
                    }
                    
                ?>
                
            </div>

            <div class="col">
            
            </div>
        </div>
    </div>
    

</body>
</html>