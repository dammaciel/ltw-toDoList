<?php
include_once ('users.php');

function addListToUser($username, $listTitle, $category, $color)
{
        $id = getUserInfoByUserName($username, 'id');

        global $db;

        $statement = $db->prepare('INSERT INTO lists (title, category_id, color_id, user_id) VALUES (?,?,?,?)');

        if ($statement->execute([$listTitle, $category, $color, $id])) {
            header("location:../index.php");
            return $db->lastInsertId();
        }
        return false;
}

function getLists(){
    global $db;

    $statement = $db->prepare('SELECT * FROM lists');
    $statement->execute([]);

    return  $statement->fetchAll();
}

function getItems(){
    global $db;

    $statement = $db->prepare('SELECT * FROM items');
    $statement->execute([]);

    return  $statement->fetchAll();
}

function getUserLists($username)
{
        $id = getUserInfoByUserName($username, 'id');

        global $db;

        $statement = $db->prepare('SELECT * FROM user_list WHERE user_id = ? ');
        $statement->execute([$id]);

    return  $statement->fetchAll();
}

function getListById($id){
    global $db;
    $statement = $db->prepare('SELECT * FROM lists WHERE id = ? ');
    $statement->execute([$id]);

    return $statement->fetch();
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

function getColors(){
    global $db;

    $statement = $db->prepare('SELECT * FROM colors');
    $statement->execute();

    return  $statement->fetchAll();
}

function getColorNameById($id){
    global $db;

    $statement = $db->prepare('SELECT * FROM colors WHERE id = ?');
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

function addItemToList($task, $date, $color)
{
    global $db;
    $statement = $db->prepare('INSERT INTO items (title, dataDue, color_id, completed) VALUES (?,?,?,?)');
    if ($statement->execute([$task, $date, $color, 0])) {
        return $db->lastInsertId();
    }
    return false;
}

function associateItemList($item, $list, $user){
    global $db;
    $statement = $db->prepare('INSERT INTO list_items (list_id, item_id, user_id) VALUES (?,?,?)');
    if ($statement->execute([$list, $item, $user])) {
        header("location:../index.php");
        return true;
    }
    return false;
}

function associateUserList($list,$user, $isPublic){
    global $db;
    $statement = $db->prepare('INSERT INTO user_list (list_id, user_id, isPublic) VALUES (?,?,?)');
    if ($statement->execute([$list, $user,  $isPublic])) {
        header("location:../index.php");
        return true;
    }
    return false;
}

function checkItem($id){
    global $db;
    $statement = $db->prepare('UPDATE items SET completed = ? WHERE id = ?');
    if($statement->execute([1,$id])){
        header("location:../index.php");
        return true;
    }
    return false;
}

function shareList($from, $to, $list){
    global $db;
    $statement = $db->prepare('INSERT INTO shares (list_id, from_user_id, to_user_id, accepted) VALUES (?,?,?,?)');
    if($statement->execute([$list,$from, $to, 0])){
        header("location:../index.php");
        return true;
    }
    return false;
}

function getSharesByUser($id){
    global $db;

    $statement = $db->prepare('SELECT * FROM shares WHERE to_user_id = ? AND accepted = ?');
    $statement->execute([$id, 0]);

    return  $statement->fetchAll();
}

function acceptShare($id){
    global $db;
    $statement = $db->prepare('UPDATE shares SET accepted = ? WHERE id = ?');
    if($statement->execute([1,$id])){
        return true;
    }
    return false;
}

function rejectShare($id){
    global $db;
    $statement = $db->prepare('DELETE FROM shares WHERE id= ?');
    if($statement->execute([$id])){
        header("location:../index.php");
        return true;
    }
    return false;
}

function isPublic($user, $list){
    global $db;

    $statement = $db->prepare('SELECT isPublic FROM user_list WHERE list_id = ? AND user_id= ?');
    $statement->execute([$list, $user]);

    return $statement->fetch()['isPublic'];
}

function isCoOwnwer($user, $list){
    global $db;

    $statement = $db->prepare('SELECT * FROM user_list WHERE list_id = ? AND user_id= ?');
    $statement->execute([$list, $user]);

    return $statement->fetch()['user_id'];
}

function removeListUser($list, $user){
    global $db;
    $statement = $db->prepare('DELETE FROM user_list WHERE list_id = ? AND user_id= ?');
    if($statement->execute([$list, $user])){
        header("location:../index.php");
        return true;
    }
    return false;
}

function getUsersOfList($list){
    global $db;

    $statement = $db->prepare('SELECT * FROM user_list WHERE list_id = ? ');
    $statement->execute([$list]);

    return  $statement->fetchAll();
}

function isAssignedTo($item, $list){
    global $db;

    $statement = $db->prepare('SELECT user_id FROM list_items WHERE item_id = ? AND list_id = ? ');
    $statement->execute([$item, $list]);

    return $statement->fetch()['user_id'];
}

function isShared($list, $user){
    global $db;

    $statement = $db->prepare('SELECT * FROM shares WHERE list_id = ? AND to_user_id = ?');
    $statement->execute([$list, $user]);

    return  $statement->fetch()["to_user_id"];
}