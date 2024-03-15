<?php 

require('bdconnexion.php');

if (isset($_GET['user']) && isset($_GET['role']) && isset($_GET['deleteId'])) {

    $id_user = $_GET['user'];
    $role_user = $_GET['role'];
    $delete_user = $_GET['deleteId'];



    $sql = "DELETE FROM utilisateur WHERE `Id_utilisateur` = '$delete_user'";
    $result = mysqli_query($conn, $sql);

    $sqlcreer = "DELETE FROM creer WHERE `Id_utilisateur` = '$delete_user'";
    $resultcreer = mysqli_query($conn, $sqlcreer);

    


    if ($result) {
        header('Location:dashboard.php?role='.$role_user.'&user='.$id_user.'');
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
}


?>