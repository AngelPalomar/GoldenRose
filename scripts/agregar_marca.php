<?php

require('db_connection.php');

var_dump($_POST);

if (isset($_POST)) {

    /**marca */
    $marca = $_POST['marca'];

    /**INSERTAR USUARIO */
    $idMarca = "SELECT max(id) AS ID FROM marca";
    $query = $mysqli->query($idMarca);


    if ($query->num_rows > 0) {
        while ($row = $query->fetch_array(MYSQLI_ASSOC)) {

            /**Máximo id de la tabla marca*/
            $idMarca = $row['ID'] + 1;
            

            /**Agregar usuario */
            $insertMarca = "INSERT INTO marca VALUES('$idMarca', '$marca')";

            /*Si la consulta se realizo, redireccionamos a la lista de 
            usuarios*/
            if($mysqli->query($insertMarca)) {


                /**Cerrar conexión */
                $mysqli->close();
                header('Location:../admin/marca.php?mensaje=1');
            }

        }
    }

} else {
    /**Algo salió mal */
    header('Location:../admin/agregar_marca.php?error=1');
}


?>