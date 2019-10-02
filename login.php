<?php

#Email = Not empty & Must contain @
#Password = Not empty & at least 8 characters

if(isset($_GET["email"]) && !empty($_GET["email"])){
    if(strpos(($_GET["email"]),'@')){
        $email = $_GET["email"];
        }else{
            echo "Email must be valid";
        }
    }else{
        echo "Email Required";
}

if(isset($_GET["password"]) && !empty($_GET["password"])){
    if(strlen($_GET["password"])>8){
        $password = $_GET["password"];
        }else{
            echo "Password length must be 8 characters";
        }
    }else{
        echo "Password Required";
}



echo "Email is: " . $email;
echo "<br>";
echo "Password is: " . $password;


?>