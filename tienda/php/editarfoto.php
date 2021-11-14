<?php 
include "conexion.php";
if(isset($_POST['nombre'])){
    
    // Imagen Big
    if($_FILES['imagen']['name'] !='' ){
        $carpeta="../images/fotos/";
        $nombre = $_FILES['imagen']['name'];
        $temp= explode( '.' ,$nombre);
        $extension= end($temp);        
        $nombreFinal = time().'.'.$extension;
    
        if($extension=='jpg' || $extension == 'png'){
            if(move_uploaded_file($_FILES['imagen']['tmp_name'], $carpeta.$nombreFinal)){
                $fila = $conexion->query('select imagen from fotos where id='.$_POST['id']);
                $id = mysqli_fetch_row($fila);
                if(file_exists('../images/fotos/'.$id[0])){
                    unlink('../images/fotos/'.$id[0]);
                }
                $conexion->query("update fotos set imagen='".$nombreFinal."' where id=".$_POST['id']);
            }

        }//llave tipo archivo
    }    //llave si no esta vacio

    $conexion->query("update fotos set 
                        nombre='".$_POST['nombre']."'
                        where id=".$_POST['id']);
    header("Location: ../admin/fotos.php?actualizar");
}else{
    header("Location: ../index.php");
} 
?>