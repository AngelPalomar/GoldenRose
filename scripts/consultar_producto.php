<?php

require('db_connection.php');

if ($_POST['producto'] === "") {
    echo "<div class='alert alert-info mt-4'>
        <h4><i class='fas fa-info-circle'></i> Buscar productos por ID</h4>
        <hr />
        <p>Por favor, ingrese el valor correspondiente en el campo para buscar.</p>
    </div>";
} else {
    $producto = $_POST['producto'];

    $cmd = "SELECT producto.id AS ID, producto.nombre AS NOMBRE_PRODUCTO, 
    producto.costo AS COSTO, producto.precio AS PRECIO, producto.descripcion AS DESCRIPCION, 
    producto.descripcionAmpliada AS DESC_AMP, producto.pathImagen AS IMAGEN, categoria.nombre AS CATEGORIA, 
    marca.nombre AS MARCA 
    FROM producto
    INNER JOIN categoria ON (categoria.id = producto.idCategoria) 
    INNER JOIN marca ON (marca.id = producto.idMarca)
    WHERE producto.id = '$producto'";

    $query = $mysqli->query($cmd);

    if ($query->num_rows > 0) {
        while ($row = $query->fetch_array(MYSQLI_ASSOC)) {
          echo '<div class="card">
          <div class="card-header">
            <h4><i class="fas fa-box"></i> '.$row['NOMBRE_PRODUCTO'].'</h4>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-sm-8">
                <div>
                  <span class="font-weight-bold">ID del producto: </span>
                  <span>'.$row['ID'].'</span>
                </div>
                <div>
                  <span class="font-weight-bold">Costo: $</span>
                  <span>'.$row['COSTO'].'</span>
                </div>
                <div>
                  <span class="font-weight-bold">Precio: $</span>
                  <span>'.$row['PRECIO'].'</span>
                </div>
                <div>
                  <span class="font-weight-bold">Descripción: </span>
                  <span>'.$row['DESCRIPCION'].'</span>
                </div>
                <div>
                  <span class="font-weight-bold">Cacterísticas: </span>
                  <span>'.$row['DESC_AMP'].'</span>
                </div>
                <div>
                  <span class="font-weight-bold">Categoría: $</span>
                  <span>'.$row['CATEGORIA'].'</span>
                </div>
                <div>
                  <span class="font-weight-bold">Marca: $</span>
                  <span>'.$row['MARCA'].'</span>
                </div>
              </div>
              <div class="col-sm-2">
                <div>
                  <img src="../imagenes_productos/'.$row['IMAGEN'].'" alt="imagen_producto" width="100%">
                </div>
              </div>
            </div>
          </div>
        </div>';
        }
    } else {
        echo "<div class='alert alert-danger mt-4'>
        <h4><i class='fas fa-times-circle'></i> El producto ingresado no existe</h4>
        <hr />
        <p>No se encontró a ningún producto, por favor, inténtelo de nuevo.</p>
      </div>";
    }
    
}


?>