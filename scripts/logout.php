<?php

session_start();

unset($_SESSION['id']);
unset($_SESSION['email']);
unset($_SESSION['tipoUsuario']);
unset($_SESSION['nombre1']);
unset($_SESSION['nombre2']);
unset($_SESSION['apellidoPaterno']);
unset($_SESSION['apellidoMaterno']);
unset($_SESSION['fechaUltimoAcceso']);
unset($_SESSION['estado']);

header('Location:../index.php');

?>