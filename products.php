<?php
session_start();
require_once ("navigation.php");
require_once("database_connection.php");
if(isset($_SESSION['user'])) {
    echo $_SESSION['user'];
}

$q = "SELECT products.id, products.name, products.price, products.amount, products.image_url, categories.category_name FROM products LEFT JOIN categories ON (products.category_id = categories.category_id)";
$query = mysqli_query($dbc, $q);

$newArray = array(); // initiliaze
while ($row = mysqli_fetch_assoc($query)) { // here i am using mysqli_fetch_assoc
    $newArray[] = $row;  // store in a new array
}

?>
<div class="row products_container">
<?php foreach($newArray as $product) {
    if (isset($_GET['product_name']) && $_GET['product_name'] == $product['name']) {
        echo '<div class="card" style="width: 18rem;">
    <img class="card-img-top" src="'.$product['image_url'].'" alt="Card image cap">
    <div class="card-body">
        <h5 class="card-title">' . $product['name'] . '</h5>
        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card\'s content.</p>
        <p class="font-weight-light">' . $product['price'] . ' $</p>
        <a href="add_to_cart.php?product_id=' . $product['id'] . ' " class="btn btn-primary">Add To Cart</a>
    </div>
</div>';
    }
}
?>
</div>

