<?php
include_once ('database/users.php');
$_SESSION['signup-token'] = generate_random_token();

include_once('includes/init.php');

include_once('pages/common/header.php');

include_once('pages/common/footer.php');
?>
