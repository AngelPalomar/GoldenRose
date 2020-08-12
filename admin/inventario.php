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

    <title>Inventario - Golden Rose</title>

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
                    <h1 class="h3 mb-4 text-gray-800 text-center"><i class="fas fa-box"></i> Inventarios</h1>

                    <div class="row pb-3">
                        <div class="col-sm-3">
                            <a href="agregar_inventario.php" class="btn golden-button-primary btn-block">
                                <span class="icon text-white-50">
                                    <i class="fas fa-plus"></i>
                                </span>
                                <span class="text">Agregar inventario</span>
                            </a>
                        </div>
                        <div class="col-sm-9">
                            <form action="inventario.php" method="get">
                                <div class="input-group">
                                    <input type="text" name="buscar" class="form-control"
                                        placeholder="Buscar en esta lista">
                                    <div class="input-group-append">
                                        <button class="btn golden-button-primary" type="submit">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>


                    <?php if(isset( $_GET['mensajeAgregarInventario'])) : ?>
                    <?php switch ( $_GET['mensajeAgregarInventario'] ) : case 1: ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong><i class="fas fa-check-circle"></i> Inventario agregado con éxito.</strong> <br />
                        <span>Verifique los resultados.</span>
                        <?php if(isset($_GET['accion'])): ?>
                        <?php if($_GET['accion'] === "sumar"): ?>
                        <br /><br />
                        <span class="font-weight-bold"><i class="fas fa-exclamation-triangle"></i> La cantidad ingresada se ha sumado al inventario
                            correspondiente porque este ya existía.</span>
                        <?php endif;?>
                        <?php endif;?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?php break; endswitch; ?>
                    <?php endif; ?>

                    <?php if(isset( $_GET['mensajeModificarInventario'])) : ?>
                    <?php switch ( $_GET['mensajeModificarInventario'] ) : case 1: ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong><i class="fas fa-check-circle"></i> Inventario modificado con éxito.</strong> <br />
                        <span>Verifique los resultados.</span>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?php break; endswitch; ?>
                    <?php endif; ?>

                    <?php if(isset( $_GET['mensajeEliminarInventario'])) : ?>
                    <?php switch ( $_GET['mensajeEliminarInventario'] ) : case 1: ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong><i class="fas fa-check-circle"></i> Estatus del inventario cambiado con éxito.</strong>
                        <br />
                        <span>Verifique que el estado del usuario sea "inactivo".</span>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?php break; ?>
                    <?php case 2: ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong><i class="fas fa-times-circle"></i> El estatus del inventario no pudo ser
                            cambiado.</strong> <br />
                        <span>Contacte al administrador.</span>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?php break; endswitch; ?>
                    <?php endif; ?>

                    <span>Inventario</span>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <?php 
                            if (isset($_GET['buscar'])) {
                                $buscar = $_GET['buscar'];

                                $cmd = "SELECT inventario.id AS ID, producto.nombre AS PRODUCTO, 
                                sucursal.nombre AS SUCURSAL, inventario.cantidad AS CANTIDAD, producto.pathImagen AS IMAGEN
                                FROM inventario
                                INNER JOIN producto ON (producto.id = inventario.idProducto) 
                                INNER JOIN sucursal ON (sucursal.id = inventario.idSucursal)
                                WHERE inventario.id LIKE '%$buscar%' OR producto.nombre LIKE '%$buscar%'
                                OR sucursal.nombre LIKE '%$buscar%'
                                ORDER BY producto.nombre";

                            } else {
                                $cmd = "SELECT inventario.id AS ID, producto.nombre AS PRODUCTO, 
                                sucursal.nombre AS SUCURSAL, inventario.cantidad AS CANTIDAD, producto.pathImagen AS IMAGEN
                                FROM inventario
                                INNER JOIN producto ON (producto.id = inventario.idProducto) 
                                INNER JOIN sucursal ON (sucursal.id = inventario.idSucursal)
                                ORDER BY producto.nombre";
                            }

                $query = $mysqli->query($cmd);
                
                if ($query->num_rows > 0): ?>
                            <thead class="golden-bg-secondary">
                                <th>ID</th>
                                <th>PRODUCTO</th>
                                <th>IMAGEN</th>
                                <th>SUCURSAL</th>
                                <th>CANTIDAD</th>
                                <th>ACCIONES</th>
                            </thead>
                            <tbody>
                                <?php while($row = $query->fetch_array(MYSQLI_ASSOC)):?>
                                <tr>
                                    <td><?=$row['ID']?></td>
                                    <td><?=$row['PRODUCTO']?></td>
                                    <td>
                                        <img src="../imagenes_productos/<?=$row['IMAGEN']?>" alt="producto"
                                            width="40px">
                                    </td>
                                    <td><?=$row['SUCURSAL']?></td>
                                    <td class="font-weight-bold"><?=$row['CANTIDAD']?></td>
                                    <td>
                                        <div class="d-flex flex-row">
                                            <div class="col-sm-6">
                                                <a href="modificar_inventario.php?id=<?=$row['ID']?>"
                                                    class="btn golden-button-success">
                                                    <i class="fas fa-pen"></i>
                                                </a>
                                            </div>
                                            <div class="col-sm-6">
                                                <a href="eliminar_inventario.php?id=<?=$row['ID']?>"
                                                    class="btn golden-button-danger">
                                                    <i class="fas fa-times"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <?php endwhile; ?>
                                <?php else: ?>
                                <div class="text-center mt-5">
                                    <h2>
                                        <i class="fas fa-times"></i>
                                        No se encontró ningún inventario.
                                    </h2>
                                </div>
                                <?php endif; ?>
                            </tbody>
                        </table>
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