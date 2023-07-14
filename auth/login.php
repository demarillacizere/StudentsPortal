<?php 
require_once "../back-end/database.php";
session_start();

if (!empty($_POST)) {
if (isset($_POST['login']) ) {
    session_start();
    $email = trim(htmlspecialchars($_POST["email"]));  // is depecrated use htmlspecialchars instead
    $password = trim(htmlspecialchars($_POST["password"]));
    if(login($email, $password)){
        $_SESSION["auth"] = true;
        $_SESSION["success"] = "Logged in Successfully";
        header("Location: /admin.php");
    }else{
        $_SESSION["error"] = "Invalid username or password.";
        header("Location: /login.php");
    }
    
}

}
?>