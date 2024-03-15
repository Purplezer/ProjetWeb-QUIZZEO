<?php

    require ('bdconnexion.php');        // Connection to the database

    if(isset($_GET['id_quizz'])) {      // Get the id of the quizz from the url
        $id_quizz = $_GET['id_quizz'];
        $sql = "SELECT * FROM question WHERE Id_quizz = " . $id_quizz;  // Get the questions of the quizz from the database
        $result = mysqli_query($conn, $sql);                 // Execute the query
        
    }

    if(isset($_GET['user'])) {      // Get the id of the user from the url  
        $id_user = $_GET['user'];       
    }

    if(isset($_GET['role'])) {      // Get the role of the user from the url
        $role = $_GET['role'];
    }


    $questions = array();       // Array of questions
                        
    if (mysqli_num_rows($result) > 0) {         // If there is at least one question
        while($row1 = mysqli_fetch_assoc($result)) {        // For each question
            $id_question = $row1['Id_question'];        // Get the id of the question
            $question = $row1['question'];          // Get the question
                                
            $sql2 = "SELECT * FROM choix WHERE Id_question = " . $id_question;      // Get the answers of the question from the database
            $result2 = mysqli_query($conn, $sql2);      // Execute the query
            $reponsesjs = array();              // Array of answers 
            if (mysqli_num_rows($result2) > 0) {    // If there is at least one answer
                while($row2=mysqli_fetch_assoc($result2)) {    // For each answer

                    $reponses = array(          // We create an array of answers
                        'reponse1' => $row2['rep1'],        // Get the answer 1
                        'reponse2' => $row2['rep2'],        // Get the answer 2
                        'reponse3' => $row2['rep3'],        // Get the answer 3
                        'Bonne_rep'=> $row2['Bonne_reponse']    // Get the good answer
                    );

                    $rep1 = $row2['rep1'];      
                    $rep2 = $row2['rep2'];
                    $rep3 = $row2['rep3'];
                    $bonnerep = $row2['Bonne_reponse'];

                    $reponsesjs[] = $reponses;
                }
            }
                                
            $questions[] = array(           // We create an array of questions
                'question' => $question
            );

            $rep[] = array(         // We create an array of answers
                'reponse1' => $rep1,
                'reponse2' => $rep2,
                'reponse3' => $rep3,
                'Bonne_rep' => $bonnerep
            );
        }
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="https://img.icons8.com/sf-black/64/000000/search.png">
    <link rel="stylesheet" href="quiz.css">
    <title>Quizzeo</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
</head>

<body>
    <audio id="audio" preload="auto" loop>
        <source src="quiz-show-timer-30-sec-music-for-content-creator.mp3" type="audio/mpeg">
        Your browser does not support the audio element.
    </audio>

    <header>
        <?php               // Bouton Home              
            echo "<a class='home' href='home.php?role=$role&user=$id_user'>";       // We send the role and the id of the user to the home page
            echo "<span>Quiz</span><span>zeo.</span>";
            echo "</a>";
        ?>
        <div class="options">
            <?php           //Bouton profil
                $sqlutilisateur = "SELECT * FROM utilisateur WHERE Id_utilisateur = '$id_user'";    // Get the user from the database
                $resultutilisateur = mysqli_query($conn, $sqlutilisateur);      // Execute the query

                $row = mysqli_fetch_assoc($resultutilisateur);      // Get the user
                $role_user = $row['role_utilisateur'];      // Get the role of the user
                $pseudo = $row['pseudo'];       // Get the pseudo of the user
                $email = $row['email'];     // Get the email of the user
                $id_utilisateur = $row['Id_utilisateur'];       // Get the id of the user

                echo "<h2>$pseudo</h2>";        // Display the pseudo of the user
                echo "<a id='profil' href='dashboard.php?role=$role&user=$id_user'>";     // We send the role and the id of the user to the dashboard page
                echo "<img src='https://cdn-icons-png.flaticon.com/512/149/149071.png' alt='Photo de profil'>";     // Photo of profil
                echo "</a>";
            ?>
        </div>
    </header>
    <div class="container">
        <div class="container-question">
            <h2 id="number-question"></h2>
            <div class="container-countdown" id="container-countdown">
                <h2 id="countdown">60</h2>
            </div>
        </div>
        <div class="container-answer">
            <div class="question" id="question"></div>
            <div class="answers" id="answers"></div>
            <button type="submit" id="valider">Valider</button>
            <button type="submit" id="home">Accueil</button>
            <button type="submit" id="retry">Recommencer</button>
        </div>
    </div>
</body>

</html>

<script>
        const _quest = document.getElementById('question');         // Get the question
		const _answers = document.querySelector('.answers');            // Get the answers
		const _submit = document.getElementById('valider');         // Get the button valider
        const _nbquestion = document.getElementById('number-question');         // Get the number of the question

        const _countdown = document.getElementById('container-countdown');      // Get the countdown
        const _home = document.getElementById('home');      // Get the button home
        const _retry = document.getElementById('retry');        // Get the button retry

		var questions = <?php echo json_encode($questions) ?>;      // Get the questions 
		var reponses = <?php echo json_encode($rep) ?>;     // Get the answers
        var user = <?php echo json_encode($id_user) ?>;     // Get the id of the user
        var idquizz = <?php echo json_encode($id_quizz) ?>;     // Get the id of the quizz
        var role = <?php echo json_encode($role) ?>;        // Get the role of the user
		var quizz = [];     // Create an array of quizz


        _home.style.display = "none";       // Hide the button home
        _retry.style.display = "none";      // Hide the button retry



		for (let i = 0; i < questions.length; i++) {        // We create an array of quizz
            let options = [         // We create an array of options
                reponses[i].reponse1,
                reponses[i].reponse2,
                reponses[i].reponse3,
                reponses[i].Bonne_rep
            ];

            for (let j = options.length - 1 ; j > 0 ; j--) {    // We shuffle the options
                const k = Math.floor(Math.random() * (j + 1));
                [options[j], options[k]] = [options[k], options[j]];
            }

            let quiz = {        // We create an object of quizz
                question: questions[i].question,        
                options: options,
                correct: reponses[i].Bonne_rep
            };


			quizz.push(quiz);       // We add the object to the array of quizz
		}

        var numberquestion = 1;     // We create a variable to count the number of the question for display the count of question
		var numquestion = 0;    // We create a variable to count the number of the question for display the question      
		var score = 0;          // We create a variable score
		var isanswered = false; // We create a variable to know if the question is answered


        displayQuestion(numquestion);
            
        function displayQuestion(num) {
            _nbquestion.innerHTML = 'Question ' + numberquestion + '/' + quizz.length;
            _quest.innerHTML = '<h1>' + quizz[num].question + '</h1>';
            var xhr = new XMLHttpRequest();
            var url = 'score.php';
            var data = 'score=' + score + '&user=' + user + '&idquizz=' + idquizz;; // score est la variable que vous souhaitez envoyer

            let optionsHtml = '';
            for (let i = 0; i < quizz[num].options.length; i++) {
                optionsHtml += '<label class="answer">';
                optionsHtml += '<input type="radio" name="option" value="' + quizz[num].options[i] + '" required>';
                optionsHtml += quizz[num].options[i];
                optionsHtml += '</label>';
            }

            _answers.innerHTML = optionsHtml;
            xhr.open('POST', url, true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                    console.log(xhr.responseText); // Affiche la réponse du script PHP
                }
            };
            xhr.send(data);
        }

        _submit.addEventListener('click', function() {
        if (isanswered === false) {
            var options = document.getElementsByName('option');
            var selectedOption = '';
            for (let i = 0; i < options.length; i++) {
                if (options[i].checked) {
                    selectedOption = options[i].value;
                    break;
                }
            }

            isanswered = true;
            if (selectedOption === quizz[numquestion].correct) {
                score++;
            }
            numquestion++;
            numberquestion++;
            if (numquestion < quizz.length) {
                resetTimer();
                _nbquestion.innerHTML = "Question " + numberquestion + "/10";
                _quest.innerHTML = "<h1>" + quizz[numquestion].question + "</h1>";
                _answers.innerHTML = '';

                for (let i = 0; i < quizz[numquestion].options.length; i++) {
                    _answers.innerHTML += "<label class='answer'>" + "<input type='radio' name='option' value='" + quizz[numquestion].options[i] + "'required>" + quizz[numquestion].options[i] + "</label>";
                }

            } else {
                _quest.innerHTML = "<h1>Le quizz est terminé !</h1>";
                _answers.innerHTML = "<p>Votre score est de " + score + " sur " + quizz.length + ".</p>";

                _home.style.display = 'block';
                _retry.style.display = 'block';

                _nbquestion.style.display = 'none';
                _submit.style.display = 'none';
                _countdown.style.display = 'none';

                var xhr = new XMLHttpRequest();
                var url = 'score.php';
                var data = 'score=' + score + '&user=' + user + '&idquizz=' + idquizz;; // score est la variable que vous souhaitez envoyer

                xhr.open('POST', url, true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.onreadystatechange = function() {

                if (xhr.readyState === 4 && xhr.status === 200) {
                    console.log(xhr.responseText); // Affiche la réponse du script PHP
                }
                };
                xhr.send(data);

            
            }
            isanswered = false;
        }
        });


            _home.addEventListener('click', () => {
                window.location.href = "home.php?user=" + user + "&role=" + role;
            });

            _retry.addEventListener('click', () => {
                window.location.href = "quiz.php?id_quizz=" + idquizz + "&user=" + user + "&role=" + role;
            });

            var timeleft = 60;
            var downloadTimer = setInterval(function(){
            if(timeleft <= 0){
                clearInterval(downloadTimer);
                document.getElementById("countdown").innerHTML = "Temps écoulé !";
                _quest.innerHTML = "<h1>Vous avez terminé le quizz !</h1>";
                _answers.innerHTML = "<h2>Votre score est de " + score + " sur " + quizz.length + "</h2>";
                _submit.style.display = 'none';
                _nbquestion.style.display = 'none';
                _countdown.style.display = 'none';

                _home.style.display = 'block';
                _retry.style.display = 'block';


                var xhr = new XMLHttpRequest();
                var url = 'score.php';
                var data = 'score=' + score + '&user=' + user + '&idquizz=' + idquizz;; // score est la variable que vous souhaitez envoyer

                xhr.open('POST', url, true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.onreadystatechange = function() {
                            if (xhr.readyState === 4 && xhr.status === 200) {
                                        console.log(xhr.responseText); // Affiche la réponse du script PHP
                            }
                };
                xhr.send(data);
            } else {
                document.getElementById("countdown").innerHTML = timeleft;
            }
 
            timeleft -= 1;
            }, 1000);

            function resetTimer() {
                clearInterval(downloadTimer);
                timeleft = 60;
                 downloadTimer = setInterval(function() {
                    if(timeleft <= 0) {
                        clearInterval(downloadTimer);
                        document.getElementById("countdown").innerHTML = "Temps écoulé !";
                        _quest.innerHTML = "<h1>Vous avez terminé le quizz !</h1>";
                        _answers.innerHTML = "<h2>Votre score est de " + score + " sur " + quizz.length + "</h2>";
                        _submit.style.display = 'none';
                        _nbquestion.style.display = 'none';
                        _countdown.style.display = 'none';

                        _home.style.display = 'block';
                        _retry.style.display = 'block';


                        var xhr = new XMLHttpRequest();
                        var url = 'score.php';
                        var data = 'score=' + score + '&user=' + user + '&idquizz=' + idquizz;; // score est la variable que vous souhaitez envoyer

                        xhr.open('POST', url, true);
                        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                        xhr.onreadystatechange = function() {
                                    if (xhr.readyState === 4 && xhr.status === 200) {
                                                        console.log(xhr.responseText); // Affiche la réponse du script PHP
                                    }
                        };
                        xhr.send(data);
                    } else {
                        document.getElementById("countdown").innerHTML = timeleft;
                    }

                    timeleft -= 1;
                }, 1000);
            }

            
        
</script>

