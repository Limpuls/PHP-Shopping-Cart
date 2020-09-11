<?php
require_once('database_connection.php');
$q = "SELECT DISTINCT categories.category_id, categories.category_name FROM products LEFT JOIN categories ON (products.category_id = categories.category_id)";
$query = "SELECT DISTINCT products.name, products.price, products.amount, categories.category_name, products.id as Action FROM products LEFT JOIN categories ON (products.category_id = categories.category_id)";
$products = mysqli_query($dbc, $query);
$columns = mysqli_query($dbc,$q);

//fetching assoc array for my categories
$arr = [];
while($row = mysqli_fetch_array($columns, MYSQLI_ASSOC)){
    $arr[] = $row;
}

//fetching assoc array for my products
$newArray = array(); // initiliaze
while ($row = mysqli_fetch_assoc($products)) { // here i am using mysqli_fetch_assoc
    $newArray[] = $row;  // store in a new array
}
?>
<!DOCTYPE html>
<head>
    <title></title>
    <link rel="stylesheet" href="style.css">
</head>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">PHP ESHOP</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="home.php">Home <span class="sr-only">(current)</span></a>
            </li>
            <?php if(!isset($_SESSION['user']) && empty($_SESSION['user'])) {
                echo '<li class="nav-item">
                <a class="nav-link" href="login.php">Login</a>
            </li>';} ?>
            <?php if(!isset($_SESSION['user']) && empty($_SESSION['user'])) {
            echo '<li class="nav-item">
                <a class="nav-link" href="register.php">Register</a>
            </li>';} ?>

            <li class="nav-item multi">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">Products</a>
                <ul class="dropdown-menu multi-level">
                    <?php foreach($arr as $category) {
                        echo "<li class='nav-link dropdown-submenu'>
                                <a href=\"products.php?category_id=".$category['category_id']."\" class='dropdown-toggle' data-toggle='dropdown'>".$category['category_name']."</a>
                                <ul class='dropdown-menu'>";?>
                                <?php foreach($newArray as $product) {
                                    if ($category['category_name'] == $product['category_name']) {
                                        echo "<li><a href='products.php?product_name=".$product['name']."'>".$product['name']."</a></li>";
                                    }
                                } ?>
                                <?php echo "</ul>
                                </li>";
                    } ?>
                    </li>
                </ul>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="add_to_cart.php">Shopping Cart</a>
            </li>
            <?php if(isset($_SESSION['userType']) && !empty($_SESSION['userType'])) {
                echo
                '<li class="nav-item">
                <a class="nav-link" href="admin_dashboard.php">Dashboard</a>
                </li>';}
                ?>
            <?php if(isset($_SESSION['user']) && !empty($_SESSION['user'])) { echo '<li class="nav-item">
                <p class="nav-link disabled">Logged in as:'; ?> <?php echo $_SESSION['user'] ?> <?php '</p>
            </li>'; }?>
            <?php if(isset($_SESSION['user'])) { echo '<li>
                <a class="nav-link" href="logout.php">Logout</a>
            </li>';}?>
        </ul>
    </div>
</nav>
<!-- bootstrap dependencies -->

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script
        src="http://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
        crossorigin="anonymous"></script>
<script src="script.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>