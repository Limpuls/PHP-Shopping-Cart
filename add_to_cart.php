<?php
ob_start();
session_start();
require_once('navigation.php');
require_once('database_connection.php');

//multi arrays
$cars = array
(
    array("Volvo",22,18),
    array("BMW",15,13),
    array("Saab",5,2),
    array("Land Rover",17,15),
    "fiat"
);
foreach($cars as $key) {

    foreach ($key as $value) {
        echo $value;
    }
}
$alert_array = array();
$alert_array[] = array('alert' => 'alert', 'email' => 'Test');

var_dump($alert_array);


$alert_array = [];
$alert_array[] = ['alert' => 'alert', 'email' => 'Test'];

if(empty($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

    $products_amount = array_count_values($_SESSION['cart']);


    array_push($_SESSION['cart'], $_GET['product_id']);
    $arrayImplodedToStr = implode("','", $_SESSION['cart']);

$q = "SELECT * FROM products WHERE id IN ('$arrayImplodedToStr')";

$result = mysqli_query($dbc, $q);

$allRows = [];

while($row = mysqli_fetch_assoc($result)) {
    $allRows[] = $row;
}
?>
<div class="container">
<?php
foreach ($allRows as $cartItems) {
        echo '
   <div class="card shopping-cart">
            <div class="card-header bg-dark text-light">
                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
    Shopping cart
    <a href="products.php" class="btn btn-outline-info btn-sm pull-right">Continue shopping</a>
                <div class="clearfix"></div>
            </div>
            <div class="card-body">
                    <!-- PRODUCT -->
                    
                        <div class="col-12 col-sm-12 col-md-2 text-center">
                                <img class="img-responsive" src="'.$cartItems['image_url'].'" alt="prewiew" width="120" height="80">
                        </div>
                        <div class="col-12 text-sm-center col-sm-12 text-md-left col-md-6">
                            <h4 class="product-name"><strong>' . $cartItems['name'] . '</strong></h4>
                          
                        </div>
                        <div class="col-12 col-sm-12 text-sm-center col-md-4 text-md-right row">
                            <div class="col-3 col-sm-3 col-md-6 text-md-right" style="padding-top: 5px">
                               
                            </div>
                            <div class="col-4 col-sm-4 col-md-4">
                                <!--<div class="quantity">
                                    <input type="button" value="+" class="plus">
                                    <input type="number" step="1" max="99" min="1" value="1" title="Qty" class="qty"
                                           size="4">
                                    <input type="button" value="-" class="minus">
                                </div>-->
                            </div><p>Amount: ' . $products_amount[$cartItems['id']] . '</p><br><div class="col-12 col-sm-12 col-md-12 text-left">
                                <p>Total Price: '.$products_amount[$cartItems['id']] * $cartItems['price'].'</p>
                                <p><a href="remove_from_cart.php?item_id='.$cartItems['id'].' ">Remove Item</a></p>
                            </div>
                        </div>
                    </div>
                    <hr>';
  
    }

?>
</div>

<?php


