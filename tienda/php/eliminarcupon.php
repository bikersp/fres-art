<?php
include "./conexion.php";
$conexion->query("delete from cupones where id=".$_POST['id']);
echo 'listo';

?>