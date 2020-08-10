<?php

require('db_connection.php');

$idMarca = $_GET['id'];

$cmd = "UPDATE marca SET estado= 'activo'  WHERE marca.id = '$idMarca'";

if ($query = $mysqli->query($cmd)) {
	header('Location:../admin/marca_inactiva.php?mensajeEliminar=1');
} else {
	$error = $mysqli->error;
	$mysqli->close();
	header('Location:../admin/marca_inactiva.php?mensajeEliminar=2'.$error);
}

?>