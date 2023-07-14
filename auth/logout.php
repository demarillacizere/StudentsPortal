<?php
session_destroy();
session_start();
unset($_SESSION['user']);
unset($_SESSION['auth']);
$_SESSION["success"] = "Logged out Successfully";
header('Location: /index.php');

?>