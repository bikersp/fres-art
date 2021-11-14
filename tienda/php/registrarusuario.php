<?php 
session_start();
include("./conexion.php");
if (isset($_POST['nombre'])) {

$usuario= $conexion->query("select * from usuario where email= '".$_POST['email']."'") or die($conexion->error);
$id_usuario= 0;
if (mysqli_num_rows($usuario) > 0) {
  $fila= mysqli_fetch_row($usuario);
  $id_usuario=$fila[0];
    header('Location: ../register.php?error');
  }else{
    $conexion->query("insert into usuario (nombre,apellido,telefono,email,password,img_perfil,nivel)
      values(
      '".$_POST['nombre']."', 
      '".$_POST['apellido']."',
      '".$_POST['telefono']."',
      '".$_POST['email']."',
      '".openssl_encrypt($_POST['password'],COD,KEY)."',
      'default.jpg',
      'cliente'
    )")or die($conexion->error);
    $id_usuario= $conexion->insert_id;
    header('Location: ../register.php?success');
  }
}else{
  header('Location: ../index.php');
}
?>