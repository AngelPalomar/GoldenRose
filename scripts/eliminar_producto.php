<?php

require('db_connection.php');

$idProducto = $_GET['id'];

$cmd = "UPDATE producto SET estado = 'no_disponible' WHERE producto.id = '$idProducto'";

if ($query = $mysqli->query($cmd)) {
    header('Location:../admin/productos.php?mensajeEliminarProducto=1');
} else {
    $error = $mysqli->error;
    $mysqli->close();
    header('Location:../admin/productos.php?mensajeEliminarProducto=2'.$error);
}

?>