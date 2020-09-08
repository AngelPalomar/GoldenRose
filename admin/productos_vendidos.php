<?php

session_start();

if (!isset($_SESSION['id']) || $_SESSION['tipoUsuario'] === 'cliente') {
    header('Location:../login.php');
}

require('../scripts/db_connection.php');

$cmd = "SELECT producto.nombre as nombre, COUNT(idProducto) as vendidos
FROM detalle_venta
INNER JOIN inventario ON (inventario.id=detalle_venta.idInventario)
INNER JOIN producto ON (producto.id=inventario.idProducto)
GROUP BY idProducto
ORDER BY COUNT(idProducto) DESC";

$query = $mysqli->query($cmd);

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Productos más vendidos</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../assets/css/golden_rose.css" rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>

    <style>
        #container {
            height: 400px;
        }

        .highcharts-figure,
        .highcharts-data-table table {
            min-width: 310px;
            max-width: 800px;
            margin: 1em auto;
        }

        .highcharts-data-table table {
            font-family: Verdana, sans-serif;
            border-collapse: collapse;
            border: 1px solid #EBEBEB;
            margin: 10px auto;
            text-align: center;
            width: 100%;
            max-width: 500px;
        }

        .highcharts-data-table caption {
            padding: 1em 0;
            font-size: 1.2em;
            color: #555;
        }

        .highcharts-data-table th {
            font-weight: 600;
            padding: 0.5em;
        }

        .highcharts-data-table td,
        .highcharts-data-table th,
        .highcharts-data-table caption {
            padding: 0.5em;
        }

        .highcharts-data-table thead tr,
        .highcharts-data-table tr:nth-child(even) {
            background: #f8f8f8;
        }

        .highcharts-data-table tr:hover {
            background: #f1f7ff;
        }
    </style>
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
                    <h1 class="h3 mb-4 text-gray-800">Top <?=isset($_GET['top']) ? $_GET['top'] : '10'?> productos más vendidos</h1>

                    <form action="productos_vendidos.php" method="get" class="d-print-none">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="input-group">
                                    <input type="number" name="top" class="form-control" placeholder="Ingresar cantidad de productos mostrados">
                                    <div class="input-group-append">
                                        <button class="btn golden-button-primary" type="submit">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </form>

                    <figure class="highcharts-figure">
                        <div id="container"></div>
                    </figure>

                    <div class="text-center d-print-none">
                        <button class="btn golden-button-primary" onclick="window.print()">
                            <i class="fas fa-print"></i>
                            Generar PDF
                        </button>
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

    <script>
        Highcharts.chart('container', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Top <?=isset($_GET['top']) ? $_GET['top'] : '10'?> productos más vendidos'
            },
            subtitle: {
                text: 'Fuente: Comic Sans'
            },
            xAxis: {
                type: 'category',
                labels: {
                    rotation: -45,
                    style: {
                        fontSize: '13px',
                        fontFamily: 'Verdana, sans-serif'
                    }
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Cantidad vendida'
                }
            },
            legend: {
                enabled: false
            },
            tooltip: {
                pointFormat: 'Vendidos: <b>{point.y:.0f} artículos</b>'
            },
            series: [{
                name: 'Population',
                data: [
                    <?php
                    if ($query->num_rows > 0) {

                        if (isset($_GET['top'])) {
                            $top = $_GET['top'];
                        } else {
                            $top = 10;
                        }

                        $i = 0;

                        while ($procs = $query->fetch_array(MYSQLI_ASSOC)) {
                            echo "['" . $procs['nombre'] . "', " . $procs['vendidos'] . "], ";
                            $i += 1;

                            if ($i >= $top) {
                                break;
                            }
                        }
                    }
                    ?>
                    //['Shanghai', 24.2],
                ],
                dataLabels: {
                    enabled: true,
                    rotation: -90,
                    color: '#FFFFFF',
                    align: 'right',
                    format: '{point.y:.0f}', // one decimal
                    y: 10, // 10 pixels down from the top
                    style: {
                        fontSize: '12px',
                        fontFamily: 'Verdana, sans-serif'
                    }
                }
            }]
        });
    </script>

</body>

</html>