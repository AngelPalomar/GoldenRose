<?php

session_start();

if (!isset($_SESSION['id']) || $_SESSION['tipoUsuario'] === 'cliente') {
  header('Location:../login.php');
}

require('../scripts/db_connection.php');

if (isset($_GET['id'])) {
  $idInventario = $_GET['id'];
  $cmd = "SELECT inventario.id AS ID, producto.nombre AS PRODUCTO, 
  sucursal.nombre AS SUCURSAL, inventario.cantidad AS CANTIDAD
  FROM inventario
  INNER JOIN producto ON (producto.id = inventario.idProducto) 
  INNER JOIN sucursal ON (sucursal.id = inventario.idSucursal)
  WHERE inventario.id = '$idInventario'";

  $query = $mysqli->query($cmd);

  if ($query->num_rows === 1) {
    $datosInventario = $query->fetch_array(MYSQLI_ASSOC);
  } else {
    /**No encontró producto */
    header('Location:productos.php?MensajeModificarInventario=2');
  }
  

} else {
  /**No hay id por GET */
  header('Location:productos.php?MensajeModificarInventario=2');
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

    <title>Eliminar inventario - Golden Rose</title>

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
                    <h1 class="h3 mb-4 text-gray-800 text-center"><i class="fas fa-box"></i> Eliminar inventario</h1>

                    <?php if(isset( $_GET['mensajeModificarInventario'])) : ?>
                    <?php switch ( $_GET['mensajeModificarInventario'] ) : case 2: ?>
                    <div class="alert alert-danger alert-dismissible fade show mt-4" role="alert">
                        <strong><i class="fas fa-times-circle"></i> El producto no pudo ser modificado en el
                            inventario.</strong> <br />
                        <span>Verifique los datos.</span>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?php break;?>
                    <?php case 3: ?>
                    <div class="alert alert-danger alert-dismissible fade show mt-4" role="alert">
                        <strong><i class="fas fa-times-circle"></i> El producto no pudo ser modificado en el
                            inventario.</strong> <br />
                        <span>Ocurrió un error, contacte al administrador.</span>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?php break; endswitch; ?>
                    <?php endif; ?>

                    <div>
                        <form action="../scripts/modificar_inventario.php" enctype="multipart/form-data" method="post">
                            <div class="form-group">
                                <h4 class="h4 mb-4 text-gray-800">Datos del producto en el inventario</h4>
                                <div class="row">
                                    <div class="col-sm-1 form-group">
                                        <label for="nombre">*ID</label>
                                        <input type="text" name="id" id="id" class="form-control" maxlength="25"
                                            required value="<?=$datosInventario['ID']?>" readonly>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="producto">*Producto</label>
                                        <select name="producto" id="producto" class="form-control" required readonly>
                                            <?php 
                                            $nombreProc = $datosInventario['PRODUCTO'];
                                              $cmd = "SELECT * FROM producto WHERE producto.nombre = '$nombreProc'";
                                              $query = $mysqli->query($cmd);
                                              
                                              if ($query->num_rows > 0):
                                                while($row = $query->fetch_array(MYSQLI_ASSOC)) : ?>

                                            <option value="<?=$row['id']?>"
                                                <?=$datosInventario['PRODUCTO'] === $row['nombre'] ? 'selected="selected"' : NULL?>>
                                                <?=$row['nombre']?>
                                            </option>
                                            <?php endwhile; endif; ?>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="sucursal">*Sucursal</label>
                                        <select name="sucursal" id="sucursal" class="form-control" required readonly>
                                            <option hidden selected value="">Seleccione una sucursal</option>
                                            <?php 
                                            $nombreSuc = $datosInventario['SUCURSAL'];
                                            
                                              $cmd = "SELECT * FROM sucursal WHERE sucursal.nombre = '$nombreSuc'";
                                              $query = $mysqli->query($cmd);
                                              
                                              if ($query->num_rows > 0):
                                                while($row = $query->fetch_array(MYSQLI_ASSOC)) :?>

                                            <option value="<?=$row['id']?>"
                                                <?=$datosInventario['SUCURSAL'] === $row['nombre'] ? 'selected="selected"' : NULL?>>
                                                <?=$row['nombre']?>
                                            </option>
                                            <?php endwhile; endif; ?>
                                        </select>
                                    </div>
                                    <div class="col-sm-3 form-group">
                                        <label for="cantidad">*Cantidad</label>
                                        <input type="number" name="cantidad" id="cantidad" class="form-control"
                                            maxlength="25" required value="0" readonly>
                                    </div>
                                </div>

                                <div class="alert alert-danger my-3 text-center">
                                    <span class="h1"><i class="fas fa-exclamation-triangle"></i></span>
                                    <br />
                                    <br />
                                    <span class="h5">Las existencias de <span
                                            class="font-weight-bold"><?=$datosInventario['PRODUCTO']?></span> de la
                                        sucursal
                                        <span class="font-weight-bold"><?=$datosInventario['SUCURSAL']?></span>
                                        serán cambiadas a 0 al eliminar este inventario.</span>
                                </div>

                                <div class="form-group text-center">
                                    <button type="submit" class="btn golden-button-primary btn-lg">
                                        <i class="fas fa-times"></i>
                                        Eliminar existencias
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
        window.location.href = 'inventario.php';
    }
}
</script>