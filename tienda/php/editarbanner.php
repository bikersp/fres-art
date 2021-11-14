<?php 
include "conexion.php";
if(isset($_POST['nombre'])){
    
    // Imagen Big
    if($_FILES['imagen']['name'] !='' ){
        $carpeta="../images/banners/big/";
        $nombre = $_FILES['imagen']['name'];
        $temp= explode( '.' ,$nombre);
        $extension= end($temp);        
        $nombreFinal = time().'.'.$extension;
    
        if($extension=='jpg' || $extension == 'png'){
            if(move_uploaded_file($_FILES['imagen']['tmp_name'], $carpeta.$nombreFinal)){
                $fila = $conexion->query('select imagen from banners where id='.$_POST['id']);
                $id = mysqli_fetch_row($fila);
                if(file_exists('../images/banners/big/'.$id[0])){
                    unlink('../images/banners/big/'.$id[0]);
                }
                $conexion->query("update banners set imagen='".$nombreFinal."' where id=".$_POST['id']);
            }

        }//llave tipo archivo
    }    //llave si no esta vacio    

    // Imagen Small
    if($_FILES['imagen2']['name'] !='' ){
        $carpeta2="../images/banners/";
        $nombre2 = $_FILES['imagen2']['name'];
        $temp2= explode( '.' ,$nombre2);
        $extension2= end($temp2);
        $nombreFinal2 = time().'.'.$extension2;
    
        if($extension2=='jpg' || $extension2 == 'png'){
            if(move_uploaded_file($_FILES['imagen2']['tmp_name'], $carpeta2.$nombreFinal2)){
                $fila2 = $conexion->query('select imagen2 from banners where id='.$_POST['id']);
                $id2 = mysqli_fetch_row($fila2);
                if(file_exists('../images/banners/'.$id2[0])){
                    unlink('../images/banners/'.$id2[0]);
                }
                $conexion->query("update banners set imagen2='".$nombreFinal2."' where id=".$_POST['id']);
            }

        }
    }

    $conexion->query("update banners set 
                        nombre='".$_POST['nombre']."'
                        where id=".$_POST['id']);
    header("Location: ../admin/banners.php?actualizar");
}else{
    header("Location: ../index.php");
} 
?>