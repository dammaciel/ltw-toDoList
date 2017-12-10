<?php
include_once('database/users.php');
include_once('database/listUtils.php');
include_once('includes/init.php');

include_once('pages/common/header.php');
if (isset($_SESSION['login-user'])) {
    $id = getUserInfoByUserName($_SESSION['login-user'], 'id');
    $lists = getUserLists($_SESSION['login-user']);
    $shares = getSharesByUser($id);
?>

<section id="myShares">
    <h2>Shared with me</h2>
    <ul>
        <?php foreach ($shares as $list) { ?>
            <li><a href="index.php?id=<?=$list?>"><?=getListInfoById($list['list_id'], 'title')?></a> - by <?= getUsernameById($list['from_user_id'])?></li>
            <form action="database/addList.php" method="post">
                <input type="hidden" name="username" value="<?php echo $_SESSION['login-user']; ?>" readonly>
                <input type="hidden" name="list" value="<?php echo $list['list_id']; ?>" readonly>
                <input type="hidden" name="share" value="<?php echo $list['id']; ?>" readonly>
                <select name="isPublic">
                    <option value="0">Private</option>
                    <option value="1">Public</option>
                </select>
                <input type="submit" value="Accept" name="accept">
                <input type="submit" value="Reject" name="reject">
            </form>
        <?php } ?>
    </ul>
</section>

<section id="shareWith">
    <h2>Share Lists</h2>
    <form class="search" action="database/shareList.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $id; ?>" readonly>
        <label>Username:</label>
            <input type="text" name="username" placeholder="username" required><br>
        <label>List:</label>
        <select name="list" required>
            <?php foreach ($lists as $list) { $list=getListById($list['list_id']) ?>
                <option value="<?=$list['id']?>"><?=$list['title']?></option>
            <?php } ?>
        </select>
        <input type="submit" value="Share">
    </form>
</section>
<?php
}

include_once('pages/common/footer.php');
?>