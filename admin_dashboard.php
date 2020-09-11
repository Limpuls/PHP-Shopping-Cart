<?php
session_start();
require_once ("navigation.php");
require_once("database_connection.php");
//query for category id and names
$q = "SELECT DISTINCT categories.category_id, categories.category_name FROM products LEFT JOIN categories ON (products.category_id = categories.category_id)";
//query for products
$query = "SELECT DISTINCT products.name, products.price, products.amount, categories.category_name, products.id as Action FROM products LEFT JOIN categories ON (products.category_id = categories.category_id)";
//query for ID column in Products table
$ids = "SELECT products.id FROM products";
$sessionUser = $_SESSION['user'];
$usersquery = "SELECT type FROM users WHERE name = '$sessionUser' ";


//$result = mysqli_query($dbc, $q);
$products = mysqli_query($dbc, $query);
$columns = mysqli_query($dbc,$q);
$idsColumn = mysqli_query($dbc, $ids);
$usersqueryResult = mysqli_query($dbc, $usersquery);

$usrname = mysqli_fetch_assoc($usersqueryResult);
$user_type = $usrname['type'];
if (!$user_type == 1) {
    header('Location: home.php');
    exit();
}

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

//ids
$idsArray = array(); // initiliaze
while ($row = mysqli_fetch_assoc($idsColumn)) { // here i am using mysqli_fetch_assoc
    $idsArray[] = $row;  // store in a new array
}

$product = isset($_POST['product']);
$category = isset($_POST['category_id']);
$price = isset($_POST['price']);
$amount = isset($_POST['amount']);

$insertq = "INSERT INTO products (category_id, name, price, amount) VALUES ('$category', '$product', '$price', '$amount')";


if(isset($_POST['product'])) {
    mysqli_query($dbc, $insertq);
}
?>

<form action="admin_dashboard.php" method="post">
    <fieldset>
        <legend>Add Product</legend>
        <p>Product name: <input name="product" type="text" size="60" maxlength="100" required></p>
        <p>Category: <select name="category_id"><?php foreach ($arr as $entry)

                { ?><option value="<?php echo($entry['category_id']);?>"><?php echo $entry['category_name']; ?></option> <?php }?></select></p>
        <p>Price: <input name="price"></p>
        <p>Amount: <input name="amount"></p>
        <p><input name="submit" type="submit" value="Add This Product"></p>
    </fieldset>
</form>


<!-- Products table -->

<table class="table">
    <thead>
    <tr>
        <?php
        $i = 1;
        foreach ($newArray as $value) {
            if($i > 1) continue; // will use for ist iteration only.
            foreach ($value as $key => $Fvalue ) {
                echo "<th scope='col'>".$key." </br ></th>"; // will print headings
            }
            $i++;
        }
        ?>
    </tr>
    </thead>
    <tbody>

    <?php
    foreach ($newArray as $value) {
        echo '<tr>';
        foreach ($value as $key => $Fvalue) {

            $remove = $value['Action'] = " REMOVE";
            if($value[$key] == $value['Action']) {
                echo '<td data-id="'.$Fvalue.'">' . '<a href="remove.php?remove_id='.$Fvalue.'">' . $remove . '</a>' . '<a href="update.php?update_id='.$Fvalue.'&name_val='.$value['name'].'&price='.$value['price'].' &amount='.$value['amount'].'">' . ' | EDIT' . '</a>' . '</td>';  // will show all values.
            } else {
                echo '<td data-editable>' . $Fvalue . '</td>';
            }
        }
        echo '</tr>';
    }
    ?>
    </tbody>