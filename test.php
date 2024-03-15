<?php

require('bdconnexion.php');

if(isset($_GET['user'])) {
    $id_user = $_GET['user'];
}

if(isset($_GET['role'])) {
    $role = $_GET['role'];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titrequizz = $_POST["titre"];
    $difficultequizz = $_POST["difficulte"];
    $question1 = $_POST["question1"];
    $q1rep1 = $_POST["answer1.1"];
    $q1rep2 = $_POST["answer1.2"];
    $q1rep3 = $_POST["answer1.3"];
    $q1rep4 = $_POST["answer1.4"];
    $q1bonne_rep = $_POST["correctAnswer"];	

    $question2 = $_POST["question2"];
    $q2rep1 = $_POST["answer2.1"];
    $q2rep2 = $_POST["answer2.2"];
    $q2rep3 = $_POST["answer2.3"];
    $q2rep4 = $_POST["answer2.4"];
    $q2bonne_rep = $_POST["correctAnswer2"];

    $question3 = $_POST["question3"];
    $q3rep1 = $_POST["answer3.1"];
    $q3rep2 = $_POST["answer3.2"];
    $q3rep3 = $_POST["answer3.3"];
    $q3rep4 = $_POST["answer3.4"];
    $q3bonne_rep = $_POST["correctAnswer3"];

    $question4 = $_POST["question4"];
    $q4rep1 = $_POST["answer4.1"];
    $q4rep2 = $_POST["answer4.2"];
    $q4rep3 = $_POST["answer4.3"];
    $q4rep4 = $_POST["answer4.4"];
    $q4bonne_rep = $_POST["correctAnswer4"];

    $question5 = $_POST["question5"];
    $q5rep1 = $_POST["answer5.1"];
    $q5rep2 = $_POST["answer5.2"];
    $q5rep3 = $_POST["answer5.3"];
    $q5rep4 = $_POST["answer5.4"];
    $q5bonne_rep = $_POST["correctAnswer5"];

    $question6 = $_POST["question6"];
    $q6rep1 = $_POST["answer6.1"];
    $q6rep2 = $_POST["answer6.2"];
    $q6rep3 = $_POST["answer6.3"];
    $q6rep4 = $_POST["answer6.4"];
    $q6bonne_rep = $_POST["correctAnswer6"];

    $question7 = $_POST["question7"];
    $q7rep1 = $_POST["answer7.1"];
    $q7rep2 = $_POST["answer7.2"];
    $q7rep3 = $_POST["answer7.3"];
    $q7rep4 = $_POST["answer7.4"];
    $q7bonne_rep = $_POST["correctAnswer7"];

    $question8 = $_POST["question8"];
    $q8rep1 = $_POST["answer8.1"];
    $q8rep2 = $_POST["answer8.2"];
    $q8rep3 = $_POST["answer8.3"];
    $q8rep4 = $_POST["answer8.4"];
    $q8bonne_rep = $_POST["correctAnswer8"];

    $question9 = $_POST["question9"];
    $q9rep1 = $_POST["answer9.1"];
    $q9rep2 = $_POST["answer9.2"];
    $q9rep3 = $_POST["answer9.3"];
    $q9rep4 = $_POST["answer9.4"];
    $q9bonne_rep = $_POST["correctAnswer9"];

    $question10 = $_POST["question10"];
    $q10rep1 = $_POST["answer10.1"];
    $q10rep2 = $_POST["answer10.2"];
    $q10rep3 = $_POST["answer10.3"];
    $q10rep4 = $_POST["answer10.4"];
    $q10bonne_rep = $_POST["correctAnswer10"];




}

echo $titrequizz;
echo $difficultequizz;
echo $question1;
echo $q1rep1;
echo $q1rep2;
echo $q1rep3;
echo $q1rep4;
echo $q1bonne_rep;





?>