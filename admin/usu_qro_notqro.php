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
          <h2 class="h3 mb-4 text-gray-800">USUARIOS DEL ESTADO DE QUERÉTARO DE LOS MUNICIPIOS QUE NO SON DEL MUNICIPIO QRO</h2>

          <div class="row pb-3 d-print-none">
            <div class="col-sm-3">
              <button onclick="window.print()" class="btn golden-button-primary btn-lg btn-block">
                <span class="icon text-white-50">
                  <i class="fas fa-print"></i>
                </span>
                <span class="text">Generar PDF</span>
              </button>
            </div>
            
          </div>

          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead class="golden-bg-secondary">
                <th>ID</th>
                <th>NOMBRE</th>
                <th>CALLE</th>
                <th>NUMERO</th>
                <th>COLONIA</th>
                <th>CODIGO POSTAL</th>
                <th>ENTIDAD</th>
              </thead>
              <tbody>
                <?php 
                $cmd = 'SELECT usuario.id, CONCAT(nombre1, " ", nombre2, " ", apellidopaterno, " ", apellidoMaterno) AS Nombre, 
                direccion.calle, CONCAT(numeroExterior, " ", numeroInterior) AS Numero,
                direccion.colonia, direccion.codigoPostal, CONCAT(municipio.nombre, ", ", estado.nombre) AS Entidad
                FROM direccion 
                INNER JOIN usuario ON (usuario.id = direccion.idUsuario)
                INNER JOIN municipio ON (municipio.id = direccion.idMunicipio)
                INNER JOIN estado ON (estado.id = municipio.idEstado)
                WHERE idUsuario IN (
                SELECT idUsuario
                FROM direccion
                WHERE idUsuario NOT LIKE ""
                ) AND
                estado.nombre LIKE "queretaro" AND
                municipio.nombre NOT LIKE "queretaro"';

                $query = $mysqli->query($cmd);

                if ($query->num_rows > 0):
                  while($row = $query->fetch_array(MYSQLI_ASSOC)):?>
                    <tr>
                     <td><?=$row['id']?></td>
                     <td><?=$row['Nombre']?></td>
                     <td><?=$row['calle']?></td>
                     <td><?=$row['Numero']?></td>
                     <td><?=$row['colonia']?></td>
                     <td><?=$row['codigoPostal']?></td>
                     <td><?=$row['Entidad']?></td>
                   </tr>
                 <?php endwhile; ?>
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

</body>

</html>
