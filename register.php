<?php

$firstName = filter_input(INPUT_GET,'firstName');
$lastName = filter_input(INPUT_GET,'lastName');
$birthday = filter_input(INPUT_GET,'birthday');
$email = filter_input(INPUT_GET,'email');
$password = filter_input(INPUT_GET,'password');


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
        echo nl2br("Password length must be 8 characters");
        echo "<br><br>";
    }
}else{
    echo nl2br("Password Required");
    echo "<br><br>";
}


?>