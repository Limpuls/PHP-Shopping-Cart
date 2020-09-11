<?php

require_once ("navigation.php");
require_once("database_connection.php");
$id = !empty($_GET['remove_id']) ? $_GET['remove_id'] : null;
var_dump($id);
if($id != null) {
    $deleteProducts = "DELETE FROM products WHERE id = '$id'";
    $result = mysqli_query($dbc, $deleteProducts);
    mysqli_query($dbc, $deleteProducts);
    if(!$result) {
        echo "error";
    }

}