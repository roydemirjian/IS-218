<?php include '../view/header.php'; ?>
<main class="login" >
    <form  action="index.php" method="post" id="login_form">
        <input type="hidden" name="action" value="user_login"

        <label>Email Address</label>
        <input id="login_email"type="text" name="email"><br>

        <label>Password</label>
        <input id="login_password" type="password" name="password" autocomplete="new-password"><br>

        <label>Submit</label>
        <input id="login_submit" type="submit" class="button" value="Login"><br>

    </form>


</main>

<?php include '../view/footer.php'; ?>

