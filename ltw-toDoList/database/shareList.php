<?php
include_once ('listUtils.php');

$from_id = htmlspecialchars($_POST['id']);
$username = htmlspecialchars($_POST['username']);
$list = htmlspecialchars($_POST['list']);

$to_id=getUserInfoByUserName($username, 'id');

shareList($from_id, $to_id, $list);