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

  <title>Panel de administración - Golden Rose</title>

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
          <h1 class="h3 mb-4 text-gray-800">Inicio</h1>

          <div class="row">
            <div class="col-sm-6 col-md-6 col-lg-6 form-group">
              <button onclick="location.href='producto_categoria.php'" class="btn golden-button-primary btn-block " ><i class="fas fa-box" style="font-size: 40px;"></i></br>Producto por categoria</button>
            </div>

            <div class="col-sm-6 col-md-6 col-lg-6 form-group">
              <button onclick="location.href='usu_qro_notqro.php'" class="btn golden-button-primary btn-block " ><i class="fas fa-user" style="font-size: 40px;"></i></br>Usuarios del estado Querétaro menos del municipio Querétaro</button>
            </div>

          </div>

          <div class="row">
            <div class="col-sm-6 col-md-6 col-lg-6 form-group">
              <button onclick="location.href='ganancias.php'" class="btn golden-button-primary btn-block " ><i class="fas fa-calculator" style="font-size: 40px;"></i></br>Ganancias</button>
            </div>

            <div class="col-sm-6 col-md-6 col-lg-6 form-group">
              <button onclick="location.href='ganancia_menor.php'" class="btn golden-button-primary btn-block " ><i class="fas fa-calculator" style="font-size: 40px;"></i></br>Menores ganancias</button>
            </div>

          </div>

          <div class="row">
            <div class="col-sm-6 col-md-6 col-lg-6 form-group">
              <button onclick="location.href='compra_clientes.php'" class="btn golden-button-primary btn-block " ><i class="fas fa-star" style="font-size: 40px;"></i></br>Compras de los clientes</button>
            </div>

            <div class="col-sm-6 col-md-6 col-lg-6 form-group">
              <button onclick="location.href='activos_inactivos.php'" class="btn golden-button-primary btn-block " ><i class="fas fa-user" style="font-size: 40px;"></i></br>Usuarios activos e inactivos</button>
            </div>

          </div>
          <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
          <div class="container my-auto">
            <div class="copyright text-center my-auto">
              <span>Copyright &copy; Golden Rose - Jardinería 2020</span>
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
