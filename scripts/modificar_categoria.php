<?php

require('db_connection.php');

$idCategoria = $_POST['id'];
$nombreCategoria = $_POST['nombre'];
$estado = $_POST['estado'];

$updateCategoria = "UPDATE categoria SET 
nombre = '$nombreCategoria', 
estado = '$estado'
WHERE id = '$idCategoria'";

if ($query = $mysqli->query($updateCategoria)) {

	header('Location:../admin/categoria.php?&mensajeModificar=1');

} else {
	$error = $mysqli->error;
	$mysqli->close();
	header('Location:../admin/modificar_categoria.php?id='.$idCategoria.'&mensajeModificar=2'.$error);
}


?>