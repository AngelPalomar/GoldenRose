<?php

require('db_connection.php');

$idCategoria = $_GET['id'];

$cmd = "UPDATE categoria SET estado= 'inactivo'  WHERE categoria.id = '$idCategoria'";

if ($query = $mysqli->query($cmd)) {
	header('Location:../admin/categoria.php?mensajeEliminarCategoria=1');
} else {
	$error = $mysqli->error;
	$mysqli->close();
	header('Location:../admin/categoria.php?mensajeEliminarCategoria=2'.$error);
}

?>