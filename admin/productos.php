<?php

session_start();

if (!isset($_SESSION['id']) || $_SESSION['tipoUsuario'] === 'cliente') {
  header('Location:../login.php');
}

require('../scripts/db_connection.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Productos - Golden Rose</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

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
          <h1 class="h3 mb-4 text-gray-800 text-center"><i class="fas fa-box"></i> Productos</h1>

          <div class="row pb-3">
            <div class="col-sm-3">
              <a href="agregar_producto.php" class="btn golden-button-primary btn-lg btn-block">
                  <span class="icon text-white-50">
                    <i class="fas fa-plus"></i>
                  </span>
                <span class="text">Agregar Producto</span>
              </a>
            </div>
            <div class="col-sm-3">
              <a href="consultar_producto.php" class="btn golden-button-primary btn-lg btn-block">
                  <span class="icon text-white-50">
                    <i class="fas fa-search"></i>
                  </span>
                <span class="text">Buscar Producto</span>
              </a>
            </div>
          </div>

          <?php if(isset( $_GET['mensajeAgregarProducto'])) : ?>
            <?php switch ( $_GET['mensajeAgregarProducto'] ) : case 1: ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                  <strong><i class="fas fa-check-circle"></i> Producto agregado con éxito.</strong> <br/>
                  <span>Verifique los resultados.</span> 
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
            <?php break; endswitch; ?>
          <?php endif; ?>

          <?php if(isset( $_GET['mensajeModificarProducto'])) : ?>
            <?php switch ( $_GET['mensajeModificarProducto'] ) : case 1: ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                  <strong><i class="fas fa-check-circle"></i> Producto modificado con éxito.</strong> <br/>
                  <span>Verifique los resultados.</span> 
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
            <?php break; endswitch; ?>
          <?php endif; ?>

          <?php if(isset( $_GET['mensajeEliminarProducto'])) : ?>
            <?php switch ( $_GET['mensajeEliminarProducto'] ) : case 1: ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                  <strong><i class="fas fa-check-circle"></i> Estatus del producto cambiado con éxito.</strong> <br/>
                  <span>Verifique que el estado del usuario sea "inactivo".</span> 
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
            <?php break; ?>
            <?php case 2: ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  <strong><i class="fas fa-times-circle"></i> El estatus del producto no pudo ser cambiado.</strong> <br/>
                  <span>Contacte al administrador.</span> 
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
            <?php break; endswitch; ?>
          <?php endif; ?>

          <span>Productos existentes en el sistema</span>

          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead class="golden-bg-secondary">
                <th>ID</th>
                <th>NOMBRE DEL PRODUCTO</th>
                <th>COSTO</th>
                <th>PRECIO</th>
                <th>IMAGEN</th>
                <th>CATEGORIA</th>
                <th>MARCA</th>
                <th>ESTADO ACTUAL</th>
                <th>ACCIONES</th>
              </thead>
              <tbody>
                <?php 
                $cmd = "SELECT producto.id AS ID, producto.nombre AS NOMBRE_PRODUCTO, 
                producto.costo AS COSTO, producto.precio AS PRECIO, producto.pathImagen AS IMAGEN, 
                categoria.nombre AS CATEGORIA, marca.nombre AS MARCA,
                (
                  CASE
                    WHEN estado LIKE 'disponible' THEN 'Disponible'
                    WHEN estado LIKE 'no_disponible' THEN 'No disponible'
                  END
                ) AS ESTATUS
                FROM producto
                INNER JOIN categoria ON (categoria.id = producto.idCategoria) 
                INNER JOIN marca ON (marca.id = producto.idMarca)";

                $query = $mysqli->query($cmd);
                
                if ($query->num_rows > 0):
                  while($row = $query->fetch_array(MYSQLI_ASSOC)):?>
                  <tr>
                    <td><?=$row['ID']?></td>
                    <td><?=$row['NOMBRE_PRODUCTO']?></td>
                    <td><?=$row['COSTO']?></td>
                    <td><?=$row['PRECIO']?></td>
                    <td>
                      <img src="../imagenes_productos/<?=$row['IMAGEN']?>" alt="producto" width="40px">
                    </td>
                    <td><?=$row['CATEGORIA']?></td>
                    <td><?=$row['MARCA']?></td>
                    <td><?=$row['ESTATUS']?></td>
                    <td>
                      <div class="d-flex flex-row">
                        <div class="col-sm-6"> 
                          <a href="modificar_producto.php?id=<?=$row['ID']?>" class="btn golden-button-success"> 
                            <i class="fas fa-pen"></i>
                          </a>
                        </div>
                        <div class="col-sm-6">
                          <a href="eliminar_producto.php?id=<?=$row['ID']?>" class="btn golden-button-danger"> 
                            <i class="fas fa-times"></i>
                          </a>
                        </div>
                      </div>
                    </td>
                  </tr>
                  <?php endwhile; ?>
                <?php endif; ?>
              </tbody>
            </table>
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
