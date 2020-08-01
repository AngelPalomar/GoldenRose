<?php

require('db_connection.php');

if ($_POST['usuario'] === "") {
    echo "<div class='alert alert-info mt-4'>
        <h4><i class='fas fa-info-circle'></i> Buscar usuarios</h4>
        <hr />
        <p>Por favor, ingrese el valor correspondiente en el campo para buscar.</p>
    </div>";
} else {
    $usuario = $_POST['usuario'];

    $cmd = "SELECT * FROM (SELECT usuario.id AS ID,
                usuario.email AS EMAIL,
                CONCAT(usuario.nombre1, ' ', usuario.nombre2, ' ', usuario.apellidoPaterno, ' ', usuario.apellidoMaterno) AS NOMBRE,
                (
                  CASE
                    WHEN tipoUsuario LIKE 'admin' THEN 'Administrador'
                    WHEN tipoUsuario LIKE 'empleado' THEN 'Empleado'
                    WHEN tipoUsuario LIKE 'cliente' THEN 'Cliente'
                  END
                ) AS 'TIPO USUARIO',
                (
                  CASE
                    WHEN estado LIKE 'activo' THEN 'Activo'
                    WHEN estado LIKE 'inactivo' THEN 'Inactivo'
                  END
                ) AS 'ESTADO ACTUAL',
                usuario.fechaRegisro AS FECHA_DE_REGISTRO,
                CONCAT(calle, ' No. ', numeroExterior, ' ', numeroInterior, ' ', colonia, ' ', codigoPostal, ' ', municipio.nombre, ', ', estado.nombre) AS DIRECCION
                FROM usuario 
                INNER JOIN direccion ON (usuario.id=direccion.idUsuario)
                INNER JOIN municipio ON (direccion.idMunicipio=municipio.id)
                INNER JOIN estado ON (municipio.idEstado=estado.id)
                ORDER BY usuario.id ASC) AS tabla_usuarios
                WHERE NOMBRE LIKE '%$usuario%'";

    $query = $mysqli->query($cmd);

    if ($query->num_rows > 0) {
        while ($row = $query->fetch_array(MYSQLI_ASSOC)) {
            echo '<div class="alert alert-secondary mt-4 mb-3 p-3">
            <h3><i class="fas fa-user"></i> '.$row['NOMBRE'].'</h3>';
            echo '<span>
                <span class="font-weight-bold">ID del usuario: </span>
                <span>'.$row['ID'].'</span>
            </span>
            <br/>';
            echo '<span>
                <span class="font-weight-bold">Tipo de usuario: </span>
                <span>'.$row['TIPO USUARIO'].'</span>
            </span>
            <br />';
            echo '<span>
                <span class="font-weight-bold">Correo electrónico: </span>
                <span>'.$row['EMAIL'].'</span>
            </span>
            <br/>';
            echo '<span>
                <span class="font-weight-bold">Estado actual: </span>
                <span>'.$row['ESTADO ACTUAL'].'</span>
            </span>
            <br />';
            echo '<span>
                <span class="font-weight-bold">Fecha de registro: </span>
                <span>'.$row['FECHA_DE_REGISTRO'].'</span>
            </span>
            <br />';
            echo '<span>
                <span class="font-weight-bold">Domicilio: </span>
                <span>'.$row['DIRECCION'].'</span>
            </span>
          </div>';
        }
    } else {
        echo "<div class='alert alert-danger mt-4'>
        <h4><i class='fas fa-times-circle'></i> No se encontró a ningún usuario</h4>
        <hr />
        <p>No se encontró a ningún usuario, por favor, inténtelo de nuevo.</p>
      </div>";
    }
    
}


?>