<?php
include "./conexion.php";
$conexion->query("delete from tallas where id=".$_POST['id']);
echo 'listo';

?>