<?php 
include "conexion.php";
if(isset($_POST['talla'])){
    
    $conexion->query("update tallas set 
                        talla='".$_POST['talla']."'
                        where id=".$_POST['id']);
    header("Location: ../admin/tallas.php?actualizar");
}else{
    header("Location: ../index.php");
} 
?>