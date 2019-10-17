<?php

session_start();


$email = filter_input(INPUT_POST,'email');
$password = filter_input(INPUT_POST,'password');


#Check if Email is valid
if(isset($email) && !empty($email)){
    if(strpos(($email),'@')){
        echo "Email is: " . $email;
        echo "<br><br>";
        }else{
            echo nl2br("Email must be valid");
            echo "<br><br>";
        }
    }else{
        echo nl2br("Email Required");
        echo "<br><br>";
}

#Check if Password is valid
if(isset($password) && !empty($password)){
    if(strlen($password)>7){
        echo "Password is: " . $password;
        echo "<br><br>";
        }else{
            echo nl2br("Password length must be 8 characters");
            echo "<br><br>";
        }
    }else{
        echo nl2br("Password Required");
        echo "<br><br>";
}

#Check if login credentials are on db
$servername = "sql1.njit.edu";
$db_username = "rrd28";
$db_password = "donate52";
$dsn = "mysql:host=$servername;dbname=$db_username";

#Check if credentials are in db
try {
    $db = new PDO($dsn, $db_username, $db_password);
    $sql = "SELECT * FROM accounts WHERE email = '$email' AND password = '$password'";
    $q = $db->prepare($sql);
    $q->bindValue('email',$email);
    $q->bindValue('password',$password);
    $q->execute();
    $results = $q->fetchAll();
    if($q->rowCount() > 0){
        echo "Login Success. Redirecting to homepage...";
        $_SESSION['email'] = $email;
        $_SESSION['password'] = $password;
        $_SESSION['logged'] = true;
        header("Refresh:2; url=test.php");
        exit;
    }else{
        echo 'Login Failure. Please register! Redirecting Now!';
        header("Refresh:2; url=register.html");
    }
    $q->closeCursor();

} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}


?>