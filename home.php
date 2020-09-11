<?php
session_start();
require_once('navigation.php');
if(isset($_SESSION['user'])) {
    echo $_SESSION['user'];
}
?>
</body>
</html>