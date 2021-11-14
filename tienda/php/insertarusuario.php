<?php 
include "./conexion.php";

if(isset($_POST['nombre']) && isset($_POST['apellido']) && isset($_POST['telefono'])
&& isset($_POST['email']) && isset($_POST['nivel']) && isset($_POST['password'])){

    $conexion->query("insert into usuario 
        (nombre,apellido,telefono,email,password,img_perfil,nivel) values
        (
            '".$_POST['nombre']."',
            '".$_POST['apellido']."',
            '".$_POST['telefono']."',
            '".$_POST['email']."',
            '".openssl_encrypt($_POST['password'],COD,KEY)."',
            'default.jpg',
            '".$_POST['nivel']."'
        )   ")or die($conexion->error);
        header("Location: ../admin/usuarios.php?success");
}else{
    header("Location: ../admin/usuarios.php?error");
}

?>