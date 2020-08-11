<?php

session_start();
require('scripts/db_connection.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Mi carrito</title>
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
</head>

<body>
    <?php require('header.php') ?>
    <main id="main">

        <!-- ======= Breadcrumbs ======= -->
        <section class="breadcrumbs">
            <div class="container">
                <div class="d-flex justify-content-between align-items-center">
                    <h2>Mi carrito</h2>
                </div>
            </div>
        </section><!-- End Breadcrumbs -->

        <section class="inner-page">
            <div class="container">
                <?php if(isset( $_GET['mensajeCarrito'])) : ?>
                <?php switch ( $_GET['mensajeCarrito'] ) : case 1: ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong><i class="fas fa-check-circle"></i> Producto agregado al carrito.</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php break;?>
                <?php case 2: ?>
                <div class="alert alert-info alert-dismissible fade show" role="alert">
                    <strong><i class="fas fa-check-circle"></i> Cantidades modificadas correctamente.</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php break; endswitch; ?>
                <?php endif; ?>

                <!--Si hay carrito-->
                <?php if(isset($_SESSION['carrito'])): ?>
                <!--Formulario para actualizar las cantidades-->
                <form action="carrito.php" method="GET">
                    <input type="hidden" name="accion" id="accion" value="actualizar">
                    <!--Acciones-->
                    <div class="row mb-2">
                        <div class="col-xl-3 form-group">
                            <button type="submit" class="btn btn-block golden-button-success">
                                <i class="fas fa-save"></i>
                                Guardar cambios
                            </button>
                        </div>
                        <div class="col-xl-3 form-group">
                            <a href="carrito.php?accion=vaciar" class="btn btn-block golden-button-danger">
                                <i class="fas fa-trash"></i>
                                Vaciar carrito
                            </a>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead class="golden-bg-primary">
                                        <th class="text-center"><i class="fas fa-ellipsis-h"></i></th>
                                        <th><i class="fas fa-box"></i> NOMBRE DEL PRODUCTO</th>
                                        <th><i class="fas fa-images"></i> IMAGEN</th>
                                        <th><i class="fas fa-dollar-sign"></i> PRECIO</th>
                                        <th>CANTIDAD</th>
                                        <th><i class="fas fa-dollar-sign"></i> SUBTOTAL</th>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        $subTotalProducto = 0;
                                        $subTotal = 0;
                                        $montoTotal = 0;
                                        foreach ($_SESSION['carrito'] as $carritoActual): ?>
                                        <tr>
                                            <td class="text-center">
                                                <a href="carrito.php?accion=eliminar&id=<?=$carritoActual['ID']?>"
                                                    class="btn golden-button-danger">
                                                    <i class="fas fa-times"></i>
                                                </a>
                                            </td>
                                            <td><?=$carritoActual['NOMBRE_PROC']?></td>
                                            <td>
                                                <img src="imagenes_productos/<?=$carritoActual['IMAGEN']?>" alt=""
                                                    class="img-cart-product rounded mx-auto d-block">
                                            </td>
                                            <td>$ <?=number_format($carritoActual['PRECIO'], 2, '.',',')?></td>
                                            <td>
                                                <input type="number" name="cantidad[]"
                                                    value='<?=$carritoActual['CANTIDAD']?>'
                                                    class="form-control input-quantity-cart" max="99" min="1">
                                            </td>
                                            <td class="font-weight-bold">
                                                <?php $subTotalProducto = $carritoActual['PRECIO'] * $carritoActual['CANTIDAD']?>
                                                $ <?=number_format($subTotalProducto, 2, '.',',')?>
                                            </td>
                                        </tr>
                                        <?php 
                                        $subTotal += $subTotalProducto;
                                        $montoTotal = $subTotal * 1.16;
                                        endforeach; 
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </form>

                <div class="form-group mb-5">
                    <h3>Resumen</h3>
                    <h5 class="g-text-primary">
                        Subtotal: <span class="g-summary">$ <?=number_format($subTotal, 2, '.',',')?></span>
                    </h5>
                    <h5 class="g-text-primary">
                        IVA: <i class="fas fa-plus fa-sm g-text-success"></i>
                        <span class="g-summary">$ <?=number_format($subTotal * 0.16, 2, '.',',')?></span>
                    </h5>
                    <h3 class="g-text-primary mt-4 text-center">
                        Monto total: <span class="g-mount">$ <?=number_format($montoTotal, 2, '.',',')?></span>
                    </h3>
                </div>

                <?php if (!isset($_SESSION['id'])): ?>
                <div class="text-center mb-3">
                    <a href="login.php" class="btn golden-button-primary btn-lg">
                        <i class="fas fa-sign-in-alt"></i>
                        Inicia sesión para seguir con la compra
                    </a>
                </div>
                <div class="text-center">
                    <span>Si no tienes una cuenta, </span> <a href="register.php"><strong>¡Regístrate aquí!</strong></a>
                </div>
                <?php else: ?>
                <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" class="row text-center">
                    <div class="col-sm-12">
                        <input type="hidden" name="cmd" value="_xclick">
                        <!-- En esta campo va el correo con el que generaste tu cuenta -->
                        <input type="hidden" name="business" value="cruzangelp@gmail.com">

                        <!-- Este es el nombre del elemento que se compró -->
                        <input type="hidden" name="item_name" value='Compra en Golden Rose - Jardinería y más'>

                        <!-- En este campo se agrega el total a pagar en paypal -->
                        <input type="hidden" name="amount" value="<?=((float) $montoTotal)?>">

                        <input type="hidden" name="no_shipping" value="0">
                        <input type="hidden" name="no_note" value="1">

                        <!-- Indicamos el pago en pesos mexicanos -->
                        <input type="hidden" name="currency_code" value="MXN">
                        <input type="hidden" name="lc" value="MX">
                        <input type="hidden" name="bn" value="PP-BuyNowBF">

                        <!-- Indicamos a donde debe regresar la petición en caso de finalizar la compra -->
                        <input type="hidden" name="return"
                            value="http://localhost/GoldenRose/scripts/pago_terminado.php">
                        <button type="submit" class="btn btn-lg golden-button-info px-5">
                            <i class="fab fa-paypal"></i> Finalizar compra
                            <br />
                            <small>Pago en PayPal &copy;</small>
                        </button>
                    </div>
                </form>
                <?php endif; ?>
                <?php else: ?>
                <div class="text-center">
                    <h1>¡El carrito está vacío!</h1>
                    <h1><i class="fas fa-surprise"></i></h2>
                        <a href="index.php" class="btn btn-lg golden-button-info h3 mt-5">
                            Seguir comprando
                            <i class="fas fa-chevron-right"></i>
                        </a>
                </div>
                <?php endif; ?>
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