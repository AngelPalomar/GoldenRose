<?php

require('db_connection.php');

var_dump($_POST);

$idInventario = $_POST['id'];
$producto = $_POST['producto'];
$sucursal = $_POST['sucursal'];
$cantidad = $_POST['cantidad'];

$updateInventario = "UPDATE inventario SET idProducto = '$producto',
idSucursal = '$sucursal', cantidad = '$cantidad' WHERE inventario.id = '$idInventario'";

if ($query = $mysqli->query($updateInventario)) {
    header('Location:../admin/inventario.php?&mensajeModificarInventario=1');
} else {
    $error = $mysqli->error;
    $mysqli->close();
    header('Location:../admin/modificar_inventario.php?id='.$idInventario.'&mensajeModificarInventario=2'.$error);
}


?>