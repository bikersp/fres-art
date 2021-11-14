<?php 
    include "conexion.php";
    if(isset($_POST['nombre']) && isset($_POST['apellido']) && isset($_POST['telefono'])
    && isset($_POST['email']) && isset($_POST['nivel']) && isset($_POST['password'])){   
        
        $conexion->query("update usuario set 
                            nombre='".$_POST['nombre']."',
                            apellido='".$_POST['apellido']."',
                            telefono='".$_POST['telefono']."',
                            email='".$_POST['email']."',
                            password='".openssl_encrypt($_POST['password'],COD,KEY)."',
                            img_perfil='default.jpg',
                            nivel='".$_POST['nivel']."' 
                            where id=".$_POST['id']);
        header("Location: ../admin/usuarios.php?actualizar");
    }else{
        header("Location: ../index.php");
    }
?>