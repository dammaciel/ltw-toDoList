<?php
include_once('database/listUtils.php');
include_once('database/users.php');
include_once('includes/init.php');

include_once('pages/common/header.php');
$categories = getCategories();
$colors = getColors();
?>
<section id="search">
    <h2>Search</h2>
    <form class="search" action="searchResults.php" method="post">
        <label>Search:</label>
        Lists<input type="radio" onclick="listOrItemCheck();" name="type" id="searchList" value="lists" required/>
        Items<input type="radio" onclick="listOrItemCheck();" name="type" id="searchItem" value="items" required/>
        Users<input type="radio" onclick="listOrItemCheck();" name="type" id="searchUser" value="users" required/>
        <div id="ifAny" style="display:none">
            <input type="text" name="search" placeholder="searching for ..." value="" required><br>
        </div>
        <div id="ifItems" style="display:none">
            <div id="ifLists">
                <label><b>Category</b></label>
                <select name="category">
                    <option value="*">All</option>
                    <?php foreach ($categories as $category) { ?>
                        <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
                    <?php } ?>
                </select>
            </div>
            <label><b>Color</b></label>
            <select name="color">
                <option value="*">All</option>
                <?php foreach ($colors as $color) { ?>
                    <option value="<?= $color['id'] ?>"><?= $color['name'] ?></option>
                <?php } ?>
            </select>
        </div>
        <input type="submit" value="Search">
    </form>
</section>

<?php
include_once('pages/common/footer.php');
?>
