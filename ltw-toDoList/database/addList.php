<?php
include_once ('listUtils.php');
$share = htmlspecialchars($_POST['share']);

if(isset($_POST["accept"])) {
    $listTitle = htmlspecialchars($_POST['title']);
    $category = htmlspecialchars($_POST['category']);
    $color = htmlspecialchars($_POST['color']);
    $isPublic = htmlspecialchars($_POST['isPublic']);
    $username = htmlspecialchars($_SESSION['login-user']);
    $list = htmlspecialchars($_POST['list']);

    if (empty($list)) {
        if ($listTitle && $category) {
            $list = addListToUser($username, $listTitle, $category, $color);
            associateUserList($list, getIdByUserName($username), $isPublic);
        }
    } else {
        associateUserList($list, getIdByUserName($username), $isPublic);
        acceptShare($share);
    }
}else if (isset($_POST["reject"])){
    rejectShare($share);
}