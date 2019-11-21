<?php include '../view/header.php'; ?>

<main class="register">
    <form action="index.php" method="post">
        <input type="hidden" name="action" value="user_register"

        <label>First Name</label>
        <input id="register_firstname" type="text" name="firstName"><br>

        <label>Last Name</label>
        <input id="register_lastname" type="text" name="lastName"><br>

        <label>Birthday</label>
        <input id="register_birthday"type="date" name="birthday"><br>

        <label>Email</label>
        <input id="register_email"type="text" name="email"><br>

        <label>Password</label>
        <input id="register_password"type="password" name="password"><br>

        <label>Submit</label>
        <input id="register_submit"type="submit" class="button" value="Register"><br>

    </form>

    <form id="register_login" action="../login/" method="post">
        <input type="submit" value="Back to Login" />
    </form>

</main>

<?php include '../view/footer.php'; ?>
