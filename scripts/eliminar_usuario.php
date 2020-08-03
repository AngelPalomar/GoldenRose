<?php

if (!isset($_POST['id'])) {
    /**No hay id en la URL */
    header('Location:usuarios.php?mensajeEliminar=1');
} else {
    require('../scripts/db_connection.php');
  
    $idUsuario = $_POST['id'];
  
    $cmd = "UPDATE usuario SET estado = 'inactivo' WHERE usuario.id LIKE '$idUsuario'";
  
    if ($query = $mysqli->query($cmd)) {
      header('Location:../admin/usuarios.php?mensajeEliminar=1');
    } else {
      /**No se pudo */
      header('Location:usuarios.php?mensajeEliminar=2');
    }
}

?>