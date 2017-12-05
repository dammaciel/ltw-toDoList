<?php
include_once ('listUtils.php');

$task = htmlspecialchars($_POST['task']);
$date = htmlspecialchars($_POST['dateDue']);
$list = htmlspecialchars($_POST['list']);

if($task && $date){
    $item= addItemToList($task, $date, $list);
    associateItemList($item, $list);
}