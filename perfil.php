<?php

session_start();

if (!isset($_SESSION['id'])) {
    header('Location:login.php');
}

require('scripts/db_connection.php');

$id_usuario = $_SESSION['id'];
$cmd = "SELECT usuario.id, email, nombre1, nombre2, apellidoPaterno, apellidoMaterno, password, tipoUsuario, usuario.estado, idSucursal, 
  calle, numeroExterior, numeroInterior, colonia, codigoPostal, municipio.nombre AS nombreMunicipio, estado.nombre AS nombreEstado
  FROM usuario 
  INNER JOIN direccion ON (usuario.id=direccion.idUsuario) 
  INNER JOIN municipio ON (direccion.idMunicipio=municipio.id)
  INNER JOIN estado ON (municipio.idEstado=estado.id)
  WHERE usuario.id = '$id_usuario'";

$query = $mysqli->query($cmd);

if ($query->num_rows === 1) {
    $usuario_datos = $query->fetch_array(MYSQLI_ASSOC);
} else {
    /**No hay usuarios */
    header('Location:usuarios.php?mensajeModificarUsuario=2');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title><?= $_SESSION['nombre1'] . " " . $_SESSION['apellidoPaterno'] ?> - Mi perfil</title>
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
                    <h2>Mi perfil</h2>
                </div>

            </div>
        </section><!-- End Breadcrumbs -->

        <section class="inner-page">
            <div class="container">
                <?php if (isset($_GET['mensajeModificar'])) : ?>
                    <?php switch ($_GET['mensajeModificar']):
                        case 1: ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong><i class="fas fa-check-circle"></i> Usuario modificado con éxito.</strong> <br />
                                <span>Verifique los resultados.</span>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                    <?php break;
                    endswitch; ?>
                <?php endif; ?>
                <?php if (isset($_GET['mensajeModificar'])) : ?>
                    <?php switch ($_GET['mensajeModificar']):
                        case 2: ?>
                            <div class="alert alert-danger alert-dismissible fade show mt-4" role="alert">
                                <strong><i class="fas fa-times-circle"></i> El usuario no pudo ser modificado.</strong> <br />
                                <span>Verifique que los datos del domicilio sean correctos.</span>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <?php break; ?>
                        <?php
                        case 3: ?>
                            <div class="alert alert-danger alert-dismissible fade show mt-4" role="alert">
                                <strong><i class="fas fa-times-circle"></i> El usuario no pudo ser modificado.</strong> <br />
                                <span>Verifique que los datos del usuario sean correctos.</span>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <?php break; ?>
                        <?php
                        case 4: ?>
                            <div class="alert alert-danger alert-dismissible fade show mt-4" role="alert">
                                <strong><i class="fas fa-times-circle"></i> El usuario no pudo ser modificado.</strong> <br />
                                <span>La nueva contraseña no puede ser igual a la anterior.</span>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                    <?php break;
                    endswitch; ?>
                <?php endif; ?>
                <div class="text-center">
                    <h1><i class="fas fa-user-circle fa-lg"></i></h1>
                    <h1><?= $_SESSION['nombre1'] . " " . $_SESSION['apellidoPaterno'] ?></h1>
                    <span><?= $_SESSION['email'] ?></span>
                </div>
                <form action="modificar_perfil.php" method="post" class="pt-4">

                    <input type="hidden" name="id" id="id" value="<?= $usuario_datos['id'] ?>" class="form-control">

                    <h4 class="h4 mb-4 text-gray-800">Datos personales</h4>
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="nom1">*Primer nombre</label>
                                <input type="text" name="nom1" id="nom1" class="form-control" value="<?= $usuario_datos['nombre1'] ?>" required>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="nom2">Segundo nombre</label>
                                <input type="text" name="nom2" id="nom2" class="form-control" value="<?= $usuario_datos['nombre2'] ?>">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="ap">*Apellido paterno</label>
                                <input type="text" name="ap" id="ap" class="form-control" value="<?= $usuario_datos['apellidoPaterno'] ?>" required>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="am">Apellido materno</label>
                                <input type="text" name="am" id="am" class="form-control" value="<?= $usuario_datos['apellidoMaterno'] ?>">
                            </div>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="email">*Correo electrónico</label>
                                <input type="email" name="email" id="email" class="form-control" value="<?= $usuario_datos['email'] ?>" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="pass">*Contraseña</label>
                                <input type="password" name="pass" id="pass" class="form-control" value="<?= $usuario_datos['password'] ?>" required>
                            </div>
                        </div>
                    </div>

                    <h4 class="h4 mb-4 text-gray-800">Domicilio</h4>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="calle">*Calle</label>
                                <input type="text" name="calle" id="calle" class="form-control" value="<?= $usuario_datos['calle'] ?>" required>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="nE">*No. exterior</label>
                                <input type="text" name="nE" id="nE" class="form-control" value="<?= $usuario_datos['numeroExterior'] ?>" required>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="nI">*No. interior</label>
                                <input type="text" name="nI" id="nI" class="form-control" value="<?= $usuario_datos['numeroInterior'] ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="col">*Colonia</label>
                                <input type="text" name="col" id="col" class="form-control" value="<?= $usuario_datos['colonia'] ?>" required>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="cp">*Código postal</label>
                                <input type="text" name="cp" id="cp" class="form-control" value="<?= $usuario_datos['codigoPostal'] ?>" required>
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

                                    if ($query->num_rows > 0) :
                                        while ($row = $query->fetch_array(MYSQLI_ASSOC)) : ?>
                                            <option value="<?= $row['id'] ?>" <?= $usuario_datos['nombreEstado'] == $row['nombre'] ? 'selected="selected"' : NULL ?>>
                                                <?= $row['nombre'] ?></option>
                                    <?php
                                        endwhile;
                                    endif; ?>
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

                    <div id="suc"></div>

                    <div class="form-group text-center pt-3">
                        <button type="submit" class="btn btn-lg golden-button-primary">
                            <i class="fas fa-user-check"></i>
                            Guardar cambios
                        </button>
                        <button type="button" class="btn btn-danger btn-lg" onclick="regresar();">
                            <i class="fas fa-times"></i>
                            Cancelar
                        </button>
                    </div>
                </form>
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
    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script>
        function regresar() {
            window.location.href = 'index.php';
        }
    </script>
</body>

</html>

<script type="text/javascript">
    $(document).ready(function() {
        recargarLista();

        $('#edo').change(function() {
            recargarLista();
        });
    });
</script>

<script type="text/javascript">
    function recargarLista() {
        $.ajax({
            type: "POST",
            url: "scripts/municipiosSel.php",
            data: "estado=" + $('#edo').val(),
            success: function(response) {
                $('#mun').html(response);
            }
        });
    }
</script>