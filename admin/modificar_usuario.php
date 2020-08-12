<?php

session_start();

if (!isset($_SESSION['id']) || $_SESSION['tipoUsuario'] === 'cliente') {
  header('Location:../login.php');
}

$usuario_datos = NULL;

if (!isset($_GET['id'])) {
  /**No llegó una variable*/
  header('Location:usuarios.php?error=1');
} else {
  require('../scripts/db_connection.php');

  $id_usuario = $_GET['id'];
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

}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Modificar usuario - Golden Rose</title>

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
                    <h1 class="h3 mb-4 text-gray-800 text-center"><i class="fas fa-user-plus"></i> Agregar usuario</h1>
                    <span class="focus">Llenar los campos correspondientes</span>
                    <?php if(isset( $_GET['mensajeModificar'])) : ?>
                    <?php switch ( $_GET['mensajeModificar'] ) : case 2: ?>
                    <div class="alert alert-danger alert-dismissible fade show mt-4" role="alert">
                        <strong><i class="fas fa-times-circle"></i> El usuario no pudo ser modificado.</strong> <br />
                        <span>Verifique que los datos del domicilio sean correctos.</span>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?php break;?>
                    <?php case 3: ?>
                    <div class="alert alert-danger alert-dismissible fade show mt-4" role="alert">
                        <strong><i class="fas fa-times-circle"></i> El usuario no pudo ser modificado.</strong> <br />
                        <span>Verifique que los datos del usuario sean correctos.</span>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?php break;?>
                    <?php case 4: ?>
                    <div class="alert alert-danger alert-dismissible fade show mt-4" role="alert">
                        <strong><i class="fas fa-times-circle"></i> El usuario no pudo ser modificado.</strong> <br />
                        <span>La nueva contraseña no puede ser igual a la anterior.</span>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?php break; endswitch; ?>
                    <?php endif; ?>

                    <form action="../scripts/modificar_usuario.php" method="post" class="pt-4">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-1"><label for="id">ID. de usuario</label></div>
                                <div class="col-sm-2">
                                    <input type="text" name="id" id="id" value="<?=$usuario_datos['id']?>"
                                        class="form-control" readonly>
                                </div>
                            </div>
                        </div>
                        <h4 class="h4 mb-4 text-gray-800">Datos personales</h4>
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="nom1">*Primer nombre</label>
                                    <input type="text" name="nom1" id="nom1" class="form-control"
                                        value="<?=$usuario_datos['nombre1']?>" required>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="nom2">Segundo nombre</label>
                                    <input type="text" name="nom2" id="nom2" class="form-control"
                                        value="<?=$usuario_datos['nombre2']?>">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="ap">*Apellido paterno</label>
                                    <input type="text" name="ap" id="ap" class="form-control"
                                        value="<?=$usuario_datos['apellidoPaterno']?>" required>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="am">Apellido materno</label>
                                    <input type="text" name="am" id="am" class="form-control"
                                        value="<?=$usuario_datos['apellidoMaterno']?>">
                                </div>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="email">*Correo electrónico</label>
                                    <input type="email" name="email" id="email" class="form-control"
                                        value="<?=$usuario_datos['email']?>" required>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="pass">*Contraseña</label>
                                    <input type="password" name="pass" id="pass" class="form-control"
                                        value="<?=$usuario_datos['password']?>" required>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="tipo">*Tipo de usuario</label>
                                    <select name="tipo" id="tipo" class="form-control" required>
                                        <option selected value="cliente"
                                            <?=$usuario_datos['tipoUsuario'] == 'cliente' ? 'selected="selected"' : NULL?>>
                                            Cliente</option>
                                        <option value="empleado"
                                            <?=$usuario_datos['tipoUsuario'] == 'empleado' ? 'selected="selected"' : NULL?>>
                                            Empleado</option>
                                        <option value="admin"
                                            <?=$usuario_datos['tipoUsuario'] == 'admin' ? 'selected="selected"' : NULL?>>
                                            Administrador</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="estatus">*Estado por defecto</label>
                                    <select name="estatus" id="estatus" class="form-control" required>
                                        <option selected value="activo"
                                            <?=$usuario_datos['estado'] == 'activo' ? 'selected="selected"' : NULL ?>>
                                            Activo</option>
                                        <option value="inactivo"
                                            <?=$usuario_datos['estado'] == 'inactivo' ? 'selected="selected"' : NULL ?>>
                                            Inactivo</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <h4 class="h4 mb-4 text-gray-800">Domicilio</h4>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="calle">*Calle</label>
                                    <input type="text" name="calle" id="calle" class="form-control"
                                        value="<?=$usuario_datos['calle']?>" required>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="nE">*No. exterior</label>
                                    <input type="text" name="nE" id="nE" class="form-control"
                                        value="<?=$usuario_datos['numeroExterior']?>" required>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="nI">*No. interior</label>
                                    <input type="text" name="nI" id="nI" class="form-control"
                                        value="<?=$usuario_datos['numeroInterior']?>">
                                </div>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="col">*Colonia</label>
                                    <input type="text" name="col" id="col" class="form-control"
                                        value="<?=$usuario_datos['colonia']?>" required>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="cp">*Código postal</label>
                                    <input type="text" name="cp" id="cp" class="form-control"
                                        value="<?=$usuario_datos['codigoPostal']?>" required>
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
                                        <option value="<?=$row['id']?>"
                                            <?=$usuario_datos['nombreEstado'] == $row['nombre'] ? 'selected="selected"' : NULL?>>
                                            <?=$row['nombre']?></option>
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
    <script src="https://code.jquery.com/jquery-3.5.1.js"
        integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script>
    function regresar() {
        if (confirm("¿Realmente quiere salir de esta sección?\nNo se guardarán los cambios.")) {
            window.location.href = 'usuarios.php';
        }
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
        url: "../scripts/municipiosSelMod.php",
        data: {
            'estado': $('#edo').val(),
            'id': $('#id').val()
        },
        success: function(response) {
            $('#mun').html(response);
        }
    });
}
</script>

<script>
$(document).ready(function() {
    mostrarSucursales();

    $('#tipo').change(function() {
        mostrarSucursales();
    });
});
</script>

<script type="text/javascript">
function mostrarSucursales() {
    $.ajax({
        type: "POST",
        url: "../scripts/mostrar_sucursales.php",
        data: "tipoUsuario=" + $('#tipo').val(),
        success: function(response) {
            $('#suc').html(response);
        }
    });
}
</script>