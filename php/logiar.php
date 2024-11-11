<?php 
include 'conexion.php';
$varusuario = $_POST['usuario'];
$varclave = $_POST['clave'];
$consulta = mysqli_query($conexion, "SELECT count(*) FROM usuario WHERE usuario = '$varusuario' AND contrasenia = '$varclave' ");
$arrcon = mysqli_fetch_row($consulta);
$consulta2 = mysqli_query($conexion, "SELECT * FROM usuario WHERE usuario = '$varusuario' AND contrasenia = '$varclave' ");
$arrcon2 = mysqli_fetch_array($consulta2);
if ($arrcon[0] > 0) {
	session_start();
	$_SESSION['autentica'] = "ADMIN";
	$_SESSION['id'] = $arrcon2['id_usuario'];
	$nomb = $arrcon2['nombre'];
	echo"<script>alert('Bienvenido $nomb.'); 
	window.location.href=\"inicio.php\"</script>";
}else{
	echo"<script>alert('Usuario o contraseña incorrecta.'); 
	window.location.href=\"../\"</script>";
}

?>