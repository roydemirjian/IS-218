<?php include '../view/header.php'; ?>

<head>
    <link rel="stylesheet" href="../styles/main.css?v=1.1.7">
</head>

<main class="register">
    <form id="register_form" action="index.php" method="post">
        <input type="hidden" name="action" value="user_register">

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

    <form id="register_login" action="../index.php" method="post">
        <input id="register_back_button" type="submit" value="Back" />
    </form>

</main>

<?php include '../view/footer.php'; ?>
