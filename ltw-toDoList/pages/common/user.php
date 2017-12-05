<div id="user">
    <?php if (isset($_SESSION['login-user']) && $_SESSION['login-user'] != '') { ?>
        <form action="../action_logout.php" method="post">
            <?=$_SESSION['login-user']?></a>
            <input type="submit" value="Logout">
        </form>
    <?php } else { ?>
        </form><button class="createAccount-button" id="btnSignIn" onclick="visibleLogin()">Login</button>
        </form><button class="createAccount-button" id="btnCreateAccount" onclick="visibleCreateAcc()">Register</button>
    <?php } ?>

</div>

</div>

<div id="login-form" class="modal">
    <!-- Modal content -->
    <div class="modal-content">
        <h1>Login</h1>
        <form action="../action_login.php" method="post">
            <label><b>Username</b></label>
            <input type="text" name="username" placeholder="UserName">
            <label><b>Password</b></label>
            <input id="myPassword" type="password" name="password" value="">
            <input type="submit" value="Login">
            <button type="button" onclick="exitLogin()">Cancel</button>

        </form>
    </div>
</div>

<div id="createAcc-form" class="modal">
    <!-- Modal content -->
    <div class="modal-content">
        <h1>Sign Up</h1>
        <form action="../action_register.php" method="post">
            <input type="hidden" name="signup-token" value="<?php echo $_SESSION['signup-token']; ?>">
            <label><b>Username</b></label>
            <input type="text" name="username" placeholder="UserName">
            <label><b>Email</b></label>
            <input type="email" name="email" placeholder="Email">
            <label><b>Full Name</b></label>
            <input type="text" name="fullname" placeholder="Full Name">
            <label><b>Gender</b></label>
            <div id="gender">
                <input type="radio" name="gender" value="Male"> Male
                <input type="radio" name="gender" value="Female"> Female
            </div>

            <label><b>Password</b></label>
            <input id="myPassword" type="password" name="password" value="">
            <label><b>Repeat Password</b></label>
            <input id="r_myPassword" type="password" name="r_password" value="">
            <label><b>Birth Date</b></label>
            <input type="date" name="birthDate">
            <input type="submit" value="Register">
            <button type="button" onclick="exitCreateAcc()">Cancel</button>

        </form>
    </div>
</div>

