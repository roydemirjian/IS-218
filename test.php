<?php

#Display all questions by user
#Display username and lastname

session_start();

#Check is session is set
if (!isset($_SESSION['logged']) || !$_SESSION['logged']){
    header("Location:login.php");
}

#Get session data

$sesh_email = $_SESSION['email'];
$sesh_password = $_SESSION['password'];


$servername = "sql1.njit.edu";
$username = "rrd28";
$password = "donate52";

$dsn = "mysql:host=$servername;dbname=$username";

#Get all rows and echo them
try {
    $db = new PDO($dsn, $username, $password);
    echo "Connected successfully<br>";
    echo "<br><br>";
    echo "All Questions posted by: FirstName LastName";
    $sql = "SELECT * FROM questions WHERE email = '$sesh_email'";
    $q = $db->prepare($sql);
    $q->execute();
    $results = $q->fetchAll();
    if($q->rowCount() > 0){
        echo "<table border=\"1\"><tr><th>ID</th><th>Email</th><th>Title</th><th>Body</th><th>Skills</th></tr>";
        foreach ($results as $result) {
            echo "<tr><td>" . $result["id"] . "</td><td>" . $result["email"] . "</td><td>" . $result["title"] . "</td><td>" . $result["body"] . "</td><td>" .$result["skills"] . "</td></tr>";
        }
    }else{
        echo '0 results';
    }
    $q->closeCursor();

} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

session_destroy();

?>