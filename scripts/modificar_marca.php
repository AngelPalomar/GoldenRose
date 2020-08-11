<?php

require('db_connection.php');

var_dump($_POST);

$idMarca = $_POST['id'];
$nombreMarca = $_POST['nombre'];
$estatus = $_POST['estatus'];

$updateMarca = "UPDATE marca SET nombre = '$nombreMarca', estado= '$estatus' WHERE id = '$idMarca'";

if ($query = $mysqli->query($updateMarca)) {
	header('Location:../admin/marca.php?&mensajeModificar=1');
} else {
	$error = $mysqli->error;
	$mysqli->close();
	header('Location:../admin/modificar_marca.php?id='.$idMarca.'&mensajeModificar=2'.$error);
}


?>
