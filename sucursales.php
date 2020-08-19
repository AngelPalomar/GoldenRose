<?php

session_start();

require('scripts/db_connection.php');

$cmd1 = "SELECT
CONCAT(calle, ' No. ', numeroExterior, ' ' , numeroInterior, ' ', colonia, ' ', 
codigoPostal, ' ', municipio.nombre, ', ', estado.nombre) AS DIRECCION
FROM direccion 
INNER JOIN sucursal ON (direccion.id=sucursal.idDireccion)
INNER JOIN municipio ON (direccion.idMunicipio=municipio.id)
INNER JOIN estado ON (municipio.idEstado=estado.id)
WHERE municipio.nombre like 'queretaro'";

$cmd2 = "SELECT
CONCAT(calle, ' No. ', numeroExterior, ' ' , numeroInterior, ' ', colonia, ' ', 
codigoPostal, ' ', municipio.nombre, ', ', estado.nombre) AS DIRECCION
FROM direccion 
INNER JOIN sucursal ON (direccion.id=sucursal.idDireccion)
INNER JOIN municipio ON (direccion.idMunicipio=municipio.id)
INNER JOIN estado ON (municipio.idEstado=estado.id)
WHERE municipio.nombre like 'corregidora'";

$cmd3 = "SELECT
CONCAT(calle, ' No. ', numeroExterior, ' ' , numeroInterior, ' ', colonia, ' ', 
codigoPostal, ' ', municipio.nombre, ', ', estado.nombre) AS DIRECCION
FROM direccion 
INNER JOIN sucursal ON (direccion.id=sucursal.idDireccion)
INNER JOIN municipio ON (direccion.idMunicipio=municipio.id)
INNER JOIN estado ON (municipio.idEstado=estado.id)
WHERE municipio.nombre like 'el marques'";

$query1 = $mysqli->query($cmd1);
$query2 = $mysqli->query($cmd2);
$query3 = $mysqli->query($cmd3);

if ($query1->num_rows > 0) {
    $datos_sucursal1 = $query1->fetch_array(MYSQLI_ASSOC);
}
if ($query2->num_rows > 0) {
    $datos_sucursal2 = $query2->fetch_array(MYSQLI_ASSOC);
}
if ($query3->num_rows > 0) {
    $datos_sucursal3 = $query3->fetch_array(MYSQLI_ASSOC);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Sucursales - Golden Rose</title>
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
                    <h2>Nuestras sucursales</h2>
                </div>

            </div>
        </section><!-- End Breadcrumbs -->

        <section class="inner-page">
            <div class="container">
                <div class="my-3">
                    <h2><i class="fas fa-store"></i> Sucursal Golden Rose Querétaro Centro</h2>
                    <span class="focus"><?=$datos_sucursal1['DIRECCION']?></span>
                    <br/>
                    <br/>
                    <div class="row">
                        <div class="col-sm-12">
                            <iframe width="100%" height="270px" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=100%25&amp;height=600&amp;hl=es&amp;q=Calle%20Fray%20F.%20Galindo%2022,%20zona%20dos%20extendida,%20Aragon,%20Santiago%20de%20Quer%C3%A9taro,%20Qro.+(Golden%20Rose%20Qro%20Centro)&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed">
                            </iframe>
                        </div>
                    </div>
                </div>
                <div class="my-3">
                    <h2><i class="fas fa-store"></i> Sucursal Golden Rose Querétaro Corregidora</h2>
                    <span class="focus"><?=$datos_sucursal2['DIRECCION']?></span>
                    <br/>
                    <br/>
                    <div class="row">
                        <div class="col-sm-12">
                            <iframe width="100%" height="270px" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=100%25&amp;height=600&amp;hl=es&amp;q=K.m.%208,%20Balvanera,%20El%20Pueblito,%20Qro.+(Golden%20Rose%20Qro%20El-Pueblito)&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed">
                            </iframe>
                        </div>
                    </div>
                </div>
                <div class="my-3">
                    <h2><i class="fas fa-store"></i> Sucursal Golden Rose El Marqués Querétaro</h2>
                    <span class="focus"><?=$datos_sucursal3['DIRECCION']?></span>
                    <br/>
                    <br/>
                    <div class="row">
                        <div class="col-sm-12">
                            <iframe width="100%" height="270px" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=100%25&amp;height=600&amp;hl=es&amp;q=Anillo%20Vial%20III%203%20Poniente,%20Los%20H%C3%A9roes%20Quer%C3%A9taro,%20Quer%C3%A9taro+(Golden%20Rose%20Qro%20Marques)&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed">
                            </iframe>
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