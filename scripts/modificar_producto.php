<?php

require('db_connection.php');

var_dump($_POST);

$idProducto = $_POST['id'];
$nombreProducto = $_POST['nombre'];
$costo = $_POST['costo'];
$precio = $_POST['precio'];
$descripcion = $_POST['desc'];
$descAmpliada = $_POST['descAmp'];
$modelo = $_POST['modelo'];
$categoria = $_POST['categoria'];
$marca = $_POST['marca'];
$estado = $_POST['estado'];

$updateProducto = "UPDATE producto SET nombre = '$nombreProducto',
precio = '$precio', costo = '$costo', descripcion = '$descripcion',
descripcionAmpliada = '$descAmpliada', modelo = '$modelo', idCategoria = '$categoria',
idMarca = '$marca', estado = '$estado' WHERE id = '$idProducto'";

if ($query = $mysqli->query($updateProducto)) {
    header('Location:../admin/productos.php?&mensajeModificarProducto=1');
} else {
    $error = $mysqli->error;
    $mysqli->close();
    header('Location:../admin/modificar_producto.php?id='.$idProducto.'&mensajeModificarProducto=2'.$error);
}


?>