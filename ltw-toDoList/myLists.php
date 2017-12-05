<?php
if (isset($_GET['id'])) {
$id = $_GET['id'];
$items = getItemsByListID($id);
        ?>

    <section id="listItems">
    <h2>Items</h2>
    <button class="createAccount-button" id="btnCreateItem" onclick="visibleCreateItem()">New Item</button>
    <ul>
        <?php foreach ($items as $item) { ?>
        <li><?= getItemInfoById($item['item_id'], 'title')?></li>
    <?php } ?>
    </ul>
    </section>

    <div id="createItem-form" class="modal">
        <!-- Modal content -->
        <div class="modal-content">
            <h1>Create List</h1>
            <form class="addList" action="database/addItem.php" method="post">
                <input type="hidden" name="token" id="token" value="<?php echo $_SESSION['token']; ?>"/>
                <label><b>List</b></label>
                <input type="hidden" name="list" value="<?php echo $id; ?>" readonly>
                <label><b>Task</b></label>
                <input type="text" name="task"  maxlength="100" placeholder="List Title"><br>

                <label><b>Date Due</b></label>
                <input type="date" name="dateDue">
                <input type="submit" value="Create Item">
                <button type="button" onclick="exitCreateItem()">Cancel</button>
            </form>
        </div>
    </div>
    <?php
}else{
?>

<section id="myLists">
    <h2>Lists</h2>
    <button class="createAccount-button" id="btnCreateList" onclick="visibleCreateList()">New List</button>
    <ul>
        <?php foreach ($lists as $list) { ?>
            <li><a href="index.php?id=<?=$list['id']?>"><?=$list['title']?></a> - <?= getCategoryNameById($list['category_id'])?></li>
        <?php } ?>
    </ul>
</section>


<div id="createList-form" class="modal">
    <!-- Modal content -->
    <div class="modal-content">
        <h1>Create List</h1>
        <form class="addList" action="database/addList.php" method="post">
            <input type="hidden" name="token" id="token" value="<?php echo $_SESSION['token']; ?>"/>
            <label><b>Title</b></label>
            <input type="text" name="title"  maxlength="100" placeholder="List Title"><br>
            <label><b>Category</b></label>
            <select name="category">
                <?php foreach ($categories as $category) { ?>
                <option value="<?=$category['id']?>"><?=$category['name']?></option>
                <?php } ?>
            </select>
            <input type="submit" value="Create">
            <button type="button" onclick="exitCreateList()">Cancel</button>
        </form>
    </div>
</div>

<?php } ?>