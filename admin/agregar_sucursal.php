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

  <title>SB Admin 2 - Blank</title>

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
          <h1 class="h3 mb-4 text-gray-800 text-center"><i class="fas fa-store"></i> Agregar Sucursal</h1>

          <?php if(isset( $_GET['mensajeAgregar'])) : ?>
            <?php switch ( $_GET['mensajeAgregar'] ) : case 2: ?>
              <div class="alert alert-danger alert-dismissible fade show mt-4" role="alert">
                <strong><i class="fas fa-times-circle"></i> La sucursal no pudo ser agregada.</strong> <br/>
                <span>Verifique los datos.</span> 
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <?php break;?>
              <?php default: ?>
              <div class="alert alert-danger alert-dismissible fade show mt-4" role="alert">
                <strong><i class="fas fa-times-circle"></i> La sucursal no pudo ser agregada.</strong> <br/>
                <span>Ocurrió un error, contacte al administrador.</span> 
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div> 
              <?php break; endswitch; ?>
            <?php endif; ?>

            <span class="focus">Llenar los campos correspondientes</span>

            <form action="../scripts/agregar_sucursal.php" method="post" class="pt-4">
              <h4 class="h4 mb-4 text-gray-800">Direccion</h4>
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="calle">*Calle</label>
                    <input type="text" name="calle" id="calle" class="form-control" maxlength="25" required>
                  </div>
                </div>
                <div class="col-sm-3">
                  <div class="form-group">
                    <label for="nE">*No. exterior</label>
                    <input type="text" name="nE" id="nE" class="form-control" maxlength="10" required>
                  </div>
                </div>
                <div class="col-sm-3">
                  <div class="form-group">
                    <label for="nI">*No. interior</label>
                    <input type="text" name="nI" id="nI" class="form-control" maxlength="10">
                  </div>
                </div>
              </div>
              <div class="row form-group">
                <div class="col-sm-3">
                  <div class="form-group">
                    <label for="col">*Colonia</label>
                    <input type="text" name="col" id="col" class="form-control" maxlength="40" required>
                  </div>
                </div>
                <div class="col-sm-3">
                  <div class="form-group">
                    <label for="cp">*Código postal</label>
                    <input type="text" name="cp" id="cp" class="form-control" maxlength="10" required>
                  </div>
                </div>
                <div class="col-sm-3">
                  <div class="form-group">
                    <label for="edo">*Estado</label>
                    <select name="edo" id="edo" class="form-control" required>
                      <?php 
                      $cmd = "SELECT * FROM estado";
                      $query = $mysqli->query($cmd);

                      if ($query->num_rows > 0):
                        while($row = $query->fetch_array(MYSQLI_ASSOC)) :
                          ?>
                          <option value="<?=$row['id']?>"><?=$row['nombre']?></option>
                          <?php 
                        endwhile;
                      endif; 
                      ?>
                    </select>
                  </div>
                </div>  
                <div class="col-sm-3">
                  <div class="form-group">
                    <label for='mun'>*Municipio</label>
                    <select class="form-control" id="mun" name="mun" required> </select>
                  </div>
                </div>
              </div>

              <h4 class="h4 mb-4 text-gray-800">Datos de sucursal</h4>
              <div class="row">
                <div class="col-sm-3">
                  <div class="form-group">
                    <label for="nom1">*Nombre de la sucursal</label>
                    <input type="text" name="nom1" id="nom1" class="form-control" maxlength="20" required>
                  </div>
                </div>
              </div>

              <div id="suc"></div>

              <div class="form-group text-center pt-3">
                <button type="submit" class="btn btn-lg golden-button-primary">
                  <i class="fas fa-check"></i>
                  Añadir usuario  
                </button>
                <button type="button" class="btn golden-button-danger btn-lg" onclick="regresar();">
                  <i class="fas fa-times"></i>
                  Cancelar
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
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
    crossorigin="anonymous"></script>
    <script>
      function regresar() {
        if (confirm("¿Realmente quiere salir de esta sección?\nNo se guardarán los cambios.")) {
          window.location.href = 'sucursal.php';
        }
      }
    </script>

  </body>

  </html>

  <script type="text/javascript">
    $(document).ready(function () {
      recargarLista();

      $('#edo').change(function () {
        recargarLista();
      });
    });
  </script>

  <script type="text/javascript">
    function recargarLista() {
      $.ajax({
        type: "POST",
        url: "../scripts/municipios.php",
        data: "estado=" + $('#edo').val(),
        success: function (response) {
          $('#mun').html(response);
        }
      });
    } 
  </script>

  <script>
    $(document).ready(function () {
      mostrarSucursales();

      $('#tipo').change(function () {
        mostrarSucursales();
      });
    });
  </script>

  <script type="text/javascript">
    function mostrarSucursales() {
      $.ajax({
        type: "POST",
        url: "../scripts/mostrar_sucursales.php",
        data: "tipoUsuario=" + $('#tipo').val(),
        success: function (response) {
          $('#suc').html(response);
        }
      });
    }
  </script>
