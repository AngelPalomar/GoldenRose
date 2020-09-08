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

  <title>Panel de administración - Golden Rose</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../assets/css/golden_rose.css" rel="stylesheet">
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

  <script src="https://code.highcharts.com/highcharts.js"></script>
  <script src="https://code.highcharts.com/modules/data.js"></script>
  <script src="https://code.highcharts.com/modules/exporting.js"></script>
  <script src="https://code.highcharts.com/modules/accessibility.js"></script>
  <style type="text/css">
    #container {
      height: 400px;
    }

    .highcharts-figure,
    .highcharts-data-table table {
      min-width: 310px;
      max-width: 800px;
      margin: 1em auto;
    }

    #datatable {
      font-family: Verdana, sans-serif;
      border-collapse: collapse;
      border: 1px solid #EBEBEB;
      margin: 10px auto;
      text-align: center;
      width: 100%;
      max-width: 500px;
    }

    #datatable caption {
      padding: 1em 0;
      font-size: 1.2em;
      color: #555;
    }

    #datatable th {
      font-weight: 600;
      padding: 0.5em;
    }

    #datatable td,
    #datatable th,
    #datatable caption {
      padding: 0.5em;
    }

    #datatable thead tr,
    #datatable tr:nth-child(even) {
      background: #f8f8f8;
    }

    #datatable tr:hover {
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
          <h2 class="h3 mb-4 text-gray-800 text-center">USUARIOS ACTIVOS E INACTIVOS</h2>

          <h1 class="h3 mb-4 text-gray-800">USUARIOS ACTIVOS</h1>

          <div class="table-responsive d-print-none">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead class="golden-bg-secondary">
                <th>EMAIL</th>
                <th>NOMBRE</th>
                <th>ESTATUS</th>
              </thead>
              <tbody>
                <?php
                $cmd = 'SELECT email,
                CONCAT(nombre1, " ", nombre2, " ", apellidopaterno, " ", apellidoMaterno) AS nombre,
                estado 
                FROM usuario 
                WHERE estado like "activo"';

                $query = $mysqli->query($cmd);

                if ($query->num_rows > 0) :
                  while ($row = $query->fetch_array(MYSQLI_ASSOC)) : ?>
                    <tr>
                      <td><?= $row['email'] ?></td>
                      <td><?= $row['nombre'] ?></td>
                      <td><?= $row['estado'] ?></td>
                    </tr>
                  <?php endwhile; ?>
                <?php endif; ?>
              </tbody>
            </table>
          </div>

          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead class="golden-bg-secondary">
                <th class="text-center">TOTAL</th>
              </thead>
              <tbody>
                <?php
                $activos = 'SELECT count(*) as activos
                from (select estado 
                from usuario 
                where estado like "activo")as activos;';

                $query2 = $mysqli->query($activos);

                if ($query2->num_rows > 0) :
                  while ($row1 = $query2->fetch_array(MYSQLI_ASSOC)) : ?>
                    <tr>
                      <td class="text-center"><?= $row1['activos'] ?></td>
                    </tr>
                  <?php endwhile; ?>
                <?php endif; ?>
              </tbody>
            </table>
          </div>


          <h1 class="h3 mb-4 text-gray-800">USUARIOS INACTIVOS</h1>

          <div class="table-responsive d-print-none">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead class="golden-bg-secondary">
                <th>EMAIL</th>
                <th>NOMBRE</th>
                <th>ESTATUS</th>
              </thead>
              <tbody>
                <?php
                $cmd2 = 'SELECT email,
                CONCAT(nombre1, " ", nombre2, " ", apellidopaterno, " ", apellidoMaterno) AS nombre,
                estado 
                FROM usuario 
                WHERE estado like "inactivo"';

                $query3 = $mysqli->query($cmd2);

                if ($query3->num_rows > 0) :
                  while ($row = $query3->fetch_array(MYSQLI_ASSOC)) : ?>
                    <tr>
                      <td><?= $row['email'] ?></td>
                      <td><?= $row['nombre'] ?></td>
                      <td><?= $row['estado'] ?></td>
                    </tr>
                  <?php endwhile; ?>
                <?php endif; ?>
              </tbody>
            </table>
          </div>

          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead class="golden-bg-secondary">
                <th class="text-center">TOTAL</th>
              </thead>
              <tbody>
                <?php
                $inactivos = 'SELECT count(*) as inactivos
                from (select estado 
                from usuario 
                where estado like "inactivo")as inactivos;';

                $query2 = $mysqli->query($inactivos);

                if ($query2->num_rows > 0) :
                  while ($row2 = $query2->fetch_array(MYSQLI_ASSOC)) : ?>
                    <tr>
                      <td class="text-center"><?= $row2['inactivos'] ?></td>
                    </tr>
                  <?php endwhile; ?>
                <?php endif; ?>
              </tbody>
            </table>
          </div>


          <div class="col-sm-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title text-center">USUARIOS ACTIVOS E INACTIVOS</h3>
              </div>
              <div class="card-body">
                <figure class="highcharts-figure">
                  <div id="container"></div>
                  <p class="highcharts-description text-center">
                    comparación de la cantidad de usarios activos y usarios inactivos
                  </p>

                  <table id="datatable">
                    <thead>
                      <tr>
                        <th></th>
                        <th>ACTIVOS</th>
                        <th>INACTIVOS</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <th>USUARIOS</th>
                        <?php
                        $activos = 'SELECT count(*) as activos
                        from (select estado 
                        from usuario 
                        where estado like "activo")as activos;';

                        $query2 = $mysqli->query($activos);

                        if ($query2->num_rows > 0) :
                          while ($row1 = $query2->fetch_array(MYSQLI_ASSOC)) : ?>

                            <td><?= $row1['activos'] ?></td>
                          <?php endwhile; ?>
                        <?php endif; ?>

                        <?php $inactivos = 'SELECT count(*) as inactivos
                        from (select estado 
                        from usuario 
                        where estado like "inactivo")as inactivos;';
                        $query2 = $mysqli->query($inactivos);
                        if ($query2->num_rows > 0) :
                          while ($row2 = $query2->fetch_array(MYSQLI_ASSOC)) : ?>
                            <td>
                              <?= $row2['inactivos'] ?>
                            </td>
                          <?php endwhile; ?>
                        <?php endif; ?>
                      </tr>
                    </tbody>
                  </table>
                </figure>
              </div>
            </div>
          </div>

          <div class="my-5 text-center d-print-none">
            <button onclick="window.print()" class="btn golden-button-primary">
              <span class="icon text-white-50">
                <i class="fas fa-print"></i>
              </span>
              <span class="text">Generar PDF</span>
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
            <span>Copyright &copy; Golden Rose - Jardinería 2020</span>
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
      data: {
        table: 'datatable'
      },
      chart: {
        type: 'column'
      },
      title: {
        text: 'Cantidad de usuarios activos inactivos'
      },
      yAxis: {
        allowDecimals: false,
        title: {
          text: 'Units'
        }
      },
      tooltip: {
        formatter: function() {
          return '<b>' + this.series.name + '</b><br/>' +
            this.point.y + ' ' + this.point.name.toLowerCase();
        }
      }
    });
  </script>

</body>

</html>