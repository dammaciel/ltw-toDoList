<?php
include_once('users.php');

$id = htmlspecialchars($_POST['id']);
$username = htmlspecialchars($_POST['username']);
$fullname = htmlspecialchars($_POST['fullName']);
$email = htmlspecialchars($_POST['email']);
$date = htmlspecialchars($_POST['birthDate']);
$password = htmlspecialchars($_POST['password']);
$r_password = htmlspecialchars($_POST['r_password']);


$_SESSION['token'] = generate_random_token();

    if(!usernameAlreadyExists($username) || $_SESSION['login-user']==$username) {
            updateProfile($id, $username, $fullname, $email, $date);
        if (isset($password) && $password==$r_password) {
            changePassword($password, $id);
        }else{
            $_SESSION["ERROR"] = "Passwords don't match!";
            header("location:../error.php");
            exit();
        }
        header("location:../myProfile.php");

    }else{
        $_SESSION["ERROR"] = "Choose a different username please";
        header("location:../error.php");
    }
