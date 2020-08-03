<header id="header" class="fixed-top d-flex align-items-center">
  <div class="container">
    <div class="header-container d-flex align-items-center">
      <div class="logo mr-auto">
        <h1 class="text-light"><a href="index.html"><span>Golden Rose</span></a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.html"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
      </div>

      <nav class="nav-menu d-none d-lg-block">
        <ul>
          <li class="active">
            <a href="#header">
              <i class="fas fa-home"></i>
              Inicio
            </a>
          </li>
          <li>
            <a href="#header">
              <i class="fas fa-seedling"></i>
              Catálogo
            </a>
          </li>
          <li class="drop-down"><a href="#"><i class="fas fa-tag"></i> Categorías</a>
            <ul>
              <!--<li class="drop-down"><a href="#">Drop Down 2</a>
                  <ul>
                    <li><a href="#">Deep Drop Down 1</a></li>
                    <li><a href="#">Deep Drop Down 2</a></li>
                    <li><a href="#">Deep Drop Down 3</a></li>
                    <li><a href="#">Deep Drop Down 4</a></li>
                    <li><a href="#">Deep Drop Down 5</a></li>
                  </ul>
                </li>-->
              <li><a href="#">Drop Down 3</a></li>
            </ul>
          </li>
          <li>
            <a href="#header">
              <i class="fas fa-shopping-cart"></i>
              Mi carrito
            </a>
          </li>
          <li class="drop-down"><a href=""><i class="fas fa-user-circle"></i>
              <?=$_SESSION['nombre1']." ".$_SESSION['apellidoPaterno']?></a>
            <ul>
              <li><a href="#"><i class="fas fa-user"></i> Mi perfil</a></li>
              <li><a href="scripts/logout.php"><i class="fas fa-power-off"></i> Cerrar sesión</a></li>
            </ul>
          </li>
        </ul>
      </nav><!-- .nav-menu -->
    </div><!-- End Header Container -->
  </div>
</header><!-- End Header -->