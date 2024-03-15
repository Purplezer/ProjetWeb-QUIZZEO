<?php 

require('bdconnexion.php');

if (isset($_GET['user']) && isset($_GET['role']) && isset($_GET['deletequizz'])) {

    $id_user = $_GET['user'];
    $role_user = $_GET['role'];
    $delete_quizz = $_GET['deletequizz'];
    
    $sqlcreate = "SELECT * FROM creer WHERE Id_quizz = '$delete_quizz'";
    $resultcreate = mysqli_query($conn, $sqlcreate);

    if (mysqli_num_rows($resultcreate) > 0) {
        // output data of each row
        while($row2 = mysqli_fetch_assoc($resultcreate)) {
            $id_quizz = $row2['Id_quizz'];

            echo $id_quizz;
            echo "<br>";
        }
    } else {
        echo "0 results";
    }

    $sqlquizz = "SELECT * FROM quizz WHERE Id_quizz = '$id_quizz'";
    $resultquizz = mysqli_query($conn, $sqlquizz);

    $sqlquestion = "SELECT * FROM question WHERE Id_quizz = '$id_quizz'";
    $resultquestion = mysqli_query($conn, $sqlquestion);

    if (mysqli_num_rows($resultquestion) > 0) {
        // output data of each row
        while($row3 = mysqli_fetch_assoc($resultquestion)) {
            $id_question = $row3['Id_question'];

            echo $id_question;
            echo "<br>";

            $sqlreponse = "SELECT * FROM choix WHERE Id_question = '$id_question'";
            $resultreponse = mysqli_query($conn, $sqlreponse);

            if (mysqli_num_rows($resultreponse) > 0) {
                // output data of each row
                while($row4 = mysqli_fetch_assoc($resultreponse)) {
                    $id_reponse = $row4['Id_rep'];
                    
                    $sqldeletereponse = "DELETE FROM choix WHERE `Id_question` = '$id_question'";
                    $resultdeletereponse = mysqli_query($conn, $sqldeletereponse);

                    if ($resultdeletereponse) {
                        
                    } else {
                        echo "Error deleting record: " . mysqli_error($conn);
                    }

                    echo "rep :".$id_reponse;   
                    echo "<br>";

                }
            } else {
                echo "0 results";
            }
        }
    } else {
        echo "0 results";
    }

    $sqldeletequestion = "DELETE FROM question WHERE `Id_quizz` = '$id_quizz'";
    $resultdeletequestion = mysqli_query($conn, $sqldeletequestion);

    if ($resultdeletequestion) {
        
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }

    $sqldeletequizz = "DELETE FROM quizz WHERE `Id_quizz` = '$delete_quizz'";
    $resultdeletequizz = mysqli_query($conn, $sqldeletequizz);

    if ($resultdeletequizz) {
        
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }

    $sqldeletecreate = "DELETE FROM creer WHERE `Id_quizz` = '$delete_quizz'";
    $resultdeletecreate = mysqli_query($conn, $sqldeletecreate);

    if ($resultdeletecreate) {
        header('Location:dashboard.php?role='.$role_user.'&user='.$id_user.'');
        
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }

}


?>