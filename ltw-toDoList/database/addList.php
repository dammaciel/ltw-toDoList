<?php
include_once('includes/init.php');
include_once ('listUtils.php');

$listTitle = htmlspecialchars($_POST['title']);
$username = htmlspecialchars($_SESSION['login-user']);

if ($_SESSION['csrf'] !== $_POST['csrf']) {
    $_SESSION['ERROR']="ERROR: Request does not appear to be legitimate";
}
else generate_random_token();

if($listTitle){
    addListToUser($username, $listTitle);
}