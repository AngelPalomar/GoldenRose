<?php
/**Conexión a BD */
require('scripts/db_connection.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Registrarse</title>
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

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/golden_rose.css">

  <!--Font Awesome-->
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
    integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
		
  <!-- =======================================================
  * Template Name: Bethany - v2.1.0
  * Template URL: https://bootstrapmade.com/bethany-free-onepage-bootstrap-theme/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top d-flex align-items-center">
    <div class="container">
      <div class="header-container d-flex align-items-center">
        <div class="logo mr-auto">
          <h1 class="text-light"><a href="index.php"><span>Golden Rose</span></a></h1>
          <!-- Uncomment below if you prefer to use an image logo -->
          <!-- <a href="index.html"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
        </div>

        <nav class="nav-menu d-none d-lg-block">
          <ul>
            <li><a href="index.php">Inicio</a></li>
            <li><a href="login.php">Iniciar sesión</a></li>
            <li class="active"><a href="#">Crear una cuenta</a></li>
          </ul>
        </nav><!-- .nav-menu -->
      </div><!-- End Header Container -->
    </div>
  </header><!-- End Header -->

  <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section class="breadcrumbs">
      <div class="container">
        <div class="text-center">
          <h2>Bienvenido a Golden Rose</h2>
        </div>
      </div>
    </section>

    <section class="inner-page">
      <div class="container pl-5 pr-5">

        <div class="text-center">
          <h2>Crear una cuenta</h2>
          <p>
            <span class="golden-text-primary">Ingresar la información correspondiente</span>
          </p>
        </div>

        <!--Mensaje de error-->
        <?php if(isset( $_GET['mensaje'])) : ?>
          <?php switch ( $_GET['mensaje'] ) : case 2: ?>
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Ocurrió un error.</strong> <br/>
                <span>You should check in on some of those fields below.</span> 
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
          <?php break; endswitch; ?>
        <?php endif; ?>

        <form action="scripts/alta_cliente.php" method="post">
          <div class="mb-4">
            <h4>Datos personales</h4>
          </div>

          <div class="form-group">
            <div class="row">
              <div class="col-xl-6">
                <div class="form-group">
                  <input type="text" name="nombre1" id="nombre1" placeholder="*Primer nombre" class="form-control"
                    required>
                </div>
              </div>
              <div class="col-xl-6">
                <div class="form-group">
                  <input type="text" name="nombre2" id="nombre2" placeholder="Segundo nombre" class="form-control">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-xl-6">
                <div class="form-group">
                  <input type="text" name="apellido1" id="apellido1" placeholder="*Primer apellido" class="form-control"
                    required>
                </div>
              </div>
              <div class="col-xl-6">
                <div class="form-group">
                  <input type="text" name="apellido2" id="apellido2" placeholder="Segundo apellido"
                    class="form-control">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-xl-8">
                <div class="form-group">
                  <input type="email" name="email" id="email" placeholder="*Dirección de correo electrónico"
                    class="form-control" required>
                </div>
              </div>
              <div class="col-xl-4">
                <div class="form-group">
                  <input type="password" name="pass" id="pass" placeholder="*Contraseña"
                    class="form-control" required>
                </div>
              </div>
            </div>

          </div>
          <div class="mb-4">
            <h4>Domicilio</h4>
          </div>

          <div class="form-group">
            <div class="row">
              <div class="col-xl-8">
                <div class="form-group">
                  <input type="text" name="calle" id="calle" placeholder="*Calle" class="form-control" required>
                </div>
              </div>
              <div class="col-xl-2">
                <div class="form-group">
                  <input type="text" name="numeroExterior" id="numeroExterior" placeholder="*No. exterior"
                    class="form-control" required>
                </div>
              </div>
              <div class="col-xl-2">
                <div class="form-group">
                  <input type="text" name="numeroInterior" id="numeroInterior" placeholder="No. interior"
                    class="form-control">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-xl-6">
                <div class="form-group">
                  <input type="text" name="colonia" id="colonia" placeholder="*Colonia" class="form-control">
                </div>
              </div>
              <div class="col-xl-3">
                <div class="form-group">
                  <input type="text" name="codigoPostal" id="codigoPostal" placeholder="*CP" class="form-control">
                </div>
              </div>
              <div class="col-xl-3">
                <div class="form-group">
                  <input type="text" name="municipio" id="municipio" placeholder="*Municipio" class="form-control" value=<?php $municipio?>>
                </div>
              </div>
            </div>
            <div class="form-group text-center mt-5">
              <button type="reset" class="btn btn-lg golden-button-secondary">
                <i class="fas fa-undo-alt"></i>
                Restablecer
              </button>
              <button type="submit" class="btn btn-lg golden-button-success">
                <i class="fas fa-check"></i>
                Registrarse ahora
              </button>
            </div>
          </div>
        </form>
      </div>
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">

    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-3 col-md-6 footer-contact">
            <h3>Bethany</h3>
            <p>
              A108 Adam Street <br>
              New York, NY 535022<br>
              United States <br><br>
              <strong>Phone:</strong> +1 5589 55488 55<br>
              <strong>Email:</strong> info@example.com<br>
            </p>
          </div>

          <div class="col-lg-2 col-md-6 footer-links">
            <h4>Useful Links</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Home</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">About us</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Services</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Terms of service</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Privacy policy</a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Our Services</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Web Design</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Web Development</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Product Management</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Marketing</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Graphic Design</a></li>
            </ul>
          </div>

          <div class="col-lg-4 col-md-6 footer-newsletter">
            <h4>Join Our Newsletter</h4>
            <p>Tamen quem nulla quae legam multos aute sint culpa legam noster magna</p>
            <form action="" method="post">
              <input type="email" name="email"><input type="submit" value="Subscribe">
            </form>
          </div>

        </div>
      </div>
    </div>

    <div class="container d-md-flex py-4">

      <div class="mr-md-auto text-center text-md-left">
        <div class="copyright">
          &copy; Copyright <strong><span>Bethany</span></strong>. All Rights Reserved
        </div>
        <div class="credits">
          <!-- All the links in the footer should remain intact. -->
          <!-- You can delete the links only if you purchased the pro version. -->
          <!-- Licensing information: https://bootstrapmade.com/license/ -->
          <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/bethany-free-onepage-bootstrap-theme/ -->
          Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
        </div>
      </div>
      <div class="social-links text-center text-md-right pt-3 pt-md-0">
        <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
        <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
        <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
        <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
        <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
      </div>
    </div>
  </footer><!-- End Footer -->

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