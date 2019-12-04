<?php include 'view/header.php'; ?>
<head>
    <link rel="stylesheet" href="styles/main.css?v=1.2.1">
</head>

<main class = "landing">
    <form id="landing_submit" action="login" method="post">
        <input id="submit_button" type="submit" value="Login" />
    </form>
    <form id="landing_register" action="register" method="post">
        <input id="register_button" type="submit" value="Register" />
    </form>


</main>
<?php include 'view/footer.php'; ?>

