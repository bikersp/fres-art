<?php
include "./conexion.php";
$conexion->query("delete from colores where id=".$_POST['id']);
echo 'listo';

?>