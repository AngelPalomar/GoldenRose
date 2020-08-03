<?php

session_start();

if (!isset($_SESSION['id']) || $_SESSION['tipoUsuario'] === 'cliente') {
  header('Location:../login.php');
}

if (!isset($_GET['id'])) {
  /**No hay id en la URL */
  header('Location:sucursal.php?error=1');
} else {
  require('../scripts/db_connection.php');

  $idSucursal = $_GET['id'];

  $cmd = "SELECT nombre, idDireccion FROM sucursal WHERE sucursal.id LIKE '$idSucursal'";
  $query = $mysqli->query($cmd);

  if ($query->num_rows === 1) {
    $sucursal_datos = $query->fetch_array(MYSQLI_ASSOC);
  } else {
    /**No hay usuarios */
    header('Location:usuarios.php?error=2');
  }
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

  <title>Eliminar sucursal - Golden Rose</title>

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
          <h1 class="h3 mb-4 text-gray-800 text-center"><i class="fas fa-times"></i> Eliminar sucursal</h1>

          <form action="../scripts/eliminar_sucursal.php" method="post">
            <div class="alert alert-warning" role="alert">
              <h4 class="alert-heading"><i class="fas fa-exclamation-triangle"></i> ¿Deseas borrar esta sucursal?</h4>
              <p>
                la sucursal <strong><?=$sucursal_datos['nombre']?></strong>
                será borrada.  
              </p>
              <p>
                <span class="text-danger">Para que pueda ser borrada la sucursal no deberá estar nada registrado a esta sucursal.</span>
              </p>
              <div class="row d-flex justify-content-center">
                <div class="col-sm-1">
                  <span>ID de la sucursal:</span>
                </div>
                <div class="col-sm-2">
                  <input type="text" name="id" id="id" readonly value="<?=$idSucursal?>" class="form-control border-warning bg-light">
                </div>
              </div>
              <hr>
              <p class="mb-0">Presiona el botón "Aceptar" para dar de baja a este usuario o presiona "Cancelar" para volver al menú de usuarios.</p>
            </div>

            <div class="form-group">
              <div class="row text-center">
                <div class="col-sm-12">
                  <button type="submit" class="btn btn-lg golden-button-success">
                    <i class="fas fa-check"></i>
                    Aceptar
                  </button>
                  <a href="sucursal.php" class="btn btn-lg golden-button-danger">
                    <i class="fas fa-times"></i>
                    Cancelar
                  </a>
                </div>
              </div>
            </div>
          </form>

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

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="login.html">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

</body>

</html>
