<?php 
include "helpers.php";
include "conexion.php";
if(isset($_POST['nombre']) &&  isset($_POST['descripcion'])   &&  isset($_POST['precio'])
    &&  isset($_POST['inventario']) &&  isset($_POST['categoria']) &&  isset($_POST['talla'])
    &&  isset($_POST['color'])){
    
    $talla=implode(",", $_POST['talla']);

    // Imagen Big
    if($_FILES['imagen']['name'] !='' ){
        $carpeta="../images/";
        $nombre = $_FILES['imagen']['name'];
        $temp= explode( '.' ,$nombre);
        $extension= end($temp);        
        $nombreFinal = time().'.'.$extension;
    
        if($extension=='jpg' || $extension == 'png'){
            if(move_uploaded_file($_FILES['imagen']['tmp_name'], $carpeta.$nombreFinal)){
                $fila = $conexion->query('select imagen from productos where id='.$_POST['id']);
                $id = mysqli_fetch_row($fila);
                if(file_exists('../images/'.$id[0])){
                    unlink('../images/'.$id[0]);
                }
                $conexion->query("update productos set imagen='".$nombreFinal."' where id=".$_POST['id']);
            }

        }//llave tipo archivo
    }    //llave si no esta vacio    

    // Imagen Small
    if($_FILES['imagen2']['name'] !='' ){
        $carpeta2="../images/small/";
        $nombre2 = $_FILES['imagen2']['name'];
        $temp2= explode( '.' ,$nombre2);
        $extension2= end($temp2);
        $nombreFinal2 = time().'.'.$extension2;
    
        if($extension2=='jpg' || $extension2 == 'png'){
            if(move_uploaded_file($_FILES['imagen2']['tmp_name'], $carpeta2.$nombreFinal2)){
                $fila2 = $conexion->query('select imagen2 from productos where id='.$_POST['id']);
                $id2 = mysqli_fetch_row($fila2);
                if(file_exists('../images/small/'.$id2[0])){
                    unlink('../images/small/'.$id2[0]);
                }
                $conexion->query("update productos set imagen2='".$nombreFinal2."' where id=".$_POST['id']);
            }

        }
    }

    $url = strtolower(clear_cadena($_POST['nombre']));
    $url = str_replace(" ","-", $url);

    $conexion->query("update productos set 
                        nombre='".$_POST['nombre']."',
                        descripcion='".$_POST['descripcion']."',
                        precio=".$_POST['precio'].",
                        precio_oferta=".$_POST['preciooferta'].",
                        inventario=".$_POST['inventario'].",
                        id_categoria=".$_POST['categoria'].",
                        talla='".$talla."',
                        color='".$_POST['color']."',
                        indice='".$_POST['indice']."',
                        nuevo='".$_POST['nuevo']."',
                        url='".$url."'
                        where id=".$_POST['id']);
    header("Location: ../admin/productos.php?actualizar");
}else{
    header("Location: ../index.php");
} 
?>