<?php
$servername = "sql1.njit.edu";
$username = 'rrd28';
$password = 'donate52';
$dsn = "mysql:host=$servername;dbname=$username";
try {
    $db = new PDO($dsn, $username, $password);
} catch (PDOException $e) {
    $error_message = $e->getMessage();
    include('../errors/database_error.php');
    exit();
}

?>
