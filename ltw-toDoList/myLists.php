<?php
if (isset($_GET['id']) && ((isCoOwnwer(getIdByUserName($_SESSION['login-user']), $_GET['id']))|| isShared($_GET['id'],getIdByUserName($_SESSION['login-user'])))) {

    $id = $_GET['id'];
    $items = getItemsByListID($id);
    $users = getUsersOfList($id);
    ?>
    <button onclick="goBack()">Go Back</button>
    <section id="listItems">
        <h2>Items</h2>
        <button class="createAccount-button" id="btnCreateItem" onclick="visibleCreateItem()">New Item</button>
        <ul>
            <?php foreach ($items as $item) { ?>
                <li><?= getItemInfoById($item['item_id'], 'title');?> - <?= getItemInfoById($item['item_id'], 'dataDue');?> - <?= getUsernameById(isAssignedTo($item['item_id'], $id))?>  - <?=  getColorNameById(getItemInfoById($item['item_id'], 'color_id'));?></li>
                <?php if (isAssignedTo($item['item_id'], $id) == getIdByUserName($_SESSION['login-user'])) {
                    if (!getItemInfoById($item['item_id'], 'completed')) { ?>
                        <form class="checkList<?= $item['item_id']; ?>" action="database/checkItem.php" method="post">
                            <input type="hidden" name="id" value="<?php echo $item['item_id']; ?>">
                            <input type="hidden" name="list" value="<?php echo $id; ?>">
                            <input type="submit" value="Complete">
                        </form>
                    <?php } else {
                        ?> completed<?php }
                }else{
            if (getItemInfoById($item['item_id'], 'completed')) {
                    ?>done <?php
            }
                }
            } ?>
        </ul>
    </section>

    <div id="createItem-form" class="modal">
        <!-- Modal content -->
        <div class="modal-content">
            <h1>Create List</h1>
            <form class="addList" action="database/addItem.php" method="post">
                <label><b>List</b></label>
                <input type="hidden" name="list" value="<?php echo $id; ?>" readonly>
                <label><b>Task</b></label>
                <input type="text" name="task" maxlength="100" placeholder="List Title" required><br>

                <label><b>Date Due</b></label>
                <input type="date" name="dateDue" required>
                <label><b>Color</b></label>
                <select name="color" required>
                    <?php foreach ($colors as $color) { ?>
                        <option value="<?= $color['id'] ?>"><?= $color['name'] ?></option>
                    <?php } ?>
                </select>
                <label><b>Assign to:</b></label>
                <select name="assignedTo" required>
                    <?php foreach ($users as $user) { ?>
                        <option value="<?= $user['user_id'] ?>"><?= getUsernameById($user['user_id']) ?></option>
                    <?php } ?>
                </select>
                <input type="submit" value="Create Item">
                <button type="button" onclick="exitCreateItem()">Cancel</button>
            </form>
        </div>
    </div>
    <?php
} else {
    ?>

    <section id="myLists">
        <h2>Lists</h2>
        <button class="createAccount-button" id="btnCreateList" onclick="visibleCreateList()">New List</button>
        <ul>
            <?php foreach ($lists as $list) {
                $list = getListById($list['list_id']) ?>
                <li><a href="index.php?id=<?= $list['id'] ?>"><?= $list['title'] ?></a>
                    - <?= getCategoryNameById($list['category_id']) ?></li>
                <form class="removeList" action="database/removeList.php" method="post">
                    <input type="hidden" name="list" value="<?php echo $list['id']; ?>" readonly>
                    <input type="submit" value="Remove">
                </form>
            <?php } ?>
        </ul>
    </section>


    <div id="createList-form" class="modal">
        <!-- Modal content -->
        <div class="modal-content">
            <h1>Create List</h1>
            <form class="addList" action="database/addList.php" method="post">
                <label><b>Title</b></label>
                <input type="text" name="title" maxlength="100" placeholder="List Title" required><br>
                <label><b>Category</b></label>
                <select name="category" required>
                    <?php foreach ($categories as $category) { ?>
                        <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
                    <?php } ?>
                </select>
                <select name="color" required>
                    <?php foreach ($colors as $color) { ?>
                        <option value="<?= $color['id'] ?>"><?= $color['name'] ?></option>
                    <?php } ?>
                </select>
                <select name="isPublic" required>
                    <option value="0">Private</option>
                    <option value="1">Public</option>
                </select>
                <input type="submit" value="Create" name="accept">
                <button type="button" onclick="exitCreateList()">Cancel</button>
            </form>
        </div>
    </div>

<?php }?>