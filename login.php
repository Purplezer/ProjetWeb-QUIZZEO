<?php

require('bdconnexion.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="https://img.icons8.com/sf-black/64/000000/search.png">
    <link rel="stylesheet" href="inscription.css">
    <title>Quizzeo</title>
</head>

<body>
    <header>
        <a class="home" href="accueil.html">
            <span>Quiz</span><span>zeo.</span>
        </a>
    </header>
    <div class="container">
        <div class="icons">
            <img src="https://cdn-icons-png.flaticon.com/512/4218/4218472.png" alt="Lettres">
            <img src="https://cdn-icons-png.flaticon.com/512/4058/4058331.png" alt="Fruit">
            <img src="https://cdn-icons-png.flaticon.com/512/4218/4218113.png" alt="Ballon de basket">
            <img src="https://cdn-icons-png.flaticon.com/512/4218/4218478.png" alt="Couleurs">
            <img src="https://cdn-icons-png.flaticon.com/512/5204/5204758.png" alt="Crayon">
            <img src="https://cdn-icons-png.flaticon.com/512/4218/4218493.png" alt="Loupe">
            <img src="https://cdn-icons-png.flaticon.com/512/4218/4218484.png" alt="Globe terrestre">
        </div>
        <div class="container-login">
            <div class="imgLogin">
                <h1>Connexion</h1>
            </div>

            <?php
                if(isset($_POST['submit'])) {
                    $pseudo = $_POST['pseudo'];
                    $password = $_POST['password'];
                    $email = $_POST['email'];

                    $sql = "SELECT * FROM utilisateur WHERE pseudo = '$pseudo' AND password = '$password' AND email = '$email'";
                    $result = mysqli_query($conn, $sql);
                    $sql2 = "SELECT role_utilisateur FROM utilisateur WHERE pseudo = '$pseudo' AND password = '$password' AND email = '$email'";
                    $result2 = mysqli_query($conn, $sql2);
                    $sql3 = "SELECT Id_utilisateur FROM utilisateur WHERE pseudo = '$pseudo' AND password = '$password' AND email = '$email'";
                    $result3 = mysqli_query($conn, $sql3);


                    if (mysqli_num_rows($result) > 0) {
                        $row = mysqli_fetch_assoc($result2);
                        $role = $row['role_utilisateur'];
                        $row2 = mysqli_fetch_assoc($result3);
                        $id_user = $row2['Id_utilisateur'];

                        switch ($role) {
                            case '1':
                                $role = "Utilisateur";
                                header('Location: home.php?role='.$role.'&user='.$id_user.'');
                                break;
                            case '2':
                                $role = "Quizzeur";
                                header('Location: home.php?role='.$role.'&user='.$id_user.'');
                                break;
                            case '3':
                                $role = "Administrateur";
                                header('Location: dashboard.php?role='.$role.'&user='.$id_user.'');
                                break;
                            default :   
                                echo "<h2>Erreur de connexion</h2>";
                                break;
                        }
                        
                    } else {
                        $error = 'Nom d\'utilisateur ou mot de passe incorrect</h2>';

                        $errors = array();
                        $sql = "SELECT * FROM utilisateur WHERE pseudo = '$pseudo'";
                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result) == 0) {
                            $errors[] = 'Nom d\'utilisateur incorrect';
                        }
                        $sql = "SELECT * FROM utilisateur WHERE email = '$email'";
                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result) == 0) {
                            $errors[] = 'Email incorrect';
                        }
                        if (count($errors) == 0) {
                            $errors[] = 'Mot de passe incorrect';
                        }

                        foreach($errors as $error) {
                            echo "<h2>$error</h2>";
                        }
                    }

                    mysqli_close($conn);

                }

            ?>

            <div class="login">
                <form method="post" action="">
                    <input type="text" name="pseudo" placeholder="Nom d'utilisateur" required>
                    <input type="email" name="email" placeholder="E-mail" required>
                    <input type="password" name="password" placeholder="Mot de passe" required>
                    <input class="submit" type="submit" name="submit" value="Se connecter">
                    <div class="other">
                        <div>
                            <span>Pas encore inscrit ?</span>
                            <a href="inscription.php">Créer un compte</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
