<?php
header('Location: index.html');

session_start();

include_once('Conexion.php');
if (isset($_POST['usuario']) && isset($_POST['contrasena'])) {
    function Validar($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);

        return $data;
    }

    $usuario = Validar($_POST['usuario']);
    $contrasena = Validar($_POST['contrasena']);

    if (empty($usuario)) {
        header('location: index.php');
        exit();
    } elseif (empty($contrasena)) {
        header('location: index.php');
        exit();
    } else {
        $sql = "SELECT * FROM usuarios WHERE usuario = '$usuario'";
        $query = mysqli_query($conexion, $sql);

        if ($query->num_rows == 1) {
            $usuarioQ = $query->fetch_assoc();
            $id = $usuarioQ['id'];
            $usuario = $usuarioQ['usuario'];
            $contrasena = $usuarioQ['contrasena'];
            $Nombre_Completo = $usuarioQ['Nombre_Completo'];

            if ($usuario === $usuario) {
                if (password_verify($contrasena, $contrasena)) {
                    $_SESSION['id'] = $id;
                    $_SESSION['usuario'] = $usuario;
                    $_SESSION['Nombre_Completo'] = $Nombre_Completo;

                    echo "<script>
                    alert('Bienvenido $Nombre_Completo');
                    location.href = ''
                    </script>";
                    header('Location: inicio.html');
                } else{
                    echo"<script>alert('Usuario o contraseña incorrecta.'); 
                    window.location.href=\"index.php\"</script>";
                }
            } else {
                header('location: index.php');
            }
        } else {
            header('location: index.php');
        }
        
    }
}
