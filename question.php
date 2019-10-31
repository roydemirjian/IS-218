<?php

session_start();

#Check is session is set, if not redirect
if (!isset($_SESSION['logged']) || !$_SESSION['logged']){
    header("Location:login.html");
}

#Get session data from login
$sesh_email = $_SESSION['email'];
$sesh_password = $_SESSION['password'];


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

$email = $sesh_email;

#Database Info
$servername = "sql1.njit.edu";
$db_username = "rrd28";
$db_password = "donate52";

$dsn = "mysql:host=$servername;dbname=$db_username";


try {
    $db = new PDO($dsn, $db_username, $db_password);
    $sql2 = "INSERT INTO questions (email, title, body, skills) VALUES ('$email','$questionName','$questionBody','$questionSkills')";
    $q = $db->prepare($sql2);
    $q->bindValue('email',$email);
    $q->bindValue('title',$questionName);
    $q->bindValue('body',$questionBody);
    $q->bindValue('skills',$questionSkills);
    $q->execute();
    echo 'Question Posted';
    echo '<br><br>';
    $q->closeCursor();
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
echo 'Redirecting to home';
header("refresh:3; url=test.php");

#session_destroy();

?>
