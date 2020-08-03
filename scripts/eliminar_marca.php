<?php

require('db_connection.php');

$idMarca = $_GET['id'];

$cmd = "DELETE FROM MARCA  WHERE marca.id = '$idMarca'";

if ($query = $mysqli->query($cmd)) {
	header('Location:../admin/marca.php?mensajeEliminarMarca=1');
} else {
	$error = $mysqli->error;
	$mysqli->close();
	header('Location:../admin/marca.php?mensajeEliminarMarca=2'.$error);
}

?>