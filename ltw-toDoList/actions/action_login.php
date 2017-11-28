<?php
include_once('../includes/session.php');
include_once('../database/connection.php');
include_once('../database/user.php');

  if (isLoginCorrect($_POST['username'], $_POST['password'])) {
    setCurrentUser($_POST['username']);
  }

  header('Location: ' . $_SERVER['HTTP_REFERER']);
?>
