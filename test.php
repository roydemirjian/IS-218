<?php

session_start();

#Check is session is set, if not redirect
if (!isset($_SESSION['logged']) || !$_SESSION['logged']){
    header("Location:login.html");
}

#Get session data from login
$sesh_email = $_SESSION['email'];
$sesh_password = $_SESSION['password'];


#Database Info
$servername = "sql1.njit.edu";
$username = "rrd28";
$password = "donate52";
$dsn = "mysql:host=$servername;dbname=$username";

#Get users first name and last name based on their session information
try {
    $db = new PDO($dsn, $username, $password);
    #echo "Connected successfully<br>";
    echo "<br><br>";
    $sql2 = "SELECT * FROM accounts WHERE email = '$sesh_email' AND password = '$sesh_password'";
    $q = $db->prepare($sql2);
    $q->bindValue('email',$sesh_email);
    $q->bindValue('password',$sesh_password);
    $q->execute();
    $results = $q->fetchAll();
    if($q->rowCount() > 0){
        foreach ($results as $result) {
            $firstName = $result["firstname"];
            $lastName = $result["lastname"];
        }
    }else{
        echo '0 results: Getting first and last name based on session info';
    }
    echo '<h1 id="welcome">'. "WELCOME " . $firstName . " " . $lastName . '</h1>';
    $q->closeCursor();

} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}


#Get all rows from questions posted by user and echo them
try {
    $db = new PDO($dsn, $username, $password);
    #echo '<h2>'. "All Questions posted by: " . $firstName . " " . $lastName . '</h2>';
    $sql = "SELECT * FROM questions WHERE email = '$sesh_email'";
    $q = $db->prepare($sql);
    $q->bindValue('email',$sesh_email);
    $q->execute();
    $results = $q->fetchAll();
    if($q->rowCount() > 0){
        echo "<table id=\"questions_table\" border=\"1\"><tr><th>ID</th><th>Email</th><th>Title</th><th>Body</th><th>Skills</th></tr>";
        foreach ($results as $result) {
            echo "<tr><td>" . $result["id"] . "</td><td>" . $result["email"] . "</td><td>" . $result["title"] . "</td><td>" . $result["body"] . "</td><td>" .$result["skills"] . "</td></tr>";
        }
    }else{
        echo '0 results: Getting all rows from questions from the user';
    }
    $q->closeCursor();

} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

#session_destroy();

?>

<html>

<head>
    <link rel="stylesheet" href="test.css?v=1.1.4">
</head>

<main class = "test">
    <form id="test_question" action="question.html" method="post">
        <input type="submit" value="Submit a new question" />
    </form>

    <form id="test_logout" action="login/logout.php">
        <input id = "logout" type="submit" value="Logout" />
    </form>
</main>



</html>
