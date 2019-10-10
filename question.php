<?php

/*
session_start();
#Check is session is set
if (!isset($_SESSION['logged']) || !$_SESSION['logged']){
    header("Location:login.php");
}
*/

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
        echo "<br><br>";

    }else{
        echo "More Skills required";
        echo "<br><br>";
    }
}else{
    echo nl2br("Question Skills must be filled out");
    echo "<br><br>";
}

#Temporary hard coded vars
$email = 'rrd28@njit.edu';

#
$servername = "sql1.njit.edu";
$db_username = "rrd28";
$db_password = "donate52";

$dsn = "mysql:host=$servername;dbname=$db_username";


try {
    $db = new PDO($dsn, $db_username, $db_password);
    $sql2 = "INSERT INTO questions (email, title, body, skills) VALUES ('$email','$questionName','$questionBody','$questionSkills')";
    $q = $db->prepare($sql2);
    $q->execute();
    echo 'Question Posted';
    $q->closeCursor();
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

session_destroy();

?>