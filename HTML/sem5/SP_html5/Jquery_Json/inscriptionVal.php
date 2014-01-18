<?php 
    // Vérification des paramètres POST
    if (!isset($_POST['pseudo']) || !isset($_POST['password']) || !isset($_POST['passwordConfirm'])
            || !isset($_POST['email']) || !isset($_POST['sexe']) || !isset($_POST['naissance'])
            || !isset($_POST['presentation']) || !isset($_POST['niveau'])) {
        header('Location: inscriptionKo.php');
        exit;
    } else {
        header('Location: inscriptionOk.php');
        exit;
    }
?>