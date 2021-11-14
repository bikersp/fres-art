<?php 
include "./helpers.php";
include "./conexion.php";

if(isset($_POST['nombre']) &&  isset($_POST['descripcion'])   &&  isset($_POST['precio'])
&&  isset($_POST['inventario']) &&  isset($_POST['categoria']) &&  isset($_POST['talla'])
&&  isset($_POST['color'])){
    
    $talla=implode(",", $_POST['talla']);

    $carpeta="../images/";
    $nombre = $_FILES['imagen']['name'];   
    $temp= explode( '.' ,$nombre);
    $extension= end($temp);
    $nombreFinal = time().'.'.$extension;

    $carpeta2="../images/small/";
    $nombre2 = $_FILES['imagen2']['name'];
    $temp2= explode( '.' ,$nombre2);
    $extension2= end($temp2);    
    $nombreFinal2 = time().'.'.$extension2;
   
    if($extension=='jpg' || $extension == 'png'){
        if(move_uploaded_file($_FILES['imagen']['tmp_name'], $carpeta.$nombreFinal) && move_uploaded_file($_FILES['imagen2']['tmp_name'],$carpeta2.$nombreFinal2)){

            $url = strtolower(clear_cadena($_POST['nombre']));
            $url = str_replace(" ","-", $url);
            if (isset($_POST['detalle1'])){$detalle1 = $_POST['detalle1'];}else{$detalle1 = "";}
            if (isset($_POST['detalle2'])){$detalle2 = $_POST['detalle2'];}else{$detalle2 = "";}
            if (isset($_POST['detalle3'])){$detalle3 = $_POST['detalle3'];}else{$detalle3 = "";}

            $conexion->query("insert into productos 
                (nombre,descripcion, imagen,precio,precio_oferta,talla,color,id_categoria,inventario,imagen2,indice,nuevo,url) values
                (
                    '".$_POST['nombre']."',
                    '".$_POST['descripcion']."',
                    '$nombreFinal',
                    ".$_POST['precio'].",
                    ".$_POST['preciooferta'].",
                    '".$talla."',
                    '".$_POST['color']."',
                    ".$_POST['categoria'].",
                    '".$_POST['inventario']."',
                    '$nombreFinal2',
                    '".$_POST['indice']."',
                    '".$_POST['nuevo']."',
                    '".$url."'
                )   ")or die($conexion->error);
                header("Location: ../admin/productos.php?success");
        }else{
            header("Location: ../admin/productos.php?error=No se pudo subir la imagen");
        }
    }else{
        header("Location: ../admin/productos.php?error=Favor de subir una imagen valida en jpg/png");
    }

}else{
    header("Location: ../admin/productos.php?error=Favor de llenar todos los campos");
}

?>