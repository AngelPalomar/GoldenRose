<?php

require('db_connection.php');

var_dump($_POST);

$idMarca = $_POST['id'];
$nombreMarca = $_POST['nombre'];

$updateMarca = "UPDATE marca SET nombre = '$nombreMarca' WHERE id = '$idMarca'";

if ($query = $mysqli->query($updateMarca)) {
	header('Location:../admin/marca.php?&mensajeModificarProducto=1');
} else {
	$error = $mysqli->error;
	$mysqli->close();
	header('Location:../admin/modificar_marca.php?id='.$idMarca.'&mensajeModificarProducto=2'.$error);
}


?>