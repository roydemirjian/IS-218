<?php

#Email = Not empty & Must contain @
#Password = Not empty & at least 8 characters

if(isset($_GET["email"]) && !empty($_GET["email"])){
    if(strpos(($_GET["email"]),'@')){
        $email = $_GET["email"];
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

if(isset($_GET["password"]) && !empty($_GET["password"])){
    if(strlen($_GET["password"])>7){
        $password = $_GET["password"];
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



#echo "Email is: " . $email;
#echo "<br><br>";
#echo "Password is: " . $password;


?>