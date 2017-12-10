<?php
include_once ('listUtils.php');

$task = htmlspecialchars($_POST['task']);
$color = htmlspecialchars($_POST['color']);
$date = htmlspecialchars($_POST['dateDue']);
$list = htmlspecialchars($_POST['list']);
$user = htmlspecialchars($_POST['assignedTo']);

if($task && $date){
    $item= addItemToList($task, $date, $color);
    associateItemList($item, $list, $user);
}