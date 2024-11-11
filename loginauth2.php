<?php 
require 'Conexion.php';
$varusuario = $_POST['usuario'];
$varclave = $_POST['contrasena'];
$cous = mysqli_query($conexion, "SELECT count(*) FROM usuarios WHERE usuario = '$varusuario' AND contrasena = '$varclave'");
$cous2 = mysqli_query($conexion, "SELECT * FROM usuarios WHERE usuario = '$varusuario' AND contrasena = '$varclave'");

$au =  mysqli_fetch_row($cous);
$au2 =  mysqli_fetch_row($cous2);
if ($au[0] > 0) {
	session_start();
	$_SESSION['autentica'] = "Administrador";
	$_SESSION['id'] = $au2[0];
	$nomb = $au2[1];
	echo"<script>alert('Bienvenido $nomb.'); 
	window.location.href=\"inicio.html\"</script>";
}else{
	echo"<script>alert('Usuario o contraseña incorrecta.'); 
	window.location.href=\"index.php\"</script>";
}

?>