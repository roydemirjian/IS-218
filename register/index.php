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
    }else{
        $error = "First Name must be filled out";
        include('../errors/error.php');
        exit;
    }

    #Last Name
    if(isset($lastName) && !empty($lastName)){
    }else{
        $error="Last Name must be filled out";
        include('../errors/error.php');
        exit;
    }

    #Birthday
    if(isset($birthday) && !empty($birthday)){
    }else{
        $error = "Birthday must be filled out";
        include('../errors/error.php');
        exit;
    }

    #Email
    if(isset($email) && !empty($email)){
        if(strpos(($email),'@')){
        }else{
            $error = "Email must be valid";
            include('../errors/error.php');
            exit;
        }
    }else{
        $error = "Email Required";
        include('../errors/error.php');
        exit;
    }

    #Password
    if(isset($password) && !empty($password)){
        if(strlen($password)>7){
        }else{
            $error = "Password length must be at least 8 characters";
            include('../errors/error.php');
            exit;
        }
    }else{
        $error = "Password Required";
        include('../errors/error.php');
        exit;
    }

    if(AccountDB::register_user($email,$firstName,$lastName,$birthday,$password)){
        header("Location: ../index.php");
    }else{
        $error = "Email must be unique!";
        include('../errors/error.php');
        exit;
    }



}

?>