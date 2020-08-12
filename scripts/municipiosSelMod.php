<?php

require('db_connection.php');

$estado = $_POST['estado'];

$cmd = "SELECT id, nombre FROM municipio WHERE municipio.idEstado LIKE '$estado'";

$query = $mysqli->query($cmd);

while ($row = $query->fetch_array(MYSQLI_ASSOC)) {
    $idUser = $_POST['id'];

    $munUsu = "SELECT municipio.nombre AS NOMBREMUN
    FROM usuario
    INNER JOIN direccion ON (usuario.id=direccion.idUsuario)
    inner join municipio ON (direccion.idMunicipio=municipio.id)
    WHERE usuario.id = '$idUser'";

    $query1 = $mysqli->query($munUsu);

    while ($row1 = $query1->fetch_array(MYSQLI_ASSOC)) {
        $nameMun = $row1['NOMBREMUN'];
    }

    if ($nameMun == $row['nombre']) {
        $selected = 'selected="selected"';
    } else {
        $selected = 'NULL';
    }

    echo '<option '.$selected.' value='.$row['id'].'>'.$row['nombre'].'</option>';
}

?>