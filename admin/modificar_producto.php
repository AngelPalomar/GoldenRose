<?php

session_start();

if (!isset($_SESSION['id']) || $_SESSION['tipoUsuario'] === 'cliente') {
  header('Location:../login.php');
}

require('../scripts/db_connection.php');

if (isset($_GET['id'])) {
  $idProducto = $_GET['id'];
  $cmd = "SELECT producto.id AS ID, producto.nombre AS NOMBRE_PRODUCTO, 
  producto.costo AS COSTO, producto.precio AS PRECIO, producto.descripcion AS DESCRIPCION, 
  producto.descripcionAmpliada AS DESC_AMP, producto.pathImagen AS IMAGEN, producto.modelo AS MODELO,
  categoria.nombre AS CATEGORIA, marca.nombre AS MARCA, producto.estado AS ESTADO
  FROM producto
  INNER JOIN categoria ON (categoria.id = producto.idCategoria) 
  INNER JOIN marca ON (marca.id = producto.idMarca)
  WHERE producto.id = '$idProducto'";

  $query = $mysqli->query($cmd);

  if ($query->num_rows === 1) {
    $datosProducto = $query->fetch_array(MYSQLI_ASSOC);
  } else {
    /**No encontró producto */
    header('Location:productos.php?MensajeModificarProducto=2');
  }
  

} else {
  /**No hay id por GET */
  header('Location:productos.php?MensajeModificarProducto=2');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Agregar producto - Golden Rose</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link
    href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
    rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../assets/css/golden_rose.css" rel="stylesheet">
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <?php require('menu_admin.php') ?>
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <?php require('header.php') ?>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800 text-center"><i class="fas fa-box"></i> Modificar Producto</h1>

          <div>
            <form action="../scripts/modificar_producto.php" enctype="multipart/form-data" method="post">
              <div class="form-group">
                <h4 class="h4 mb-4 text-gray-800">Datos del producto</h4>
                <div class="row">
                  <div class="col-sm-1 form-group">
                    <label for="nombre">*ID</label>
                    <input type="text" name="id" id="id" class="form-control" maxlength="25" required
                      value="<?=$datosProducto['ID']?>" readonly>
                  </div>
                  <div class="col-sm-4 form-group">
                    <label for="nombre">*Nombre del producto</label>
                    <input type="text" name="nombre" id="nombre" class="form-control" maxlength="25" required
                      value="<?=$datosProducto['NOMBRE_PRODUCTO']?>">
                  </div>
                  <div class="col-sm-2 form-group">
                    <label for="precio">*Costo original</label>
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text">$</span>
                      </div>
                      <input type="number" step="0.01" name="costo" id="costo" class="form-control" maxlength="11"
                        placeholder="00.00" value="<?=$datosProducto['COSTO']?>" required>
                    </div>
                  </div>
                  <div class="col-sm-2 form-group">
                    <label for="precio">*Precio al publico</label>
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text">$</span>
                      </div>
                      <input type="number" step="0.01" name="precio" id="precio" class="form-control" maxlength="11"
                        placeholder="00.00" value="<?=$datosProducto['PRECIO']?>" required>
                    </div>
                  </div>
                  <div class="col-sm-3">
                    <label for="marca">*Estado actual</label>
                    <select name="estado" id="estado" class="form-control" required>
                      <option hidden selected value="">Seleccione el estado del producto</option>
                      <option value="disponible" <?=$datosProducto['ESTADO'] == 'disponible' ? 'selected="selected"' : NULL?>>Disponible</option>
                      <option value="no_disponible" <?=$datosProducto['ESTADO'] == 'no_disponible' ? 'selected="selected"' : NULL?>>No disponible</option>
                    </select>
                  </div>
                </div>

                <h4 class="h4 mb-4 text-gray-800">Descripción y características</h4>
                <div class="row">
                  <div class="col-sm-6 form-group">
                    <label for="desc">*Descripción del producto</label>
                    <textarea name="desc" id="desc" cols="132" rows="5" maxlength="256" class="form-control"
                      required><?=$datosProducto['DESCRIPCION']?></textarea>
                  </div>
                  <div class="col-sm-6 form-group">
                    <label for="desc">*Descripción ampliada (características) del producto</label>
                    <textarea name="descAmp" id="descAmp" cols="132" rows="5" maxlength="512" class="form-control"
                      required><?=$datosProducto['DESC_AMP']?></textarea>
                  </div>
                </div>

                <div class="row form-group mb-5">
                  <div class="col-sm-4">
                    <label for="modelo">*Modelo del producto</label>
                    <input type="text" name="modelo" id="modelo" class="form-control" value="<?=$datosProducto['MODELO']?>" required>
                  </div>
                  <div class="col-sm-4">
                    <label for="categoria">*Categoría</label>
                    <select name="categoria" id="categoria" class="form-control" required>
                      <option hidden selected value="">Seleccione una categoría</option>
                      <?php 
                      $cmd = "SELECT * FROM categoria";
                      $query = $mysqli->query($cmd);
                      
                      if ($query->num_rows > 0):
                        while($row = $query->fetch_array(MYSQLI_ASSOC)) :
                    ?>
                      <option value="<?=$row['id']?>" <?=$datosProducto['CATEGORIA'] == $row['nombre'] ? 'selected="selected"' : NULL?> ><?=$row['nombre']?></option>
                      <?php 
                      endwhile;
                      endif; 
                    ?>
                    </select>
                  </div>
                  <div class="col-sm-4">
                    <label for="marca">*Marca</label>
                    <select name="marca" id="marca" class="form-control" required>
                      <option hidden selected value="">Seleccione una marca</option>
                      <?php 
                      $cmd = "SELECT * FROM marca";
                      $query = $mysqli->query($cmd);
                      
                      if ($query->num_rows > 0):
                        while($row = $query->fetch_array(MYSQLI_ASSOC)) :
                    ?>
                      <option value="<?=$row['id']?>" <?=$datosProducto['MARCA'] == $row['nombre'] ? 'selected="selected"' : NULL?>><?=$row['nombre']?></option>
                      <?php 
                      endwhile;
                      endif; 
                    ?>
                    </select>
                  </div>
                </div>

                <div class="form-group text-center">
                  <button type="submit" class="btn golden-button-primary btn-lg">
                    <i class="fas fa-upload"></i>
                    Subir producto
                  </button>
                  <button type="button" class="btn golden-button-danger btn-lg" onclick="regresar();">
                    <i class="fas fa-times"></i>
                    Cancelar
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Your Website 2020</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

</body>

</html>

<script>
  function regresar() {
    if (confirm("¿Realmente quiere salir de esta sección?\nNo se guardarán los cambios.")) {
      window.location.href = 'productos.php';
    }
  }
</script>