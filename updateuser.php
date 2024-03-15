<?php 

require('bdconnexion.php');

if(isset($_GET['user'])) {
    $id_user = $_GET['user'];
}

if(isset($_GET['role'])) {
    $role = $_GET['role'];
}

if(isset($_GET['updateId'])) {
    $updateId = $_GET['updateId'];
}

if(isset($_GET['updateRole'])) {
    $updateRole = $_GET['updateRole'];
}

?>

<DOCTYPE html>
    <html>
        <head>
            <meta charset="utf-8">
            <title>Modification Utilisateur</title>
            <link rel="stylesheet" type="text/css" media="screen"  href="modif.css">
        </head>
        <body>
            <?php 

                if(isset($_GET['updateId'])) {
                    $id_utilisateur = $_GET['updateId'];
                }

                if(isset($_GET['updateRole'])) {
                    $role = $_GET['updateRole'];
                }

                $sqlutilisateur = "SELECT * FROM utilisateur WHERE Id_utilisateur = '$updateId'";
                $resultutilisateur = mysqli_query($conn, $sqlutilisateur);
                
                while($row = mysqli_fetch_assoc($resultutilisateur)) {
                    $id_utilisateur = $row['Id_utilisateur'];
                    $pseudo_utilisateur = $row['pseudo'];
                    $email_utilisateur = $row['email'];
                    $password_utilisateur = $row['password'];
                    $role_utilisateur = $row['role_utilisateur'];
                }
            ?>

            <h1>Modification de l'utilisateur <?php echo $pseudo_utilisateur ?></h1>
            <form action='' method='post' class='formAjout'>
                <div class='form-example'>
                    <label for='nom'>Pseudo</label>
                    <input type='text' name='pseudo' id='pseudo' value='<?php echo $pseudo_utilisateur?>' required>
                </div>
                <div class='form-example'>
                    <label for='Email'>Email</label>
                    <input type='email' name='email' id='email' value='<?php echo $email_utilisateur?>' required>
                </div>
                <div class='form-example'>
                    <label for='password'>Mot de passe</label>
                    <input type='password' name='password' id='password' value='<?php echo $password_utilisateur?>' required>
                </div>
                <div class='form-example'>
                    <label for='role'>Role</label>
                    <select name='role' id='role'>
                        <option value='1'>Utilisateur</option>
                        <option value='2'>Quizzeur</option>
                        <option value='3'>Administrateur</option>
                    </select>
                </div>
                <div class='form-example'>
                    <input type='submit' name='Usersubmit' value="Modifier l'utilisateur <?php echo $pseudo_utilisateur?>">
                </div>
            </form>
        
            <?php

            if(isset($_POST['Usersubmit'])) {
                $pseudo = $_POST['pseudo'];
                $email = $_POST['email'];
                $role = $_POST['role'];
                $sql = "UPDATE utilisateur SET pseudo = '$pseudo', email = '$email', role_utilisateur = '$role' WHERE Id_utilisateur = '$updateId'";
                $result = mysqli_query($conn, $sql);
                if($result) {
                    header('Location: dashboard.php?role='.$role_user.'&user='.$id_user.'');
                } else {
                    echo "Erreur lors de la modification de l'utilisateur";
                }
            }

            ?>

        </body>