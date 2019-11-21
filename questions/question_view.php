<?php include '../view/header.php'; ?>

<main class="question">
    <form action="index.php" method="post">
        <input type="hidden" name="action" value="add_question"

        <label>Question Name</label>
        <input id="question_name" type="text" name="questionName"><br>

        <label>Question Body</label>
        <input id="question_body" type="text" name="questionBody"><br>

        <label>Question Skills</label>
        <textarea id="question_skills" name="questionSkills" placeholder="separate with commas" style="height:100px"></textarea>

        <label>Submit</label>
        <input id="question_submit" type="submit" class="button" value="Submit"><br>

    </form>

    <form id = "question_back" action="index.php" method="post">
        <input type="submit" value="Back" />
    </form>

</main>

<?php include '../view/footer.php'; ?>

