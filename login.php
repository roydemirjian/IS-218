<?php

#Change to post
$email = filter_input(INPUT_POST,'email');
$password = filter_input(INPUT_POST,'password');


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