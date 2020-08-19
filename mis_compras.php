<?php

session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Mis compras</title>
    <meta content="" name="descriptison">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/icofont/icofont.min.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets/vendor/venobox/venobox.css" rel="stylesheet">
    <link href="assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">

    <link href="admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/golden_rose.css">

    <!-- =======================================================
  * Template Name: Bethany - v2.1.0
  * Template URL: https://bootstrapmade.com/bethany-free-onepage-bootstrap-theme/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>
    <?php require('header.php') ?>
    <main id="main">

        <!-- ======= Breadcrumbs ======= -->
        <section class="breadcrumbs">
            <div class="container">

                <div class="d-flex justify-content-between align-items-center">
                    <h2>Mis compras</h2>
                    
                </div>

            </div>
        </section><!-- End Breadcrumbs -->

        <section class="inner-page">
            <div class="container">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <?php
                        $idUser = $_SESSION['id'];
                        $cmd = "SELECT venta.id AS ID,
                                        fecha AS FECHA,
                                        monto AS MONTO,
                                        folioFactura AS FOLIOFACTURA,
                                        fechaFactura AS FECHAFACTURA
                                        from venta
                                        INNER JOIN detalle_venta ON (venta.id=detalle_venta.idVenta)
                                        INNER JOIN usuario ON (usuario.id=detalle_venta.idUsuario)
                                        WHERE usuario.id = '$idUser'
                                        GROUP BY venta.id
                                        ORDER BY id DESC";

                        $query = $mysqli->query($cmd);

                        if ($query->num_rows > 0) : ?>
                            <thead class="golden-bg-secondary">
                                <th>ID</th>
                                <th>FECHA</th>
                                <th>MONTO</th>
                                <th>FOLIO DE FACTURA</th>
                                <th>FECHA DE FACTURA</th>
                                <th class="d-print-none">ACCIONES</th>
                            </thead>
                            <tbody>
                                <?php while ($row = $query->fetch_array(MYSQLI_ASSOC)) : ?>
                                    <tr>
                                        <td><?= $row['ID'] ?></td>
                                        <td><?= $row['FECHA'] ?></td>
                                        <td>$ <?= $row['MONTO'] ?> </td>
                                        <td><?= $row['FOLIOFACTURA'] !== "" ? $row['FOLIOFACTURA'] : "Sin factura."; ?></td>
                                        <td><?= empty($row['FECHAFACTURA']) ? "Sin fecha de factura." : $row['FECHAFACTURA']; ?>
                                        </td>
                                        <td class="d-print-none">
                                            <div class="">
                                                <a href="detalle_venta.php?idVenta=<?= $row['ID'] ?>" class="btn golden-button-info btn-block">
                                                    <span class="icon text-white-50">
                                                        <i class="fas fa-scroll"></i>
                                                    </span>
                                                    <span class="text">Ver detalle de compra</span>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>

                            <?php else : ?>
                                <div class="text-center mt-5">
                                    <h2>
                                        <i class="fas fa-times"></i>
                                        No se encontraron compras.
                                    </h2>
                                </div>
                            <?php endif; ?>
                            </tbody>
                    </table>
                </div>
            </div>
        </section>

    </main><!-- End #main -->

    <?php require('footer.php') ?>

    <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

    <!-- Vendor JS Files -->
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/jquery.easing/jquery.easing.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>
    <script src="assets/vendor/waypoints/jquery.waypoints.min.js"></script>
    <script src="assets/vendor/counterup/counterup.min.js"></script>
    <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="assets/vendor/venobox/venobox.min.js"></script>
    <script src="assets/vendor/owl.carousel/owl.carousel.min.js"></script>
    <script src="assets/vendor/aos/aos.js"></script>

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>

</body>

</html>