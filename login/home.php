<?php include '../view/header.php'; ?>

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

#Get users first and last name
$array = AccountDB::get_user($sesh_email,$sesh_password);
$firstName =  $array[0];
$lastName =  $array[1];

echo '<h1 id="welcome">'. "WELCOME " . $firstName . " " . $lastName . '</h1>';

?>
<link rel="stylesheet" href="../styles/table.css?v=1.2.3">


<main class = "home_buttons">
    <form id="home_question" action="index.php" method="post">
        <input type="hidden" name="action" value="add_question"/>
        <input type="submit" value="Submit a new question" />
    </form>

    <form id="home_logout" action="index.php" method="post">
        <input type="hidden" name="action" value="user_logout"/>
        <input type="submit" value="Logout" />
    </form>

    <form id="user_questions" action="index.php" method="post">
        <input type="hidden" name="action" value="user_questions_home"/>
        <input type="submit" value="User Questions" />
    </form>

    <form id="user_questions" action="index.php" method="post">
        <input type="hidden" name="action" value="all_questions_home"/>
        <input type="submit" value="All Questions" />
    </form>



</main>


<?php

$toggle= $_SESSION['toggle'];

if ($toggle == "all_questions_home"){
    $results = QuestionDB::get_all_questions($sesh_email);
} else {
    $results = QuestionDB::get_all_user_questions($sesh_email);
}




echo "<table id=\"questions_table\" border=\"1\">
      <tr><th>ID</th><th>Email</th><th>Title</th><th>Body</th><th>Skills</th><th>Delete</th><th>Edit</th><th>Reply</th></tr>";
foreach ($results as $result) {
    echo "<form action=\"index.php\" method=\"post\" >" .
         "<tr><td>" . $result["id"] .
         "</td><td>" . $result["email"] .
         "</td><td>" . $result["title"] .
         "</td><td>" . $result["body"] .
         "</td><td>" .$result["skills"] .
         "</td><td><input type=\"hidden\" name=\"action\"value=\"delete_question\" >" .
         "<input type=\"hidden\" name=\"id\" value= {$result['id']} >" .
         "<input type=\"submit\" value=\"Delete\" ></td>" .
         "</form>" .

         "<form action=\"index.php\" method=\"post\" >" .
         "<td><input type=\"hidden\" name=\"action\"value=\"populate_question\" >" .
         "<input type=\"hidden\" name=\"id\" value= {$result['id']} >" .
         "<input type=\"submit\" formaction=\"../questions/index.php\" value=\"Edit\" ></td>" .
         "</form>" .

         "<form action=\"index.php\" method=\"post\" >" .
         "<td><input type=\"hidden\" name=\"action\"value=\"reply_question\" >" .
         "<input type=\"hidden\" name=\"id\" value= {$result['id']} >" .
         "<input type=\"submit\" formaction=\"../questions/index.php\" value=\"Reply\" ></td>" .
         "</tr></form>";
}
echo "</table>";
?>

<?php include '../view/footer.php'; ?>

