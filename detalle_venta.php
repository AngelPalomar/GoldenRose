<?php

session_start();

if (!isset($_SESSION['id'])) {
    header('Location:login.php');
}

if (!isset($_GET['idVenta'])) {
    header('Location:ventas.php');
} else {
    $idVenta = $_GET['idVenta'];
}

require('scripts/db_connection.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Inner Page - Bethany Bootstrap Template</title>
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
                    <h2>Detalles</h2>
                    
                </div>

            </div>
        </section><!-- End Breadcrumbs -->

        <section class="inner-page">
            <div class="container">
                <h3>Detalle de compra</h3>
                <span>ID de venta: <?= $idVenta ?></span>

                <div class="table-responsive mt-4" style="text-align:center">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead class="golden-bg-secondary">
                            <th>PRODUCTO</th>
                            <th>PRECIO UNITARIO</th>
                            <th>CANTIDAD</th>
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

                            if ($query->num_rows > 0) :
                                while ($row = $query->fetch_array(MYSQLI_ASSOC)) : ?>
                                    <tr>
                                        <td><?= $row['PRODUCTO'] ?> </td>
                                        <td><?= $row['PRECIO'] ?> </td>
                                        <td><?= $row['CANTIDAD'] ?> </td>
                                        <td><?= $row['SUBTOTAL'] ?> </td>
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