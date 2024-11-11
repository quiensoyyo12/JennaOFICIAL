<?php
$conexion = mysqli_connect("localhost", "root", "", "jennawork");

if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}
?>