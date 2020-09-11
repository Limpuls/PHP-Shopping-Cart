<?php
session_start();
require_once ("navigation.php");
require_once("database_connection.php");

$id = trim($_GET['update_id'], " ");
$name = trim($_GET['name_val'], " ");
$price = trim($_GET['price'], " ");
$amount = trim($_GET['amount'], " ");

$newName = trim($_POST['product'], " ");

$q = "UPDATE products SET name = '$newName', name = '$price' WHERE id = '$id'";

$result = mysqli_query($dbc, $q);
mysqli_query($dbc, $q);
if(!$result) {
    echo "error";
} else {
    echo "success";
}
?>

<form action="update.php" method="post">
    <fieldset>
        <legend>Edit Product</legend>
        <p>Product name: <input name="product" type="text" size="60" maxlength="100" value="<?php echo $name;?>" required></p>
        <p>Category: <select name="category_id"><?php foreach ($arr as $entry)

                { ?><option value="<?php echo($entry['category_id']);?>"><?php echo $entry['category_name']; ?></option> <?php }?></select></p>
        <p>Price: <input name="price" value="<?php echo $price; ?>"></p>
        <p>Amount: <input name="amount" value="<?php echo $amount; ?>"></p>
        <p><input name="submit" type="submit" value="Edit This Product"></p>
    </fieldset>
</form>