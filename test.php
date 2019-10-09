<?php

$servername = "sql1.njit.edu";
$username = "rrd28";
$password = "donate52";

$dsn = "mysql:host=$servername;dbname=$username";

#Get all rows and echo them
try {
    $db = new PDO($dsn, $username, $password);
    echo "Connected successfully<br>";
    $sql = 'SELECT * FROM accounts';
    $q = $db->prepare($sql);
    $q->execute();
    $results = $q->fetchAll();
    if($q->rowCount() > 0){
        echo "<table border=\"1\"><tr><th>ID</th><th>Email</th><th>First Name</th><th>Last Name</th><th>Birthday</th><th>Password</th></tr>";
        foreach ($results as $result) {
            echo "<tr><td>" . $result["id"] . "</td><td>" . $result["email"] . "</td><td>" . $result["firstname"] . "</td><td>" . $result["lastname"] . "</td><td>" .$result["birthday"] . "</td><td>" . $result["password"]."</td></tr>";
        }
    }else{
        echo '0 results';
    }
    $q->closeCursor();

} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}




?>