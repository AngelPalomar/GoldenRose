<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <!-- Sidebar -->
    <ul class="navbar-nav admin-sidebar sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center admin-sidebar" href="index.php">
        <div class="sidebar-brand-icon">
            <i class="fas fa-leaf"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Golden Rose</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item">
        <a class="nav-link" href="index.php">
          <i class="fas fa-home"></i>
          <span>Inicio</span></a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="../home.php">
          <i class="fas fa-leaf"></i>
          <span>Ir a la tienda</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Opciones
      </div>

      <!-- Nav Item - Charts -->
      <?php if ($_SESSION['tipoUsuario'] === 'admin'): ?>
      <li class="nav-item">
        <a class="nav-link" href="usuarios.php">
          <i class="fas fa-user"></i>
          <span>Usuarios</span>
        </a>
      </li>
      <?php endif; ?>

      <?php if ($_SESSION['tipoUsuario'] === 'admin'): ?>
      <li class="nav-item">
        <a class="nav-link" href="productos.php">
          <i class="fas fa-box"></i>
          <span>Productos</span></a>
      </li>
      <?php endif; ?>
      
      <li class="nav-item">
        <a class="nav-link" href="usuarios.php">
          <i class="fas fa-boxes"></i>
          <span>Inventarios</span>
        </a>
      </li>

      <!-- Nav Item - Tables -->
      <?php if ($_SESSION['tipoUsuario'] === 'admin'): ?>
      <li class="nav-item">
        <a class="nav-link" href="tables.html">
          <i class="fas fa-copyright"></i>
          <span>Marcas</span></a>
      </li>
      <?php endif; ?>

      <?php if ($_SESSION['tipoUsuario'] === 'admin'): ?>
      <li class="nav-item">
        <a class="nav-link" href="tables.html">
          <i class="fas fa-tag"></i>
          <span>Categorías</span></a>
      </li>
      <?php endif; ?>

      <li class="nav-item">
        <a class="nav-link" href="tables.html">
          <i class="fas fa-money-check"></i>
          <span>Ventas</span></a>
      </li>

      <?php if ($_SESSION['tipoUsuario'] === 'admin'): ?>
      <li class="nav-item">
        <a class="nav-link" href="tables.html">
          <i class="fas fa-store"></i>
          <span>Sucursales</span></a>
      </li>
      <?php endif; ?>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Cerrar sesión</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Seleccione "Salir" para cerrar la sesión actual</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
            <a class="btn golden-button-primary" href="../scripts/logout.php">Cerrar sesión</a>
          </div>
        </div>
      </div>
    </div>
</body>
</html>