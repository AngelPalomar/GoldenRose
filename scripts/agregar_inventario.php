<?php

require('db_connection.php');

if (isset($_POST)) {
    var_dump($_POST);
    var_dump($_FILES);

    $producto = $_POST['producto'];
    $sucursal = $_POST['sucursal'];
    $cantidad = $_POST['cantidad'];

    $idInventario = 0;

    $maxIdInventario = "SELECT max(id) as maxId FROM inventario";
    $query = $mysqli->query($maxIdInventario);

    if ($query->num_rows > 0) {
        while ($row = $query->fetch_array(MYSQLI_ASSOC)) {
            $idInventario = $row['maxId'] + 1;
        }
    } else {
      
        $idInventario = 1;
    }

    $insertarInventario = "INSERT INTO producto VALUES('$idInventario', '$producto', '$sucursal', '$cantidad')";

    if ($mysqli->query($insertarInventario)) {
            $mysqli->close();
            header('Location:../admin/inventario.php?mensajeAgregarInventario=1');

    } else {
        $error = $mysqli->error;
        $mysqli->close();
        header('Location:../admin/agregar_inventario.php?id='.$idInventario.'&mensajeAgregarInventario=2'.$error);
    }

} else {
    $mysqli->close();
    header('Location:../admin/agregar_inventario.php?mensajeAgregarInventario=3');
}


?>