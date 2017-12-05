<?php
include_once ('users.php');

function addListToUser($username, $listTitle, $category)
{
        $id = getUserInfoByUserName($username, 'id');

        global $db;

        $statement = $db->prepare('INSERT INTO lists (title, category_id, color, user_id) VALUES (?,?,?,?)');

        if ($statement->execute([$listTitle, $category, NULL, $id])) {
            header("location:../index.php");
            return true;
        }
        return false;
}

function getUserLists($username)
{
        $id = getUserInfoByUserName($username, 'id');

        global $db;

        $statement = $db->prepare('SELECT * FROM lists WHERE user_id = ? ');
        $statement->execute([$id]);

    return  $statement->fetchAll();
}

function getCategories(){
    global $db;

    $statement = $db->prepare('SELECT * FROM categories');
    $statement->execute();

    return  $statement->fetchAll();
}

function getCategoryNameById($id){
    global $db;

    $statement = $db->prepare('SELECT * FROM categories WHERE id = ?');
    $statement->execute([$id]);

    return $statement->fetch()['name'];
}

function getItemsByListID($listId)
{
    global $db;

    $statement = $db->prepare('SELECT * FROM list_items WHERE list_id = ? ');
    $statement->execute([$listId]);

    return  $statement->fetchAll();
}

function getItemInfoById($id,$info){
    global $db;
    $statement = $db->prepare('SELECT * FROM items WHERE id = ? ');
    $statement->execute([$id]);

    return $statement->fetch()[$info];
}

function getListInfoById($id,$info){
    global $db;
    $statement = $db->prepare('SELECT * FROM lists WHERE id = ? ');
    $statement->execute([$id]);

    return $statement->fetch()[$info];
}

function addItemToList($task, $date, $list)
{
    global $db;
    $statement = $db->prepare('INSERT INTO items (title, dataDue, color) VALUES (?,?,?)');
    if ($statement->execute([$task, $date, NULL])) {
        return $db->lastInsertId();
    }
    return false;
}

function associateItemList($item, $list){
    global $db;
    echo $item;
    $statement = $db->prepare('INSERT INTO list_items (list_id, item_id) VALUES (?,?)');
    if ($statement->execute([$list, $item])) {
        header("location:../index.php");
        return true;
    }
    return false;
}
