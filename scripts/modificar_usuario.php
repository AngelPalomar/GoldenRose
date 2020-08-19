<?php

require('db_connection.php');

if (isset($_POST)) {

    /**Usuario */
    $id = $_POST['id'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $tipo = $_POST['tipo'];
    $nombre1 = $_POST['nom1'];
    $nombre2 = $_POST['nom2'];
    $apellidoP = $_POST['ap'];
    $apellidoM = $_POST['am'];
    $estatus = $_POST['estatus'];

    /**Direccion */
    $calle = $_POST['calle'];
    $numEx = $_POST['nE'];
    $numIn = $_POST['nI'];
    $colonia = $_POST['col'];
    $cp = $_POST['cp'];
    $municipio = $_POST['mun'];

    /**Si es empleado y se eligió una sucursal */
    if (isset($_POST['suc'])) {
        $sucursal = $_POST['suc'];
    } else {
        $sucursal = 'null';
    }

    /**Busco su contraseña anterior */
    $validarContrasena = "SELECT password AS password FROM usuario WHERE usuario.id = '$id'";
    $query = $mysqli->query($validarContrasena);

    if ($query->num_rows === 1) {
        $anteriorContrasena = $query->fetch_array(MYSQLI_ASSOC);
    }

    if ($anteriorContrasena['password'] == $pass) {
        /**UPDATE del usuario sin reemplazar la contraseña*/

        $updateUsuario = "UPDATE usuario SET 
        email = '$email', 
        password = '$pass',
        nombre1 = '$nombre1',
        nombre2 = '$nombre2',
        apellidoPaterno = '$apellidoP',
        apellidoMaterno = '$apellidoM',
        tipoUsuario = '$tipo',
        estado = '$estatus',
        idSucursal = $sucursal
        WHERE usuario.id = '$id'";

    } else {
        /**UPDATE del usuario con contraseña nueva*/
        $pass = md5($_POST['pass']);

        $updateUsuario = "UPDATE usuario SET 
        email = '$email', 
        password = '$pass',
        nombre1 = '$nombre1',
        nombre2 = '$nombre2',
        apellidoPaterno = '$apellidoP',
        apellidoMaterno = '$apellidoM',
        tipoUsuario = '$tipo',
        estado = '$estatus',
        idSucursal = $sucursal
        WHERE usuario.id = '$id'";
    }

    /**Las contraseñas son iguales */
    //header('Location:../admin/modificar_usuario.php?id=' . $id . '&mensajeModificar=4');

    if ($mysqli->query($updateUsuario)) {

        $updateDireccion = "UPDATE direccion SET 
            calle = '$calle',
            numeroExterior = '$numEx',
            numeroInterior = '$numIn',
            colonia = '$colonia',
            codigoPostal = '$cp',
            idMunicipio = '$municipio'
            WHERE direccion.idUsuario = '$id'";

        if ($mysqli->query($updateDireccion)) {
            header('Location:../admin/usuarios.php?mensajeModificar=1');
        } else {
            $error = $mysqli->error;
            $mysqli->close();
            header('Location:../admin/modificar_usuario.php?id=' . $id . '&mensajeModificar=2' . $error);
        }
    } else {
        $error = $mysqli->error;
        $mysqli->close();
        header('Location:../admin/modificar_usuario.php?id=' . $id . '&mensajeModificar=3' . $error);
    }
}
