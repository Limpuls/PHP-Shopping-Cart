<?php
require_once('navigation.php');
require_once('database_connection.php');
?>

<form action="register.php" method="POST">
    <h2>Register Form</h2>
    <p>Name</p><input type="text" name="username" class="form-control" required />
    <p>Phone No.</p><input type="number" name="phone_no" class="form-control" required />
    <p>Full Address</p><input type="text" name="address" class="form-control" required />
    <p>Email</p><input type="email" name="email" class="form-control" required />
    <p>Password</p><input type="password" name="pass" class="form-control" required />
    <p>Repeat Password</p><input type="password" name="pass2" class="form-control" required />
    <button type="submit" class="btn btn-primary">Submit</button>
</form>

<?php
    $usrn = isset($_POST["username"]);
    $phone = isset($_POST["phone_no"]);
    $address = isset($_POST["address"]);
    $email = isset($_POST["email"]);
    $pswrd = isset($_POST["pass"]);
    $pswrd2 = isset($_POST["pass2"]);


    if (isset($_POST['username']) && isset($_POST['pass'])) {
        if (!preg_match("/^[a-zA-Z]/", $usrn)) {
            echo "name only accepts alphabetical characters!";
        } else if (!preg_match("/[0-9]{8}/", $phone)) {
            echo "Phone no must be numeric and consist of 8 characters!";
        } else if (!preg_match("/[a-zA-Z0-9,]\s/", $address)) {
            echo "Address only accepts alphabetical and numeric characters, commas and white spaces!";
        } else  if ($pswrd != $pswrd2) {
            echo "Password doesn't match!";
        } else {
                $hashedPass = password_hash($pswrd, PASSWORD_DEFAULT);
                $query = "INSERT INTO users (name, phone_no, address, email, password, type) VALUES ('$usrn', '$phone', '$address', '$email', '$hashedPass', '0')";
                $res = mysqli_query($dbc, $query);
                mysqli_query($dbc, $query);
                if (!$res) {
                    echo mysqli_error($dbc);
                } else {
                    echo "registered";
                    header('Location: login.php');
                }
            }
        }

?>