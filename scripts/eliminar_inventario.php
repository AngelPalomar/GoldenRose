<?php

require('db_connection.php');

$idProducto = $_GET['id'];

$cmd = "UPDATE inventario SET estado = 'no_disponible' WHERE inventario.id = '$idInventario'";

if ($query = $mysqli->query($cmd)) {
    header('Location:../admin/inventario.php?mensajeEliminarInventario=1');
} else {
    $error = $mysqli->error;
    $mysqli->close();
    header('Location:../admin/inventario.php?mensajeEliminarInventario=2'.$error);
}

?>