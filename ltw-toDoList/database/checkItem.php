<?php
include_once ('listUtils.php');

$id = htmlspecialchars($_POST['id']);
$list = htmlspecialchars($_POST['list']);

if(checkItem($id)) {
    header("location:../index.php?id=".$list);
}