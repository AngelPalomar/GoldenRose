<?php

require('scripts/db_connection.php');

?>

<header id="header" class="fixed-top d-flex align-items-center">
    <div class="container">
        <div class="header-container d-flex align-items-center">
            <div class="logo mr-auto">
                <h1 class="text-light"><a href="index.php"><span>Golden Rose</span></a></h1>
                <!-- Uncomment below if you prefer to use an image logo -->
                <!-- <a href="index.html"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
            </div>

            <nav class="nav-menu d-none d-lg-block">
                <ul>
                    <li>
                        <a href="index.php">
                            <i class="fas fa-home"></i>
                            Inicio
                        </a>
                    </li>
                    <li class="drop-down"><a href="#"><i class="fas fa-tag"></i> Categorías</a>
                        <ul>
                            <?php
                          $cat = "SELECT nombre FROM categoria";
                          $query = $mysqli->query($cat);

                          if($query->num_rows > 0):
                          while ($row = $query->fetch_array(MYSQLI_ASSOC)):
                          ?>
                            <li><a href="categoria.php?cat=<?=$row['nombre']?>"><?=$row['nombre']?></a></li>
                            <?php endwhile; ?>
                            <?php endif; ?>
                        </ul>
                    </li>
                    <li>
                        <a href="ver_carrito.php">
                            <i class="fas fa-shopping-cart"></i>
                            Mi carrito 
                            <?php
                            if (!isset($_SESSION['carrito'])) {
                                echo '(0)';
                            } else {
                                echo '('.sizeof($_SESSION['carrito']).')';
                            }
                            ?>                           
                        </a>
                    </li>
                    <?php
                    if (isset($_SESSION['id'])):
                    ?>
                    <li class="drop-down"><a href=""><i class="fas fa-user-circle"></i>
                            <?=$_SESSION['nombre1']." ".$_SESSION['apellidoPaterno']?></a>
                        <ul>
                            <li><a href="perfil.php"><i class="fas fa-user"></i> Mi perfil</a></li>
                            <li><a href="scripts/logout.php"><i class="fas fa-power-off"></i> Cerrar sesión</a></li>
                        </ul>
                    </li>
                    <?php else: ?>
                    <li class="drop-down active">
                        <a href="">
                            <i class="fas fa-arrow-alt-circle-right"></i>
                            Ingresar
                        </a>
                        <ul>
                            <li><a href="register.php"><i class="fas fa-user-edit"></i> Registrarse</a></li>
                            <li><a href="login.php"><i class="fas fa-sign-in-alt"></i> Iniciar Sesión</a></li>
                        </ul>
                    </li>
                    <?php endif; ?>
                </ul>
            </nav><!-- .nav-menu -->
        </div><!-- End Header Container -->
    </div>
</header><!-- End Header -->