<?php
include_once(__DIR__ .'/../includes/init.php');

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

function signUp($username,$fullname,$email, $date,$password,$gender){
    global $db;
    if(strtoupper($gender)=='FEMALE')
        $photo = 'female.png';
    else $photo = 'male.png';
    $statement = $db->prepare('INSERT INTO users (username,fullname,email,birthDate,photoId,gender,password) VALUES (?,?,?,?,?,?,?)');
    if($statement->execute([$username,$fullname,$email,$date,$photo,$gender,password_hash($password, PASSWORD_DEFAULT)])){
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
        header("location:../error.php");
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

function getUsernameById($id){
    global $db;
    $statement = $db->prepare('SELECT username FROM users WHERE id = ? ');
    $statement->execute([$id]);
    return $statement->fetch()['username'];
}

function getUserInfoByUserName($username,$info){
    if($info == 'password')
        return null;

    global $db;
    $statement = $db->prepare('SELECT * FROM users WHERE username = ? ');
    $statement->execute([$username]);

    return $statement->fetch()[$info];
}

function updateProfile($id, $username, $fullname, $email, $birthDate){
    global $db;
    $statement = $db->prepare('UPDATE users SET username = ?, fullName= ?, email=?, birthDate=? WHERE id = ?');
    if($statement->execute([$username, $fullname, $email, $birthDate, $id])){
        $_SESSION['login-user']=$username;
        return true;
    }
    return false;
}

function changePassword($password, $id){
    global $db;
    $statement = $db->prepare('UPDATE users SET password= ? WHERE id = ?');
    if($statement->execute([password_hash($password, PASSWORD_DEFAULT), $id])){
        return true;
    }
    return false;
}

function getUsers(){
    global $db;

    $statement = $db->prepare('SELECT * FROM users');
    $statement->execute([]);

    return  $statement->fetchAll();
}

function uploadUserPhoto($username){
    global $db;
    $idPhoto = 'photo'.getUserInfoByUserName($username,'id').'.jpg';
    $statement = $db->prepare('UPDATE users SET photoId = ? WHERE username = ?');
    $statement->execute([$idPhoto,$username]);
    return $statement->errorCode();
}

?>
