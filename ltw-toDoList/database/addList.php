<?php
include_once ('listUtils.php');

$listTitle = htmlspecialchars($_POST['title']);
$category = htmlspecialchars($_POST['category']);
$username = htmlspecialchars($_SESSION['login-user']);


if($listTitle && $category){
    addListToUser($username, $listTitle, $category);
}