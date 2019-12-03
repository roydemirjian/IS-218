<?php

function login_user($email,$password){
    session_start();
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
            return false;
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
            return true;
            exit;
        }
        $q->closeCursor();
    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
}

function get_user($sesh_email,$sesh_password){
    session_start();
    global $db;
    #Get users first name and last name based on their session information
    try {
        $sql2 = "SELECT * FROM accounts WHERE email = '$sesh_email' AND password = '$sesh_password'";
        $q = $db->prepare($sql2);
        $q->bindValue('email',$sesh_email);
        $q->bindValue('password',$sesh_password);
        $q->execute();
        $results = $q->fetchAll();
        if($q->rowCount() > 0){
            foreach ($results as $result) {
                $firstName = $result["firstname"];
                $lastName = $result["lastname"];
            }
        }else{
            echo '0 results: Getting first and last name based on session info';
        }
        #echo '<h1 id="welcome">'. "WELCOME " . $firstName . " " . $lastName . '</h1>';
        return array($firstName,$lastName);
        $q->closeCursor();
    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }

}

?>