<?php

require('db_connection.php');

var_dump($_POST);

if (isset($_POST)) {

    /**Usuario */
    $email = $_POST['email'];
    $pass = md5($_POST['pass']);
    $tipo = $_POST['tipo'];
    $nombre1 = $_POST['nom1'];
    $nombre2 = $_POST['nom2'];
    $apellidoP = $_POST['ap'];
    $apellidoM = $_POST['am'];
    $fechaR = date('Y-m-d H:i:s');
    $fechaU = date('Y-m-d H:i:s');
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

    /**INSERTAR USUARIO */
    $idUsuario = "SELECT max(id) AS ID FROM usuario";
    $query = $mysqli->query($idUsuario);

    if ($query->num_rows > 0) {
        while ($row = $query->fetch_array(MYSQLI_ASSOC)) {
            /**Máximo id de la tabla dirección */
            $idUsuario = $row['ID'] + 1;

            /**Agregar usuario */
            $insertUsuario = "INSERT INTO usuario VALUES('$idUsuario', '$email', '$pass', '$tipo', '$nombre1', '$nombre2', '$apellidoP', '$apellidoM', '$fechaR', '$fechaU', '$estatus', $sucursal)";

            if ($mysqli->query($insertUsuario)) {
                
                /**Agregar dirección */
                $idDireccion = "SELECT max(id) AS ID FROM direccion";
                $query = $mysqli->query($idDireccion);

                if ($query->num_rows > 0) {
                    while ($row = $query->fetch_array(MYSQLI_ASSOC)) {
                        /**Máximo id de la tabla dirección */
                        $idDireccion = $row['ID'] + 1;
                        $insertDireccion = "INSERT INTO direccion VALUES('$idDireccion', '$calle', '$numEx', '$numIn', '$colonia', '$cp', '$municipio', '$idUsuario')";
                        $mysqli->query($insertDireccion);

                        /**Cerrar conexión */
                        $mysqli->close();
                        header('Location:../admin/usuarios.php?mensaje=1');
                    }
                }

            } else {
                /**No se pudo guardar */
                $error = $mysqli->error;
                $mysqli->close();
                header('Location:../admin/agregar_usuario.php?mensaje=2&valor='.$error);
            }
        }
    }

} else {
    /**Algo salió mal */
    header('Location:../admin/agregar_usuario.php?error=1');
}


?>