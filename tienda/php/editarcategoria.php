<?php 
include "conexion.php";
if(isset($_POST['nombre']) && isset($_POST['descripcion'])){
    
   
    // Imagen Big
    if($_FILES['imagen']['name'] !='' ){
        $carpeta="../images/";
        $nombre = $_FILES['imagen']['name'];
        $temp= explode( '.' ,$nombre);
        $extension= end($temp);        
        $nombreFinal = time().'.'.$extension;
    
        if($extension=='jpg' || $extension == 'png'){
            if(move_uploaded_file($_FILES['imagen']['tmp_name'], $carpeta.$nombreFinal)){
                $fila = $conexion->query('select imagen from categorias where id='.$_POST['id']);
                $id = mysqli_fetch_row($fila);
                if(file_exists('../images/'.$id[0])){
                    unlink('../images/'.$id[0]);
                }
                $conexion->query("update categorias set imagen='".$nombreFinal."' where id=".$_POST['id']);
            }

        }//llave tipo archivo
    }    //llave si no esta vacio 


    if (isset($_POST['detalle1'])){$detalle1 = $_POST['detalle1'];}else{$detalle1 = "";}
    if (isset($_POST['detalle2'])){$detalle2 = $_POST['detalle2'];}else{$detalle2 = "";}
    if (isset($_POST['detalle3'])){$detalle3 = $_POST['detalle3'];}else{$detalle3 = "";}

    $conexion->query("update categorias set 
                        nombre='".$_POST['nombre']."',
                        descripcion='".$_POST['descripcion']."',
                        detalle1='".$detalle1."',
                        detalle2='".$detalle2."',
                        detalle3='".$detalle3."'
                        where id=".$_POST['id']);
    header("Location: ../admin/categorias.php?actualizar");
}else{
    header("Location: ../index.php");
} 
?>