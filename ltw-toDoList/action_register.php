<?php
include_once('includes/init.php');
include_once('database/users.php');

$username = htmlspecialchars($_POST['username']);
$password = htmlspecialchars($_POST['password']);
$fullname = htmlspecialchars($_POST['fullname']);
$date = htmlspecialchars($_POST['birthDate']);
$gender = htmlspecialchars($_POST['gender']);

if($username && $password){
    if(!usernameAlreadyExists($username)){
        if(validatePassword($password))
            signUp($username,$fullname,$date,$password,$gender);
        else {
            header("Location:".$_SERVER['HTTP_REFERER']."");
            $_SESSION["ERROR"] = "Password must be at least 6 characters.";
        }
    } else {
        header("Location:".$_SERVER['HTTP_REFERER']."");
        $_SESSION["ERROR"] = "Choose a different email address. This one is not available. If this is you log in now.";
    }
}else{
    header("Location:".$_SERVER['HTTP_REFERER']."");
    $_SESSION["ERROR"] = "You must fill ate least Username and Password Field ! ";}

?>
