<?php
require('../model/database.php');
require('../model/accounts_db.php');
require('../model/questions_db.php');

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        $action = 'login';
    }
}

if ($action == 'login') {
    include('login_view.php');
}

else if ($action == 'user_login'){
    $email = filter_input(INPUT_POST,'email');
    $password = filter_input(INPUT_POST,'password');

    #Check if Email is valid
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

    #Check if Password is valid
    if(isset($password) && !empty($password)){
        if(strlen($password)>7){
        #echo "Password is: " . $password;
        }else{
            $error = "Password length must be 8 characters";
            include('../errors/error.php');
        }
    }else{
        $error = "Password Required";
        include('../errors/error.php');
    }

    if(login_user($email,$password)){
        header("Location: login_success_test.php");
        #Successful login... goto home page?
    }
    /**
    else{
        header("Location: index.php");
        #Failure... back to login page?
    }
    **/
}

?>

