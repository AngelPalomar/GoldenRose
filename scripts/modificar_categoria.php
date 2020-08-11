<?php

require('db_connection.php');

var_dump($_POST);

$idCategoria = $_POST['id'];
$nombreCategoria = $_POST['nombre'];

$updateMarca = "UPDATE categoria SET nombre = '$nombreCategoria' WHERE id = '$idCategoria'";

if ($query = $mysqli->query($updateCategoria)) {
	header('Location:../admin/categoria.php?&mensajeModificar=1');
} else {
	$error = $mysqli->error;
	$mysqli->close();
	header('Location:../admin/modificar_categoria.php?id='.$idCategoria.'&mensajeModificar=2'.$error);
}


?>