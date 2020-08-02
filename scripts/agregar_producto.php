<?php

require('db_connection.php');

if (isset($_POST)) {
    var_dump($_POST);
    var_dump($_FILES);

    $nombreProducto = $_POST['nombre'];
    $costo = $_POST['costo'];
    $descripcion = $_POST['desc'];
    $descAmpliada = $_POST['descAmp'];
    $modelo = $_POST['modelo'];
    $imagen = $_FILES['imagen'];
    $categoria = $_POST['categoria'];
    $marca = $_POST['marca'];
    $estado = $_POST['estado'];

    $idProducto = 0;

    $maxIdProducto = "SELECT max(id) as maxId FROM producto";
    $query = $mysqli->query($maxIdProducto);

    if ($query->num_rows > 0) {
        while ($row = $query->fetch_array(MYSQLI_ASSOC)) {
            $idProducto = $row['maxId'] + 1;
        }
    } else {
        /**Si no hay registros */
        $idProducto = 1;
    }

    /**INSERT DE PRODUCTO */
    $pathImagen = $imagen['name'];
    $insertarProducto = "INSERT INTO producto VALUES('$idProducto', '$nombreProducto', '0', '$costo', '$descripcion', '$descAmpliada', '$modelo', '$pathImagen', '$categoria', '$marca', '$estado')";

    if ($mysqli->query($insertarProducto)) {

        /**Cargar imagen al servidor */
        if (move_uploaded_file($imagen['tmp_name'], '../imagenes_productos/'.$imagen['name'])) {
            echo 'Imagen cargada correctamente.';

            $mysqli->close();
            header('Location:../admin/productos.php?mensajeAgregarProducto=1');
        }

    } else {
        /**Si no se pudo insertar */
        $error = $mysqli->error;
        $mysqli->close();
        header('Location:../admin/agregar_producto.php?id='.$idProducto.'&mensajeAgregarProducto=2'.$error);
    }

} else {
    /**Algo salió mal */
    $mysqli->close();
    header('Location:../admin/agregar_producto.php?mensajeAgregarProducto=3');
}


?>