<?php

session_start();
require('scripts/db_connection.php');

if (isset($_GET['idVenta'])) {
    $idVenta = $_GET['idVenta'];

    $venta = "SELECT * FROM venta WHERE id = '$idVenta'";
    $query = $mysqli->query($venta);

    if ($query->num_rows > 0) {
        $datosVenta = $query->fetch_array(MYSQLI_ASSOC);
        $_SESSION['carrito'] = NULL;
    }
} else {
    header('Location:index.php');
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Compra completada</title>
    <meta content="" name="descriptison">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

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
                    <h2>Resumen de compra</h2>                   
                </div>

            </div>
        </section><!-- End Breadcrumbs -->

        <section class="inner-page">
            <div class="container">               
                <div class="form-group mb-5">
                    <h3 class="text-center">Gracias por comprar en Golden Rose</h3>
                    <div class="form-group text-center">
                        <a href="index.php" class="btn golden-button-info px-3">
                            Ir a la tienda
                            <i class="fas fa-chevron-right"></i>
                        </a>
                        <a href="mis_compras.php" class="btn golden-button-info px-3">
                            Ver mis compras
                            <i class="fas fa-chevron-right"></i>
                        </a>
                    </div>
                    <h5 class="g-text-primary mt-3">
                        ID de la venta: <span class="g-summary"><?=$datosVenta['id']?></span>
                    </h5>
                    <h5 class="g-text-primary">
                        Fecha: 
                        <span class="g-summary"><?=$datosVenta['fecha']?></span>
                    </h5>
                    <h3 class="g-text-primary mt-4">
                        Monto total: <span class="g-mount">$ <?=number_format($datosVenta['monto'], 2, '.',',')?></span>
                    </h3>
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