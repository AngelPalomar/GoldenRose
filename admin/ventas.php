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

    <title>Ventas - Golden Rose</title>

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
                    <h1 class="h3 mb-4 text-gray-800 text-center"><i class="fas fa-money-check"></i> Ventas</h1>

                    <div class="row pb-3 d-print-none">
                        <div class="col-sm-6">
                            <form action="ventas.php" method="get">
                                <div class="input-group">
                                    <input type="text" name="buscar" class="form-control"
                                        placeholder="Buscar en esta lista">
                                    <div class="input-group-append">
                                        <button class="btn golden-button-primary" type="submit">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="col-sm-3">
                            <form action="ventas.php" method="get">
                                <div class="input-group">

                                    <input type="date" name="buscarFecha" class="form-control">
                                    <div class="input-group-append">
                                        <button class="btn golden-button-primary" type="submit">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </div>

                                </div>
                            </form>
                        </div>

                        <div class="col-sm-3">
                            <button class="btn btn-block golden-button-primary" onclick="window.print()">
                                <i class="fas fa-print"></i>
                                Generar reporte
                            </button>
                        </div>
                    </div>

                    <span>Listado de ventas</span>

                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <?php
                                    $cmd = "SELECT id AS ID,
                                        fecha AS FECHA,
                                        monto AS MONTO,
                                        folioFactura AS FOLIOFACTURA,
                                        fechaFactura AS FECHAFACTURA
                                        from venta
                                        ORDER BY id DESC";

                                    if (isset($_GET['buscar'])) {
                                        $buscar = $_GET['buscar'];

                                        $cmd = "SELECT id AS ID,
                                        fecha AS FECHA,
                                        monto AS MONTO,
                                        folioFactura AS FOLIOFACTURA,
                                        fechaFactura AS FECHAFACTURA
                                        from venta
                                        WHERE id = '$buscar'
                                        ORDER BY id ASC";
                                    }

                                    if (isset($_GET['buscarFecha'])) {
                                        $buscarFecha = $_GET['buscarFecha'];

                                        $cmd = "SELECT id AS ID,
                                        fecha AS FECHA,
                                        monto AS MONTO,
                                        folioFactura AS FOLIOFACTURA,
                                        fechaFactura AS FECHAFACTURA
                                        from venta
                                        WHERE fecha = '$buscarFecha'
                                        ORDER BY id ASC";
                                    }

                            $query = $mysqli->query($cmd);

                            if ($query->num_rows > 0): ?>
                            <thead class="golden-bg-secondary">
                                <th>ID</th>
                                <th>FECHA</th>
                                <th>MONTO</th>
                                <th>FOLIO DE FACTURA</th>
                                <th>FECHA DE FACTURA</th>
                                <th class="d-print-none">ACCIONES</th>
                            </thead>
                            <tbody>
                                <?php while($row = $query->fetch_array(MYSQLI_ASSOC)):?>
                                <tr>
                                    <td><?= $row['ID'] ?></td>
                                    <td><?= $row['FECHA'] ?></td>
                                    <td>$ <?= $row['MONTO'] ?> </td>
                                    <td><?= $row['FOLIOFACTURA'] !== "" ? $row['FOLIOFACTURA'] : "Sin factura."; ?></td>
                                    <td><?= empty($row['FECHAFACTURA']) ? "Sin fecha de factura." : $row['FECHAFACTURA']; ?></td>
                                    <td class="d-print-none">
                                        <div class="">
                                            <a href="detalle_venta.php?idVenta=<?= $row['ID'] ?>"
                                                class="btn golden-button-info btn-block">
                                                <span class="icon text-white-50">
                                                    <i class="fas fa-scroll"></i>
                                                </span>
                                                <span class="text">Ver detalle de venta</span>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <?php endwhile; ?>

                                <?php else: ?>
                                <div class="text-center mt-5">
                                    <h2>
                                        <i class="fas fa-times"></i>
                                        No se encontraron ventas.
                                    </h2>
                                </div>
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