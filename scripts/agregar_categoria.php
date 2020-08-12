<?php

require('db_connection.php');

var_dump($_POST);

if (isset($_POST)) {

    $categoria = $_POST['categoria'];

    $idCategoria = "SELECT max(id) AS ID FROM categoria";
    $query = $mysqli->query($idCategoria);


    if ($query->num_rows > 0) {
        while ($row = $query->fetch_array(MYSQLI_ASSOC)) {

            $idCategoria = $row['ID'] + 1;
            
            $insertCategoria = "INSERT INTO categoria VALUES('$idCategoria', '$categoria', 'activo')";

            if($mysqli->query($insertCategoria)) {

                $mysqli->close();
                header('Location:../admin/categoria.php?mensajeAgregar=1');
            } else {
                $error = $mysqli->error;
                $mysqli->close();
                header('Location:../admin/categoria.php?mensajeAgregar=2'.$error);
            }

        }
    }

} else {
    header('Location:../admin/agregar_categoria.php?mensajeAgregar=2');
}


?>