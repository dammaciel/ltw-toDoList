<?php
include_once('includes/init.php');
include_once ('users.php');

function addListToUser($username, $listTitle)
{
    if (strtoupper(getUserInfoByUserName($username, 'type')) == 'OWNER') {
        $id = getUserInfoByUserName($username, 'id');

        global $db;

        $statement = $db->prepare('INSERT INTO lists (title, category_id, color, user_id) VALUES (?,?,?,?)');

        if ($statement->execute([$listTitle, NULL, NULL, $id])) {
            return true;
        }
        return false;
    }
}