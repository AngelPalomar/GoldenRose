<?php

require('db_connection.php');

$cmd = "SELECT * FROM sucursal";
$query = $mysqli->query($cmd);

$tipoUsuario = $_POST['tipoUsuario'];

if ($tipoUsuario === "empleado") {
    echo "
    <h4 class='h4 mb-4 text-gray-800'>
        Sucursal
        <small><sup>Solo aplica para empleados</sup></small>
    </h4>
    <div class='row form-group'>
        <div class='col-sm-3'>
        <label for='suc'>Nombre de sucursal</label>
        <select name='suc' id='suc' class='form-control' required>";

    while ($row = $query->fetch_array(MYSQLI_ASSOC)) {
        echo '<option value='.$row['id'].'>'.$row['nombre'].'</option>';
    }
    
    echo "</select>
        </div>
  </div>";
}



?>