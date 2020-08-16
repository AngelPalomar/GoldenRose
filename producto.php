<?php

session_start();
require('scripts/db_connection.php');

if (isset($_GET['id'])) {
    $idProducto = $_GET['id'];

    $buscarProducto = "SELECT producto.id AS ID, producto.nombre AS nombreProducto, producto.precio,
    producto.descripcion AS descripcion, producto.descripcionAmpliada AS desc_amp,
    producto.pathImagen AS imagen, categoria.nombre AS categoria, marca.nombre AS marca
    FROM producto
    LEFT JOIN categoria ON (producto.idCategoria = categoria.id)
    LEFT JOIN marca ON (producto.idMarca = marca.id)
    WHERE producto.id = '$idProducto'";

    $query = $mysqli->query($buscarProducto);

    if ($query->num_rows === 1) {
        $datosProducto = $query->fetch_array(MYSQLI_ASSOC);
    } else {
        /**No se encontró producto */
        header('Location:index.php');
    }
    
    
} else {
    /**No llegó post */
    header('Location:index.php');
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title><?=$datosProducto['nombreProducto']?> - Golden Rose</title>
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
                    <h2>Detalles del producto</h2>
                </div>

            </div>
        </section><!-- End Breadcrumbs -->

        <section class="inner-page">
            <div class="container">
                <div class="card">
                    <div class="row">
                        <div class="col-sm-6">
                            <img src="imagenes_productos/<?=$datosProducto['imagen']?>" alt="imagen" class="img-fluid">
                        </div>
                        <div class="col-sm-6">
                            <div class="p-3">
                                <h2><?=$datosProducto['nombreProducto']?></h2>
                                <h3 class="g-text-primary">$ <?=$datosProducto['precio']?></h3>
                                <a href="carrito.php?accion=agregar&id=<?=$datosProducto['ID']?>&cantidad=1"
                                    class="my-4 p-2 btn golden-button-info btn-block">
                                    <span class="h5">
                                        <i class="fas fa-cart-plus"></i> Añadir al carrito
                                    </span>
                                </a>
                                <h5>Descripción</h5>
                                <p>
                                    <?=$datosProducto['descripcion']?>
                                </p>
                                <h5>Características</h5>
                                <p>
                                    <?=$datosProducto['desc_amp']?>
                                </p>
                                <h5>Categoría</h5>
                                <p>
                                    <?=$datosProducto['categoria']?>
                                </p>
                                <h5>Marca</h5>
                                <p>
                                    <?=$datosProducto['marca']?>
                                </p>              
                            </div>
                        </div>
                    </div>
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