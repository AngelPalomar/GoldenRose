<?php

if (!isset($_POST['id'])) {
  /**No hay id en la URL */
  header('sucursal.php?mensajeEliminar=1');
} else {
  require('../scripts/db_connection.php');
  
  $idSucursal = $_POST['id'];
  
  $cmd = "UPDATE sucursal SET estado = 'inactivo' WHERE sucursal.id LIKE '$idSucursal'";
  $bajaExistencias = "UPDATE inventario SET cantidad = 0 WHERE idSucursal = '$idSucursal'";
  
  if ($query = $mysqli->query($cmd)) {
    /**Baja existencias */
    $query = $mysqli->query($bajaExistencias);
    header('Location:../admin/sucursal.php?mensajeEliminar=1');
  } else {
    /**No se pudo */
    header('Location:sucursal.php?mensajeEliminar=2');
  }
}

?>