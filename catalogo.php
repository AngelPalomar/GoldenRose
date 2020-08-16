<?php

session_start();
require('scripts/db_connection.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Catálogo - Golden Rose</title>
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
                    <h2>Catálogo - Golden Rose</h2>
                    
                </div>

            </div>
        </section><!-- End Breadcrumbs -->

        <section class="inner-page">
            <div class="container">
                <section id="cta" class="cta">
                    <div class="container">
                        <div class="text-center" data-aos="zoom-in">
                            <h3>Catálogo</h3>
                            <p>Ve todos nuestros prodcutos en un solo lugar</p>
                        </div>
                    </div>
                </section><!-- End cactus Section -->

                <div class="mt-4 mb-4">
                    <div class="row">
                        <?php
                        
                        $producto = "SELECT idProducto AS ID, producto.nombre AS nombreProducto, producto.pathImagen AS imagen,
                        producto.precio AS precio, categoria.nombre AS CATEGORIA, marca.nombre AS MARCA, 
                        MAX(cantidad) AS EXISTENCIAS
                        FROM inventario
                        INNER JOIN producto ON (producto.id = inventario.idProducto)
                        INNER JOIN categoria ON (producto.idCategoria = categoria.id)
                        INNER JOIN marca ON (producto.idMarca = marca.id)
                        AND producto.estado = 'disponible'
                        AND categoria.estado = 'activo'
                        AND marca.estado = 'activo'
                        AND cantidad > 0
                        GROUP BY idProducto";
                        $query = $mysqli->query($producto);

                        if($query->num_rows > 0):
                        while ($row = $query->fetch_array(MYSQLI_ASSOC)):
                        ?>
                        <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-12 mb-4">
                            <a href="producto.php?id=<?=$row['ID']?>">
                                <div class="card">
                                    <div class="d-flex justify-content-center">
                                        <img src="imagenes_productos/<?=$row['imagen']?>" alt="imagen_proc"
                                            class="rounded img-product">
                                    </div>
                                    <div class="card-body">
                                        <span class="g-title"><?=$row['nombreProducto']?></span>
                                        <br />
                                        <span clasS="g-price">$ <?=$row['precio']?></span>
                                        <a href="carrito.php?accion=agregar&id=<?=$row['ID']?>&cantidad=1"
                                            class="mt-3 btn golden-button-info btn-block">
                                            <i class="fas fa-cart-plus"></i> Añadir al carrito
                                        </a>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <?php endwhile; ?>
                        <?php endif; ?>
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