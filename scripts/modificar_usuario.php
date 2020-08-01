<?php

require('db_connection.php');

if (isset($_POST)) {

    /**Usuario */
    $id = $_POST['id'];
    $email = $_POST['email'];
    $pass = md5($_POST['pass']);
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

    $validarContrasena = "SELECT password AS password FROM usuario WHERE usuario.id = '$id'";
    $query = $mysqli->query($validarContrasena);
    
    while ($row = $query->fetch_array(MYSQLI_ASSOC)) {
        $anteriorContrasena = $row['password'];
    }

    if ($anteriorContrasena !== $pass) {

        /**UPDATE del usuario */
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
                header('Location:../admin/usuarios.php?mensajeModificar=1');
            } else {
                $error = $mysqli->error;
                $mysqli->close();
                header('Location:../admin/modificar_usuario.php?id='.$id.'&mensajeModificar=2'.$error);
            }
            

        } else {
            /**No se pudo actualizar el usuario*/
            $error = $mysqli->error;
            $mysqli->close();
            header('Location:../admin/modificar_usuario.php?id='.$id.'&mensajeModificar=3'.$error);
        }

    } else {
        /**Las contraseñas son iguales */
        header('Location:../admin/modificar_usuario.php?id='.$id.'&mensajeModificar=4');
    }
}

?>