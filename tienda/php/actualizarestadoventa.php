<?php 
include "conexion.php";
if(isset($_GET['id'])){
	if ($_GET['status'] == "pendiente") {
	   	$conexion->query("update ventas set status='pagado' where id=".$_GET['id']);
	}else{
    	$conexion->query("update ventas set status='entregado' where id=".$_GET['id']);
    }
    header("Location: ../admin/pedidos.php");
}else{
    header("Location: ../index.php");
} 
?>