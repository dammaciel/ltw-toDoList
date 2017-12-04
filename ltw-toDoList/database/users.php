<?php
include_once('includes/init.php');

function createUser($username, $password, $email, $name) {
    global $db;
    $statement = $db->prepare('INSERT INTO Users VALUES(NULL, ?, ?, ?, ?, NULL, NULL, NULL)');
    $statement->execute([$username, $password, $email, $name]);
    return $statement->errorInfo();
}

function isLoginCorrect($username, $password) {
    global $db;
    $stmt = $db->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
    $stmt->execute(array($username, sha1($password)));
    return $stmt->fetch() !== false;
}

function usernameAlreadyExists($username){
    global $db;
    $statement = $db->prepare('SELECT * FROM users WHERE username = ?');
    $statement->execute(array($username));
    return $statement->fetch();
}

function validatePassword($password){
    if(strlen($password) >= 6)
        return true;
    return false;
}

function signUp($username,$fullname,$date,$password,$gender){
    global $db;
    if(strtoupper($gender)=='FEMALE')
        $photo = 'photo0F.jpg';
    else $photo = 'photo0.jpg';
    $statement = $db->prepare('INSERT INTO users (username,fullname,birthDate,photoId,gender,password) VALUES (?,?,?,?,?,?)');
    if($statement->execute([$username,$fullname,$date,$photo,$gender,password_hash($password, PASSWORD_DEFAULT)])){
        $_SESSION['login-user']=$username;
        unset($_SESSION["ERROR"]);
        header("location:../index.php");
        exit();
    }
    else{
        $_SESSION["ERROR"] = "Error on sign Up";
    }
}

function login($username, $password) {
    global $db;
    $statement = $db->prepare('SELECT id,password,fullName FROM users WHERE username = ? ');
    $statement->execute([$username]);
    $result = $statement->fetch(PDO::FETCH_ASSOC);
    $hashed_password = $result['password'];
    if(password_verify($password, $hashed_password)){
        $_SESSION['login-user']=$username;
        unset($_SESSION["ERROR"]);
        header("location:../index.php");
        exit();
    }
    else {
        $_SESSION["ERROR"] = "Incorrect Password or Username, try again!";
        header("Location:".$_SERVER['HTTP_REFERER']."");
        exit();
    }
}


function generate_random_token() {
    $token = bin2hex(openssl_random_pseudo_bytes(16));
    return $token;
}

function getIdByUserName($userName){
    global $db;
    $statement = $db->prepare('SELECT id FROM users WHERE username = ? ');
    $statement->execute([$userName]);
    return $statement->fetch()['id'];
}

function getUserInfoByUserName($username,$info){
    if($info == 'password')
        return null;

    global $db;
    $statement = $db->prepare('SELECT * FROM users WHERE username = ? ');
    $statement->execute([$username]);

    return $statement->fetch()[$info];
}
?>
