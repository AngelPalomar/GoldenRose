<?php

session_start();

if (!isset($_SESSION['id']) || $_SESSION['tipoUsuario'] === 'cliente' || $_SESSION['tipoUsuario'] === 'empleado') {
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

  <title>SB Admin 2 - Blank</title>

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
          <h1 class="h3 mb-4 text-gray-800 text-center"><i class="fas fa-copyright"></i> Categorias</h1>

          <div class="row pb-3">
            <div class="col-sm-3">
              <a href="agregar_categoria.php" class="btn golden-button-primary btn-lg btn-block">
                <span class="icon text-white-50">
                  <i class="fas fa-copyright"></i>
                </span>
                <span class="text">Agregar categoria</span>
              </a>
            </div>
            
          </div>


          <?php if(isset( $_GET['mensajeAgregar'])) : ?>
            <?php switch ( $_GET['mensajeAgregar'] ) : case 1: ?>
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong><i class="fas fa-check-circle"></i> Categoria agregada con éxito.</strong> <br/>
                <span>Verifique los resultados.</span> 
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <?php break; endswitch; ?>
            <?php endif; ?>

            <?php if(isset( $_GET['mensajeModificar'])) : ?>
              <?php switch ( $_GET['mensajeModificar'] ) : case 1: ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                  <strong><i class="fas fa-check-circle"></i> Categoria modificada con éxito.</strong> <br/>
                  <span>Verifique los resultados.</span> 
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <?php break; endswitch; ?>
              <?php endif; ?>

              <?php if(isset( $_GET['mensajeEliminar'])) : ?>
                <?php switch ( $_GET['mensajeEliminar'] ) : case 1: ?>
                  <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong><i class="fas fa-check-circle"></i> Estatus de la categoria cambiada a estado inactivo.</strong> <br/>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <?php break; ?>
                  <?php case 2: ?>
                  <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong><i class="fas fa-times-circle"></i> El estatus de la categoria no pudo ser cambiado a inactivo.</strong> <br/>
                    <span>Contacte al administrador.</span> 
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <?php break; endswitch; ?>
                <?php endif; ?>

                <span>Categorias registradas en el sistema</span>

                <div class="table-responsive">
                  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead class="golden-bg-secondary">
                      <th>ID</th>
                      <th>NOMBRE</th>
                      <th>ESTADO ACTUAL</th>
                      <th>ACCIONES</th>
                    </thead>
                    <tbody>
                      <?php 
                      $cmd = 'SELECT id AS ID,
                      nombre AS NOMBRE,
                      estado AS ESTADO
                      from categoria
                      ORDER BY id DESC';

                      $query = $mysqli->query($cmd);

                      if ($query->num_rows > 0):
                        while($row = $query->fetch_array(MYSQLI_ASSOC)):?>
                          <tr>
                            <td><?=$row['ID']?></td>
                            <td><?=$row['NOMBRE']?></td>
                            <td><?=$row['ESTADO']?></td>
                            <td>
                              <div class="d-flex flex-row">
                                <div class="col-sm-6"> 
                                  <a href="modificar_categoria.php?id=<?=$row['ID']?>" class="btn golden-button-success"> 
                                    <i class="fas fa-pen"></i>
                                  </a>
                                </div>
                                <div class="col-sm-6">
                                  <a href="eliminar_categoria.php?id=<?=$row['ID']?>" class="btn golden-button-danger"> 
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
