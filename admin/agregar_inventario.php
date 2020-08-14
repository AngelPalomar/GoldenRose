<?php

session_start();

if (!isset($_SESSION['id']) || $_SESSION['tipoUsuario'] === 'cliente') {
    header('Location:../login.php');
}

require('../scripts/db_connection.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Agregar inventario - Golden Rose</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../assets/css/golden_rose.css" rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <?php require('menu_admin.php') ?>
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php require('header.php') ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800 text-center"><i class="fas fa-box"></i> Agregar inventario</h1>

                    <?php if (isset($_GET['mensajeAgregarInventario'])) : ?>
                    <?php switch ($_GET['mensajeAgregarInventario']):
                            case 2: ?>
                    <div class="alert alert-danger alert-dismissible fade show mt-4" role="alert">
                        <strong><i class="fas fa-times-circle"></i> El inventario no pudo ser agregado.</strong> <br />
                        <span>Verifique los datos.</span>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?php break; ?>
                    <?php
                            case 3: ?>
                    <div class="alert alert-danger alert-dismissible fade show mt-4" role="alert">
                        <strong><i class="fas fa-times-circle"></i> El inventario no pudo ser agregado.</strong> <br />
                        <span>Ocurrió un error, contacte al administrador.</span>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?php break;
                        endswitch; ?>
                    <?php endif; ?>

                    <div>
                        <form action="../scripts/agregar_inventario.php" enctype="multipart/form-data" method="post">
                            <div class="form-group">
                                <h4 class="h4 text-gray-800">Datos del inventario</h4>
                                <h6 class="h6 mb-4 text-gray-800 font-weight-bold">*Si el inventario ingresado ya
                                    existe, la cantidad ingresada se sumará al existente.</h6>
                                <div class="row">
                                    <div class="col-sm-4 form-group">
                                        <label for="Producto">*Producto</label>
                                        <select name="producto" id="producto" class="form-control" required>
                                            <option hidden selected value="">Seleccione una producto</option>
                                            <?php
                                            $cmd = "SELECT producto.id AS IDP, producto.nombre AS PROC FROM producto
                                            INNER JOIN categoria ON (producto.idCategoria=categoria.id)
                                            INNER JOIN marca ON (producto.idMarca=marca.id)
                                            WHERE producto.estado = 'disponible'
                                            AND categoria.estado = 'activo'
                                            AND marca.estado = 'activo'";

                                            $query = $mysqli->query($cmd);

                                            if ($query->num_rows > 0) :
                                                while ($row = $query->fetch_array(MYSQLI_ASSOC)) :
                                            ?>
                                            <option value="<?= $row['IDP'] ?>"><?= $row['PROC'] ?></option>
                                            <?php
                                                endwhile;
                                            endif;
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-sm-4 form-group">
                                        <label for="Sucursal">*Sucursal</label>
                                        <select name="sucursal" id="sucursal" class="form-control" required>
                                            <option hidden selected value="">Seleccione una sucursal</option>
                                            <?php
                                            $cmd = "SELECT * FROM sucursal WHERE estado = 'activo'";
                                            $query = $mysqli->query($cmd);

                                            if ($query->num_rows > 0) :
                                                while ($row = $query->fetch_array(MYSQLI_ASSOC)) :
                                            ?>
                                            <option value="<?= $row['id'] ?>"><?= $row['nombre'] ?></option>
                                            <?php
                                                endwhile;
                                            endif;
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-sm-4 form-group">
                                        <label for="id">*cantidad</label>
                                        <input type="number" name="cantidad" id="cantidad" class="form-control"
                                            maxlength='25' required='required'>
                                    </div>
                                </div>
                                <div class="form-group text-center">
                                    <button type="submit" class="btn golden-button-primary btn-lg">
                                        <i class="fas fa-upload"></i>
                                        Subir el producto al inventario
                                    </button>
                                    <button type="button" class="btn golden-button-danger btn-lg" onclick="regresar();">
                                        <i class="fas fa-times"></i>
                                        Cancelar
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2020</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>

<script>
function regresar() {
    if (confirm("¿Realmente quiere salir de esta sección?\nNo se guardarán los cambios.")) {
        window.location.href = 'inventario.php';
    }
}
</script>