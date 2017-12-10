<?php
include_once ('listUtils.php');

$list = htmlspecialchars($_POST['list']);

removeListUser($list, getIdByUserName($_SESSION['login-user']));