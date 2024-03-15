<?php 
require('bdconnexion.php');

if(isset($_GET['user'])) {
    $id_user = $_GET['user'];
}

if(isset($_GET['role'])) {
    $role = $_GET['role'];
}

$titrequizz ="";
$difficulte ="";

$question1 ="";
$q1rep1 ="";
$q1rep2 ="";
$q1rep3 ="";
$q1bonnerep ="";

$question2 ="";
$q2rep1 ="";
$q2rep2 = "";
$q2rep3 = "";
$q2bonnerep = "";

$question3 ="";
$q3rep1 ="";
$q3rep2 ="";
$q3rep3 ="";
$q3bonnerep ="";

$question4 ="";
$q4rep1 ="";
$q4rep2 ="";
$q4rep3 ="";
$q4bonnerep ="";

$question5 ="";
$q5rep1 ="";
$q5rep2 ="";
$q5rep3 ="";
$q5bonnerep ="";

$question6 ="";
$q6rep1 ="";
$q6rep2 ="";
$q6rep3 ="";
$q6bonnerep ="";

$question7 ="";
$q7rep1 ="";
$q7rep2 ="";
$q7rep3 ="";
$q7bonnerep ="";

$question8 ="";
$q8rep1 ="";
$q8rep2 ="";
$q8rep3 ="";
$q8bonnerep ="";

$question9 ="";
$q9rep1 ="";
$q9rep2 ="";
$q9rep3 ="";
$q9bonnerep ="";

$question10 ="";
$q10rep1 ="";
$q10rep2 ="";
$q10rep3 ="";
$q10bonnerep ="";

