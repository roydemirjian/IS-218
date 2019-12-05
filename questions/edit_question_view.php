<?php include '../view/header.php'; ?>


<head>
    <link rel="stylesheet" href="../styles/main.css?v=1.1.8">
</head>

<main class="question">

    <h1 id = "question_number"> Question # <?php echo $question_id; ?> </h1>

    <form action="index.php" method="post">
        <input type="hidden" name="action" value="edit_question">
        <input type="hidden" name="id" value= "<?php echo $question_id; ?>" >

        <label>Question Name</label>
        <input id="question_name" type="text" name="questionName" value = "<?php echo $questionName; ?>" ><br>

        <label>Question Body</label>
        <input id="question_body" type="text" name="questionBody" value = "<?php echo $questionBody; ?>" ><br>

        <label>Question Skills</label>
        <textarea id="question_skills" name="questionSkills" placeholder="separate with commas" style="height:100px" ><?php echo $questionSkills; ?></textarea>

        <label>Submit</label>
        <input id="question_submit" type="submit" class="button" value="Edit"><br>

    </form>

    <form id = "question_back" action="../login/home.php" method="post">
        <input type="submit" value="Back" />
    </form>

</main>

<?php include '../view/footer.php'; ?>

