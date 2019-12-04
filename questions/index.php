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
            #echo "Question Name is: " . $questionName;
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
            #echo "Question Body is: " . $questionBody;
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

    if(create_question($email,$questionName,$questionBody,$questionSkills)){
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
    $array = populate_question($question_id);
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
            #echo "Question Name is: " . $questionName;
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
            #echo "Question Body is: " . $questionBody;
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

    #echo $questionName;
    #echo $questionBody;
    #echo $questionSkills;

    if(edit_question($email, $question_id,$questionName,$questionBody,$questionSkills)){
        header("Location: ../login/home.php");
    }
}



?>

