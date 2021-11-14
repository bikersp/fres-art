<?php 
session_start();
include "./conexion.php";

if(isset($_POST['email'])  && isset($_POST['password'])){
    
    $resultado = $conexion->query("select * from usuario where 
        email='".$_POST['email']."' and 
        password='".openssl_encrypt($_POST['password'],COD,KEY)."' limit 1")or die($conexion->error);
    if(mysqli_num_rows($resultado)>0){
        $datos_usuario = mysqli_fetch_row($resultado); 
        $id = $datos_usuario[0];
        $nombre = $datos_usuario[1];
        $apellido = $datos_usuario[2];
        $id_usuario = $datos_usuario[0];
        $telefono = $datos_usuario[3];
        $email = $datos_usuario[4];
        $imagen_perfil = $datos_usuario[6];
        $nivel = $datos_usuario[7];

        $_SESSION['datos_login']= array(
            'id'=>$id,
            'nombre'=>$nombre,
            'apellido'=>$apellido,
            'id_usuario'=>$id_usuario,
            'email'=>$email,
            'telefono'=>$telefono,
            'imagen'=>$imagen_perfil,
            'nivel'=>$nivel
        );
        header("Location: ../admin/");
    }else{
        header("Location: ../login.php?error");
    }
}else{
    header("Location: ../login");
}
?>