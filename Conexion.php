<?php
    $host="localhost";
    $user="root";
    $pass="";
    $db ="jennawork";

    $conexion = new mysqli($host, $user, $pass, $db);

    if(!$conexion){
        echo "Conexion fallida";

    }

    
    $conexion2 = new mysqli($host, $user, $pass, $db);

    if(!$conexion2){
        echo "Conexion fallida";

    }

    $conn = new mysqli($host, $user, $pass, $db);
    // Verifica la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
