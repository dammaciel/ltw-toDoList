<?php
include_once ('database/users.php');
include_once ('database/listUtils.php');
$_SESSION['signup-token'] = generate_random_token();

include_once('includes/init.php');

include_once('pages/common/header.php');

if(isset($_SESSION['login-user'])) {
    $lists = getUserLists($_SESSION['login-user']);
    $categories = getCategories();
    $colors = getColors();
    include_once('myLists.php');
}
include_once('pages/common/footer.php');
?>
