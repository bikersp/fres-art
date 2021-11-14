<?php 
include("conexion.php");
if (isset($_POST['color'])) {
	$conexion->query("insert into colores (color,codigo)
		values(
		'".$_POST['color']."',
		'".$_POST['codigo']."'
		)
		") or die($conexion->error);
		header("Location: ../admin/colores.php?success");
}else{
	header("Location: ../admin/colores.php?error");
}

?>