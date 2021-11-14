<?php 
include "./conexion.php";

if(isset($_POST['nombre']) &&  isset($_POST['descripcion'])){
    
    $carpeta="../images/";
    $nombre = $_FILES['imagen']['name'];
   
    //imagen.casa.jpg
    $temp= explode( '.' ,$nombre);
    $extension= end($temp);
    
    $nombreFinal = time().'.'.$extension;
   
    if($extension=='jpg' || $extension == 'png'){
        if(move_uploaded_file($_FILES['imagen']['tmp_name'], $carpeta.$nombreFinal)){
            $conexion->query("insert into categorias 
                (nombre,descripcion, imagen,detalle1,detalle2,detalle3) values
                (
                    '".$_POST['nombre']."',
                    '".$_POST['descripcion']."',
                    '$nombreFinal',
                    '".$detalle1."',
                    '".$detalle2."',
                    '".$detalle3."'
                )   ")or die($conexion->error);

                header("Location: ../admin/categorias.php?success");
        }else{
            header("Location: ../admin/categorias.php?error=No se pudo subir la imagen");
        }
    }else{
        header("Location: ../admin/categorias.php?error=Favor de subir una imagen valida en jpg/png");
    }

}else{
    header("Location: ../admin/categorias.php?error=Favor de llenar todos los campos");
}

?>