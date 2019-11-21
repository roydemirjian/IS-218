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
            #maybe send this array to home page first?
            echo "<table id=\"questions_table\" border=\"1\">
                    <tr><th>ID</th><th>Email</th><th>Title</th><th>Body</th><th>Skills</th></tr>";
            foreach ($results as $result) {
                echo "<form action=\"index.php\" method=\"post\" >" .
                     "<tr><td>" . $result["id"] .
                     "</td><td>" . $result["email"] .
                     "</td><td>" . $result["title"] .
                     "</td><td>" . $result["body"] .
                     "</td><td>" .$result["skills"] .
                     "<input type=\"hidden\" name=\"action\"value=\"delete_question\" >" .
                     "<input type=\"hidden\" name=\"id\" value= {$result['id']} >" .
                     "<input type=\"submit\" value=\"Delete\" >" .
                     "</td></tr></form>";
                #"<input type=\"hidden\" name=\"product_id\" value=" . $result["id"] >"" .
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
        #echo 'Question Posted';
        $q->closeCursor();
        return true;
        exit;
    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }

}

function edit_question(){

}


function delete_question($question_id){
    global $db;
    try {
        $sql = "DELETE FROM questions WHERE id = '$question_id'";
        $q = $db->prepare($sql);
        $q->bindValue('id',$question_id);
        $q->execute();
        $q->closeCursor();
    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
}

