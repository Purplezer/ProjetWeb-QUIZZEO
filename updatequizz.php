<?php 
require('bdconnexion.php');

if(isset($_GET['user'])) {
    $id_user = $_GET['user'];
}

if(isset($_GET['role'])) {
    $role = $_GET['role'];
}

if(isset($_GET['updatequizz'])) {
    $id_quizz = $_GET['updatequizz'];
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


//------------------------------------------------------------------------------------------------------------------------------
        $sqlquizz = "SELECT * FROM `quizz` WHERE `Id_quizz` = '$id_quizz'";
        $resultquizz = mysqli_query($conn, $sqlquizz);

        if (mysqli_num_rows($resultquizz) > 0) {
            while ($row = mysqli_fetch_assoc($resultquizz)) {
                $titrequizz = $row["Titre"];
                $difficulte = $row["difficulte"];
                $categorie = $row["Categorie"];
                $datequizz = $row["date_creation"];

                echo $titrequizz;
                echo $difficulte;
                echo $categorie;
                echo $datequizz;
            }
        }

//------------------------------------------------------------------------------------------------------------------------------
$sqlquestion = "SELECT * FROM `question` WHERE `Id_quizz` = '$id_quizz'";
$resultquestion = mysqli_query($conn, $sqlquestion);

$questions = array();

if (mysqli_num_rows($resultquestion) > 0) {
    while ($row2 = mysqli_fetch_assoc($resultquestion)) {
        $question = $row2["question"];
        $difficultequestion = $row2["difficulte"];
        $id_question = $row2["Id_question"];

        $reponses = array();
        $sqlchoix = "SELECT * FROM `choix` WHERE `Id_question` = '$id_question'";
        $resultchoix = mysqli_query($conn, $sqlchoix);

        if (mysqli_num_rows($resultchoix) > 0) {
            while ($row3 = mysqli_fetch_assoc($resultchoix)) {
                $reponses[] = array (
                    "id" => $row3["Id_rep"],
                    "rep1" => $row3["rep1"],
                    "rep2" => $row3["rep2"],
                    "rep3" => $row3["rep3"],
                    "bonne_reponse" => $row3["Bonne_reponse"]
                );
            }
        }

        $questions[] = array (
            "id" => $id_question,
            "question" => $question,
            "reponses" => $reponses
        );
    }
}

// Maintenant, vous pouvez accéder aux questions et à leurs réponses de la manière suivante :

$q1 = $questions[0]["question"];
$q1rep1 = $questions[0]["reponses"][0]["rep1"];
$q1rep2 = $questions[0]["reponses"][0]["rep2"];
$q1rep3 = $questions[0]["reponses"][0]["rep3"];
$q1bonnerep = $questions[0]["reponses"][0]["bonne_reponse"];

$q2 = $questions[1]["question"];
$q2rep1 = $questions[1]["reponses"][0]["rep1"];
$q2rep2 = $questions[1]["reponses"][0]["rep2"];
$q2rep3 = $questions[1]["reponses"][0]["rep3"];
$q2bonnerep = $questions[1]["reponses"][0]["bonne_reponse"];

$q3 = $questions[2]["question"];
$q3rep1 = $questions[2]["reponses"][0]["rep1"];
$q3rep2 = $questions[2]["reponses"][0]["rep2"];
$q3rep3 = $questions[2]["reponses"][0]["rep3"];
$q3bonnerep = $questions[2]["reponses"][0]["bonne_reponse"];

$q4 = $questions[3]["question"];
$q4rep1 = $questions[3]["reponses"][0]["rep1"];
$q4rep2 = $questions[3]["reponses"][0]["rep2"];
$q4rep3 = $questions[3]["reponses"][0]["rep3"];
$q4bonnerep = $questions[3]["reponses"][0]["bonne_reponse"];

$q5 = $questions[4]["question"];
$q5rep1 = $questions[4]["reponses"][0]["rep1"];
$q5rep2 = $questions[4]["reponses"][0]["rep2"];
$q5rep3 = $questions[4]["reponses"][0]["rep3"];
$q5bonnerep = $questions[4]["reponses"][0]["bonne_reponse"];

$q6 = $questions[5]["question"];
$q6rep1 = $questions[5]["reponses"][0]["rep1"];
$q6rep2 = $questions[5]["reponses"][0]["rep2"];
$q6rep3 = $questions[5]["reponses"][0]["rep3"];
$q6bonnerep = $questions[5]["reponses"][0]["bonne_reponse"];

$q7 = $questions[6]["question"];
$q7rep1 = $questions[6]["reponses"][0]["rep1"];
$q7rep2 = $questions[6]["reponses"][0]["rep2"];
$q7rep3 = $questions[6]["reponses"][0]["rep3"];
$q7bonnerep = $questions[6]["reponses"][0]["bonne_reponse"];

$q8 = $questions[7]["question"];
$q8rep1 = $questions[7]["reponses"][0]["rep1"];
$q8rep2 = $questions[7]["reponses"][0]["rep2"];
$q8rep3 = $questions[7]["reponses"][0]["rep3"];
$q8bonnerep = $questions[7]["reponses"][0]["bonne_reponse"];

$q9 = $questions[8]["question"];
$q9rep1 = $questions[8]["reponses"][0]["rep1"];
$q9rep2 = $questions[8]["reponses"][0]["rep2"];
$q9rep3 = $questions[8]["reponses"][0]["rep3"];
$q9bonnerep = $questions[8]["reponses"][0]["bonne_reponse"];

$q10 = $questions[9]["question"];
$q10rep1 = $questions[9]["reponses"][0]["rep1"];
$q10rep2 = $questions[9]["reponses"][0]["rep2"];
$q10rep3 = $questions[9]["reponses"][0]["rep3"];
$q10bonnerep = $questions[9]["reponses"][0]["bonne_reponse"];




//------------------------------------------------------------------------------------------------------------------------------


    //------------------------------------------------------------------------------------------------------------------------------
    
    


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
            <form  method="post">
                <div class="info-container">
                    <input class="input-quiz" type="text" placeholder="Titre" name="titre" id="titre" value="<?php echo $titrequizz ?>" maxlength="15" required>
                    <!-- <input class="input-quiz" type="text" placeholder="Titre" maxlength="20" required
                        oninvalid="this.style.border='2px solid #ff5f45';"> -->
                    <h2>Difficulté</h2>
                    <select name="difficulte" class="input-quiz difficulty" id="difficulte" value="<?php echo $difficulte ?>" placeholder="aze" required>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                    </select>
                    <input class="input-quiz" type="text" placeholder="Catégorie" name="categorie" id="categorie" value="<?php echo $categorie ?>" maxlength="15" required>
                </div>
                <div class="container-question">
                    <div class="question">
                        <div class="bar"></div>
                        <div class="question2">
                            <div class="number">
                                <h3>1</h3>
                            </div>
                            <h3>Question</h3>
                            <input type="text" name="question1" id="question1" value="<?php echo $q1 ?>">
                        </div>
                        <div class="arrow">
                            <img src="https://img.icons8.com/fluency-systems-regular/256/expand-arrow.png" alt="arrow">
                        </div>
                    </div>
                    <div class="container-answer">
                        <div class="answer">
                            <div>
                                <label for="answer1" class="letter">A</label>
                                <input type="text" name="q1rep1" id="q1rep1" value="<?php echo $q1rep1 ?>" required>
                            </div>
                            <div>
                                <label for="answer2" class="letter">B</label>
                                <input type="text" name="q1rep2" id="q1rep2" value="<?php echo $q1rep2 ?>" required>
                            </div>
                            <div>
                                <label for="answer3" class="letter">C</label>
                                <input type="text" name="q1rep3" id="q1rep3" value="<?php echo $q1rep3 ?>" required>
                            </div>
                            <div>
                                <label for="answer4" > Bonne réponse </label>
                                <input type="text" name="q1bonnerep" id="q1bonnerep" value="<?php echo $q1bonnerep ?>" required>
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
                            <input type="text" name="question2" id="question2" value="<?php echo $q2 ?>">
                        </div>
                        <div class="arrow">
                            <img src="https://img.icons8.com/fluency-systems-regular/256/expand-arrow.png" alt="arrow">
                        </div>
                    </div>
                    <div class="container-answer">
                        <div class="answer">
                            <div>
                                <label for="answer1" class="letter">A</label>
                                <input type="text" name="q2rep1" id="q2rep1" value="<?php echo $q2rep1 ?>" required>
                            </div>
                            <div>
                                <label for="answer2" class="letter">B</label>
                                <input type="text" name="q2rep2" id="q2rep2" value="<?php echo $q2rep2 ?>" required>
                            </div>
                            <div>
                                <label for="answer3" class="letter">C</label>
                                <input type="text" name="q2rep3" id="q2rep3" value="<?php echo $q2rep3 ?>" required>
                            </div>
                            <div>
                                <label for="answer4" >Bonne réponse</label>
                                <input type="text" name="q2bonnerep" id="q2bonnerep" value="<?php echo $q2bonnerep ?>" required>
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
                            <input type="text" name="question3" id="question3" value="<?php echo $q3 ?>">
                        </div>
                        <div class="arrow">
                            <img src="https://img.icons8.com/fluency-systems-regular/256/expand-arrow.png" alt="arrow">
                        </div>
                    </div>
                    <div class="container-answer">
                        <div class="answer">
                            <div>
                                <label for="answer1" class="letter">A</label>
                                <input type="text" name="q3rep1" id="q3rep1" value="<?php echo $q3rep1 ?>" required>
                            </div>
                            <div>
                                <label for="answer2" class="letter">B</label>
                                <input type="text" name="q3rep2" id="q3rep2" value="<?php echo $q3rep2 ?>" required>
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
    <?php 
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
        
        
            // do {
            }
    ?>
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