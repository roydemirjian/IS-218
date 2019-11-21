<?php


function get_all_questions($sesh_email){
    global $db;
    try {
        $sql = "SELECT * FROM questions WHERE email = '$sesh_email'";
        $q = $db->prepare($sql);
        $q->bindValue('email',$sesh_email);
        $q->execute();
        $results = $q->fetchAll();
        if($q->rowCount() > 0){
            echo "<table id=\"questions_table\" border=\"1\"><tr><th>ID</th><th>Email</th><th>Title</th><th>Body</th><th>Skills</th></tr>";
            foreach ($results as $result) {
                echo "<tr><td>" . $result["id"] . "</td><td>" . $result["email"] . "</td><td>" . $result["title"] . "</td><td>" . $result["body"] . "</td><td>" .$result["skills"] . "</td></tr>";
            }
        }else{
            echo '0 results: Getting all rows from questions from the user';
        }
        $q->closeCursor();

    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }

}

function get_question($sesh_email,$id){
    global $db;
    try {
        $sql = "SELECT * FROM questions WHERE email = '$sesh_email' AND id = '$id'";
        $q = $db->prepare($sql);
        $q->bindValue('email',$sesh_email);
        $q->execute();
        $results = $q->fetchAll();
        if($q->rowCount() > 0){
            echo "<table id=\"questions_table\" border=\"1\"><tr><th>ID</th><th>Email</th><th>Title</th><th>Body</th><th>Skills</th></tr>";
            foreach ($results as $result) {
                echo "<tr><td>" . $result["id"] . "</td><td>" . $result["email"] . "</td><td>" . $result["title"] . "</td><td>" . $result["body"] . "</td><td>" .$result["skills"] . "</td></tr>";
            }
        }else{
            echo '0 results: Getting all rows from questions from the user';
        }
        $q->closeCursor();

    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }


}

function create_question($email,$questionName,$questionBody,$questionSkills){
    global $db;
    try {
        $sql2 = "INSERT INTO questions (email, title, body, skills) VALUES ('$email','$questionName','$questionBody','$questionSkills')";
        $q = $db->prepare($sql2);
        $q->bindValue('email',$email);
        $q->bindValue('title',$questionName);
        $q->bindValue('body',$questionBody);
        $q->bindValue('skills',$questionSkills);
        $q->execute();
        echo 'Question Posted';
        $q->closeCursor();
    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }

}

function edit_question(){

}

function delete_question(){

}