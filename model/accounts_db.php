<?php

function login_user($email,$password){
    global $db;
    try {
        $sql = "SELECT * FROM accounts WHERE email = '$email' AND password = '$password'";
        $q = $db->prepare($sql);
        $q->bindValue('email',$email);
        $q->bindValue('password',$password);
        $q->execute();
        if($q->rowCount() > 0){
            #echo "Login Success.";
            $_SESSION['email'] = $email;
            $_SESSION['password'] = $password;
            $_SESSION['logged'] = true;
            return true;
            exit;
        } else{
            #echo 'Login Failure.';
            return false;
        }
        $q->closeCursor();
    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
}

function register_user($email,$firstName,$lastName,$birthday,$password){
    global $db;
    try {
        $sql = "SELECT * FROM accounts WHERE email = '$email' AND password = '$password'";
        $q = $db->prepare($sql);
        $q->bindValue('email',$email);
        $q->bindValue('password',$password);
        $q->execute();
        if($q->rowCount() > 0){
            #echo "Account is already made";
        } else{
            $sql2 = "INSERT INTO accounts (email, firstname, lastname, birthday, password) VALUES ('$email','$firstName','$lastName','$birthday','$password')";
            $q = $db->prepare($sql2);
            $q->bindValue('email',$email);
            $q->bindValue('firstname',$firstName);
            $q->bindValue('lastname',$lastName);
            $q->bindValue('birthday',$birthday);
            $q->bindValue('password',$password);
            $q->execute();
            #echo 'Account Made! Redirecting to Login Page!';
        }
        $q->closeCursor();
    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
}

?>