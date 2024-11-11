<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualización de proveedores</title>
    <link href="css/bootstrap-5.0.2-dist/css/bootstrap.css" type="text/css" rel="stylesheet">
</head>
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
                    $conexion = mysqli_connect("localhost","root","","jennawork");
                    $consulta = "INSERT INTO proveedor VALUES ('$idProveedor', '$Nombre', '$ApellidoP', '$ApellidoM', '$RFC', '$Telefono', '$Domicilio','$Correo')";
                    $resultado=mysqli_query($conexion,$consulta);
                    if($resultado==1){
                        echo "<h3>Datos del proveedor guardados</h3>";
                    }
                    else{
                        echo "<h3>Datos del proveedor No guardados</h3>";
                    }
                ?>
                <a href=""></a>
            </div>
            <div class="col"></div>
        </div>
    </div>
    
</body>
</html>