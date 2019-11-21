<?php include 'view/header.php'; ?>

<?php
require('../model/database.php');
require('../model/accounts_db.php');
require('../model/questions_db.php');

session_start();

#Check is session is set, if not redirect
if (!isset($_SESSION['logged']) || !$_SESSION['logged']){
    header("Location:login");
}

#Get session data from login
$sesh_email = $_SESSION['email'];
$sesh_password = $_SESSION['password'];

$array = get_user($sesh_email,$sesh_password);
$firstName =  $array[0];
$lastName =  $array[1];

echo '<h1 id="welcome">'. "WELCOME " . $firstName . " " . $lastName . '</h1>';

get_all_questions($sesh_email);


?>

<html>

<head>
    <link rel="stylesheet" href="test.css?v=1.1.4">
</head>

<main class = "test">
    <form id="test_question" action="index.php" method="post">
        <input type="hidden" name="action" value="add_question"
        <input type="submit" value="Submit a new question" />
    </form>

    <form id="test_logout" action="index.php">
        <input type="hidden" name="action" value="user_logout"
        <input id = "logout" type="submit" value="Logout" />
    </form>
</main>



</html>


<?php include 'view/footer.php'; ?>

