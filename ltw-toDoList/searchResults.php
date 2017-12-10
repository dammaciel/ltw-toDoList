<?php
include_once('database/listUtils.php');
include_once('database/users.php');
include_once('includes/init.php');

include_once('pages/common/header.php');


$searchList = [];
$type = htmlspecialchars($_POST['type']);
$search = htmlspecialchars($_POST['search']);
$color = htmlspecialchars($_POST['color']);
$category = htmlspecialchars($_POST['category']);

if (!empty($search)) {
    if ($type == "lists") {
        $lists = getLists();
        foreach ($lists as $list) {
            if (isPublic($list["user_id"], $list["id"]) || getUserInfoByUserName($_SESSION['login-user'], 'id') == isCoOwnwer(getUserInfoByUserName($_SESSION['login-user'], 'id'), $list["id"])) {
                $s1 = strtolower($list['title']);
                $s2 = strtolower($search);
                if (strpos($s1, $s2) !== false) {
                    if (($color == $list['color_id'] || $color == '*') && ($category == $list['category_id'] || $category == '*')) {
                        array_push($searchList, $list);
                    }
                }
            }
        }
    } else if ($type == "items") {
        $items = getItems();
        foreach ($items as $item) {
            $s1 = strtolower($item['title']);
            $s2 = strtolower($search);
            if (strpos($s1, $s2) !== false) {
                if ($color == $item['color_id'] || $color == '*') {
                    array_push($searchList, $item);
                }
            }
        }

    } else {
        $users = getUsers();
        foreach ($users as $user) {
            $u1 = strtolower($user['username']);
            $u2 = strtolower($search);
            $e1 = strtolower($user['email']);
            if (!empty($search)) {
                if ((strpos($u1, $u2) !== false) || (strpos($e1, $u2) !== false)) {
                    array_push($searchList, $user);
                }
            }
        }
    }
}
?>
<button onclick="goBack()">Go Back</button>
<section id="searchResults">
    <h2>Results</h2>
    <?php if (!empty($searchList)) { ?>
        <ul>
            <?php if (!($type == "users")) {
                foreach ($searchList as $rlist) { ?>
                    <li><a href="index.php?id=<?= $rlist['id'] ?>"><?= $rlist['title'] ?></a></li>
                <?php }
            } else {
                foreach ($searchList as $rlist) { ?>
                    <li><a href="index.php?id=<?= $rlist['id'] ?>"><?= $rlist['username'] ?></a></li>
                <?php }
            } ?>
        </ul>
    <?php } else { ?>
        No Results were found
    <?php } ?>
</section>


<?php
include_once('pages/common/footer.php');
?>
