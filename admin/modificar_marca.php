<?php

session_start();

if (!isset($_SESSION['id']) || $_SESSION['tipoUsuario'] === 'cliente') {
  header('Location:../login.php');
}

$marca_datos = NULL;

if (!isset($_GET['id'])) {
  /**No llegó una variable*/
  header('Location:marca.php?error=1');
} else {
  require('../scripts/db_connection.php');

  $id_marca = $_GET['id'];

  $cmd = "SELECT id, nombre, estado
  FROM marca 
  WHERE marca.id = '$id_marca'";

  $query = $mysqli->query($cmd);

  if ($query->num_rows === 1) {
    $marca_datos = $query->fetch_array(MYSQLI_ASSOC);
  } else {
    /**No hay usuarios */
    header('Location:marca.php?mensajeModificarSucursal=2');
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

  <title>Modificar sucursal - Golden Rose</title>

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
          <h1 class="h3 mb-4 text-gray-800 text-center"><i class="fas fa-copyright"></i> Modificar marca</h1>
          
          <?php if(isset( $_GET['mensajeModificar'])) : ?>
            <?php switch ( $_GET['mensajeModificar'] ) : case 2: ?>
              <div class="alert alert-danger alert-dismissible fade show mt-4" role="alert">
                <strong><i class="fas fa-times-circle"></i> La marca no pudo ser modificada.</strong> <br/>
                <span>Verifique los datos.</span> 
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <?php break;?>
              <?php default: ?>
              <div class="alert alert-danger alert-dismissible fade show mt-4" role="alert">
                <strong><i class="fas fa-times-circle"></i> La marca no pudo ser modificada.</strong> <br/>
                <span>Ocurrió un error, contacte al administrador.</span>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div> 
              <?php break; endswitch; ?>
            <?php endif; ?>



            <form action="../scripts/modificar_marca.php" method="post" class="pt-4">
              <div class="form-group">
                <div class="row">
                  <div class="col-sm-1"><label for="id">ID. de la marca</label></div>
                  <div class="col-sm-2">
                    <input type="text" name="id" id="id" value="<?=$marca_datos['id']?>" class="form-control" readonly>
                  </div>
                </div>
              </div>

              
              <h4 class="h4 mb-4 text-gray-800">Datos de la marca</h4>
              <div class="row">
                <div class="col-sm-3">
                  <div class="form-group">
                    <label for="nombre">*Nombre de la marca</label>
                    <input type="text" name="nombre" id="nombre" class="form-control" value="<?=$marca_datos['nombre']?>" maxlength="20" required >
                  </div>
                </div>
                <div class="col-sm-3">
                  <div class="form-group">
                    <label for="estatus">*Estado por defecto</label>
                    <select name="estatus" id="estatus" class="form-control" required>
                      <option selected value="activo" <?=$marca_datos['estado'] == 'activo' ? 'selected="selected"' : NULL ?>>Activo</option>
                      <option value="inactivo" <?=$marca_datos['estado'] == 'inactivo' ? 'selected="selected"' : NULL ?>>Inactivo</option>
                    </select>
                  </div>
                </div>
              </div>



              <div class="form-group text-center pt-3">
                <button type="submit" class="btn btn-lg golden-button-primary">
                  <i class="fas fa-check"></i>
                  Guardar cambios
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
          window.location.href = 'marca.php';
        }
      }
    </script>

  </body>

  </html>
