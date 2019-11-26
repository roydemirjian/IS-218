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
            return $results;
        }else{
            echo '0 results: Getting all rows from questions from the user';
        }
        $q->closeCursor();

    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }

}

function populate_question($question_id){
    global $db;
    try {
        $sql = "SELECT * FROM questions WHERE id = '$question_id'";
        $q = $db->prepare($sql);
        $q->bindValue('id',$question_id);
        $q->execute();
        $results = $q->fetchAll();
        if($q->rowCount() > 0){
            foreach ($results as $result) {
                $questionName = $result["title"];
                $questionBody = $result["body"];
                $questionSkills = $result["skills"];
            }
        }else{
            echo '0 results: ';
        }
        return array($questionName,$questionBody,$questionSkills);
        $q->closeCursor();
    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
}


function edit_question($question_id,$questionName,$questionBody,$questionSkills){
    global $db;
    try {
        $sql = "SELECT * FROM questions WHERE id = '$question_id'";
        $q = $db->prepare($sql);
        $q->bindValue('id',$question_id);
        $q->execute();
        $results = $q->fetchAll();
        if($q->rowCount() > 0){
            #update new info into question
            $sql2 = "UPDATE questions SET (title, body, skills) VALUES ($questionName','$questionBody','$questionSkills')";
            $q = $db->prepare($sql2);
            $q->bindValue('title',$questionName);
            $q->bindValue('body',$questionBody);
            $q->bindValue('skills',$questionSkills);
            $q->execute();
        }else{
            echo '0 results: Could not update question';
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

