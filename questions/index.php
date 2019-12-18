<?php
require('../model/database.php');
require('../model/accounts_db.php');
require('../model/questions_db.php');

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        $action = 'action';
    }
}

if ($action == 'action') {
    include('question_view.php');
}

else if ($action == 'add_question'){
    session_start();
    $questionName = filter_input(INPUT_POST,'questionName');
    $questionBody = filter_input(INPUT_POST,'questionBody');
    $questionSkills = filter_input(INPUT_POST,'questionSkills');

    #questionName
    if(!empty($questionName)){
        if(strlen($questionName)>2){
        }else{
            $error =  "Question Name must be more than 3 characters";
            include('../errors/error.php');
        }
    }else{
        $error = "Question Name must be filled out";
        include('../errors/error.php');
    }

    #questionBody
    if(!empty($questionBody)){
        if(strlen($questionBody)<500){
        }else{
            $error = "Question body has reached max characters";
            include('../errors/error.php');
        }
    }else{
        $error = "Question Body must be filled out";
        include('../errors/error.php');
    }

    #questionSkills
    if(!empty($questionSkills)){
        $questionArray = explode(',', $questionSkills);
        if(count($questionArray)>1){
            #echo "Question Skills are: ";
            #foreach ($questionArray as $val){echo $val; echo " | "; }
        }else{
            $error =  "More Skills required";
            include('../errors/error.php');
        }
    }else{
        $error = "Question Skills must be filled out";
        include('../errors/error.php');
    }
    $sesh_email = $_SESSION['email'];
    $email = $sesh_email;

    if(QuestionDB::create_question($email,$questionName,$questionBody,$questionSkills)){
        header("Location: ../login/home.php");
        #Successful login... goto home page?
    }

    /**
    else{
    header("Location: index.php");
    #Failure... back to login page?
    }
     **/
}

else if ($action == 'populate_question'){
    $question_id = filter_input(INPUT_POST, 'id',FILTER_VALIDATE_INT);
    $array = QuestionDB::populate_question($question_id);
    $questionName =  $array[0];
    $questionBody =  $array[1];
    $questionSkills =  $array[2];
    include('edit_question_view.php');
}

else if ($action == 'edit_question'){
    session_start();
    $question_id = filter_input(INPUT_POST, 'id',FILTER_VALIDATE_INT);
    $questionName = filter_input(INPUT_POST,'questionName');
    $questionBody = filter_input(INPUT_POST,'questionBody');
    $questionSkills = filter_input(INPUT_POST,'questionSkills');

    #questionName
    if(!empty($questionName)){
        if(strlen($questionName)>2){
        }else{
            $error =  "Question Name must be more than 3 characters";
            include('../errors/error.php');
        }
    }else{
        $error = "Question Name must be filled out";
        include('../errors/error.php');
    }

    #questionBody
    if(!empty($questionBody)){
        if(strlen($questionBody)<500){
        }else{
            $error = "Question body has reached max characters";
            include('../errors/error.php');
        }
    }else{
        $error = "Question Body must be filled out";
        include('../errors/error.php');
    }

    #questionSkills
    if(!empty($questionSkills)){
        $questionArray = explode(',', $questionSkills);
        if(count($questionArray)>1){
            #echo "Question Skills are: ";
            #foreach ($questionArray as $val){echo $val; echo " | "; }
        }else{
            $error =  "More Skills required";
            include('../errors/error.php');
        }
    }else{
        $error = "Question Skills must be filled out";
        include('../errors/error.php');
    }
    $sesh_email = $_SESSION['email'];
    $email = $sesh_email;

    if(QuestionDB::edit_question($email, $question_id,$questionName,$questionBody,$questionSkills)){
        header("Location: ../login/home.php");
    }
}

else if ($action == 'reply_question'){
    session_start();
    $sesh_email = $_SESSION['email'];
    $question_id = filter_input(INPUT_POST, 'id',FILTER_VALIDATE_INT);
    $array = QuestionDB::populate_question($question_id);
    $questionName =  $array[0];
    $questionBody =  $array[1];
    $questionSkills =  $array[2];
    $questionEmail =  $array[3];
    include('single_question_view.php');
}

else if ($action == 'add_answer'){
    session_start();
    $sesh_email = $_SESSION['email'];
    $question_id = filter_input(INPUT_POST, 'question_id',FILTER_VALIDATE_INT);
    $answerBody = filter_input(INPUT_POST,'answerBody');

    #questionBody
    if(!empty($answerBody)){
        if(strlen($answerBody)<100){
        }else{
            $error = "Answer body has reached max characters";
            include('../errors/error.php');
        }
    }else{
        $error = "Answer Body must be filled out";
        include('../errors/error.php');
    }
    QuestionDB::new_answer($sesh_email,$answerBody,$question_id);
    header("Location: ../login/home.php");
}

else if ($action == 'upvote'){
    session_start();
    $answer_id = filter_input(INPUT_POST, 'id',FILTER_VALIDATE_INT);
    QuestionDB::up_vote($answer_id);
    header("Location: ../login/home.php");

    echo "upvote";

}

else if ($action == 'downvote') {
    session_start();
    $sesh_email = $_SESSION['email'];
    $answer_id = filter_input(INPUT_POST, 'id',FILTER_VALIDATE_INT);
    QuestionDB::down_vote($answer_id);
    header("Location: ../login/home.php");

    echo "downvote";

}

?>

