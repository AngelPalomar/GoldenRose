<?php

require('db_connection.php');

if ($_POST['sucursal'] === "") {
    echo "<div class='alert alert-info mt-4'>
    <h4><i class='fas fa-info-circle'></i> Buscar sucursales</h4>
    <hr />
    <p>Por favor, ingrese el valor correspondiente en el campo para buscar.</p>
    </div>";
} else {
    $sucursal = $_POST['sucursal'];

    $cmd =  "SELECT * FROM (SELECT sucursal.id AS ID,
    sucursal.nombre AS SUCURSAL,
    CONCAT(calle, ' No. ', numeroExterior, ' ' , numeroInterior, ' ', colonia) AS DIRECCION,
    codigoPostal,
    estado.nombre AS ESTADO,
    municipio.nombre AS MUNICIPIO
    FROM direccion 
    INNER JOIN sucursal ON (direccion.id=sucursal.idDireccion)
    INNER JOIN municipio ON (direccion.idMunicipio=municipio.id)
    INNER JOIN estado ON (municipio.idEstado=estado.id)
    ORDER BY sucursal.id ASC) AS tabla_sucursales
    WHERE SUCURSAL LIKE '%$sucursal%' OR DIRECCION LIKE '%$sucursal%' OR ESTADO LIKE '%$sucursal%' OR MUNICIPIO LIKE '%$sucursal%'";

    $query = $mysqli->query($cmd);

    if ($query->num_rows > 0) {
        while ($row = $query->fetch_array(MYSQLI_ASSOC)) {
            echo '<div class="alert alert-secondary mt-4 mb-3 p-3">
            <h3><i class="fas fa-store"></i> '.$row['SUCURSAL'].'</h3>';
            echo '<span>
            <span class="font-weight-bold">ID de la sucursal: </span>
            <span>'.$row['ID'].'</span>
            </span>
            <br/>';
            echo '<span>
            <span class="font-weight-bold">Direccion: </span>
            <span>'.$row['DIRECCION'].'</span>
            </span>
            <br>';
            echo '<span>
            <span class="font-weight-bold">Codigo postal: </span>
            <span>'.$row['codigoPostal'].'</span>
            </span>
            <br>';
            echo '<span>
            <span class="font-weight-bold">Estado: </span>
            <span>'.$row['ESTADO'].'</span>
            </span>
            <br>';
            echo '<span>
            <span class="font-weight-bold">Municipio: </span>
            <span>'.$row['MUNICIPIO'].'</span>
            </span>
            </div>';
        }
    } else {
        echo "<div class='alert alert-danger mt-4'>
        <h4><i class='fas fa-times-circle'></i> No se encontró a ninguna sucursal</h4>
        <hr />
        <p>No se encontró a ninguna sucursal, por favor, inténtelo de nuevo.</p>
        </div>";
    }
    
}


?>