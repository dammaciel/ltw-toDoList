<?php
include_once('database/users.php');
include_once('includes/init.php');

include_once('pages/common/header.php');
if (isset($_SESSION['login-user'])) {
if (!isset($_GET['edit'])) {
    $photoUser = getUserInfoByUserName($_SESSION['login-user'], 'photoId');
    $srcPhoto = '../assets/' . $photoUser;?>

    <section id="profile">
        <h2>Profile</h2>
        <ul>
            <img class="img-item" src="<?php echo $srcPhoto ?>"><br>
            <form class="uploadPhotoProfile" action="database/uploadPhoto.php" method="post"
                  enctype="multipart/form-data">
                <input type="hidden" name="token" id="token" value="<?php echo $_SESSION['token']; ?>"/>
                <input type="file" name="fileToUpload" id="fileToUpload" value="Select image to upload:"><br>
                <input type="submit" value="Upload Image" name="submit">
            </form>
            <label>Username:</label>
            <label><?= $_SESSION['login-user'] ?></label><br>

            <label>Full Name: </label>
            <label><?= getUserInfoByUserName($_SESSION['login-user'], 'fullName') ?></label><br>

            <label>Email: </label>
            <label><?= getUserInfoByUserName($_SESSION['login-user'], 'email') ?></label><br>

            <label>Birth Date: </label>
            <label><?= getUserInfoByUserName($_SESSION['login-user'], 'birthDate') ?></label><br>

            <label>Gender: </label>
            <label><?= getUserInfoByUserName($_SESSION['login-user'], 'gender') ?></label><br>

            <label>Password: </label>
            <label>Change Password</label><br>

            <a href='myProfile.php?edit=true'>Edit Profile</a>
        </ul>
    </section>

    <?php
}else{?>
    <section id="profile">
        <h2>Edit Profile</h2>
        <form class="editProfile" action="database/editProfile.php" method="post">
        <ul>
            <input type="hidden" name="id" value="<?= getUserInfoByUserName($_SESSION['login-user'], 'id') ?>">
            <label>Username:</label>
            <input  type="text" name="username" placeholder="Username" value="<?= $_SESSION['login-user'] ?>" required><br>

            <label>Full Name: </label>
            <input  type="text" name="fullName" placeholder="Full Name" value="<?= getUserInfoByUserName($_SESSION['login-user'], 'fullName') ?>" required><br>

            <label>Email: </label>
            <input  type="text" name="email" placeholder="Email" value="<?= getUserInfoByUserName($_SESSION['login-user'], 'email') ?>" required ><br>

            <label>Birth Date: </label>
            <input  type="date" name="birthDate" value="<?= getUserInfoByUserName($_SESSION['login-user'], 'birthDate') ?>" required><br>

            <label><b>Password</b></label>
            <input id="myPassword" type="password" name="password" value="" minlength="6"><br>
            <label><b>Repeat Password</b></label>
            <input id="r_myPassword" type="password" name="r_password" value="" minlength="6"><br>
            <label>Change Password</label><br>

            <input type="submit" value="Save Changes">
        </ul>
        </form>
    </section>
<?php
}
}
include_once('pages/common/footer.php');
?>
