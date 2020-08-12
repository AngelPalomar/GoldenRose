<?php

session_start();

if (!isset($_SESSION['id']) || $_SESSION['tipoUsuario'] === 'cliente') {
  header('Location:../login.php');
}

if (!isset($_GET['idVenta'])) {
    header('Location:ventas.php');
} else {
    $idVenta = $_GET['idVenta'];
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

    <title>Detalle de venta - Golden Rose</title>

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

                    <h3>Detalle de venta</h3>
                    <span>ID de venta: <?=$idVenta?></span>

                    <?php if(!isset ($_GET['buscar'])) :?>

                    <div class="table-responsive mt-4" style="text-align:center">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead class="golden-bg-secondary">
                                <th>ID</th>
                                <th>ID VENTA</th>
                                <th>ID INVENTARIO</th>
                                <th>ID USUARIO</th>
                                <th>PRODUCTO</th>
                                <th>PRECIO UNITARIO</th>
                                <th>PRODUCTOS</th>
                                <th>SUBTOTAL</th>
                            </thead>
                            <tbody>
                                <?php 
                                
      $cmd = "SELECT detalle_venta.id AS ID,
      idVenta AS VENTA,
      idInventario AS INVENTARIO,
      idUsuario AS USUARIO,
      producto.nombre AS PRODUCTO,
      precioProducto AS PRECIO,
      detalle_venta.cantidad AS CANTIDAD,
      subtotal AS SUBTOTAL
      from detalle_venta
      INNER JOIN inventario ON (detalle_venta.idInventario = inventario.id)
      INNER JOIN producto ON (inventario.idProducto = producto.id)
      WHERE idVenta = '$idVenta'
      ORDER BY id DESC";

      $query = $mysqli->query($cmd);

      if ($query->num_rows > 0):
        while($row = $query->fetch_array(MYSQLI_ASSOC)):?>
                                <tr>
                                    <td><?=$row['ID']?></td>
                                    <td><?=$row['VENTA']?></td>
                                    <td><?=$row['INVENTARIO']?> </td>
                                     <td><?=$row['PRODUCTO']?> </td>
                                    <td><?=$row['USUARIO']?> </td>
                                    <td><?=$row['PRECIO']?> </td>
                                    <td><?=$row['CANTIDAD']?> </td>
                                    <td><?=$row['SUBTOTAL']?> </td>
                                </tr>
                                <?php endwhile; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="text-center mt-4 d-print-none">
                        <button class="btn golden-button-info btn-lg px-4" onclick="window.print()">
                            <span class="icon text-white-50">
                                <i class="fas fa-print"></i>
                            </span>
                            <span class="text">Generar PDF</span>
                        </button>
                    </div>
                    <?php endif;?>


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