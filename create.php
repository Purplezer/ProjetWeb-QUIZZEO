<?php

require('bdconnexion.php');

if(isset($_GET['user'])) {
    $id_user = $_GET['user'];
}

if(isset($_GET['role'])) {
    $role = $_GET['role'];
}

$pseudo ="";
$email ="";
$password ="";
$role ="";

$errorMessage = "";
$successMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pseudo = $_POST["pseudo"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $role = $_POST["role"];

    do {
        if (empty($pseudo) || empty($email) || empty($password) || empty($role)) {
            $errorMessage = "Veuillez remplir tous les champs";
            break;
        }

        // Add new user to database

        $sql = "INSERT INTO `utilisateur`(`pseudo`, `email`, `password`, `role_utilisateur`) VALUES ('$pseudo','$email','$password','$role')";
        $result = mysqli_query($conn, $sql);

        if (!$result) {
            $errorMessage = "Erreur lors de l'ajout de l'utilisateur";
            break;
        }

        $name = "";
        $email = "";
        $password = "";
        $role = "";

        $successMessage = "Utilisateur ajouté avec succès";

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
    <title>Mes Utilisateurs</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container my-5">
        <h2>Nouvel Utilisateur</h2>

        <?php 
            if (!empty($errorMessage)) {
                echo "
                    <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                        <strong>$errorMessage</strong>
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>
                    ";
            } 
        ?>

        <form method="post">

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Pseudo</label>
                <div class="col-sm-6">
                    <input type="text" name="pseudo" id="pseudo" placeholder="Pseudo" class="form-control" value="<?php echo $pseudo; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Email</label>
                <div class="col-sm-6">
                    <input type="email" name="email" id="email" placeholder="Email" class="form-control" value="<?php echo $email; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Mot de passe</label>
                <div class="col-sm-6">
                    <input type="password" name="password" id="password" placeholder="Mot de passe" class="form-control" value="<?php echo $password; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Rôle</label>
                <div class="col-sm-6">
                    <select name="role" id="role" class="form-control">
                        <option value="1">Utilisateur</option>
                        <option value="2">Quizzeur</option>
                        <option value="3">Administrateur</option>
                    </select>
                </div>
            </div>

            <?php 
                if (!empty($successMessage)) {
                    echo "
                        <div class='alert alert-success alert-dismissible fade show' role='alert'>
                            <strong>$successMessage</strong>
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>
                        ";
                }
            ?>

            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Ajouter</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="/" role="button">Annuler</a>
                </div>
            </div>

        </form>
    </div>
</body>
</html>