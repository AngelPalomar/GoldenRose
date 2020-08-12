<?php

session_start();
require('scripts/db_connection.php');

$idVenta = 0;
$maxIdVenta = "SELECT MAX(id) AS maxId FROM venta";

$query = $mysqli->query($maxIdVenta);

if ($query->num_rows > 0) {
    while ($row = $query->fetch_array(MYSQLI_ASSOC)) {
        $idVenta = $row['maxId'] + 1;
    }
} else {
    /**Si no hay registros */
    $idVenta = 1;
}

$fechaVenta = date('Y-m-d H:i:s');
$nuevaVenta = "INSERT INTO venta VALUES ('$idVenta', '$fechaVenta', '0', '', null)";

if ($query = $mysqli->query($nuevaVenta)) {
    $carrito = $_SESSION['carrito'];

    for ($i = 0; $i < sizeof($carrito); $i++) {
        /**Guardo cada producto en el detalle  */

        $idDetalle = 0;
        $maxIdDetalle = "SELECT MAX(id) AS maxId FROM detalle_venta";

        $query = $mysqli->query($maxIdDetalle);

        if ($query->num_rows > 0) {
            while ($row = $query->fetch_array(MYSQLI_ASSOC)) {
                $idDetalle = $row['maxId'] + 1;
            }
        } else {
            /**Si no hay registros */
            $idDetalle = 1;
        }

        /**Buscar un inventario */
        $idProc = $carrito[$i]['ID'];
        $inventario = "SELECT id, idProducto FROM inventario WHERE idProducto = '$idProc'";

        $idInventario = 0;
        /**Agarra el ultimo inventario */
        $query = $mysqli->query($inventario);
        while ($row = $query->fetch_array(MYSQLI_ASSOC)) {
            $idInventario = $row['id'];
        }

        $idUsuario = $_SESSION['id'];
        $cantidad = $carrito[$i]['CANTIDAD'];

        $detalle = "INSERT INTO detalle_venta VALUES ('$idDetalle', '$idVenta', '$idInventario', '$idUsuario', '0', '$cantidad', '0')";

        if ($query = $mysqli->query($detalle)) {
            echo "Insertado";
        } else {
            $error = $mysqli->error;
            echo $error;
        }
    }

    /**Aplicar iva */
    $aplicarIVA = "UPDATE venta SET monto = monto * 1.16 WHERE id = '$idVenta'";
    $query = $mysqli->query($aplicarIVA);
    header('Location:resumen_compra.php?idVenta='.$idVenta);

} else {
    $error = $mysqli->error;
    header('Location:index.php?errorVenta=1'.$error);
}
