<?php include '../view/header.php'; ?>


<head>
    <link rel="stylesheet" href="../styles/main.css?v=1.1.1">
    <link rel="stylesheet" href="../styles/table.css?v=1.1.1">
</head>

<main class="question">

    <h1> BY: <?php echo $questionEmail; ?></h1>
    <h1> Question ID: <?php echo $question_id; ?> </h1>
    <h1> Question Name: <?php echo $questionName; ?> </h1>
    <h1> Question Body: <?php echo $questionBody; ?> </h1>
    <h1> Question Skills: <?php echo $questionSkills; ?> </h1>

</main>

<main>
    <table id="questions_table" border="1"><caption>Answers</caption><tr><th>User</th><th>Body</th><th>Score</th><th>Vote</th></tr>
        <?php $results = QuestionDB::get_answers($question_id); ?>
        <?php foreach ($results as $result) {
            echo "<form action=\"index.php\" method=\"post\" >" .
                "<tr><td>" . $result["email"] .
                "</td><td>" . $result["body"] .
                "</td><td>" .$result["scores"] .
                "</td><td><input type=\"hidden\" name=\"action\"value=\"upvote\" >" .
                "<input type=\"hidden\" name=\"id\" value= {$result['id']} >" .
                "<input type=\"submit\" value=\"Upvote\" ></td>" .
                "</tr></form>" .

                "<form action=\"index.php\" method=\"post\" >" .
                "<tr><td><input type=\"hidden\" name=\"action\"value=\"downvote\" >" .
                "<input type=\"hidden\" name=\"id\" value= {$result['id']} >" .
                "<input type=\"submit\" formaction=\"../questions/index.php\" value=\"Downvote\" ></td>" .
                "</tr></form>";
        }
        ?>


    </table>
</main>

<main class="question">
    <form id = "answer_form" action="index.php" method="post">
        <input type="hidden" name="action" value="add_answer">

        <input type="hidden" name="question_id" value="<?php echo $question_id; ?>">

        <label>Answering As:</label>
        <div> <?php echo $sesh_email; ?> </div> <br>

        <label>Answer Body</label>
        <input id="answer_body" type="text" name="answerBody"><br>

        <label>Submit</label>
        <input id="answer_submit" type="submit" class="button" value="Submit"><br>

    </form>

    <form id = "question_back" action="../login/home.php" method="post">
        <input id="question_back_button" type="submit" value="Back" />
    </form>

</main>

<?php include '../view/footer.php'; ?>

