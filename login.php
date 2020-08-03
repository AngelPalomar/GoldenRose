<?php

session_start();
if (isset($_SESSION['id'])) {
    switch ($_SESSION['tipoUsuario']) {
        case 'admin':
            header('Location:admin/index.php');
            break;
        case 'empleado':
            header('Location:admin/index.php');
            break;
        case 'cliente':
            header('Location:home.php');
            break;
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />

  <title>Iniciar Sesión</title>
  <meta content="" name="descriptison" />
  <meta content="" name="keywords" />

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon" />
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon" />

  <!-- Google Fonts -->
  <link
    href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
    rel="stylesheet" />

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
  <link href="assets/vendor/icofont/icofont.min.css" rel="stylesheet" />
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet" />
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet" />
  <link href="assets/vendor/venobox/venobox.css" rel="stylesheet" />
  <link href="assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet" />
  <link href="assets/vendor/aos/aos.css" rel="stylesheet" />

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet" />
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
          <h1 class="text-light">
            <a href="index.php"><span>Golden Rose</span></a>
          </h1>
          <!-- Uncomment below if you prefer to use an image logo -->
          <!-- <a href="index.html"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
        </div>

        <nav class="nav-menu d-none d-lg-block">
          <ul>
            <li><a href="index.php">Inicio</a></li>
            <li class="active"><a href="#">Iniciar sesión</a></li>
            <li><a href="register.php">Crear una cuenta</a></li>
          </ul>
        </nav>
        <!-- .nav-menu -->
      </div>
      <!-- End Header Container -->
    </div>
  </header>
  <!-- End Header -->

  <main id="main">
    <!-- ======= Breadcrumbs ======= -->
    <section class="breadcrumbs">
      <div class="container pl-5 pr-5">
        <div class="text-center">
          <h2>Bienvenido a <i class="fas fa-leaf"></i> Golden Rose</h2>
        </div>
      </div>
    </section>
    <!-- End Breadcrumbs -->
  </main>
  <!-- End #main -->

  <section class="inner-page">
    <div class="container">

      <div class="text-center">
        <h2><i class="fas fa-sign-in-alt"></i> Iniciar sesión</h2>
        <p>
          Todos los datos son requeridos
        </p>
      </div>

      <!--Alertas-->
      <?php if(isset($_GET['error'])): ?>
        <?php switch($_GET['error']): case 1: ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <i class="fas fa-times-circle"></i>
          <strong>Ocurrió un error.</strong> <br />
          <span>Verifica que hayas llenado correctamente los datos requeridos</span>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <?php break; ?>
        <?php case 2: ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <i class="fas fa-user-times"></i>
          <strong>Esta cuenta no existe</strong> <br />
          <span>Si no tienes una cuenta, </span> <a href="register.php"><strong>¡Regístrate aquí!</strong></a>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <?php break; ?>
        <?php case 3: ?>
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
          <i class="fas fa-key"></i>
          <strong>Correo electrónico o contraseña incorrectos</strong> <br />
          <span>Por favor, verifica tus credenciales</span>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <?php break; ?>
        <?php case 4: ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <i class="fas fa-user-slash"></i>
          <strong>Esta cuenta está inactiva</strong> <br />
          <span>Por favor, contacte a un administrador.</span>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <?php break; ?>
        <?php endswitch; ?>
      <?php endif; ?>

      <?php if(isset( $_GET['mensajeRegister'])) : ?>
          <?php switch ( $_GET['mensajeRegister'] ) : case 1: ?>
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong><i class="fas fa-check-circle"></i> Cuenta creada con éxito.</strong> <br/>
                <span>Inicia sesión para empezar a comprar.</span> 
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
          <?php break; endswitch; ?>
        <?php endif; ?>

      <form action="scripts/login.php" method="POST" class="mt-5">
        <div class="row">
            <div class="col-sm-2"></div>
            <div class="col-sm-8">
              <div class="form-group row">
                <label for="email" class="col-sm-3 col-form-label">Correo electrónico</label>
                <div class="col-sm-9">
                  <input type="email" name="email" id="email" class="form-control"
                    placeholder="Tu dirección de correo electrónico" required autofocus />
                </div>
              </div>
              <div class="form-group row">
                <label for="password" class="col-sm-3 col-form-label">Contraseña</label>
                <div class="col-sm-9">
                  <input type="password" name="password" id="password" class="form-control" placeholder="Tu contraseña"
                    required autofocus />
                </div>
              </div>
            </div>
            <div class="col-sm-2"></div>
        </div>
        <div class="text-center">
          <a href="register.php">¿No tienes una cuenta? ¡Regístrate ahora!</a>
        </div>

        <div class="form-group text-center mt-5">
          <button type="reset" class="btn btn-lg golden-button-secondary">
            <i class="fas fa-undo-alt"></i>
            Restablecer
          </button>
          <button type="submit" class="btn btn-lg golden-button-primary">
            <i class="fas fa-sign-in-alt"></i>
            Ingresar
          </button>
        </div>

      </form>
    </div>
  </section>

  <!-- ======= Footer ======= -->
  <?php require('footer.php') ?>
  <!-- End Footer -->

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