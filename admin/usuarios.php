<?php

session_start();

if (!isset($_SESSION['id']) || $_SESSION['tipoUsuario'] === 'cliente' || $_SESSION['tipoUsuario'] === 'empleado') {
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

  <title>Usuarios - Golden Rose</title>

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
          <h1 class="h3 mb-4 text-gray-800 text-center"><i class="fas fa-user"></i> Usuarios</h1>

          <div class="row pb-3">
            <div class="col-sm-3">
              <a href="agregar_usuario.php" class="btn golden-button-primary btn-lg btn-block">
                  <span class="icon text-white-50">
                    <i class="fas fa-user-plus"></i>
                  </span>
                <span class="text">Agregar Usuario</span>
              </a>
            </div>
            <div class="col-sm-3">
              <a href="consultar_usuario.php" class="btn golden-button-primary btn-lg btn-block">
                  <span class="icon text-white-50">
                    <i class="fas fa-search"></i>
                  </span>
                <span class="text">Buscar Usuario</span>
              </a>
            </div>
          </div>
          
          <span>Usuarios registrados en el sistema</span>

          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead class="golden-bg-secondary">
                <th>ID</th>
                <th>EMAIL</th>
                <th>NOMBRE</th>
                <th>TIPO USUARIO</th>
                <th>ESTADO ACTUAL</th>
                <th>FECHA DE REGISTRO</th>
                <th>DIRECCION</th>
                <th>ACCIONES</th>
              </thead>
              <tbody>
                <?php 
                $cmd = 'SELECT usuario.id AS ID,
                usuario.email AS EMAIL,
                CONCAT(usuario.nombre1, " ", usuario.nombre2, " ", usuario.apellidoPaterno, " ", usuario.apellidoMaterno) AS NOMBRE,
                (
                  CASE
                    WHEN tipoUsuario LIKE "admin" THEN "Administrador"
                    WHEN tipoUsuario LIKE "empleado" THEN "Empleado"
                    WHEN tipoUsuario LIKE "cliente" THEN "Cliente"
                  END
                ) AS "TIPO USUARIO",
                (
                  CASE
                    WHEN estado LIKE "activo" THEN "Activo"
                    WHEN estado LIKE "inactivo" THEN "Inactivo"
                  END
                ) AS "ESTADO ACTUAL",
                usuario.fechaRegisro AS "FECHA DE REGISTRO",
                CONCAT(calle, " No. ", numeroExterior, " ", numeroInterior, " ", colonia, " ", codigoPostal, " ", municipio.nombre, ", ", estado.nombre) AS DIRECCION
                FROM usuario 
                INNER JOIN direccion ON (usuario.id=direccion.idUsuario)
                INNER JOIN municipio ON (direccion.idMunicipio=municipio.id)
                INNER JOIN estado ON (municipio.idEstado=estado.id)
                ORDER BY usuario.id DESC';

                $query = $mysqli->query($cmd);
                
                if ($query->num_rows > 0):
                  while($row = $query->fetch_array(MYSQLI_ASSOC)):?>
                  <tr>
                    <td><?=$row['ID']?></td>
                    <td><?=$row['EMAIL']?></td>
                    <td><?=$row['NOMBRE']?></td>
                    <td><?=$row['TIPO USUARIO']?></td>
                    <td><?=$row['ESTADO ACTUAL']?></td>
                    <td><?=$row['FECHA DE REGISTRO']?></td>
                    <td><?=$row['DIRECCION']?></td>
                    <td>
                      <div class="d-flex flex-row">
                        <div class="col-sm-6"> 
                          <a href="modificar_usuario.php?id=<?=$row['ID']?>" class="btn golden-button-success"> 
                            <i class="fas fa-pen"></i>
                          </a>
                        </div>
                        <div class="col-sm-6">
                          <a href="eliminar_usuario.php?id=<?=$row['ID']?>" class="btn golden-button-danger"> 
                            <i class="fas fa-times"></i>
                          </a>
                        </div>
                      </div>
                    </td>
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
