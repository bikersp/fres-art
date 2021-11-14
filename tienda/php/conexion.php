<?php
  include('config.php');
	define("KEY", "MODAFRESART");
	define("COD", "AES-128-ECB");

	$servidor="localhost";
	$nombreBd="carrito";
	$usuario="root";
	$pass="";

  // $servidor="localhost";
  // $nombreBd="jgodrive_fresart_tienda";
  // $usuario="jgodrive_fresart";
  // $pass="fresart2021";

	$conexion = new mysqli($servidor,$usuario,$pass,$nombreBd);

	if ($conexion->connect_error) {
		die("Error en la Conexion");
		// exit;
	}

?>