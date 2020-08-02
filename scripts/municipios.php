<?php

require('db_connection.php');

$estado = $_POST['estado'];

$cmd = "SELECT id, nombre FROM municipio WHERE municipio.idEstado LIKE '$estado'";

$query = $mysqli->query($cmd);

while ($row = $query->fetch_array(MYSQLI_ASSOC)) {
    echo '<option hidden selected value="">Selecciona un municipio</option>';
    echo '<option value='.$row['id'].'>'.$row['nombre'].'</option>';
}

?>