<?php

function createUser($username, $password, $email, $name) {
    global $db;
    global $USER_GROUP_ID;
    $statement = $db->prepare('INSERT INTO Users VALUES(NULL, ?, ?, ?, ?, ?, NULL, NULL, NULL)');
    $statement->execute([$username, $password, $email, $name, $USER_GROUP_ID]);
    return $statement->errorInfo();
}

function isLoginCorrect($username, $password) {
    global $dbh;
    $stmt = $dbh->prepare('SELECT * FROM user WHERE username = ? AND password = ?');
    $stmt->execute(array($username, sha1($password)));
    return $stmt->fetch() !== false;
}

function usernameAlreadyExists($username){
    global $db;
    $statement = $db->prepare('SELECT * FROM user WHERE username = :username');
    $statement->execute(array(':username' => $username));
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
    $statement = $db->prepare('INSERT INTO users (username,fullname,birthDate,photoId,gender,password) VALUES (?,?,?,?,?,?,?)');
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

?>
