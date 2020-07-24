<?php

session_start();

if (!isset($_SESSION['id'])) {
  header('Location:../login.php');
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

  <title>SB Admin 2 - Blank</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/golden_admin.css" rel="stylesheet">
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
          <h1 class="h3 mb-4 text-gray-800 text-center">Agregar usuario</h1>
          <span class="focus">Llenar los campos correspondientes</span>
          <form action="" method="post" class="pt-4">
            <h4 class="h4 mb-4 text-gray-800">Datos personales</h4>
            <div class="row">
              <div class="col-sm-3">
                <div class="form-group">
                  <label for="nom1">*Primer nombre</label>
                  <input type="text" name="nom1" id="nom1" class="form-control" required>
                </div>
              </div>
              <div class="col-sm-3">
                <div class="form-group">
                <label for="nom2">Segundo nombre</label>
                  <input type="text" name="nom2" id="nom2" class="form-control">
                </div>
              </div>
              <div class="col-sm-3">
                <div class="form-group">
                <label for="ap">*Apellido paterno</label>
                  <input type="text" name="ap" id="ap" class="form-control" required>
                </div>
              </div>
              <div class="col-sm-3">
                <div class="form-group">
                <label for="am">Apellido materno</label>
                  <input type="text" name="am" id="am" class="form-control">
                </div>
              </div>
            </div>

            <div class="row form-group">
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="email">*Correo electrónico</label>
                  <input type="email" name="email" id="email" class="form-control" required>
                </div>
              </div>
              <div class="col-sm-3">
                <div class="form-group">
                  <label for="pass">*Contraseña</label>
                  <input type="password" name="pass" id="pass" class="form-control" required>
                </div>
              </div>
              <div class="col-sm-3">
                <div class="form-group">
                  <label for="tipo">*Tipo de usuario</label>
                  <select name="tipo" id="tipo" class="form-control" required>
                    <option selected value="cliente">Cliente</option>
                    <option value="empleado">Empleado</option>
                    <option value="admin">Administrador</option>
                  </select>
                </div>
              </div>
            </div>

            <h4 class="h4 mb-4 text-gray-800">Domicilio</h4>
            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="calle">*Calle</label>
                  <input type="text" name="calle" id="calle" class="form-control" required>
                </div>
              </div>
              <div class="col-sm-3">
                <div class="form-group">
                  <label for="nE">*No. exterior</label>
                  <input type="text" name="nE" id="nE" class="form-control" required>
                </div>
              </div>
              <div class="col-sm-3">
                <div class="form-group">
                  <label for="nI">*No. interior</label>
                  <input type="text" name="nI" id="nI" class="form-control" required>
                </div>
              </div>
            </div>
            <div class="row">
            <div class="col-sm-3">
                <div class="form-group">
                  <label for="col">*Colonia</label>
                  <input type="text" name="col" id="col" class="form-control" required>
                </div>
              </div>
              <div class="col-sm-3">
                <div class="form-group">
                  <label for="cp">*Código postal</label>
                  <input type="text" name="cp" id="cp" class="form-control" required>
                </div>
              </div>
              <div class="col-sm-3">
                <div class="form-group">
                  <label for="edo">*Estado</label>
                  <select name="edo" id="edo" class="form-control" required>

                  </select>
                </div>
              </div>
              <div class="col-sm-3">
                <div class="form-group">
                  <label for="mun">*Municipio</label>
                  <select name="mun" id="mun" class="form-control" required>

                  </select>
                </div>
              </div>
            </div>

            <div class="form-group text-center pt-3">
              <button type="submit" class="btn btn-lg golden-button-primary">
                <i class="fas fa-user-plus"></i>
                Añadir usuario
              </button>
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

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

</body>

</html>
