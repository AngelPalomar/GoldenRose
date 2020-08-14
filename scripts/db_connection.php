<?php

session_start();
/**Selección de usuario a la BD dependiendo del tipo */
if (isset($_SESSION['id']) && isset($_SESSION['tipoUsuario'])) {

	$tipoUsuario = $_SESSION['tipoUsuario'];

	switch ($tipoUsuario) {
		case 'admin':
			$user = 'admingr';
			break;

		case 'empleado':
			$user = 'empleadogr';
			break;

		case 'cliente':
			$user = 'clientegr';
			break;
		
		default:
			$user = 'clientegr';
			break;
	}
} else {
	$user = 'admingr';
}


$mysqli = new mysqli
(
	'localhost',
	$user,
	'0000',
	'golden_rose'
);

/**Caracteres especiales */
$mysqli->set_charset("utf8");

?>