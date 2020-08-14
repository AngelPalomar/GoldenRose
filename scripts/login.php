<?php

session_start();

if (isset($_POST)) {
    require('db_connection.php');

    $email= $_POST['email'];
    $password= $_POST['password'];

    /**Consulta */
    $cmd = "SELECT * FROM golden_rose.usuario WHERE email LIKE '$email'";
    $query = $mysqli->query($cmd);

    /**Si hay resultados */
    if ($query->num_rows > 0) {
        $usuario = $query->fetch_array(MYSQLI_ASSOC);
        
        /**Verificar contraseña */
        if (md5($password) === $usuario['password']) {
            
            /**Iniciamos sesión */
            if ($usuario['estado'] == 'activo') {
                
                $_SESSION['id'] = $usuario['id'];
                $_SESSION['email'] = $usuario['email'];
                $_SESSION['tipoUsuario'] = $usuario['tipoUsuario'];
                $_SESSION['nombre1'] = $usuario['nombre1'];
                $_SESSION['nombre2'] = $usuario['nombre2'];
                $_SESSION['apellidoPaterno'] = $usuario['apellidoPaterno'];
                $_SESSION['apellidoMaterno'] = $usuario['apellidoMaterno'];
                $_SESSION['fechaUltimoAcceso'] = $usuario['fechaUltimoAcceso'];
                $_SESSION['estado'] = $usuario['estado'];

                /**Fecha actual */
                $date = date('Y-m-d H:i:s');
                $idUsuario = $usuario['id'];

                /**Actualización de fecha de acceso */
                $updateDateLogin = "UPDATE usuario SET fechaUltimoAcceso = '$date' 
                WHERE usuario.id = '$idUsuario'";

                $query = $mysqli->query($updateDateLogin);

                $tipoUser = $_SESSION['tipoUsuario'];
                $acceso = "SELECT url FROM accesos WHERE tipoUsuario = '$tipoUser'";

                $query = $mysqli->query($acceso);

                if ($query->num_rows === 1) {
                    $row = $query->fetch_array(MYSQLI_ASSOC);
                    $view = $row['url'];
                }

                $url = 'Location:http://localhost/GoldenRose/'.$view;

                /**Redirección */
                header($url);

            } else {
                /**Usuario inactivo/deshabilitado */
                header('Location:../login.php?error=4');
            }
            
        } else {
            /**Contraseña incorrecta */
            header('Location:../login.php?error=3');
        }

    } else {
        /**Usuario no existe */
        header('Location:../login.php?error=2');
    }
} else {
    /**Algo salió mal */
    header('Location:../login.php?error=1');
}


?>