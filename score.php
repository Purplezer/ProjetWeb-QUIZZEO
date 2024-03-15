<?php
$score = $_POST['score'];
$id_user = $_POST['user'];
$id_quizz = $_POST['idquizz'];

echo $score;
echo $id_user;
echo $id_quizz;

require ('bdconnexion.php');

//vérification de s'il y a deja un score pour ce quizz
$sql = "SELECT * FROM jouer WHERE Id_utilisateur = '$id_user' AND Id_quizz = '$id_quizz'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    //si oui, on update le score
    $sql = "UPDATE jouer SET Score = '$score' WHERE Id_utilisateur = '$id_user' AND Id_quizz = '$id_quizz'";
    $result = mysqli_query($conn, $sql);
    if (!$result) {
        echo "Erreur lors de la mise à jour du score";
    } else {
        echo "Score mis à jour";
    }
} else {
    //si non, on insert le score
    $sql = "INSERT INTO jouer (Id_utilisateur, Id_quizz, Score) VALUES ('$id_user', '$id_quizz', '$score')";
    $result = mysqli_query($conn, $sql);
    if (!$result) {
        echo "Erreur lors de l'enregistrement du score";
    } else {
        echo "Score enregistré";
    }
}

// $sql = "INSERT INTO jouer (Id_utilisateur, Id_quizz, Score) VALUES ('$id_user', '$id_quizz', '$score')";
// $result = mysqli_query($conn, $sql);

// if (!$result) {
//     echo "Erreur lors du score";
    
// } else {
//     echo "Score enregistré";
// }

?>