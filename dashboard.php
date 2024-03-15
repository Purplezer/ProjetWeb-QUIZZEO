<?php
                            
require('bdconnexion.php');

if(isset($_GET['user'])) {
    $id_user = $_GET['user'];
}

if(isset($_GET['role'])) {
    $role = $_GET['role'];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="https://img.icons8.com/sf-black/64/000000/search.png">
    <link rel="stylesheet" href="dashboard.css">
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
        <div class="onglets">
            <div>
                <div class="button active" data-onglet ="onglet-1">
                    <img src="https://img.icons8.com/fluency-systems-regular/256/home.png" alt="home">
                </div>
                <div class="button" data-onglet="onglet-2">
                    <img src="https://img.icons8.com/fluency-systems-regular/256/plus-math.png" alt="add">
                </div>
                <hr>
                <div class="button" data-onglet="onglet-3">
                    <img src="https://img.icons8.com/fluency-systems-regular/256/test.png" alt="quiz">
                </div>
                <div class="button" data-onglet="onglet-4">
                    <img src="https://img.icons8.com/fluency-systems-regular/256/security-user-male.png"
                        alt="admin">
                </div>
            </div>
            <div>
                <div class="button" data-onglet="onglet-5">
                    <img src="https://img.icons8.com/fluency-systems-regular/256/settings.png" alt="settings">
                </div>
                <a href="accueil.html">
                    <div class="button">
                        <img src="https://img.icons8.com/fluency-systems-regular/256/logout-rounded-left.png" alt="deconnexion">
                    </div>
                </a>
            </div>
        </div>

        <div class="container-onglet active" id="onglet-1">
            <div class="info">
                <div class="title">
                    <h2>Bienvenue, <?php echo $pseudo?></h2>
                    <div>
                        <img src="https://cdn-icons-png.flaticon.com/512/5197/5197842.png" alt="Pouce en l'air">
                    </div>
                </div>
                <p><?php echo $role ?></p>
            </div>
            <div id="statistics">
                <div class="box">
                    <h3>Dernier quiz</h3>
                    <p>
                        <?php
                            $sql = "SELECT * FROM quizz ORDER BY Id_quizz DESC LIMIT 1";
                            $result = mysqli_query($conn, $sql);
                            $row = mysqli_fetch_assoc($result);
                            $nom = $row['Titre'];
                            echo $nom;
                        ?>
                    </p>
                </div>
                <div class="box">
                    <h3>Quiz joué(s)</h3>
                    <p class="number">
                        <?php 
                            $sqltotal = "SELECT COUNT(*) AS total FROM jouer WHERE Id_utilisateur = '$id_user'";
                            $resulttotal = mysqli_query($conn, $sqltotal);
                            $row = mysqli_fetch_assoc($resulttotal);
                            $total = $row['total'];
                            echo $total;
                        ?>
                    </p>
                </div>
                <div class="box">
                    <h3>Total score</h3>
                    <p class="number">
                        <?php 
                            $sqlscore = "SELECT SUM(Score) AS total FROM jouer WHERE Id_utilisateur = '$id_user'";
                            $resultscore = mysqli_query($conn, $sqlscore);
                            $row = mysqli_fetch_assoc($resultscore);
                            $score = !empty($row['total']) ? $row['total'] : 0;
                            echo $score;
                        ?>
                    </p>
                </div>
            </div>
        </div>

        <div class="container-onglet" id="onglet-2">
            <div class="info">
                <div class="title">
                    <h2>Création</h2>
                    <div>
                        <img src="https://cdn-icons-png.flaticon.com/512/5204/5204758.png" alt="Crayon">
                    </div>
                </div>
                <p>Gérer vos quiz</p>
            </div>
            <div class="categories">
                <?php 
                    $sqlcreation = "SELECT * FROM creer WHERE Id_utilisateur = '$id_user'";
                    $resultcreation = mysqli_query($conn, $sqlcreation);

                    //POUR POUVOIR AFFICHER LE SCORE SUR LE TABLEAU DE BORD
                    // $sqlcreation2 = "SELECT * FROM jouer WHERE Id_utilisateur = '$id_user' AND Id_quizz = '$id_quiz' AND Score = '$score'";

                    while($rowcreation = mysqli_fetch_assoc($resultcreation)) {
                        $id_quiz = $rowcreation['Id_quizz'];


                        $sqlquiz = "SELECT * FROM quizz WHERE Id_quizz = '$id_quiz'";
                        $resultquiz = mysqli_query($conn, $sqlquiz);

                        $row = mysqli_fetch_assoc($resultquiz);
                        $nom_quiz = $row['Titre'];
                        $difficulte_quizz = $row['difficulte'];
                        $categorie_quizz = $row['Categorie'];
                        $date_quizz = $row['date_creation'];

                        echo "<div class='quiz2'>";
                        echo "<a href='deletequiz.php?role=$role&user=$id_user&deletequizz=$id_quiz' onclick=\"return confirm('Êtes-vous sûr de vouloir supprimer ce quiz?')\">";
                        echo "<img class='trash2' src='https://cdn-icons-png.flaticon.com/512/7641/7641678.png' alt='Supprimer'>";
                        echo "</a>";                        
                        echo "<h3 class='Name'>$nom_quiz</h3>";
                        
                        switch ($categorie_quizz) {
                            case 'Sport':
                                echo "<img class='illustration' src='https://cdn-icons-png.flaticon.com/512/4218/4218113.png' alt='Sport'>";
                                break;
                            case 'Cinema':
                                echo "<img class='illustration' src='https://cdn-icons-png.flaticon.com/512/5198/5198228.png' alt='Cinéma'>";
                                break;
                            case 'Musique':
                                echo "<img class='illustration' src='https://cdn-icons-png.flaticon.com/512/5198/5198104.png' alt='Musique'>";
                                break;
                            case 'Geographie':
                                echo "<img class='illustration' src='https://cdn-icons-png.flaticon.com/512/4218/4218484.png' alt='Géographie'>";
                                break;
                            case 'Animal':
                                echo "<img class='illustration' src='https://cdn-icons-png.flaticon.com/512/8176/8176142.png' alt='Animal'>";
                        }
                        echo "</div>";
                    }
                    
                ?>

                <?php
                    echo "<a href='creation.php?role=$role&user=$id_user'>";
                        echo "<div class='quiz2'>";
                        echo "<img id='add' src='https://img.icons8.com/fluency-systems-regular/256/plus-math.png' alt='Ajouter'>";
                        echo "</div>";
                    echo "</a>";
                ?>
            </div>
        </div>

        <div class="container-onglet" id="onglet-3">
            <div class="info">
                <div class="title">
                    <h2>Administrateur</h2>
                    <div>
                        <img src="https://cdn-icons-png.flaticon.com/512/7128/7128197.png" alt="Bouclier">
                    </div>
                </div>
                <div id="status">
                    <p>Quiz en ligne</p>
                    <div id="online"></div>
                </div>
                <div class="search-container">
                    <div id="search-icon">
                        <img src="https://img.icons8.com/fluency-systems-regular/256/search.png" alt="Rechercher">
                    </div>
                    <input class="searchBar" type="search" placeholder="Rechercher">
                </div>
            </div>

            <div class="container-list">
                <div id="list-user">
                    <table>
                        <tr>
                            <th id="id">Id</th>
                            <th>Utilisateur</th>
                            <th>Titre</th>
                            <th>Difficulté</th>
                            <th>Date</th>
                            <th>Modifier</th>
                            <th>Supprimer</th>
                        </tr>

                        <?php

                            $sqlcreation = "SELECT * FROM creer";
                            $resultcreation = mysqli_query($conn, $sqlcreation);
                            
                            while($row=mysqli_fetch_assoc($resultcreation)) {
                                $id_utilisateur = $row['Id_utilisateur'];
                                $id_quiz = $row['Id_quizz'];

                                $sqlquizz = "SELECT * FROM quizz WHERE Id_quizz = '$id_quiz'";                                                                
                                $resultquizz = mysqli_query($conn, $sqlquizz);

                                $rowquizz = mysqli_fetch_assoc($resultquizz);
                                
                                $nom_quizz = $rowquizz['Titre'];
                                $categorie_quizz = $rowquizz['Categorie'];
                                $date_quizz = $rowquizz['date_creation'];
                                $difficulte_quizz = $rowquizz['difficulte'];
                                

                                $sqlutilisateur = "SELECT * FROM utilisateur WHERE Id_utilisateur = '$id_utilisateur'";
                                $resultutilisateur = mysqli_query($conn, $sqlutilisateur);
                                
                                $rowutilisateur = mysqli_fetch_assoc($resultutilisateur);
                                
                                $pseudo_utilisateur = $rowutilisateur['pseudo'];

                                
                                // echo "L'utilisateur " .$id_utilisateur ." a créé le quiz " .$id_quiz ."<br>";
                                echo "<tr>";

                                echo "<td>" .$id_quiz ."</td>";
                                echo "<td>" .$pseudo_utilisateur ."</td>";
                                echo "<td>" .$nom_quizz ."</td>";
                                echo "<td>" .$difficulte_quizz ."</td>";
                                echo "<td>" .$date_quizz ."</td>";

                                echo "<td>";
                                echo "<a href='updatequizz.php?role=$role&user=$id_user&updatequizz=$id_quiz'>";
                                echo "<img class='edit' src='https://cdn-icons-png.flaticon.com/512/5204/5204758.png' alt='Modifier'>";
                                echo "</a>";
                                echo "</td>";
                                
                                echo "<td>";
                                echo "<a href='deletequiz.php?role=$role&user=$id_user&deletequizz=$id_quiz'>";
                                echo "<img class='trash' src='https://cdn-icons-png.flaticon.com/512/7641/7641678.png' alt='Supprimer'>";
                                echo "</a>";
                                echo "</td>";

                                echo "</tr>";
                            }

                        ?>

                    </table>
                </div>
            </div>
        </div>

        <div class="container-onglet" id="onglet-4">
            <div class="info">
                <div class="title">
                    <h2>Administrateur</h2>
                    <div>
                        <img src="https://cdn-icons-png.flaticon.com/512/3962/3962402.png" alt="Bouclier">
                    </div>
                </div>
                <div id="status">
                    <p>Liste utilisateurs</p>
                    <div id="online"></div>
                </div>
                <div class="buttons">
                    <div class="search-container">
                        <div id="search-icon">
                            <img src="https://img.icons8.com/fluency-systems-regular/256/search.png" alt="Rechercher">
                        </div>
                        <input class="searchBar" type="search" placeholder="Rechercher">
                    </div>
                    <div class="buttons">
                        <?php
                            echo "
                            <a href='create.php?role=$role_user&user=$id_user'>
                            <input class='button-save' type='submit' value='+ Ajouter'>
                            </a>
                            ";
                        ?>
                    </div>
                </div>
            </div>
            <div id="list-user">
                <table>
                    <tr>
                        <th id="id">Id</th>
                        <th>Utilisateur</th>
                        <th>Rôle</th>
                        <th>E-mail</th>
                        <th>Mot de passe</th>
                        <th>Modifier</th>
                        <th>Supprimer</th>
                    </tr>

                    <?php 
                        $sql2utilisateur = "SELECT * FROM utilisateur";
                        $result2utilisateur = mysqli_query($conn, $sql2utilisateur);

                        while($row2utilisateur = mysqli_fetch_assoc($result2utilisateur)) {
                            $id_utilisateur = $row2utilisateur['Id_utilisateur'];
                            $pseudo_user = $row2utilisateur['pseudo'];
                            $email_user = $row2utilisateur['email'];
                            $password_user = $row2utilisateur['password'];
                            $role_user = $row2utilisateur['role_utilisateur'];

                            switch ($role_user) {
                                case 1:
                                    $role_user = "Utilisateur";
                                    break;
                                case 2:
                                    $role_user = "Quizzeur";
                                    break;
                                case 3:
                                    $role_user = "Administrateur";
                                    break;
                            }
                            // echo "<form action='' method='post'";
                            echo "<tr>";
                            echo "<td>$id_utilisateur</td>";
                            echo "<td>$pseudo_user</td>";
                            echo "<td>$role_user</td>";
                            echo "<td>$email_user</td>";
                            echo "<td>$password_user</td>";
                            
                            echo "<td>";
                            echo "<a href='updateuser.php?role=$role&user=$id_user&updateId=$id_utilisateur&updateRole=$role_user'>";
                            echo "<img class='edit' src='https://cdn-icons-png.flaticon.com/512/5204/5204758.png' alt='Modifier'>";
                            echo "</a>";
                            echo "</td>";
                            
                            echo "<td>";
                            echo "<a href='delete.php?role=$role&user=$id_user&deleteId=$id_utilisateur'>";
                            echo "<img class='trash' src='https://cdn-icons-png.flaticon.com/512/7641/7641678.png' alt='Supprimer'>";
                            echo "</a>";

                            echo "</td>";

                            echo "</tr>";
                            // echo "</form>";

                        }
                    ?>
                </table>
            </div>
        </div>
        <div class="container-onglet" id="onglet-5">
            <div class="info">
                <div class="title">
                    <h2>Paramètre</h2>
                    <div>
                        <img src="https://cdn-icons-png.flaticon.com/512/8633/8633246.png" alt="Crayon">
                    </div>
                </div>
                <p>Modifier vos informations</p>
            </div>
            <div class="passwd">
                <form method="post" action="" class="update-user">
                    <div>
                        <label for="pseudo">Nom d'utilisateur</label>
                        <input type="text" name="pseudo" placeholder="Nom d'utilisateur" value="<?php echo $pseudo?>">
                    </div>
                    <div>
                        <label for="e-mail">Email</label>
                        <input type="text" name="e-mail" placeholder="Email" value="<?php echo $email?>">
                    </div>
                    <div>
                        <label for="password">Mot de passe</label>
                        <input type="password" name="password" placeholder="Ancien mot de passe">
                        <input type="password" name="new-password" placeholder="Nouveau mot de passe">
                        <input type="password" name="confirm-password" placeholder="Confirmer le mot de passe">
                    </div>
                    <input type="submit" class="button-save" name="update-user" value="Modifier">

                    <?php 
                        if(isset($_POST['update-user'])) {
                            $pseudo = $_POST["pseudo"];
                            $email = $_POST["e-mail"];
                            $password = $_POST["password"];
                            $new_password = $_POST["new-password"];
                            $confirm_password = $_POST["confirm-password"];

                            $sqlmodif = "SELECT * FROM utilisateur WHERE pseudo = '$pseudo' AND email = '$email' AND password = '$password'";
                            $resultmodif = mysqli_query($conn, $sqlmodif);

                            if (mysqli_num_rows($resultmodif) > 0) {
                                $rowmodif = mysqli_fetch_assoc($resultmodif);
                                $id = $rowmodif["Id_utilisateur"];
                                $pseudobd = $rowmodif["pseudo"];
                                $emailbd = $rowmodif["email"];
                                $passwordbd = $rowmodif["password"];

                                if ($passwordbd === $password) {
                                    if ($new_password === $confirm_password) {
                                        $sqlupdate = "UPDATE utilisateur SET pseudo = '$pseudo', email = '$email', password = '$new_password' WHERE Id_utilisateur = '$id'";
                                        $resultupdate = mysqli_query($conn, $sqlupdate);
                                        echo "<script>alert('Modification réussie')</script>";
                                    } else {
                                        echo "<script>alert('Les mots de passe ne correspondent pas.')</script>"; 
                                    }
                                } else {
                                    echo "<script>alert('Mot de passe incorrect')</script>";
                                }
                            }
                        }
                    ?>

                </form>
            </div>
        </div>
    </div>
    <script>
        if ('<?php echo $id_user ?>' !== '1') {
            $('#onglet-3, #onglet-4, .button[data-onglet="onglet-3"], .button[data-onglet="onglet-4"],hr').remove();
        }

        if ('<?php echo $role ?>' !== 'Administrateur' && '<?php echo $role ?>' !== 'Quizzeur') {
            $('.button[data-onglet="onglet-2"]').remove();
        }

        $(".button").click(function () {
            $(".button").removeClass("active");
            $(".container-onglet").removeClass("active");

            $(this).addClass("active");
            var tab = $(this).data("onglet");
            $("#" + tab).addClass("active");
        });

        $('input[type="search"]').focus(function () {
            $(".search-container").css("width", "400px");
        });

        $('input[type="search"]').blur(function () {
            $(".search-container").css("width", "220px");
        });

        $(".searchBar").on("input", function() {
            const query = $(this).val().toLowerCase();
            $("tr:not(:first-child)").each(function() {
                const utilisateur = $(this).find("td:nth-child(2)").text().toLowerCase();
                const titre = $(this).find("td:nth-child(3)").text().toLowerCase();
                if (utilisateur.includes(query) || titre.includes(query)) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        });


        // $(".searchBar").on("input", function () {
        //     const query = $(this).val().toLowerCase();
        //     $("tr").each(function() {
        //         const title = $(this).find("td:eq(2)").text().toLowerCase();

        //         if (title.includes(query)) {
        //             $(this).css("display", "flex");
        //         } else {
        //             $(this).css("display", "none");
        //         }
        //     });
        // });


        // $(".searchBar").on("input", function () {
        //     const query = $(this).val().toLowerCase();
        //     $("tr").each(function() {
        //         const title = $(this).data("category").toLowerCase();

        //         if (title.includes(query)) {
        //             $(this).css("display", "flex");
        //         } else {
        //             $(this).css("display", "none");
        //         }
        //     });
        // });

    </script>
</body>

</html>