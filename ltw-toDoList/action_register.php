<?php
include_once('database/users.php');
$username = htmlspecialchars($_POST['username']);
$password = htmlspecialchars($_POST['password']);
$r_password = htmlspecialchars($_POST['r_password']);
$fullname = htmlspecialchars($_POST['fullname']);
$email = htmlspecialchars($_POST['email']);
$date = htmlspecialchars($_POST['birthDate']);
$gender = htmlspecialchars($_POST['gender']);

if ($_SESSION['signup-token'] !== $_POST['signup-token']) {
    header('HTTP/1.0 403 Forbidden');
    die();
}
$_SESSION['token'] = generate_random_token();

if (!usernameAlreadyExists($username)) {
    if($password==$r_password){
    signUp($username, $fullname, $email, $date, $password, $gender);
    }else{
        $_SESSION["ERROR"] = "Passwords don't match!";
        header("location:../error.php");
    }
} else {
    $_SESSION["ERROR"] = "Choose a different username please";
    header("location:../error.php");
}

?>
