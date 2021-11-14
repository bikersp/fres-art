<?php 
include("conexion.php");
if (isset($_POST['talla'])) {
	$conexion->query("insert into tallas (talla)
		values(
		'".$_POST['talla']."'
		)
		") or die($conexion->error);
		header("Location: ../admin/tallas.php?success");
}else{
	header("Location: ../admin/tallas.php?error");
}

?>