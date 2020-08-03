<?php

require('db_connection.php');

var_dump($_POST);

if (isset($_POST)) {

    /**Direccion */
    $calle = $_POST['calle'];
    $numEx = $_POST['nE'];
    $numIn = $_POST['nI'];
    $colonia = $_POST['col'];
    $cp = $_POST['cp'];
    $municipio = $_POST['mun'];


    /**Sucursal */
    $nombre1 = $_POST['nom1'];

    /**INSERTAR USUARIO */
    $idDireccion = "SELECT max(id) AS ID FROM direccion";
    $query = $mysqli->query($idDireccion);

    if ($query->num_rows > 0) {
        while ($row = $query->fetch_array(MYSQLI_ASSOC)) {
            /**Máximo id de la tabla dirección */
            $idDireccion = $row['ID'] + 1;

            $insertDireccion = "INSERT INTO direccion VALUES('$idDireccion', '$calle', '$numEx', '$numIn', '$colonia', '$cp', '$municipio', null)";

            if ($mysqli->query($insertDireccion)) {

                /**Agregar sucursal */
                $idSucursal = "SELECT max(id) AS ID FROM Sucursal";
                $query = $mysqli->query($idSucursal);

                if ($query->num_rows > 0) {
                    while ($row = $query->fetch_array(MYSQLI_ASSOC)) {
                        /**Máximo id de la tabla dirección */
                        $idSucursal = $row['ID'] + 1;
                        $insertSucursal = "INSERT INTO sucursal VALUES('$idSucursal', '$nombre1', '$idDireccion')";
                        $mysqli->query($insertSucursal);

                        /**Cerrar conexión */
                        $mysqli->close();
                        header('Location:../admin/sucursal.php?mensaje=1');
                    }
                }

            } else {
                /**No se pudo guardar */
                $error = $mysqli->error;
                $mysqli->close();
                header('Location:../admin/agregar_sucursal.php?mensaje=2&valor='.$error);
            }

        }
    }




} else {
    /**Algo salió mal */
    header('Location:../admin/agregar_sucursal.php?error=1');
}


?>