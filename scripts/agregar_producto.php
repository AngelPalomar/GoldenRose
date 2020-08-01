<?php

require('db_connection.php');

if (isset($_POST)) {
    var_dump($_POST);
} else {
    /**Algo salió mal */
    header('Location:../admin/agregar_usuario.php?mensajeAgregar=3');
}


?>