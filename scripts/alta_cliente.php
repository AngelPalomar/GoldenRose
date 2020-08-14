<?php

session_start();

require('db_connection.php');

if (isset($_POST)) {
    $nombre1 = $_POST['nombre1'];
    $nombre2 = $_POST['nombre2'];
    $apellido1 = $_POST['apellido1'];
    $apellido2 = $_POST['apellido2'];
    $email = $_POST['email'];
    $contrasena = $_POST['pass'];   
    $fechaR = date('Y-m-d H:i:s');
    $fechaU = date('Y-m-d H:i:s');

    $calle = $_POST['calle'];
    $colonia = $_POST['colonia'];
    $numeroExterior = $_POST['numeroExterior'];
    $numeroInterior = $_POST['numeroInterior'];
    $codigoPostal = $_POST['codigoPostal'];
    $municipio = $_POST['mun'];
    
    /**Procedimiento almacenado */
    $alta = "CALL alta_cliente('$email', '$contrasena', '$nombre1', '$nombre2', '$apellido1', '$apellido2', 
'$calle', '$numeroExterior', '$numeroInterior', '$colonia', '$codigoPostal', '$municipio')";

    if ($query = $mysqli->query($alta)) {
        while ($row = $query->fetch_array(MYSQLI_ASSOC)) {
            $results = $row['RESULT'];
            if ($results === "OK") {
                /**Caso de éxito */
                header('Location:../login.php?mensajeRegister=1');
            } else {
               /**Se hizo rollback y no se pudo registrar */
                header('Location:../register.php?mensajeRegister=2');
            }
        }       
    }
    
} else {
    header('Location:../register.php');
}

?>