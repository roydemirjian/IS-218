<?php

require('../model/database.php');
require('../model/accounts_db.php');
require('../model/questions_db.php');

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        $action = 'register';
    }
}

if ($action == 'register') {
    include('register_view.php');
}

else if ($action == 'user_register'){
    $firstName = filter_input(INPUT_POST,'firstName');
    $lastName = filter_input(INPUT_POST,'lastName');
    $birthday = filter_input(INPUT_POST,'birthday');
    $email = filter_input(INPUT_POST,'email');
    $password = filter_input(INPUT_POST,'password');

    #First Name
    if(!empty($firstName)){
        #echo "First Name is: " . $firstName;
    }else{
        $error = "First Name must be filled out";
        include('../errors/error.php');
    }

    #Last Name
    if(isset($lastName) && !empty($lastName)){
        #echo "Last Name is: " . $lastName;
    }else{
        echo nl2br("Last Name must be filled out");
        include('../errors/error.php');
    }

    #Birthday
    if(isset($birthday) && !empty($birthday)){
        #echo "Birthday is: " . $birthday;
    }else{
        $error = "Birthday must be filled out";
        include('../errors/error.php');
    }

    #Email
    if(isset($email) && !empty($email)){
        if(strpos(($email),'@')){
            #echo "Email is: " . $email;
        }else{
            $error = "Email must be valid";
            include('../errors/error.php');
        }
    }else{
        $error = "Email Required";
        include('../errors/error.php');
    }

    #Password
    if(isset($password) && !empty($password)){
        if(strlen($password)>7){
            #echo "Password is: " . $password;
        }else{
            $error = "Password length must be at least 8 characters";
            include('../errors/error.php');
        }
    }else{
        $error = "Password Required";
        include('../errors/error.php');
    }

    if(register_user($email,$firstName,$lastName,$birthday,$password)){
        header("Location: register_success_test.php");
        #Successful registration... goto login page?
    }

}

?>