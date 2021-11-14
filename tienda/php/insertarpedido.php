<?php 
session_start();
include("./conexion.php");
if (!isset($_SESSION['carrito'])) {
  header('Location: ../index.php');
}

$arreglo = $_SESSION['carrito'];
$delibery=$_POST['delibery'];
$total= 0;

for ($i=0; $i < count($arreglo); $i++) { 
  $total= $total + $arreglo[$i]['Precio'] * $arreglo[$i]['Cantidad'];
}

if ($total <= 160) {
  $total=$total+$delibery;
}

if (isset($_POST['c_account_password'])) {
  if (isset($_POST['c_account_password'])!="") {
    $password= $_POST['c_account_password'];
  }
}

$re= $conexion->query("select * from usuario where email= '".$_POST['c_email_address']."'") or die($conexion->error);
$id_usuario= 0;
if (mysqli_num_rows($re) > 0) {
  $fila= mysqli_fetch_row($re);
  $id_usuario=$fila[0];
}else{
  $conexion->query("insert into usuario (nombre,apellido,telefono,email,password,img_perfil,nivel)
    values(
    '".$_POST['c_fname']."', 
    '".$_POST['c_lname']."',
    '".$_POST['c_phone']."',
    '".$_POST['c_email_address']."',
    '".openssl_encrypt($password,COD,KEY)."',
    'default.jpg',
    'cliente'
  )")or die($conexion->error);
  $id_usuario= $conexion->insert_id;
}

if ($_POST['id_cupon'] == "") {$cupon = 0;}else{$cupon = $_POST['id_cupon'];}

$fecha= date('Y-m-d h:m:s');
$conexion -> query("insert into ventas(id_usuario,total,fecha,status,id_cupon,delibery) values($id_usuario,$total,'$fecha','pendiente',$cupon,$delibery)") or die($conexion->error);
$id_venta = $conexion ->insert_id;

for ($i=0; $i < count($arreglo); $i++) { 
  $conexion -> query("insert into productos_venta(id_venta,id_producto,talla,cantidad,precio,subtotal) 
    values(
    $id_venta,
    ".$arreglo[$i]['Id'].",
    '".$arreglo[$i]['Talla']."',
    ".$arreglo[$i]['Cantidad'].",
    ".$arreglo[$i]['Precio'].",
    ".$arreglo[$i]['Cantidad']*$arreglo[$i]['Precio']."
    )") or die($conexion->error);
  $conexion->query("update productos set inventario = inventario -".$arreglo[$i]['Cantidad']." where id=".$arreglo[$i]['Id']) or die($conexion->error);
}

if (empty($_POST['c_state_country2'])) {
  $distrito=$_POST['c_state_country'];
}else{
  $distrito=$_POST['c_state_country2'];  
}

$conexion->query("insert into envios (pais,company,direccion,estado,cp,id_venta) values(
  '".$_POST['country']."',
  '".$_POST['c_companyname']."',
  '".$_POST['c_address']."',
  '".$distrito."',
  '".$_POST['c_postal_zip']."',
  $id_venta
  )") or die($conexion->error);

if (isset($conexion->error)) {
  if ($_POST['id_cupon'] != "") {
    $conexion->query("update cupones set status ='usado' where id=".$_POST['id_cupon']) or die($conexion->error);
    $conexion->query("update ventas set id_cupon = ".$_POST['id_cupon']." where id=".$id_venta) or die($conexion->error);
  }
}

include("../phpmailer/email.php");
unset($_SESSION['carrito']);
header('Location: ../compra-finalizada.php?id_venta='.base64_encode($id_venta).'&metodo=transferencia');