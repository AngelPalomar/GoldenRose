<?php

require('db_connection.php');

if (isset($_POST)) {
    var_dump($_POST);
    var_dump($_FILES);

    $producto = $_POST['producto'];
    $sucursal = $_POST['sucursal'];
    $cantidad = $_POST['cantidad'];

    /**Busqueda que verifica que ya exista este inventario */
    $verificarExistencia = "SELECT inventario.id, producto.nombre, sucursal.nombre, cantidad FROM inventario
    INNER JOIN producto ON (producto.id = inventario.idProducto)
    INNER JOIN sucursal ON (sucursal.id = inventario.idSucursal)
    WHERE producto.id = '$producto' AND sucursal.id = '$sucursal'";

    $query = $mysqli->query($verificarExistencia);

    /**si se encuentra */
    if ($query->num_rows === 1) {

        /**Sumar la cantidad ingresada, a la ya existente */
        $sumarCantidad = "UPDATE inventario SET cantidad = cantidad + '$cantidad'
        WHERE idProducto = '$producto' AND idSucursal = '$sucursal'";

        if ($mysqli->query($sumarCantidad)) {
            $mysqli->close();
            header('Location:../admin/inventario.php?mensajeAgregarInventario=1&accion=sumar');
        } else {
            $error = $mysqli->error;
            $mysqli->close();
            header('Location:../admin/agregar_inventario.php?id='.$idInventario.'&mensajeAgregarInventario=2'.$error);
        }

    } else {
        /**Si este producto no está en existencia en dicha sucursal, inserta uno nuevo */
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

        $insertarInventario = "INSERT INTO inventario VALUES('$idInventario', '$producto', '$sucursal', '$cantidad')";

        if ($mysqli->query($insertarInventario)) {
            $mysqli->close();
            header('Location:../admin/inventario.php?mensajeAgregarInventario=1&accion=agregar');
        } else {
            $error = $mysqli->error;
            $mysqli->close();
            header('Location:../admin/agregar_inventario.php?id='.$idInventario.'&mensajeAgregarInventario=2'.$error);
        }
    }

} else {
    $mysqli->close();
    header('Location:../admin/agregar_inventario.php?mensajeAgregarInventario=3');
}


?>