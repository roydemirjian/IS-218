<?php

$firstName = filter_input(INPUT_POST,'firstName');
$lastName = filter_input(INPUT_POST,'lastName');
$birthday = filter_input(INPUT_POST,'birthday');
$email = filter_input(INPUT_POST,'email');
$password = filter_input(INPUT_POST,'password');


#First Name
if(!empty($firstName)){
    echo "First Name is: " . $firstName;
    echo "<br><br>";
}else{
    echo nl2br("First Name must be filled out");
    echo "<br><br>";
}

#Last Name
if(isset($lastName) && !empty($lastName)){
    echo "Last Name is: " . $lastName;
    echo "<br><br>";
}else{
    echo nl2br("Last Name must be filled out");
    echo "<br><br>";
}

#Birthday
if(isset($birthday) && !empty($birthday)){
    echo "Birthday is: " . $birthday;
    echo "<br><br>";
}else{
    echo nl2br("Birthday must be filled out");
    echo "<br><br>";
}

#Email
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

#Password
if(isset($password) && !empty($password)){
    if(strlen($password)>7){
        echo "Password is: " . $password;
        echo "<br><br>";
    }else{
        echo nl2br("Password length must be at least 8 characters");
        echo "<br><br>";
    }
}else{
    echo nl2br("Password Required");
    echo "<br><br>";
}

#Register user if it does not exist
$servername = "sql1.njit.edu";
$db_username = "rrd28";
$db_password = "donate52";
$dsn = "mysql:host=$servername;dbname=$db_username";

#Check if credentials are in db
try {
    $db = new PDO($dsn, $db_username, $db_password);
    $sql = "SELECT * FROM accounts WHERE email = '$email' AND password = '$password'";
    $q = $db->prepare($sql);
    $q->execute();
    $results = $q->fetchAll();
    if($q->rowCount() > 0){
        echo "Account is already made";
    }else{
        $sql2 = "INSERT INTO accounts (email, firstname, lastname, birthday, password) VALUES ('$email','$firstName','$lastName','$birthday','$password')";
        $q = $db->prepare($sql2);
        $q->execute();
        echo 'Account Made!';
    }
    $q->closeCursor();

} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

?>