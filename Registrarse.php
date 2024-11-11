<?php
session_start();
include_once('Conexion.php');
if (isset($_POST['usuario']) && isset($_POST['Nombre_Completo']) && isset($_POST['contrasena']) && isset($_POST['Rcontrasena'])) {
    function validar ($data) {
        $data = trim($data);
        $data = stripcslashes($data);
        $data = htmlspecialchars($data);

        return $data;

    }

    $usuario = validar($_POST['usuario']);
    $Nombre_Completo = validar($_POST['Nombre_Completo']);
    $contrasena = validar($_POST['contrasena']);
    $Rcontrasena = validar($_POST['Rcontrasena']);

    $datosUsuario = 'usuario='.$usuario. '&Nombre_Completo='.$Nombre_Completo;

    if (empty($usuario)) {
        header("location: Registrate.php?error=El usuario es requerido&$datosUsuario");
        exit();
    }
    elseif (empty($Nombre_Completo)) {
        header("location: Registrate.php?error=El nombre completo es requerido&$datosUsuario");
        exit();
    }
    elseif (empty($contrasena)) {
        header("location: Registrate.php?error=La contraseña es requerida&$datosUsuario");
        exit();
    }
    elseif (empty($Rcontrasena)) {
        header("location: Registrate.php?error=Repetir la contraseña es requerido&$datosUsuario");
        exit();
    }
    elseif ($contrasena !== $Rcontrasena) {
        header("location: Registrate.php?error=La contraseña no coincide&$datosUsuario");
        exit();
    }
    else {
        $contrasena= password_hash($contrasena, PASSWORD_DEFAULT);

        $sql = "SELECT * FROM usuarios WHERE usuario ='$usuario'";
        $query = $conexion->query($sql);

        if (mysqli_num_rows($query) > 0) {
            header("location: Registrate.php?error=El usuario ya existe");
        exit();
        }
        else {
            $sql2 = "INSERT INTO usuarios (Nombre_Completo, usuario, contrasena) VALUES ('$Nombre_Completo','$usuario','$contrasena')";
            $query2 = $conexion->query($sql2);

            if ($query2) {
                header("location: Registrate.php?success=Usuario creado con exito");
        exit();
            }
            else {
                header("location: Registrate.php?error=Ocurrio un error");
        exit();
            }
        }
    }

}
else {
    header('location: Registrate.php');
        exit();
}