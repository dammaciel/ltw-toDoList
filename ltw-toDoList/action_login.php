<?php
include_once('database/users.php');

$username = htmlspecialchars($_POST['username']);
$password = htmlspecialchars($_POST['password']);

login($username,$password);