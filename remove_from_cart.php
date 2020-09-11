<?php
ob_start();
session_start();

echo $_GET['item_id'];

$key=array_search($_GET['item_id'],$_SESSION['cart']);
while($key=array_search($_GET['item_id'],$_SESSION['cart'])) {
    unset($_SESSION['cart'][$key]);
}
header('Location: add_to_cart.php');
ob_clean();
//unset($_SESSION['cart'][1]);