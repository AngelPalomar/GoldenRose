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
          <h2>Bienvenido a <i class="fas fa-leaf"></i> Golden Rose</h2>
        </div>
      </div>
    </section>

    <section class="inner-page">
      <div class="container pl-5 pr-5">

        <div class="text-center">
          <h2><i class="fas fa-user-edit"></i> Crear una cuenta</h2>
          <p>
            <span class="golden-text-primary">Ingresar la información correspondiente</span>
          </p>
        </div>

        <!--Mensaje de error-->
        <?php if(isset( $_GET['mensajeAltaCliente'])) : ?>
          <?php switch ( $_GET['mensajeAltaCliente'] ) : case 2: ?>
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
              <div class="col-xl-3">
                <div class="form-group">
                  <label for="nombre1">*Primer nombre</label>
                  <input type="text" name="nombre1" id="nombre1" class="form-control" placeholder="Juan"
                    required>
                </div>
              </div>
              <div class="col-xl-3">
                <div class="form-group">
                  <label for="nombre2">Segundo nombre</label>
                  <input type="text" name="nombre2" id="nombre2" class="form-control">
                </div>
              </div>
              <div class="col-xl-3">
                <div class="form-group">
                  <label for="apellido2">*Primer apellido</label>
                  <input type="text" name="apellido1" id="apellido1" class="form-control" placeholder="Pérez"
                    required>
                </div>
              </div>
              <div class="col-xl-3">
                <div class="form-group">
                  <label for="apellido2">Segundo apellido</label>
                  <input type="text" name="apellido2" id="apellido2"
                    class="form-control">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-xl-8">
                <div class="form-group">
                  <label for="email">*Dirección de correo electrónico</label>
                  <input type="email" name="email" id="email" placeholder="ejemplo@email.com"
                    class="form-control" required>
                </div>
              </div>
              <div class="col-xl-4">
                <div class="form-group">
                  <label for="pass">*Contraseña</label>
                  <input type="password" name="pass" id="pass"
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
                  <label for="calle">*Calle</label>
                  <input type="text" name="calle" id="calle" class="form-control" required>
                </div>
              </div>
              <div class="col-xl-2">
                <div class="form-group">
                  <label for="numeroExterior">*No. exterior</label>
                  <input type="text" name="numeroExterior" id="numeroExterior" placeholder="#"
                    class="form-control" required>
                </div>
              </div>
              <div class="col-xl-2">
                <div class="form-group">
                  <label for="numeroInterior">No. interior</label>
                  <input type="text" name="numeroInterior" id="numeroInterior"
                    class="form-control">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-xl-3">
                <div class="form-group">
                  <label for="colonia">*Colonia</label>
                  <input type="text" name="colonia" id="colonia" class="form-control">
                </div>
              </div>
              <div class="col-xl-3">
                <div class="form-group">
                  <label for="codigoPostal">*Código postal</label>
                  <input type="text" name="codigoPostal" id="codigoPostal" class="form-control">
                </div>
              </div>
              <div class="col-sm-3">
                <div class="form-group">
                  <label for="edo">*Estado</label>
                  <select name="edo" id="edo" class="form-control" required>
                  <option hidden selected value="">Seleccione un estado</option>
                    <?php 
                    $cmd = "SELECT * FROM estado";
                    $query = $mysqli->query($cmd);
                    
                    if ($query->num_rows > 0):
                      while($row = $query->fetch_array(MYSQLI_ASSOC)) :
                  ?>
                    <option value="<?=$row['id']?>"><?=$row['nombre']?></option>
                    <?php 
                    endwhile;
                    endif; 
                  ?>
                  </select>
                </div>
              </div>  
              <div class="col-sm-3">
                <div class="form-group">
                  <label for='mun'>*Municipio</label>
                  <select class="form-control" id="mun" name="mun" required> </select>
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

<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
    crossorigin="anonymous">
</script>

<script type="text/javascript">
  $(document).ready(function () {
    recargarLista();

    $('#edo').change(function () {
      recargarLista();
    });
  });
</script>

<script type="text/javascript">
  function recargarLista() {
    $.ajax({
      type: "POST",
      url: "scripts/municipios.php",
      data: "estado=" + $('#edo').val(),
      success: function (response) {
        $('#mun').html(response);
      }
    });
  } 
</script>