<?php

if (isset($_POST)) {
    $nombre1 = $_POST['nombre1'];
    $nombre2 = $_POST['nombre2'];
    $apellido1 = $_POST['apellido1'];
    $apellido2 = $_POST['apellido2'];
    $email = $_POST['email'];
    $calle = $_POST['colonia'];
    $colonia = $_POST['colonia'];
    $numeroExterior = $_POST['numeroExterior'];
    $numeroInterior = $_POST['numeroInterior'];
    $codigoPostal = $_POST['codigoPostal'];
    $municipio = $_POST['municipio'];

    require('db_connection.php');
    /**Procedimiento almacenado de alta de clientes */
    $cmd = "CALL alta_cliente('$email','$nombre1','$nombre2','$apellido1','$apellido2','$calle',
    '$numeroExterior','$numeroInterior','$colonia','$codigoPostal','$municipio')";

    if ($mysqli->query($cmd)) {
        /**Cerrar conexión */
        $mysqli->close();
        header('Location:../store.php?mensaje=1');
    } else {
        $error = $mysqli->error;
        $cmd = 'DELETE FROM usuario WHERE email = ""';
        $mysqli->query($cmd);
        $mysqli->close();
        header('Location:alta_cliente.php?mensaje=2&valor='.$error);
    }
}

?>