// $errorMessage = "";
// $successMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titrequizz = $_POST["titre"];
    $difficulte = $_POST["difficulte"];
    $categorie = $_POST["categorie"];
    
    $question1 = $_POST["question1"];
    $q1rep1 = $_POST["q1rep1"];
    $q1rep2 = $_POST["q1rep2"];
    $q1rep3 = $_POST["q1rep3"];
    $q1bonnerep = $_POST["q1bonnerep"];


    $question2 = $_POST["question2"];
    $q2rep1 = $_POST["q2rep1"];
    $q2rep2 = $_POST["q2rep2"];
    $q2rep3 = $_POST["q2rep3"];
    $q2bonnerep = $_POST["q2bonnerep"];


    $question3 = $_POST["question3"];
    $q3rep1 = $_POST["q3rep1"];
    $q3rep2 = $_POST["q3rep2"];
    $q3rep3 = $_POST["q3rep3"];
    $q3bonnerep = $_POST["q3bonnerep"];


    $question4 = $_POST["question4"];
    $q4rep1 = $_POST["q4rep1"];
    $q4rep2 = $_POST["q4rep2"];
    $q4rep3 = $_POST["q4rep3"];
    $q4bonnerep = $_POST["q4bonnerep"];
        

    $question5 = $_POST["question5"];
    $q5rep1 = $_POST["q5rep1"];
    $q5rep2 = $_POST["q5rep2"];
    $q5rep3 = $_POST["q5rep3"];
    $q5bonnerep = $_POST["q5bonnerep"];


    $question6 = $_POST["question6"];
    $q6rep1 = $_POST["q6rep1"];
    $q6rep2 = $_POST["q6rep2"];
    $q6rep3 = $_POST["q6rep3"];
    $q6bonnerep = $_POST["q6bonnerep"];


    $question7 = $_POST["question7"];
    $q7rep1 = $_POST["q7rep1"];
    $q7rep2 = $_POST["q7rep2"];
    $q7rep3 = $_POST["q7rep3"];
    $q7bonnerep = $_POST["q7bonnerep"];


    $question8 = $_POST["question8"];
    $q8rep1 = $_POST["q8rep1"];
    $q8rep2 = $_POST["q8rep2"];
    $q8rep3 = $_POST["q8rep3"];
    $q8bonnerep = $_POST["q8bonnerep"];


    $question9 = $_POST["question9"];
    $q9rep1 = $_POST["q9rep1"];
    $q9rep2 = $_POST["q9rep2"];
    $q9rep3 = $_POST["q9rep3"];
    $q9bonnerep = $_POST["q9bonnerep"];

    
    $question10 = $_POST["question10"];
    $q10rep1 = $_POST["q10rep1"];
    $q10rep2 = $_POST["q10rep2"];
    $q10rep3 = $_POST["q10rep3"];
    $q10bonnerep = $_POST["q10bonnerep"];


    do {

        $date = date("Y-m-d");
//------------------------------------------------------------------------------------------------------------------------------
        $sqlquizz = "INSERT INTO `quizz`(`Titre`, `difficulte`, `date_creation`, `Categorie`) VALUES ('$titrequizz','$difficulte','$date', '$categorie')";
        $result = mysqli_query($conn, $sqlquizz);

        if (!$result) {
            $errorMessage = "Erreur lors de l'ajout du quizz";
            break;
        }

        $sqlidquizz = "SELECT `Id_quizz` FROM `quizz` WHERE Titre = '$titrequizz'";
        $resultidquizz = mysqli_query($conn, $sqlidquizz);

        if (mysqli_num_rows($resultidquizz) > 0) {
            while ($row = mysqli_fetch_assoc($resultidquizz)) {
                $id_quizz = $row['Id_quizz'];
            }
        }
//------------------------------------------------------------------------------------------------------------------------------
        $sqlcreer = "INSERT INTO `creer`(`Id_quizz`, `Id_utilisateur`) VALUES ('$id_quizz','$id_user')";
        $resultcreer = mysqli_query($conn, $sqlcreer);

        if (!$resultcreer) {
            echo "Erreur lors de l'ajout de creer";
            break;
        }

//------------------------------------------------------------------------------------------------------------------------------
        $sqlquestion1 = "INSERT INTO `question`(`Id_quizz`, `question`, `difficulte`, `date_creation`) VALUES ('$id_quizz','$question1','$difficulte','$date')";
        $resultq1 = mysqli_query($conn, $sqlquestion1);

        if (!$resultq1) {
            echo "Erreur lors de l'ajout du question1";
            break;
        }

        $sqlidquestion1 = "SELECT `Id_question` FROM `question` WHERE question = '$question1'";
        $resultidquestion1 = mysqli_query($conn, $sqlidquestion1);
        if (mysqli_num_rows($resultidquestion1) > 0) {
            while ($row2 = mysqli_fetch_assoc($resultidquestion1)) {
                $id_q1 = $row2['Id_question'];
            }
        }

        $sqlrep1 = "INSERT INTO `choix`(`rep1`,`rep2`, `rep3`, `Bonne_reponse`, `Id_question`) VALUES ('$q1rep1','$q1rep2','$q1rep3','$q1bonnerep','$id_q1')";
        $resultrep1 = mysqli_query($conn, $sqlrep1);

        if (!$resultrep1) {
            echo "Erreur lors de l'ajout de la reponse1";
            break;
        }

    //------------------------------------------------------------------------------------------------------------------------------

        $sqlquestion2 = "INSERT INTO `question`(`Id_quizz`, `question`, `difficulte`, `date_creation`) VALUES ('$id_quizz','$question2','$difficulte','$date')";
        $resultq2 = mysqli_query($conn, $sqlquestion2);

        if (!$resultq2) {
            echo "Erreur lors de l'ajout de la question2";
            break;
        }

        $sqlidquestion2 = "SELECT `Id_question` FROM `question` WHERE question = '$question2'";
        $resultidquestion2 = mysqli_query($conn, $sqlidquestion2);
        if (mysqli_num_rows($resultidquestion2) > 0) {
            while ($row3 = mysqli_fetch_assoc($resultidquestion2)) {
                $id_q2 = $row3['Id_question'];
            }
        }

        $sqlrep2 = "INSERT INTO `choix`(`rep1`,`rep2`, `rep3`, `Bonne_reponse`, `Id_question`) VALUES ('$q2rep1','$q2rep2','$q2rep3','$q2bonnerep', '$id_q2')";
        $resultrep2 = mysqli_query($conn, $sqlrep2);

        if (!$resultrep2) {
            echo "Erreur lors de l'ajout de la reponse2";
            break;
        }
//------------------------------------------------------------------------------------------------------------------------------
        $sqlquestion3 = "INSERT INTO `question`(`Id_quizz`, `question`, `difficulte`, `date_creation`) VALUES ('$id_quizz','$question3','$difficulte','$date')";
        $resultq3 = mysqli_query($conn, $sqlquestion3);

        if (!$resultq3) {
            echo "Erreur lors de l'ajout de la question3";
            break;
        }

        $sqlidquestion3 = "SELECT `Id_question` FROM `question` WHERE question = '$question3'";
        $resultidquestion3 = mysqli_query($conn, $sqlidquestion3);

        if (mysqli_num_rows($resultidquestion3) > 0) {
            while ($row4 = mysqli_fetch_assoc($resultidquestion3)) {
                $id_q3 = $row4['Id_question'];
            }
        }

        $sqlrep3 = "INSERT INTO `choix`(`rep1`,`rep2`, `rep3`, `Bonne_reponse`, `Id_question`) VALUES ('$q3rep1','$q3rep2','$q3rep3','$q3bonnerep', '$id_q3')";
        $resultrep3 = mysqli_query($conn, $sqlrep3);

        if (!$resultrep3) {
            echo "Erreur lors de l'ajout de la reponse3";
            break;
        }
//------------------------------------------------------------------------------------------------------------------------------

        $sqlquestion4 = "INSERT INTO `question`(`Id_quizz`, `question`, `difficulte`, `date_creation`) VALUES ('$id_quizz','$question4','$difficulte','$date')";
        $resultq4 = mysqli_query($conn, $sqlquestion4);

        if (!$resultq4) {
            echo "Erreur lors de l'ajout de la question4";
            break;
        }

        $sqlidquestion4 = "SELECT `Id_question` FROM `question` WHERE question = '$question4'";
        $resultidquestion4 = mysqli_query($conn, $sqlidquestion4);

        if (mysqli_num_rows($resultidquestion4) > 0) {
            while ($row5 = mysqli_fetch_assoc($resultidquestion4)) {
                $id_q4 = $row5['Id_question'];
            }
        }
        

        $sqlrep4 = "INSERT INTO `choix` (`rep1`,`rep2`, `rep3`, `Bonne_reponse`, `Id_question`) VALUES ('$q4rep1','$q4rep2','$q4rep3','$q4bonnerep', '$id_q4')";
        $resultrep4 = mysqli_query($conn, $sqlrep4);

        if (!$resultrep4) {
            echo "Erreur lors de l'ajout de la reponse4";
            break;
        }
//------------------------------------------------------------------------------------------------------------------------------

        $sqlquestion5 = "INSERT INTO `question`(`Id_quizz`, `question`, `difficulte`, `date_creation`) VALUES ('$id_quizz','$question5','$difficulte','$date')";
        $resultq5 = mysqli_query($conn, $sqlquestion5);

        if (!$resultq5) {
            echo "Erreur lors de l'ajout de la question5";
            break;
        }

        $sqlidquestion5 = "SELECT `Id_question` FROM `question` WHERE question = '$question5'";
        $resultidquestion5 = mysqli_query($conn, $sqlidquestion5);

        if (mysqli_num_rows($resultidquestion5) > 0) {
            while ($row6 = mysqli_fetch_assoc($resultidquestion5)) {
                $id_q5 = $row6['Id_question'];
            }
        }

        $sqlrep5 = "INSERT INTO `choix`(`rep1`,`rep2`, `rep3`, `Bonne_reponse`, `Id_question`) VALUES ('$q5rep1','$q5rep2','$q5rep3','$q5bonnerep', '$id_q5')";
        $resultrep5 = mysqli_query($conn, $sqlrep5);

        if (!$resultrep5) {
            echo "Erreur lors de l'ajout de la reponse5";
            break;
        }

//------------------------------------------------------------------------------------------------------------------------------        

        $sqlquestion6 = "INSERT INTO `question`(`Id_quizz`, `question`, `difficulte`, `date_creation`) VALUES ('$id_quizz','$question6','$difficulte','$date')";
        $resultq6 = mysqli_query($conn, $sqlquestion6);

        if (!$resultq6) {
            echo "Erreur lors de l'ajout de la question6";
            break;
        }

        $sqlidquestion6 = "SELECT `Id_question` FROM `question` WHERE question = '$question6'";
        $resultidquestion6 = mysqli_query($conn, $sqlidquestion6);

        if (mysqli_num_rows($resultidquestion6) > 0) {
            while ($row7 = mysqli_fetch_assoc($resultidquestion6)) {
                $id_q6 = $row7['Id_question'];
            }
        }

        $sqlrep6 = "INSERT INTO `choix`(`rep1`,`rep2`, `rep3`, `Bonne_reponse`, `Id_question`) VALUES ('$q6rep1','$q6rep2','$q6rep3','$q6bonnerep', '$id_q6')";
        $resultrep6 = mysqli_query($conn, $sqlrep6);

        if (!$resultrep6) {
            echo "Erreur lors de l'ajout de la reponse6";
            break;
        }

//------------------------------------------------------------------------------------------------------------------------------ 

        $sqlquestion7 = "INSERT INTO `question`(`Id_quizz`, `question`, `difficulte`, `date_creation`) VALUES ('$id_quizz','$question7','$difficulte','$date')";
        $resultq7 = mysqli_query($conn, $sqlquestion7);

        if (!$resultq7) {
            echo "Erreur lors de l'ajout de la question7";
            break;
        }

        $sqlidquestion7 = "SELECT `Id_question` FROM `question` WHERE question = '$question7'";
        $resultidquestion7 = mysqli_query($conn, $sqlidquestion7);

        if (mysqli_num_rows($resultidquestion7) > 0) {
            while ($row8 = mysqli_fetch_assoc($resultidquestion7)) {
                $id_q7 = $row8['Id_question'];
            }
        }

        $sqlrep7 = "INSERT INTO `choix`(`rep1`,`rep2`, `rep3`, `Bonne_reponse`, `Id_question`) VALUES ('$q7rep1','$q7rep2','$q7rep3','$q7bonnerep', '$id_q7')";
        $resultrep7 = mysqli_query($conn, $sqlrep7);

        if (!$resultrep7) {
            echo "Erreur lors de l'ajout de la reponse7";
            break;
        }
        
//------------------------------------------------------------------------------------------------------------------------------ 
        $sqlquestion8 = "INSERT INTO `question`(`Id_quizz`, `question`, `difficulte`, `date_creation`) VALUES ('$id_quizz','$question8','$difficulte','$date')";
        $resultq8 = mysqli_query($conn, $sqlquestion8);

        if (!$resultq8) {
            echo "Erreur lors de l'ajout de la question8";
            break;
        }

        $sqlidquestion8 = "SELECT `Id_question` FROM `question` WHERE question = '$question8'";
        $resultidquestion8 = mysqli_query($conn, $sqlidquestion8);

        if (mysqli_num_rows($resultidquestion8) > 0) {
            while ($row9 = mysqli_fetch_assoc($resultidquestion8)) {
                $id_q8 = $row9['Id_question'];
            }
        }


        $sqlrep8 = "INSERT INTO `choix`(`rep1`,`rep2`, `rep3`, `Bonne_reponse`, `Id_question`) VALUES ('$q8rep1','$q8rep2','$q8rep3','$q8bonnerep', '$id_q8')";
        $resultrep8 = mysqli_query($conn, $sqlrep8);

        if (!$resultrep8) {
            echo "Erreur lors de l'ajout de la reponse8";
            break;
        }
//------------------------------------------------------------------------------------------------------------------------------ 
        $sqlquestion9 = "INSERT INTO `question`(`Id_quizz`, `question`, `difficulte`, `date_creation`) VALUES ('$id_quizz','$question9','$difficulte','$date')";
        $resultq9 = mysqli_query($conn, $sqlquestion9);

        if (!$resultq9) {
            echo "Erreur lors de l'ajout de la question9";
            break;
        }

        $sqlidquestion9 = "SELECT `Id_question` FROM `question` WHERE question = '$question9'";
        $resultidquestion9 = mysqli_query($conn, $sqlidquestion9);

        if (mysqli_num_rows($resultidquestion9) > 0) {
            while ($row10 = mysqli_fetch_assoc($resultidquestion9)) {
                $id_q9 = $row10['Id_question'];
            }
        }


        $sqlrep9 = "INSERT INTO `choix`(`rep1`,`rep2`, `rep3`, `Bonne_reponse`, `Id_question`) VALUES ('$q9rep1','$q9rep2','$q9rep3','$q9bonnerep', '$id_q9')";
        $resultrep9 = mysqli_query($conn, $sqlrep9);

        if (!$resultrep9) {
            echo "Erreur lors de l'ajout de la reponse9";
            break;
        }
//------------------------------------------------------------------------------------------------------------------------------ 
        $sqlquestion10 = "INSERT INTO `question`(`Id_quizz`, `question`, `difficulte`, `date_creation`) VALUES ('$id_quizz','$question10','$difficulte','$date')";
        $resultq10 = mysqli_query($conn, $sqlquestion10);

        if (!$resultq10) {
            echo "Erreur lors de l'ajout de la question10";
            break;
        }

        $sqlidquestion10 = "SELECT `Id_question` FROM `question` WHERE question = '$question10'";
        $resultidquestion10 = mysqli_query($conn, $sqlidquestion10);

        if (mysqli_num_rows($resultidquestion10) > 0) {
            while ($row11 = mysqli_fetch_assoc($resultidquestion10)) {
                $id_q10 = $row11['Id_question'];
            }
        }


        $sqlrep10 = "INSERT INTO `choix`(`rep1`,`rep2`, `rep3`, `Bonne_reponse`, `Id_question`) VALUES ('$q10rep1','$q10rep2','$q10rep3','$q10bonnerep', '$id_q10')";
        $resultrep10 = mysqli_query($conn, $sqlrep10);

        if (!$resultrep10) {
            echo "Erreur lors de l'ajout de la reponse10";
            break;
        }
//------------------------------------------------------------------------------------------------------------------------------ 

        header('Location:dashboard.php?role='.$role.'&user='.$id_user.'');
        exit;

    } while (false);
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="https://img.icons8.com/sf-black/64/000000/search.png">
    <link rel="stylesheet" href="creation.css">
    <title>Quizzeo</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
