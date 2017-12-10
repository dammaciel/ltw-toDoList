<?php
include_once('includes/init.php');
include_once('pages/common/header.php');
 ?>

            <label><b><?php echo $_SESSION["ERROR"];?></b></label>
            <button onclick="goBack()">OK</button>

<?php
include_once('pages/common/footer.php');
?>