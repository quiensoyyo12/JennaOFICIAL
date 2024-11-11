<html>

<head>
    <title>Usuarios</title>
   
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
                <h2>Alta de usuarios</h2>
                <?php
                    $idUsuarios=$_POST['idUsuarios'];
                    $usuario=$_POST['Nombre'];
                    $Correo=$_POST['Correo'];
                    $Password=$_POST['Password'];
                    echo "idUsuarios: ".$idUsuarios."<br>";
                    echo "Nombre: ".$usuario."<br>";
                    echo "Correo: ".$Correo."<br>";
                    echo "Password: ".$Password."<br>";                  
                    $conexion = mysqli_connect("localhost","root","","jennawork")
                    or die ("Error en la B.D.");
                    $Consulta="INSERT INTO usuarios VALUES('$idUsuarios', '$usuario' ,'$Correo','$Password')";
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