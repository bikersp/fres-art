<?php  
session_start();
if(isset($_SESSION["carrito"])){
    $carrito = $_SESSION["carrito"];
    unset($carrito[$_POST['indice']]);
    $carrito = array_values($carrito);

    $_SESSION["carrito"] = $carrito;

    if(count($carrito) == 0){
        session_unset($carrito);
    }
}
echo "Listo";
// header("Location: ../cart.php");
?>