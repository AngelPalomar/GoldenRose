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
    $id = $_POST['id'];
    $estatus = $_POST['estatus'];
    /**INSERTAR USUARIO */
    
    $idDireccion = "SELECT direccion.id AS ID FROM direccion INNER JOIN sucursal ON (direccion.id=sucursal.idDireccion) WHERE sucursal.id = '$id'";
    
    $query = $mysqli->query($idDireccion);

    while ($row = $query->fetch_array(MYSQLI_ASSOC)) {

        $idDireccion = $row['ID'];


        $updateDireccion = "UPDATE direccion SET
        calle = '$calle',
        numeroExterior =  '$numEx',
        numeroInterior =  '$numIn',
        colonia = '$colonia',
        codigoPostal = '$cp',
        idMunicipio = '$municipio', 
        idUsuario = null 
        WHERE direccion.id= '$idDireccion'";

        if ($mysqli->query($updateDireccion)) {


            $updateSucursal = "UPDATE sucursal SET nombre = '$nombre1', estado= '$estatus' WHERE sucursal.id = '$id'";

            if ($mysqli->query($updateSucursal)) {

                /**Cerrar conexión */
                $mysqli->close();
                header('Location:../admin/sucursal.php?mensajeModificar=1');

            } else {
                $error = $mysqli->error;
                $mysqli->close();
                header('Location:../admin/modificar_sucursal.php?id='.$id.'&mensajeModificar=2'.$error);
            }



        } else {
            /**No se pudo guardar */
            $error = $mysqli->error;
            $mysqli->close();
            header('Location:../admin/modificar_sucursal.php?id='.$id.'&mensajeModificar=3'.$error);
        }

    }


} else {
    /**Algo salió mal */
    header('Location:../admin/modificar_sucursal.php?mensajeModificar=4');
}


?>
