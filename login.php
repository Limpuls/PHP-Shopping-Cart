<?php
ob_start();
session_start();
require_once('navigation.php');
require_once('database_connection.php');
?>
<form action="login.php" method="POST">
    <h2>Login Form</h2>
    <div class="form-group">
    <p>Name</p><input type="text" name="username" placeholder="Enter Username" class="form-control" />
    <p>Password</p><input type="password" name="pass" placeholder="Enter Password" class="form-control" />
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>

<?php

if(isset($_POST["username"])) {
    $username = $_POST["username"];
    $sql=mysqli_query($dbc, "SELECT * FROM users WHERE name = '".$username."'");
    if (mysqli_num_rows($sql)>=1) {

        $query = "SELECT type FROM users WHERE name = '$username' ";
        $result = mysqli_query($dbc, $query);
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            $user_type = $row['type'];
            $_SESSION['userType'] = $user_type;
            if ($user_type == 1) {
                $_SESSION['user'] = $username;
                echo "admin: " . $username;
            }

            elseif ($user_type == 0) {
                $_SESSION['user'] = $username;
                echo "user: " . $_SESSION['user'];
            }
        } else {
            echo "result fail";
        }

        header('Location: home.php' );
        ob_end_flush();
        echo "user exists";
    } else {
        echo "user does not exist";
    }
}

?>



