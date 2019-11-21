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
        header("Location: ../login/login_success.php");
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

