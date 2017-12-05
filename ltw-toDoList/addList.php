<?php
include_once ('pages/common/header.php');
include_once('includes/init.php');
$_SESSION['token'] = generate_random_token();

?>

<form class="addList" action="database/addList.php" method="post">
    <input type="hidden" name="token" id="token" value="<?php echo $_SESSION['token']; ?>"/>
    <ul>
        <div class="container">
            <li>
                <label for="Title">Title</label>
                <input type="text" name="title"  maxlength="100" placeholder="List Title"><br>
                <span> List Name</span>
            </li>
        </div>
        <div class="container">
            <li>
                <input type="submit" value="Save Changes">
                <input action="action" type="button" value="Back" onclick="window.history.go(-1); return false;" />
            </li>
        </div>
</form>

<?php include_once('pages/common/footer.php'); ?>