</head>

<body>
    <header>
        <?php
            echo "<a class='home' href='home.php?role=$role&user=$id_user'>";
            echo "<span>Quiz</span><span>zeo.</span>";
            echo "</a>";
        ?>
        <div class="options">
            <?php 
                $sqlutilisateur = "SELECT * FROM utilisateur WHERE Id_utilisateur = '$id_user'";
                $resultutilisateur = mysqli_query($conn, $sqlutilisateur);

                $row = mysqli_fetch_assoc($resultutilisateur);
                $role_user = $row['role_utilisateur'];
                $pseudo = $row['pseudo'];
                $email = $row['email'];
                $id_utilisateur = $row['Id_utilisateur'];

                echo "<h2>$pseudo</h2>";
                echo "<a id='profil' href='dashboard.php?role=$role&user=$id_user'>";
                echo "<img src='https://cdn-icons-png.flaticon.com/512/149/149071.png' alt='Photo de profil'>";
                echo "</a>";

            ?>
        </div>
    </header>
    <div class="container">
        <div class="info-container">
            <h1>Création de quiz</h1>
            <img src="https://img.icons8.com/color/256/add-folder.png">
        </div>
        <div id="pageCreate">
            <form  method="post" action="">
                <div class="info-container">
                    <input class="input-quiz" type="text" placeholder="Titre" name="titre" id="titre" maxlength="15" required>
                    <!-- <input class="input-quiz" type="text" placeholder="Titre" maxlength="20" required
                        oninvalid="this.style.border='2px solid #ff5f45';"> -->
                    <h2>Difficulté</h2>
                    <select name="difficulte" class="input-quiz difficulty" id="difficulte" placeholder="aze" required>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                    </select>
                    <input class="input-quiz" type="text" placeholder="Catégorie" name="categorie" id="categorie" maxlength="15" required>
                </div>
                <div class="container-question">
                    <div class="question">
                        <div class="bar"></div>
                        <div class="question2">
                            <div class="number">
                                <h3>1</h3>
                            </div>
                            <h3>Question</h3>
                            <input type="text" name="question1" id="question1" placeholder="Quel est la couleur du cheval blanc de Henri IV ?">
                        </div>
                        <div class="arrow">
                            <img src="https://img.icons8.com/fluency-systems-regular/256/expand-arrow.png" alt="arrow">
                        </div>
                    </div>
                    <div class="container-answer">
                        <div class="answer">
                            <div>
                                <label for="answer1" class="letter">A</label>
                                <input type="text" name="q1rep1" id="q1rep1" required>
                            </div>
                            <div>
                                <label for="answer2" class="letter">B</label>
                                <input type="text" name="q1rep2" id="q1rep2" required>
                            </div>
                            <div>
                                <label for="answer3" class="letter">C</label>
                                <input type="text" name="q1rep3" id="q1rep3" required>
                            </div>
                            <div>
                                <label for="answer4" class="letter">D</label>
                                <input type="text" name="q1bonnerep" id="q1bonnerep" placeholder="Bonne réponse" required>
                            </div>
                            <div class="check">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container-question">
                <div class="question">
                        <div class="bar"></div>
                        <div class="question2">
                            <div class="number">
                                <h3>2</h3>
                            </div>
                            <h3>Question</h3>
                            <input type="text" name="question2" id="question2" placeholder="Quel est la couleur du cheval blanc de Henri IV ?">
                        </div>
                        <div class="arrow">
                            <img src="https://img.icons8.com/fluency-systems-regular/256/expand-arrow.png" alt="arrow">
                        </div>
                    </div>
                    <div class="container-answer">
                        <div class="answer">
                            <div>
                                <label for="answer1" class="letter">A</label>
                                <input type="text" name="q2rep1" id="q2rep1" required>
                            </div>
                            <div>
                                <label for="answer2" class="letter">B</label>
                                <input type="text" name="q2rep2" id="q2rep2" required>
                            </div>
                            <div>
                                <label for="answer3" class="letter">C</label>
                                <input type="text" name="q2rep3" id="q2rep3" required>
                            </div>
                            <div>
                                <label for="answer4" class="letter">D</label>
                                <input type="text" name="q2bonnerep" id="q2bonnerep" placeholder="Bonne réponse" required>
                            </div>
                            <div class="check">

                            </div>
                        </div>
                    </div>
                </div>

                <div class="container-question">
                <div class="question">
                        <div class="bar"></div>
                        <div class="question2">
                            <div class="number">
                                <h3>3</h3>
                            </div>
                            <h3>Question</h3>
                            <input type="text" name="question3" id="question3" placeholder="Quel est la couleur du cheval blanc de Henri IV ?">
                        </div>
                        <div class="arrow">
                            <img src="https://img.icons8.com/fluency-systems-regular/256/expand-arrow.png" alt="arrow">
                        </div>
                    </div>
                    <div class="container-answer">
                        <div class="answer">
                            <div>
                                <label for="answer1" class="letter">A</label>
                                <input type="text" name="q3rep1" id="q3rep1" required>
                            </div>
                            <div>
                                <label for="answer2" class="letter">B</label>
                                <input type="text" name="q3rep2" id="q3rep2" required>
                            </div>
                            <div>
                                <label for="answer3" class="letter">C</label>
                                <input type="text" name="q3rep3" id="q3rep3" required>
                            </div>
                            <div>
                                <label for="answer4" class="letter">D</label>
                                <input type="text" name="q3bonnerep" id="q3bonnerep" placeholder="Bonne réponse" required>
                            </div>
                            <div class="check">

                            </div>
                        </div>
                    </div>
                </div>

                <div class="container-question">
                <div class="question">
                        <div class="bar"></div>
                        <div class="question2">
                            <div class="number">
                                <h3>4</h3>
                            </div>
                            <h3>Question</h3>
                            <input type="text" name="question4" id="question4" placeholder="Quel est la couleur du cheval blanc de Henri IV ?">
                        </div>
                        <div class="arrow">
                            <img src="https://img.icons8.com/fluency-systems-regular/256/expand-arrow.png" alt="arrow">
                        </div>
                    </div>
                    <div class="container-answer">
                        <div class="answer">
                            <div>
                                <label for="answer1" class="letter">A</label>
                                <input type="text" name="q4rep1" id="q4rep1" required>
                            </div>
                            <div>
                                <label for="answer2" class="letter">B</label>
                                <input type="text" name="q4rep2" id="q4rep2" required>
                            </div>
                            <div>
                                <label for="answer3" class="letter">C</label>
                                <input type="text" name="q4rep3" id="q4rep3" required>
                            </div>
                            <div>
                                <label for="answer4" class="letter">D</label>
                                <input type="text" name="q4bonnerep" id="q4bonnerep" placeholder="Bonne réponse" required>
                            </div>
                            <div class="check">

                            </div>
                        </div>
                    </div>
                </div>

                <div class="container-question">
                <div class="question">
                        <div class="bar"></div>
                        <div class="question2">
                            <div class="number">
                                <h3>5</h3>
                            </div>
                            <h3>Question</h3>
                            <input type="text" name="question5" id="question5" placeholder="Quel est la couleur du cheval blanc de Henri IV ?">
                        </div>
                        <div class="arrow">
                            <img src="https://img.icons8.com/fluency-systems-regular/256/expand-arrow.png" alt="arrow">
                        </div>
                    </div>
                    <div class="container-answer">
                        <div class="answer">
                            <div>
                                <label for="answer1" class="letter">A</label>
                                <input type="text" name="q5rep1" id="q5rep1" required>
                            </div>
                            <div>
                                <label for="answer2" class="letter">B</label>
                                <input type="text" name="q5rep2" id="q5rep2" required>
                            </div>
                            <div>
                                <label for="answer3" class="letter">C</label>
                                <input type="text" name="q5rep3" id="q5rep3" required>
                            </div>
                            <div>
                                <label for="answer4" class="letter">D</label>
                                <input type="text" name="q5bonnerep" id="q5bonnerep" placeholder="Bonne réponse" required>
                            </div>
                            <div class="check">

                            </div>
                        </div>
                    </div>
                </div>

                <div class="container-question">
                <div class="question">
                        <div class="bar"></div>
                        <div class="question2">
                            <div class="number">
                                <h3>6</h3>
                            </div>
                            <h3>Question</h3>
                            <input type="text" name="question6" id="question6" placeholder="Quel est la couleur du cheval blanc de Henri IV ?">
                        </div>
                        <div class="arrow">
                            <img src="https://img.icons8.com/fluency-systems-regular/256/expand-arrow.png" alt="arrow">
                        </div>
                    </div>
                    <div class="container-answer">
                        <div class="answer">
                            <div>
                                <label for="answer1" class="letter">A</label>
                                <input type="text" name="q6rep1" id="q6rep1" required>
                            </div>
                            <div>
                                <label for="answer2" class="letter">B</label>
                                <input type="text" name="q6rep2" id="q6rep2" required>
                            </div>
                            <div>
                                <label for="answer3" class="letter">C</label>
                                <input type="text" name="q6rep3" id="q6rep3" required>
                            </div>
                            <div>
                                <label for="answer4" class="letter">D</label>
                                <input type="text" name="q6bonnerep" id="q6bonnerep" placeholder="Bonne réponse" required>
                            </div>
                            <div class="check">

                            </div>
                        </div>
                    </div>
                </div>

                <div class="container-question">
                <div class="question">
                        <div class="bar"></div>
                        <div class="question2">
                            <div class="number">
                                <h3>7</h3>
                            </div>
                            <h3>Question</h3>
                            <input type="text" name="question7" id="question7" placeholder="Quel est la couleur du cheval blanc de Henri IV ?">
                        </div>
                        <div class="arrow">
                            <img src="https://img.icons8.com/fluency-systems-regular/256/expand-arrow.png" alt="arrow">
                        </div>
                    </div>
                    <div class="container-answer">
                        <div class="answer">
                            <div>
                                <label for="answer1" class="letter">A</label>
                                <input type="text" name="q7rep1" id="q7rep1" required>
                            </div>
                            <div>
                                <label for="answer2" class="letter">B</label>
                                <input type="text" name="q7rep2" id="q7rep2" required>
                            </div>
                            <div>
                                <label for="answer3" class="letter">C</label>
                                <input type="text" name="q7rep3" id="q7rep3" required>
                            </div>
                            <div>
                                <label for="answer4" class="letter">D</label>
                                <input type="text" name="q7bonnerep" id="q7bonnerep" placeholder="Bonne réponse" required>
                            </div>
                            <div class="check">

                            </div>
                        </div>
                    </div>
                </div>

                <div class="container-question">
                <div class="question">
                        <div class="bar"></div>
                        <div class="question2">
                            <div class="number">
                                <h3>8</h3>
                            </div>
                            <h3>Question</h3>
                            <input type="text" name="question8" id="question8" placeholder="Quel est la couleur du cheval blanc de Henri IV ?">
                        </div>
                        <div class="arrow">
                            <img src="https://img.icons8.com/fluency-systems-regular/256/expand-arrow.png" alt="arrow">
                        </div>
                    </div>
                    <div class="container-answer">
                        <div class="answer">
                            <div>
                                <label for="answer1" class="letter">A</label>
                                <input type="text" name="q8rep1" id="q8rep1" required>
                            </div>
                            <div>
                                <label for="answer2" class="letter">B</label>
                                <input type="text" name="q8rep2" id="q8rep2" required>
                            </div>
                            <div>
                                <label for="answer3" class="letter">C</label>
                                <input type="text" name="q8rep3" id="q8rep3" required>
                            </div>
                            <div>
                                <label for="answer4" class="letter">D</label>
                                <input type="text" name="q8bonnerep" id="q8bonnerep" placeholder="Bonne réponse" required>
                            </div>
                            <div class="check">
                  
                            </div>

                        </div>
                    </div>
                </div>

                <div class="container-question">
                <div class="question">
                        <div class="bar"></div>
                        <div class="question2">
                            <div class="number">
                                <h3>9</h3>
                            </div>
                            <h3>Question</h3>
                            <input type="text" name="question9" id="question9" placeholder="Quel est la couleur du cheval blanc de Henri IV ?">
                        </div>
                        <div class="arrow">
                            <img src="https://img.icons8.com/fluency-systems-regular/256/expand-arrow.png" alt="arrow">
                        </div>
                    </div>
                    <div class="container-answer">
                        <div class="answer">
                            <div>
                                <label for="answer1" class="letter">A</label>
                                <input type="text" name="q9rep1" id="q9rep1" required>
                            </div>
                            <div>
                                <label for="answer2" class="letter">B</label>
                                <input type="text" name="q9rep2" id="q9rep2" required>
                            </div>
                            <div>
                                <label for="answer3" class="letter">C</label>
                                <input type="text" name="q9rep3" id="q9rep3" required>
                            </div>
                            <div>
                                <label for="answer4" class="letter">D</label>
                                <input type="text" name="q9bonnerep" id="q9bonnerep" placeholder="Bonne réponse" required>
                            </div>
                            <div class="check">

                            </div>
                        </div>
                    </div>
                </div>

                <div class="container-question">
                <div class="question">
                        <div class="bar"></div>
                        <div class="question2">
                            <div class="number">
                                <h3>10</h3>
                            </div>
                            <h3>Question</h3>
                            <input type="text" name="question10" id="question10" placeholder="Quel est la couleur du cheval blanc de Henri IV ?">
                        </div>
                        <div class="arrow">
                            <img src="https://img.icons8.com/fluency-systems-regular/256/expand-arrow.png" alt="arrow">
                        </div>
                    </div>
                    <div class="container-answer">
                        <div class="answer">
                            <div>
                                <label for="answer1" class="letter">A</label>
                                <input type="text" name="q10rep1" id="q10rep1" required>
                            </div>
                            <div>
                                <label for="answer2" class="letter">B</label>
                                <input type="text" name="q10rep2" id="q10rep2" required>
                            </div>
                            <div>
                                <label for="answer3" class="letter">C</label>
                                <input type="text" name="q10rep3" id="q10rep3" required>
                            </div>
                            <div>
                                <label for="answer4" class="letter">D</label>
                                <input type="text" name="q10bonnerep" id="q10bonnerep" placeholder="Bonne réponse" required>
                            </div>
                            <div class="check">

                            </div>
                        </div>
                    </div>
                </div>
                <input id="button-submit" type="submit" value="Créer">
            </form>
        </div>
    </div>
    <script src="script.js"></script>
    <script>
        $(".arrow").click(function () {

        var $containerAnswer = $(this).closest(".container-question").find(".container-answer");
        var $containerBar = $(this).closest(".container-question").find(".bar");
        
        if ($containerAnswer.height() > 0) {
            $containerAnswer.height(0);
            $containerBar.height(60);
        } else {
            $containerAnswer.height(
                $containerAnswer.prop("scrollHeight") + "px"
            );
            $containerBar.height(
                $containerBar.prop("scrollHeight") + "px"
            );
        }
        });

        $(".arrow").click(function () {
            $(this).toggleClass("rotate");
        });
    </script>
</body>

</html>