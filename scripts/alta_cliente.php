<?php

require('db_connection.php');

if (isset($_POST)) {
    $nombre1 = $_POST['nombre1'];
    $nombre2 = $_POST['nombre2'];
    $apellido1 = $_POST['apellido1'];
    $apellido2 = $_POST['apellido2'];
    $email = $_POST['email'];
    $contrasena = md5($_POST['pass']);   
    $fechaR = date('Y-m-d H:i:s');
    $fechaU = date('Y-m-d H:i:s');

    $calle = $_POST['colonia'];
    $colonia = $_POST['colonia'];
    $numeroExterior = $_POST['numeroExterior'];
    $numeroInterior = $_POST['numeroInterior'];
    $codigoPostal = $_POST['codigoPostal'];
    $municipio = $_POST['mun'];
    
    /**INSERTAR USUARIO */
    $idUsuario = "SELECT max(id) AS ID FROM usuario";
    $query = $mysqli->query($idUsuario);

    if ($query->num_rows > 0) {
        while ($row = $query->fetch_array(MYSQLI_ASSOC)) {
            /**Máximo id de la tabla dirección */
            $idUsuario = $row['ID'] + 1;

            /**Agregar usuario */
            $insertUsuario = "INSERT INTO usuario VALUES('$idUsuario', '$email', '$contrasena', 'cliente', '$nombre1', '$nombre2', '$apellido1', '$apellido2', '$fechaR', '$fechaU', 'activo', null)";

            if ($mysqli->query($insertUsuario)) {
                
                /**Agregar dirección */
                $idDireccion = "SELECT max(id) AS ID FROM direccion";
                $query = $mysqli->query($idDireccion);

                if ($query->num_rows > 0) {
                    while ($row = $query->fetch_array(MYSQLI_ASSOC)) {
                        /**Máximo id de la tabla dirección */
                        $idDireccion = $row['ID'] + 1;
                        $insertDireccion = "INSERT INTO direccion VALUES('$idDireccion', '$calle', '$numeroExterior', '$numeroInterior', '$colonia', '$codigoPostal', '$municipio', '$idUsuario')";
                        $mysqli->query($insertDireccion);

                        /**Cerrar conexión */
                        $mysqli->close();

                        header('Location:../login.php?mensajeRegister=1');
                    }
                }

            } else {
                /**No se pudo guardar */
                $error = $mysqli->error;
                $mysqli->close();
                header('Location:../register.php?mensajeRegister=2&valor='.$error);
            }
        }
    }
    
}

?>