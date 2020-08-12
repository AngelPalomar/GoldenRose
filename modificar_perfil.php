<?php

require('scripts/db_connection.php');

if (isset($_POST) && isset($_SESSION['id'])) {

    /**Usuario */
    $id = $_SESSION['id'];
    $email = $_POST['email'];
    $nombre1 = $_POST['nom1'];
    $nombre2 = $_POST['nom2'];
    $apellidoP = $_POST['ap'];
    $apellidoM = $_POST['am'];

    /**Direccion */
    $calle = $_POST['calle'];
    $numEx = $_POST['nE'];
    $numIn = $_POST['nI'];
    $colonia = $_POST['col'];
    $cp = $_POST['cp'];
    $municipio = $_POST['mun'];

    /**UPDATE del usuario */
    $updateUsuario = "UPDATE usuario SET 
        email = '$email',
        nombre1 = '$nombre1',
        nombre2 = '$nombre2',
        apellidoPaterno = '$apellidoP',
        apellidoMaterno = '$apellidoM'
        WHERE usuario.id = '$id'";

    if ($mysqli->query($updateUsuario)) {

        /**UPDATE direccion */
        $updateDireccion = "UPDATE direccion SET 
            calle = '$calle',
            numeroExterior = '$numEx',
            numeroInterior = '$numIn',
            colonia = '$colonia',
            codigoPostal = '$cp',
            idMunicipio = '$municipio'
            WHERE direccion.idUsuario = '$id'";

        if ($mysqli->query($updateDireccion)) {
            /**Todo correcto */
            header('Location:perfil.php?mensajeModificar=1');
        } else {
            $error = $mysqli->error;
            $mysqli->close();
            header('Location:perfil.php?id=' . $id . '&mensajeModificar=2' . $error);
        }
    } else {
        /**No se pudo actualizar el usuario*/
        $error = $mysqli->error;
        $mysqli->close();
        header('Location:perfil.php?id=' . $id . '&mensajeModificar=3' . $error);
    }
}
