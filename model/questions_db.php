<?php

class QuestionDB{

    public static function get_all_user_questions($sesh_email){
        $db = Database::getDB();
        try {
            $sql = "SELECT * FROM questions WHERE email = '$sesh_email'";
            $q = $db->prepare($sql);
            $q->bindValue('email',$sesh_email);
            $q->execute();
            $results = $q->fetchAll();
            if($q->rowCount() > 0){
                return $results;
            }else{
                echo 'You have not posted anything yet';
            }
            $q->closeCursor();

        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }

    }

    public static function get_all_questions(){
        $db = Database::getDB();
        try {
            $sql = "SELECT * FROM questions";
            $q = $db->prepare($sql);
            $q->execute();
            $results = $q->fetchAll();
            if($q->rowCount() > 0){
                return $results;
            }else{
                echo 'There are no posts available';
            }
            $q->closeCursor();

        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }

    }



    public static function populate_question($question_id){
        $db = Database::getDB();
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
                    $questionEmail = $result["email"];
                }
            }else{
                echo 'Could not obtain question data';
            }
            return array($questionName,$questionBody,$questionSkills,$questionEmail);
            $q->closeCursor();
        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }


    public static function edit_question($email,$question_id,$questionName,$questionBody,$questionSkills){
        $db = Database::getDB();
        try {
            $sql2 = "UPDATE questions SET title = '$questionName', body = '$questionBody', skills = '$questionSkills' WHERE id = '$question_id' AND email = '$email'";
            $q = $db->prepare($sql2);
            $q->bindValue('id',$question_id);
            $q->bindValue('title',$questionName);
            $q->bindValue('body',$questionBody);
            $q->bindValue('skills',$questionSkills);
            $q->execute();
            $q->closeCursor();
            return true;
            exit;
        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public static function create_question($email,$questionName,$questionBody,$questionSkills){
        $db = Database::getDB();
        try {
            $sql2 = "INSERT INTO questions (email, title, body, skills) VALUES ('$email','$questionName','$questionBody','$questionSkills')";
            $q = $db->prepare($sql2);
            $q->bindValue('email',$email);
            $q->bindValue('title',$questionName);
            $q->bindValue('body',$questionBody);
            $q->bindValue('skills',$questionSkills);
            $q->execute();
            $q->closeCursor();
            return true;
            exit;
        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }

    }


    public static function delete_question($question_id){
        $db = Database::getDB();
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

    public static function new_answer($sesh_email,$answerBody,$question_id){
        $db = Database::getDB();
        try {
            $sql2 = "INSERT INTO answers (email, body, question_id) VALUES ('$sesh_email','$answerBody','$question_id')";
            $q = $db->prepare($sql2);
            $q->bindValue('email',$sesh_email);
            $q->bindValue('body',$answerBody);
            $q->bindValue('question_id',$question_id);
            $q->execute();
            $q->closeCursor();
            return true;
            exit;
        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }

    }

    public static function get_answers($question_id){
        $db = Database::getDB();
        try {
            $sql = "SELECT * FROM answers WHERE question_id = '$question_id'";
            $q = $db->prepare($sql);
            $q->bindValue('question_id',$question_id);
            $q->execute();
            $results = $q->fetchAll();
            if($q->rowCount() > 0){
                return $results;
            }else{
                echo 'You have not commented yet';
            }
            $q->closeCursor();

        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }

    }

    public static function up_vote(){

    }

    public static function down_vote(){

    }

}

/**
function get_all_questions($sesh_email){
    $db = Database::getDB();
    try {
        $sql = "SELECT * FROM questions WHERE email = '$sesh_email'";
        $q = $db->prepare($sql);
        $q->bindValue('email',$sesh_email);
        $q->execute();
        $results = $q->fetchAll();
        if($q->rowCount() > 0){
            return $results;
        }else{
            echo 'You have not posted anything yet';
        }
        $q->closeCursor();

    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }

}

function populate_question($question_id){
    $db = Database::getDB();
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
            echo 'Could not obtain question data';
        }
        return array($questionName,$questionBody,$questionSkills);
        $q->closeCursor();
    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
}


function edit_question($email,$question_id,$questionName,$questionBody,$questionSkills){
    $db = Database::getDB();
    try {
        $sql2 = "UPDATE questions SET title = '$questionName', body = '$questionBody', skills = '$questionSkills' WHERE id = '$question_id' AND email = '$email'";
        $q = $db->prepare($sql2);
        $q->bindValue('id',$question_id);
        $q->bindValue('title',$questionName);
        $q->bindValue('body',$questionBody);
        $q->bindValue('skills',$questionSkills);
        $q->execute();
        $q->closeCursor();
        return true;
        exit;
    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
}

function create_question($email,$questionName,$questionBody,$questionSkills){
    $db = Database::getDB();
    try {
        $sql2 = "INSERT INTO questions (email, title, body, skills) VALUES ('$email','$questionName','$questionBody','$questionSkills')";
        $q = $db->prepare($sql2);
        $q->bindValue('email',$email);
        $q->bindValue('title',$questionName);
        $q->bindValue('body',$questionBody);
        $q->bindValue('skills',$questionSkills);
        $q->execute();
        $q->closeCursor();
        return true;
        exit;
    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }

}


function delete_question($question_id){
    $db = Database::getDB();
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

 **/

?>