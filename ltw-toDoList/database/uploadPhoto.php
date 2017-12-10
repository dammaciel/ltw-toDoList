<?php
include_once ('users.php');

$id = getUserInfoByUserName($_SESSION['login-user'],'id');
$photo_name = 'photo'.$id.'.jpg';
$target_dir = "../assets/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        $uploadOk = 1;
    } else {
        $uploadOk = 0;
        $_SESSION["ERROR"] = "Something went wrong. Choose another photo please";
        header("location:../error.php");
        exit();
    }
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    $uploadOk = 0;
    $_SESSION["ERROR"] = "Image size to large";
    header("location:../error.php");
    exit();
}


if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
    echo $imageFileType;
    $uploadOk = 0;
    $_SESSION["ERROR"] = $imageFileType." is not compatible";
    header("location:../error.php");
    exit();
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 1) {

    move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_dir.$photo_name);
}

uploadUserPhoto($_SESSION['login-user']);

header('Location: ../myProfile.php');

?>
