<?php

require('db_connection.php');

$idMarca = $_GET['id'];

$cmd = "UPDATE marca SET estado= 'inactivo'  WHERE marca.id = '$idMarca'";

if ($query = $mysqli->query($cmd)) {
	header('Location:../admin/marca.php?mensajeEliminar=1');
} else {
	$error = $mysqli->error;
	$mysqli->close();
	header('Location:../admin/marca.php?mensajeEliminar=2'.$error);
}

?>
