<?php 
include "conexion.php";
if(isset($_POST['color']) && isset($_POST['codigo'])){
    
    $conexion->query("update colores set 
                        color='".$_POST['color']."',
                        codigo='".$_POST['codigo']."'
                        where id=".$_POST['id']);
    header("Location: ../admin/colores.php?actualizar");
}else{
    header("Location: ../index.php");
} 
?>