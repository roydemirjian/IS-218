<?php

$questionName = filter_input(INPUT_POST,'questionName');
$questionBody = filter_input(INPUT_POST,'questionBody');
$questionSkills = filter_input(INPUT_POST,'questionSkills');

#questionName
if(!empty($questionName)){
    if(strlen($questionName)>2){
        echo "Question Name is: " . $questionName;
        echo "<br><br>";
    }else{
        echo "Question Name must be more than 3 characters";
        echo "<br><br>";
    }
}else{
    echo nl2br("Question Name must be filled out");
    echo "<br><br>";
}

#questionBody
if(!empty($questionBody)){
    if(strlen($questionBody)<500){
        echo "Question Body is: " . $questionBody;
        echo "<br><br>";
    }else{
        echo "Question body has reached max characters";
        echo "<br><br>";
    }
}else{
    echo nl2br("Question Body must be filled out");
    echo "<br><br>";
}

#questionSkills
if(!empty($questionSkills)){
    $questionArray = explode(',', $questionSkills);
    if(count($questionArray)>1){
        echo "Question Skills are: ";
        foreach ($questionArray as $val){
            echo $val;
            echo " | ";
        }

    }else{
        echo "More Skills required";
        echo "<br><br>";
    }
}else{
    echo nl2br("Question Skills must be filled out");
    echo "<br><br>";
}

?>