<<?php

require('db_connection.php');

var_dump($_POST);

if (isset($_POST)) {

  /**Sucursal */
  $id = $_POST['id'];
  /**INSERTAR USUARIO */
  
  $idDireccion = "SELECT direccion.id AS ID FROM direccion INNER JOIN sucursal ON (direccion.id=sucursal.idDireccion) WHERE sucursal.id = '$id'";
  
  $query = $mysqli->query($idDireccion);

  while ($row = $query->fetch_array(MYSQLI_ASSOC)) {

    $idDireccion = $row['ID'];

    $deleteSucursal = "DELETE FROM sucursal  WHERE sucursal.id = '$id'";

    

    if ($mysqli->query($deleteSucursal)) {

     $deleteDireccion = "DELETE FROM direccion WHERE direccion.id= '$idDireccion'";
     
     if ($mysqli->query($deleteDireccion)) {

      /**Cerrar conexión */
      $mysqli->close();
      header('Location:../admin/sucursal.php?mensaje=1');

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
  header('Location:../admin/modificar_sucursal.php?error=1');
}


?>